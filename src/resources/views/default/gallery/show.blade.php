@extends('layouts.app')

@section('content')
    @dump($item->text)
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
