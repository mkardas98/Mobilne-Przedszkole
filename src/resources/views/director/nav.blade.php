@if(count($navSections) > 0)
    @foreach($navSections as $sectionKey => $section)

        @if(!empty($section['label']))
            <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
                <span>{{__($section['label'])}}</span>
                @if(!empty($section['icon']))
                    <a class="d-flex align-items-center text-muted" href="#" aria-label="Add a new report">
                        <span data-feather="{{$section['icon']}}"></span>
                    </a>
                @endif
            </h6>
        @endif


        @if(count($section['items']) > 0)
            <ul class="nav flex-column {{$sectionKey > 0 ? 'mb-2' : ''}}">
                @foreach($section['items'] as $item)
                    @php
                        $isActive = str_starts_with($item['route_name'], str_replace(['edit', 'create', 'index', 'show'], '', request()->route()->getName()));
                    @endphp
                    <li class="nav-item">
                        @if(isset($item['items']))
                            <button class="nav-link">
                                @if(!empty($item['icon']))
                                    <span data-feather="{{$item['icon']}}"></span>
                                @endif
                                {{__($item['label'])}} <span class="sr-only">(current)</span>
                            </button>
                            <ul class="nav @foreach($item['items'] as $subItem)
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
                                        <a class="nav-link {{$isActive ? 'active' : ''}}" href="{{route($subItem['route_name'], $subItem['params'] ?? null)}}">
                                            @if(!empty($subItem['icon']))
                                                <span data-feather="{{$subItem['icon']}}"></span>
                                            @endif
                                            {{__($subItem['label'])}} <span class="sr-only">(current)</span>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            <a class="nav-link {{$isActive ? 'active' : ''}}" href="{{route($item['route_name'], $subItem['params'] ?? null)}}">
                                @if(!empty($item['icon']))
                                    <span data-feather="{{$item['icon']}}"></span>
                                @endif
                                {{__($item['label'])}} <span class="sr-only">(current)</span>
                            </a>
                        @endif
                    </li>
                @endforeach
            </ul>
        @endif


    @endforeach
@endif
