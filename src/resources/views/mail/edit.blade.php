@extends('layouts.application')
@section('content')
<section class="MailConfig">
    <div class="pageNavigation">
        <span class="pageNavigation__title">
            Ustawienia poczty
        </span>
        <div class="pageNavigation__buttons">
            <button onclick="event.preventDefault(); document.getElementById('mailForm').submit();" class="primaryButton ">Zapisz</button>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card__body">
                    <form action="{{route('director.configuration.email')}}" method="POST" id="mailForm" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-lg-6">
                                @include('helpers.input', ['name' => 'from_name', 'label' => 'Nadawca - nazwa', 'default' => $obj->from_name])
                            </div>
                            <div class="col-lg-6">
                                @include('helpers.input', ['name' => 'from_address', 'label' => 'Nadawca - Adres e-mail', 'default' => $obj->from_address])
                            </div>
                            <div class="col-lg-6">
                                @include('helpers.input', ['name' => 'host', 'label' => 'Host', 'default' => $obj->host])
                            </div>
                            <div class="col-lg-3">
                                @include('helpers.input', ['name' => 'port', 'label' => 'Port', 'default' => $obj->port])
                            </div>
                            <div class="col-lg-3">
                                @include('helpers.input', ['name' => 'encryption', 'label' => 'Szyfrowanie', 'default' => $obj->encryption])
                            </div>
                            <div class="col-lg-6">
                                @include('helpers.input', ['name' => 'user_name', 'label' => 'Login', 'default' => $obj->user_name])
                            </div>
                            <div class="col-lg-6">
                                @include('helpers.input', ['name' => 'password', 'label' => 'Hasło', 'default' => $obj->password])
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
