@extends('layouts.application')

@section('content')
    <section class="messagesContainer">

        <div class="pageNavigation">
            <span class="pageNavigation__title">
               Konwersacja z użytkownikiem: {{$chat_user->first_name}} {{$chat_user->last_name}}
            </span>
            <div class="pageNavigation__buttons">
                <a href="{{route('chats.index')}}" class="primaryButton">Konwersacje</a>
            </div>
        </div>

        @include('helpers.alert')
        <div class="chatShow">
            <div class="chatShow__messages">
                @if($messages->hasMorePages())
                <div class="chatShow__more" id="loadMore{{$messages->currentPage()}}">
                        <button onclick="loadMore('{{ $messages->nextPageUrl() }}', {{$messages->currentPage()}})" class="showMoreMessages">Zobacz wcześniejsze wiadomości</button>
                </div>
                @endif
            @foreach($messages->reverse() as $message)
                    @if($message->user_id === $chat_user->id)
                        <div class="messageItem -chatUser">
                            <img src="{{renderImage($chat_user->avatar ?? asset('images/app/profile/empty-avatar.jpg'), [50,50, 'fit'])}}" class="messageItem__avatar -chatUser" alt="">
                            <div class="messageItem__body -chatUser">
                                <div class="messageItem__header">
                                            <span class="messageItem__date">
                                                {{$message->created_at}}
                                            </span>
                                    <span class="messageItem__author">{{$chat_user->first_name}} {{$chat_user->last_name}} napisał(a):</span>

                                </div>
                                <div class="messageItem__text -chatUser">
                                    <p>{{$message->text}}</p>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="messageItem -your">
                            <div class="messageItem__body -your">
                                <div class="messageItem__header">
                                            <span class="messageItem__author">
                                                Ty napisałeś(aś):
                                            </span>
                                    <span class="messageItem__date">
                                                {{$message->created_at}}
                                            </span>
                                </div>
                                <div class="messageItem__text -your">
                                    <p>{{$message->text}}</p>
                                </div>
                            </div>
                            <img
                                src="{{renderImage(Auth::user()->avatar ?? asset('images/app/profile/empty-avatar.jpg'), [50,50, 'fit'])}}"
                                class="messageItem__avatar -your" alt="">

                        </div>
                    @endif

                @endforeach
            </div>
            <form action="{{route('chats.add_message', $chat_id)}}" method="post">
                @csrf
                <div class="form-group">
                    <label for="message"></label>
                    <textarea class="form-control" name="message" id="message" rows="7"
                              placeholder="Odpisz.."></textarea>
                </div>
                <button type="submit" class="primaryButton -green">Dodaj odpowiedź</button>
            </form>
        </div>


    </section>
@endsection

@push('scripts.body.bottom')
    <script>
        const loadMore = (url, page) => {
            const container = $('.chatShow__messages');
            $(`.showMoreMessages`).html('ŁADOWANIE..')
            $.ajax({
                method: "GET",
                url: url,
            }).done(function( data ) {
                if(data){
                    $(`#loadMore${page}`).remove();
                    const oldContent = container.html()
                    container.html(data + oldContent)
                }
            });

        }
    </script>
@endpush

