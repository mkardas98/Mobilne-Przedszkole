@extends('layouts.application')

@section('content')

    <section class="editUser">
        <div class="pageNavigation">
        <span class="pageNavigation__title">
            Edytuj użytkownika
        </span>
            <div class="pageNavigation__buttons">
                <a href="{{route('director.users.index')}}" class="primaryButton -red">Anuluj</a>
                <button onclick="event.preventDefault(); document.getElementById('userForm').submit();" class="primaryButton ">Zapisz</button>
            </div>
        </div>
        @include('helpers.alert')
        <form action="{{route('director.users.edit', ['id'=>$obj->id])}}" method="post" enctype="multipart/form-data" id="userForm">
            @csrf
            <div class="row">
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card__body">
                            <div class="editAvatar">
                                @if(!(is_null($obj->avatar)))
                                    <img src="{{renderImage($obj->avatar, [300,300, 'fit'])}}" alt="">
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
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="card">
                       <div class="card__body">
                           <div class="row">
                               <div class="col-lg-6">
                                   @include('helpers.input', ['name' => 'first_name', 'label' => 'Imię', 'default' => $obj->first_name])
                               </div>
                               <div class="col-lg-6">
                                   @include('helpers.input', ['name' => 'last_name', 'label' => 'Nazwisko', 'default' => $obj->last_name])
                               </div>
                               <div class="col-lg-6">
                                   @include('helpers.input', ['name' => 'email', 'label' => 'E-mail', 'default' => $obj->phone])
                               </div>
                               <div class="col-lg-6">
                                   @include('helpers.input', ['name' => 'phone', 'label' => 'Numer telefonu', 'default' => $obj->phone])
                               </div>
                               <div class="col-lg-6">
                                   @include('helpers.input', ['name' => 'pesel', 'label' => 'PESEL', 'default' => $obj->pesel])
                               </div>
                               <div class="col-lg-6">
                                   @include('helpers.input', ['name' => 'date_of_birth', 'label' => 'Data urodzenia', 'default' => $obj->date_of_birth, 'type' => 'date'])
                               </div>
                               <div class="col-lg-6">
                                   @include('helpers.input', ['name' => 'address', 'label' => 'Adres zamieszkania', 'default' => $obj->address])
                               </div>
                               <div class="col-lg-6">
                                   <div class="input-wrapper">
                                       <label for="role" class="custom-label ">Typ konta</label>
                                       <select id="role" name="role" class="custom-input {{$errors->first('role') ? ' form-error' : ''}}" onchange="changeRole()">
                                           <option value="">Wybierz</option>
                                           <option value="0" @if($obj->role == 0) selected @endif>Dyrektor</option>
                                           <option value="1" @if($obj->role == 1) selected @endif>Nauczyciel</option>
                                           <option value="2" @if($obj->role == 2) selected @endif >Rodzic</option>
                                       </select>
                                       {!! $errors->first('role', '<p class="help-block">:message</p>') !!}
                                   </div>
                               </div>
                               <div class="col-lg-12 @if($obj->role == 2) d-none @endif" id="teacherSpecialization">
                                       @include('helpers.input', ['name' => 'specialization', 'label' => 'Specjalizacja', 'default' => $obj->specialization])
                               </div>
                               <div class="col-lg-12  @if($obj->role == 1 || $obj->role === 0) d-none @endif" id="parentChild">
                                   <div class="input-wrapper">
                                       <label for="role" class="custom-label ">Dziecko</label>
                                       <select id="child" name="child" class="custom-input {{$errors->first('child') ? ' form-error' : ''}}">
                                           <option value="">Wybierz</option>
                                           <option value="0" @if($obj->child == 0) selected @endif>dziecko1</option>
                                           <option value="1" @if($obj->child == 1) selected @endif>dziecko2</option>
                                           <option value="2" @if($obj->child == 2) selected @endif >dziecko3</option>
                                       </select>
                                       {!! $errors->first('child', '<p class="help-block">:message</p>') !!}
                                   </div>
                               </div>
                           </div>
                       </div>

                    </div>
                </div>
            </div>
        </form>
    </section>

    @push('scripts.body.bottom')
        <script>

            const changeRole = () => {
                const specialization = $('#teacherSpecialization')
                const child = $('#parentChild')
                const roleSelected = $('#role');

                    if(roleSelected.val() == 0 || roleSelected.val() == 1) {
                        specialization.removeClass('d-none');
                        child.addClass('d-none');

                    } else if(roleSelected.val() == 2){
                        child.removeClass('d-none');
                        specialization.addClass('d-none');

                    } else  {
                        child.addClass('d-none');
                        specialization.addClass('d-none');
                    }
            }

        </script>
    @endpush

@endsection
