<?php

return [

    'filters' => [

        'archived' => [

            'label' => 'Gearchiveerde records',

            'only_archived' => 'Alleen gearchiveerde records',

            'with_archived' => 'Met gearchiveerde records',

            'without_archived' => 'Zonder gearchiveerde records',

        ],
    ],

    'actions' => [

        'archive' => [

            'single' => [

                'label' => 'Archiveer',

                'modal' => [

                    'heading' => 'Archiveer :label',

                    'actions' => [

                        'archive' => [

                            'label' => 'Archiveren',
                        ],

                    ],

                ],

                'notifications' => [

                    'archived' => [

                        'title' => 'Record gearchiveerd',
                    ],
                ],
            ],
        ],

        'unarchive' => [

            'single' => [

                'label' => 'Herstellen',

                'modal' => [

                    'heading' => 'Herstel :label',

                    'actions' => [

                        'unarchive' => [

                            'label' => 'Herstellen',
                        ],

                    ],
                ],

                'notifications' => [

                    'unarchived' => [

                        'title' => 'Record hersteld',
                    ],
                ],
            ],
        ],
    ],
];
