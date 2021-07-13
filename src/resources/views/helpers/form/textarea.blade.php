<div class="form-group">
    <label class="custom-label" for="{{$field['name']}}">{{__($field['label'])}}</label>
    <textarea id="{{$field['name']}}"
              name="{{$field['name']}}"
              class="form-control {{$field['class']}} {{$errors->get($field['name']) ? 'is-invalid' : ''}}"
              placeholder="{{__($field['label'])}}"
    @foreach($field['options'] as $option=>$value) {{$option}}="{{$value}}" @endforeach
            @foreach($field['attrs'] as $attr=>$value){{$attr}}="{{$value == 1 ? $attr : $value}}"@endforeach
    >{{old($field['name']) ?? $field['value']}}</textarea>

    @if($errors->has($field['name']))
        <div class="invalid-feedback">
            {{$errors->first($field['name'])}}
        </div>
    @endif
</div>

@push('scripts.body.bottom')

    <script>
        const ckeditor = [...document.querySelectorAll('.ckeditor')]
        console.log(ckeditor)

        ckeditor.map( function (ck){
            ClassicEditor
                .create(ck)
                .catch( error => {
                    console.error( error );
                } );
        })
    </script>

@endpush
