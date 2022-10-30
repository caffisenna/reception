<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateParticipantRequest;
use App\Http\Requests\UpdateParticipantRequest;
use App\Repositories\ParticipantRepository;
use App\Http\Controllers\AppBaseController;
use App\Models\Participant;
use Illuminate\Http\Request;
use Flash;
use Response;
use Ramsey\Uuid\Uuid;
use Illuminate\Support\Facades\Mail;
use App\Mail\InvitationSend;

class ParticipantController extends AppBaseController
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
        $participants = $this->participantRepository->paginate(100);

        return view('participants.index')
            ->with('participants', $participants);
    }

    public function search(Request $request)
    {
        if (isset($request->furigana)) {

            // 個別氏名をサーチ
            $participants = Participant::where('furigana', 'like', "$request->furigana%")->where('checkedin_at', null)->paginate(100);

            // foreachで回して、引率指導者の場合は同じ県連のBSとVSを引っかける
            // $participant->vs $participant->bs などに格納
            foreach ($participants as $value) {
                if ($value->category == "県連代表(4)") {
                    $value->vs = Participant::where('pref', $value->pref)->where('category', '県連代表(5)')->select('name')->first();
                    $value->bs = Participant::where('pref', $value->pref)->where('category', '県連代表(6)')->select('name')->first();
                }
            }

            // 結果を返す
            return view('participants.index')->with('participants', $participants);
        }

        if (isset($request->prefecture)) {
            $participants = Participant::where('pref', "$request->prefecture")->where('checkedin_at', null)->paginate(100);
            return view('participants.index')->with('participants', $participants);
        }
    }

    /**
     * Show the form for creating a new Participant.
     *
     * @return Response
     */
    public function create()
    {
        return view('participants.create');
    }

    /**
     * Store a newly created Participant in storage.
     *
     * @param CreateParticipantRequest $request
     *
     * @return Response
     */
    public function store(CreateParticipantRequest $request)
    {
        $input = $request->all();

        // UUID生成
        $input['uuid'] = Uuid::uuid4();

        $participant = $this->participantRepository->create($input);

        Flash::success('参加者を登録しました');

        return redirect(route('participants.index'));
    }

    /**
     * Display the specified Participant.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $participant = $this->participantRepository->find($id);

        if (empty($participant)) {
            Flash::error('Participant not found');

            return redirect(route('participants.index'));
        }

        return view('participants.show')->with('participant', $participant);
    }

    /**
     * Show the form for editing the specified Participant.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $participant = $this->participantRepository->find($id);

        if (empty($participant)) {
            Flash::error('Participant not found');

            return redirect(route('participants.index'));
        }

        return view('participants.edit')->with('participant', $participant);
    }

    /**
     * Update the specified Participant in storage.
     *
     * @param int $id
     * @param UpdateParticipantRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateParticipantRequest $request)
    {
        $participant = $this->participantRepository->find($id);

        if (empty($participant)) {
            Flash::error('Participant not found');

            return redirect(route('participants.index'));
        }

        $participant = $this->participantRepository->update($request->all(), $id);

        Flash::success('更新しました');

        return redirect(route('participants.index'));
    }

    /**
     * Remove the specified Participant from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $participant = $this->participantRepository->find($id);

        if (empty($participant)) {
            Flash::error('Participant not found');

            return redirect(route('participants.index'));
        }

        $this->participantRepository->delete($id);

        Flash::success('削除しました');

        return redirect(route('participants.index'));
    }

    public function checked_in(Request $request)
    {
        $participants = Participant::where('checkedin_at', '<>', NULL)
            ->paginate(100);

        return view('participants.checked_in')
            ->with('participants', $participants);
    }

    public function cancel_check_in(Request $request)
    {
        $uuid = $request['uuid'];
        $participant = Participant::where('uuid', $uuid)->firstorfail();

        if (empty($participant)) {
            Flash::error('Participant not found');

            return redirect(route('participants.index'));
        }

        if (isset($participant)) {
            $participant->checkedin_at = NULL;
            $participant->save();
        }

        Flash::success($participant->name . 'のチェックインを取り消しました');

        return back();
    }

    public function absent_list(Request $request)
    {
        $participants = Participant::where('self_absent', '<>', NULL)
            ->paginate(100);

        return view('participants.absent_list')
            ->with('participants', $participants);
    }

    public function cancel_absent(Request $request)
    {
        $uuid = $request['uuid'];
        $participant = Participant::where('uuid', $uuid)->firstorfail();

        if (empty($participant)) {
            Flash::error('Participant not found');

            return redirect(route('participants.index'));
        }

        if (isset($participant)) {
            $participant->self_absent = NULL;
            $participant->save();
        }

        Flash::success($participant->name . 'の欠席入力を取り消しました');

        return back();
    }

    public function not_checked_in(Request $request)
    {
        $participants = Participant::where('checkedin_at', NULL)
            ->paginate(100);

        return view('participants.checked_in')
            ->with('participants', $participants);
    }

    public function sendmail(Request $request)
    {
        $input = $request->all();
        if (isset($input['uuid'])) { // UUID取得
            $participant = Participant::where('uuid', $input['uuid'])->first();
            $sendto = ['email' => $participant->email];
            Mail::to($sendto)->queue(new InvitationSend($participant));
            Flash::success($participant->name . '様へデジタルパスを送信しました');
        }

        $participants = Participant::where('deleted_at', NULL)
            ->paginate(100);

        return view('participants.sendmail')
            ->with('participants', $participants);
    }

    public function sendmail_pref(Request $request)
    // 県連ごとの送信
    {
        $input = $request->all();
        if (isset($input['pref'])) { // 県連取得
            $participants = Participant::where('pref', $input['pref'])->get();

            foreach ($participants as $participant) {
                // 個別にメール送信をループ
                $sendto = ['email' => $participant->email];
                Mail::to($sendto)->queue(new InvitationSend($participant));
            }
            Flash::success($input['pref'] . '連盟へデジタルパスを送信しました');
        }

        $prefs = array('北海道', '青森', '岩手', '宮城', '秋田', '山形', '福島', '茨城', '栃木', '群馬', '埼玉', '千葉', '東京', '神奈川', '新潟', '富山', '石川', '福井', '山梨', '長野', '岐阜', '静岡', '愛知', '三重', '滋賀', '京都', '大阪', '兵庫', '奈良', '和歌山', '鳥取', '島根', '岡山', '広島', '山口', '徳島', '香川', '愛媛', '高知', '福岡', '佐賀', '長崎', '熊本', '大分', '宮崎', '鹿児島', '沖縄', '荻窪');

        return view('participants.sendmail_pref')->with('prefs', $prefs);
    }
}
