const L = window.L;

const center = [15, -37];
const zoom = 4;
const map = L.map('map', {'minZoom': zoom}).setView(center, zoom);

const imageUrl = "https://media.fortniteapi.io/images/map.png";
const imageBounds = [[-15, 0], [40.774, -70.125]];

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

L.imageOverlay(imageUrl, imageBounds).addTo(map);

map.on('drag', () => map.panInsideBounds(imageBounds, { animate: false }));

const markers = [];
for (const userData of mapUsersData) {
    const markerData = JSON.parse(userData.pivot.marker_data);

    if (markerData !== null) {
        markerData.ownerNickname = userData.nickname;
        markers.push(markerData);
    }
}

const drawnItems = markers.length > 0 ? L.geoJson(
    markers,
    {
        "onEachFeature": (marker, layer) => {
            layer.bindPopup(marker.ownerNickname);

            switch(marker.type) {
                case 'Point':
                    layer.setIcon(redIcon);
                    break;
            }
        }
    }
) : new L.FeatureGroup();

map.addLayer(drawnItems);

const drawControl = new L.Control.Draw(
    {
        position: 'topright',
        draw: {
            polygon: user !== null && user.maps[0].pivot.marker_data === null ? {
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
            } : false,
            marker: user !== null && user.maps[0].pivot.marker_data === null ? {
                icon: redIcon
            } : false,
            polyline: false,
            rectangle: false,
            circle: false,
            circlemarker: false
        },
        edit: {
            edit: false, //ToDo: Hacer que solo el ADMINISTRADOR del server de turno pueda editar.
            featureGroup: drawnItems
        }
    }
);

//ToDo: Add hasRole check at some point.
if (user !== null && Object.keys(user).length > 0 && user.maps[0].pivot.has_role) map.addControl(drawControl);

map.on(
    L.Draw.Event.CREATED,
    e => {
        const layer = e.layer;
        layer.bindPopup(user.nickname);

        drawnItems.addLayer(layer);

        const rawLayer = JSON.stringify(layer.toGeoJSON().geometry);

        fetch(
            saveMarkUri,
            {
                'method': 'PUT',
                'mode': 'same-origin',
                'cache': 'no-cache',
                'credentials': 'same-origin',
                'headers': {
                    'Content-Type': 'application/json'
                },
                'redirect': 'follow',
                'referrerPolicy': 'no-referrer',
                'body': {
                    'map_id': map
                }
            }
        );
    }
);
