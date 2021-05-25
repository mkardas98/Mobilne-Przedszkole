@extends('layouts.application')
@section('content')
    <section class="profileEditShow">

        <div class="pageNavigation">
        <span class="pageNavigation__title">
            {{__('Edytuj profil')}}
        </span>
            <div class="pageNavigation__buttons">
                <a href="{{route('profile.show')}}" class="primaryButton -red">{{__('Anuluj')}}</a>
                <a href="" onclick="event.preventDefault(); document.querySelector('.profileEditShow__form').submit();" class="primaryButton -green">{{__('Zapisz')}}</a>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card__header">
                <span class="card__headerTitle">
                    {{__('Edytuj dane twojego profilu')}}
                </span>
                    </div>
                    <div class="card__body">
                        <form action="{{route('profile.edit')}}" method="POST" enctype="multipart/form-data" class="profileEditShow__form">
                            @csrf
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="profileEditShow__avatar">
                                        @if(!(is_null($profile->avatar)))
                                            <img src="{{renderImage($profile->avatar, [300,300, 'fit'])}}" alt="">
                                        @else
                                            <img src="{{asset('images/app/profile/empty-avatar.jpg')}}" alt="">
                                        @endif
                                            <div class="input-file-container">
                                                <label tabindex="0" for="avatar" class="input-file-trigger primaryButton">Zmień zdjęcie profilowe..</label>
                                                <input class="input-file" type="file" id="avatar" name="avatar" accept="image/png, image/jpeg">
                                                <p class="file-return"></p>
                                            </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">

                                </div>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>

    </section>

@endsection


@push('scripts.body.bottom')
<script>

    var fileInput  = document.querySelector( ".input-file" ),
        button     = document.querySelector( ".input-file-trigger" ),
        the_return = document.querySelector(".file-return");

    button.addEventListener( "keydown", function( event ) {
        if ( event.keyCode == 13 || event.keyCode == 32 ) {
            fileInput.focus();
        }
    });
    button.addEventListener( "click", function( event ) {
        fileInput.focus();
        return false;
    });
    fileInput.addEventListener( "change", function( event ) {
        the_return.innerHTML = this.value;
    });
</script>
@endpush