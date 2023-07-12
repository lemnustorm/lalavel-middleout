<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateArticleRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'title' => 'required|max:200',
            'body' => 'required|max:1000',
            'published_at' => 'nullable|date_format:Y-m-d H:i:s',
            'user_id' => 'required|exists:users,id'
        ];
    }
}
