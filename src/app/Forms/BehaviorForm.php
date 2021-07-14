<?php


namespace App\Forms;


use App\Helpers\Form;
use App\Models\Announcement;
use App\Models\Behavior;
use App\Models\Group;
use App\Models\User;


class BehaviorForm extends Form
{

    const FIELDS = [

        'type' => [
            'name' => 'type',
            'type' => 'radio',
            'label' => 'Typ',
            'rules' => ['required'],
            'options' => [
                0 => 'Uwaga ',
                1 => 'Pochwała'
            ],
        ],
        'text' => [
            'name' => 'text',
            'type' => 'textarea',
            'label' => 'Komentarz',
            'class'=> '',
            'rules' => ['required'],
            'options' => [],
            'attrs' => [
                'rows' => 10
            ],
        ],



    ];



    public function __construct($model = null)
    {
        foreach (self::FIELDS as $name => $field) {
            $this->modelFields[$name] = $field;
        }


        parent::__construct($model, Behavior::class);
    }
}
