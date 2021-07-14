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
        class MyUploadAdapter {
            constructor( loader ) {
                this.loader = loader;
            }
            upload() {
                return this.loader.file
                    .then( file => new Promise( ( resolve, reject ) => {
                        this._initRequest();
                        this._initListeners( resolve, reject, file );
                        this._sendRequest( file );
                    } ) );
            }

            // Aborts the upload process.
            abort() {
                if ( this.xhr ) {
                    this.xhr.abort();
                }
            }

            _initRequest() {
                const xhr = this.xhr = new XMLHttpRequest();
                xhr.open( 'POST', '{{route('ckeditor.upload')}}', true );
                xhr.setRequestHeader('x-csrf-token', '{{ csrf_token() }}')
                xhr.responseType = 'json';
            }
            _initListeners( resolve, reject, file ) {
                const xhr = this.xhr;
                const loader = this.loader;
                const genericErrorText = `Couldn't upload file: ${ file.name }.`;

                xhr.addEventListener( 'error', () => reject( genericErrorText ) );
                xhr.addEventListener( 'abort', () => reject() );
                xhr.addEventListener( 'load', () => {
                    const response = xhr.response;
                    if ( !response || response.error ) {
                        return reject( response && response.error ? response.error.message : genericErrorText );
                    }
                    resolve( {
                        default: response.url
                    } );
                } );
                if ( xhr.upload ) {
                    xhr.upload.addEventListener( 'progress', evt => {
                        if ( evt.lengthComputable ) {
                            loader.uploadTotal = evt.total;
                            loader.uploaded = evt.loaded;
                        }
                    } );
                }
            }
            _sendRequest( file ) {
                const data = new FormData();
                data.append( 'upload', file );
                this.xhr.send( data );
            }
        }
        function SimpleUploadAdapterPlugin( editor ) {
            editor.plugins.get( 'FileRepository' ).createUploadAdapter = ( loader ) => {
                // Configure the URL to the upload script in your back-end here!
                return new MyUploadAdapter( loader );
            };
        }

        const ckeditor = [...document.querySelectorAll('.ckeditor')]

            ckeditor.map( function (ck){
                ClassicEditor
                    .create(ck, {
                     extraPlugins: [SimpleUploadAdapterPlugin],
                    })
                    .catch( error => {
                        console.error( error );
                    } );
            })


    </script>

@endpush
