@extends('layouts.application')
@section('content')
    <div class="pageNavigation">
        <span class="pageNavigation__title">Dane przedszkola</span>
        <div class="pageNavigation__buttons">
            <button type="submit" onclick="event.preventDefault(); document.getElementById('kindergartenData').submit();" class="primaryButton">Zapisz</button>
        </div>
    </div>
    <div class="row">
        @include('helpers.alert')
        <div class="col-12">
            <div class="card">
                <div class="card__body">
                    <form id="kindergartenData" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                {!! $form->renderFieldGroup('name_kindergarten') !!}
                            </div>
                            <div class="col-md-6">
                                {!! $form->renderFieldGroup('type_kindergarten') !!}
                            </div>
                             <div class="col-md-6">
                                {!! $form->renderFieldGroup('phone_kindergarten') !!}
                            </div>
                             <div class="col-md-6">
                                {!! $form->renderFieldGroup('email_kindergarten') !!}
                            </div>
                             <div class="col-md-12">
                                {!! $form->renderFieldGroup('address_kindergarten') !!}
                            </div>
                            <div class="col-md-6">
                                {!! $form->renderFieldGroup('city_kindergarten') !!}
                            </div>
                            <div class="col-md-6">
                                {!! $form->renderFieldGroup('post_code_kindergarten') !!}
                            </div>


                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
