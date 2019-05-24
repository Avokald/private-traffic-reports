<div class="form-group mb-4">
    <div class="col-sm-12">
        <div class="form-material">
            @if (isset($label) && $label)
                <div class="form-text">{{ $label }}</div>
            @endif

            @php
            $ids = array_map(function($element) {
                return $element['id'];
            }, $value->get()->toArray())
            @endphp

            <select class="form-control shadow-sm custom-select"
                    name="{{ $name }}"
                    multiple
                    size="10"
            >
                @foreach (get_class($value->getRelated())::all() as $item)
                    @if ($value->first() != null)
                        <option value="{{ $item->id }}"{{ (in_array($item->id, $ids, true)) ? ' selected' : ''}}>{{ $item->title }}</option>
                    @else
                        <option value="{{ $item->id }}">{{ $item->title }}</option>
                    @endif
                @endforeach
            </select>
        </div>
    </div>
</div>
