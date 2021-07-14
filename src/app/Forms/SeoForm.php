<?php


namespace App\Forms;


use App\Helpers\Form;
use App\Models\Group;
use App\Models\Kid;
use App\Models\Seo;
use App\Models\User;


class SeoForm extends Form
{

    const FIELDS = [
        'seo_url' => [
            'name' => 'seo_url',
            'type' => 'text',
            'label' => 'URL',
            'rules' => ['max:200', 'required'],
        ],
        'seo_title' => [
            'name' => 'seo_title',
            'type' => 'text',
            'label' => 'SEO - tytuł',
            'rules' => ['max:200', 'required'],
        ],
        'seo_description' => [
            'name' => 'seo_description',
            'type' => 'textarea',
            'label' => 'SEO - opis',
            'rules' => [],
            'options' => [],
            'attrs' => [
                'rows' => 5
            ]
        ],
        'seo_tags' => [
            'name' => 'seo_tags',
            'type' => 'text',
            'label' => 'SEO - tagi',
            'rules' => [],
            'options' => [],
        ],

    ];



    public function __construct($model = null)
    {
        foreach (self::FIELDS as $name => $field) {
            $this->modelFields[$name] = $field;
        }

        parent::__construct($model, Seo::class);
    }
}
