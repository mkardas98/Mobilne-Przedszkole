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

