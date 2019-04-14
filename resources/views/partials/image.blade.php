<div class="form-group">
    <div class="col-sm-12">
        <div class="form-material">
            <img class="ajax-image-preview"
                 src="{{ $value }}"
                 height="100"
                 width="100"
                 alt="uploaded image preview"
            >
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