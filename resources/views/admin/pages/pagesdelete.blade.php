@extends('admin.dashboard.pages')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="row">
                <h1 class="col-12 text-center">Kérdőív lap törlés</h1>
                <div class="col-12">
                    <form action="{{ route('admin.pagedelete') }}" method="post" >
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="question">Csak azok a kérdőív lapok törölhetőek, amelyek jelenleg nincsenek használatban. Ez a törlés véglegesen eltávolítja az adatbázisból is a kérdőív lapot.
                            Abban az esetben ha kérdőív lap kérdést tartalmaz, a kérdés felszabadul és újból felhasználhatóvá válik.</label>
                            <select class="form-control {{ $errors->has('page') ? ' is-invalid' : '' }}" id="page" name="page">
                                @foreach($pages as $page)
                                    <option value="{{$page->id}}">{{$page->page_name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <input class="btn btn-primary" type="submit" value="Törlés">
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection