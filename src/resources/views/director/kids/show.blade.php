@extends('layouts.application')
@section('content')
    <section class="profileShow">
        <div class="pageNavigation">
        <span class="pageNavigation__title">
            Profil dziecka: {{$obj->first_name.' '.$obj->last_name}}
        </span>

        </div>
        <div class="row justify-content-center">
            @include('helpers.alert')
            <div class="col-lg-12">
                <div class="card">
                    <div class="card__header">
                <span class="card__headerTitle">
                 Dane dziecka
                </span>
                    </div>
                    <div class="card__body">
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="profileShow__avatar">
                                    @if(!(is_null($obj->avatar)))
                                        <img src="{{renderImage($obj->avatar, [300,300, 'fit'])}}" alt="">
                                    @else
                                        <img src="{{asset('images/app/profile/empty-avatar.jpg')}}" alt="">
                                    @endif
                                </div>
                            </div>
                            <div class="col-lg-8">
                                <div class="profileShow__details">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="profileShow__info">
                                                <span class="profileShow__name">Imię:</span>
                                                <span class="profileShow__value">{{$obj->first_name}}</span>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="profileShow__info">
                                                <span class="profileShow__name">Nazwisko:</span>
                                                <span class="profileShow__value">{{$obj->last_name}}</span>
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="profileShow__info">
                                                <span class="profileShow__name">Data urodzenia:</span>
                                                <span
                                                    class="profileShow__value">{{date('d/m/Y', strtotime($obj->date_of_birth))}}</span>
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="profileShow__info">
                                                <span class="profileShow__name">PESEL:</span>
                                                <span class="profileShow__value">{{$obj->pesel}}</span>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="profileShow__info">
                                    <span class="profileShow__name">
                                       Grupa:
                                        </span>

                                                <span
                                                    class="profileShow__value">{{$obj->group->name ?? 'Nie przypisano'}}</span>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="card">
                    <div class="card__header">
                <span class="card__headerTitle">
                   Alergeny
                </span>
                        <div class="card__buttons">
                            <a href="{{route('director.allergens.edit', ['kid_id'=>$obj->id])}}" class="primaryButton">Dodaj
                                nowy</a>
                        </div>
                    </div>
                    <div class="card__body">
                        <div class="col-12">
                            @if(count($obj->allergens)>0)
                                <table class="styled-table">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Alergen</th>
                                        <th>Zarządzanie</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($obj->allergens as $key=>$item)
                                        <tr>
                                            <td><strong>{{$key+1}}</strong></td>
                                            <td>{{$item->allergen}}</td>
                                            <td class="tableButtons">
                                                <a class="controlButton -blue"
                                                   href="{{route('director.allergens.edit', ['id'=>$item->id, 'kid_id'=>$obj->id])}}"><i
                                                        class="far fa-edit"></i></a>
                                                @php($delete = route('director.allergens.delete', $item->id))
                                                <button class="controlButton -red" onclick="deleteItem('{{$delete}}')">
                                                    <i class="fas fa-ban"></i></button>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            @else
                                <span class="emptySection">
                                    Brak alergenów
                                </span>
                            @endif
                        </div>
                    </div>

                </div>
            </div>
            <div class="col-lg-12">
                <div class="card">
                    <div class="card__header">
                <span class="card__headerTitle">
                 Dane opiekuna
                </span>
                    </div>
                    <div class="card__body">
                        @if(isset($obj->user))
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="profileShow__avatar">
                                        @if(!(is_null($obj->user->avatar)))
                                            <img src="{{renderImage($obj->user->avatar, [300,300, 'fit'])}}" alt="">
                                        @else
                                            <img src="{{asset('images/app/profile/empty-avatar.jpg')}}" alt="">
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-8">
                                    <div class="profileShow__details">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="profileShow__info">
                                                    <span class="profileShow__name">Imię:</span>
                                                    <span class="profileShow__value">{{$obj->user->first_name}}</span>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="profileShow__info">
                                                    <span class="profileShow__name">Nazwisko:</span>
                                                    <span class="profileShow__value">{{$obj->user->last_name}}</span>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="profileShow__info">
                                                    <span class="profileShow__name">Email:</span>
                                                    <span class="profileShow__value">{{$obj->user->email}}</span>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="profileShow__info">
                                                    <span class="profileShow__name">Numer telefonu:</span>
                                                    <span class="profileShow__value">{{$obj->user->phone}}</span>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="profileShow__info">
                                                    <span class="profileShow__name">PESEL:</span>
                                                    <span class="profileShow__value">{{$obj->user->pesel}}</span>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="profileShow__info">
                                                    <span class="profileShow__name">Data urodzenia:</span>
                                                    <span
                                                        class="profileShow__value">{{date('d/m/Y', strtotime($obj->user->date_of_birth))}}</span>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="profileShow__info">
                                                    <span class="profileShow__name">Adres:</span>
                                                    <span class="profileShow__value">{{$obj->user->address}}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @else
                            <span class="emptySection">
                                   Nie przypisano
                                </span>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="card">
                    <div class="card__header">
                <span class="card__headerTitle">
                    Zachowanie dziecka
                </span>
                        <div class="card__buttons">
                            <a class="primaryButton" href="{{route('director.behaviors.edit', ['kid_id'=>$obj->id])}}">Dodaj nowy wpis</a>
                        </div>
                    </div>
                    <div class="card__body">
                        @if(isset($obj->behaviors))
                            <table id="behaviorsTable" class="ui celled table">
                                <thead>
                                <tr>
                                    <th><i class="fas fa-hashtag"></i></th>
                                    <th>Data</th>
                                    <th>Typ</th>
                                    <th>Komentarz</th>
                                    <th><i class="fas fa-cogs"></i> Zarządzanie</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($obj->behaviors as $key=>$item)
                                    <tr>
                                        <td>{{$key + 1}}</td>
                                        <td>{{date('d/m/Y', strtotime($item->created_at))}}</td>
                                        <td>{!!$item->type ? '<i class="fas fa-smile-beam true"></i> Pozytywne' : '<i class="fas fa-frown false"></i> Negatywne' !!}</td>
                                        <td>{{$item->text}}</td>
                                        <td class="tableButtons">
                                            <a class="controlButton -blue"
                                               href="{{route('director.behaviors.edit', ['id'=>$item->id, 'kid_id'=>$obj->id])}}"><i
                                                    class="far fa-edit"></i></a>
                                            @php($delete = route('director.behaviors.delete', $item->id))
                                            <button class="controlButton -red" onclick="deleteItem('{{$delete}}')"><i
                                                    class="fas fa-ban"></i></button>

                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        @else
                            <span class="emptySection">
                                   Brak wpisów
                                </span>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="card">
                    <div class="card__header">
                <span class="card__headerTitle">
                    Upoważnienia odbioru
                </span>
                        <div class="card__buttons">
                            {{--                            <a class="primaryButton" href="{{route('director.behaviors.edit', ['kid_id'=>$obj->id])}}">Dodaj nowy wpis</a>--}}
                        </div>
                    </div>
                    <div class="card__body">
                        {{--                        <table id="behaviorsTable" class="ui celled table" >--}}
                        {{--                            <thead>--}}
                        {{--                            <tr>--}}
                        {{--                                <th><i class="fas fa-hashtag"></i></th>--}}
                        {{--                                <th>Typ</th>--}}
                        {{--                                <th>Komentarz</th>--}}
                        {{--                                <th><i class="fas fa-cogs"></i> Zarządzanie</th>--}}
                        {{--                            </tr>--}}
                        {{--                            </thead>--}}
                        {{--                            <tbody>--}}
                        {{--                                                        @foreach($obj->behaviors as $key=>$item)--}}
                        {{--                                                            <tr>--}}
                        {{--                                                                <td>{{$key + 1}}</td>--}}
                        {{--                                                                <td>{{$item->type}}</td>--}}
                        {{--                                                                <td>{{$item->text}}</td>--}}
                        {{--                                                                <td class="tableButtons">--}}
                        {{--                                                                    <a class="controlButton -blue" href="{{route('director.behaviors.edit', ['id'=>$item->id, 'kid_id'=>$obj->id])}}"><i class="far fa-edit"></i></a>--}}
                        {{--                                                                    @php($delete = route('director.behaviors.delete', $item->id))--}}
                        {{--                                                                    <button class="controlButton -red" onclick="deleteItem('{{$delete}}')"><i--}}
                        {{--                                                                            class="fas fa-ban"></i></button>--}}

                        {{--                                                                </td>--}}
                        {{--                                                            </tr>--}}
                        {{--                                                        @endforeach--}}
                        {{--                            </tbody>--}}
                        {{--                        </table>--}}
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="card">
                    <div class="card__header">
                <span class="card__headerTitle">
                    Obecności dziecka
                </span>

                    </div>

                    <div class="card__body">
                        @if($obj->attendanceList)
                            <table id="attendanceTable" class="ui celled table">
                                <thead>
                                <tr>
                                    <th><i class="fas fa-hashtag"></i></th>
                                    <th>Data</th>
                                    <th>Obecność</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($obj->attendanceList as $key=>$item)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{date('d/m/Y', strtotime($item->date))}}</td>
                                        <td>{!! $item->status ? '<i class="fas fa-check-circle true"></i> TAK' :  '<i class="fas fa-times-circle false"></i> NIE'!!}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        @else
                            <span class="emptySection">Historia obecności jest pusta</span>
                        @endif
                    </div>
                </div>
            </div>

        </div>
    </section>


    @push('scripts.body.bottom')
        <script>
            $(document).ready(function () {
                $('#behaviorsTable').DataTable();
            });
            $(document).ready(function () {
                $('#attendanceTable').DataTable();
            });
        </script>
    @endpush

@endsection
