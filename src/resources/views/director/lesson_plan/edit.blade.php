

@extends('layouts.application')

@section('content')
    <div class="pageNavigation">
        <span class="pageNavigation__title">Dodaj/edytuj plan dnia</span>
        <div class="pageNavigation__buttons">
            <a href="{{route('director.groups.show', ['id' => $group_id])}}" class="primaryButton -red">Anuluj</a>
            <button type="submit" onclick="event.preventDefault(); document.getElementById('lessonPlanForm').submit();" class="primaryButton">Zapisz</button>
        </div>
    </div>
    <div class="row">
        @include('helpers.alert')
        <div class="col-12">
            <div class="card">
                <div class="card__body">
                    <form id="lessonPlanForm" class="lessonPlanEdit" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                {!! $form->renderFieldGroup('date') !!}
                            </div>
                        </div>
                      @for($i = 1; $i<=7; $i++)
                            <div class="row">
                                <div class="col-12"><span class="lessonPlanEdit__header">Lekcja {{$i}}</span></div>
                                <div class="col-md-4">
                                    <div class="input-wrapper">
                                        <label for="plan[{{$i}}][time]" class="custom-label ">Czas trawania (od - do)</label>
                                        <input id="plan[{{$i}}][time]" name="plan[{{$i}}][time]" type="text" value="{{$obj->plan[$i]['time'] ?? ''}}"
                                               class="custom-input {{$errors->first('plan['. $i .'][time]') ? ' form-error' : ''}}" placeholder="Czas trawania (od - do)"
                                        >
                                        {!! $errors->first('plan['. $i .'][time]', '<p class="help-block">:message</p>') !!}
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="input-wrapper">
                                        <label for="plan[{{$i}}][name]" class="custom-label ">Nazwa zajęć</label>
                                        <input id="plan[{{$i}}][name]" name="plan[{{$i}}][name]" type="text" value="{{$obj->plan[$i]['name'] ?? ''}} "
                                               class="custom-input {{$errors->first('plan['. $i .'][name]') ? ' form-error' : ''}}" placeholder="Nazwa zajęć"
                                        >
                                        {!! $errors->first('plan['. $i .'][name]', '<p class="help-block">:message</p>') !!}
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="input-wrapper">
                                        <label for="plan[{{$i}}][teacher]" class="custom-label ">Prowadzący</label>
                                        <select id="plan[{{$i}}][teacher]" name="plan[{{$i}}][teacher]" class="custom-input" @foreach($teachers as $ruleName=>$ruleValue) {{$ruleName}}="{{$ruleValue}}" @endforeach>
                                        <option value="" selected>Wybierz</option>
                                        @foreach($teachers as $optionValue)
                                            <option value="{{$optionValue->first_name}} {{$optionValue->last_name}} " {{$obj->plan[$i]['teacher'] ?? '' == $optionValue->first_name . ' ' . $optionValue->last_name ? 'selected=selected' : ''}}>{{$optionValue->first_name . ' ' . $optionValue->last_name}}</option>
                                            @endforeach
                                            </select>

                                        {!! $errors->first('plan['. $i .'][name]', '<p class="help-block">:message</p>') !!}
                                    </div>
                                </div>
                            </div>
                        @endfor
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection


