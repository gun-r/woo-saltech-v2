<?php
/**
 * track-downloads.php
 * ────────────────────
 * JC 1286 - Phase 4: Download tracking endpoint (MySQL)
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
  $wp_load = dirname( __FILE__ ) . '/../../../wp-load.php';
  if ( file_exists( $wp_load ) ) {
    require_once $wp_load;
  } else {
    http_response_code( 500 );
    echo json_encode( [ 'success' => false, 'message' => 'Could not load WordPress' ] );
    exit;
  }
}

// ─── Headers ─────────────────────────────────────────────────────────────────
header( 'Content-Type: application/json' );
header( 'Access-Control-Allow-Origin: *' );
header( 'Access-Control-Allow-Methods: POST, OPTIONS' );

// Handle preflight
if ( $_SERVER['REQUEST_METHOD'] === 'OPTIONS' ) {
  http_response_code( 204 );
  exit;
}

// ─── GET: Return all counts on page load ─────────────────────────────────────
if ( $_SERVER['REQUEST_METHOD'] === 'GET' && isset( $_GET['action'] ) && $_GET['action'] === 'counts' ) {
  global $wpdb;
  $table = $wpdb->prefix . 'sal_download_logs';
  $rows  = $wpdb->get_results( "SELECT file_id, COUNT(*) as count FROM `{$table}` GROUP BY file_id", ARRAY_A );
  $counts = [];
  foreach ( $rows as $row ) {
    $counts[ $row['file_id'] ] = (int) $row['count'];
  }
  echo json_encode( [ 'success' => true, 'counts' => $counts ] );
  exit;
}

// ─── Read and validate POST body ─────────────────────────────────────────────
$raw  = file_get_contents( 'php://input' );
$data = json_decode( $raw, true );

if ( ! $data || empty( $data['file_id'] ) ) {
  http_response_code( 400 );
  echo json_encode( [ 'success' => false, 'message' => 'Missing file_id' ] );
  exit;
}

// ─── Sanitize fields ─────────────────────────────────────────────────────────
$file_id   = sanitize_text_field( $data['file_id']   ?? '' );
$title     = sanitize_text_field( $data['title']     ?? '' );
$category  = sanitize_text_field( $data['category']  ?? '' );
$machine   = sanitize_text_field( $data['machine']   ?? '' );
$doc_type  = sanitize_text_field( $data['docType']   ?? '' );  // JS sends camelCase
$file_type = sanitize_text_field( $data['fileType']  ?? '' );  // JS sends camelCase
$timestamp = current_time( 'mysql' );
$user_ip   = $_SERVER['REMOTE_ADDR']     ?? '';
$user_agent= $_SERVER['HTTP_USER_AGENT'] ?? '';

// ─── Insert log row ──────────────────────────────────────────────────────────
global $wpdb;
$table = $wpdb->prefix . 'sal_download_logs';

$inserted = $wpdb->insert(
  $table,
  [
    'file_id'    => $file_id,
    'title'      => $title,
    'category'   => $category,
    'machine'    => $machine,
    'doc_type'   => $doc_type,
    'file_type'  => $file_type,
    'logged_at'  => $timestamp,
    'user_ip'    => $user_ip,
    'user_agent' => $user_agent,
  ],
  [ '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s' ]
);

if ( $inserted === false ) {
  http_response_code( 500 );
  echo json_encode( [
    'success' => false,
    'message' => 'DB insert failed',
    'error'   => $wpdb->last_error,
  ] );
  exit;
}

// ─── Get total count for this file ───────────────────────────────────────────
$count = (int) $wpdb->get_var(
  $wpdb->prepare( "SELECT COUNT(*) FROM {$table} WHERE file_id = %s", $file_id )
);

// ─── Return response ─────────────────────────────────────────────────────────
echo json_encode( [
  'success'   => true,
  'file_id'   => $file_id,
  'count'     => $count,
  'timestamp' => $timestamp,
] );
exit;