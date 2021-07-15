@php
if((!(isset($label))) || $label == null){
    $label = '';
}
if((!(isset($name))) || $name == null){
    $name = '';
}
if((!(isset($default))) || $default == null){
    $default = '';
}
if(!isset($type)){
    $type = 'text';
}
if(!isset($old)){
    $old = true;
}
if(!isset($class)){
    $class = '';
}
@endphp

<div class="input-wrapper">
    <label for="{{$name}}" class="custom-label ">{!! $label !!}</label>
    <input type="{{$type}}" id="{{$name}}" name="{{$name}}" class="custom-input {{$class}} {{$errors->first($name) ? ' form-error' : ''}}" value="{{$old ? old($name, $default) : $default}}">
    {!! $errors->first($name, '<p class="help-block">:message</p>') !!}

</div>
