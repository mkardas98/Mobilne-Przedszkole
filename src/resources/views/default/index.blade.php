@extends('layouts.default')

@section('content')
    <header class="header">
        <div class="container">
            <div class="header__content">
                <nav class="nav">
                    <ul>
                        <li><a href="">Strona główna</a></li>
                        <li><a href="">Aktualności</a></li>
                        <li><a href="">Galeria</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </header>
    <section class="start">
        <img src="{{asset('images/header.svg')}}" class="start__image" alt="">
    </section>
@endsection
