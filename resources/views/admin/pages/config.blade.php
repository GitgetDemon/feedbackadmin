@extends('admin.dashboard.pages')

@section('content')
    <div class="row">
        <h1 class="col-12 text-center">Egyéb beállítások</h1>
        <div class="col-12">
            <form action="{{ route('admin.settingsStoreMail') }}" method="post" >
                {{ csrf_field() }}
                <div class="col-6 form-group">
                    <label for="mail" class="col-form-label">
                        E-mail cím amelyre a válaszok érkeznek
                    </label>
                    <input type="text" name="mail" class="form-control" value="{{ $mail }}">
                    @if ($errors->has('mail'))
                        <span class="help-block">
                            <strong>E-mail mező kitöltése kötelező</strong>
                        </span>
                    @endif
                </div>
                <div class="col-12 form-group">
                    <input type="submit" class="btn btn-info" value="Mentés">
                </div>
            </form>
        </div>
        <div class="col-12">
            <form action="{{ route('admin.settingsStoreGooglelink') }}" method="post" >
                {{ csrf_field() }}
                <div class="col-6 form-group">
                    <label for="googlelink" class="col-form-label">
                        Google értékelő hivatkozás (Abszolút URL)
                    </label>
                    <input type="text" name="googlelink" class="form-control" value="{{ $googlelink }}" placeholder="https://www.google.com">
                    @if ($errors->has('googlelink'))
                        <span class="help-block">
                            <strong>A google értékelő hivatkozás kitöltése kötelező</strong>
                        </span>
                    @endif
                </div>
                <div class="col-12 form-group">
                    <input type="submit" class="btn btn-info" value="Mentés">
                </div>
            </form>
        </div>
        <div class="col-12">
            <form action="{{ route('admin.settingsStoreGreetings') }}" method="post" >
                {{ csrf_field() }}
                <div class="col-6 form-group">
                    <label for="greetings" class="col-form-label">
                        Üdvözlő üzenet a kérdőív elkezdésekor
                    </label>
                    <textarea name="greetings" id="greetings" cols="30" rows="10" class="form-control">{{ $greetings }}</textarea>
                </div>
                <div class="col-12 form-group">
                    <input type="submit" class="btn btn-info" value="Mentés">
                </div>
            </form>
        </div>
        <div class="col-12">
            <form action="{{ route('admin.settingsStoreRegards') }}" method="post" >
                {{ csrf_field() }}
                <div class="col-6 form-group">
                    <label for="regards" class="col-form-label">
                        Köszönetnyilvánító üzenet a kérdőív befejezésekor
                    </label>
                    <textarea name="regards" id="regards" cols="30" rows="10" class="form-control">{{ $regards }}</textarea>
                </div>
                <div class="col-12 form-group">
                    <input type="submit" class="btn btn-info" value="Mentés">
                </div>
            </form>
        </div>
    </div>
@endsection