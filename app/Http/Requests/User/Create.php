<?php
namespace App\Http\Requests\User;

use App\Http\Requests\Request;

class Create extends Request
{
    /**
     * Returns the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email'            => 'required|email|unique:users',
            'password'         => 'required',
            'password_confirm' => 'required_with:password|same:password',
        ];
    }
}
