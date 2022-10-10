<?php

namespace App\Http\Controllers;

use App\Repositories\ParticipantRepository;
use App\Http\Controllers\AppBaseController;
use App\Models\Participant;
use Illuminate\Http\Request;
use Response;
use Laracasts\Flash\Flash;

class Check_InController extends AppBaseController
{
    /** @var ParticipantRepository $participantRepository*/
    private $participantRepository;

    public function __construct(ParticipantRepository $participantRepo)
    {
        $this->participantRepository = $participantRepo;
    }

    /**
     * Display a listing of the Participant.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        if (isset($request->id)) {
            $participant = Participant::where('uuid', $request->id)->firstorfail();
            $participant->checkedin_at = now();

            // ここで引率するスカウトも同時チェックインする

            $participant->save();
            return view('check_in.index')
                ->with('participant', $participant);
        } else {
            return back();
        }
    }

    public function input(Request $request)
    {
        if (isset($request->furigana)) {
            $participants = Participant::where('furigana', 'like', "$request->furigana%")->where('checkedin_at', null)->get();

            // 引率スカウトの取得
            foreach ($participants as $value) {
                if ($value->is_represent == "県連代表(4)") {
                    $value->vs = Participant::where('pref', $value->pref)->where('is_represent', '県連代表(5)')->select('name')->first();
                    $value->bs = Participant::where('pref', $value->pref)->where('is_represent', '県連代表(6)')->select('name')->first();
                }
            }
            return view('check_in.input')->with('participants', $participants);
        }

        // 手入力チェックインの場合
        if (isset($request->uuid)) {
            $participant = Participant::where('uuid', $request->uuid)->firstorfail();
            $participant->checkedin_at = now();

            // 引率スカウトの取得
            if ($participant->is_represent == "県連代表(4)") {
                $vs = Participant::where('pref', $participant->pref)->where('is_represent', '県連代表(5)')->select('id', 'name')->first();
                $bs = Participant::where('pref', $participant->pref)->where('is_represent', '県連代表(6)')->select('id', 'name')->first();
            }

            // 打刻
            if (isset($vs)) {
                $vs->checkedin_at = $participant->checkedin_at;
            }

            if (isset($bs)) {
                $bs->checkedin_at = $participant->checkedin_at;
            }
            // 打刻

            // DB保存
            $participant->save();
            $vs->save();
            $bs->save();





            Flash::success($participant->name . "さんのチェックイン完了");
            return view('check_in.input')->with('participant', $participant);
        }

        return view('check_in.input');
        // ->with('participant', $participant);
    }

    public function self_check_in(Request $request)
    {
        $uuid = $request['checkin_id'];

        // 対象取得(未チェックインを抽出)
        $person = Participant::where('uuid', $uuid)->where('checkedin_at', null)->firstorfail();
        $person->checkedin_at = now();  // 指導者

        // 引率スカウトを引っ張る
        if ($person->is_represent == "県連代表(4)") {
            $vs = Participant::where('pref', $person->pref)->where('is_represent', '県連代表(5)')->first();
            $bs = Participant::where('pref', $person->pref)->where('is_represent', '県連代表(6)')->first();

            // チェックイン処理
            if (empty($vs->self_absent)) {  // 欠席入力があればチェックインの打刻しない
                $vs->checkedin_at = now();  // VS
            }

            if (empty($bs->self_absent)) {  // 欠席入力があればチェックインの打刻しない
                $bs->checkedin_at = now();  // BS
            }
        }

        // DB保存
        $person->save();
        $vs->save();
        $bs->save();



        Flash::success($person->name . 'さんのチェックイン処理をしました');
        return back();
    }
}
