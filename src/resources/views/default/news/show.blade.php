@extends('layouts.app')

@section('content')
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
