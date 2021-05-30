@extends('layouts.application')
@section('content')
    <section class="profileEditShow">

        <div class="pageNavigation">
        <span class="pageNavigation__title">
            {{('Edytuj profil')}}
        </span>
        </div>
        <div class="row justify-content-center">
            @include('helpers.alert')

            <div class="col-lg-12">
                <div class="card">
                    <div class="card__header">
                <span class="card__headerTitle">
                    Edytuj dane twojego profilu
                </span>
                        <div class="card__buttons">
                            <a href="{{route('profile.show')}}" class="primaryButton -red">Anuluj</a>
                            <button onclick="event.preventDefault(); document.getElementById('profileForm').submit();" class="primaryButton ">Zapisz</button>
                        </div>
                    </div>
                    <div class="card__body">
                        <form action="{{route('profile.edit')}}" method="POST" id="profileForm" enctype="multipart/form-data" class="profileEditShow__form">
                            @csrf
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="editAvatar">
                                        @if(!(is_null($profile->avatar)))
                                            <img src="{{renderImage($profile->avatar, [300,300, 'fit'])}}" alt="">
                                        @else
                                            <img src="{{asset('images/app/profile/empty-avatar.jpg')}}" alt="">
                                        @endif
                                            <div class="input-file-container">
                                                <label tabindex="0" for="avatar" class="input-file-trigger primaryButton">Zmień zdjęcie profilowe</label>
                                                <input class="input-file" type="file" id="avatar" name="avatar" accept="image/png, image/jpeg">
                                                <p class="file-return"></p>
                                                {!! $errors->first('avatar', '<p class="help-block">:message</p>') !!}
                                            </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="profileEditShow__inputs">
                       <div class="row">

                           <div class="col-6">
                               {!! $form->renderFieldGroup('first_name') !!}
                           </div>
                           <div class="col-6">
                               {!! $form->renderFieldGroup('last_name') !!}
                           </div>
                           <div class="col-12">
                               {!! $form->renderFieldGroup('date_of_birth') !!}
                           </div>
                           <div class="col-12">
                               {!! $form->renderFieldGroup('pesel') !!}
                           </div>
                           <div class="col-12">
                               {!! $form->renderFieldGroup('phone') !!}
                           </div>
                           <div class="col-12">
                               {!! $form->renderFieldGroup('address') !!}
                           </div>
                           <div class="col-12">
                               {!! $form->renderFieldGroup('email') !!}
                           </div>

                       </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>
            </div>


            <div class="col-lg-12">
                <div class="card ">
                    <div class="card__header">
                                       <span class="card__headerTitle">
                    Zmień hasło
                </span>
                        <div class="card__buttons">
                            <button type="submit" onclick="event.preventDefault(); document.getElementById('passwordForm').submit();" class="primaryButton">Zmień hasło</button>
                        </div>
                    </div>
                    <div class="card__body">
                        <div class="row justify-content-center">
                            <div class="col-lg-7">
                                <form action="{{route('profile_password.edit')}}" method="POST" id="passwordForm" class="profileEditShow__passwordForm">
                                    @csrf
                                    <div class="row justify-content-center">
                                        <div class="col-lg-7">
                                            {!! $form->renderFieldGroup('password') !!}
                                        </div>
                                        <div class="col-lg-7">
                                            {!! $form->renderFieldGroup('new_password') !!}
                                        </div>
                                        <div class="col-lg-7">
                                            {!! $form->renderFieldGroup('new_confirm_password') !!}
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
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
