<?php


namespace App\Forms;


use App\Helpers\Form;
use App\Models\User;


class EditPasswordForm extends Form
{

    const FIELDS = [
        'password' => [
            'name' => 'password',
            'type' => 'password',
            'label' => 'Aktualne hasło',
            'rules' => ['required'],
            'options' => [],
        ],
        'new_password' => [
            'name' => 'new_password',
            'type' => 'password',
            'label' => 'Nowe hasło',
            'rules' => ['required', 'min:6', 'max:30', 'regex:/[a-z]/', 'regex:/[A-Z]/', 'regex:/[0-9]/', 'regex:/[0-9]/'],
            'options' => [],
        ],
        'new_confirm_password' => [
            'name' => 'new_confirm_password',
            'type' => 'password',
            'label' => 'Powtórz nowe hasło',
            'rules' => ['same:new_password'],
            'options' => [],
        ],
    ];



    public function __construct($model = null)
    {
        foreach (self::FIELDS as $name => $field) {
            $this->modelFields[$name] = $field;
        }
        parent::__construct($model, User::class);
    }
}
