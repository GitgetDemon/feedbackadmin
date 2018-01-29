<div class="form-group">
    <label class="form-check-label" for="{{$input_name}}">
        {{$input_text}}
    </label>
    <div class="col-12 text-center">
        <span class="rating">
            <input type="radio" class="rating-input" id="rating-input-{{$input_name}}-5"name="{{$input_name}}" value="5" @if($input_value == 5) checked="checked" @endif/>
            <label for="rating-input-{{$input_name}}-5" class="rating-star"></label>
            <input type="radio" class="rating-input" id="rating-input-{{$input_name}}-4" name="{{$input_name}}" value="4" @if($input_value == 4) checked="checked" @endif/>
            <label for="rating-input-{{$input_name}}-4" class="rating-star"></label>
            <input type="radio" class="rating-input" id="rating-input-{{$input_name}}-3" name="{{$input_name}}" value="3" @if($input_value == 3) checked="checked" @endif/>
            <label for="rating-input-{{$input_name}}-3" class="rating-star"></label>
            <input type="radio" class="rating-input" id="rating-input-{{$input_name}}-2" name="{{$input_name}}" value="2" @if($input_value == 2) checked="checked" @endif/>
            <label for="rating-input-{{$input_name}}-2" class="rating-star"></label>
            <input type="radio" class="rating-input" id="rating-input-{{$input_name}}-1" name="{{$input_name}}" value="1" @if($input_value == 1) checked="checked" @endif/>
            <label for="rating-input-{{$input_name}}-1" class="rating-star"></label>
        </span>
    </div>
</div>
