<?php

namespace App\Validations;

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class participantValidation
{
    function validate($data, $id)
    {
        $response = ['errors' => null, 'status' => false];
        $validator = Validator::make($data, [
            'name' => 'required|string',
            'last_name' => 'required|string',
            'occupation' => 'required|string',
            'deleted_at' =>'exists:participants,deleted_at,NULL',
            'mail' => ['required','email',Rule::unique('participants')->ignore($id)->whereNull('deleted_at')],
            'age' => 'required|integer',
            'sex' => 'required|string',
        ]);
        if ($validator->fails()) {
            $response = ['errors' => ['errors' => $validator->errors()], 'status' => true];
        }
        return $response;
    }
}
