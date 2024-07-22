<?php

return [

    'filters' => [

        'archived' => [

            'label' => 'Archived records',

            'only_archived' => 'Only archived records',

            'with_archived' => 'With archived records',

            'without_archived' => 'Without archived records',

        ],
    ],

    'actions' => [

        'archive' => [

            'single' => [

                'label' => 'Archive',

                'modal' => [

                    'heading' => 'Archive :label',

                    'actions' => [

                        'archive' => [

                            'label' => 'Archive',
                        ],

                    ],

                ],

                'notifications' => [

                    'archived' => [

                        'title' => 'Record archived',
                    ],
                ],
            ],
        ],

        'unarchive' => [

            'single' => [

                'label' => 'Unarchive',

                'modal' => [

                    'heading' => 'Unarchive :label',

                    'actions' => [

                        'unarchive' => [

                            'label' => 'Unarchive',
                        ],

                    ],
                ],

                'notifications' => [

                    'unarchived' => [

                        'title' => 'Record unarchived',
                    ],
                ],
            ],
        ],
    ],
];
