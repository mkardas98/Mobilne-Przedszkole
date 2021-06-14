<?php


namespace App\Forms;


use App\Helpers\Form;
use App\Models\Kid;
use App\Models\User;


class UserForm extends Form
{

    const FIELDS = [
        'first_name' => [
            'name' => 'first_name',
            'type' => 'text',
            'label' => 'Imię',
            'rules' => ['required', 'max:16'],
            'options' => [],
        ],
        'last_name' => [
            'name' => 'last_name',
            'type' => 'text',
            'label' => 'Nazwisko',
            'rules' => ['required', 'max:16'],
            'options' => [],
        ],
        'email' => [
            'name' => 'email',
            'type' => 'email',
            'label' => 'Email',
            'rules' => ['required'],
            'options' => [],
        ],
        'phone' => [
            'name' => 'phone',
            'type' => 'text',
            'label' => 'Numer telefonu',
            'rules' => ['required', 'digits_between:9,16', 'numeric'],
            'options' => [],
        ],
        'pesel' => [
            'name' => 'pesel',
            'type' => 'text',
            'label' => 'Pesel',
            'rules' => ['digits:11', 'numeric'],
            'options' => [],
        ],
        'date_of_birth' => [
            'name' => 'date_of_birth',
            'type' => 'date',
            'label' => 'Data urodzenia',
            'rules' => ['required'],
            'options' => [],
        ],
        'address' => [
            'name' => 'address',
            'type' => 'text',
            'label' => 'Adres',
            'rules' => ['required','min:6'],
            'options' => [],
        ],

        'avatar' => [
            'name' => 'avatar',
            'type' => 'file',
            'label' => 'Zmień zdjęcie profilowe',
            'rules' => ['file','image', 'mimes:jpg,jpeg,png,gif,webp', 'max:2048'],
            'options' => [],
        ],

        'role' => [
            'name' => 'role',
            'type' => 'select',
            'label' => 'Typ konta',
            'rules' => ['required'],
            'options' => [
                '0' => 'Dyrektor',
                '1' => 'Nauczyciel',
                '2' => 'Rodzic',
            ],
        ],

        'specialization' => [
            'name' => 'specialization',
            'type' => 'text',
            'label' => 'Specjalizacja',
            'rules' => [],
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
