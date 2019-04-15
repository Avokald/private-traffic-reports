@extends('admin.models')
@section('style')
    #map {
        height: 70vh;
    }
@endsection


@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/admin/reports/">Все происшествия</a></li>
            <li class="breadcrumb-item active" aria-current="page">Происшествие</li>
        </ol>
    </nav>
    <div class="container-fluid">
        <div class="">
            <form method="post" action="{{
                            $report->id
                                ? route('admin.reports.update', $report->id)
                                : route('admin.reports.store') }}">
                @csrf
                @if ( $report->id )
                    @method('patch')
                @endif

                <div class="card mb-3">
                    <div class="card-header">
                        <h4>Заголовок</h4>
                    </div>
                    @include('partials.text', [
                        'label' => '',
                        'name' => 'title',
                        'value' => $report->title ?? '',
                    ])
                </div>

                <div class="card mb-3">
                    <div class="card-header">
                        <h4>Категория</h4>
                    </div>
                    @include('partials.select_one', [
                        'label' => '',
                        'name' => 'category',
                        'value' => $report->category(),
                    ])
                </div>

                <div class="card mb-3">
                    <div class="card-header">
                        <h4>Теги</h4>
                    </div>
                    @include('partials.select_multiple', [
                        'label' => '',
                        'name' => 'tags',
                        'value' => $report->tags(),
                    ])
                </div>

                <div class="card mb-3">
                    <div class="card-header">
                        <h4>Описание</h4>
                    </div>
                    <div class="form-group">
                        @include('partials.textarea', [
                            'label' => '',
                            'name' => 'description',
                            'value' => $report->description ?? '',
                        ])
                        </div>
                </div>

                <div class="card mb-3">
                    <div class="card-header">
                        <h4>Изображения</h4>
                    </div>
                    <div class="form-group">
                        @include('partials.repeater', [
                            'label' => '',
                            'name' => 'images',
                            'class' => 'images-element',
                            'template' => 'partials.image',
                            'value' => $report->images ?? null,
                        ])
                    </div>
                </div>

                <div class="card mb-3">
                    <div class="card-header">
                        <h4>Видеозаписи</h4>
                    </div>
                    <div class="form-group">
                        @include('partials.repeater', [
                            'label' => '',
                            'name' => 'videos',
                            'class' => 'videos-element',
                            'template' => 'partials.text',
                            'value' => $report->videos ?? null,
                        ])
                    </div>
                </div>




                <input type="hidden"
                       name="lat"
                       value="{{ $report->lat ?? '' }}"
                       class="report-lat"
                >

                <input type="hidden"
                       name="lng"
                       value="{{ $report->lng ?? '' }}"
                       class="report-lng"
                >

                <div id="map"></div>
                <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDYzwvnXcXQFr16PVDQ4mva-LK41IUli6I&callback=initMap"
                        async defer></script>
                <script>
                    var map;

                    function initMap() {

                        map = new google.maps.Map(document.getElementById('map'), {
                            center: { lat: 52.279141, lng: 76.953151 },
                            zoom: 13
                        });

                        var marker = new google.maps.Marker({
                            map: map,
                            @if ($report->lng && $report->lat)

                                position: { lat: {{ $report->lat }}, lng: {{ $report->lng }} },
                            @endif
                        });

                        google.maps.event.addListener(map, 'click', function(event) {
                            var lat = event.latLng['lat']();
                            var lng = event.latLng['lng']();

                            marker.setPosition(new google.maps.LatLng(lat, lng));

                            document.getElementsByClassName("report-lat")[0].value = lat;
                            document.getElementsByClassName("report-lng")[0].value = lng;

                        });
                    }
                </script>

                <div class="card">
                    <div class="card-content">
                        <button>Сохранить</button>
                        <a href="{{ route('admin.reports.index') }}" class="btn btn-link">Отменить</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection