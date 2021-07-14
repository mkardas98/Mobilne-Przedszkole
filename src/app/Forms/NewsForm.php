<?php


namespace App\Forms;


use App\Helpers\Form;
use App\Models\Group;
use App\Models\Kid;
use App\Models\User;


class NewsForm extends Form
{

    const FIELDS = [
        'title' => [
            'name' => 'title',
            'type' => 'text',
            'label' => 'Tytuł',
            'rules' => ['required', 'max:200'],
            'options' => [],
        ],
        'lead' => [
            'name' => 'lead',
            'type' => 'textarea',
            'label' => 'Wprowadzenie',
            'rules' => [],
            'options' => [],
            'attrs' => [
                'rows' => 5
            ]
        ],
        'text' => [
            'name' => 'text',
            'type' => 'textarea',
            'label' => 'Treść',
            'rules' => [],
            'class'=> 'ckeditor',
            'options' => [],
        ],

    ];



    public function __construct($model = null)
    {
        foreach (self::FIELDS as $name => $field) {
            $this->modelFields[$name] = $field;
        }

        parent::__construct($model, NewsForm::class);
    }
}
