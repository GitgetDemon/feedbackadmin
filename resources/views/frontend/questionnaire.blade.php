@extends('frontend.layout.framework')

@section('content')
    <div class="col-12 text-center">
        <h1>{{$actualPage['page_name']}}</h1>
    </div>
    @if(!empty($actualPage['page_text']))
        <div class="col-8 rounded bg-primary my-5 mx-auto text-white text-box p-3">
            {{$actualPage['page_text']}}
        </div>
    @endif
    <div class="col-8 mx-auto my-3">
        <div class="progress">
            <div class="progress-bar progress-bar-striped progress-bar-animated bg-success w-{{$percent}}" role="progressbar" aria-valuenow="{{$percent}}" aria-valuemin="0" aria-valuemax="100">{{$actualPage['order']}}/{{$numberOfPages}}</div>
        </div>
    </div>
        <div class="startform col-8 my-5 mx-auto">
            <form action="{{ route('guest.questionnaire') }}" method="post" >
                {{ csrf_field() }}
                @foreach($actualPage['questions'] as $question)
                    @if($question['answer_type'] == 'decide')
                        @include('frontend.input.decide', [
                                            'input_name' => $question['id'],
                                            'input_text' => $question['question'],
                                        ])
                    @elseif($question['answer_type'] == 'longtext')
                        @include('frontend.input.longtext', [
                                            'input_name' => $question['id'],
                                            'input_text' => $question['question'],
                                        ])
                    @elseif($question['answer_type'] == 'shorttext')
                        @include('frontend.input.shorttext', [
                                            'input_name' => $question['id'],
                                            'input_text' => $question['question'],
                                        ])
                    @elseif($question['answer_type'] == 'numeric')
                        @include('frontend.input.numeric', [
                                            'input_name' => $question['id'],
                                            'input_text' => $question['question'],
                                        ])
                    @elseif($question['answer_type'] == 'rating')
                        @include('frontend.input.rating', [
                                            'input_name' => $question['id'],
                                            'input_text' => $question['question'],
                                        ])
                    @endif

                @endforeach
                <div class="col-12 text-center">
                    <input class="btn btn-lg btn-success" type="submit" value="Tovább!">
                </div>
            </form>
        </div>
@endsection

@push('styles')
<style>
    .text-box
    {
        border: 3px double;
    }
    form .stars {
        background: url("{{URL::asset('images/stars.png')}}") repeat-x 0 0;
        width: 150px;
        margin: 0 auto;
    }

    form .stars input[type="radio"] {
        position: absolute;
        opacity: 0;
        filter: alpha(opacity=0);
    }
    form .stars input[type="radio"].star-5:checked ~ span {
        width: 100%;
    }
    form .stars input[type="radio"].star-4:checked ~ span {
        width: 80%;
    }
    form .stars input[type="radio"].star-3:checked ~ span {
        width: 60%;
    }
    form .stars input[type="radio"].star-2:checked ~ span {
        width: 40%;
    }
    form .stars input[type="radio"].star-1:checked ~ span {
        width: 20%;
    }
    form .stars label {
        display: block;
        width: 30px;
        height: 30px;
        margin: 0!important;
        padding: 0!important;
        text-indent: -999em;
        float: left;
        position: relative;
        z-index: 10;
        background: transparent!important;
        cursor: pointer;
    }
    form .stars label:hover ~ span {
        background-position: 0 -30px;
    }
    form .stars label.star-5:hover ~ span {
        width: 100% !important;
    }
    form .stars label.star-4:hover ~ span {
        width: 80% !important;
    }
    form .stars label.star-3:hover ~ span {
        width: 60% !important;
    }
    form .stars label.star-2:hover ~ span {
        width: 40% !important;
    }
    form .stars label.star-1:hover ~ span {
        width: 20% !important;
    }
    form .stars span {
        display: block;
        width: 0;
        position: relative;
        top: 0;
        left: 0;
        height: 30px;
        background: url("{{URL::asset('images/stars.png')}}") repeat-x 0 -60px;
        -webkit-transition: -webkit-width 0.5s;
        -moz-transition: -moz-width 0.5s;
        -ms-transition: -ms-width 0.5s;
        -o-transition: -o-width 0.5s;
        transition: width 0.5s;
    }
</style>
@endpush