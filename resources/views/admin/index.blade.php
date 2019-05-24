@extends('admin.models')

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active">{{ $title }}</li>
        </ol>
    </nav>

    <div class="table table-responsive table-hover">
        <table class="table table-striped table-vcenter table-bordered text-center">
            <thead class="thead-dark">
            @if (isset($fields))
                @foreach($fields as $field_name => $parameters)
                    <th>{{ $parameters['title'] }}</th>
                @endforeach
                <th>Действия</th>
            @endif
            </thead>
            <tbody>
            @if (isset($values, $fields))
                @foreach ($values as $value_key => $value_item)
                    <tr>
                        @foreach ($fields as $field_name => $field_parameters)
                            @if (isset($field_parameters['template']) && $value_item->$field_name)
                                @switch ($field_parameters['template'])
                                    @case('image')
                                        <td><img src="{{ $value_item->$field_name }}" width="50" height="50"></td>
                                    @break

                                    @case('color')
                                        <td style="background-color: {{ $value_item->$field_name }}" width="50" height="50"></td>
                                    @break
                                @endswitch
                            @else
                                <td>{{ $value_item->$field_name }}</td>
                            @endif

                        @endforeach
                        <td class="text-center">
                            <div class="btn-group">
                                <a href="{{ route('admin.'. $route_name .'.edit', $value_item->id) }}"
                                   class="btn btn-xs btn-default" data-toggle="tooltip" title="Изменить">
                                        <span class="fa-stack fa-lg">
                                          <i class="fa fa-square fa-stack-2x"></i>
                                          <i class="fa fa-pencil fa-stack-1x"></i>
                                        </span>
                                </a>
                                <form action="{{ route('admin.'. $route_name .'.destroy', $value_item->id) }}"
                                      method="post" class="hidden" id="form-element-delete-{{ $value_key }}">
                                    @csrf
                                    @method('delete')
                                </form>
                                <button class="btn btn-xs btn-default confirm-delete" data-toggle="tooltip"
                                        title="Удалить" form="form-element-delete-{{ $value_key }}">
                                        <span class="fa-stack fa-lg">
                                          <i class="fa fa-square fa-stack-2x button-delete-background"></i>
                                          <i class="fa fa-times fa-stack-1x"></i>
                                        </span>
                                </button>
                            </div>
                        </td>
                    </tr>
                @endforeach
            @endif
            </tbody>
        </table>
    </div>
@endsection