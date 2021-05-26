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
@endphp

<div class="input-wrapper">
    {!! $errors->first($name, '<p class="help-block">:message</p>') !!}
    <label for="{{$name}}" class="custom-label ">{!! $label !!}</label>
    <input type="{{$type}}" id="{{$name}}" name="{{$name}}" class="custom-input {{$errors->first($name) ? ' form-error' : '' }}" value="{{old($name, $default)}}">
</div>
