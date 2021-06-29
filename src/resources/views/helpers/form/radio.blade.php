<div class="form-group">
    <label class="custom-label">{{$field['label']}}</label>
    @foreach($field['options'] as $key=>$item)
       <div class="radio-item">
           <input type="radio" id="{{$field['name'].$key}}" name="{{$field['name']}}" value="{{$key}}"
               {{$field['value'] == $key ? 'checked' : ''}}>
           <label class="custom-label" for="{{$field['name'].$key}}">{!! $item !!}</label>
       </div>
    @endforeach
    {!! $errors->first('role', '<p class="help-block">:message</p>') !!}
</div>

{{--<div class="form-group">--}}
{{--    <label for="{{$model.'_'.$field['name']}}">{{__($field['label'])}}</label>--}}

{{--    <div class="form-check">--}}
{{--        <label for="{{$model.'_'.$field['name']}}" class="form-check-input"></label>--}}
{{--        <input name="{{$model}}[{{$field['name']}}]" type="hidden" value="0">--}}
{{--        <input id="{{$model.'_'.$field['name']}}" name="{{$model}}[{{$field['name']}}]" type="checkbox" value="1"--}}
{{--               class="form-check-input {{$field['class']}} {{$errors->get($model.'.'.$field['name']) ? 'is-invalid' : ''}}" placeholder="{{__($field['label'])}}"--}}
{{--        {{(old($model.'.'.$field['name']) ?? $field['value']) ? 'checked="checked"' : ''}}--}}
{{--        @foreach($field['rules'] as $ruleName=>$ruleValue) {{$ruleName}}="{{$ruleValue}}" @endforeach>--}}
{{--    </div>--}}

{{--    @if($errors->has($model.'.'.$field['name']))--}}
{{--        <div class="invalid-feedback">--}}
{{--            {{$errors->first($model.'.'.$field['name'])}}--}}
{{--        </div>--}}
{{--    @endif--}}
{{--</div>--}}
