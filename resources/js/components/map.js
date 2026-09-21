import html2canvas from 'html2canvas';

let map = null;
let locationMarker = null;


/* =========================================================
   INITIALIZE MAP
========================================================= */

export function initMap() {

    if (typeof L === 'undefined') {
        console.error('Leaflet (L) is not available.');
        return null;
    }

    const mapElement = document.getElementById('map');

    if (!mapElement) {
        console.warn('Map element #map not found.');
        return null;
    }


    if (map) {
        return map;
    }


    const defaultLat = 12.0665;
    const defaultLng = 124.5965;


    map = L.map(mapElement, {
        zoomControl: true
    }).setView(
        [defaultLat, defaultLng],
        16
    );


    L.tileLayer(
        'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png',
        {
            maxZoom: 19,
            attribution: '&copy; OpenStreetMap contributors',
            crossOrigin: 'anonymous'
        }
    ).addTo(map);

    locationMarker = L.marker(
        [defaultLat, defaultLng],
        {
            draggable: true
        }
    ).addTo(map);


    locationMarker.bindPopup(
        '<strong>Your House Location</strong>'
    );


    updateInputs(
        defaultLat,
        defaultLng
    );

    map.on('moveend', () => {

        const center = map.getCenter();

        updateInputs(
            center.lat,
            center.lng
        );

    });


    locationMarker.on('dragend', () => {

        const position =
            locationMarker.getLatLng();

        const lat = position.lat;
        const lng = position.lng;

        updateInputs(
            lat,
            lng
        );

        map.setView(
            [lat, lng],
            map.getZoom()
        );

        locationMarker
            .bindPopup(
                `<strong>Your House Location</strong><br>
                 ${lat.toFixed(6)}, ${lng.toFixed(6)}`
            )
            .openPopup();

    });


    map.on('click', (event) => {

        const lat = event.latlng.lat;
        const lng = event.latlng.lng;


        locationMarker.setLatLng(
            [lat, lng]
        );


        updateInputs(
            lat,
            lng
        );


        locationMarker
            .bindPopup(
                `<strong>Your House Location</strong><br>
                 ${lat.toFixed(6)}, ${lng.toFixed(6)}`
            )
            .openPopup();

    });


    return map;
}


/* =========================================================
   UPDATE LATITUDE / LONGITUDE
========================================================= */

function updateInputs(lat, lng) {

    const latitudeInput =
        document.getElementById('latitude');

    const longitudeInput =
        document.getElementById('longitude');


    if (latitudeInput) {
        latitudeInput.value = lat.toFixed(6);
    }


    if (longitudeInput) {
        longitudeInput.value = lng.toFixed(6);
    }

}


/* =========================================================
   GET USER LOCATION
========================================================= */

export function getUserLocation() {

    if (!navigator.geolocation) {

        alert(
            'Geolocation is not supported by your browser.'
        );

        return;
    }


    if (!map) {

        console.warn(
            'Map is not initialized.'
        );

        return;
    }


    navigator.geolocation.getCurrentPosition(


        (position) => {

            const lat =
                position.coords.latitude;

            const lng =
                position.coords.longitude;

            map.setView(
                [lat, lng],
                17
            );


            if (locationMarker) {

                locationMarker.setLatLng(
                    [lat, lng]
                );


                locationMarker
                    .bindPopup(
                        `<strong>Your House Location</strong><br>
                         ${lat.toFixed(6)}, ${lng.toFixed(6)}`
                    )
                    .openPopup();

            }


            updateInputs(
                lat,
                lng
            );

        },


        (error) => {

            switch (error.code) {

                case error.PERMISSION_DENIED:

                    alert(
                        'Location permission was denied.'
                    );

                    break;


                case error.POSITION_UNAVAILABLE:

                    alert(
                        'Location is unavailable.'
                    );

                    break;


                case error.TIMEOUT:

                    alert(
                        'Location request timed out.'
                    );

                    break;


                default:

                    alert(
                        'Unable to get your location.'
                    );

            }

        },


        {
            enableHighAccuracy: true,
            timeout: 10000,
            maximumAge: 0
        }

    );

}
/* =========================================================
   CAPTURE MAP
========================================================= */

export async function captureMap(mapInstance) {

    if (!mapInstance) {
        throw new Error('Map is not initialized.');
    }


    const mapElement =
        document.getElementById('map');


    if (!mapElement) {
        throw new Error('Map element #map not found.');
    }


    /* =====================================================
       FIND MAP STEP
    ===================================================== */

    const mapStep =
        mapElement.closest('.form-step');


    /* =====================================================
       SAVE ORIGINAL DISPLAY STATES
    ===================================================== */

    const originalMapStepDisplay =
        mapStep
            ? mapStep.style.display
            : '';


    const originalMapDisplay =
        mapElement.style.display;


    const originalMapVisibility =
        mapElement.style.visibility;


    const originalMapPosition =
        mapElement.style.position;


    /* =====================================================
       TEMPORARILY SHOW MAP
    ===================================================== */

    if (mapStep) {

        mapStep.style.display = 'block';

    }


    mapElement.style.display = 'block';
    mapElement.style.visibility = 'visible';
    mapElement.style.position = 'relative';


    /* =====================================================
       WAIT FOR BROWSER LAYOUT
    ===================================================== */

    await new Promise(resolve => {

        requestAnimationFrame(() => {

            requestAnimationFrame(resolve);

        });

    });


    /* =====================================================
       REFRESH LEAFLET SIZE
    ===================================================== */

    mapInstance.invalidateSize(true);


    /* =====================================================
       WAIT FOR LEAFLET
    ===================================================== */

    await new Promise(resolve =>
        setTimeout(resolve, 500)
    );


    /* =====================================================
       CHECK MAP DIMENSIONS
    ===================================================== */

    const mapWidth =
        mapElement.offsetWidth;


    const mapHeight =
        mapElement.offsetHeight;


    console.log(
        'Map dimensions before capture:',
        mapWidth,
        'x',
        mapHeight
    );


    if (
        mapWidth <= 0 ||
        mapHeight <= 0
    ) {

        if (mapStep) {
            mapStep.style.display =
                originalMapStepDisplay;
        }

        mapElement.style.display =
            originalMapDisplay;

        mapElement.style.visibility =
            originalMapVisibility;

        mapElement.style.position =
            originalMapPosition;


        throw new Error(
            `Map has invalid dimensions: ${mapWidth}x${mapHeight}`
        );

    }


    /* =====================================================
       CAPTURE
    ===================================================== */

    let canvas;


    try {

        canvas =
            await html2canvas(
                mapElement,
                {
                    useCORS: true,

                    allowTaint: false,

                    scale: 2,

                    backgroundColor: '#ffffff',

                    logging: false,

                    imageTimeout: 15000,

                    removeContainer: true,

                    foreignObjectRendering: false
                }
            );

    }
    catch (error) {

        console.error(
            'html2canvas error:',
            error
        );

        throw error;

    }


    /* =====================================================
       VALIDATE CANVAS
    ===================================================== */

    if (
        !canvas ||
        !canvas.width ||
        !canvas.height
    ) {

        throw new Error(
            `Map capture produced an invalid canvas: ${
                canvas
                    ? `${canvas.width}x${canvas.height}`
                    : 'no canvas'
            }`
        );

    }


    console.log(
        'Canvas generated successfully:',
        canvas.width,
        'x',
        canvas.height
    );


    /* =====================================================
       CONVERT TO PNG
    ===================================================== */

    let dataUrl;


    try {

        dataUrl =
            canvas.toDataURL(
                'image/png'
            );

    }
    catch (error) {

        console.error(
            'Canvas export error:',
            error
        );

        throw new Error(
            'Unable to export map canvas: ' +
            error.message
        );

    }


    /* =====================================================
       VALIDATE DATA URL
    ===================================================== */

    if (
        !dataUrl ||
        !dataUrl.startsWith(
            'data:image/png'
        )
    ) {

        throw new Error(
            'Map capture produced an invalid PNG image.'
        );

    }


    console.log(
        'Map captured successfully.'
    );


    /* =====================================================
       RESTORE ORIGINAL MAP STATE
    ===================================================== */

    if (mapStep) {

        mapStep.style.display =
            originalMapStepDisplay;

    }


    mapElement.style.display =
        originalMapDisplay;


    mapElement.style.visibility =
        originalMapVisibility;


    mapElement.style.position =
        originalMapPosition;


    /* =====================================================
       RETURN IMAGE
    ===================================================== */

    return dataUrl;
}


/* =========================================================
   REFRESH MAP SIZE
========================================================= */

export function refreshMap() {

    if (!map) {
        return;
    }


    setTimeout(() => {

        map.invalidateSize();

    }, 100);

}