<?php

declare(strict_types=1);

namespace App\Http\Requests\Api\Conversations;

use Illuminate\Foundation\Http\FormRequest;

class CreateMessageFormRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'content' => ['required']
        ];
    }
}
