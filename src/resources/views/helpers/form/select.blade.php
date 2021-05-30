<div class="input-wrapper">
    <label class="custom-label" for="{{$field['name']}}">{{$field['label']}}</label>

    <select id="{{$field['name']}}" name="{{$field['name']}}" class="custom-input" @foreach($field['rules'] as $ruleName=>$ruleValue) {{$ruleName}}="{{$ruleValue}}" @endforeach>
        <option value="" selected>Wybierz</option>
        @foreach($field['options'] as $optionName=>$optionValue)
            <option value="{{$optionName}}" {{$field['value'] == $optionName ? 'selected=selected' : ''}}>{{$optionValue}}</option>
        @endforeach
    </select>

     {!! $errors->first('role', '<p class="help-block">:message</p>') !!}

</div>
