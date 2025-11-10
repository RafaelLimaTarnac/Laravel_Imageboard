<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostCreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title'=>"required|max:60",
            'content'=>"required|max:3000",
            'file'=>'required|extensions:png,jpg,webm,mkv,mp3,mp4,gif,jpeg,png,pdf,epub,mobi,avif,prc'
        ];
    }
}
