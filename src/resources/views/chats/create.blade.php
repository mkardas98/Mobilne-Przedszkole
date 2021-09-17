@extends('layouts.application')

@section('content')
    <section class="directorGroupsIndex">

        <div class="pageNavigation">
            <span class="pageNavigation__title">
              Nowa konwersacja
            </span>
        </div>

        <div class="row">
            @include('helpers.alert')
            <div class="col-lg-12">
                <div class="card">
                    <div class="card__body">
                        <form action="{{route('chats.create')}}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for='user' class="custom-label">Wybierz użytkownika, z którym chcesz rozpocząć konwersację.</label>
                                <select id='user' name="user" style="width: 100%">
                                    @foreach($users as $user)
                                        <option value='{{$user->id}}' data-avatar="@if(!(is_null($user->avatar))) {{renderImage($user->avatar, [50,50, 'fit'])}} @else {{asset('images/app/profile/empty-avatar.jpg')}}@endif">
                                            {{$user->first_name}} {{$user->last_name}}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="message" class="custom-label">Wiadomość</label>
                                <textarea name="message" class="form-control" id="message" rows="10" placeholder="Wrowadź treść wiadomości"></textarea>
                            </div>
                            <button class="primaryButton -green" type="submit">Wyślij wiadomość</button>
                        </form>
                    </div>
                </div>
            </div>

        </div>

    </section>
    @push('scripts.body.bottom')
        <script>
            $(document).ready(function(){
                $("#user").select2({
                    templateResult: formatState,
                    placeholder: "Wybierz użytkownika",
                    selectOnClose: true

                });
            });

            function formatState (state) {
                if (!state.id) { return state.text; }
                console.log()
                let $state = $('<span><img src="' + state.element.dataset.avatar + '" style="width: 50px" class="img-flag" /> ' + state.text + '</span>')
                return $state;
            }
        </script>
    @endpush
@endsection


