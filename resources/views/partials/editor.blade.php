<div class="form-group">
    <div class="col-sm-12">
        <div class="form-material">
            <textarea id="{{ $id }}" name="{{ $name }}">{{
                $value
            }}</textarea>
            <label>{{ $label }}</label>
        </div>
    </div>
</div>

@push('script')
    ClassicEditor
        .create(document.querySelector("#{{ $id }}"))
        .catch( error => {
            console.error( error );
    });
@endpush
