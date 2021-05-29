@extends('layouts.application')

@section('content')

    <section class="directorGroupDetail">
        <div class="pageNavigation">
        <span class="pageNavigation__title">
            Szczegóły grupy - <span style="color: {{$group->color}}">{{$group->name}}</span>
        </span>
            <div class="pageNavigation__buttons">
                <a href="{{route('director.groups.index')}}" class="primaryButton">Wszystkie grupy</a>
            </div>
        </div>

        <div class="card">
            <div class="card__header justify-content-end">
                <div class="card__buttons">
                    <a class="primaryButton" href="{{route('director.groups.edit', ['id'=>$group->id])}}">Edytuj</a>
                </div>
            </div>

            <div class="card__body">

                <div class="row">
                    <div class="col-lg-3">
                <span class="card__valueName">
                    Nazwa grupy:
                </span>
                        <span class="card__value">
                    {{$group->name}}
                </span>
                    </div>
                    <div class="col-lg-3">
                <span class="card__valueName">
                    Sala grupy:
                </span>
                        <span class="card__value">
                    {{$group->room}}
                </span>
                    </div>
                    <div class="col-lg-3">
                <span class="card__valueName">
                    Opiekunowie grupy:
                </span>
                        @foreach($group->users as $user)
                            <span class="card__value">
                    {{$user->first_name}} {{$user->last_name}}
                        </span>
                        @endforeach
                    </div>
                    <div class="col-lg-3">
                        <span class="card__valueName">
                            Widoczność w serwisie:
                        </span>
                        <span class="card__value">
                            {{$group->status ? 'Widoczna' : 'Nie widoczna'}}
                        </span>
                    </div>
                </div>

            </div>
        </div>
    </section>

@endsection
