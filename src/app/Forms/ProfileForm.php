<?php


namespace App\Forms;


use App\Helpers\Form;
use App\Models\User;


class ProfileForm extends Form
{

    const FIELDS = [
        'first_name' => [
            'name' => 'first_name',
            'type' => 'text',
            'label' => 'Imię',
            'rules' => ['required', 'max:16'],
            'options' => [],
        ],
        'last_name' => [
            'name' => 'last_name',
            'type' => 'text',
            'label' => 'Nazwisko',
            'rules' => ['required', 'max:16'],
            'options' => [],
        ],
        'date_of_birth' => [
            'name' => 'date_of_birth',
            'type' => 'date',
            'label' => 'Data urodzenia',
            'rules' => ['required'],
            'options' => [],
        ],
        'address' => [
            'name' => 'address',
            'type' => 'text',
            'label' => 'Adres',
            'rules' => ['required','min:6'],
            'options' => [],
        ],
        'phone' => [
            'name' => 'phone',
            'type' => 'text',
            'label' => 'Numer telefonu',
            'rules' => ['required', 'digits_between:9,16', 'numeric'],
            'options' => [],
        ],
        'pesel' => [
            'name' => 'pesel',
            'type' => 'text',
            'label' => 'Pesel',
            'rules' => ['digits:11', 'numeric'],
            'options' => [],
        ],
        'email' => [
            'name' => 'email',
            'type' => 'email',
            'label' => 'Email',
            'rules' => ['required'],
            'options' => [],
        ],


    ];



    public function __construct($model = null)
    {
        foreach (self::FIELDS as $name => $field) {
            $this->modelFields[$name] = $field;
        }

//        $categories = OfferCategory::with([])->adminLocale()->get();
//        foreach ($categories as $category) {
//            $this->modelFields['offer_category_id']['options'][$category->id] = $category->title;
//        }

        parent::__construct($model, User::class);
    }
}
