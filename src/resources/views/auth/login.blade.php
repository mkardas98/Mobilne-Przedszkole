@extends('layouts.application')

@section('content')


    <section class="loginSection">
        <div class="loginSection__image"></div>
        <div class="loginSection__form">

            <div class="loginSection__text">
                <span class="loginSection__title">{{__('Zaloguj się do')}}</span>
                <span class="loginSection__subTitle">{{__('Mobilnego Przedszkola')}}</span>
            </div>

            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="loginSection__loginInputs -login">
                  <div class="loginSection__input -login">
                      <input id="login" type="login" class="form-control @error('login') is-invalid @enderror"
                             name="login" value="{{ old('login') }}" required autofocus placeholder="{{__('Login lub adres e-mail')}}">
                  </div>
                    <div class="loginSection__input -password">
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                           name="password" required autocomplete="current-password"  placeholder="{{__('Hasło')}}">
                    </div>
                    @if (\Session::has('error'))
                        <div class="alert alert-danger">
                                {!! \Session::get('error') !!}
                        </div>
                    @endif

                    <input class="inp-cbx" id="remember" type="checkbox" name="remember"
                           style="display: none;" {{ old('remember') ? 'checked' : '' }}>
                    <label class="cbx" for="remember"><span>
    <svg width="12px" height="9px" viewBox="0 0 12 9">
      <polyline points="1 5 4 8 11 1"></polyline>
    </svg></span><span>{{ __('Zapamiętaj mnie') }}</span></label>


                </div>


                <button type="submit" class="primaryButton">
                    {{ __('Zaloguj się') }}
                </button>

                @if (Route::has('password.request'))
                    <a class="primaryButton -dark" href="{{ route('password.request') }}">
                        {{ __('Nie pamiętasz hasła?') }}
                    </a>
                @endif

            </form>
        </div>
    </section>



@endsection

@push('scripts.body.bottom')
    <script>
        const headerApp = $('.headerApp').outerHeight();
        const footerApp = $('.footerApp').outerHeight();
        $('.main').css('min-height', 'calc(100vh - ' + (headerApp + footerApp) + 'px)');
    </script>

@endpush
