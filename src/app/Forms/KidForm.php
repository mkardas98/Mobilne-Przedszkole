<?php


namespace App\Forms;


use App\Helpers\Form;
use App\Models\Group;
use App\Models\Kid;
use App\Models\User;


class KidForm extends Form
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

        'date_of_birth' => [
            'name' => 'date_of_birth',
            'type' => 'date',
            'label' => 'Data urodzenia',
            'rules' => ['required'],
            'options' => [],
        ],
        'pesel' => [
            'name' => 'pesel',
            'type' => 'text',
            'label' => 'Pesel',
            'rules' => ['digits:11', 'numeric'],
            'options' => [],
        ],
        'avatar' => [
            'name' => 'avatar',
            'type' => 'file',
            'label' => 'Zmień zdjęcie profilowe',
            'rules' => ['file','image', 'mimes:jpg,jpeg,png,gif,webp', 'max:2048'],
            'options' => [],
        ],
        'user_id' => [
            'name' => 'user_id',
            'type' => 'select',
            'label' => 'Opiekun',
            'rules' => ['required'],
            'options' => [],
        ],
        'group_id' => [
            'name' => 'group_id',
            'type' => 'select',
            'label' => 'Grupa',
            'rules' => ['required'],
            'options' => [],
        ],


    ];



    public function __construct($model = null)
    {
        foreach (self::FIELDS as $name => $field) {
            $this->modelFields[$name] = $field;
        }

        $parents = User::where('role', '=', '2')
            ->orderBy('last_name')
            ->get();

        foreach ($parents as $parent){
            $this->modelFields['user_id']['options'][$parent->id] = $parent->first_name . ' ' . $parent->last_name;
        }

        $groups = Group::where('status', '=', '1')
            ->orderBy('name')
            ->get();

        foreach ($groups as $group){
            $this->modelFields['group_id']['options'][$group->id] = $group->name;
        }

        parent::__construct($model, Kid::class);
    }
}
