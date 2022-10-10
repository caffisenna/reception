<?php

namespace App\Http\Controllers;

use App\Models\Participant;
use Illuminate\Http\Request;
use Response;
use Laracasts\Flash\Flash;

class CancelController extends AppBaseController
{
    /** @var ParticipantRepository $participantRepository*/

    /**
     * Display a listing of the Participant.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        //ここから処理を書く
        // dd($request);  $request['furigana']で検索キーを受ける
        // cat = checkin => チェックイン処理
        // cat = absent => 欠席処理


        if (isset($request['uuid'])) { // 削除リクエストの処理
            $uuid = $request['uuid'];
            $cat = $request['cat'];
            $cancel = Participant::where('uuid', $uuid)->firstorfail();
            if ($cat == 'checkin') { // チェックインのキャンセル
                $cancel->checkedin_at = NULL;
                $cancel->save();
                Flash::success($cancel->name . "さんのチェックイン処理を取り消しました");
                return back();
            } elseif ($cat == 'absent') { // 欠席手続きのキャンセル
                $cancel->self_absent = NULL;
                $cancel->save();
                Flash::success($cancel->name . "さんの欠席処理を取り消しました");
                return back();
            }
        } else { // 何もリクエストがないとき
            $participants = Participant::where('checkedin_at', '<>', NULL)
                ->orwhere('self_absent', '<>', NULL)->orderby('id', 'asc')->get();

            // $participant->save();
            return view('cancel.index')
                ->with('participants', $participants);
        }
    }

    // public function input(Request $request)
    // {
    //     // dd($request['uuid']); uuidが取れる
    //     if (isset($request->furigana)) {
    //         $participants = Participant::where('furigana', 'like', "$request->furigana%")
    //             ->where('checkedin_at', null)
    //             ->where('self_absent', null)
    //             ->get();

    //         return view('absent.input')->with('participants', $participants);
    //     }

    //     // 手入力チェックインの場合
    //     if (isset($request->uuid)) {
    //         $participant = Participant::where('uuid', $request->uuid)->firstorfail();
    //         $participant->self_absent = 'スタッフ入力';
    //         $participant->save();
    //         Flash::success($participant->name . "さんの欠席処理が完了しました");
    //         return view('absent.input')->with('participant', $participant);
    //     }

    //     return view('absent.input');
    // }

    // public function fever(Request $request)
    // {
    //     // dd($request['uuid']); uuidが取れる
    //     if (isset($request->furigana)) {
    //         $participants = Participant::where('furigana', 'like', "$request->furigana%")
    //             ->where('checkedin_at', null)
    //             ->where('self_absent', null)
    //             ->get();

    //         return view('fever_absent.input')->with('participants', $participants);
    //     }

    //     // 手入力チェックインの場合
    //     if (isset($request->uuid)) {
    //         $participant = Participant::where('uuid', $request->uuid)->firstorfail();
    //         $participant->self_absent = '発熱NG';
    //         $participant->save();
    //         Flash::success($participant->name . "さんの発熱欠席処理が完了しました");
    //         return view('fever_absent.input')->with('participant', $participant);
    //     }

    //     return view('fever_absent.input');
    // }
}
