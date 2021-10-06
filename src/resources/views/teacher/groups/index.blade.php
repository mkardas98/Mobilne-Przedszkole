@extends('layouts.application')

@section('content')
<section class="directorGroupsIndex">

    <div class="pageNavigation">
        <span class="pageNavigation__title">
            Grupy
        </span>
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
                            <th>Kolor</th>
                            <th>Nazwa</th>
                            <th>Sala</th>
                            <th>Opiekunowie</th>
                            <th><i class="fas fa-cogs"></i> Zarządzanie</th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($items as $key=>$item)
                            <tr>
                                <td>{{$key + 1}}</td>
                                <td><i class="fas fa-tint colorGroup" style="color: {{$item->color}}"></i></td>
                                <td>{{$item->name}}</td>
                                <td>{{$item->room}}</td>
                                <td>
                                    @foreach($item->users as $user)
                                        <span>
                                                  @if($user->id === \Illuminate\Support\Facades\Auth::id())
                                                <b>{{$user->first_name}} {{$user->last_name}}</b>
                                            @else
                                                {{$user->first_name}} {{$user->last_name}}
                                                      @endif
                                            </span>
                                    @endforeach
                                </td>
                                <td class="tableButtons">
                                    <a class="controlButton -green" href="{{route('director.groups.show', ['id'=>$item->id])}}"><i class="far fa-hand-pointer"></i></a>
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
