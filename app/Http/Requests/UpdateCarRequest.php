<?php

namespace App\Http\Requests;

class UpdateCarRequest extends StoreCarRequest {
    public function rules(): array {
        $rules = parent::rules();
        $rules['make'][0] = 'sometimes';
        $rules['model'][0] = 'sometimes';
        $rules['year'][0] = 'sometimes';
        $rules['price'][0] = 'sometimes';
        return $rules;
    }
}
