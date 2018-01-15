@extends('admin.dashboard.pages')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="row">
                <h1 class="col-12 text-center">Kérdés törlés</h1>
                <div class="col-12">
                    <form action="{{ route('admin.questiondelete') }}" method="post" >
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="question">Csak azok a kérdések törölhetőek, amelyek jelenleg nincsenek használatban. Ez a törlés véglegesen eltávolítja az adatbázisból is a kérdést.</label>
                            <select class="form-control {{ $errors->has('question') ? ' is-invalid' : '' }}" id="question" name="question">
                                @foreach($questions as $question)
                                    <option value="{{$question->id}}">{{$question->question}}</option>
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