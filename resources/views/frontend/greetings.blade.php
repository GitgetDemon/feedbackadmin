@extends('frontend.layout.framework')

@section('content')
    @if($error === false)
        <div class="col-8 rounded bg-primary my-5 mx-auto text-white text-box p-3">
            @if(!empty($greetings))
                {{$greetings}}
            @endif
        </div>
        <div class="startform col-12 my-5 mx-auto text-center">
            <form action="{{ route('guest.questionnaire') }}" method="get" >
                {{ csrf_field() }}
                <input class="btn btn-lg btn-success" type="submit" value="Tovább a kérdőívre!">
            </form>
        </div>
    @elseif($error === true)
        <div class="col-8 rounded bg-danger my-5 mx-auto text-white text-box p-3">
            A szolgáltatás jelenleg nem elérhető, próbálja meg később.
        </div>
    @endif
@endsection

@push('styles')
<style>
    .text-box
    {
        border: 3px double;
    }
     .box
     {
         height:100vh;
     }
</style>
@endpush