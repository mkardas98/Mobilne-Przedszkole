<div class="checkbox-wrapper">
    <label class="custom-label">{{$field['label']}}</label>
    {!! $errors->first($field['name'].'[]', '<p class="help-block">:message</p>') !!}
    <div class="row mt-2">
        @foreach($field['options'] as $optionName=>$optionValue)
            <div class="col-md-6">
                <label class="checkbox-label">
                    <input type="checkbox" name="{{$field['name']}}[]"
                           class="custom-input"
                           @if($field['value'])
                           @foreach($field['value'] as $value){{ $value == $optionName ? 'checked="checked"' : ''}} @endforeach
                               @endif
                           value="{{$optionName}}">{{$optionValue}}
                </label>
            </div>
        @endforeach
    </div>
</div>


