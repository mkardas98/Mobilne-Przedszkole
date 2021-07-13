<?php


namespace App\Forms;


use App\Helpers\Form;
use App\Models\BasicFields;


class BasicFieldsForm extends Form
{

    const FIELDS = [
        'name_kindergarten' => [
            'name' => 'name_kindergarten',
            'type' => 'text',
            'label' => 'Nazwa przedszkola',
            'rules' => [],
            'options' => [],
        ],



    ];



    public function __construct($model = null)
    {
        foreach (self::FIELDS as $name => $field) {
            $this->modelFields[$name] = $field;
        }

        parent::__construct($model, BasicFields::class);
    }
}
