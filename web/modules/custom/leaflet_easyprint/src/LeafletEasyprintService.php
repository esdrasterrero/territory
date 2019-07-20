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
    // Added parent function, because it loads libraries through php,
    // inhibiting 'libraries-override'.
    $map_id = isset($map['id']) ? $map['id'] : Html::getUniqueId('leaflet_map');
    $attached_libraries = ['leaflet_easyprint/leaflet-drupal', 'leaflet/general'];
    // Attach the EasyPrint library.
    $attached_libraries[] = 'leaflet_easyprint/leaflet.easyprint';
    // Add the Leaflet Fullscreen library, if requested.
    if (isset($map['settings']['fullscreen_control'])) {
      $attached_libraries[] = 'leaflet/leaflet.fullscreen';
    }
    // Add the Leaflet Markecluster library and functionalities, if requested.
    if ($this->moduleHandler->moduleExists('leaflet_markercluster') && isset($map['settings']['leaflet_markercluster']) && $map['settings']['leaflet_markercluster']['control']) {
      $attached_libraries[] = 'leaflet_markercluster/leaflet-markercluster';
      $attached_libraries[] = 'leaflet_markercluster/leaflet-markercluster-drupal';
    }
    $settings[$map_id] = [
      'mapid' => $map_id,
      'map' => $map,
      // JS only works with arrays, make sure we have one with numeric keys.
      'features' => array_values($features),
    ];
    return [
      '#theme' => 'leaflet_map',
      '#map_id' => $map_id,
      '#height' => $height,
      '#map' => $map,
      '#attached' => [
        'library' => $attached_libraries,
        'drupalSettings' => [
          'leaflet' => $settings,
        ],
      ],
    ];
  }

}
