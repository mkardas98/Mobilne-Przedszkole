@extends('layouts.app')

@section('content')
<div style="text-align: center">
    <div>
        {!! $item->title !!}
    </div>
    <div>
        {!! $item->lead !!}
    </div>
    <div>
        {!! $item->text !!}
    </div>
</div>
@endsection
