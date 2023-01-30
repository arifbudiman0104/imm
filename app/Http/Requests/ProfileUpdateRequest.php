<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['string', 'max:255'],
            'username' => ['string', 'max:255', Rule::unique(User::class)->ignore($this->user()->id)],
            'email' => ['email', 'max:255', Rule::unique(User::class)->ignore($this->user()->id)],
            'hide_email' => ['boolean'],
            'dob' => ['required'],
            'pob' => ['max:20', 'required'],
            'gender' => ['max:6', 'required'],
            'phone' => ['max:20', 'required'],
            'address' => ['max:255', 'required'],
            'bio' => ['string', 'max:255', 'nullable'],
            'instagram' => ['string', 'max:255', 'nullable', 'url'],
            'facebook' => ['string', 'max:255', 'nullable', 'url'],
            'twitter' => ['string', 'max:255', 'nullable', 'url'],
            'youtube' => ['string', 'max:255', 'nullable', 'url'],
        ];
    }
}
