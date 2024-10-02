<?php

return [

    'filters' => [

        'archived' => [

            'label' => 'Archivierte Datensätze',

            'only_archived' => 'Nur archivierte Datensätze',

            'with_archived' => 'Mit archivierten Datensätzen',

            'without_archived' => 'Ohne archivierte Datensätze',

        ],
    ],

    'actions' => [

        'archive' => [

            'single' => [

                'label' => 'Archivieren',

                'modal' => [

                    'heading' => ':Label archivieren',

                    'actions' => [

                        'archive' => [

                            'label' => 'Archivieren',
                        ],

                    ],

                ],

                'notifications' => [

                    'archived' => [

                        'title' => 'Datensatz archiviert',
                    ],
                ],
            ],
        ],

        'unarchive' => [

            'single' => [

                'label' => 'Wiederherstellen',

                'modal' => [

                    'heading' => ':Label wiederherstellen',

                    'actions' => [

                        'unarchive' => [

                            'label' => 'Wiederherstellen',
                        ],

                    ],
                ],

                'notifications' => [

                    'unarchived' => [

                        'title' => 'Datensatz wiederhergestellt',
                    ],
                ],
            ],
        ],
    ],
];
