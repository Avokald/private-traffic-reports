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
        <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />

        <style>
            html, body {
                height: 100vh;
                margin: 0;
            }

            #map {
                height: 100%;
            }

            .attachment {
                width: 40px;
                height: 30px;
            }

            .video_element {
                display: flex;
                flex-direction: row;
                flex-wrap: wrap;
            }
            .map-filters {
                direction: ltr;
                overflow: hidden;
                text-align: center;
                width: 30vw;
                display: table-cell;
                vertical-align: middle;
                position: relative;
                color: rgb(86, 86, 86);
                font-size: 18px;
                background-color: rgb(255, 255, 255);
                background-clip: padding-box;
                box-shadow: rgba(0, 0, 0, 0.3) 0px 1px 4px -1px;
                z-index: 100;
                opacity: 0.1;
                transition: width 2s;
                overflow: scroll;
            }

            .map-filters:hover {
                opacity: 1.0;
                height: 100vh;
            }
            .map-filters:active {
                opacity: 1.0;
                height: 100vh;
            }

            .goto-admin {
                direction: ltr;
                overflow: hidden;
                text-align: center;
                height: 40px;
                display: table-cell;
                vertical-align: middle;
                position: relative;
                color: rgb(86, 86, 86);
                font-size: 18px;
                background-color: rgb(255, 255, 255);
                background-clip: padding-box;
                box-shadow: rgba(0, 0, 0, 0.3) 0px 1px 4px -1px;
                min-width: 40px;
                border-left: 0px;
                margin-top: 10px;
            }

            .select2-container {
                width: 100%;
            }


            #legend {
                margin-bottom: 10px;
            }


            .map-filter-markers-controls {
                margin-bottom: 100px;
            }

        </style>
    </head>
    <body>

        @if (Auth::user()->id === 1)
            <div class="goto-admin">
                <a class="nav-link text-black-50" href="{{ route('admin.reports.index') }}">Панель администратора</a>
            </div>
        @endif



        <div id="map"></div>
        <div class="map-filters col-2 min-vh-100 container container-fluid">
            <h5>Фильтры</h5>
            <form method="get" action="" class="map-filter-form">

                <div class="row mb-2">
                    <div class="time-filter col-12">
                        <input class="map-filter-time-from" type="date" name="f" value="{{ request()->f }}">
                        <input class="map-filter-time-to"   type="date" name="t" value="{{ request()->t }}">
                    </div>
                </div>

                <div class="row">
                    <div class="category-filter col-12">
                        <div class="form-group mb-2">
                            <div class="col-12">
                                <div class="form-material">
                                    <div class="form-text">Категория</div>

                                    <select class="form-control shadow-sm filter-select-single col-6"
                                            name="category_id">
                                        <option value="" selected>Нет</option>
                                        @foreach ($allCategories as $category)
                                            <option value="{{ $category->id }}"{{ ($category->id === (int) request()->category_id ) ? ' selected' : ''}}>{{ $category->title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="category-filter col-12">
                        <div class="form-group mb-2">
                            <div class="col-12">
                                <div class="form-material">
                                    <div class="form-text">Теги</div>

                                    <select class="form-control shadow-sm filter-select-multiple col-6"
                                            name="tags_id[]"
                                            multiple>
                                        @foreach ($allTags as $tag)
                                            <option value="{{ $tag->id }}"{{
                                                    isset(request()->tags_id) ?
                                                        in_array($tag->id, request()->tags_id, false)
                                                        ? ' selected'
                                                        : ''
                                                    : '' }}>{{
                                                $tag->title
                                            }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <button class="btn btn-info">Применить</button>
            </form>
            <hr>

            <div class="col-12 text-center">
                <h5>Тепловая карта</h5>
                <label>
                    <p>Радиус</p>
                    <input class="filter-heatmap-radius" type="range" min="0" max="50" value="10" />
                </label>

                <label class="col-12">
                    <p>Прозрачность</p>
                    <input class="filter-heatmap-opacity" type="range" min="0" max="1" step="0.1" />
                </label>

                <button class="filter-toggle-heatmap btn btn-info">Показать тепловую карту</button>
            </div>
            <hr>

            <table class="map-filter-markers-controls">
                <tr>
                    <td>Отобразить организации</td>
                    <td><input class="filter-toggle-organizations" type="checkbox"></td>
                </tr>
                {{--<tr>--}}
                    {{--<td>Отобразить парки</td>--}}
                    {{--<td><input class="filter-toggle-parks" type="checkbox"></td>--}}
                {{--</tr>--}}
                <tr>
                    <td>Отобразить автобусные остановки</td>
                    <td><input class="filter-toggle-transit" type="checkbox"></td>
                </tr>
            </table>

        </div>

        <div class="col-12 text-center" id="legend">

            @if (request()->f && request()->t)
                <div>
                    <button class="map-filter-time-back btn">
                        <h4><</h4>
                    </button>
                    {{ request()->f . ' - ' .  request()->t }}
                    <button class="map-filter-time-forward btn">
                        <h4>></h4>
                    </button>
                </div>
            @endif

            <div class="d-flex justify-content-center">
                @if ($allCategories)
                    @foreach ($allCategories as $category)
                        <div class="p-2">
                            <img src="{{ $category->marker_url }}" width="15" height="15">

                            <b class="text-left">
                                {{ $category->title }}
                            </b>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>


        <script src="/public/js/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
        <script src="/public/js/bootstrap.min.js"></script>
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDYzwvnXcXQFr16PVDQ4mva-LK41IUli6I&callback=initMap&language=ru&libraries=visualization"
                async defer></script>





        <script>


            var map;
            var heatmap;

            // Data points for heatmap
            var data_points = [];
            var markers = [];

            var myStyles =[
                {
                    featureType: "poi",
                    elementType: "labels",
                    stylers: [
                        { visibility: "off" }
                    ],
                },
                {
                    featureType: "transit",
                    elementType: "labels",
                    stylers: [
                        { visibility: "off" }
                    ],
                },
                // {
                //     featureType: "administrative",
                //     elementType: "labels",
                //     stylers: [
                //         { visibility: "off" }
                //     ],
                // },

            ];


            function formatDate(date) {
                var month = '' + (date.getMonth() + 1);
                var day = '' + date.getDate();
                var year = date.getFullYear();

                if (month.length < 2) month = '0' + month;
                if (day.length < 2) day = '0' + day;

                return [year, month, day].join('-');
            }


            function initMap() {
                $(".filter-select-single").select2();
                $(".filter-select-multiple").select2();


                var icon_white = {
                    url: 'https://cdn3.iconfinder.com/data/icons/business-life-1/532/placeholder_map_marker_position_pinpoint-512.png',
                    scaledSize: new google.maps.Size(40, 25),
                    origin: new google.maps.Point(0,0),
                    anchor: new google.maps.Point(0, 0)
                };


                map = new google.maps.Map(document.getElementById('map'), {
                    center: { lat: 52.279141, lng: 76.953151 },
                    zoom: 13,
                    zoomControl: true,
                    mapTypeControl: true,
                    mapTypeControlOptions: {
                        mapTypeIds: ['satellite', 'terrain'],
                        position: google.maps.ControlPosition.TOP_RIGHT,
                    },
                    scaleControl: true,
                    streetViewControl: false,
                    rotateControl: true,
                    fullscreenControl: false,
                    styles: myStyles,
                });


                var map_filter = document.getElementsByClassName("map-filters")[0];
                map.controls[google.maps.ControlPosition.TOP_LEFT].push(map_filter);


                var goto_admin = document.getElementsByClassName("goto-admin")[0];
                map.controls[google.maps.ControlPosition.TOP_RIGHT].push(goto_admin);

                var legend = document.getElementById("legend");
                map.controls[google.maps.ControlPosition.BOTTOM_CENTER].push(legend);

                var infowindow = new google.maps.InfoWindow();
                let category_icon;


                $(".filter-toggle-heatmap").on("click", function(e) {
                    heatmap.setMap(heatmap.getMap() ? null : map);
                    for (var single_marker of markers) {
                        single_marker.setMap(heatmap.getMap() ? null : map);
                    }
                    e.target.innerHTML = heatmap.getMap() ? "Скрыть тепловую карту" : "Показать тепловую карту";
                });

                $(".filter-toggle-organizations").on("change", function(e) {
                    var map_elements_visibility = e.target.checked ? 'on' : 'off';
                    myStyles[0].stylers[0].visibility = map_elements_visibility;
                    map.setOptions(
                        {
                            styles: myStyles,
                        }
                    );
                });

                // $(".filter-toggle-parks").on("change", function(e) {
                //     var map_elements_visibility = e.target.checked ? 'on' : 'off';
                //     myStyles[1].stylers[0].visibility = map_elements_visibility;
                //     map.setOptions(
                //         {
                //             styles: myStyles,
                //         }
                //     );
                // });

                $(".filter-toggle-transit").on("change", function(e) {
                    var map_elements_visibility = e.target.checked ? 'on' : 'off';
                    myStyles[1].stylers[0].visibility = map_elements_visibility;
                    map.setOptions(
                        {
                            styles: myStyles,
                        }
                    );
                });



                $(".filter-heatmap-radius").on("input", function(e) {
                    heatmap.set('radius', e.target.value);
                });

                $(".filter-heatmap-opacity").on("input", function(e) {
                    heatmap.set('opacity', e.target.value);
                });

                @foreach ($reports as $key => $report)

                    category_icon = {
                        url: "{{ url()->current() . $report->category->marker_url }}",
                        scaledSize: new google.maps.Size(25, 25),
                        origin: new google.maps.Point(0,0),
                        anchor: new google.maps.Point(0, 0)
                    };

                    data_points.push(new google.maps.LatLng({{ $report->lat }}, {{ $report->lng }}));

                    var marker = new google.maps.Marker({
                        position: { lat: {{ $report->lat }}, lng: {{ $report->lng }} },
                        map: map,
                        icon: category_icon,
                        title: '{{ $report->title }}'
                    });


                    google.maps.event.addListener(marker, 'click', function() {
                        infowindow.close(); // Close previously opened infowindow
                        infowindow.setPosition(new google.maps.LatLng(this.getPosition().lat(), this.getPosition().lng()));
                        infowindow.setContent(
                            `<div id="content" style="width: 40vw;">
                                <div id="siteNotice">
                                </div>
                                <h1 id="firstHeading" class="firstHeading">{{ $report->title }}</h1>

                                <h1 class="firstHeading">
                                    @if (isset($report->tags))
                                        @foreach($report->tags as $tag)
                                            <h6 class="badge" style="background-color: {{ $tag->color }}">{{ $tag->title }}</h6>
                                        @endforeach
                                    @endif
                                </h1>
                                <div id="bodyContent">
                                    <p>{{ $report->description }}</p>

                                    {{-- TODO Can be improved to use count() once --}}
                                    @if (isset($report->images) && count($report->images))
                                        <div class="attachment_block">
                                            <h3>Изображения: </h3>
                                            <div class="attachment_block flex-row">
                                                @foreach($report->images as $image_key => $image)
                                                    <a href="{{ $image }}" target="_blank">
                                                        <img class="attachment" src="{{ $image }}" alt="Report image">
                                                    </a>
                                                @endforeach
                                            </div>
                                        </div>
                                    @endif

                                    @if (isset($report->videos) && count($report->videos))
                                        <div class="attachment_block">
                                            <h3>Видеозаписи: </h3>
                                            <div class="attachment_block">
                                                @foreach ($report->videos as $video)
                                                    @php
                                                        preg_match(
'/^((?:https?:)?\/\/)?((?:www|m)\.)?((?:youtube\.com|youtu.be))(\/(?:[\w\-]+\?v=|embed\/|v\/)?)([\w\-]+)(\S+)?$/',
                                                            $video,
                                                            $parsed_link);
                                                    @endphp
                                                    <iframe width="240"
                                                            height="180"
                                                            src="https://www.youtube.com/embed/{{ $parsed_link[5] }}"
                                                            frameborder="0"
                                                            allow="accelerometer;
                                                                   autoplay;
                                                                   encrypted-media;
                                                                   gyroscope;
                                                                   picture-in-picture"
                                                            allowfullscreen>'
                                                    </iframe>
                                                @endforeach
                                            </div>
                                        </div>
                                    @endif
                                    @if (Auth::user()->id === 1)
                                        <form action="{{ route('admin.reports.destroy', $report->id) }}"
                                              method="post"
                                              class="hidden clearfix"
                                              id="form-element-delete-{{ $key }}">
                                            @csrf
                                            @method('delete')
                                            <a class="btn btn-info" href="{{ route('admin.reports.edit', $report->id) }}">Изменить</a>
                                            <button class="btn btn-danger float-right">Удалить</button>
                                        </form>
                                    @endif
                                </div>
                            </div>`
                        );
                        infowindow.open(map, this);

                    });

                markers.push(marker);
                @endforeach
                heatmap = new google.maps.visualization.HeatmapLayer({
                    data: data_points,
                    map: null,
                });

                $('.map-filter-time-back').on("click", function (e) {
                    var date_from = new Date($(".map-filter-time-from").val());
                    var date_to = new Date($(".map-filter-time-to").val());

                    const diffTime = Math.abs(date_from.getTime() - date_to.getTime());
                    const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));

                    date_from.setDate(date_from.getDate() - diffDays);
                    date_to.setDate(date_to.getDate() - diffDays);
                    $(".map-filter-time-from").val(formatDate(date_from));
                    $(".map-filter-time-to").val(formatDate(date_to));

                    $(".map-filter-form").submit();
                });

                $('.map-filter-time-forward').on("click", function (e) {
                    var date_from = new Date($(".map-filter-time-from").val());
                    var date_to = new Date($(".map-filter-time-to").val());

                    const diffTime = Math.abs(date_from.getTime() - date_to.getTime());
                    const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));

                    date_from.setDate(date_from.getDate() + diffDays);
                    date_to.setDate(date_to.getDate() + diffDays);
                    $(".map-filter-time-from").val(formatDate(date_from));
                    $(".map-filter-time-to").val(formatDate(date_to));

                    $(".map-filter-form").submit();
                });

            }
        </script>

    </body>
</html>
