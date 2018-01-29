@extends('admin.dashboard.pages')

@section('content')
    <div>
        <h1 class="col-12 text-center">Eddig publikált kérdőívek.</h1>
    </div>
    <div class="col-12">
        <div class="col-12 my-4 text-danger text-center">
            @if(!empty($newest->id))Jelenleg a <strong>{{$newest->id}}</strong> számú azonosítóval ellátott kérdőív jelenik meg a látogatók számára.@endif
        </div>
        <table class="table table-striped table-bordered">
            <thead class="thead-dark">
            <tr>
                <th scope="col">Azonosító</th>
                <th scope="col">Létrehozva</th>
                <th scope="col">Megtekintés</th>
            </tr>
            </thead>
            <tbody>
                @foreach($publishedQuestionnaires as $publishedQuestionnaire)
                    <tr>
                        <td>{{ $publishedQuestionnaire->id }}</td>
                        <td>{{ $publishedQuestionnaire->created_at }}</td>
                        <td>
                            <form action="{{ route('admin.publishedQuestionnaire') }}" method="get" >
                                {{ csrf_field() }}
                                <input type="hidden" name="id" value="{{$publishedQuestionnaire->id}}">
                                <input class="btn btn-primary" type="submit" value="Megtekintés">
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection