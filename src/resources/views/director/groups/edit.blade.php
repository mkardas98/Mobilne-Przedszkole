@extends('layouts.application')

@section('content')
    <div class="pageNavigation">
        <span class="pageNavigation__title">Dodaj/edytuj grupę</span>
        <div class="pageNavigation__buttons">
            <a href="{{route('director.groups.index')}}" class="primaryButton -red">Anuluj</a>
            <button type="submit" onclick="event.preventDefault(); document.getElementById('groupForm').submit();" class="primaryButton">Zapisz</button>
        </div>
    </div>

    <div class="row">
        @include('helpers.alert')
        <div class="col-12">
            <div class="card">
                <div class="card__body">
                    <form id="groupForm" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                @include('helpers.input', ['name' => 'name', 'label'=>'Nazwa grupy', 'default'=>$obj->name])
                            </div>
                            <div class="col-md-6">
                                @include('helpers.input', ['name' => 'room', 'label'=>'Sala', 'default'=>$obj->room])
                            </div>
                            <div class="col-md-6">
                                <div class="checkbox-wrapper">
                                    <label class="custom-label">Opiekunowie grupy</label>
                                    {!! $errors->first('teachers', '<p class="help-block">:message</p>') !!}
                                    <div class="row mt-2">
                                        @foreach($teachers as $teacher)
                                            <div class="col-6">
                                                <label class="checkbox-label"><input type="checkbox" name="teachers[]" class="custom-input" @if(isset($obj->teachers)) @foreach($obj->teachers as $assignedTeacher) {{$assignedTeacher->user_id === $teacher->id ? 'checked="checked' : ''}} @endforeach @endif value="{{$teacher->id}}">{{$teacher->first_name}} {{$teacher->last_name}}</label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                @include('helpers.input', ['name' => 'color', 'label'=>'Kolor grupy', 'default'=>$obj->color, 'type'=>'color', 'class'=>'-color'])
                            </div>
                            <div class="col-md-3">
                                <div class="checkbox-wrapper">
                                    <label class="custom-label">Status grupy</label>
                                    <label class="checkbox-label mt-2"><input type="checkbox" name="status" class="custom-input" value="1" @if($obj->status) checked="checked" @endif>Widoczna - aktywna</label>
                                </div>
                            </div>


                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
