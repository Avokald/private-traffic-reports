<div class="form-group mb-4">
    <div class="col-sm-12">
        <div class="form-material">

            @if (isset($label) && $label)
                <div class="form-text">{{ $label }}</div>
            @endif

            <label class="col-12">
                <div class="col-2 text-center">
                    <img class="ajax-image-preview"
                         src="{{ $value }}"
                         height="100"
                         width="100"
                         alt="uploaded image preview"
                         @if (!$value)
                             hidden
                        @endif
                    >
                </div>
                <span class="btn btn-info col-2 shadow"><b>Выбрать</b></span>
                <input class="ajax-image-upload"
                       type="file"
                       accept="image/png, image/jpeg"
                       hidden
                >
                <input class="ajax-image-value"
                       type="hidden"
                       name="{{ $name }}"
                       value="{{ $value }}">
            </label>

        </div>
    </div>
</div>