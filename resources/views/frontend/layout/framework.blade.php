@extends('frontend.layout.html')

@section('body')
    <div class="container box bg-white">
        <div class="row">
            <div class="col-12 text-center">
                <div class="col-6 my-5 mx-auto">
                    <a href="http://revotica.hu" target="_blank"><img src="http://revotica.hu/sites/default/files/logo_0.jpg" class="img-fluid my-6" alt="Revotica.hu"></a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                @yield('content')
            </div>
        </div>
    </div>
@endsection

@push('styles')
<style>
.box
{
    height:100vh;
}
</style>
@endpush