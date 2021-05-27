@if(count($navSections) > 0)
    <div class="navApp">
        <div class="navApp__user" onclick="window.location.href = `{{route('profile.show')}}`">
            <div class="navApp__userAvatarWrap">
                @if($user->avatar)
                    <img src="{{renderImage($user->avatar, [200,200, 'fit'])}}" alt="avatar" class="navApp__userAvatar">
                @else
                    <img src="{{asset('images/app/profile/empty-avatar.jpg')}}" alt="avatar" class="navApp__userAvatar">
                @endif
            </div>

            <span class="navApp__userName">{{$user->first_name}} {{$user->last_name}}</span>
            <span class="navApp__userRole">@if($user->role === 0) {{__('dyrektor')}} @elseif($user->role === 1) {{__('nauczyciel')}} @else
                    {{__('rodzic')}} @endif</span>


        </div>
        @foreach($navSections as $sectionKey => $section)

            @if(!empty($section['label']))
                <h6 class="navApp__titleGroup">
                    <span>{{__($section['label'])}}</span>
                    @if(!empty($section['icon']))
                        <a class="" href="#" aria-label="Add a new report">
                            <span data-feather="{{$section['icon']}}"></span>
                        </a>
                    @endif
                </h6>
            @endif


            @if(count($section['items']) > 0)
                <ul class="navApp__list">
                    @foreach($section['items'] as $item)
                        @php
                            $isActive = str_starts_with($item['route_name'], str_replace(['edit', 'create', 'index', 'show'], '', request()->route()->getName()));
                        @endphp
                        <li class="">
                            @if(isset($item['items']))
                                <button class="">
                                    @if(!empty($item['icon']))
                                        {{--                                        <span data-feather="{{$item['icon']}}"></span>--}}
                                        <i class="{{$item['icon']}}"></i>
                                    @endif
                                    {{__($item['label'])}} <span class="">(current)</span>
                                </button>
                                <ul class="@foreach($item['items'] as $subItem)
                                @php
                                    $isActive = str_starts_with($subItem['route_name'], str_replace(['edit', 'create', 'index', 'show'], '', request()->route()->getName()));
                                @endphp
                                {{$isActive ? '-active' : ''}}
                                @endforeach">
                                    @foreach($item['items'] as $subItem)
                                        @php
                                            $isActive = str_starts_with($subItem['route_name'], str_replace(['edit', 'create', 'index', 'show'], '', request()->route()->getName()));
                                        @endphp
                                        <li>
                                            <a class="{{$isActive ? 'active' : ''}}"
                                               href="{{route($subItem['route_name'], $subItem['params'] ?? null)}}">
                                                @if(!empty($subItem['icon']))
                                                    {{--                                                    <span data-feather="{{$subItem['icon']}}"></span>--}}
                                                    <i class="{{$item['icon']}}"></i>
                                                @endif
                                                {{__($subItem['label'])}} <span class="sr-only">(current)</span>
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            @else
                                <a class=" {{$isActive ? 'active' : ''}}"
                                   href="{{route($item['route_name'], $subItem['params'] ?? null)}}">
                                    @if(!empty($item['icon']))
                                        {{--                                        <span data-feather="{{$item['icon']}}"></span>--}}
                                        <i class="{{$item['icon']}}"></i>
                                    @endif
                                    {{__($item['label'])}} <span class="sr-only">(current)</span>
                                </a>
                            @endif
                        </li>
                    @endforeach
                </ul>
            @endif


        @endforeach
    </div>
@endif

@push('scripts.body.bottom')
    <script>
        const headerApp = $('.headerApp').outerHeight();
        const footerApp = $('.footerApp').outerHeight();
        $('.main').css('min-height', 'calc(100vh - ' + (headerApp + footerApp) + 'px)');
    </script>

@endpush
