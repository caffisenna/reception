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
        if(isset($request->furigana)){
            $participants = Participant::where('furigana','like',"$request->furigana%")->where('checkedin_at',null)->paginate(100);
            return view('participants.index')->with('participants', $participants);
        }

        if(isset($request->prefecture)){
            $participants = Participant::where('pref',"$request->prefecture")->where('checkedin_at',null)->paginate(100);
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
}
