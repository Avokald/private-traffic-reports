<div class="form-group">
    <div class="col-sm-12">
        <div class="form-material">
            @if (!$value)
            <input class="form-control ajax-image-upload"
                   type="file"
                   accept="image/png, image/jpeg">
            @endif
            <input class="ajax-image-value"
                   type="hidden"
                   name="{{ $name }}"
                   value="{{ $value }}">
            <label>{{ $label }}</label>
        </div>
    </div>
</div>