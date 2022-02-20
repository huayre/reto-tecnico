<?php

namespace App\Services;

use App\Models\Event;
use App\Models\Participant;
use App\Validations\EventValidation;
use Illuminate\Support\Facades\Log;

class EventService
{
    protected EventValidation $eventValidation;

    public function __construct(EventValidation $eventValidation)
    {
        $this->eventValidation = $eventValidation;
    }

    public function listEvents()
    {
        $listEvents = Event::paginate(10);
        return $listEvents;
    }

    public function createEvent($data)
    {
        $response = ['message' => null, 'status' => 200];
        $validation = $this->eventValidation->validate($data, null);
        if ($validation['status'] === true) {
            return ['message' => $validation['errors'], 'status' => 400];
        }
        try {
            $event = Event::create($data);
            $response['message'] = $event;

        } catch (\Exception $e) {
            Log::error('error al crear el empleado: ' . $e->getMessage());
            $response = ['message' => $e->getMessage(), 'status' => 500];
        }
        return $response;
    }
    public function inscriptionEvent($data)
    {
        $response = ['message' => null, 'status' => 200];
        $validation = $this->eventValidation->validateInscription($data);
        if ($validation['status'] === true) {
            return ['message' => $validation['errors'], 'status' => 400];
        }
        try {
            $participant = Participant::find((integer)$data['id_participant']);
            if(!$participant) {
                return ['message' => 'participant not found', 'status' => 400];
            }
            $event = Event::find((integer)$data['id_event']);
            if(!$event) {
                return ['message' => 'event not found', 'status' => 400];
            }
            $event = Event::find($event->id);
            foreach ($event->participants as $value) {
                if ((integer)$value->id == (integer)$participant->id) {
                    return ['message' => 'the participant is already registered for the event', 'status' => 400];
                }
            }
            $event->participants()->attach($participant->id);
            $response['message'] = true;

        } catch (\Exception $e) {
            Log::error('error al crear el empleado: ' . $e->getMessage());
            $response = ['message' => $e->getMessage(), 'status' => 500];
        }
        return $response;

    }
    public function listInscriptions()
    {
        $response = [];
        $listEvents = Event::all();
        foreach ($listEvents as $event) {
            $item = [
                'event' => $event->theme,
                'participants' => $event->participants
            ];
            array_push($response,$item);
        }
        return $response;
    }
}
