<?php

namespace App\Http\Requests\Admin;

use App\Entity\User;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email' => 'required|string|email|max:255|unique:users,id,' . $this->user->id,
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'role' => ['required', 'string', Rule::in(array_keys(User::rolesList()))]
        ];
    }
}
