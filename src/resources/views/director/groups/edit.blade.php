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
                                {!! $form->renderFieldGroup('name') !!}

                            </div>
                            <div class="col-md-6">
                                {!! $form->renderFieldGroup('room') !!}

                            </div>
                            <div class="col-md-6">
                                {!! $form->renderFieldGroup('teachers') !!}
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
