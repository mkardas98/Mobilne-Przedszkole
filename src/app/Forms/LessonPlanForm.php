<?php


namespace App\Forms;


use App\Helpers\Form;
use App\Models\Group;
use App\Models\Kid;
use App\Models\User;


class LessonPlanForm extends Form
{

    const FIELDS = [
        'date' => [
            'name' => 'date',
            'type' => 'date',
            'label' => 'Data',
            'rules' => ['required'],
            'options' => [],
        ],
        'plan[1][time]' => [
            'name' => 'plan[1][time]',
            'type' => 'text',
            'label' => 'Godzina (od - do)',
            'rules' => [],
            'options' => [],
        ],
        'plan[1][name]' => [
            'name' => 'plan[1][name]',
            'type' => 'text',
            'label' => 'Nazwa zajęć',
            'rules' => [],
            'options' => [],
        ],
        'plan[1][teacher]' => [
            'name' => 'plan[1][teacher]',
            'type' => 'select',
            'label' => 'Prowadzący',
            'rules' => [],
            'options' => [],
        ],
        'plan[2][time]' => [
            'name' => 'plan[2][time]',
            'type' => 'text',
            'label' => 'Godzina (od - do)',
            'rules' => [],
            'options' => [],
        ],
        'plan[2][name]' => [
            'name' => 'plan[2][name]',
            'type' => 'text',
            'label' => 'Nazwa zajęć',
            'rules' => [],
            'options' => [],
        ],
        'plan[2][teacher]' => [
            'name' => 'plan[2][teacher]',
            'type' => 'select',
            'label' => 'Prowadzący',
            'rules' => [],
            'options' => [],
        ],
        'plan[3][time]' => [
            'name' => 'plan[3][time]',
            'type' => 'text',
            'label' => 'Godzina (od - do)',
            'rules' => [],
            'options' => [],
        ],
        'plan[3][name]' => [
            'name' => 'plan[3][name]',
            'type' => 'text',
            'label' => 'Nazwa zajęć',
            'rules' => [],
            'options' => [],
        ],
        'plan[3][teacher]' => [
            'name' => 'plan[3][teacher]',
            'type' => 'select',
            'label' => 'Prowadzący',
            'rules' => [],
            'options' => [],
        ],
        'plan[4][time]' => [
            'name' => 'plan[4][time]',
            'type' => 'text',
            'label' => 'Godzina (od - do)',
            'rules' => [],
            'options' => [],
        ],
        'plan[4][name]' => [
            'name' => 'plan[4][name]',
            'type' => 'text',
            'label' => 'Nazwa zajęć',
            'rules' => [],
            'options' => [],
        ],
        'plan[4][teacher]' => [
            'name' => 'plan[4][teacher]',
            'type' => 'select',
            'label' => 'Prowadzący',
            'rules' => [],
            'options' => [],
        ],
        'plan[5][time]' => [
            'name' => 'plan[5][time]',
            'type' => 'text',
            'label' => 'Godzina (od - do)',
            'rules' => [],
            'options' => [],
        ],
        'plan[5][name]' => [
            'name' => 'plan[5][name]',
            'type' => 'text',
            'label' => 'Nazwa zajęć',
            'rules' => [],
            'options' => [],
        ],
        'plan[5][teacher]' => [
            'name' => 'plan[5][teacher]',
            'type' => 'select',
            'label' => 'Prowadzący',
            'rules' => [],
            'options' => [],
        ],
        'plan[6][time]' => [
            'name' => 'plan[6][time]',
            'type' => 'text',
            'label' => 'Godzina (od - do)',
            'rules' => [],
            'options' => [],
        ],
        'plan[6][name]' => [
            'name' => 'plan[6][name]',
            'type' => 'text',
            'label' => 'Nazwa zajęć',
            'rules' => [],
            'options' => [],
        ],
        'plan[6][teacher]' => [
            'name' => 'plan[6][teacher]',
            'type' => 'select',
            'label' => 'Prowadzący',
            'rules' => [],
            'options' => [],
        ],
        'plan[7][time]' => [
            'name' => 'plan[7][time]',
            'type' => 'text',
            'label' => 'Godzina (od - do)',
            'rules' => [],
            'options' => [],
        ],
        'plan[7][name]' => [
            'name' => 'plan[7][name]',
            'type' => 'text',
            'label' => 'Nazwa zajęć',
            'rules' => [],
            'options' => [],
        ],
        'plan[7][teacher]' => [
            'name' => 'plan[7][teacher]',
            'type' => 'select',
            'label' => 'Prowadzący',
            'rules' => [],
            'options' => [],
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
