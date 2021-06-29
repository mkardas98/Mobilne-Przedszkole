@extends('layouts.application')

@section('content')
    <div class="pageNavigation">
        <span class="pageNavigation__title">Dodaj/edytuj zachowanie</span>
        <div class="pageNavigation__buttons">
            <a href="{{route('director.kids.show', ['id' => $kid_id])}}" class="primaryButton -red">Anuluj</a>
            <button type="submit" onclick="event.preventDefault(); document.getElementById('behaviorForm').submit();" class="primaryButton">Zapisz</button>
        </div>
    </div>
    <div class="row">
        @include('helpers.alert')
        <div class="col-12">
            <div class="card">
                <div class="card__body">
                    <form id="behaviorForm" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                {!! $form->renderFieldGroup('type') !!}
                            </div>
                            <div class="col-md-12">
                                {!! $form->renderFieldGroup('text') !!}
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

