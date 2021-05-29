@if (\Session::has('success'))
    <div class="col-lg-12">
        <div class="alert alert-success text-center mx-3">
            {!! \Session::get('success') !!}
        </div>
    </div>
@endif
@if (\Session::has('error'))
    <div class="col-lg-12">
        <div class="alert alert-danger text-center mx-3">
            {!! \Session::get('error') !!}
        </div>
    </div>
@endif
