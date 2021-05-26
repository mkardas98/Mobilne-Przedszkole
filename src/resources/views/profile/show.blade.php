@extends('layouts.application')
@section('content')
<section class="profileShow">
    <div class="pageNavigation">
        <span class="pageNavigation__title">
            {{__('Twój profil')}}
        </span>

    </div>
  <div class="row justify-content-center">
      <div class="col-lg-9">
          <div class="card">
              <div class="card__header">
                <span class="card__headerTitle">
                    {{__('Aktualne dane twojego profilu')}}
                </span>
                  <div class="card__buttons">
                      <a href="{{route('profile_edit.show')}}" class="primaryButton">{{__('Edytuj')}}</a>
                  </div>
              </div>
              <div class="card__body">
                <div class="row">
                    <div class="col-lg-4">
                       <div class="profileShow__avatar">
                           @if(!(is_null($profile->avatar)))
                               <img src="{{renderImage($profile->avatar, [300,300, 'fit'])}}" alt="">
                           @else
                               <img src="{{asset('images/app/profile/empty-avatar.jpg')}}" alt="">
                           @endif
                       </div>
                    </div>
                    <div class="col-lg-8">
                        <div class="profileShow__details">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="profileShow__info">
                                    <span class="profileShow__name">
                                        {{__('Imię')}}:
                                    </span>
                                        <span class="profileShow__value">
                                        {{$profile->first_name}}
                                    </span>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="profileShow__info">
                                    <span class="profileShow__name">
                                        {{__('Nazwisko')}}:
                                    </span>
                                        <span class="profileShow__value">
                                        {{$profile->last_name}}
                                    </span>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="profileShow__info">
                                    <span class="profileShow__name">
                                        {{__('Numer telefonu')}}:
                                    </span>
                                        <span class="profileShow__value">
                                        {{$profile->phone}}
                                    </span>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="profileShow__info">
                                    <span class="profileShow__name">
                                        {{__('Adres e-mail')}}:
                                    </span>
                                        <span class="profileShow__value">
                                        {{$profile->email}}
                                    </span>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="profileShow__info">
                                    <span class="profileShow__name">
                                      {{__('Data urodzenia')}}:
                                    </span>
                                        <span class="profileShow__value">
                                        {{date('d/m/Y', strtotime($profile->date_of_birth))}}
                                    </span>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="profileShow__info">
                                    <span class="profileShow__name">
                                       {{__('Typ konta')}}:
                                    </span>
                                        <span class="profileShow__value">
                                        @if($profile->role === 0)
                                                {{__('Dyrektor')}}
                                            @elseif($profile->role === 1)
                                                {{__('Nauczyciel')}}
                                            @else
                                                {{__('Opiekun/Rodzic')}}
                                            @endif

                                    </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
              </div>

          </div>
      </div>
  </div>

</section>

@endsection
