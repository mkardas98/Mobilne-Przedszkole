@extends('layouts.app')

@section('content')
    @foreach($item->galleryItems as $galleryItem)
        <img src="{{renderImage($galleryItem->url, [80, 80, 'fit'])}}" alt="">
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
