<div class="form-material col-sm-12 mb-4">
    @if (isset($label) && $label)
        <div class="form-text">{{ $label }}</div>
    @endif

    <input class="form-control shadow-sm"
           type="text"
           name="{{ $name }}"
           value="{{ $value }}"{{
           isset($required) ? ' required ' : ''
   }}>
    {{--<div class="help-block">This is a help block!</div>--}}
</div>