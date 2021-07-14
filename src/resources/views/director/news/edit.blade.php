@extends('layouts.application')

@section('content')
    <div class="pageNavigation">
        <span class="pageNavigation__title">Dodaj/edytuj aktualność</span>
        <div class="pageNavigation__buttons">
            <a href="{{route('director.news.index')}}" class="primaryButton -red">Anuluj</a>
            <button type="submit" onclick="event.preventDefault(); document.getElementById('newsForm').submit();" class="primaryButton">Zapisz</button>
        </div>
    </div>
    <form id="newsForm" method="post" enctype="multipart/form-data">
        @csrf

        <div class="row">
        @include('helpers.alert')
        <div class="col-md-6">
            <div class="card">
                <div class="card__body">
                    {!! $form->renderFieldGroup('title') !!}
                    {!! $form->renderFieldGroup('lead') !!}
                    <div class="checkbox-wrapper">
                        <label class="custom-label">Status</label>
                        <label class="checkbox-label mt-2"><input type="checkbox" name="status" class="custom-input" value="1" @if($obj->status) checked="checked" @endif>Widoczna - aktywna</label>
                    </div>
                </div>
            </div>
        </div>
            <div class="col-md-6">
               @include('helpers.form.seo', ['form'=>$seoForm])
            </div>
            <div class="col-12">
                <div class="card">
                    <div class="card__body">
                        {!! $form->renderFieldGroup('text') !!}
                    </div>
                </div>
            </div>
    </div>
    </form>

@endsection
