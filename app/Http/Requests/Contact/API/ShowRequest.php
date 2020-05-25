<?php

namespace App\Http\Requests\Contact\API;

use App\Http\Requests\Contact;

class ShowRequest extends Contact\ShowRequest
{
    protected function failedAuthorization()
    {
        //throw new HttpResponseException(response()->json('asd', 422));
    }
}
