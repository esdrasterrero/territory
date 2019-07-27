(function($, Drupal, drupalSettings) {
  Drupal.behaviors.leaflet_easyprint = {
    attach: function (context, settings) {
      var easyPrintWidth = 2339;
      var easyPrintHeight = 3308;
      var easyPrintExportOnly = null;

      console.log(drupalSettings.leaflet.easyPrint.easyprint_export);
      if (drupalSettings.leaflet.easyPrint.easyprint_width && drupalSettings.leaflet.easyPrint.easyprint_width) {
        easyPrintWidth = drupalSettings.leaflet.easyPrint.easyprint_width;
        easyPrintHeight = drupalSettings.leaflet.easyPrint.easyprint_height;
      }

      if (drupalSettings.leaflet.easyPrint.easyprint_export > 0) {
        easyPrintExportOnly = true;
      }


      $.each(settings.leaflet, function (m, data) {
        $('#' + data.mapid, context).each(function() {
            /*
             * Initializes map as null.
             */
            var map = null;
            var mapid = data.mapid;
            /*
             * Gets the map object.
             */
            if (typeof data.lMap !== 'undefined' && data.lMap !== null) {
              map = data.lMap;
              var $container = $(this);
              $container.data('leaflet').fitbounds(mapid);

              var s12Portrait = {
                width: easyPrintHeight,
                height: easyPrintWidth,
                className: 's12Portrait',
                tooltip: 's12 Form size portrait mode'
              };

              var s12Landscape = {
                width: easyPrintWidth,
                height: easyPrintHeight,
                className: 's12Landscape',
                tooltip: 's12 Form size landscape mode'
              };

              L.easyPrint({
                title: 'Print',
                position: 'topleft',
                sizeModes: ['Current', 'A4Portrait', 'A4Landscape', s12Portrait, s12Landscape],
                exportOnly: easyPrintExportOnly
              }).addTo(map);
            }
          });
      });
    }
  }
})(jQuery, Drupal, drupalSettings);
