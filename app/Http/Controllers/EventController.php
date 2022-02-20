<?php

namespace App\Http\Controllers;

use App\Services\EventService;
use Illuminate\Http\Request;

class EventController
{
    protected EventService $eventService;
    function __construct(EventService $eventService)
    {
        $this->eventService = $eventService;
    }

    public function index()
    {
        $response = $this->eventService->listEvents();
        return response()->json($response);
    }
    public function store(Request $request)
    {
        $response = $this->eventService->createEvent($request->all());
        return response()->json(['message' => $response['message']],$response['status']);
    }
    public function inscription(Request $request)
    {
        $response = $this->eventService->inscriptionEvent($request->all());
        return response()->json(['message' => $response['message']],$response['status']);
    }
    public function listInscription()
    {
        $response = $this->eventService->listInscriptions();
        return response()->json($response);
    }
}
