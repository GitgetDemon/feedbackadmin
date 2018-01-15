@inject('QuestionFormatter','App\Lib\Formatters\QuestionFormatter')
@extends('admin.dashboard.pages')

@section('content')
    <div class="row">
        <div class="col-12">
            <table class="table table-striped table-bordered">
                <thead class="thead-dark">
                <tr>
                    <th scope="col">Kérdőívlap</th>
                    <th scope="col">Sorrend</th>
                    <th scope="col">Művelet</th>
                </tr>
                </thead>
                <tbody>
                @foreach($selectedPages as $selectedPage)
                    <tr>
                        <td>{{ $selectedPage->page_name }}</td>
                        <td>{{ $selectedPage->order }}</td>
                        <td>
                            <form action="{{ route('admin.modifyQuestionnaireDeletePage') }}" method="post" >
                                {{ csrf_field() }}
                                <input type="hidden" name="page_id" value="{{$selectedPage->id}}">
                                <input type="hidden" name="questionnaire_id" value="{{$selectedQuestionnaire->id}}">
                                <input class="btn btn-primary" type="submit" value="Töröl">
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div class="col-12">
                <form action="{{ route('admin.modifyQuestionnaireAddPage') }}" method="post" >
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="form-group col-6">
                            <label for="question">Lap hozzáadása a kérdőívhez</label>
                            <select class="form-control {{ $errors->has('page_id') ? ' is-invalid' : '' }}" id="question" name="page_id">
                                @foreach($unusedPage as $page)
                                    <option value="{{$page->id}}">{{$page->page_name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-6">
                            <label for="place_in_order">Lap helyzete a kérdőívben</label>
                            <select class="form-control" id="place_in_order" name="place_in_order">
                                @for($x = 1;$x <= 50;$x++)
                                    <option value="{{$x}}" @if($maxPlaceInOrder == $x)selected="selected"@endif>{{$x}}</option>
                                @endfor
                            </select>
                        </div>
                    </div>
                    <input type="hidden" name="questionnaire_id" value="{{$selectedQuestionnaire->id}}">
                    <input class="btn btn-primary" type="submit" value="Hozzáad">
                </form>
            </div>
        </div>
    </div>
@endsection