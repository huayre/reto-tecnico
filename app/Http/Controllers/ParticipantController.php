<?php

namespace App\Http\Controllers;

use App\Services\ParticipantService;
use App\Validations\participantValidation;
use Illuminate\Http\Request;

class ParticipantController
{
    protected ParticipantService $participantService;
    public function __construct(ParticipantService $participantService)
    {
        $this->participantService = $participantService;
    }
    public function index()
    {
        $listParticipant = $this->participantService->listParticipants();
        return response()->json($listParticipant);
    }
    public function store(Request $request)
    {
        $response = $this->participantService->createParticipant($request->all());
        return response()->json(['message' => $response['message']],$response['status']);
    }
    public function update(Request $request, $id)
    {
        $response = $this->participantService->updateParticipant($request->all(), $id);
        return response()->json(['message' => $response['message']],$response['status']);
    }
    public function delete($id)
    {
        $response = $this->participantService->deleteParticipant($id);
        return response()->json(['message' => $response['message']],$response['status']);
    }

}
