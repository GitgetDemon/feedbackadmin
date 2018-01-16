@inject('QuestionFormatter','App\Lib\Formatters\QuestionFormatter')
@extends('admin.dashboard.pages')

@section('content')
    <div>
        <h1 class="col-12 text-center">Kérdőív</h1>
    </div>
    <div>
        <div>
            Azonosító: {{$selectedPublishedQuestionnaire->id}}
        </div>
        <div>
            Készült: {{$selectedPublishedQuestionnaire->created_at}}
        </div>
    </div>
    <div>
        @foreach($selectedPublishedQuestionnaire->published_questionnaire[0]['pages'] as $page)
            <div class="col-12 my-3 border border-info">
                <div>{{$page['order']}}.oldal</div>
                <h2 class="col-12 text-center">
                    {{$page['page_name']}}
                </h2>
                <div class="col-12 text-box">
                    {{$page['page_text']}}
                </div>
                <table class="table table-striped table-bordered">
                    <thead class="thead-dark">
                    <tr>
                        <th scope="col">Kérdés</th>
                        <th scope="col">Válasz típusa</th>
                        <th scope="col">Sorrend</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($page['questions'] as $question)
                        <tr>
                            <td>{{ $question['question'] }}</td>
                            <td>{{ $QuestionFormatter->format($question['answer_type'])}}</td>
                            <td>{{ $question['order'] }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        @endforeach
    </div>
@endsection