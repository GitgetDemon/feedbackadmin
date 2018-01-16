@inject('QuestionFormatter','App\Lib\Formatters\QuestionFormatter')
@extends('admin.dashboard.pages')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="row">
                <h1 class="col-12 text-center">Kérdés módosítás</h1>
                <div class="col-12">
                    <form action="{{ route('admin.choosequestion') }}" method="post" >
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="question">Kérdés kiválasztása</label>
                            <select class="form-control {{ $errors->has('question') ? ' is-invalid' : '' }}" id="question" name="question">
                                @foreach($questions as $question)
                                    <option value="{{$question->id}}"
                                        @if(!empty($selectedQuestion->id))
                                            @if($selectedQuestion->id== $question->id)
                                                selected="selected"
                                            @endif
                                        @endif
                                        >{{$question->question}}({{$QuestionFormatter->format($question->answer_type)}})</option>
                                @endforeach
                            </select>
                        </div>
                        <input class="btn btn-primary" type="submit" value="Kiválasztás">
                    </form>

                    @if(!empty($selectedQuestion))
                        <div class="border border-warning col-12 my-4 py-3">
                            <form action="{{ route('admin.modifyquestion') }}" method="post" >
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="selectedquestion">Kérdés módosítása</label>
                                    <input type="text" name="selectedquestion" class="form-control {{ $errors->has('selectedquestion') ? ' is-invalid' : '' }}" id="selectedquestion" value="{{$selectedQuestion->question}}">
                                    <input type="hidden" name="id" value="{{$selectedQuestion->id}}">
                                </div>
                                <div class="col-12">Kérdés eddigi szövege : <strong>{{ $selectedQuestion->question }}</strong></div>
                                <div class="col-12">Válasz típusa : {{ $QuestionFormatter->format($selectedQuestion->answer_type) }}</div>
                                <div class="col-12">Használatban : {{ $selectedQuestion->page()->first()->page_name }}</div>
                                <input class="btn btn-primary" type="submit" value="Módosítás">
                            </form>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
