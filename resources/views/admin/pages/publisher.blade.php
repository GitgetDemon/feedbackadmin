@inject('QuestionFormatter','App\Lib\Formatters\QuestionFormatter')
@extends('admin.dashboard.pages')

@section('content')
    <div>
        <h1 class="col-12 text-center">Kérdőív prototípus</h1>
    </div>
    <div class="col-12 text-center">
        A kérdőívben a következő kérdések jelennek meg a megadott sorrendben.
        <div class="text-danger text-left border-info border my-2">
            <ul>
                <li>
                    A kérdőív csak a publikálás után jelenik meg, az alábbi beállítások alapján.
                </li>
                <li>
                    A publikálás után, a kérdőív publikált verziója nem módosítható.
                </li>
                <li>
                    A változtatáshoz mindig új publikáció szükséges.
                </li>
                <li>
                    Mindig az újonnan publikált kérdőív verzió jelenik meg minden új kitöltő személynek.
                </li>
            </ul>
        </div>
        <div class="text-center">
            <form action="{{ route('admin.publishQuestionnaire') }}" method="post" >
                {{ csrf_field() }}
                <input class="btn btn-lg btn-success" type="submit" value="Publikálás">
            </form>
        </div>
    </div>
    <div>
        @foreach($questionnaire->pages()->orderBy('order', 'asc')->get() as $page)
            <div class="col-12 my-3 border border-info">
                <div>{{$page->order}}.oldal</div>
                <h2 class="col-12 text-center">
                    {{$page->page_name}}
                </h2>
                <div class="col-12 text-box">
                    {{$page->page_text}}
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
                    @foreach($page->questions()->orderBy('order', 'asc')->get() as $question)
                        <tr>
                            <td>{{ $question->question }}</td>
                            <td>{{ $QuestionFormatter->format($question->answer_type)}}</td>
                            <td>{{ $question->order }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        @endforeach
    </div>
@endsection