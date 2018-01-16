@extends('admin.dashboard.pages')

@section('content')
        <div class="row">
            <div class="col-12">
                <div class="row newpages">
                    <h1 class="col-12 text-center">Új kérdőív lap</h1>
                    <div class="col-12">
                        <form action="{{ route('admin.pagestore') }}" method="post" >
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="page_name">Kérdőív lap megnevezése</label>
                                <input type="text" name="page_name" class="form-control {{ $errors->has('page_name') ? ' is-invalid' : '' }}" id="page_name">
                            </div>
                            <div class="form-group">
                                <label for="page_text">Kérdőív lap ismertetés</label>
                                <textarea name="page_text" id="page_text" cols="30" rows="10" class="form-control"></textarea>
                            </div>
                            <input class="btn btn-primary" type="submit" value="Kérdőív lap hozzáadása">
                        </form>
                    </div>
                </div>
                <div class="row pages">
                    <h1 class="col-12 text-center">Kérdőív lapok</h1>
                    <div class="col-12">
                        <table class="table table-striped table-bordered">
                            <thead class="thead-dark">
                            <tr>
                                <th scope="col">Kérdőív lap neve</th>
                                <th scope="col">Ismertető</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($pages as $page)
                                <tr>
                                    <td>{{ $page->page_name }}</td>
                                    <td>{{ $page->page_text}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
@endsection