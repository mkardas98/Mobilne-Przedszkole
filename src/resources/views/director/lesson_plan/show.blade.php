

@extends('layouts.application')

@section('content')
    @include('helpers.alert')
    <div class="pageNavigation">
        <span class="pageNavigation__title">Plan na dzień: {{date('d/m/Y', strtotime($obj->date))}}</span>
        <div class="pageNavigation__buttons">
            <a href="{{url()->previous()}}" class="primaryButton -red">Powrót</a>
        </div>
    </div>
    <div class="row">
        @include('helpers.alert')
        <div class="col-12">
            <table class="styled-table">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Godzina</th>
                    <th>Nazwa zajęć</th>
                    <th>Prowadzący</th>
                </tr>
                </thead>
                <tbody>
                @foreach($obj->plan as $key=>$item)
                    <tr>
                        <td><strong>{{$key}}</strong></td>
                        <td>{{$item['time']}}</td>
                        <td>{{$item['name']}}</td>
                        <td>{{$item['teacher']}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection


