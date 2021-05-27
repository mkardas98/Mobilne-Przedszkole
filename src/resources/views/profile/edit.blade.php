@extends('layouts.application')
@section('content')
    <section class="profileEditShow">

        <div class="pageNavigation">
        <span class="pageNavigation__title">
            {{__('Edytuj profil')}}
        </span>
        </div>
        <div class="row justify-content-center">
            @if (\Session::has('success'))
                <div class="col-lg-8">
                    <div class="alert alert-success text-center mx-3">
                        {!! \Session::get('success') !!}
                    </div>
                </div>
                @endif
                @if (\Session::has('error'))
                    <div class="col-lg-8">
                        <div class="alert alert-danger text-center mx-3">
                            {!! \Session::get('error') !!}
                        </div>
                    </div>
                @endif
            <div class="col-lg-8">
                <div class="card">
                    <div class="card__header">
                <span class="card__headerTitle">
                    {{__('Edytuj dane twojego profilu')}}
                </span>
                        <div class="card__buttons">
                            <a href="{{route('profile.show')}}" class="primaryButton -red">{{__('Anuluj')}}</a>
                            <button onclick="event.preventDefault(); document.getElementById('profileForm').submit();" class="primaryButton ">{{__('Zapisz')}}</button>
                        </div>
                    </div>
                    <div class="card__body">
                        <form action="{{route('profile.edit')}}" method="POST" id="profileForm" enctype="multipart/form-data" class="profileEditShow__form">
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
                                                <label tabindex="0" for="avatar" class="input-file-trigger primaryButton">{{__('Zmień zdjęcie profilowe')}}</label>
                                                <input class="input-file" type="file" id="avatar" name="avatar" accept="image/png, image/jpeg">
                                                <p class="file-return"></p>
                                                {!! $errors->first('avatar', '<p class="help-block">:message</p>') !!}
                                            </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="profileEditShow__inputs">
                       <div class="row">
                           <div class="col-12">
                               @include('helpers.input', ['name' => 'login', 'label' => 'Login', 'default' => $profile->login])
                           </div>
                           <div class="col-6">
                               @include('helpers.input', ['name' => 'first_name', 'label' => 'Imię', 'default' => $profile->first_name])
                           </div>
                           <div class="col-6">
                               @include('helpers.input', ['name' => 'last_name', 'label' => 'Nazwisko', 'default' => $profile->last_name])
                           </div>
                           <div class="col-12">
                               @include('helpers.input', ['name' => 'date_of_birth', 'label' => 'Data urodzenia', 'default' => $profile->date_of_birth, 'type' => 'date'])
                           </div>
                           <div class="col-12">
                               @include('helpers.input', ['name' => 'phone', 'label' => 'Numer telefonu', 'default' => $profile->phone])
                           </div>
                           <div class="col-12">
                               @include('helpers.input', ['name' => 'email', 'label' => 'Adres e-mail', 'default' => $profile->email])
                           </div>

                       </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>
            </div>


            <div class="col-lg-8">
                <div class="card ">
                    <div class="card__header">
                                       <span class="card__headerTitle">
                    {{__('Zmień hasło')}}
                </span>
                        <div class="card__buttons">
                            <button type="submit" onclick="event.preventDefault(); document.getElementById('passwordForm').submit();" class="primaryButton">{{__('Zmień hasło')}}</button>
                        </div>
                    </div>
                    <div class="card__body">
                        <div class="row justify-content-center">
                            <div class="col-lg-7">
                                <form action="{{route('profile_password.edit')}}" method="POST" id="passwordForm" class="profileEditShow__passwordForm">
                                    @csrf
                                    <div class="row justify-content-center">
                                        <div class="col-lg-7">
                                            @include('helpers.input', ['name' => 'password', 'label' => 'Aktualne hasło', 'default' => '', 'type' => 'password', 'old'=>false])
                                        </div>
                                        <div class="col-lg-7">
                                            @include('helpers.input', ['name' => 'new_password', 'label' => 'Nowe hasło', 'default' => '', 'type' => 'password', 'old'=>false])
                                        </div>
                                        <div class="col-lg-7">
                                            @include('helpers.input', ['name' => 'new_confirm_password', 'label' => 'Powtórz nowe hasło', 'default' => '', 'type' => 'password', 'old'=>false])
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
