<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateArticleRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'title' => 'max:200',
            'body' => 'max:1000',
            'published_at' => 'nullable|date_format:Y-m-d H:i:s',
            'user_id' => 'exists:users,id'
        ];
    }
}
