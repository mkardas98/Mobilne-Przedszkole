<?php


namespace App\Forms;


use App\Helpers\Form;
use App\Models\Announcement;
use App\Models\Group;
use App\Models\User;


class AllergenForm extends Form
{

    const FIELDS = [

        'allergen' => [
            'name' => 'allergen',
            'type' => 'text',
            'label' => 'Alergen',
            'rules' => ['required'],
            'options' => [],
        ],




    ];



    public function __construct($model = null)
    {
        foreach (self::FIELDS as $name => $field) {
            $this->modelFields[$name] = $field;
        }


        parent::__construct($model, Announcement::class);
    }
}
