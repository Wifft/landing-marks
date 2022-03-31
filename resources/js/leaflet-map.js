import makeRequest from "./ajax-helper";

let userMapData = {};
if (user !== null) userMapData = user.maps[0].pivot;

const L = window.L;

const center = [15, -37];
const zoom = 4.4;
const map = L.map(
    'map',
    {
        'minZoom': zoom,
        'zoomSnap': 0.1,
    }
)
    .setView(center, zoom);

const imageUrl = "https://media.fortniteapi.io/images/map.png";
const imageBounds = [[-14.5, -1.5], [40.774, -70.125]];

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
        markerData.ownerId = userData.id;
        markerData.createdAt = userData.pivot.created_at;
        markers.push(markerData);
    }
}

const drawnItems = markers.length > 0 ? L.geoJson(
    markers,
    {
        "onEachFeature": (marker, layer) => {
            console.log(marker);
            const createdAt = new Date(marker.createdAt).toLocaleTimeString();

            layer.bindPopup(
                `
                    <center>
                        ${marker.ownerNickname}
                        <br/>
                        <b>${createdAt}</b>
                    </center>
                `
            );

            switch(marker.type) {
                case 'Point':
                    layer.setIcon(redIcon);

                    break;
                case 'Polygon':
                    layer.setStyle(
                        {
                            color: 'red'
                        }
                    );

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
            polygon: user !== null && userMapData.marker_data === null ? {
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
            marker: user !== null && userMapData.marker_data === null ? {
                icon: redIcon
            } : false,
            polyline: false,
            rectangle: false,
            circle: false,
            circlemarker: false
        },
        edit: {
            edit: false,
            remove: (user !== null && userMapData.marker_data !== null) || userMapData.is_admin,
            featureGroup: drawnItems
        }
    }
);

if (user !== null && Object.keys(user).length > 0 && (userMapData.has_role || userMapData.is_admin)) map.addControl(drawControl);

map.on(
    L.Draw.Event.CREATED,
    e => {
        const layer = e.layer;
        layer.bindPopup(user.nickname);

        drawnItems.addLayer(layer);

        const gsonLayer = layer.toGeoJSON().geometry;
        const rawLayer = JSON.stringify(gsonLayer);

        let requestData = {
            '_method': 'PUT',
            'map_id': mapId,
            'discord_user_id': user.id,
            'marker_data': rawLayer
        };

        makeRequest('POST', saveMarkUri, requestData).then(
            _ => {
                requestData = {
                    'map_id': mapId,
                    'discord_user_id': user.id,
                    'message': `put his spot.`
                };

                makeRequest('POST', storeUserActivityUri, requestData)
                    .then(_ => window.location.reload());
            }
        );

    }
);

map.on(
    L.Draw.Event.DELETED,
    e => {
        const requestData = {
            '_method': 'PUT',
            'map_id': mapId,
            'discord_user_id': user.id,
            'message': `removed his spot.`
        };

        if (userMapData.is_admin) {
            e.layers.eachLayer(
                layer => {
                    const ownerId = layer.feature.geometry.ownerId;
                    requestData.discord_user_id = ownerId;

                    makeRequest('POST', deleteMarkUri, requestData).then(
                        _ => {
                            delete requestData._method;

                            if (ownerId !== user.id) {
                                requestData.message = `removed the spot of ${layer.feature.geometry.ownerNickname}`;
                            }

                            makeRequest('POST', storeUserActivityUri, requestData);
                        }
                    );
                }
            );

            setTimeout(() => window.location.reload(), 2 * 1000)

            return;
        }

        makeRequest('POST', deleteMarkUri, requestData).then(
            _ => {
                delete requestData._method;

                makeRequest('POST', storeUserActivityUri, requestData)
                    .then(_ => window.location.reload());
            }
        );
    }
)
