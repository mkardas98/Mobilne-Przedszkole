@extends('layouts.application')

@section('content')

    <section class="editUser">
        <div class="pageNavigation">
        <span class="pageNavigation__title">
            Edytuj użytkownika
        </span>
            <div class="pageNavigation__buttons">
                <a href="{{route('director.users.index')}}" class="primaryButton -red">Cofnij</a>
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
                                   {!! $form->renderFieldGroup('first_name') !!}
                               </div>
                               <div class="col-lg-6">
                                   {!! $form->renderFieldGroup('last_name') !!}
                               </div>
                               <div class="col-lg-6">
                                   {!! $form->renderFieldGroup('email') !!}
                               </div>
                               <div class="col-lg-6">
                                   {!! $form->renderFieldGroup('phone') !!}

                               </div>
                               <div class="col-lg-6">
                                   {!! $form->renderFieldGroup('pesel') !!}
                               </div>
                               <div class="col-lg-6">
                                   {!! $form->renderFieldGroup('date_of_birth') !!}
                               </div>
                               <div class="col-lg-6">
                                   {!! $form->renderFieldGroup('address') !!}
                               </div>
                               <div class="col-lg-6">
                                   {!! $form->renderFieldGroup('role') !!}
                               </div>
                               <div class="col-lg-12  @if($obj->role == 2) d-none @endif" id="teacherSpecialization">
                                   {!! $form->renderFieldGroup('specialization') !!}
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
                const roleSelected = $('#role');

                    if(roleSelected.val() === '0' || roleSelected.val() === '1') {
                        specialization.removeClass('d-none');

                    }  else  {
                        specialization.addClass('d-none');
                    }
            }
            $('#role').change(()=>{
                changeRole();
            })

            $(document).ready(()=> {
                changeRole()
            })


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

@endsection
