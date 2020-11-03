<div class="form-group">
    <label for="{{$name}}">{{$label}}</label>
    <input type="{{$type}}" class="form-control @error($name) is-invalid @enderror"
           @if($disabled) disabled @endif
           value="{{ $value }}"
           id="{{$name}}" name="{{$name}}">
    <x-form-error name="{{$name}}"/>
</div>
