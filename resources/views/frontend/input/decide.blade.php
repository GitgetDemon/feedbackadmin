<div class="form-group">
    <label for="{{$input_name}}">{{$input_text}}</label>
    <select class="form-control" id="{{$input_name}}" name="{{$input_name}}">
        <option></option>
        <option value="1" @if($input_value == 1) selected="selected" @endif>Igen</option>
        <option value="0" @if($input_value === 0) selected="selected" @endif>Nem</option>
    </select>
</div>