@extends('web.layout')

@section('content')
    <style>
        #map {
            height: 70vh;
        }
    </style>
    <div class="block">
        <div class="block-header">
            <h1>Report</h1>
        </div>
        <div class="block-content">
            <form action="{{
                        $report->id
                            ? route('reports.update', $report->id)
                            : route('reports.store')
                            }}" method="post">
                @csrf
                @if ( $report->id )
                    @method('patch')
                @endif
                <div class="card">
                    <div class="card-header">
                        <h3>Основные</h3>
                    </div>
                    <div class="card-content">

                        @include('partials.text', [
                            'label' => 'Заголовок',
                            'name' => 'title',
                            'value' => $report->title ?? '',
                        ])

                        @include('partials.textarea', [
                            'label' => 'Описание',
                            'name' => 'description',
                            'value' => $report->description ?? '',
                        ])

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

                    </div>
                </div>
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
                <button class="btn btn--default">Save</button>
            </form>
        </div>

@endsection

@push('scripts')
    <script src="https://cdn.ckeditor.com/ckeditor5/12.0.0/classic/ckeditor.js"></script>
@endpush