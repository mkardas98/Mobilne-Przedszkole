

    @extends('layouts.application')

@section('content')
    <div class="pageNavigation">
        <span class="pageNavigation__title">Dodaj/edytuj ogłoszenie</span>
        <div class="pageNavigation__buttons">
            <a href="{{route('director.groups.show', ['id' => $group_id])}}" class="primaryButton -red">Anuluj</a>
            <button type="submit" onclick="event.preventDefault(); document.getElementById('announcementForm').submit();" class="primaryButton">Zapisz</button>
        </div>
    </div>
    <div class="row">
        @include('helpers.alert')
        <div class="col-12">
            <div class="card">
                <div class="card__body">
                    <form id="announcementForm" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                {!! $form->renderFieldGroup('title') !!}
                            </div>
                            <div class="col-md-12">
                                {!! $form->renderFieldGroup('text') !!}
                            </div>
                            <div class="col-md-12">
                                <div class="checkbox-wrapper">
                                    <label class="custom-label">Status ogłoszenia</label>
                                    <label class="checkbox-label mt-2"><input type="checkbox" name="status" class="custom-input" value="1" @if($obj->status) checked="checked" @endif>Widoczna - aktywna</label>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection


