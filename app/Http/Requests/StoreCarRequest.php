<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCarRequest extends FormRequest {
    public function authorize(): bool {
        return true;
    }

    public function rules(): array {
        return [
            'make'  => ['required', 'string', 'max:100'],
            'model' => ['required', 'string', 'max:100'],
            'year'  => ['required', 'integer', 'min:1886', 'max:' . date('Y')],
            'price' => ['required', 'numeric', 'min:0'],
            'status'        => ['in:in_stock,sold'],
            'dealership_id' => ['nullable', 'exists:dealerships,id'],
        ];
    }
}
