@extends('layouts.application')

@section('content')
    <section class="directorGroupsIndex">

        <div class="pageNavigation">
        <span class="pageNavigation__title">
           Galerie
        </span>
            <div class="pageNavigation__buttons">
                <a href="{{route('director.gallery.edit')}}" class="primaryButton">Dodaj nową galerię</a>
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
                                <th>Tytuł</th>
                                <th>Wprowadzenie</th>
                                <th>URL</th>
                                <th>Data utworzenia</th>
                                <th>Status</th>
                                <th><i class="fas fa-cogs"></i> Zarządzanie</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($items as $key=>$item)
                                <tr>
                                    <td>{{$key + 1}}</td>
                                    <td>{{$item->title}}</td>
                                    <td><small>{{$item->lead}}</small></td>
                                    <td><small>
                                            @if($item->status)
                                                <a href="{{route('gallery.show.'.$item->id)}}" title="{{$item->title}}" target="_blank">{{$item->seo->seo_url}}</a>
                                            @else
                                                {{$item->seo->seo_url}}
                                            @endif
                                        </small></td>
                                    <td>{{date('d/m/Y', strtotime($item->created_at))}}</td>
                                    <td>
                                        @if($item->status)
                                            <i class="fas fa-eye active"></i>
                                        @else
                                            <i class="fas fa-eye-slash not-active"></i>
                                        @endif
                                    </td>
                                    <td class="tableButtons">
                                        <a class="controlButton -blue" href="{{route('director.gallery.edit', ['id'=>$item->id])}}"><i class="far fa-edit"></i></a>
{{--                                        @php($delete = route('director.news.delete', $item->id))--}}
{{--                                        <button class="controlButton -red" onclick="deleteItem('{{$delete}}')"><i class="fas fa-ban"></i></button>--}}
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
