@extends('layouts.application')

@section('content')
    <div class="pageNavigation">
        <span class="pageNavigation__title">
            Grupa - <span class="groupColor" style="color: {{$group->color}}">{{$group->name}}</span>
        </span>
        <div class="pageNavigation__buttons">
            <a href="{{route('director.groups.index')}}" class="primaryButton">Wszystkie grupy</a>
        </div>
    </div>
    <section class="directorGroupDetail">
        <div class="card">
            <div class="card__header justify-content-between">
                <span class="card__headerTitle">
                   Szczegóły grupy
                </span>
                <div class="card__buttons">
                    <a class="primaryButton" href="{{route('director.groups.edit', ['id'=>$group->id])}}">Edytuj</a>
                </div>
            </div>

            <div class="card__body">
                <div class="row">
                    <div class="col-lg-3">
                        <div class="colorCard -small -red">
                            <div class="colorCard__header">
                                <span class="colorCard__headerTitle">
                                   Nazwa grupy:
                                </span>
                            </div>
                            <div class="colorCard__body">
                            <span class="colorCard__value">
                                 {{$group->name}}
                            </span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="colorCard -small -blue">
                            <div class="colorCard__header">
                                <span class="colorCard__headerTitle">
                                      Sala grupy:
                                </span>
                            </div>
                            <div class="colorCard__body">
                            <span class="colorCard__value">
                                 {{$group->room}}
                            </span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="colorCard -small -orange">
                            <div class="colorCard__header">
                                <span class="colorCard__headerTitle">
                                      Opiekunowie grupy:
                                </span>
                            </div>
                            <div class="colorCard__body">
                            <span class="colorCard__value">
                                 @foreach($group->users as $user)
                    {{$user->first_name}} {{$user->last_name}}
                                @endforeach
                            </span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="colorCard -small -green">
                            <div class="colorCard__header">
                                <span class="colorCard__headerTitle">
                                      Widoczność w serwisie:
                                </span>
                            </div>
                            <div class="colorCard__body">
                            <span class="colorCard__value">
                       {{$group->status ? 'Widoczna' : 'Nie widoczna'}}
                            </span>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3">
                        <span class="card__valueName">

                        </span>
                        <span class="card__value">

                        </span>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <section class="directorGroupKids">
        <div class="card">
            <div class="card__header">
                <span class="card__headerTitle">
                    Dzieci należące do grupy
                </span>
                <div class="card__buttons">
                    <a class="primaryButton" href="{{route('director.attendance_list.edit', ['group_id'=>$group->id, 'date'=>date('Y-m-d', strtotime(\Carbon\Carbon::now()))])}}">Sprawdź obecność</a>
                </div>
            </div>
            <div class="card__body">
                <table id="dataTable" class="ui celled table" >
                    <thead>
                    <tr>
                        <th><i class="fas fa-hashtag"></i></th>
                        <th>Zdjęcie</th>
                        <th>Imię</th>
                        <th>Nazwisko</th>
                        <th>Data urodzenia</th>
                        <th>Opiekun</th>
                        <th><i class="fas fa-cogs"></i> Zarządzanie</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($group->kids as $key=>$kid)
                        <tr>
                            <td>{{$key + 1}}</td>
                            <td>
                                <img
                                    src="{{$kid->avatar ? renderImage($kid->avatar, [80, 80, 'fit']) : asset('images/app/profile/empty-avatar.jpg')}}"
                                    alt="" class="avatar -small">
                            </td>
                            <td>{{$kid->first_name}}</td>
                            <td>{{$kid->last_name}}</td>
                            <td> {{date('d/m/Y', strtotime($kid->date_of_birth))}}</td>
                            <td>@if($kid->user){{$kid->user->first_name}} {{$kid->user->last_name}} @else Nie
                                przypisano @endif</td>
                            <td class="tableButtons">
                                <a class="controlButton -blue" href="{{route('director.kids.edit', ['id'=>$kid->id])}}"><i
                                        class="far fa-edit"></i></a>
                                @php($delete = route('director.kids.delete', $kid->id))
                                <button class="controlButton -red" onclick="deleteItem('{{$delete}}')"><i
                                        class="fas fa-ban"></i></button>
                                <a class="controlButton -green"
                                   href="{{route('director.kids.show', ['id'=>$kid->id])}}"><i
                                        class="far fa-hand-pointer"></i></a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>
    <section class="directorGroupAnnouncements">
        <div class="card">
            <div class="card__header justify-content-between">
                <div class="card__header">
                    <span class="card__headerTitle">
                    Ogłoszenia grupy
                </span>
                    <div class="card__buttons">
                        <a class="primaryButton"
                           href="{{route('director.announcement.edit', ['group_id' => $group->id])}}">Dodaj nowe
                            ogłoszenie</a>
                    </div>
                </div>
            </div>

            <div class="card__body">
                @if(count($group->announcements)>0)
               @foreach($group->announcements as $item)
                    <div class="announcementItem">
                        <div class="announcementItem__header">
                            <div class="announcementItem__details">

                                <span class="announcementItem__date">
                                    DODANO: {{date('d/m/Y H:i', strtotime($item->created_at))}}
                                </span>
                                <span class="announcementItem__status">
                                    {!! $item->status ? '<i class="fas fa-eye"></i> Ogłoszenie widoczne' : ' <i class="fas fa-eye-slash"></i> Ogłoszenie niewidoczne' !!}
                                </span>
                            </div>
                            <div class="announcementItem__buttons">
                                <a class="controlButton -blue" href="{{route('director.announcement.edit', ['group_id' => $group->id, 'id'=>$item->id])}}"><i class="far fa-edit"></i></a>
                                @php($delete = route('director.announcement.delete', ['id'=>$item->id]))
                                <button class="controlButton -red" onclick="deleteItem('{{$delete}}')"><i
                                        class="fas fa-ban"></i></button>
                            </div>
                        </div>
                        <div class="announcementItem__text">
                             <span class="announcementItem__title">
                                    {{$item->title}}
                                </span>
                            {!! $item->text !!}
                        </div>
                    </div>
                @endforeach
                   @if(count($group->announcements) == 3)
                       <a href="{{route('director.announcement.group.index', $group->id)}}" class="primaryButton -green">Zobacz wszystie ogłoszenia</a>
                       @endif
                @else
                    <span class="emptySection">Brak ogłoszeń dla tej grupy!</span>
                @endif
            </div>
        </div>
    </section>
    <section class="lessonPlan">
        <div class="card">
            <div class="card__header">
                <span class="card__headerTitle">
                    Plan zajęć
                </span>
                <div class="card__buttons">
                    <a class="primaryButton"
                       href="{{route('director.lesson_plan.edit', ['group_id' => $group->id])}}">Dodaj nowy dzień</a>
                </div>
            </div>
            <div class="card__body">
                <table id="dataTable2" class="ui celled table">
                    <thead>
                    <tr>
                        <th><i class="fas fa-hashtag"></i></th>
                        <th>Data</th>
                        <th><i class="fas fa-cogs"></i> Zarządzanie</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($group->lessonPlan as $key=>$plan)
                        <tr>
                            <td>{{$key + 1}}</td>
                            <td> {{date('d/m/Y', strtotime($plan->date))}}</td>
                            <td class="tableButtons">
                                <a class="controlButton -blue" href="{{route('director.lesson_plan.edit', ['id'=>$plan->id, 'group_id'=>$group->id])}}"><i
                                        class="far fa-edit"></i></a>
                                @php($delete = route('director.lesson_plan.delete', $plan->id))
                                <button class="controlButton -red" onclick="deleteItem('{{$delete}}')"><i
                                        class="fas fa-ban"></i></button>
                                <a class="controlButton -green"
                                   href="{{route('director.lesson_plan.show', ['id'=>$plan->id])}}"><i
                                        class="far fa-hand-pointer"></i></a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>


@endsection

@push('scripts.body.bottom')
    <script>
        $(document).ready(function () {
            $('#dataTable').DataTable();
            $('#dataTable2').DataTable();
        });


    </script>
@endpush
