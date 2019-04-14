@extends('admin.models')

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/admin/reports/">Пользователи</a></li>
            <li class="breadcrumb-item active" aria-current="page">Пользователь</li>
        </ol>
    </nav>

    <div class="table table-responsive table-hover">
        <table class="table table-striped table-vcenter table-bordered text-center">
            <thead class="thead-dark">
                <th>id</th>
                <th>Имя</th>
                <th>Почта</th>
                <th>Дата создания</th>
                <th>Действия</th>
            </thead>
            <tbody>
                @foreach ( $users as $key => $user )
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->created_at }}</td>
                        <td class="text-center">
                            <div class="btn-group">
                                <a href="{{ route('admin.users.edit', $user->id) }}"
                                   class="btn btn-xs btn-default" data-toggle="tooltip" title="Изменить">
                                    <span class="fa-stack fa-lg">
                                      <i class="fa fa-square fa-stack-2x"></i>
                                      <i class="fa fa-pencil fa-stack-1x"></i>
                                    </span>
                                </a>
                                <form action="{{ route('admin.users.destroy', $user->id) }}"
                                      method="post" class="hidden" id="form-element-delete-{{ $key }}">
                                    @csrf
                                    @method('delete')
                                </form>
                                <button class="btn btn-xs btn-default confirm-delete" data-toggle="tooltip"
                                        title="Удалить" form="form-element-delete-{{ $key }}">
                                    <span class="fa-stack fa-lg">
                                      <i class="fa fa-square fa-stack-2x button-delete-background"></i>
                                      <i class="fa fa-times fa-stack-1x"></i>
                                    </span>
                                </button>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection