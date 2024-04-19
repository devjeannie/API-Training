<?php

namespace App\Http\Requests;

use App\Http\Requests\BaseRequest;

class LoginRequest extends BaseRequest
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
            'username' => ['required', 'exists:users,username'],
            'password' => ['required','min:8'],
        ];
    }

    public function data(): array
    {
        $data = $this->only('username');

        if (! is_null($this->input('password'))) {
            $data['password'] = bcrypt($this->password);
        }

        return $data;
    }
}
