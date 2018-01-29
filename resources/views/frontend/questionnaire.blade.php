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
            <div class="progress-bar progress-bar-striped progress-bar-animated bg-success" style="width:{{$percent}}%;" role="progressbar" aria-valuenow="{{$percent}}" aria-valuemin="0" aria-valuemax="100">{{$actualPage['order']}}/{{$numberOfPages}}</div>
        </div>
    </div>
        <div class="startform col-8 my-5 mx-auto">
            <form action="{{ route('guest.answers') }}" method="post" >
                {{ csrf_field() }}
                @foreach($actualPage['questions'] as $question)
                    <div class="col-12">
                        @php
                         $input_value = old('id-' . $question['id']) ? old('id-' . $question['id']) : '';
                        @endphp
                        @if($question['answer_type'] == 'decide')
                            @include('frontend.input.decide', [
                                                'input_name' => 'id-' . $question['id'],
                                                'input_text' => $question['question'],
                                                'input_value' => $input_value,
                                            ])
                            @if ($errors->has('id-' . $question['id']))
                                <span class="help-block text-danger">Mező kitöltése kötelező!</span>
                            @endif
                            <hr>
                        @elseif($question['answer_type'] == 'longtext')
                            @include('frontend.input.longtext', [
                                                'input_name' => 'id-' . $question['id'],
                                                'input_text' => $question['question'],
                                                'input_value' => $input_value,
                                            ])
                            @if ($errors->has('id-' . $question['id']))
                                <span class="help-block text-danger">Mező kitöltése kötelező!</span>
                            @endif
                            <hr>
                        @elseif($question['answer_type'] == 'shorttext')
                            @include('frontend.input.shorttext', [
                                                'input_name' => 'id-' . $question['id'],
                                                'input_text' => $question['question'],
                                                'input_value' => $input_value,
                                            ])
                            @if ($errors->has('id-' . $question['id']))
                                <span class="help-block text-danger">Mező kitöltése kötelező!</span>
                            @endif
                            <hr>
                        @elseif($question['answer_type'] == 'numeric')
                            @include('frontend.input.numeric', [
                                                'input_name' => 'id-' . $question['id'],
                                                'input_text' => $question['question'],
                                                'input_value' => $input_value,
                                            ])
                            @if ($errors->has('id-' . $question['id']))
                                <span class="help-block text-danger">Mező kitöltése kötelező! A mező csak számértéket fogad el!</span>
                            @endif
                            <hr>
                        @elseif($question['answer_type'] == 'rating')
                            @include('frontend.input.rating', [
                                                'input_name' => 'id-' . $question['id'],
                                                'input_text' => $question['question'],
                                                'input_value' => $input_value,
                                            ])
                            @if ($errors->has('id-' . $question['id']))
                                <span class="help-block text-danger">Mező kitöltése kötelező!</span>
                            @endif
                            <hr>
                        @endif
                    </div>
                @endforeach
                <div class="col-12 text-center">
                    <input class="btn btn-lg btn-success" type="submit" value="Tovább!">
                </div>
            </form>
        </div>
@endsection

@push('styles')
<style>
    hr
    {
        height: 10px;
        border: 0;
        box-shadow: 0 10px 10px -10px #8c8b8b inset;
    }
    .text-box
    {
        border: 3px double;
    }


    .rating {
        overflow: hidden;
        display: inline-block;
    }

    .rating-input {
        float: right;
        width: 16px;
        height: 16px;
        padding: 0;
        margin: 0 0 0 -16px;
        opacity: 0;
    }

    .rating:hover .rating-star:hover,
    .rating:hover .rating-star:hover ~ .rating-star,
    .rating-input:checked ~ .rating-star {
        background-position: 0 0;
    }

    .rating-star,
    .rating:hover .rating-star {
        position: relative;
        float: right;
        display: block;
        width: 16px;
        height: 16px;
        background: url('{{URL::asset('images/star.png')}}') 0 -16px;
    }
</style>
@endpush