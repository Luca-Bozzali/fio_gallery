<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'message' => ['required', 'string', 'min:10', 'max:5000'],
            'website' => ['sometimes', 'nullable', 'string', 'max:255'],
        ];
    }

    public function attributes(): array
    {
        return [
            'name' => 'nome',
            'email' => 'email',
            'message' => 'messaggio',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Il campo nome è obbligatorio.',
            'name.string' => 'Il nome deve essere una stringa valida.',
            'name.max' => 'Il nome non può superare 255 caratteri.',
            'email.required' => 'Il campo email è obbligatorio.',
            'email.email' => 'Inserisci un indirizzo email valido.',
            'email.max' => 'L\'email non può superare 255 caratteri.',
            'message.required' => 'Il campo messaggio è obbligatorio.',
            'message.string' => 'Il messaggio deve essere una stringa valida.',
            'message.min' => 'Il messaggio deve contenere almeno 10 caratteri.',
            'message.max' => 'Il messaggio non può superare 5000 caratteri.',
        ];
    }
}
