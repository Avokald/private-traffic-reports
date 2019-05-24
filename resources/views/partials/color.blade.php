<div class="form-group mb-4">
    <div class="col-sm-12">
        <div class="form-material">

            @if (isset($label) && $label)
                <div class="form-text">{{ $label }}</div>
            @endif

            <input type="color"
                   name="{{ $name }}"
                   value="{{ $value }}">

        </div>
    </div>
</div>