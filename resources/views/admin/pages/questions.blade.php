@inject('QuestionFormatter','App\Lib\Formatters\QuestionFormatter')
@extends('admin.dashboard.pages')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="row newquestion">
            <h1 class="col-12 text-center">Új kérdés</h1>
            <div class="col-12">
                <form action="{{ route('admin.questionstore') }}" method="post" >
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="newquestion">Kérdés</label>
                        <input type="text" name="newquestion" class="form-control {{ $errors->has('newquestion') ? ' is-invalid' : '' }}" id="newquestion">
                    </div>
                    <div class="form-group">
                        <label for="answertype">Válasz típusa</label>
                        <select class="form-control" id="answertype" name="answertype">
                            <option value="rating"  @if(old('answertype') == 'rating')selected="selected"@endif>Értékelés</option>
                            <option value="shorttext" @if(old('answertype') == 'shorttext')selected="selected"@endif>Rövid szöveges válasz</option>
                            <option value="longtext" @if(old('answertype') == 'longtext')selected="selected"@endif>Hosszú szöveges válasz</option>
                            <option value="numeric" @if(old('answertype') == 'numeric')selected="selected"@endif>Numerikus válasz</option>
                            <option value="decide" @if(old('answertype') == 'decide')selected="selected"@endif>Igen/Nem válasz</option>
                        </select>
                    </div>
                    <input class="btn btn-primary" type="submit" value="Kérdés hozzáadása">
                </form>
            </div>
        </div>
        <div class="row questions">
            <h1 class="col-12 text-center">Kérdések</h1>
            <div class="col-12">
                <table class="table table-striped table-bordered">
                    <thead class="thead-dark">
                    <tr>
                        <th scope="col">Kérdés</th>
                        <th scope="col">Válasz típusa</th>
                        <th scope="col">Használatban</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($questions as $question)
                    <tr>
                        <td>{{ $question->question }}</td>
                        <td>{{ $QuestionFormatter->format($question->answer_type) }}</td>
                        <td>@if(!empty($question->page->page_name)){{ $question->page->page_name }}@endif</td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection