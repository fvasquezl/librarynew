<?php

namespace App\Http\Requests\User;

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
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($this->user)],
            'password' => ['sometimes'],
            'departments'=>['required'],
            'roles' =>['required']
        ];
    }

    public function updateUser($user)
    {

        $user->fill([
            'name' => $this->name,
            'email' => $this->email,
        ]);

        if ($this->password != null)
        {
            $user->password = $this->password;
        }
        $user->save();
        
        //Update Roles
        $user->roles()->sync($this->roles);
        
        //Update Departments
        $user->departments()->sync($this->departments);

    }
}