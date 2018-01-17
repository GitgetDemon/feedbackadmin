@extends('frontend.layout.framework')

@section('content')
<div class="col-8 rounded bg-primary my-5 mx-auto text-white text-box p-3">
    {{$greetings}}
</div>
    <div class="startform col-12 my-5 mx-auto text-center">
        <form action="{{ route('guest.questionnaire') }}" method="post" >
            {{ csrf_field() }}
            <input class="btn btn-lg btn-success" type="submit" value="Tovább a kérdőívre!">
        </form>
    </div>
@endsection

@push('styles')
<style>
    .text-box
    {
        border: 3px double;
    }
</style>
@endpush