<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <link rel="stylesheet" href="/public/css/normalize.css" type="text/css">
        <link rel="stylesheet" href="/public/css/bootstrap.min.css" type="text/css">

        <style>
            html, body {
                height: 100vh;
                margin: 0;
            }

            #map {
                height: 100%;
            }

            .attachment_block {
                display: block;
                width: 100%;
            }
            .attachment {
                width: 160px;
                height: 120px;
            }

            .video_element {
                display: flex;
                flex-direction: row;
                flex-wrap: wrap;
            }

        </style>
    </head>
    <body>
        <div id="map"></div>

        <script src="/public/js/jquery.min.js"></script>
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDYzwvnXcXQFr16PVDQ4mva-LK41IUli6I&callback=initMap"
                async defer></script>

        <script src="/public/js/bootstrap.min.js"></script>
        <script>
            var map;

            function initMap() {

                map = new google.maps.Map(document.getElementById('map'), {
                    center: { lat: 52.279141, lng: 76.953151 },
                    zoom: 13
                });

                var infowindow = new google.maps.InfoWindow();

                @foreach ($reports as $report)

                    var marker = new google.maps.Marker({
                        position: { lat: {{ $report->lat }}, lng: {{ $report->lng }} },
                        map: map,
                        title: '{{ $report->title }}'
                    });

                    google.maps.event.addListener(marker, 'click', function() {
                        infowindow.close(); // Close previously opened infowindow
                        infowindow.setPosition(new google.maps.LatLng(this.getPosition().lat(), this.getPosition().lng()));
                        infowindow.setContent(
                            `<div id="content">
                                <div id="siteNotice">
                                </div>
                                <h1 id="firstHeading" class="firstHeading">{{ $report->title }}</h1>
                                <div id="bodyContent">
                                    <p>{{ $report->description }}</p>

                                    {{-- TODO Can be improved to use count() once --}}
                                    @if (isset($report->images) && count($report->images))
                                        <div id="carouselExampleIndicators" class="attachment_block carousel slide" data-ride="carousel">
                                            <h3>Изображения: </h3>
                                            <ol class="carousel-indicators">
                                                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                                                @for($i = 1, $imageCount = count($report->images); $i < $imageCount; $i++)
                                                    <li data-target="#carouselExampleIndicators" data-slide-to="{{ $i }}"></li>
                                                @endfor
                                            </ol>
                                            <div class="carousel-inner attachment" role="listbox">
                                                <div class="carousel-item active">
                                                    <img class="d-block w-100" src="{{ $report->images[0] }}" alt="Report image">
                                                </div>
                                                @foreach($report->images as $key => $image)
                                                    @if ($key)
                                                        <div class="carousel-item">
                                                            <img class="d-block w-100" src="{{ $image }}" alt="Report image">
                                                        </div>
                                                    @endif
                                                @endforeach
                                            </div>
                                            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                <span class="sr-only">Previous</span>
                                            </a>
                                            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                <span class="sr-only">Next</span>
                                            </a>
                                        </div>
                                    @endif

                                    @if (isset($report->videos) && count($report->videos))
                                        <div class="attachment_block">
                                            <h3>Видеозаписи: </h3>
                                            <div class="attachments">
                                                @foreach ($report->videos as $video)
                                                    @php
                                                        preg_match(
'/^((?:https?:)?\/\/)?((?:www|m)\.)?((?:youtube\.com|youtu.be))(\/(?:[\w\-]+\?v=|embed\/|v\/)?)([\w\-]+)(\S+)?$/',
                                                            $video,
                                                            $parsed_link);
                                                    @endphp
                                                    <div class="attachment">
                                                        <iframe width="160"
                                                                height="120"
                                                                src="https://www.youtube.com/embed/{{ $parsed_link[5] }}"
                                                                frameborder="0"
                                                                allow="accelerometer;
                                                                       autoplay;
                                                                       encrypted-media;
                                                                       gyroscope;
                                                                       picture-in-picture"
                                                                allowfullscreen>'
                                                        </iframe>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>`
                        );
                        infowindow.open(map, this);
                    });
                @endforeach
            }
        </script>
    </body>
</html>
