<div class="form-group">
    <label for="{{$model.'_'.$field['name']}}">{{__($field['label'])}}</label>

    <div class="form-check">
        <label for="{{$model.'_'.$field['name']}}" class="form-check-input"></label>
        <input name="{{$model}}[{{$field['name']}}]" type="hidden" value="0">
        <input id="{{$model.'_'.$field['name']}}" name="{{$model}}[{{$field['name']}}]" type="checkbox" value="1"
               class="form-check-input {{$field['class']}} {{$errors->get($model.'.'.$field['name']) ? 'is-invalid' : ''}}" placeholder="{{__($field['label'])}}"
                {{(old($model.'.'.$field['name']) ?? $field['value']) ? 'checked="checked"' : ''}}
        @foreach($field['rules'] as $ruleName=>$ruleValue) {{$ruleName}}="{{$ruleValue}}" @endforeach>
    </div>

    @if($errors->has($model.'.'.$field['name']))
        <div class="invalid-feedback">
            {{$errors->first($model.'.'.$field['name'])}}
        </div>
    @endif
</div>
