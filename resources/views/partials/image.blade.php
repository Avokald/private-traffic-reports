<div class="form-group">
    <div class="col-sm-12">
        <div class="form-material">
            <img class="ajax-image-preview"
                 src="{{ $url }}"
                 height="100"
                 width="100"
                 alt="uploaded image preview"
            >
            <input class="form-control ajax-image-upload"
                   type="file"
                   accept="image/png, image/jpeg">
            <input class="ajax-image-id"
                   type="hidden"
                   name="{{ $name }}"
                   value="{{ $value }}">
            <label>{{ $label }}</label>
            {{--<div class="help-block">This is a help block!</div>--}}
        </div>
    </div>
</div>