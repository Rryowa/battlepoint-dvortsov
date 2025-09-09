<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreDealershipRequest extends FormRequest {
    public function authorize(): bool {
        return true;
    }

    public function rules(): array {
        return [
            'name'          => ['required', 'string', 'max:150', 'unique:dealerships,name'],
            'city'          => ['required', 'string', 'max:120'],
            'phoneNumber'   => ['required', 'string', 'max:30'],
        ];
    }
}
