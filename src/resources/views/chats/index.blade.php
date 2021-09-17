@extends('layouts.application')

@section('content')
    <section class="directorGroupsIndex">

        <div class="pageNavigation">
            <span class="pageNavigation__title">
               Wiadomości
            </span>
            <div class="pageNavigation__buttons">
                <a href="{{route('chats.new_chat')}}" class="primaryButton">Rozpoczni nową konwersację</a>
            </div>
        </div>

        <div class="row">
            @include('helpers.alert')
            <div class="col-lg-12">
                <div class="card">
                    <div class="card__body">
                        @if(count($chats)>0)
                            @foreach($chats as $chat)

                                <a href="{{route('chats.show', $chat->chat_id)}}">{{$chat->chat_id}}</a>

                            @endforeach
                        @endif
                    </div>
                </div>
            </div>

        </div>

    </section>
@endsection


