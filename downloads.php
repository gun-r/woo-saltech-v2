<?php
/**
 * Template Name: Downloads
 * ─────────────────────────
 * JC 1286 - Improved Download Center
 * Phase 1: Visual improvement
 * Phase 2: Filter system (language, doc type, file format)
 * Phase 3: Self-standing config (downloads-config.php)
 * Phase 4: Download count tracking (localStorage → STEPv5 later)
 */
get_header();
require_once get_template_directory() . '/downloads-config.php';

$cfg    = $downloads_config;
$labels = $cfg['labels'];
$ui     = $cfg['ui'];

// ─── Data ─────────────────────────────────────────────────────────────────────
$downloads_structure = [
  'Automation' => [
    'name'     => 'Automation',
    'machines' => [
      'STEP Z-Shaped Conveyor' => [
        'Manuals' => [
          ['title'=>'Manual DK','file_type'=>'PDF','file_size'=>'3.0 MB','date'=>'2024-08-09','download_url'=>'https://docs.sal-tech.com/wp-content/uploads/2023/08/48618010-3218-STEP-Z-shaped-Conveyor-with-Vibration-Hopper-3.2-meter-DK-Manual-JC-253765-230323-DFF-.pdf'],
          ['title'=>'Manual EN','file_type'=>'PDF','file_size'=>'3.0 MB','date'=>'2024-08-09','download_url'=>'https://docs.sal-tech.com/wp-content/uploads/2023/08/48618010-3218-STEP-Z-shaped-Conveyor-with-Vibration-Hopper-3.2-meter-UK-Manual-JC-253765-230323-DFF-.pdf'],
        ],
      ],
      'STEP Output Conveyor' => [
        'Manuals' => [
          ['title'=>'Manual EN','file_type'=>'PDF','file_size'=>'1.0 MB','date'=>'2024-08-09','download_url'=>'https://docs.sal-tech.com/wp-content/uploads/2023/08/48313010-STEP-Output-Conveyor-UK-Manual-JC-253765-100423-DFF-.pdf'],
          ['title'=>'Manual DK','file_type'=>'PDF','file_size'=>'1.0 MB','date'=>'2024-08-09','download_url'=>'https://docs.sal-tech.com/wp-content/uploads/2023/08/48313010-STEP-Output-Conveyor-DK-Manual-JC-253765-100423-DFF-.pdf'],
        ],
        'Catalogs' => [
          ['title'=>'Conveyors Catalog','file_type'=>'PDF','file_size'=>'3.0 MB','date'=>'2022-12-07','download_url'=>'https://docs.sal-tech.com/wp-content/uploads/2021/09/JC-3375-STEP-Catalog-MOVE-CONVEYORS-DEC-2022-051222-GUS.pdf'],
        ],
      ],
      'Robotics & Automation' => [
        'Catalogs' => [
          ['title'=>'STG Robotics Autonomous','file_type'=>'PDF','file_size'=>'485 KB','date'=>'2022-07-15','download_url'=>'https://docs.sal-tech.com/wp-content/uploads/2021/09/JC-3365-STG-Robotics-Autonomous-A-Short-Introduction-140722-GUS.pdf'],
        ],
      ],
    ],
  ],
  'Band & Tie' => [
    'name'     => 'Band & Tie',
    'machines' => [
      'STEP Band 1000' => [
        'Manuals'  => [['title'=>'Manual EN','file_type'=>'PDF','file_size'=>'3.0 MB','date'=>'2024-08-03','download_url'=>'https://docs.sal-tech.com/wp-content/uploads/2023/08/32201000-STEP-Band-1000-Banding-Machine-UK-Manual-011222-DFF.pdf']],
        'Catalogs' => [['title'=>'Banding Machines Catalog','file_type'=>'PDF','file_size'=>'3.0 MB','date'=>'2024-05-28','download_url'=>'https://docs.sal-tech.com/wp-content/uploads/2021/09/JC-3362-STEP-Catalog-BAND-MAY-220524-GUS-1.pdf']],
      ],
      'STEP LSI String Tiers' => [
        'Manuals'  => [['title'=>'Manual EN','file_type'=>'PDF','file_size'=>'5.0 MB','date'=>'2024-03-19','download_url'=>'https://docs.sal-tech.com/wp-content/uploads/2024/03/41330176-STEP-LSI-175-Left-String-Tyer-Manual-UK-version-310122-DFF.pdf']],
        'Catalogs' => [['title'=>'String Tiers Catalog','file_type'=>'PDF','file_size'=>'2.0 MB','date'=>'2024-06-05','download_url'=>'https://docs.sal-tech.com/wp-content/uploads/2021/09/JC-3379-STEP-Catalog-STRING-TIERS-JUN-2024-040624-GUS.pdf']],
      ],
    ],
  ],
  'Box' => [
    'name'     => 'Box',
    'machines' => [
      'Box Erection & Closing' => ['Catalogs'=>[['title'=>'Cases & Boxes Catalog','file_type'=>'PDF','file_size'=>'3.0 MB','date'=>'2021-12-09','download_url'=>'https://docs.sal-tech.com/wp-content/uploads/2021/09/JC-3372-STEP-Catalog-Box-Erect-Close-DEC-2021-051221-GUS.pdf']]],
      'Bag Closing Machines'   => ['Catalogs'=>[['title'=>'Bag Closing Mechanical Catalog','file_type'=>'PDF','file_size'=>'2.0 MB','date'=>'2023-06-21','download_url'=>'https://docs.sal-tech.com/wp-content/uploads/2021/09/JC-3371-STEP-Catalog-Bag-Closing-Mechanical-June-2023-190623-GUS.pdf']]],
    ],
  ],
  'General' => [
    'name'     => 'General',
    'machines' => [
      'Company Resources' => [
        'Brochures' => [['title'=>'STEP Magazine June Release','file_type'=>'PDF','file_size'=>'20.0 MB','date'=>'2023-06-26','download_url'=>'https://docs.sal-tech.com/wp-content/uploads/2023/06/JC-267448-STEP-Magazine-June-Release-230623-DFF.pdf']],
        'Catalogs'  => [['title'=>'Service Catalog','file_type'=>'PDF','file_size'=>'414 KB','date'=>'2022-07-15','download_url'=>'https://docs.sal-tech.com/wp-content/uploads/2021/09/JC-3303-STEP-Catalog-SERVICE-July-2022-140722-GUS-1.pdf']],
      ],
    ],
  ],
  'Materials' => [
    'name'     => 'Materials',
    'machines' => [
      'Packaging Tapes'    => ['Catalogs'=>[['title'=>'STEP Packaging Tapes Catalog','file_type'=>'PDF','file_size'=>'38.7 MB','date'=>'2024-04-03','download_url'=>'https://docs.sal-tech.com/wp-content/uploads/2024/04/JC-283921-STEP-Packaging-Tapes-Catalog-030424-KLV.pdf']]],
      'Stretch Film'       => ['Catalogs'=>[['title'=>'E3 Wrap Film Catalog','file_type'=>'PDF','file_size'=>'11.0 MB','date'=>'2023-11-09','download_url'=>'https://docs.sal-tech.com/wp-content/uploads/2023/10/JC-108010-E3-Wrap-Film-Catalog-v3-031123-DFF-1.pdf']]],
      'Strapping Materials'=> ['Catalogs'=>[['title'=>'Straps, Buckles & Protectors Catalog','file_type'=>'PDF','file_size'=>'1.0 MB','date'=>'2024-07-02','download_url'=>'https://docs.sal-tech.com/wp-content/uploads/2021/09/STEP-Catalog-Straps-Buckles-Protectors-for-Strapping-2.pdf']]],
    ],
  ],
  'Production' => [
    'name'     => 'Production',
    'machines' => [
      'Marking & Labeling'      => ['Catalogs'=>[['title'=>'Mark, Label & Detect Catalog','file_type'=>'PDF','file_size'=>'9.0 MB','date'=>'2021-09-06','download_url'=>'https://docs.sal-tech.com/wp-content/uploads/2021/09/STEP-Catalog-MARK-LABEL-DETTECT.pdf']]],
      'Loading & Unloading'     => ['Catalogs'=>[['title'=>'Load & Unload Catalog','file_type'=>'PDF','file_size'=>'4.0 MB','date'=>'2021-09-06','download_url'=>'https://docs.sal-tech.com/wp-content/uploads/2021/09/STEP-Catalog-Load-Unload.pdf']]],
      'Liquid Filling & Capping'=> ['Catalogs'=>[['title'=>'Liquid Filling Catalog','file_type'=>'PDF','file_size'=>'4.0 MB','date'=>'2021-09-06','download_url'=>'https://docs.sal-tech.com/wp-content/uploads/2021/09/STEP-Catalog-LIQUID-FILLING-CAPPING.pdf']]],
      'Bag Vacuum Gofer'        => ['Data Sheets'=>[['title'=>'Bag Vacuum Gofer Data Sheet','file_type'=>'PDF','file_size'=>'725 KB','date'=>'2024-09-26','download_url'=>'https://docs.sal-tech.com/wp-content/uploads/2024/09/65310000-Bag-Vacuum-Gofer-STEP-Data-Sheet-JC-280380-200624-GUS.docx-1.pdf']]],
    ],
  ],
  'Seal' => [
    'name'     => 'Seal',
    'machines' => [
      'STEP FRD-1000 Band Sealer'=> ['Manuals'=>[['title'=>'Manual EN','file_type'=>'PDF','file_size'=>'2.0 MB','date'=>'2024-08-31','download_url'=>'https://docs.sal-tech.com/wp-content/uploads/2021/08/STEP-FRD-1000-Solid-ink-Coding-Band-Sealer-UK-Manual-1.pdf'],['title'=>'Manual DK','file_type'=>'PDF','file_size'=>'2.0 MB','date'=>'2024-08-31','download_url'=>'https://docs.sal-tech.com/wp-content/uploads/2021/08/STEP-FRD-1000-Solid-ink-Coding-Band-Sealer-DK-Manual-1.pdf']]],
      'STEP FR-900 Band Sealer'  => ['Manuals'=>[['title'=>'Manual EN','file_type'=>'PDF','file_size'=>'2.0 MB','date'=>'2024-08-31','download_url'=>'https://docs.sal-tech.com/wp-content/uploads/2021/08/STEP-FRD-1000-Solid-ink-Coding-Band-Sealer-UK-Manual.pdf'],['title'=>'Manual DK','file_type'=>'PDF','file_size'=>'2.0 MB','date'=>'2024-08-31','download_url'=>'https://docs.sal-tech.com/wp-content/uploads/2021/08/STEP-FRD-1000-Solid-ink-Coding-Band-Sealer-DK-Manual.pdf']]],
      'STEP Silver ABS'          => ['Manuals'=>[['title'=>'Manual EN','file_type'=>'PDF','file_size'=>'2.0 MB','date'=>'2024-08-31','download_url'=>'https://docs.sal-tech.com/wp-content/uploads/2021/08/STEP-Silver-ABS-Manual.pdf']]],
      'STEP Auto Impulse'        => ['Manuals'=>[['title'=>'Manual EN','file_type'=>'PDF','file_size'=>'2.0 MB','date'=>'2024-08-17','download_url'=>'https://docs.sal-tech.com/wp-content/uploads/2021/08/STEP-Auto-Impulse-sealer-EN-Manual.pdf']]],
      'Heat Sealing Equipment'   => ['Catalogs'=>[['title'=>'Heat Sealing Catalog','file_type'=>'PDF','file_size'=>'3.0 MB','date'=>'2023-01-05','download_url'=>'https://docs.sal-tech.com/wp-content/uploads/2021/09/JC-3370-STEP-Catalog-SEAL-HEAT-DEC-2022-091222-GUS-1.pdf']]],
    ],
  ],
  'Shrink' => [
    'name'     => 'Shrink',
    'machines' => [
      'Shrink & Filming Equipment'=> ['Catalogs'=>[['title'=>'Shrink & Filming Catalog','file_type'=>'PDF','file_size'=>'16.0 MB','date'=>'2021-09-06','download_url'=>'https://docs.sal-tech.com/wp-content/uploads/2021/09/STEP-Catalog-SHRINK-FILMING.pdf']]],
    ],
  ],
  'Strap' => [
    'name'     => 'Strap',
    'machines' => [
      'STEP TP-502CE'            => ['Manuals'=>[['title'=>'Manual EN','file_type'=>'PDF','file_size'=>'9.0 MB','date'=>'2024-08-31','download_url'=>'https://docs.sal-tech.com/wp-content/uploads/2021/08/STEP-TP-502CE-UK-Manual-.pdf']]],
      'STEP TP-202CE'            => ['Manuals'=>[['title'=>'Manual EN','file_type'=>'PDF','file_size'=>'6.0 MB','date'=>'2024-08-31','download_url'=>'https://docs.sal-tech.com/wp-content/uploads/2021/08/STEP-TP-202CE-Semi-Automatic-Strapping-Machine-Manual-UK.pdf']]],
      'STEP H48A Battery Tools'  => ['Manuals'=>[['title'=>'Manual EN','file_type'=>'PDF','file_size'=>'2.0 MB','date'=>'2024-08-31','download_url'=>'https://docs.sal-tech.com/wp-content/uploads/2021/08/STEP-DD19A-BATTERY-POWERED-PLASTIC-STRAPPING-TOOL.pdf']]],
      'STEP ERGO Strap Table'    => ['Manuals'=>[['title'=>'Manual EN','file_type'=>'PDF','file_size'=>'7.0 MB','date'=>'2024-08-31','download_url'=>'https://docs.sal-tech.com/wp-content/uploads/2021/08/25001020-STEP-ERGO-Strap-Table-Manual-UK-JC-417-180821-DFF.pdf']]],
      'Hand Strapping Tools'     => ['Catalogs'=>[['title'=>'Hand Tools Catalog','file_type'=>'PDF','file_size'=>'2.0 MB','date'=>'2024-07-02','download_url'=>'https://docs.sal-tech.com/wp-content/uploads/2021/09/STEP-Catalog-Hand-Strapping-Tools-Strap-Wagons-1.pdf']]],
      'Semi-Automatic Strapping' => ['Catalogs'=>[['title'=>'Semi-Automatic Catalog','file_type'=>'PDF','file_size'=>'2.0 MB','date'=>'2024-07-02','download_url'=>'https://docs.sal-tech.com/wp-content/uploads/2021/09/JC-3361-STEP-Catalog-STRAP-JUNE-2024-200624-GUS-1-11.pdf']]],
      'Fully Automatic Strapping'=> ['Catalogs'=>[['title'=>'Fully Automatic Catalog','file_type'=>'PDF','file_size'=>'2.0 MB','date'=>'2024-07-02','download_url'=>'https://docs.sal-tech.com/wp-content/uploads/2021/09/JC-3361-STEP-Catalog-STRAP-JUNE-2024-200624-GUS-23-36.pdf']]],
      'Automatic Strapping'      => ['Catalogs'=>[['title'=>'Automatic Catalog','file_type'=>'PDF','file_size'=>'1.0 MB','date'=>'2024-07-02','download_url'=>'https://docs.sal-tech.com/wp-content/uploads/2021/09/JC-3361-STEP-Catalog-STRAP-JUNE-2024-200624-GUS-12-22.pdf']]],
      'Corrugated Strapping'     => ['Catalogs'=>[['title'=>'Corrugated Catalog','file_type'=>'PDF','file_size'=>'2.0 MB','date'=>'2024-07-02','download_url'=>'https://docs.sal-tech.com/wp-content/uploads/2021/09/STEP-Catalog-Corrugated-Strapping-Machines.pdf']]],
      'Pallet Strapping'         => ['Catalogs'=>[['title'=>'Pallet Strapping Catalog','file_type'=>'PDF','file_size'=>'1.0 MB','date'=>'2024-07-02','download_url'=>'https://docs.sal-tech.com/wp-content/uploads/2021/09/STEP-Catalog-Fully-Automatic-Pallet-Strapping-Machines-1.pdf']]],
    ],
  ],
  'VFFS & WEIGH' => [
    'name'     => 'VFFS & WEIGH',
    'machines' => [
      'STEP VFFS + Multihead x10' => [
        'Manuals'  => [
          ['title'=>'Manual DK','file_type'=>'PDF','file_size'=>'1.0 MB','date'=>'2024-08-09','download_url'=>'https://docs.sal-tech.com/wp-content/uploads/2023/08/48381210-STEP-VFFS-Multihead-x10-System-Complete-DK-Manual-JC-253765-270323-DFF-.pdf'],
          ['title'=>'Manual EN','file_type'=>'PDF','file_size'=>'1.0 MB','date'=>'2024-08-09','download_url'=>'https://docs.sal-tech.com/wp-content/uploads/2023/08/48381210-STEP-VFFS-Multihead-x10-System-Complete-UK-Manual-JC-253765-270323-DFF-.pdf'],
        ],
        'Catalogs' => [['title'=>'VFFS Catalog','file_type'=>'PDF','file_size'=>'5.0 MB','date'=>'2024-06-20','download_url'=>'https://docs.sal-tech.com/wp-content/uploads/2021/09/JC-3367-STEP-Catalog-WEIGH-VFFS-Flowpack-June-2024-200624-GUS.pdf']],
      ],
    ],
  ],
  'Wrap' => [
    'name'     => 'Wrap',
    'machines' => [
      'E3 Wrap 2100' => [
        'Manuals'   => [['title'=>'E3 Wrap 2100 Manual EN','file_type'=>'PDF','file_size'=>'2.0 MB','date'=>'2024-08-31','download_url'=>'https://docs.sal-tech.com/wp-content/uploads/2021/08/E3-Wrap-2100-UK-Manual.pdf']],
        'Brochures' => [
          ['title'=>'E3 Wrap 2100 Main Brochure','file_type'=>'PDF','file_size'=>'22.0 MB','date'=>'2023-07-28','download_url'=>'https://docs.sal-tech.com/wp-content/uploads/2023/06/JC-42122-E3-Wrap-2100-Main-Brochure-16-pages-250523-DFF-1.pdf'],
          ['title'=>'E3 Wrap 2100 Scale Brochure','file_type'=>'PDF','file_size'=>'830 KB','date'=>'2021-08-17','download_url'=>'https://docs.sal-tech.com/wp-content/uploads/2021/08/E3-WRAP-2100-SCALE-SEMI-AUTO-PALLET-WRAPPER.pdf'],
          ['title'=>'E3 Wrap 2100 Buying Guide','file_type'=>'PDF','file_size'=>'6 MB','date'=>'2021-08-17','download_url'=>'https://docs.sal-tech.com/wp-content/uploads/2021/08/E3-Wrap-2100-Guide-to-Buying-Customers-Finish.pdf'],
        ],
        'Videos'    => [
          ['title'=>'E3 Wrap 2100 Operation','file_type'=>'VIDEO','duration'=>'1:40','date'=>'2020-09-04','video_url'=>'https://youtu.be/yqL_XWTbTTk'],
          ['title'=>'E3 Wrap 2100 Semi-Automatic','file_type'=>'VIDEO','duration'=>'2:37','date'=>'2021-01-14','video_url'=>'https://youtu.be/Nt6cg2BuVrA'],
        ],
      ],
      'STEP Advance Pallet Wrapper X500' => [
        'Manuals'  => [['title'=>'Manual EN','file_type'=>'PDF','file_size'=>'10.0 MB','date'=>'2024-08-31','download_url'=>'https://docs.sal-tech.com/wp-content/uploads/2021/08/STEP-Advance-Pallet-Wrapper-X500-Manual-UK-Version.pdf']],
        'Catalogs' => [['title'=>'Pallet Wrapper Catalog','file_type'=>'PDF','file_size'=>'6.0 MB','date'=>'2022-12-07','download_url'=>'https://docs.sal-tech.com/wp-content/uploads/2021/09/JC-3363-STEP-Catalog-WRAP-DEC-2022-051221-GUS-1.pdf']],
      ],
      'Horizontal Wrapping Machines' => [
        'Catalogs' => [['title'=>'Horizontal Wrapping Catalog','file_type'=>'PDF','file_size'=>'3.0 MB','date'=>'2021-09-06','download_url'=>'https://docs.sal-tech.com/wp-content/uploads/2021/09/STEP-Catalog-Horizontal-WRAP.pdf']],
      ],
    ],
  ],
];

// ─── Helpers ──────────────────────────────────────────────────────────────────
ksort($downloads_structure);
$categories = array_keys($downloads_structure);

function dl_extract_lang($title, $languages) {
  $upper = strtoupper($title);
  foreach ($languages as $lang) {
    if (strpos($upper, $lang) !== false) return $lang;
  }
  return null;
}

function dl_make_file_id($category, $machine, $doc_type, $title) {
  return preg_replace('/[^a-z0-9_]/', '_',
    strtolower(implode('__', [$category, $machine, $doc_type, $title]))
  );
}

function dl_get_format_meta($file_type, $cfg) {
  $key = strtoupper($file_type);
  return $cfg['file_formats'][$key] ?? ['label' => $key, 'badge' => 'b-pdf', 'icon' => 'fi-pdf'];
}

function dl_count_machine_files($doc_types) {
  $count = 0;
  foreach ($doc_types as $files) $count += count($files);
  return $count;
}

function dl_count_category_files($machines) {
  $count = 0;
  foreach ($machines as $doc_types) $count += dl_count_machine_files($doc_types);
  return $count;
}

// ─── Per-category icon paths (Tabler-style SVG path data) ────────────────────
function dl_get_category_icon($category_name) {
  $icons = [
    'Automation'    => 'M9 7h6m0 10v-3m-6 3v-3m3-13v3m-7 4h14a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2zm3 4h.01M12 11h.01M15 11h.01',
    'Band & Tie'    => 'M9 12a3 3 0 106 0 3 3 0 10-6 0zM5 5l4 4m10-4l-4 4M5 19l4-4m10 4l-4-4',
    'Box'           => 'M21 8a2 2 0 00-1-1.73l-7-4a2 2 0 00-2 0l-7 4A2 2 0 003 8v8a2 2 0 001 1.73l7 4a2 2 0 002 0l7-4A2 2 0 0021 16V8zM3.27 6.96L12 12.01l8.73-5.05M12 22.08V12',
    'General'       => 'M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8zm0 0v6h6m-10 1h6m-6 4h6',
    'Materials'     => 'M21 7.5L12 3 3 7.5m18 0L12 12m9-4.5v9L12 21m0-9L3 7.5m9 4.5v9m-9-9v9l9 4.5',
    'Production'    => 'M3 21v-7l6-4 6 4 6-4v11M3 21h18M9 21v-4h6v4M5 14l4-3 4 3M11 10l4-3 4 3',
    'Seal'          => 'M12 2c1 3 4 4.5 4 8a4 4 0 11-8 0c0-1.5.7-2.5 1.5-3.5C10 7.5 11 5 12 2zm0 14v6',
    'Shrink'        => 'M4 9V4h5M4 4l6 6m10-1V4h-5m5 0l-6 6M4 15v5h5m-5 0l6-6m10 6l-6-6m6 6v-5h-5',
    'Strap'         => 'M4 8h16M4 16h16M8 4v4m0 8v4m8-16v4m0 8v4M6 8v8m12-8v8',
    'VFFS & WEIGH'  => 'M12 3v2m0 14v2M5 12H3m18 0h-2M7.05 7.05L5.64 5.64m12.72 12.72l-1.41-1.41M7.05 16.95l-1.41 1.41M18.36 5.64l-1.41 1.41M12 8a4 4 0 100 8 4 4 0 000-8z',
    'Wrap'          => 'M12 3a9 9 0 110 18 9 9 0 010-18zm0 3a6 6 0 100 12 6 6 0 000-12zm0 3a3 3 0 110 6 3 3 0 010-6z',
  ];
  return $icons[$category_name] ?? 'M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10';
}

// ─── Translation helpers ──────────────────────────────────────────────────────
// Display labels only — internal keys (used for IDs, search, filters,
// machine_files JSON, etc.) stay in English so the system logic never breaks.
function dl_label_category($category_key, $cfg) {
  return $cfg['category_labels'][$category_key] ?? $category_key;
}

function dl_label_machine($machine_name, $cfg) {
  return $cfg['machine_labels'][$machine_name] ?? $machine_name;
}

// Collect available filters from data
$avail_langs = []; $avail_doc_types = []; $avail_file_types = [];
foreach ($downloads_structure as $cat_data) {
  foreach ($cat_data['machines'] as $machine_name => $doc_types) {
    foreach ($doc_types as $doc_type => $files) {
      $avail_doc_types[$doc_type] = true;
      foreach ($files as $file) {
        $lang = dl_extract_lang($file['title'], $cfg['languages']);
        if ($lang) $avail_langs[$lang] = true;
        $avail_file_types[$file['file_type']] = true;
      }
    }
  }
}
// Sort doc types by configured order
$avail_doc_types = array_keys($avail_doc_types);
usort($avail_doc_types, function($a, $b) use ($cfg) {
  $ai = array_search($a, $cfg['doc_type_order']);
  $bi = array_search($b, $cfg['doc_type_order']);
  $ai = $ai === false ? 999 : $ai;
  $bi = $bi === false ? 999 : $bi;
  return $ai - $bi;
});
$avail_langs      = array_filter(array_keys($avail_langs), fn($l) => in_array($l, $cfg['languages']));
$avail_file_types = array_keys($avail_file_types);
sort($avail_file_types);

$total_docs = 0;
foreach ($downloads_structure as $cat_data) {
  $total_docs += dl_count_category_files($cat_data['machines']);
}

// Letter groups for mobile sidebar
$category_abbreviations = [
  'Automation' => 'AU',
  'Band & Tie' => 'BT',
  'Box' => 'BX',
  'General' => 'GN',
  'Materials' => 'MT',
  'Production' => 'PD',
  'Seal' => 'SE',
  'Shrink' => 'SH',
  'Strap' => 'ST',
  'VFFS & WEIGH' => 'V&W',
  'Wrap' => 'WR',
];

$letter_groups = [];
foreach ($categories as $cat) {
  $letter = $category_abbreviations[$cat] ?? strtoupper(substr($cat, 0, 1));
  $letter_groups[$letter][] = $cat;
}

get_header();
?>

<div class="dl-page">
<div class="dl-wrap">
  <div class="dl-inner">

    <?php /* ── Header ──────────────────────────────────────────── */ ?>
    <div class="dl-topbar">
      <div>
        <h1 class="dl-title">
          <svg class="dl-title-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
          </svg>
          <?php echo esc_html($labels['filter_title'] ? $cfg['site']['title'] : 'Download center'); ?>
        </h1>
        <p class="dl-sub"><?php echo esc_html($cfg['site']['subtitle']); ?></p>
      </div>
      <?php if ($ui['show_doc_count'] || $ui['show_category_count']): ?>
      <div class="dl-count-meta">
        <?php if ($ui['show_doc_count']): ?><?php echo $total_docs; ?> <?php echo esc_html($labels['documents_label']); ?><?php endif; ?>
        <?php if ($ui['show_doc_count'] && $ui['show_category_count']): ?> &nbsp;·&nbsp; <?php endif; ?>
        <?php if ($ui['show_category_count']): ?><?php echo count($categories); ?> <?php echo esc_html($labels['categories_label']); ?><?php endif; ?>
      </div>
      <?php endif; ?>
    </div>

    <?php /* ── Category Nav ─────────────────────────────────────── */ ?>
    <nav class="cat-nav" aria-label="Document categories">
      <button class="cat-btn active" data-filter-cat="all"><?php echo esc_html($labels['nav_all'] ?? 'All'); ?></button>
      <?php foreach ($categories as $cat): ?>
        <button class="cat-btn" data-filter-cat="<?php echo esc_attr(sanitize_title($cat)); ?>">
          <?php echo esc_html(dl_label_category($cat, $cfg)); ?>
        </button>
      <?php endforeach; ?>
    </nav>

    <?php /* ── Search + Filter Bar ──────────────────────────────── */ ?>
    <div class="dl-filter-bar">

      <div class="dl-search-row">
        <svg class="dl-search-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35M11 19a8 8 0 100-16 8 8 0 000 16z"/>
        </svg>
        <input type="text" id="dlSearchInput" class="dl-search-input"
               placeholder="<?php echo esc_attr($labels['search_placeholder'] ?? 'Search by document or machine name…'); ?>" autocomplete="off">
        <button type="button" id="dlSearchClear" class="dl-search-clear hidden" aria-label="Clear search">✕</button>
      </div>

      <p class="dl-filter-title"><?php echo esc_html($labels['filter_title']); ?></p>
      <div class="dl-filter-row">

        <div class="dl-filter-group">
          <label class="dl-filter-label"><?php echo esc_html($labels['filter_language']); ?></label>
          <select class="dl-filter-select" id="filterLang">
            <option value=""><?php echo esc_html($labels['filter_all_langs']); ?></option>
            <?php foreach ($avail_langs as $lang): ?>
              <option value="<?php echo esc_attr($lang); ?>"><?php echo esc_html($lang); ?></option>
            <?php endforeach; ?>
          </select>
        </div>

        <div class="dl-filter-group">
          <label class="dl-filter-label"><?php echo esc_html($labels['filter_doc_type']); ?></label>
          <select class="dl-filter-select" id="filterDocType">
            <option value=""><?php echo esc_html($labels['filter_all_types']); ?></option>
            <?php foreach ($avail_doc_types as $dt): ?>
              <option value="<?php echo esc_attr($dt); ?>"><?php echo esc_html($dt); ?></option>
            <?php endforeach; ?>
          </select>
        </div>

        <div class="dl-filter-group">
          <label class="dl-filter-label"><?php echo esc_html($labels['filter_file_format']); ?></label>
          <select class="dl-filter-select" id="filterFileType">
            <option value=""><?php echo esc_html($labels['filter_all_formats']); ?></option>
            <?php foreach ($avail_file_types as $ft):
              $fmt = dl_get_format_meta($ft, $cfg); ?>
              <option value="<?php echo esc_attr($ft); ?>"><?php echo esc_html($fmt['label']); ?></option>
            <?php endforeach; ?>
          </select>
        </div>

        <button class="dl-filter-clear hidden" id="filterClear">✕ <?php echo esc_html($labels['filter_clear']); ?></button>
      </div>

      <div class="dl-active-chips" id="activeChips"></div>
    </div>

    <?php /* ── Content ──────────────────────────────────────────── */ ?>
    <div id="downloadsContent">
      <?php foreach ($downloads_structure as $cat_key => $cat_data):
        $cat_id   = sanitize_title($cat_key);
        $machines = $cat_data['machines'];
        $cat_count = dl_count_category_files($machines);
      ?>
      <div class="cat-section" id="category-<?php echo $cat_id; ?>" data-cat="<?php echo $cat_id; ?>">

        <div class="cat-header">
          <div class="cat-icon">
            <svg class="cat-icon-svg" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="<?php echo esc_attr(dl_get_category_icon($cat_data['name'])); ?>"/>
            </svg>
          </div>
          <div>
            <p class="cat-name"><?php echo esc_html(dl_label_category($cat_data['name'], $cfg)); ?></p>
            <p class="cat-count"><?php echo $cat_count; ?> <?php echo esc_html($labels['documents_label']); ?></p>
          </div>
          <div class="cat-line"></div>
        </div>

        <?php foreach ($machines as $machine_name => $doc_types):
          $machine_id    = sanitize_title($cat_key . '-' . $machine_name);
          $machine_count = dl_count_machine_files($doc_types);
          if ($machine_count === 0) continue;
        ?>
        <div class="machine-card"
             data-machine-id="<?php echo esc_attr($machine_id); ?>"
             data-machine-files='<?php
               $files_meta = [];
               foreach ($doc_types as $dt => $files) {
                 foreach ($files as $f) {
                   $files_meta[] = [
                     'id'       => dl_make_file_id($cat_key, $machine_name, $dt, $f['title']),
                     'lang'     => dl_extract_lang($f['title'], $cfg['languages']),
                     'doc_type' => $dt,
                     'file_type'=> $f['file_type'],
                   ];
                 }
               }
               echo esc_attr(json_encode($files_meta));
             ?>'>

          <button type="button" class="machine-header" aria-expanded="false">
            <div class="machine-thumb">
              <svg class="machine-thumb-svg" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 3v2m6-2v2M9 19v2m6-2v2M5 9H3m2 6H3m18-6h-2m2 6h-2M7 19h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2zM9 9h6v6H9V9z"/>
              </svg>
            </div>
            <div class="machine-info">
              <p class="machine-name"><?php echo esc_html(dl_label_machine($machine_name, $cfg)); ?></p>
              <p class="machine-meta"><?php echo $machine_count; ?> <?php echo esc_html($labels['documents_label']); ?></p>
            </div>
            <!-- Overall download count pill (populated by JS) -->
            <span class="machine-dl-total hidden" data-machine-total="<?php echo esc_attr($machine_id); ?>">
              <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
              </svg>
              <span class="machine-dl-total-num">0</span> <?php echo esc_html($labels['total_label']); ?>
            </span>
            <svg class="machine-chev" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
            </svg>
          </button>

          <div class="machine-body">
            <?php foreach ($cfg['doc_type_order'] as $doc_type):
              if (!isset($doc_types[$doc_type])) continue;
              $files = $doc_types[$doc_type];
              if (empty($files)) continue;
            ?>
            <div class="doctype-section" data-doctype="<?php echo esc_attr($doc_type); ?>">
              <p class="doctype-label"><?php echo esc_html($doc_type); ?></p>
              <div class="file-grid">
                <?php foreach ($files as $file):
                  $fmt     = dl_get_format_meta($file['file_type'], $cfg);
                  $lang    = dl_extract_lang($file['title'], $cfg['languages']);
                  $file_id = dl_make_file_id($cat_key, $machine_name, $doc_type, $file['title']);
                  $is_video = $file['file_type'] === 'VIDEO';
                  $action_url = $is_video ? ($file['video_url'] ?? '#') : ($file['download_url'] ?? '#');
                ?>
                <div class="file-card"
                     data-lang="<?php echo esc_attr($lang ?? ''); ?>"
                     data-doctype="<?php echo esc_attr($doc_type); ?>"
                     data-filetype="<?php echo esc_attr($file['file_type']); ?>"
                     data-file-id="<?php echo esc_attr($file_id); ?>"
                     data-search="<?php echo esc_attr(strtolower($file['title'] . ' ' . $machine_name . ' ' . $cat_key . ' ' . dl_label_machine($machine_name, $cfg) . ' ' . dl_label_category($cat_key, $cfg))); ?>">

                  <div class="fc-top">
                    <div class="file-icon <?php echo esc_attr($fmt['icon']); ?>">
                      <?php if ($is_video): ?>
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" aria-hidden="true"><path d="M5 3v18l15-9L5 3z" stroke-width="1.2"/></svg>
                      <?php else: ?>
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" aria-hidden="true">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M6 2h7l5 5v13a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2z"/>
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13 2v6h6"/>
                        </svg>
                      <?php endif; ?>
                    </div>
                    <p class="file-name"><?php echo esc_html($file['title']); ?></p>
                  </div>

                  <div class="badges">
                    <?php if ($lang): ?>
                      <span class="badge b-lang"><?php echo esc_html($lang); ?></span>
                    <?php endif; ?>
                    <span class="badge <?php echo esc_attr($fmt['badge']); ?>"><?php echo esc_html($fmt['label']); ?></span>
                  </div>

                  <div class="file-meta">
                    <?php if ($ui['show_file_size'] && !empty($file['file_size'])): ?>
                      <span><?php echo esc_html($file['file_size']); ?></span>
                    <?php endif; ?>
                    <?php if ($ui['show_file_size'] && !empty($file['file_size']) && $ui['show_file_date'] && !empty($file['date'])): ?>
                      <span>·</span>
                    <?php endif; ?>
                    <?php if ($ui['show_file_date'] && !empty($file['date'])): ?>
                      <span><?php echo date('M d, Y', strtotime($file['date'])); ?></span>
                    <?php endif; ?>
                  </div>

                  <div class="fc-footer">
                    <!-- Per-file download count (populated by JS) -->
                    <span class="file-dl-count" data-count-id="<?php echo esc_attr($file_id); ?>">
                      <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                      </svg>
                      <span class="file-dl-num">0</span>
                    </span>
                    <a href="<?php echo esc_url($action_url); ?>"
                       target="_blank"
                       rel="noopener noreferrer"
                       class="dl-btn-sm"
                       data-track-id="<?php echo esc_attr($file_id); ?>"
                       data-track-title="<?php echo esc_attr($file['title']); ?>"
                       data-track-category="<?php echo esc_attr($cat_key); ?>"
                       data-track-machine="<?php echo esc_attr($machine_name); ?>"
                       data-track-doctype="<?php echo esc_attr($doc_type); ?>"
                       data-track-filetype="<?php echo esc_attr($file['file_type']); ?>">
                      <?php echo $is_video ? esc_html($labels['watch_btn']) : esc_html($labels['download_btn']); ?>
                    </a>
                  </div>

                </div>
                <?php endforeach; ?>
              </div>
            </div>
            <?php endforeach; ?>
          </div>
        </div>
        <?php endforeach; ?>

      </div>
      <?php endforeach; ?>

      <!-- No Results -->
      <div class="dl-no-results hidden" id="noResults">
        <svg class="dl-no-results-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
        </svg>
        <p class="dl-no-results-title"><?php echo esc_html($labels['no_results']); ?></p>
        <p class="dl-no-results-sub"><?php echo esc_html($labels['no_results_sub']); ?></p>
        <button onclick="dlClearFilters()" class="dl-clear-all-btn"><?php echo esc_html($labels['filter_clear_all']); ?></button>
      </div>
    </div>

    <?php /* ── Mobile Sidebar ───────────────────────────────────── */ ?>
    <?php if ($ui['mobile_sidebar']): ?>
    <div class="dl-mobile-sidebar-wrap" aria-label="Category navigation">
      <div class="dl-mobile-sidebar" id="mobileSidebar">
        <button class="dl-sidebar-toggle" id="sidebarToggle" aria-label="Toggle category menu">
          <svg class="sidebar-icon-open" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 19l-7-7 7-7m8 14l-7-7 7-7"/>
          </svg>
          <svg class="sidebar-icon-close hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5l7 7-7 7M5 5l7 7-7 7"/>
          </svg>
        </button>
        <div class="dl-sidebar-list">
          <?php foreach ($letter_groups as $letter => $cats): ?>
          <div class="sidebar-letter-group">
            <div class="sidebar-letter-header"><?php echo esc_html($letter); ?></div>
            <?php foreach ($cats as $cat):
              $cat_id = sanitize_title($cat); ?>
            <a href="#category-<?php echo $cat_id; ?>"
               class="sidebar-cat-link"
               data-cat="<?php echo esc_attr($cat_id); ?>">
              <span class="sidebar-cat-initial"><?php echo esc_html($category_abbreviations[$cat] ?? strtoupper(substr($cat, 0, 1))); ?></span>
              <span class="sidebar-cat-name"><?php echo esc_html(dl_label_category($cat, $cfg)); ?></span>
            </a>
            <?php endforeach; ?>
          </div>
          <?php endforeach; ?>
        </div>
      </div>
    </div>
    <?php endif; ?>

  </div>
</div>
</div>

<?php /* ── Styles ───────────────────────────────────────────────────── */ ?>
<style>
:root {
  --dl-text-primary:   #111827;
  --dl-text-secondary: #6b7280;
  --dl-text-tertiary:  #9ca3af;
  --dl-bg-primary:     #ffffff;
  --dl-bg-secondary:   #f8fafc;
  --dl-border:         #e5e7eb;
  --dl-border-md:      #d1d5db;
  --dl-radius-md:      0.75rem;
  --dl-radius-lg:      1rem;
  --dl-red:            #dc2626;
  --dl-red-hover:      #b91c1c;
}
html { scroll-behavior: smooth; }
.dl-page { background: linear-gradient(to bottom, #f8fafc, #fff); min-height: 100vh; padding: 2rem 0; }
.dl-wrap { max-width: 80rem; margin: 0 auto; padding: 0 1rem; }
.dl-inner { position: relative; }

/* Topbar */
.dl-topbar { display: flex; align-items: flex-start; justify-content: space-between; margin-bottom: 1.5rem; flex-wrap: wrap; gap: 8px; }
.dl-title { font-size: 18px; font-weight: 500; color: var(--dl-text-primary); margin: 0; display: flex; align-items: center; gap: 8px; }
.dl-title-icon { width: 20px; height: 20px; flex-shrink: 0; }
.dl-sub { font-size: 13px; color: var(--dl-text-secondary); margin: 4px 0 0; }
.dl-count-meta { font-size: 12px; color: var(--dl-text-tertiary); white-space: nowrap; }

/* Category Nav */
.cat-nav { display: flex; gap: 6px; flex-wrap: wrap; margin-bottom: 1.5rem; padding-bottom: 1rem; border-bottom: 0.5px solid var(--dl-border); }
.cat-btn { font-size: 12px; padding: 5px 12px; border-radius: 99px; border: 0.5px solid var(--dl-border-md); background: transparent; cursor: pointer; color: var(--dl-text-secondary); transition: all .15s; }
.cat-btn:hover, .cat-btn.active { background: #fee2e2; color: var(--dl-red); border-color: var(--dl-border-md); }

/* Filter Bar */
.dl-filter-bar { background: var(--dl-bg-secondary); border: 0.5px solid var(--dl-border); border-radius: var(--dl-radius-lg); padding: 1rem; margin-bottom: 1.5rem; }
.dl-search-row { position: relative; margin-bottom: 1rem; }
.dl-search-icon { position: absolute; left: 12px; top: 50%; transform: translateY(-50%); width: 16px; height: 16px; color: var(--dl-text-tertiary); pointer-events: none; }
.dl-search-input { width: 100%; padding: 10px 36px 10px 38px; font-size: 14px; border: 0.5px solid var(--dl-border-md); border-radius: 8px; background: var(--dl-bg-primary); color: var(--dl-text-primary); }
.dl-search-input:focus { outline: none; border-color: var(--dl-red); box-shadow: 0 0 0 2px rgba(220,38,38,.1); }
.dl-search-clear { position: absolute; right: 10px; top: 50%; transform: translateY(-50%); background: none; border: none; cursor: pointer; color: var(--dl-text-tertiary); font-size: 13px; padding: 4px; line-height: 1; }
.dl-search-clear:hover { color: var(--dl-text-secondary); }
.dl-search-clear.hidden { display: none; }
.dl-filter-title { font-size: 13px; font-weight: 500; color: var(--dl-text-primary); margin: 0 0 .75rem; }
.dl-filter-row { display: flex; flex-wrap: wrap; gap: .75rem; align-items: flex-end; margin-bottom: .75rem; }
.dl-filter-group { display: flex; flex-direction: column; gap: 4px; }
.dl-filter-label { font-size: 11px; font-weight: 500; color: var(--dl-text-secondary); }
.dl-filter-select { padding: 6px 10px; font-size: 13px; border: 0.5px solid var(--dl-border-md); border-radius: 6px; background: var(--dl-bg-primary); color: var(--dl-text-primary); }
.dl-filter-clear { padding: 6px 12px; font-size: 12px; border: 0.5px solid #fca5a5; color: var(--dl-red); border-radius: 6px; background: transparent; cursor: pointer; }
.dl-filter-clear:hover { background: #fee2e2; }
.dl-active-chips { display: flex; flex-wrap: wrap; gap: 6px; }
.dl-chip { display: inline-flex; align-items: center; gap: 6px; padding: 3px 10px; border-radius: 99px; font-size: 11px; }
.dl-chip-lang   { background: #FAEEDA; color: #633806; border: 0.5px solid #EF9F27; }
.dl-chip-type   { background: #dcfce7; color: #14532d; border: 0.5px solid #86efac; }
.dl-chip-format { background: #ede9fe; color: #4c1d95; border: 0.5px solid #c4b5fd; }
.dl-chip button { background: none; border: none; cursor: pointer; padding: 0; line-height: 1; font-size: 12px; color: inherit; }

/* Category Section */
.cat-section { margin-bottom: 2rem; }
.cat-header { display: flex; align-items: center; gap: 10px; margin-bottom: 1rem; }
.cat-icon { width: 36px; height: 36px; border-radius: var(--dl-radius-md); background: #fee2e2; display: flex; align-items: center; justify-content: center; flex-shrink: 0; }
.cat-icon-svg { width: 20px; height: 20px; color: var(--dl-red); }
.cat-name { font-size: 15px; font-weight: 500; color: var(--dl-text-primary); margin: 0; }
.cat-count { font-size: 12px; color: var(--dl-text-tertiary); margin: 0; }
.cat-line { flex: 1; height: 0.5px; background: var(--dl-border); }

/* Machine Card */
.machine-card { background: var(--dl-bg-primary); border: 0.5px solid var(--dl-border); border-radius: var(--dl-radius-lg); margin-bottom: 8px; overflow: hidden; }
.machine-header { display: flex; align-items: center; gap: 12px; padding: .75rem 1rem; cursor: pointer; background: transparent; border: none; width: 100%; text-align: left; }
.machine-header:hover { background: var(--dl-bg-secondary); }
.machine-thumb { width: 40px; height: 40px; border-radius: var(--dl-radius-md); background: var(--dl-bg-secondary); border: 0.5px solid var(--dl-border); display: flex; align-items: center; justify-content: center; flex-shrink: 0; }
.machine-thumb-svg { width: 20px; height: 20px; color: var(--dl-text-secondary); }
.machine-info { flex: 1; min-width: 0; }
.machine-name { font-size: 14px; font-weight: 500; color: var(--dl-text-primary); margin: 0; }
.machine-meta { font-size: 12px; color: var(--dl-text-tertiary); margin: 2px 0 0; }
.machine-dl-total { display: inline-flex; align-items: center; gap: 5px; padding: 3px 10px; font-size: 12px; font-weight: 500; color: var(--dl-text-secondary); background: var(--dl-bg-secondary); border: 0.5px solid var(--dl-border); border-radius: 99px; white-space: nowrap; margin-right: 8px; }
.machine-dl-total.hidden { display: none; }
.machine-chev { width: 20px; height: 20px; color: var(--dl-text-tertiary); flex-shrink: 0; transition: transform .2s; }
.machine-header[aria-expanded="true"] .machine-chev { transform: rotate(180deg); }
.machine-body { border-top: 0.5px solid var(--dl-border); padding: .75rem 1rem; background: var(--dl-bg-secondary); display: none; }
.machine-body.open { display: block; }

/* Doc Type */
.doctype-section { margin-bottom: 12px; }
.doctype-label { font-size: 11px; font-weight: 500; color: var(--dl-text-tertiary); text-transform: uppercase; letter-spacing: .06em; margin: 0 0 8px; }

/* File Grid & Card */
.file-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(190px, 1fr)); gap: 8px; }
.file-card { background: var(--dl-bg-primary); border: 0.5px solid var(--dl-border); border-radius: var(--dl-radius-md); padding: .75rem; display: flex; flex-direction: column; gap: 8px; transition: border-color .15s; }
.file-card:hover { border-color: var(--dl-border-md); }
.file-card.hidden { display: none; }
.fc-top { display: flex; align-items: center; gap: 8px; }
.file-icon { width: 32px; height: 36px; border-radius: 6px; display: flex; align-items: center; justify-content: center; flex-shrink: 0; }
.fi-pdf   { background: #FCEBEB; color: #A32D2D; }
.fi-video { background: #E5F6FF; color: #1D4ED8; }
.fi-xlsx  { background: #EAF3DE; color: #27500A; }
.fi-dxf   { background: #EEEDFE; color: #3C3489; }
.fi-docx  { background: #E6F1FB; color: #0C447C; }
.file-name { font-size: 13px; font-weight: 500; color: var(--dl-text-primary); margin: 0; line-height: 1.3; }
.badges { display: flex; gap: 4px; flex-wrap: wrap; }
.badge { font-size: 11px; padding: 2px 8px; border-radius: 99px; white-space: nowrap; }
.b-lang  { background: #FAEEDA; color: #633806; border: 0.5px solid #EF9F27; }
.b-pdf   { background: #FCEBEB; color: #791F1F; border: 0.5px solid #F09595; }
.b-video { background: #E5F6FF; color: #1D4ED8; border: 0.5px solid #93C5FD; }
.b-xlsx  { background: #EAF3DE; color: #27500A; border: 0.5px solid #97C459; }
.b-dxf   { background: #EEEDFE; color: #3C3489; border: 0.5px solid #AFA9EC; }
.b-docx  { background: #E6F1FB; color: #0C447C; border: 0.5px solid #85B7EB; }
.file-meta { font-size: 11px; color: var(--dl-text-tertiary); display: flex; align-items: center; gap: 4px; }
.fc-footer { display: flex; align-items: center; justify-content: space-between; border-top: 0.5px solid var(--dl-border); padding-top: 8px; margin-top: auto; }
.file-dl-count { display: inline-flex; align-items: center; gap: 4px; font-size: 11px; color: var(--dl-text-tertiary); }
.file-dl-count .w-3 { width: 12px; height: 12px; }
.dl-btn-sm { display: inline-flex; align-items: center; gap: 4px; font-size: 12px; padding: 5px 12px; border-radius: var(--dl-radius-md); border: 0.5px solid var(--dl-border-md); background: transparent; cursor: pointer; color: var(--dl-text-primary); text-decoration: none; transition: background .15s; white-space: nowrap; }
.dl-btn-sm:hover { background: var(--dl-bg-secondary); }

/* No Results */
.dl-no-results { text-align: center; padding: 3rem 0; }
.dl-no-results.hidden { display: none; }
.dl-no-results-icon { width: 48px; height: 48px; color: var(--dl-text-tertiary); margin: 0 auto 1rem; }
.dl-no-results-title { font-size: 16px; font-weight: 500; color: var(--dl-text-secondary); margin: 0; }
.dl-no-results-sub { font-size: 13px; color: var(--dl-text-tertiary); margin: 4px 0 1rem; }
.dl-clear-all-btn { padding: 8px 16px; background: var(--dl-red); color: #fff; border: none; border-radius: 6px; font-size: 13px; font-weight: 500; cursor: pointer; }
.dl-clear-all-btn:hover { background: var(--dl-red-hover); }

/* Mobile Sidebar */
.dl-mobile-sidebar-wrap { position: fixed; right: 0; top: 0; bottom: 0; z-index: 40; pointer-events: none; display: flex; align-items: center; }
@media (min-width: 1024px) { .dl-mobile-sidebar-wrap { display: none; } }
.dl-mobile-sidebar { pointer-events: auto; background: var(--dl-bg-primary); border-radius: .75rem 0 0 .75rem; box-shadow: 0 4px 24px rgba(0,0,0,.12); border: 0.5px solid var(--dl-border); overflow: hidden; max-height: 80vh; width: 3rem; transition: width .3s ease; }
.dl-mobile-sidebar.expanded { width: 14rem; }
.dl-sidebar-toggle { width: 100%; padding: .75rem .5rem; background: #4b5563; color: #fff; border: none; border-bottom: 0.5px solid #374151; cursor: pointer; display: flex; align-items: center; justify-content: center; }
.dl-sidebar-toggle:hover { background: #374151; }
.dl-sidebar-toggle svg { width: 20px; height: 20px; }
.dl-sidebar-list { overflow-y: auto; max-height: calc(80vh - 3rem); }
.sidebar-letter-header { padding: 6px 12px; font-size: 12px; font-weight: 700; color: var(--dl-text-secondary); background: var(--dl-bg-secondary); border-bottom: 0.5px solid var(--dl-border); display: none; }
.dl-mobile-sidebar.expanded .sidebar-letter-header { display: block; }
.sidebar-cat-link { display: block; padding: 10px .75rem; font-size: 12px; font-weight: 500; color: var(--dl-text-secondary); border-bottom: 0.5px solid var(--dl-border); text-decoration: none; transition: all .15s; }
.sidebar-cat-link:hover, .sidebar-cat-link.active { background: var(--dl-red); color: #fff; }
.sidebar-cat-initial { display: block; text-align: center; font-weight: 700; }
.sidebar-cat-name { display: none; white-space: nowrap; }
.dl-mobile-sidebar.expanded .sidebar-cat-initial { display: none; }
.dl-mobile-sidebar.expanded .sidebar-cat-name { display: block; }
.sidebar-icon-close.hidden, .sidebar-icon-open.hidden { display: none; }

/* Hidden utility */
.hidden { display: none !important; }
</style>

<?php /* ── Scripts ──────────────────────────────────────────────────── */ ?>
<script>
(function () {

  // ─── Config (from PHP) ──────────────────────────────────────────────────────
  var TRACK_ENDPOINT = '<?php echo esc_js($cfg["tracking"]["track_endpoint"]); ?>';
  var LANGUAGES      = <?php echo json_encode(array_values($avail_langs)); ?>;

  // ─── In-memory counts (loaded from MySQL on page load) ────────────────────
  var dlCounts = {};

  function getCount(fileId) {
    return dlCounts[fileId] || 0;
  }

  // ─── Load all counts from MySQL on page load ──────────────────────────────
  function loadCountsFromDB() {
    fetch(TRACK_ENDPOINT + '?action=counts')
      .then(function(r) { return r.json(); })
      .then(function(data) {
        if (data.success && data.counts) {
          dlCounts = data.counts;
          renderAllCounts();
        }
      })
      .catch(function(e) {
        console.warn('[DL] Could not load counts from DB:', e);
      });
  }

  // ─── Track download → POST to MySQL → update count in UI ─────────────────
  function trackDownload(fileId, meta) {
    fetch(TRACK_ENDPOINT, {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify({
        file_id:  fileId,
        title:    meta.title,
        category: meta.category,
        machine:  meta.machine,
        docType:  meta.docType,
        fileType: meta.fileType,
      })
    })
    .then(function(r) { return r.json(); })
    .then(function(data) {
      if (data.success && data.count !== undefined) {
        dlCounts[fileId] = data.count;
        renderAllCounts();
      }
    })
    .catch(function(e) {
      console.warn('[DL] Track failed:', e);
      dlCounts[fileId] = (dlCounts[fileId] || 0) + 1;
      renderAllCounts();
    });
  }

  // ─── Render counts ────────────────────────────────────────────────────────
  function renderAllCounts() {
    document.querySelectorAll('[data-count-id]').forEach(function(el) {
      var count = getCount(el.dataset.countId);
      el.querySelector('.file-dl-num').textContent = count;
    });

    document.querySelectorAll('.machine-card').forEach(function(card) {
      var files = JSON.parse(card.dataset.machineFiles || '[]');
      var total = files.reduce(function(sum, f) { return sum + getCount(f.id); }, 0);
      var pill  = card.querySelector('.machine-dl-total');
      var numEl = card.querySelector('.machine-dl-total-num');
      if (pill && numEl) {
        numEl.textContent = total;
        if (total > 0) pill.classList.remove('hidden');
        else pill.classList.add('hidden');
      }
    });
  }

  // ─── Download click handler ───────────────────────────────────────────────
  document.querySelectorAll('[data-track-id]').forEach(function(link) {
    link.addEventListener('click', function() {
      var id   = this.dataset.trackId;
      var meta = {
        title:    this.dataset.trackTitle,
        category: this.dataset.trackCategory,
        machine:  this.dataset.trackMachine,
        docType:  this.dataset.trackDoctype,
        fileType: this.dataset.trackFiletype,
      };
      trackDownload(id, meta);
    });
  });

  // ─── Machine accordion ───────────────────────────────────────────────────────
  document.querySelectorAll('.machine-header').forEach(function(btn) {
    btn.addEventListener('click', function() {
      var body     = this.nextElementSibling;
      var isOpen   = body.classList.contains('open');

      // Close all
      document.querySelectorAll('.machine-body.open').forEach(function(b) {
        b.classList.remove('open');
        b.previousElementSibling.setAttribute('aria-expanded', 'false');
      });

      // Open clicked
      if (!isOpen) {
        body.classList.add('open');
        this.setAttribute('aria-expanded', 'true');
      }
    });
  });

  // ─── Filter system ───────────────────────────────────────────────────────────
  var filterLang     = '';
  var filterDocType  = '';
  var filterFileType = '';
  var searchQuery    = '';
  var activeCat      = 'all';

  function extractLang(title) {
    var upper = title.toUpperCase();
    for (var i = 0; i < LANGUAGES.length; i++) {
      if (upper.indexOf(LANGUAGES[i]) !== -1) return LANGUAGES[i];
    }
    return '';
  }

  function applyFilters() {
    var anyVisible = false;

    document.querySelectorAll('.cat-section').forEach(function(section) {
      var catId     = section.dataset.cat;
      var catMatch  = !activeCat || activeCat === 'all' || activeCat === catId;
      var catHasDoc = false;

      section.querySelectorAll('.file-card').forEach(function(card) {
        var langMatch   = !filterLang     || card.dataset.lang === filterLang;
        var typeMatch   = !filterDocType  || card.dataset.doctype === filterDocType;
        var fmtMatch    = !filterFileType || card.dataset.filetype === filterFileType;
        var searchMatch = !searchQuery    || (card.dataset.search || '').indexOf(searchQuery) !== -1;
        var visible     = catMatch && langMatch && typeMatch && fmtMatch && searchMatch;
        card.classList.toggle('hidden', !visible);
        if (visible) catHasDoc = true;
      });

      // Hide doc type sections if all their cards are hidden
      section.querySelectorAll('.doctype-section').forEach(function(ds) {
        var hasVisible = ds.querySelectorAll('.file-card:not(.hidden)').length > 0;
        ds.style.display = hasVisible ? '' : 'none';
      });

      // When searching, also hide machine cards with no visible files
      section.querySelectorAll('.machine-card').forEach(function(mc) {
        var hasVisible = mc.querySelectorAll('.file-card:not(.hidden)').length > 0;
        mc.style.display = hasVisible ? '' : 'none';
        // Auto-expand machine card body when searching so results are visible
        if (searchQuery && hasVisible) {
          var body = mc.querySelector('.machine-body');
          var header = mc.querySelector('.machine-header');
          if (body && !body.classList.contains('open')) {
            body.classList.add('open');
            header.setAttribute('aria-expanded', 'true');
          }
        }
      });

      section.style.display = (catMatch && catHasDoc) ? '' : 'none';
      if (catMatch && catHasDoc) anyVisible = true;
    });

    document.getElementById('noResults').classList.toggle('hidden', anyVisible);
    renderChips();
    updateClearBtn();
  }

  function renderChips() {
    var chips = document.getElementById('activeChips');
    chips.innerHTML = '';
    if (filterLang) {
      chips.innerHTML += '<span class="dl-chip dl-chip-lang"><?php echo esc_js($labels['filter_language']); ?>: ' + filterLang + ' <button onclick="dlRemoveFilter(\'lang\')">✕</button></span>';
    }
    if (filterDocType) {
      chips.innerHTML += '<span class="dl-chip dl-chip-type"><?php echo esc_js($labels['filter_doc_type']); ?>: ' + filterDocType + ' <button onclick="dlRemoveFilter(\'doctype\')">✕</button></span>';
    }
    if (filterFileType) {
      chips.innerHTML += '<span class="dl-chip dl-chip-format"><?php echo esc_js($labels['filter_file_format']); ?>: ' + filterFileType + ' <button onclick="dlRemoveFilter(\'filetype\')">✕</button></span>';
    }
  }

  function updateClearBtn() {
    var hasFilter = filterLang || filterDocType || filterFileType;
    document.getElementById('filterClear').classList.toggle('hidden', !hasFilter);
  }

  window.dlRemoveFilter = function(type) {
    if (type === 'lang')     { filterLang = '';     document.getElementById('filterLang').value = ''; }
    if (type === 'doctype')  { filterDocType = '';  document.getElementById('filterDocType').value = ''; }
    if (type === 'filetype') { filterFileType = ''; document.getElementById('filterFileType').value = ''; }
    applyFilters();
  };

  window.dlClearFilters = function() {
    filterLang = ''; filterDocType = ''; filterFileType = ''; searchQuery = '';
    document.getElementById('filterLang').value     = '';
    document.getElementById('filterDocType').value  = '';
    document.getElementById('filterFileType').value = '';
    document.getElementById('dlSearchInput').value  = '';
    document.getElementById('dlSearchClear').classList.add('hidden');
    applyFilters();
  };

  document.getElementById('filterLang').addEventListener('change',     function() { filterLang     = this.value; applyFilters(); });
  document.getElementById('filterDocType').addEventListener('change',  function() { filterDocType  = this.value; applyFilters(); });
  document.getElementById('filterFileType').addEventListener('change', function() { filterFileType = this.value; applyFilters(); });
  document.getElementById('filterClear').addEventListener('click', window.dlClearFilters);

  // ─── Search box ───────────────────────────────────────────────────────────────
  var searchInput = document.getElementById('dlSearchInput');
  var searchClear = document.getElementById('dlSearchClear');
  var searchDebounce;

  searchInput.addEventListener('input', function() {
    clearTimeout(searchDebounce);
    var val = this.value;
    searchClear.classList.toggle('hidden', val.length === 0);
    searchDebounce = setTimeout(function() {
      searchQuery = val.trim().toLowerCase();
      applyFilters();
    }, 150);
  });

  searchClear.addEventListener('click', function() {
    searchInput.value = '';
    searchQuery = '';
    searchClear.classList.add('hidden');
    applyFilters();
    searchInput.focus();
  });

  // ─── Category nav ────────────────────────────────────────────────────────────
  document.querySelectorAll('.cat-btn').forEach(function(btn) {
    btn.addEventListener('click', function() {
      activeCat = this.dataset.filterCat;
      document.querySelectorAll('.cat-btn').forEach(function(b) { b.classList.remove('active'); });
      this.classList.add('active');

      if (activeCat === 'all') {
        window.scrollTo({top: 0, behavior: 'smooth'});
      } else {
        var el = document.getElementById('category-' + activeCat);
        if (el) window.scrollTo({top: el.offsetTop - 100, behavior: 'smooth'});
      }
      applyFilters();
    });
  });

  // ─── Mobile sidebar ──────────────────────────────────────────────────────────
  var sidebar = document.getElementById('mobileSidebar');
  var toggle  = document.getElementById('sidebarToggle');
  if (sidebar && toggle) {
    toggle.addEventListener('click', function() {
      var expanded = sidebar.classList.toggle('expanded');
      sidebar.querySelector('.sidebar-icon-open').classList.toggle('hidden', expanded);
      sidebar.querySelector('.sidebar-icon-close').classList.toggle('hidden', !expanded);
    });

    sidebar.querySelectorAll('.sidebar-cat-link').forEach(function(link) {
      link.addEventListener('click', function(e) {
        e.preventDefault();
        var catId = this.dataset.cat;
        activeCat = catId;
        var el = document.getElementById('category-' + catId);
        if (el) window.scrollTo({top: el.offsetTop - 20, behavior: 'smooth'});
        setTimeout(function() { sidebar.classList.remove('expanded'); }, 300);
        applyFilters();
      });
    });
  }

  // ─── Scroll: active category highlight ──────────────────────────────────────
  window.addEventListener('scroll', function() {
    if (activeCat !== 'all') return;
    var scrollPos = window.scrollY + 200;
    document.querySelectorAll('.cat-section').forEach(function(section) {
      if (scrollPos >= section.offsetTop && scrollPos < section.offsetTop + section.offsetHeight) {
        var id = section.id.replace('category-', '');
        document.querySelectorAll('.cat-btn').forEach(function(b) {
          b.classList.toggle('active', b.dataset.filterCat === id);
        });
      }
    });
  }, {passive: true});

  // ─── Init ────────────────────────────────────────────────────────────────────
  loadCountsFromDB(); // Fetch shared counts from MySQL on page load

})();
</script>

<?php get_footer(); ?>