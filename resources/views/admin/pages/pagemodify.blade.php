@extends('admin.dashboard.pages')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="row pages">
                <h1 class="col-12 text-center">Kérdőív lap módosítás</h1>
                <div class="col-12">
                    <form action="{{ route('admin.choosepage') }}" method="get" >
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="page">Kérdőív lap kiválasztása</label>
                            <select class="form-control {{ $errors->has('page_id') ? ' is-invalid' : '' }}" id="page" name="page_id">
                                @foreach($pages as $page)
                                    <option value="{{$page->id}}"
                                            @if(!empty($selectedPage->id))
                                            @if($selectedPage->id== $page->id)
                                            selected="selected"
                                            @endif
                                            @endif
                                    >{{$page->page_name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <input class="btn btn-primary" type="submit" value="Kiválasztás">
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection