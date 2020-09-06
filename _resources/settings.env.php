<?php
$env = [
  'db_prefix' => '',
  'files_location' => 'sites/default/files',
  'hash_salt' => 'MVBGFcdHs5IEwHLZzxLy85FB',
  'install_profile' => 'standard',
  'redis' => [
    'enabled' => FALSE,
    'database' => 3, // Required if enabled.
    'host' => 'localhost', // Required if enabled.
    'port' => 6379 // Required if enabled.
  ],
  'solr' => [
    'override' => FALSE,
    'server' => 'solr_server',  // Required if override.
    'name' => 'SOLR server (Overriden)', // Required if override.
    'solr_hostname' => 'localhost', // Optional
    'solr_path' => 'solr', // Optional
    'solr_core' => 'collection1', // Optional
    'solr_port' => '8983', // Optional
  ],
  'error_reporting_enabled' => TRUE, // TRUE dev, test, uat, FALSE live
  'trusted_host_patterns' => [
    '^territory\.test$',
    '^territory\.esdrasterrero\.com',
    '^127\.0.\0.\1$',
    '^localhost$',
  ]
];

$databases['default']['default'] = array (
  'database' => 'territory',
  'username' => 'root',
  'password' => 'root',
  'host' => 'localhost',
  'port' => '3306',
  'driver' => 'mysql',
  'prefix' => '',
  //  'collation' => 'utf8mb4_general_ci',
);

//$config['config_split.config_split.dev']['status'] = TRUE;
$settings['container_yamls'][] = DRUPAL_ROOT . '/sites/default/services.yml';
