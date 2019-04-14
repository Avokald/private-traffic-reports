@extends('admin.models')

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.'. $route_name .'.index' ) }}">{{ $title_plural }}</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $title_singular }}</li>
        </ol>
    </nav>

    <div class="container-fluid">
        <div class="">
            <form method="post" action="{{
                                $value->id
                                    ? route('admin.'. $route_name .'.update', $value->id)
                                    : route('admin.'. $route_name .'.store') }}">
                @csrf
                @if ( $value->id )
                    @method('patch')
                @endif

                <div class="card clearfix">
                    <div class="card-content">
                        @foreach($fields as $field_name => $field_parameters)
                            @include('partials.' . $field_parameters['template'] , [
                                'name' => $field_name,
                                'value' => $value->$field_name,
                                'label' => $field_parameters['title'],
                            ])
                        @endforeach
                    </div>
                </div>


                <button class="btn btn-info">Сохранить</button>
                <a class="btn btn-secondary" href="{{ route('admin.'. $route_name .'.index') }}" class="btn btn-link">Отменить</a>
            </form>
        </div>
    </div>
@endsection