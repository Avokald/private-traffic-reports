<div class="form-group repeater push-30-t clearfix">
    <div class="col-sm-12">
        <div class="form-material">
            <div class="repeater-list">
                @if ( isset($value) )
                    @foreach ($value as $image)
                        {{-- TODO Does clearfix really needs to be here--}}
                        <div class="{{ $class }} repeater-item push-30-t">
                            <div class="row">
                                <div class="col-sm-10">
                                    @include('admin.partials.image', [
                                        'label' => '',
                                        'name'  => $name ?? '',
                                        'value' => $image->id ?? '',
                                    ])
                                    {{-- TODO 'url'   => $image->url ?? '',--}}
                                </div>
                                <button class="ajax-image-delete repeater-delete-el col-sm-2 btn btn-danger push-100-t" data-image-id="{{ $image->id ?? '' }}">Удалить</button>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
            <label>{{ $label }}</label>
            {{--<div class="help-block">This is a help block!</div>--}}
            <div class="col-sm-12">
                <button class="repeater-add-el btn btn-success"
                        data-block-type="{{ $class }}">Добавить</button>
            </div>
        </div>
    </div>
</div>

@push('hidden')
    <div class="{{ $class }} repeater-item push-30-t">
        <div class="row">
            <div class="col-sm-10">
                @include('admin.partials.image', [
                    'name' => $name,
                    'value' => '',
                    'label' => '',
               ])
            </div>
            <button class="ajax-image-delete repeater-delete-el col-sm-2 btn btn-danger" data-image-id="">Удалить</button>
        </div>
    </div>
@endpush
