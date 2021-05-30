@extends('layouts.application')
@section('content')
<section class="profileShow">
    <div class="pageNavigation">
        <span class="pageNavigation__title">
            Twój profil
        </span>

    </div>
  <div class="row justify-content-center">
      @include('helpers.alert')
      <div class="col-lg-12">
          <div class="card">
              <div class="card__header">
                <span class="card__headerTitle">
                    Aktualne dane twojego profilu
                </span>
                  <div class="card__buttons">
                      <a href="{{route('profile.edit')}}" class="primaryButton">Edytuj</a>
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
                                        Imię:
                                    </span>
                                        <span class="profileShow__value">
                                        {{$profile->first_name}}
                                    </span>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="profileShow__info">
                                    <span class="profileShow__name">
                                        Nazwisko:
                                    </span>
                                        <span class="profileShow__value">
                                        {{$profile->last_name}}
                                    </span>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="profileShow__info">
                                    <span class="profileShow__name">
                                        Numer telefonu:
                                    </span>
                                        <span class="profileShow__value">
                                        {{$profile->phone}}
                                    </span>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="profileShow__info">
                                    <span class="profileShow__name">
                                        Adres e-mail:
                                    </span>
                                        <span class="profileShow__value">
                                        {{$profile->email}}
                                    </span>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="profileShow__info">
                                    <span class="profileShow__name">
                                      Data urodzenia:
                                    </span>
                                        <span class="profileShow__value">
                                        {{date('d/m/Y', strtotime($profile->date_of_birth))}}
                                    </span>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="profileShow__info">
                                    <span class="profileShow__name">
                                      Adres zamiesznia:
                                    </span>
                                        <span class="profileShow__value">
                                        {{$profile->address}}
                                    </span>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="profileShow__info">
                                    <span class="profileShow__name">
                                      PESEL:
                                    </span>
                                        <span class="profileShow__value">
                                        {{$profile->pesel}}
                                    </span>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="profileShow__info">
                                    <span class="profileShow__name">
                                       Typ konta:
                                    </span>
                                        <span class="profileShow__value">
                                        @if($profile->role === 0)
                                                Dyrektor
                                            @elseif($profile->role === 1)
                                                Nauczyciel
                                            @else
                                                Opiekun/Rodzic
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
