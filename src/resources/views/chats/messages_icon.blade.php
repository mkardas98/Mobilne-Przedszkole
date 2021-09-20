<li class="nav-item">
    <a class="nav-link" href="{{route('chats.index')}}">
        <img src="{{asset('images/app/icons/messages.svg')}}" alt="">
        <span>Wiadomości</span>

        @if($countNewMessages)
            <div class="newMessagesIcon">
                <span>
                    {{$countNewMessages}}
                </span>
            </div>
            @endif

    </a>
</li>
