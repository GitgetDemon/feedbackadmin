@inject('QuestionFormatter','App\Lib\Formatters\QuestionFormatter')
@extends('admin.dashboard.pages')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="row modpages">
                <h1 class="col-12 text-center">Kiválaszott kérdőív lap módosítása</h1>
                <div class="col-12 border border-warning mx-auto my-2">
                    <form action="{{ route('admin.chosePageModifyText') }}" method="post" >
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="page_name">Kérdőív lap megnevezése</label>
                            <input type="text" name="page_name" value="{{$selectedPage->page_name}}" class="form-control {{ $errors->has('page_name') ? ' is-invalid' : '' }}" id="page_name">
                        </div>
                        <div class="form-group">
                            <label for="page_text">Kérdőív lap ismertetés</label>
                            <textarea name="page_text" id="page_text" cols="30" rows="10" class="form-control">{{$selectedPage->page_text}}</textarea>
                        </div>
                        <input type="hidden" name="id" value="{{$selectedPage->id}}">
                        <input class="btn btn-primary" type="submit" value="Kérdőív lap módosítása">
                    </form>
                </div>
                <table class="table table-striped table-bordered">
                    <thead class="thead-dark">
                    <tr>
                        <th scope="col">Kérdés</th>
                        <th scope="col">Válasz típusa</th>
                        <th scope="col">Sorrend</th>
                        <th scope="col">Művelet</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($selectedQuestions as $selectedQuestion)
                            <tr>
                                <td>{{ $selectedQuestion->question }}</td>
                                <td>{{ $QuestionFormatter->format($selectedQuestion->answer_type) }}</td>
                                <td>{{ $selectedQuestion->order }}</td>
                                <td>
                                    <form action="{{ route('admin.chosePageDeleteQuestion') }}" method="post" >
                                        {{ csrf_field() }}
                                        <input type="hidden" name="question_id" value="{{$selectedQuestion->id}}">
                                        <input type="hidden" name="page_id" value="{{$selectedPage->id}}">
                                        <input class="btn btn-primary" type="submit" value="Töröl">
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="col-12">
                    <form action="{{ route('admin.chosePageAddQuestion') }}" method="post" >
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="form-group col-6">
                                <label for="question">Kérdés hozzáadása a kérdőív laphoz</label>
                                <select class="form-control {{ $errors->has('question_id') ? ' is-invalid' : '' }}" id="question" name="question_id">
                                    @foreach($unusedQuestions as $question)
                                            <option value="{{$question->id}}">{{$question->question}}({{ $QuestionFormatter->format($question->answer_type) }})</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-6">
                                <label for="place_in_order">Kérdés helyzete a lapon</label>
                                <select class="form-control" id="place_in_order" name="place_in_order">
                                    @for($x = 1;$x <= 50;$x++)
                                        <option value="{{$x}}" @if($maxPlaceInOrder == $x)selected="selected"@endif>{{$x}}</option>
                                    @endfor
                                </select>
                            </div>
                        </div>
                        <input type="hidden" name="page_id" value="{{$selectedPage->id}}">
                        <input class="btn btn-primary" type="submit" value="Hozzáad">
                    </form>
                </div>
                </div>
            </div>
        </div>
@endsection