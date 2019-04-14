<div class="form-group mb-4">
    <div class="col-sm-12">
        <div class="form-material">
            @if (isset($label) && $label)
                <div class="form-text">{{ $label }}</div>
            @endif

            <select class="form-control shadow-sm custom-select"
                      name="{{ $name }}">
                    <option selected>Нет</option>
                @foreach (get_class($value->getRelated())::all() as $item)
                    @if ($value->first() != null)
                        <option value="{{ $item->id }}"{{ ($item->id === $value->first()->id ) ? ' selected' : ''}}>{{ $item->title }}</option>
                    @else
                        <option value="{{ $item->get() }}">{{ $item->title }}</option>
                    @endif
                @endforeach
            </select>
        </div>
    </div>
</div>
