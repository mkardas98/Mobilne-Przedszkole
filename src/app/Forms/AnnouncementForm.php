<?php


namespace App\Forms;


use App\Helpers\Form;
use App\Models\Announcement;
use App\Models\Group;
use App\Models\User;


class AnnouncementForm extends Form
{

    const FIELDS = [

        'name' => [
            'name' => 'title',
            'type' => 'text',
            'label' => 'Tytuł ogłoszenia',
            'rules' => ['required', 'min:3'],
            'options' => [],
        ],
        'text' => [
            'name' => 'text',
            'type' => 'textarea',
            'label' => 'Treść ogłoszenia',
            'class'=> 'ckeditor',
            'rules' => ['required', 'min:5'],
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


        parent::__construct($model, Announcement::class);
    }
}
