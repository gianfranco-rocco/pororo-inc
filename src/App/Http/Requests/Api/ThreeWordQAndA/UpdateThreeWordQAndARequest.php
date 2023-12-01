<?php

declare(strict_types=1);

namespace App\Http\Requests\Api\ThreeWordQAndA;

use Illuminate\Foundation\Http\FormRequest;

class UpdateThreeWordQAndARequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'a_word_1' => ['required', 'max:255'],
            'a_word_2' => ['required', 'max:255'],
            'a_word_3' => ['required', 'max:255']
        ];
    }
}
