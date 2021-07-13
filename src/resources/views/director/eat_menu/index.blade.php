@extends('layouts.application')

@section('content')
    <section class="eatMenuIndex">

        <div class="pageNavigation">
        <span class="pageNavigation__title">
            Jadłospis
        </span>
            <div class="pageNavigation__buttons">
                <a href="{{route('director.eat_menu.edit')}}" class="primaryButton">Dodaj nowy dzień</a>
            </div>
        </div>

        <div class="row">
            @include('helpers.alert')
            <div class="col-lg-12">
                <div class="card">

                    <div class="card__body">
                        <table id="dataTable" class="ui celled table">
                            <thead>
                            <tr>
                                <th><i class="fas fa-hashtag"></i></th>
                                <th>Data</th>
                                <th><i class="fas fa-cogs"></i> Zarządzanie</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($items as $key=>$item)
                                <tr>
                                    <td>{{$key + 1}}</td>
                                    <td> {{date('d/m/Y', strtotime($item->date))}}</td>
                                    <td class="tableButtons">
                                        <a class="controlButton -blue" href="{{route('director.eat_menu.edit', ['id'=>$item->id])}}"><i class="far fa-edit"></i></a>
                                        @php($delete = route('director.eat_menu.delete', $item->id))
                                        <button class="controlButton -red" onclick="deleteItem('{{$delete}}')"><i class="fas fa-ban"></i></button>
                                        <a class="controlButton -green" href="{{route('director.eat_menu.show', ['id'=>$item->id])}}"><i class="far fa-hand-pointer"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>

    </section>
@endsection

@push('scripts.body.bottom')
    <script>
        $(document).ready(function() {
            $('#dataTable').DataTable();
        });
    </script>
@endpush
