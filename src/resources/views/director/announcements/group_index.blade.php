@extends('layouts.application')

@section('content')
    <div class="pageNavigation">
        <span class="pageNavigation__title">
           Ogłoszenia grupy {{$item->name}}
        </span>
        <div class="pageNavigation__buttons">
            <a href="{{route('director.groups.show', $item->id)}}" class="primaryButton">Powrót</a>
        </div>
    </div>

    <section class="directorGroupAnnouncements">
        <div class="card">
            <div class="card__header justify-content-between">
                <div class="card__header">
                    <span class="card__headerTitle">
                    Ogłoszenia grupy
                </span>
                    <div class="card__buttons">
                        <a class="primaryButton"
                           href="{{route('director.announcement.edit', ['group_id' => $item->id])}}">Dodaj nowe
                            ogłoszenie</a>
                    </div>
                </div>
            </div>

            <div class="card__body">
                @if(count($item->announcements)>0)
                    @foreach($item->announcements as $itemAnnouncement)
                        <div class="announcementItem">
                            <div class="announcementItem__header">
                                <div class="announcementItem__details">

                                <span class="announcementItem__date">
                                    DODANO: {{date('d/m/Y H:i', strtotime($itemAnnouncement->created_at))}}
                                </span>
                                    <span class="announcementItem__status">
                                    {!! $itemAnnouncement->status ? '<i class="fas fa-eye"></i> Ogłoszenie widoczne' : ' <i class="fas fa-eye-slash"></i> Ogłoszenie niewidoczne' !!}
                                </span>
                                </div>
                                <div class="announcementItem__buttons">
                                    <a class="controlButton -blue" href="{{route('director.announcement.edit', ['group_id' => $item->id, 'id'=>$itemAnnouncement->id])}}"><i class="far fa-edit"></i></a>
                                    @php($delete = route('director.announcement.delete', ['id'=>$itemAnnouncement->id]))
                                    <button class="controlButton -red" onclick="deleteItem('{{$delete}}')"><i
                                            class="fas fa-ban"></i></button>
                                </div>
                            </div>
                            <div class="announcementItem__text">
                             <span class="announcementItem__title">
                                    {{$itemAnnouncement->title}}
                                </span>
                                {!! $itemAnnouncement->text !!}
                            </div>
                        </div>
                    @endforeach
                @else
                    <span class="emptySection">Brak ogłoszeń dla tej grupy!</span>
                @endif
            </div>
        </div>
    </section>

@endsection

@push('scripts.body.bottom')

@endpush
