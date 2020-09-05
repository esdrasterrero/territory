(function($, Drupal, drupalSettings) {
  Drupal.behaviors.leaflet_easyprint = {
    attach: function (context, settings) {
      var easyPrintWidth = 2339;
      var easyPrintHeight = 3308;
      var easyPrintExportOnly = null;

      $.each(settings.leaflet, function (map_id, data) {
        $('#' + map_id, context).each(function() {
            /*
             * Initializes map as null.
             */
            var lMap = null;
            var mapid = data.mapid;

            if (typeof drupalSettings.leaflet.easyPrint.easyprint_width !== 'undefined' && typeof drupalSettings.leaflet.easyPrint.easyprint_height !== 'undefined') {
              easyPrintWidth = drupalSettings.leaflet.easyPrint.easyprint_width;
              easyPrintHeight = drupalSettings.leaflet.easyPrint.easyprint_height;
            }

            if (drupalSettings.leaflet.easyPrint.easyprint_export > 0) {
              easyPrintExportOnly = true;
            }

            /*
             * Gets the map object.
             */
            if (typeof drupalSettings.leaflet[map_id].lMap !== 'undefined' && drupalSettings.leaflet[map_id].lMap !== null) {
              lMap = drupalSettings.leaflet[map_id].lMap;
              var $container = $(this);
              $container.data('leaflet').fitbounds(mapid);

              var s12Portrait = {
                height: easyPrintWidth,
                width: easyPrintHeight,
                name: 's12 Portrait',
                className: 's12Portrait',
                tooltip: 's12 Form size portrait mode'
              };

              var s12Landscape = {
                height: easyPrintHeight,
                width: easyPrintWidth,
                name: 's12 Landscape',
                className: 's12Landscape',
                tooltip: 's12 Form size landscape mode'
              };

              L.easyPrint({
                title: 'Print',
                position: 'topleft',
                sizeModes: ['Current', 'A4Portrait', 'A4Landscape', s12Portrait, s12Landscape],
                exportOnly: easyPrintExportOnly
              }).addTo(lMap);
            }
          });
      });
    }
  };
})(jQuery, Drupal, drupalSettings);
