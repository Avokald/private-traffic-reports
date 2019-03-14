<div class="table-responsive">
    <table class="table table-striped table-vcenter">
        <thead>
            <th>id</th>
            <th>Название</th>
            <th>Верт</th>
            <th>Гориз</th>
            <th>Дата создания</th>
            <th>Действия</th>
        </thead>
        <tbody>
            @foreach ( $reports as $key => $report )
                <tr>
                    <td>{{ $report->id }}</td>
                    <td>{{ $report->title }}</td>
                    <td>{{ $report->lat }}</td>
                    <td>{{ $report->lng }}</td>
                    <td>{{ $report->created_at }}</td>
                    <td class="text-center">
                        <div class="btn-group">
                            <a href="{{ route('admin.report.edit', $report->id) }}"
                               class="btn btn-xs btn-default" data-toggle="tooltip" title="Edit">
                                <i class="fa fa-pencil">Edit</i>
                            </a>
                            <form action="{{ route('admin.report.destroy', $report->id) }}"
                                  method="post" class="hidden" id="form-element-delete-{{ $key }}">
                                @csrf
                                @method('delete')
                            </form>
                            <button class="btn btn-xs btn-default confirm-delete" data-toggle="tooltip"
                                    title="Remove" form="form-element-delete-{{ $key }}">
                                <i class="fa fa-times"></i>
                            </button>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>