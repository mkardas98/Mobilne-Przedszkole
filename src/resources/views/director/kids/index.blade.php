

    @extends('layouts.application')

@section('content')
    <section class="usersIndex">

        <div class="pageNavigation">
        <span class="pageNavigation__title">
            Dzieci
        </span>
            <div class="pageNavigation__buttons">
                <a href="{{route('director.kids.edit')}}" class="primaryButton">Dodaj nowe dziecko</a>
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
                                <th>Grupa</th>
                                <th>Opiekun</th>
                                <th><i class="fas fa-cogs"></i> Zarządzanie</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($kids as $key=>$kid)
                                <tr>
                                    <td>{{$key + 1}}</td>
                                    <td>
                                        <img src="{{$kid->avatar ? renderImage($kid->avatar, [80, 80, 'fit']) : asset('images/app/profile/empty-avatar.jpg')}}" alt="" class="avatar">
                                    </td>
                                    <td>{{$kid->first_name}}</td>
                                    <td>{{$kid->last_name}}</td>
                                    <td> {{date('d/m/Y', strtotime($kid->date_of_birth))}}</td>
                                    <td> </td>
                                    <td>@if($kid->user){{$kid->user->first_name}} {{$kid->user->last_name}} @else Nie przypisano @endif</td>
                                    <td class="tableButtons">
                                        <a class="controlButton -blue" href="{{route('director.kids.edit', ['id'=>$kid->id])}}"><i class="far fa-edit"></i></a>
                                        @php($delete = route('director.kids.delete', $kid->id))
                                        <button class="controlButton -red" onclick="deleteItem('{{$delete}}')"><i class="fas fa-ban"></i></button>
                                        <a class="controlButton -green" href="{{--{{route('director.groups.show', ['id'=>$kid->id])}}--}}"><i class="far fa-hand-pointer"></i></a>
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


