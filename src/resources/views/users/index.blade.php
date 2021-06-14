@extends('layouts.application')

@section('content')

<section class="usersIndex">

    <div class="pageNavigation">
        <span class="pageNavigation__title">
            Użytkownicy
        </span>
        <div class="pageNavigation__buttons">
            <a href="{{route('director.users.edit')}}" class="primaryButton">Dodaj nowego użytkownika</a>
        </div>
    </div>
    <div class="row">
        @include('helpers.alert')
        <div class="col-lg-12">
            <div class="card">

                <div class="card__body">
                    <table id="dataTable" class="ui celled table">
                        <thead>
                        <tr>
                            <th><i class="fas fa-hashtag"></i></th>
                            <th>Zdjęcie</th>
                            <th>Imię</th>
                            <th>Nazwisko</th>
                            <th>Data urodzenia</th>
                            <th>Email</th>
                            <th>Typ konta</th>
                            <th><i class="fas fa-cogs"></i> Zarządzanie</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $key=>$user)
                            <tr>
                                <td>{{$key + 1}}</td>
                                <td>
                                    <img src="{{$user->avatar ? renderImage($user->avatar, [80, 80, 'fit']) : asset('images/app/profile/empty-avatar.jpg')}}" alt="" class="avatar">
                                </td>
                                <td>{{$user->first_name}}</td>
                                <td>{{$user->last_name}}</td>
                                <td> {{date('d/m/Y', strtotime($user->date_of_birth))}}</td>
                                <td>{{$user->email}}</td>
                                <td>@if($user->role === 0) Dyrektor @elseif ($user->role === 1) Nauczyciel @else Rodzic @endif</td>
                                <td class="tableButtons">
                                    <a class="controlButton -blue" href="{{route('director.users.edit', ['id'=>$user->id])}}"><i class="far fa-edit"></i></a>
                                    @php($delete = route('director.users.delete', $user->id))
                                    <button class="controlButton -red" onclick="deleteItem('{{$delete}}')"><i class="fas fa-ban"></i></button>
{{--                                    <a class="controlButton -green" href="--}}{{--{{route('director.groups.show', ['id'=>$user->id])}}--}}{{--"><i class="far fa-hand-pointer"></i></a>--}}
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</section>

@push('scripts.body.bottom')
    <script>
        $(document).ready(function() {
            $('#dataTable').DataTable();
        });
    </script>
@endpush

@endsection
