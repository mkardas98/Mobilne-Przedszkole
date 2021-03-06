<div class="input-wrapper">
    <label for="{{$field['name']}}" class="custom-label">{{$field['label']}}</label>
    <input id="{{$field['name']}}" name="{{$field['name']}}" type="text" value="{{old($field['name']) ?? $field['value']}}"
           class="custom-input {{$field['class']}} {{$errors->first($field['name']) ? ' form-error' : ''}}" placeholder="{{$field['label']}}"
            @foreach($field['attrs'] as $attr=>$value){{$attr}}="{{$value == 1 ? $attr : $value}}"@endforeach
    >

    {!! $errors->first($field['name'], '<p class="help-block">:message</p>') !!}

</div>
