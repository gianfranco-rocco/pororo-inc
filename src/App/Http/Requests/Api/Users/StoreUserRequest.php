<?php

declare(strict_types=1);

namespace App\Http\Requests\Api\Users;

use Carbon\Carbon;
use Domain\Users\Enums\Role;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreUserRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'phone_number' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'unique:users'],
            'role' => ['required', Rule::enum(Role::class)],
            'patient_data' => ['required_if:role,' . Role::PATIENT->value, 'array'],
            'patient_data.conditions' => ['string'],
            'patient_data.weight' => ['string'],
            'patient_data.height' => ['string'],
            'patient_data.birth_date' => ['date_format:Y-m-d', 'before:' . Carbon::today()->format('Y-m-d')],
        ];
    }
}
