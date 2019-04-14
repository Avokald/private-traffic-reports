<div class="form-group mb-4">
    <div class="col-sm-12">
        <div class="form-material">
            @if (isset($label) && $label)
                <div class="form-text">{{ $label }}</div>
            @endif

            <textarea class="form-control shadow-sm" rows="8"
                      name="{{ $name }}" {{
                      isset($required) ? ' required ' : ''
            }}>{{
                $value
            }}</textarea>
        </div>
    </div>
</div>
