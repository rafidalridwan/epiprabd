(function () {
    'use strict';

    var projects = window.projectsMapData || [];
    var mapEl = document.getElementById('projects-map');

    if (!mapEl || !projects.length || typeof L === 'undefined') {
        return;
    }

    var map = L.map(mapEl, {
        scrollWheelZoom: true,
        zoomControl: true,
    });

    L.tileLayer('https://{s}.basemaps.cartocdn.com/light_all/{z}/{x}/{y}{r}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors &copy; <a href="https://carto.com/attributions">CARTO</a>',
        subdomains: 'abcd',
        maxZoom: 19,
    }).addTo(map);

    var markers = {};
    var markerGroup = L.featureGroup();
    var activeMarkerId = null;
    var activePopup = null;

    function escapeHtml(value) {
        return String(value || '')
            .replace(/&/g, '&amp;')
            .replace(/</g, '&lt;')
            .replace(/>/g, '&gt;')
            .replace(/"/g, '&quot;')
            .replace(/'/g, '&#039;');
    }

    function buildPopupContent(project) {
        return (
            '<div class="projects-map-popup__content">' +
                '<div class="projects-map-popup__card">' +
                    '<img class="projects-map-popup__image" src="' + escapeHtml(project.image) + '" alt="' + escapeHtml(project.title) + '">' +
                    '<div class="projects-map-popup__footer">' +
                        '<span class="projects-map-popup__title">' + escapeHtml(project.title) + '</span>' +
                        '<a class="projects-map-popup__link" href="' + escapeHtml(project.url) + '" title="View details" aria-label="View project details">' +
                            '<i class="fa fa-arrow-right"></i>' +
                        '</a>' +
                    '</div>' +
                '</div>' +
            '</div>'
        );
    }

    function setActiveMarker(projectId) {
        activeMarkerId = projectId;

        Object.keys(markers).forEach(function (id) {
            var marker = markers[id];
            var iconEl = marker._icon;

            if (!iconEl) {
                return;
            }

            if (String(id) === String(projectId)) {
                iconEl.classList.add('is-active');
            } else {
                iconEl.classList.remove('is-active');
            }
        });

        document.querySelectorAll('.projects-map-sidebar__item').forEach(function (button) {
            if (String(button.dataset.projectId) === String(projectId)) {
                button.classList.add('is-active');
            } else {
                button.classList.remove('is-active');
            }
        });
    }

    function openPopup(project, marker, shouldPan) {
        if (!marker) {
            return;
        }

        setActiveMarker(project.id);

        if (activePopup) {
            map.closePopup(activePopup);
        }

        activePopup = L.popup({
            className: 'projects-map-popup',
            closeButton: true,
            maxWidth: 240,
            offset: [0, -12],
        })
            .setLatLng([project.lat, project.lng])
            .setContent(buildPopupContent(project))
            .openOn(map);

        if (shouldPan) {
            map.panTo([project.lat, project.lng], { animate: true });
        }
    }

    function createMarkerIcon() {
        return L.divIcon({
            className: 'projects-map-marker',
            html: '<span class="projects-map-marker__pin"><i class="fa fa-building"></i></span>',
            iconSize: [34, 34],
            iconAnchor: [17, 34],
            popupAnchor: [0, -30],
        });
    }

    projects.forEach(function (project) {
        var marker = L.marker([project.lat, project.lng], {
            icon: createMarkerIcon(),
            title: project.title,
        });

        marker.on('mouseover', function () {
            openPopup(project, marker, false);
        });

        marker.on('click', function () {
            openPopup(project, marker, true);
        });

        markers[project.id] = marker;
        markerGroup.addLayer(marker);
    });

    markerGroup.addTo(map);

    if (projects.length === 1) {
        map.setView([projects[0].lat, projects[0].lng], 13);
    } else {
        map.fitBounds(markerGroup.getBounds().pad(0.18));
    }

    document.querySelectorAll('.projects-map-sidebar__item').forEach(function (button) {
        button.addEventListener('mouseenter', function () {
            var projectId = button.dataset.projectId;
            var project = projects.find(function (item) {
                return String(item.id) === String(projectId);
            });

            if (project) {
                openPopup(project, markers[project.id], false);
            }
        });

        button.addEventListener('click', function () {
            var projectId = button.dataset.projectId;
            var project = projects.find(function (item) {
                return String(item.id) === String(projectId);
            });

            if (project) {
                openPopup(project, markers[project.id], true);
            }
        });
    });

    map.on('popupclose', function () {
        activePopup = null;
    });
})();
