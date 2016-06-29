<?php

namespace App\Http\Requests\User;

use App\Http\Requests\Request;

class Update extends Request
{
    /**
     * Returns the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $id = $this->route()->getParameter('id');

        return [
            'email'            => 'required|email|unique:users,email,'.$id,
            'password_confirm' => 'required_with:password|same:password',
        ];
    }
}
