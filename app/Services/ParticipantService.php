<?php

namespace App\Services;

use App\Models\Participant;
use App\Validations\participantValidation;
use Illuminate\Support\Facades\Log;

class ParticipantService
{
    protected participantValidation $participantValidation;
    public function __construct(participantValidation $participantValidation)
    {
        $this->participantValidation = $participantValidation;

    }

    public function listParticipants()
    {
        $listParticipants = Participant::paginate(10);
        return $listParticipants;
    }
    public function createParticipant($data)
    {
        $response = ['message' => null, 'status' => 200];
        $validation = $this->participantValidation->validate($data, null);
        if ($validation['status'] === true){
            return ['message' => $validation['errors'], 'status' => 400];
        }
        try {
            $participant = Participant::create($data);
            $response['message'] = $participant;

        } catch (\Exception $e) {
            Log::error('error al crear el empleado: ' . $e->getMessage());
            $response = ['message' => $e->getMessage(), 'status' => 500];
        }
        return $response;
    }
    public function updateParticipant($data, $id)
    {
        $response = ['message' => null, 'status' => 200];
        try {
            $participant = Participant::find((integer)$id);
            if(!$participant) {
                return ['message' => 'participant not found', 'status' => 400];
            }
            $validation = $this->participantValidation->validate($data, (integer)$id);
            if ($validation['status'] === true){
                return ['message' => $validation['errors'], 'status' => 400];
            }
            $participant = $participant->update($data);
            $response['message'] = $participant;

        } catch (\Exception $e) {
            Log::error('error al crear el empleado: ' . $e->getMessage());
            $response = ['message' => $e->getMessage(), 'status' => 500];
        }
        return $response;
    }
    public function deleteParticipant($id)
    {
        $response = ['message' => null, 'status' => 200];
        try {
            $participant = Participant::find((integer)$id);
            if(!$participant) {
                return ['message' => 'participant not found', 'status' => 400];
            }
            $participant->delete($id);
            $response['message'] = true;

        } catch (\Exception $e) {
            Log::error('error al crear el empleado: ' . $e->getMessage());
            $response = ['message' => $e->getMessage(), 'status' => 500];
        }
        return $response;
    }

}
