<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SearchArticleRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'search' => 'min:3|max:255'
        ];
    }
}
