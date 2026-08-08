<?php
/**
 * downloads-config.php
 * ─────────────────────
 * JC 1286 - Phase 3: Self-standing configuration
 * Edit this file to adapt the download center to any website.
 * No changes needed in downloads.php or data.
 */

$downloads_config = [

  // ─── Site Identity ────────────────────────────────────────────────
  'site' => [
    // English (reference only):
    // 'title'    => 'Download center',
    // 'subtitle' => 'Browse manuals, catalogs, and data sheets by category',
    'title'    => 'Downloadcenter',
    'subtitle' => 'Gennemse manualer, kataloger og datablad efter kategori',
  ],

  // ─── Languages ────────────────────────────────────────────────────
  // Recognized language codes extracted from document titles
  'languages' => ['EN', 'DK'],

  // ─── Document Type Order ──────────────────────────────────────────
  'doc_type_order' => [
    'Manuals',
    'Catalogs',
    'Brochures',
    'Data Sheets',
    'Videos',
  ],

  // ─── File Formats ─────────────────────────────────────────────────
  'file_formats' => [
    'PDF'   => ['label' => 'PDF',   'badge' => 'b-pdf',   'icon' => 'fi-pdf'],
    'VIDEO' => ['label' => 'Video', 'badge' => 'b-video', 'icon' => 'fi-video'],
    'XLSX'  => ['label' => 'Excel', 'badge' => 'b-xlsx',  'icon' => 'fi-xlsx'],
    'DXF'   => ['label' => 'DXF',   'badge' => 'b-dxf',   'icon' => 'fi-dxf'],
    'DOCX'  => ['label' => 'Word',  'badge' => 'b-docx',  'icon' => 'fi-docx'],
  ],

  // ─── UI Options ───────────────────────────────────────────────────
  'ui' => [
    'show_doc_count'      => true,
    'show_category_count' => true,
    'show_file_size'      => true,
    'show_file_date'      => true,
    'mobile_sidebar'      => true,
  ],

  // ─── Category Name Translations ───────────────────────────────────
  // Maps the English category key (used internally / in data) to the
  // Danish label shown on the page. Falls back to the key itself if
  // a category isn't listed here.
  'category_labels' => [
    // English (reference only — uncomment block below and comment out
    // the Danish block to revert to English names):
    // 'Automation'    => 'Automation',
    // 'Band & Tie'    => 'Band & Tie',
    // 'Box'           => 'Box',
    // 'General'       => 'General',
    // 'Materials'     => 'Materials',
    // 'Production'    => 'Production',
    // 'Seal'          => 'Seal',
    // 'Shrink'        => 'Shrink',
    // 'Strap'         => 'Strap',
    // 'VFFS & WEIGH'  => 'VFFS & WEIGH',
    // 'Wrap'          => 'Wrap',

    'Automation'    => 'Automatisering',
    'Band & Tie'    => 'Bånd & Bindemaskiner',
    'Box'           => 'Kasser',
    'General'       => 'Generelt',
    'Materials'     => 'Materialer',
    'Production'    => 'Produktion',
    'Seal'          => 'Forsegling',
    'Shrink'        => 'Krympeemballering',
    'Strap'         => 'Omsnøring',
    'VFFS & WEIGH'  => 'VFFS & Vejesystemer',
    'Wrap'          => 'Wrap',
  ],

  // ─── Machine Name Translations ─────────────────────────────────────
  // Maps internal machine names (used in $downloads_structure) to the
  // Danish display label. Falls back to the original name if not listed.
  'machine_labels' => [
    'STEP Z-Shaped Conveyor'            => 'STEP Z-formet transportør',
    'STEP Output Conveyor'              => 'STEP Udløbstransportør',
    'Robotics & Automation'             => 'Robotter & Automatisering',
    'STEP Band 1000'                    => 'STEP Band 1000',
    'STEP LSI String Tiers'             => 'STEP LSI Snørebindere',
    'Box Erection & Closing'            => 'Kasserejsning & Kasselukning',
    'Bag Closing Machines'              => 'Sækkelukkemaskiner',
    'Company Resources'                 => 'Virksomhedsressourcer',
    'Packaging Tapes'                   => 'Pakketape',
    'Stretch Film'                      => 'Strækfilm',
    'Strapping Materials'               => 'Omsnøringsmaterialer',
    'Marking & Labeling'                => 'Mærkning & Etikettering',
    'Loading & Unloading'               => 'Læsning & Aflæsning',
    'Liquid Filling & Capping'          => 'Væskepåfyldning & Kapselpåsætning',
    'Bag Vacuum Gofer'                  => 'Posevakuummaskiner',
    'STEP FRD-1000 Band Sealer'         => 'STEP FRD-1000 Båndforsegler',
    'STEP FR-900 Band Sealer'           => 'STEP FR-900 Båndforsegler',
    'STEP Silver ABS'                   => 'STEP Silver ABS',
    'STEP Auto Impulse'                 => 'STEP Auto Impulsforsegler',
    'Heat Sealing Equipment'            => 'Varmeforseglingsudstyr',
    'Shrink & Filming Equipment'        => 'Krympe- og Folieringsudstyr',
    'STEP TP-502CE'                     => 'STEP TP-502CE',
    'STEP TP-202CE'                     => 'STEP TP-202CE',
    'STEP H48A Battery Tools'           => 'STEP H48A Batteriværktøj',
    'STEP ERGO Strap Table'             => 'STEP ERGO Omsnøringsbord',
    'Hand Strapping Tools'              => 'Håndværktøj til omsnøring',
    'Semi-Automatic Strapping'          => 'Halvautomatisk omsnøring',
    'Fully Automatic Strapping'         => 'Fuldautomatisk omsnøring',
    'Automatic Strapping'               => 'Automatisk omsnøring',
    'Corrugated Strapping'              => 'Omsnøring af bølgepap',
    'Pallet Strapping'                  => 'Palleomsnøring',
    'STEP VFFS + Multihead x10'         => 'STEP VFFS + Multihead x10',
    'E3 Wrap 2100'                      => 'E3 Wrap 2100',
    'STEP Advance Pallet Wrapper X500'  => 'STEP Advance Palleomvikler X500',
    'Horizontal Wrapping Machines'      => 'Horisontale Omviklingsmaskiner',
  ],

  // ─── Labels ───────────────────────────────────────────────────────
  'labels' => [
    // English (reference only — for re-adapting to other sites):
    // 'filter_title'        => 'Filter documents',
    // 'filter_language'     => 'Language',
    // 'filter_doc_type'     => 'Document type',
    // 'filter_file_format'  => 'File format',
    // 'filter_all_langs'    => 'All languages',
    // 'filter_all_types'    => 'All types',
    // 'filter_all_formats'  => 'All formats',
    // 'filter_clear'        => 'Clear',
    // 'filter_clear_all'    => 'Clear all filters',
    // 'no_results'          => 'No documents match your filters',
    // 'no_results_sub'      => 'Try adjusting your selection',
    // 'download_btn'        => 'Download',
    // 'watch_btn'           => 'Watch',
    // 'documents_label'     => 'documents',
    // 'categories_label'    => 'categories',
    // 'total_label'         => 'total',
    // 'search_placeholder'  => 'Search by document or machine name…',

    'filter_title'        => 'Filtrer dokumenter',
    'filter_language'     => 'Sprog',
    'filter_doc_type'     => 'Dokumenttype',
    'filter_file_format'  => 'Filformat',
    'filter_all_langs'    => 'Alle sprog',
    'filter_all_types'    => 'Alle typer',
    'filter_all_formats'  => 'Alle formater',
    'filter_clear'        => 'Ryd',
    'filter_clear_all'    => 'Ryd alle filtre',
    'no_results'          => 'Ingen dokumenter matcher dine filtre',
    'no_results_sub'      => 'Prøv at justere dit valg',
    'download_btn'        => 'Download',
    'watch_btn'           => 'Se video',
    'documents_label'     => 'dokumenter',
    'categories_label'    => 'kategorier',
    'total_label'         => 'i alt',
    'search_placeholder'  => 'Søg efter dokument eller maskinnavn…',
    'nav_all'             => 'Alle',
  ],

  'tracking' => [
    'mode'           => 'api',
    'track_endpoint' => '/wp-content/themes/chris-tailwind-woo/track-download.php',
  ],

];