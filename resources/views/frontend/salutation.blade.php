@extends('frontend.layout.framework')

@section('content')

        <div class="col-8 rounded bg-primary my-5 mx-auto text-white text-box p-3">
            @if(!empty($regards))
                {{$regards}}
            @endif
        </div>
        <div class="col-12 my-5 mx-auto text-center">
            @if(!empty($googlelink))
                <a href="{{ $googlelink }}" class="btn btn-success btn-lg btn-block">Revotica értékelése a Google-n</a>
                <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
                <script>
                    setTimeout(function(){
                        swal({
                            title: "Köszönjük!",   text: "Az ön válaszai sokat segítenek nekünk, kérjük értékeljen minket a Google értékelésben is.",
                            type: "warning",
                            icon: "success",
                            confirmButtonColor: "green",
                            confirmButtonText: "Rendben",
                            closeOnConfirm: false
                        }).then(function(){
                            window.location.href = "{{$googlelink}}";
                            })
                    },3000);
                </script>
            @endif
        </div>
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