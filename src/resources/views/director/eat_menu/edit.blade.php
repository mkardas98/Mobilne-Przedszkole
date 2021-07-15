@extends('layouts.application')
@section('content')


    <div class="pageNavigation">
        <span class="pageNavigation__title">Dodaj/edytuj jadłospis</span>
        <div class="pageNavigation__buttons">
            <a href="{{route('director.eat_menu.index')}}" class="primaryButton -red">Cofnij</a>
            <button type="submit" onclick="event.preventDefault(); document.getElementById('eatMenu').submit();"
                    class="primaryButton">Zapisz
            </button>
        </div>
    </div>
    <div class="row">
        @include('helpers.alert')
        <div class="col-12">
            <div class="card">
                <div class="card__body">
                    <form id="eatMenu" class="eatMenu" method="post">
                        @csrf
                        <div class="row justify-content-center">
                            <div class="col-md-4">
                                {!! $form->renderFieldGroup('date') !!}
                            </div>
                        </div>
                        <div class="row justify-content-center">
                            <div class="col-md-6">
                                <div class="input-wrapper">
                                    <label for="eats[breakfast]" class="custom-label ">Śniadanie</label>
                                    <textarea id="eats[breakfast]" name="eats[breakfast]"
                                              class="custom-input {{$errors->first('eats[breakfast]') ? ' form-error' : ''}}" placeholder="Śniadanie" rows="10">{{$obj->eats['breakfast'] ?? ''}}</textarea>{!! $errors->first('eats[breakfast]', '<p class="help-block">:message</p>') !!}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-wrapper">
                                    <label for="eats[breakfast2]" class="custom-label ">Śniadanie II</label>
                                    <textarea id="eats[breakfast2]" name="eats[breakfast2]"
                                              class="custom-input {{$errors->first('eats[breakfast2]') ? ' form-error' : ''}}" placeholder="Śniadanie II" rows="10">{{$obj->eats['breakfast2'] ?? ''}}</textarea>{!! $errors->first('eats[breakfast2]', '<p class="help-block">:message</p>') !!}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-wrapper">
                                    <label for="eats[dinner]" class="custom-label ">Obiad</label>
                                    <textarea id="eats[dinner]" name="eats[dinner]"
                                              class="custom-input {{$errors->first('eats[dinner]') ? ' form-error' : ''}}" placeholder="Obiad" rows="10">{{$obj->eats['dinner'] ?? ''}}</textarea>
                                    {!! $errors->first('eats[dinner]', '<p class="help-block">:message</p>') !!}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-wrapper">
                                    <label for="eats[tea]" class="custom-label ">Podwieczorek</label>
                                    <textarea id="eats[tea]" name="eats[tea]"
                                              class="custom-input {{$errors->first('eats[tea]') ? ' form-error' : ''}}" placeholder="Podwieczorek" rows="10">{!! $obj->eats['tea'] ?? '' !!}</textarea>
                                    {!! $errors->first('eats[tea]', '<p class="help-block">:message</p>') !!}
                                </div>

                            </div>

                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection


