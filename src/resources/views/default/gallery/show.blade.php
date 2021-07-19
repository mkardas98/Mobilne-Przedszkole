@extends('layouts.app')

@section('content')
    @foreach($item->galleryItems as $galleryItem)
    <div style="display: flex; flex-direction: column;  align-items: center; justify-content: center; width: 100%; margin-bottom: 2rem">
        <img src="{{renderImage($galleryItem->url, [800, 800, 'resize'])}}" style="max-width: 500px" alt="">

    </div>
    @endforeach
    <div>
        {!! $item->title !!}
    </div>
    <div>
        {!! $item->lead !!}
    </div>
    <div>
        {!! $item->text !!}
    </div>
@endsection
