@extends('layouts.main')
@push('styles')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
    integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
    crossorigin=""/>
<link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/leaflet.draw/1.0.4/leaflet.draw.css"/>
@endpush

@section('content')
    @include('partials.map.default')
@endsection

@push('scripts')
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
    integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
    crossorigin=""></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet.draw/1.0.4/leaflet.draw.js"></script>

    <script>
        const center = [15, -37];
        const zoom = 4;
        const map = L.map('map', {'minZoom': zoom}).setView(center, zoom);

        const imageUrl = "https://media.fortniteapi.io/images/map.png";
        const imageBounds = [[-15, 0], [40.774, -70.125]];

        L.imageOverlay(imageUrl, imageBounds).addTo(map);

        map.on('drag', () => map.panInsideBounds(imageBounds, { animate: false }));

        const drawnItems = new L.FeatureGroup();
        map.addLayer(drawnItems);

        const redIcon = new L.Icon(
            {
                iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-red.png',
                shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
                iconSize: [25, 41],
                iconAnchor: [12, 41],
                popupAnchor: [1, -34],
                shadowSize: [41, 41]
            }
        );

        const drawControl = new L.Control.Draw(
            {
                position: 'topright',
                draw: {
                    polygon: {
                        shapeOptions: {
                            color: 'red'
                        },
                        allowIntersection: false,
                        drawError: {
                            color: 'orange',
                            timeout: 1000
                        },
                        showArea: true,
                        metric: false,
                        repeatMode: true
                    },
                    marker: {
                        icon: redIcon
                    },
                    polyline: false,
                    rectangle: false,
                    circle: false,
                    circlemarker: false
			    },
                edit: {
                    featureGroup: drawnItems
                }
            }
        );

        map.addControl(drawControl);

        map.on(
            'draw:created',
            e => {
                const type = e.layerType, layer = e.layer;

                if (type === 'marker') {
                    layer.bindPopup('Wifft#0519');
                }

                drawnItems.addLayer(layer);
		    }
        );
    </script>
@endpush
