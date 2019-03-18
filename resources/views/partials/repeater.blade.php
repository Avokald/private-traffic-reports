<div class="form-group repeater">
    <div class="col-sm-12">
        <div class="form-material">
            <div class="repeater-list form-group">
                @if ( isset($value) )
                    @foreach ($value as $key => $element)
                        <div class="{{ $class }} repeater-item">
                            <div class="row">
                                <div class="col-sm-11 mt-4">
                                    @include($template, [
                                        'label' => '',
                                        'name' => $name ?? '',
                                        'value' => $element ?? '',
                                    ])
                                </div>
                                <button class="repeater-delete-el btn btn-danger pull-right ">Удалить</button>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
            <button class="repeater-add-el btn btn-success"
                    data-block-type="{{ $class }}">Добавить</button>
        </div>
    </div>
</div>

@push('hidden')
    <div class="{{ $class }} repeater-item">
        <div class="row">
            <div class="col-sm-11">
                @include($template, [
                    'name' => $name,
                    'value' => '',
                    'label' => '',
               ])
            </div>
            <button class="repeater-delete-el btn btn-danger pull-right col-sm-1">Удалить</button>
        </div>
    </div>
@endpush
