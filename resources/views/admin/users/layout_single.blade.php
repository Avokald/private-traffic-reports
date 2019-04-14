@extends('admin.models')

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/admin/users/">Список пользователей</a></li>
            <li class="breadcrumb-item active" aria-current="page">Пользователь</li>
        </ol>
    </nav>

        <div class="container-fluid">
            <div class="">
                <form method="post" action="{{
                                $user->id
                                    ? route('admin.users.update', $user->id)
                                    : route('admin.users.store') }}">
                    @csrf
                    @if ( $user->id )
                        @method('patch')
                    @endif

                    <div class="card mb-3">
                        <div class="card-header">
                            <h4>Имя</h4>
                        </div>
                        @include('partials.text', [
                            'label' => '',
                            'name' => 'name',
                            'value' => $user->name ?? '',
                        ])
                    </div>

                    <div class="card mb-3">
                        <div class="card-header">
                            <h4>Почта</h4>
                        </div>
                        @include('partials.text', [
                            'label' => '',
                            'name' => 'email',
                            'value' => $user->email ?? '',
                        ])
                    </div>

                    <div class="card mb-3">
                        <div class="card-header">
                            <h4>Пароль</h4>
                        </div>
                        @include('partials.text', [
                            'label' => '',
                            'name' => 'password_unsafe',
                            'value' => '',
                        ])
                    </div>


                    <div class="card">
                        <div class="card-content">
                            <button>Сохранить</button>
                            <a href="{{ route('admin.users.index') }}" class="btn btn-link">Отменить</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
@endsection