<div class="pageNavigation">
    <span class="pageNavigation__title">Zdjęcia</span>
    <div class="pageNavigation__buttons">
        <button data-toggle="modal" data-target="#addImagesModal" class="primaryButton">Dodaj zdjęcia</button>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card">

            <div class="card__body">
                <table id="dataTable" class="ui celled table">
                    <thead>
                    <tr>
                        <th><i class="fas fa-hashtag"></i></th>
                        <th>Zdjęcie</th>
                        <th>Nazwa</th>
                        <th><i class="fas fa-cogs"></i> Zarządzanie</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($galleryItems as $key=>$galleryItem)
                        <tr>
                            <td>{{$key + 1}}</td>
                            <td>
                                <img
                                    src="{{renderImage($galleryItem->url ?? asset('images/app/profile/empty-avatar.jpg'), [80, 80, 'fit'])}}"
                                    alt="" class="avatar">
                            </td>
                            <td>{{$galleryItem->name}}</td>
                            <td class="tableButtons">
                                @php($delete = route('director.gallery.item.delete', $galleryItem->id))
                                <button class="controlButton -red" onclick="deleteItem('{{$delete}}')"><i
                                        class="fas fa-ban"></i></button>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


<div id="addImagesModal" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog"
     aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="pageNavigation">
                <span class="pageNavigation__title">Dodaj zdjęcia</span>
                <div class="pageNavigation__buttons">
                    <button type="button" class="primaryButton -red" data-dismiss="modal" aria-label="Close">Cofnij
                    </button>
                    <button type="submit"
                            onclick="event.preventDefault(); document.getElementById('galleryItems').submit();"
                            class="primaryButton">Zapisz
                    </button>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card__body">
                            <form id="galleryItems" action="{{route('director.gallery.item.upload', ['id_gallery'=>$obj->id])}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <label for="name" class="custom-label">Nazwa zdjęcia/zdjęć:</label>
                                <input id="name" type="text" name="name">
                                <div class="file-drop-area">
                                    <span class="fake-btn">Wybierz zdjęcia</span>
                                    <span class="file-msg">lub przęciągnij je tutaj!</span>
                                    <input id="uploadImg" class="file-input" name="images[]" onchange="loadFiles(event)" accept="image/*" type="file"
                                           multiple>
                                </div>
                                <div class="imagesPreview"></div>
                                {!! $errors->first('images[]', '<p class="help-block">:message</p>') !!}
                                {!! $errors->first('images', '<p class="help-block">:message</p>') !!}

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@push('scripts.body.bottom')
    <script>
        function updateInput(){
            const $fileInput = $('.file-input');
            const $droparea = $('.file-drop-area');

            $fileInput.on('dragenter focus click', function () {
                $droparea.addClass('is-active');
            });

            $fileInput.on('dragleave blur drop', function () {
                $droparea.removeClass('is-active');
            });

            $fileInput.on('change', function () {
                const filesCount = $(this)[0].files.length;
                const $textContainer = $(this).prev();

                if (filesCount === 1) {
                    const fileName = $(this).val().split('\\').pop();
                    $textContainer.text(fileName);
                } else {
                    $textContainer.text('Przesłano ' + filesCount + ' pliki');
                }
            });
        }
        function validate() {
            var uploadImg = document.getElementById('uploadImg');
            //uploadImg.files: FileList
            for (var i = 0; i < uploadImg.files.length; i++) {
                var f = uploadImg.files[i];
                if (!endsWith(f.name.toLowerCase(), 'jpg') && !endsWith(f.name.toLowerCase(),'png') && !endsWith(f.name.toLowerCase(),'jpeg') && !endsWith(f.name.toLowerCase(),'gif') && !endsWith(f.name.toLowerCase(),'svg')) {
                    alert(f.name + " nie jest zdjęciem!");
                    return false;
                } else {
                    return true;

                }
            }
        }

        function endsWith(str, suffix) {
            return str.indexOf(suffix, str.length - suffix.length) !== -1;
        }

        function loadFiles(e) {
            if(validate()){
                updateInput();
                const container = document.querySelector('.imagesPreview')
                const items = e.target.files;
                const array = Object.keys(items).map(item => items[item]);
                container.innerHTML = ''
                array.map((item) => {
                    const imgWrapper = document.createElement('div')
                    const img = document.createElement('img')
                    imgWrapper.classList.add('imagesPreview__item')
                    img.src = URL.createObjectURL(item)
                    imgWrapper.appendChild(img);
                    container.appendChild(imgWrapper)
                })
            }


        }
    </script>
@endpush
