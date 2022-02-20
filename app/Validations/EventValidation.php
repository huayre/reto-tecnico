<?php

namespace App\Validations;

use Illuminate\Support\Facades\Validator;

class EventValidation
{
    function validate($data, $id)
    {
        $response = ['errors' => null, 'status' => false];
        $validator = Validator::make($data, [
            'theme' => 'required|string',
            'start_date' => 'required|date|date_format:Y-m-d',
            'hour' => 'required|date_format:H:i:s',
            'price' => 'required|integer',
            'place' => 'required|string',
            'speaker' => 'required|string',
        ]);
        if ($validator->fails()) {
            $response = ['errors' => ['errors' => $validator->errors()], 'status' => true];
        }
        return $response;
    }
    function validateInscription($data)
    {
        $response = ['errors' => null, 'status' => false];
        $validator = Validator::make($data, [
            'id_event' => 'required|integer',
            'id_participant' => 'required|integer'
        ]);
        if ($validator->fails()) {
            $response = ['errors' => ['errors' => $validator->errors()], 'status' => true];
        }
        return $response;

    }

}
