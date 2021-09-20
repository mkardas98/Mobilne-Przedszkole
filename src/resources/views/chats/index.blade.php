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
                        <div class="chatItems">
                            @if(count($chats)>0)
                                @foreach($chats as $chat)
                                    <div class="chatItem">
                                        <a href="{{route('chats.show', $chat->chat_id)}}" class="chatItem__imageWrapper">
                                            <img
                                                src="{{renderImage($chat->user->avatar ?? asset('images/app/profile/empty-avatar.jpg'), [100,100, 'fit'])}}"
                                                class="chatItem__avatar" alt="">
                                            @if((!$chat->last_message->read_status) && ($chat->last_message->user_id != auth()->user()->id))
                                                <span class="chatItem__newMessage">
                                                    Nowa wiadomość
                                                </span>
                                            @endif
                                        </a>
                                        <a href="{{route('chats.show', $chat->chat_id)}}" class="chatItem__right">
                                            <div class="chatItem__top">
                                                <span class="chatItem__user"><i
                                                        class="fas fa-user"></i> {{$chat->user->first_name}} {{$chat->user->last_name}}</span>
                                                <span class="chatItem__dateLastMassage">
                                                   <i class="fas fa-clock"></i> Ostatnia wiadomość: {{date_format($chat->last_message['created_at'], 'd-m-Y | h:s:j')}}
                                                </span>
                                            </div>
                                            <p class="chatItem__lastMessage">
                                                <span>{{$chat->last_message->user_id === $chat->user->id ? $chat->user->first_name.' '.$chat->user->last_name.' napisał(a): ': 'Ty napisałeś(aś): ' }}</span>{{$chat->last_message->text}}
                                            </p>
                                        </a>
                                    </div>

                                @endforeach
                            @else
                                <span>Nie masz żadnych rozpoczętych konwersacji.</span>
                            @endif
                        </div>

                    </div>
                </div>
            </div>

        </div>

    </section>
@endsection


