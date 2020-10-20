<?php

return [
	'mode'                  => 'utf-8',
	'format'                => 'A4',
	'author'                => '',
	'subject'               => '',
	'keywords'              => '',
	'creator'               => 'Laravel Pdf',
	'display_mode'          => 'fullpage',
	'tempDir'               => base_path('../temp/'),
	'font_path' => base_path('public/fonts/'),
    'font_data' => [
        'Riyaz' => [
            'R'  => 'XB Riyaz.ttf',    // regular font
            'B'  => 'XB RiyazBd.ttf',       // optional: bold font
            'I'  => 'XB RiyazBdIt.ttf',     // optional: italic font
            'BI' => 'XB RiyazIt.ttf', // optional: bold-italic font
            'useOTL' => 0xFF,    // required for complicated langs like Persian, Arabic and Chinese
            'useKashida' => 75,  // required for complicated langs like Persian, Arabic and Chinese
        ]
    ]

];
