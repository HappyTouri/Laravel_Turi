<?php

return [
    'show_warnings' => false,
    'public_path' => null,
    'convert_entities' => true,
    'options' => [
        'font_dir' => storage_path('fonts'), // Directory for storing custom fonts
        'font_cache' => storage_path('fonts'), // Cache directory for fonts
        'temp_dir' => sys_get_temp_dir(),
        'fontdata' => [
            'cairo' => [
                'R' => 'Cairo.ttf', // Regular font
                'B' => 'Cairo-Bold.ttf', // Bold font (if exists)
            ],
            'amiri' => [
                'R' => 'Amiri-Regular.ttf', // Regular font
                'B' => 'Amiri-Bold.ttf', // Bold font (if exists)
            ],
        ],
        'chroot' => realpath(base_path()), // Ensures the path is secure
        'allowed_protocols' => [
            'file://' => ['rules' => []],
            'http://' => ['rules' => []],
            'https://' => ['rules' => []],
        ],
        'artifactPathValidation' => null,
        'log_output_file' => null,
        'enable_font_subsetting' => true, // Ensures font subsetting
        'pdf_backend' => 'CPDF', // Use CPDF for better font rendering
        'default_media_type' => 'screen',
        'default_paper_size' => 'a4', // Default paper size
        'default_paper_orientation' => 'portrait', // Portrait orientation
        'default_font' => 'cairo', // Set the default font to Cairo
        'dpi' => 96, // DPI setting for PDF rendering
        'enable_php' => false,
        'enable_javascript' => true,
        'enable_remote' => false,
        'allowed_remote_hosts' => null,
        'font_height_ratio' => 1.1,
        'enable_html5_parser' => true,
    ],
];
