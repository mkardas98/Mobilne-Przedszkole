<?php


namespace App\Forms;


use App\Helpers\Form;
use App\Models\Group;
use App\Models\User;


class GroupForm extends Form
{

    const FIELDS = [

        'name' => [
            'name' => 'name',
            'type' => 'text',
            'label' => 'Nazwa grupy',
            'rules' => ['required', 'max:30', 'min:3'],
            'options' => [],
        ],
        'room' => [
            'name' => 'room',
            'type' => 'text',
            'label' => 'Sala grupy',
            'rules' => ['required', 'max:30'],
            'options' => [],
        ],
        'teachers' => [
            'name' => 'teachers',
            'type' => 'multi_checkbox',
            'label' => 'Opiekunowie grupy',
            'rules' => ['required'],
            'options' => [],
        ],

    ];



    public function __construct($model = null)
    {
        foreach (self::FIELDS as $name => $field) {
            $this->modelFields[$name] = $field;
        }
        $teachers = User::where(function ($query) {
            $query->where('role', '=', '0')
                ->orWhere('role', '=', 1);
        })
            ->orderBy('last_name')
            ->get();


        foreach ($teachers as $teacher){
            $this->modelFields['teachers']['options'][$teacher->id] = $teacher->first_name . ' ' . $teacher->last_name;
        }

        parent::__construct($model, Group::class);
    }
}
