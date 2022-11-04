<?php

namespace Drupal\leaflet_easyprint;

use Drupal\leaflet\LeafletService;

/**
 * Provides a  LeafletEasyprintService class.
 */
class LeafletEasyprintService extends LeafletService {

  /**
   * Service function to render the leaflet map.
   *
   * @param array $map
   *   The map settings.
   * @param array $features
   *   The leaflet features on the map.
   * @param string $height
   *   The height of the map.
   *
   * @return array
   *   Returns a config array for rendering.
   */
  public function leafletRenderMap(array $map, array $features = [], $height = '400px') {
    // Attach the EasyPrint library.
    $build = parent::leafletRenderMap($map, $features, $height);

    $build["#attached"]["library"][] = 'leaflet_easyprint/easyprint-general';
    $build["#attached"]["library"][] = 'leaflet_easyprint/leaflet.easyprint';
    $build["#attached"]["library"][] = 'leaflet_easyprint/leaflet-drupal';
    return $build;
  }

  /**
   * Magic method to return any method call inside the inner service.
   */
  public function __call($method, $args) {
    return call_user_func_array(array($this->leafletService, $method), $args);
  }

}
