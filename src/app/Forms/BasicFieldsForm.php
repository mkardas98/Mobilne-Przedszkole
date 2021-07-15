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
        'type_kindergarten' => [
            'name' => 'type_kindergarten',
            'type' => 'text',
            'label' => 'Typ i rodzaj przedszkola',
            'rules' => [],
            'options' => [],
        ],
        'phone_kindergarten' => [
            'name' => 'phone_kindergarten',
            'type' => 'text',
            'label' => 'Numer telefonu przedszkola',
            'rules' => [],
            'options' => [],
        ],
        'email_kindergarten' => [
            'name' => 'email_kindergarten',
            'type' => 'text',
            'label' => 'E-mail przedszkola',
            'rules' => [],
            'options' => [],
        ],
        'address_kindergarten' => [
            'name' => 'address_kindergarten',
            'type' => 'text',
            'label' => 'Adres',
            'rules' => [],
            'options' => [],
        ],
        'nip_kindergarten' => [
            'name' => 'nip_kindergarten',
            'type' => 'text',
            'label' => 'NIP',
            'rules' => [],
            'options' => [],
        ],
        'regon_kindergarten' => [
            'name' => 'regon_kindergarten',
            'type' => 'text',
            'label' => 'REGON',
            'rules' => [],
            'options' => [],
        ],
        'city_kindergarten' => [
            'name' => 'city_kindergarten',
            'type' => 'text',
            'label' => 'Miasto',
            'rules' => [],
            'options' => [],
        ],
        'post_code_kindergarten' => [
            'name' => 'post_code_kindergarten',
            'type' => 'text',
            'label' => 'Kod pocztowy',
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
