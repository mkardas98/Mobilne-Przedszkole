@extends('layouts.application')

@section('content')
    <div class="pageNavigation">
        <span class="pageNavigation__title">Edytuj plan dnia</span>
        <div class="pageNavigation__buttons">
            <a href="{{route('director.groups.show', ['id' => $group_id])}}" class="primaryButton -red">Cofnij</a>
            <button type="submit" onclick="event.preventDefault(); document.getElementById('lessonPlanForm').submit();"
                    class="primaryButton">Zapisz
            </button>
        </div>
    </div>
    <div class="row">

        @include('helpers.alert')
        <div class="col-12">
            <div class="card">
                <div class="card__body">
                    <form id="lessonPlanForm" class="lessonPlanEdit" method="post">
                        @csrf
                            @if($obj->id)
                                @foreach($obj->plan as $plan)
                                <div class="row align-items-center" id="stage{{$loop->iteration}}">
                                    <div class="col-md-1">
                                        <button class="controlButton -red" onclick="deleteStageItem(event, {{$loop->iteration}})"><i class="fas fa-ban"></i></button>
                                    </div>
                                <div class="col-md-3">
                                        <div class="input-wrapper">
                                            <label for="plan[{{$loop->iteration}}][time]" class="custom-label ">Czas trawania (od -
                                                do)</label>
                                            <input id="plan[{{$loop->iteration}}][time]" name="plan[{{$loop->iteration}}][time]" type="text"
                                                   class="custom-input" value="{{$plan['time']}}"
                                                   placeholder="Godzina"
                                            >
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="input-wrapper">
                                            <label for="plan[{{$loop->iteration}}][desc]" class="custom-label ">Opis</label>
                                            <textarea id="plan[{{$loop->iteration}}][desc]" name="plan[{{$loop->iteration}}][desc]" type="text"
                                                      class="custom-input"
                                                      placeholder="Opis"
                                            >{{$plan['desc']}}</textarea>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            @else
                                @for($i=0; $i<5; $i++)
                                    <div class="row align-items-center" id="stage{{$i}}">
                                        <div class="col-md-1">
                                            <button class="controlButton -red" onclick="deleteStageItem(event, {{$i}})"><i class="fas fa-ban"></i></button>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="input-wrapper">
                                                <label for="plan[{{$i}}][time]" class="custom-label ">Czas trawania (od -
                                                    do)</label>
                                                <input id="plan[{{$i}}][time]" name="plan[{{$i}}][time]" type="text"
                                                       class="custom-input"
                                                       placeholder="Godzina"
                                                >
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="input-wrapper">
                                                <label for="plan[{{$i}}][desc]" class="custom-label ">Opis</label>
                                                <textarea id="plan[{{$i}}][desc]" name="plan[{{$i}}][desc]" type="text"
                                                          class="custom-input"
                                                          placeholder="Opis"
                                                ></textarea>
                                            </div>
                                        </div>
                                    </div>
                                @endfor
                            @endif
                    </form>
                    <button class="primaryButton" onclick="addNewStage()">Dodaj kolejny etap</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts.body.bottom')

    <script>
        const container = $('#lessonPlanForm');

        let stage = {{$obj->id ? count($obj->plan) + 1 : 6}} ;

        const addNewStage = () => {

            const deleteButton = document.createElement('div')
             deleteButton.classList.add('col-md-1')
            deleteButton.innerHTML = `<button class="controlButton -red" onclick="deleteStageItem(event, ${stage})"><i class="fas fa-ban"></i></button>`
            const divTime  = document.createElement('div');
            divTime.classList.add('col-md-3');
            divTime.innerHTML = `<div class="input-wrapper"><label for="plan[${stage}][time]" class="custom-label ">Czas trawania (od - do)</label><input id="plan[${stage}][time]" name="plan[${stage}][time]" type="text"class="custom-input"placeholder="Godzina"></div>`

            const divDesc = document.createElement('div')
            divDesc.classList.add('col-md-8');
            divDesc.innerHTML = `<div class="input-wrapper"><label for="plan[${stage}][desc]" class="custom-label ">Opis</label><textarea id="plan[${stage}][desc]" name="plan[${stage}][desc]" type="text" class="custom-input" placeholder="Opis"></textarea></div>`

            const row  = document.createElement('div');
            row.classList.add('row');
            row.classList.add('align-items-center');
            row.id = `stage${stage}`

            row.append(deleteButton)
            row.append(divTime)
            row.append(divDesc)
            container.append(row)

            stage += 1;

        }

        const deleteStageItem = (e, number) => {
            e.preventDefault();
         $(`#stage${number}`).remove()
        }


    </script>

@endpush




