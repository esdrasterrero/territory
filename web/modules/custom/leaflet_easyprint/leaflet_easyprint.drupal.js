(function($) {
  Drupal.behaviors.leaflet_easyprint = {
    attach: function (context, settings) {
      console.log('easyprint');

      $.each(settings.leaflet, function (m, data) {
        $('#' + data.mapid, context).each(function() {
            /*
             * Initializes map as null.
             */
            var map = null;
            /*
             * Gets the map object.
             */
            if (typeof data.lMap !== 'undefined' && data.lMap !== null) {
              map = data.lMap;

              console.log(map);
              L.easyPrint({
                title: 'My awesome print button',
                position: 'topleft',
                sizeModes: ['A4Portrait', 'A4Landscape']
              }).addTo(map);
            }
          });
      });
    }
  }
})(jQuery, Drupal, drupalSettings);
