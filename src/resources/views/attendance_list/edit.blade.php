

@extends('layouts.application')

@section('content')
    @include('helpers.alert')
    <div class="pageNavigation">
        <span class="pageNavigation__title">Lista obecności - {{date('d/m/Y', strtotime($date))}}</span>
        <div class="pageNavigation__buttons">
            <a href="{{url()->previous()}}" class="primaryButton -red">Powrót</a>
            <button type="submit" onclick="event.preventDefault(); document.getElementById('attendanceList').submit();" class="primaryButton">Zapisz</button>
        </div>
    </div>
    <div class="row">
        @include('helpers.alert')
        <div class="col-12">
            <form action="{{route('attendance_list.edit', ['group_id' => $group_id, 'date'=>$date])}}" method="post" id="attendanceList">
                @csrf
            <table class="styled-table">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Imię i nazwisko</th>
                    <th>Obecność</th>
                </tr>
                </thead>
                <tbody>
                  @foreach($kids as $key=>$kid)
                      <tr>
                          <td>{{$key+1}}</td>
                          <td>{{$kid->first_name.''.$kid->last_name}}</td>
                          <td>
                              <label class="switch">
                                  <input type='hidden' value='0' name='attendance_list[{{$kid->id}}][{{$date}}]'>
                                  <input name="attendance_list[{{$kid->id}}][{{$date}}]" hidden value="1" type="checkbox" @if(isset($kid->attendance_list[$date])){{$kid->attendance_list[$date] ? 'checked' : ''}} @else checked @endif />
                                  <span class="slider round"></span>
                              </label>
                          </td>
                      </tr>
                  @endforeach
                </tbody>
            </table>
            </form>
        </div>
    </div>
@endsection


