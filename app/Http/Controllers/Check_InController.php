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
        }else{
            return back();
        }


    }

    public function input(Request $request){
        if(isset($request->furigana)){
            $participants = Participant::where('furigana','like',"$request->furigana%")->where('checkedin_at',null)->get();

            // 引率スカウトの取得
            foreach ($participants as $value) {
                if($value->is_represent == "県連代表(4)"){
                    $value->vs = Participant::where('pref', $value->pref)->where('is_represent','県連代表(5)')->select('name')->first();
                    $value->bs = Participant::where('pref', $value->pref)->where('is_represent','県連代表(6)')->select('name')->first();
                }
            }
            return view('check_in.input')->with('participants', $participants);
        }

        // 手入力チェックインの場合
        if(isset($request->uuid)){
            $participant = Participant::where('uuid',$request->uuid)->firstorfail();
            $participant->checkedin_at = now();
            $participant->save();
            Flash::success($participant->name . "さんのチェックイン完了");
            return view('check_in.input')->with('participant', $participant);
        }

        return view('check_in.input');
            // ->with('participant', $participant);
    }
}
