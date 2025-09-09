<?php

namespace App\Http\Requests;

class UpdateDealershipRequest extends StoreDealershipRequest {
    public function rules(): array {
        $rules = parent::rules();
        
        foreach (['name', 'city', 'phoneNumber'] as $field) {
            $rules[$field][0] = 'sometimes';
        }

        $id = $this->route('dealership')->id ?? null;
        $rules['name'] = ['sometimes', 'string', 'max:150', 'unique:dealerships,name,' . $id];

        return $rules;
    }
}
