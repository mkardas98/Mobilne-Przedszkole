@extends('layouts.application')

@section('content')
    <div class="pageNavigation">
        <span class="pageNavigation__title">
            Dashboard
        </span>
    </div>

<div class="row">
    <div class="col-4">
        <div class="colorCard -blue">
            <div class="colorCard__header">
                <span class="colorCard__headerTitle">
                    Liczba aktywnych grup
                </span>
            </div>
            <div class="colorCard__body">
                <span class="colorCard__value">
                    {{$data['groups']}}
                </span>
            </div>
        </div>
    </div>
    <div class="col-4">
        <div class="colorCard -red">
            <div class="colorCard__header">
                <span class="colorCard__headerTitle">
                    Liczba dzieci
                </span>
            </div>
            <div class="colorCard__body">
                <span class="colorCard__value">
                    {{$data['kids']}}
                </span>
            </div>
        </div>
    </div>
    <div class="col-4">
        <div class="colorCard -green">
            <div class="colorCard__header">
                <span class="colorCard__headerTitle">
                    Liczba nauczycieli
                </span>
            </div>
            <div class="colorCard__body">
                <span class="colorCard__value">
                    {{$data['teachers']}}
                </span>
            </div>
        </div>
    </div>
    <div class="col-12">
        <div class="card">
            <div class="card__header">
                <span class="card__headerTitle">
                    Liczba wyświetleń strony przedszkola
                </span>
            </div>
            <div class="card__body">
                <canvas id="views" width="400" height="100"></canvas>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts.body.bottom')
    <script>
        new Chart(document.getElementById("views"), {
            type: 'line',
            data: {
                labels: [
                    @foreach($views as $view)
                        "{{$view->date}}",
                    @endforeach
                ],
                datasets: [{
                    data: [
                        @foreach($views as $view)
                            "{{$view->views}}",
                        @endforeach
                    ],
                    label: "Wyświetlenia",
                    borderColor: "#0162E8",
                    fill: false
                }
                ]
            },
            options: {
                title: {
                    display: true,
                    text: 'Liczba wyświetleń przedszkola'
                }
            }
        });
    </script>

@endpush



