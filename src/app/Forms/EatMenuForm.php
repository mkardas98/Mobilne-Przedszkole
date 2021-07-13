<?php


namespace App\Forms;


use App\Helpers\Form;
use App\Models\Group;
use App\Models\Kid;
use App\Models\User;


class EatMenuForm extends Form
{

    const FIELDS = [
        'date' => [
            'name' => 'date',
            'type' => 'date',
            'label' => 'Data',
            'rules' => ['required'],
            'options' => [],
        ],
        'eats[breakfast]' => [
            'name' => 'eats[breakfast]',
            'type' => 'textarea',
            'label' => 'Śniadanie',
            'rules' => [],
            'options' => [
                'rows' => 10
            ],
        ],
        'eats[breakfast2]' => [
            'name' => 'eats[breakfast2]',
            'type' => 'textarea',
            'label' => 'Śniadanie II',
            'rules' => [],
            'options' => [
                'rows' => 10
            ],
        ],
        'eats[dinner]' => [
            'name' => 'eats[dinner]',
            'type' => 'textarea',
            'label' => 'Obiad',
            'rules' => [],
            'options' => [
                'rows' => 10
            ],
        ],
        'eats[tea]' => [
            'name' => 'eats[tea]',
            'type' => 'textarea',
            'label' => 'Podwieczorek',
            'rules' => [],
            'options' => [
                'rows' => 10
            ],
        ],


    ];



    public function __construct($model = null)
    {
        foreach (self::FIELDS as $name => $field) {
            $this->modelFields[$name] = $field;
        }

        parent::__construct($model, Kid::class);
    }
}
