<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <link href="/public/css/bootstrap.min.css" type="text/css">
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }

            #map {
                height: 100%;
            }

            .attachment_block {
                display: block;
                width: 100%;
            }

            .attachments {
                display: flex;
                flex-direction: row;
                flex-wrap: wrap;
            }
        </style>
    </head>
    <body>
        <div id="map"></div>
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

                                    @if (isset($report->videos))
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
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDYzwvnXcXQFr16PVDQ4mva-LK41IUli6I&callback=initMap"
                async defer></script>
    </body>
</html>
