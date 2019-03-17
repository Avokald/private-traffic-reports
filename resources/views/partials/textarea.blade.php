<div class="form-group">
    <div class="col-sm-12">
        <div class="form-material">
            <textarea class="form-control"
                      name="{{ $name }}" {{
                      isset($required) ? ' required ' : ''
            }}>{{
                $value
            }}</textarea>
            <label>{{ $label }}</label>
        </div>
    </div>
</div>
