<div class="form-material col-sm-12">
    <input class="form-control"
           type="text"
           name="{{ $name }}"
           value="{{ $value }}"{{
           isset($required) ? ' required ' : ''
           }}>
    @if (isset($label))
        <label>{{ $label }}</label>
    @endif
    {{--<div class="help-block">This is a help block!</div>--}}
</div>