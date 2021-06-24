@extends('layouts.application')
@section('content')
    <section class="profileShow">
        <div class="pageNavigation">
        <span class="pageNavigation__title">
            Profil dziecka
        </span>

        </div>
        <div class="row justify-content-center">
            @include('helpers.alert')
            <div class="col-lg-12">
                <div class="card">
                    <div class="card__header">
                <span class="card__headerTitle">
                    {{$obj->first_name.' '.$obj->last_name}}
                </span>
                        <div class="card__buttons">
                            <a href="{{route('director.kids.edit', $obj->id)}}" class="primaryButton">Edytuj</a>
                        </div>
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
                                                <span class="profileShow__value">{{date('d/m/Y', strtotime($obj->date_of_birth))}}</span>
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
                                                <span class="profileShow__value">{{$obj->group->name}}</span>
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
                            <a href="{{route('director.allergens.edit', ['kid_id'=>$obj->id])}}" class="primaryButton">Dodaj nowy</a>
                        </div>
                    </div>
                    <div class="card__body">

                    </div>

                </div>
            </div>

        </div>

    </section>

@endsection
