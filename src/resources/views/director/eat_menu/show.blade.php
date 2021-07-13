@extends('layouts.application')

@section('content')
<section class="eatMenuShow">
    <h1 class="eatMenuShow__title">
        Jadłospis - {{date('d/m/Y', strtotime($item->date))}}
    </h1>

    <div class="row">
        <div class="col-lg-7">
            <div class="eatMenuShow__item">
                <div class="eatMenuShow__header">
                    <div class="eatMenuShow__count">
                        <span>1</span>
                    </div>
                    <span class="eatMenuShow__itemTitle">Śniadanie</span>
                </div>
                <div class="eatMenuShow__body">
                    <span class="eatMenuShow__text">
                        {!! $item->eats['breakfast'] !!}
                    </span>
                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-end">
        <div class="col-lg-7">
            <div class="eatMenuShow__item">
                <div class="eatMenuShow__header">
                    <div class="eatMenuShow__count">
                        <span>2</span>
                    </div>
                    <span class="eatMenuShow__itemTitle">Śniadanie II</span>
                </div>
                <div class="eatMenuShow__body">
                    <span class="eatMenuShow__text">
                        {!! $item->eats['breakfast2'] !!}
                    </span>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-7">
            <div class="eatMenuShow__item">
                <div class="eatMenuShow__header">
                    <div class="eatMenuShow__count">
                        <span>3</span>
                    </div>
                    <span class="eatMenuShow__itemTitle">Obiad</span>
                </div>
                <div class="eatMenuShow__body">
                    <span class="eatMenuShow__text">
                        {!! $item->eats['dinner'] !!}
                    </span>
                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-end">
        <div class="col-lg-7">
            <div class="eatMenuShow__item">
                <div class="eatMenuShow__header">
                    <div class="eatMenuShow__count">
                        <span>4</span>
                    </div>
                    <span class="eatMenuShow__itemTitle">Podwieczorek</span>
                </div>
                <div class="eatMenuShow__body">
                    <span class="eatMenuShow__text">
                        {!! $item->eats['tea'] !!}
                    </span>
                </div>
            </div>
        </div>
    </div>
</section>



@endsection

@push('scripts.body.bottom')

@endpush
