<div class="form-group col-sm-12">
    <div class="form-material push-20">
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
</div>