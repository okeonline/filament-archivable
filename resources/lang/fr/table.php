<?php

return [

    'filters' => [

        'archived' => [

            'label' => 'Enregistrements archivés',

            'only_archived' => 'Uniquement les enregistrements archivés',

            'with_archived' => 'Avec les enregistrements archivés',

            'without_archived' => 'Sans les enregistrements archivés',

        ],
    ],

    'actions' => [

        'archive' => [

            'single' => [

                'label' => 'Archiver',

                'modal' => [

                    'heading' => 'Archiver :label',

                    'actions' => [

                        'archive' => [

                            'label' => 'Archiver',
                        ],

                    ],

                ],

                'notifications' => [

                    'archived' => [

                        'title' => 'Enregistrement archivé',
                    ],
                ],
            ],
        ],

        'unarchive' => [

            'single' => [

                'label' => 'Désarchiver',

                'modal' => [

                    'heading' => 'Désarchiver :label',

                    'actions' => [

                        'unarchive' => [

                            'label' => 'Désarchiver',
                        ],

                    ],
                ],

                'notifications' => [

                    'unarchived' => [

                        'title' => 'Enregistrement désarchivé',
                    ],
                ],
            ],
        ],
    ],
];
