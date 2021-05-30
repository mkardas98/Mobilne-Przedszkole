<?php


namespace App\Helpers;


use Illuminate\Database\Eloquent\Model;

class Form {
    protected $modelFields = [];
    protected $model = null;
    public $fields = [];

    public function __construct($model, $modelClass) {
        if($model instanceof Model)
            $this->model = $model;
        elseif (is_numeric($model) || $model == null)
            $this->model = $modelClass::with([])->findOrNew($model);
        else {
            $message = 'Model should be instance of Eloquent BaseModel or numeric (id)';
//            throw new \Exception($message);
        }


        foreach ($this->modelFields as $field) {
            $rules = $this->laravelToHtmlRules($field['rules']);

            $value = $this->model->getAttribute($field['name']);
            if($value == null) {
                if($field['type'] == 'number')
                    $value = 0;
                elseif($field['type'] == 'multiselect')
                    $value = [];
                else
                    $value = '';
            }

            $this->fields[$field['name']] = [
//                'name' => $this->model->getTable().'_'.$field['name'],
                'name' => $field['name'],
                'type' => $field['type'],
                'label' => $field['label'] ?? $field['name'],
                'rules' => $rules,
                'value' => $value,
                'class' => $field['class'] ?? '',
                'options' => $field['options'] ?? [],
                'attrs' => $field['attrs'] ?? []
            ];
        }
    }

    private function laravelToHtmlRules(array $laravelRules): array {
        $htmlRules = [];
        foreach ($laravelRules as $r) {
            if(strpos($r, ':') != false) {
                [$name, $value] = explode(':', $r);
                if($name == 'min')
                    $htmlRules['minlength'] = $value;
                if($name == 'max')
                    $htmlRules['maxlength'] = $value;
            }
            else {
                $name = $r;
                if($name == 'required')
                    $htmlRules['required'] = 'required';
            }
        }
        return $htmlRules;
    }

    public function getFields(): array {
        return $this->fields;
    }

    public function renderFieldGroup($name) {
        return $this->render($name, 'fieldGroup');
    }

    public function renderField($name) {
        return $this->render($name, 'field');
    }

    private function render($name, $option = '') {
        if(empty($name))
            return null;

        $field = $this->fields[$name] ?? null;
        if(empty($field))
            return null;

        return view('helpers.form.'.$field['type'], [
            'model' => $this->model->getTable(),
            'field' => $field,
        ]);
    }
}
