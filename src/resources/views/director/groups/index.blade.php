@extends('layouts.application')

@section('content')
    <div class="pageNavigation">
        <span class="pageNavigation__title">
            Grupy
        </span>
        <div class="pageNavigation__buttons">
            <a href="{{route('director.groups.edit')}}" class="primaryButton">Dodaj nową grupę</a>
        </div>
    </div>

    <div class="row">
            <div class="col-lg-12">
                <div class="card">

                    <div class="card__body">
                        <table id="dataTable" class="table text-md-nowrap dataTable dtr-inline">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Nazwa</th>
                                <th>Sala</th>
                                <th>Opiekunowie</th>
                                <th>Status</th>
                                <th>Zarządzanie</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($items as $key=>$item)
                                <tr>
                                    <td>{{$key + 1}}</td>
                                    <td>{{$item->name}}</td>
                                    <td>{{$item->room}}</td>
                                    <td>
                                        @foreach($item->users as $user)
                                            <span>
                                                <small>
                                                    {{$user->first_name}} {{$user->last_name}}
                                                </small>
                                            </span>
                                        @endforeach
                                    </td>
                                    <td>{{$item->status}}</td>
                                    <td>
                                        <a href="{{route('director.groups.delete', ['id'=>$item->id])}}">Usuń</a>
                                        <a href="{{route('director.groups.edit', ['id'=>$item->id])}}">Edytuj</a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
    </div>
@endsection

@push('scripts.body.bottom')
    <script>
        $(document).ready(function() {
            $('#dataTable').DataTable();
        });
    </script>
@endpush
