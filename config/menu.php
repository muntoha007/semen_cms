<?php

return [
    'dashboard' => [
        'title' => 'Dashboard',
        'routeName' => 'dashboard',
        'icon' => 'mdi mdi-home menu-icon',
    ],
    'room-1' => [
        'title' => 'Room 1',
        'routeName' => 'letters.index',
        'additional_query' => '',
        'icon' => 'mdi mdi-comment-text-outline menu-icon',
        'sub_menu' => [
            'letter_category' => [
                'title' => 'Kategori Kata',
                'routeName' => 'letter-categories.index',
                'icon' => 'mdi mdi-flag menu-icon',
            ],
            'letter' => [
                'title' => 'Daftar Kata',
                'routeName' => 'letters.index',
                'additional_query' => '',
                'icon' => 'mdi mdi-flag menu-icon',
            ],
            'letter-course' => [
                'title' => 'Edukasi Huruf',
                'routeName' => 'letter-courses.index',
                'additional_query' => '',
                'icon' => 'mdi mdi-flag menu-icon',
            ],
            'letter-question' => [
                'title' => 'Daftar Pertanyaan',
                'routeName' => 'letter-questions.index',
                'additional_query' => '',
                'icon' => 'mdi mdi-flag menu-icon',
            ]
        ]
    ],
    'room-2' => [
        'title' => 'Room 2',
        'routeName' => 'verb-levels.index',
        'additional_query' => '',
        'icon' => 'mdi mdi-comment-text-outline menu-icon',
        'sub_menu' => [
            'verb-level' => [
                'title' => 'Verb Levels',
                'routeName' => 'verb-levels.index',
                'icon' => 'mdi mdi-flag menu-icon',
            ],
            'verb-group' => [
                'title' => 'Verb Groups',
                'routeName' => 'verb-groups.index',
                'additional_query' => '',
                'icon' => 'mdi mdi-flag menu-icon',
            ],
            'verb-word' => [
                'title' => 'Verb Words',
                'routeName' => 'verb-words.index',
                'additional_query' => '',
                'icon' => 'mdi mdi-flag menu-icon',
            ],
            'verb-change' => [
                'title' => 'Verb Changes',
                'routeName' => 'verb-changes.index',
                'additional_query' => '',
                'icon' => 'mdi mdi-flag menu-icon',
            ],
            'verb-sentence' => [
                'title' => 'Verb Sentence',
                'routeName' => 'verb-sentences.index',
                'additional_query' => '',
                'icon' => 'mdi mdi-flag menu-icon',
            ],
            'verb-course' => [
                'title' => 'Verb Course',
                'routeName' => 'verb-courses.index',
                'additional_query' => '',
                'icon' => 'mdi mdi-flag menu-icon',
            ],
            'verb-question' => [
                'title' => 'Questions',
                'routeName' => 'verb-questions.index',
                'additional_query' => '',
                'icon' => 'mdi mdi-flag menu-icon',
            ]
        ]
    ],
    'room-3' => [
        'title' => 'Room 3',
        'routeName' => 'particle-educations.index',
        'additional_query' => '',
        'icon' => 'mdi mdi-comment-text-outline menu-icon',
        'sub_menu' => [
            'particle-education' => [
                'title' => 'Particle Education',
                'routeName' => 'particle-educations.index',
                'icon' => 'mdi mdi-flag menu-icon',
            ],
            'particle-education-detail' => [
                'title' => 'Particle Education Detail',
                'routeName' => 'particle-education-details.index',
                'icon' => 'mdi mdi-flag menu-icon',
            ],
            'particle-course' => [
                'title' => 'Particle Course',
                'routeName' => 'particle-courses.index',
                'additional_query' => '',
                'icon' => 'mdi mdi-flag menu-icon',
            ],
            'particle-question' => [
                'title' => 'Questions',
                'routeName' => 'particle-course-questions.index',
                'additional_query' => '',
                'icon' => 'mdi mdi-flag menu-icon',
            ]
        ]
    ],
    'room-4' => [
        'title' => 'Room 4',
        'routeName' => 'pattern-chapters.index',
        'additional_query' => '',
        'icon' => 'mdi mdi-comment-text-outline menu-icon',
        'sub_menu' => [
            'particle-education' => [
                'title' => 'Pattern Chapter',
                'routeName' => 'pattern-chapters.index',
                'icon' => 'mdi mdi-flag menu-icon',
            ],
            'pattern-lesson' => [
                'title' => 'Pattern Lesson',
                'routeName' => 'pattern-lessons.index',
                'icon' => 'mdi mdi-flag menu-icon',
            ],
            'pattern-course' => [
                'title' => 'Pattern Course',
                'routeName' => 'pattern-courses.index',
                'additional_query' => '',
                'icon' => 'mdi mdi-flag menu-icon',
            ],
            'pattern-question' => [
                'title' => 'Questions',
                'routeName' => 'pattern-course-questions.index',
                'additional_query' => '',
                'icon' => 'mdi mdi-flag menu-icon',
            ]
        ]
    ],
    'master-setting' => [
        'title' => 'Master Setting',
        'routeName' => 'user.index',
        'additional_query' => '',
        'icon' => 'mdi mdi-settings menu-icon',
        'sub_menu' => [
            'user-list' => [
                'title' => 'User',
                'routeName' => 'user.index',
                'icon' => 'mdi mdi-account-multiple menu-icon',
            ],
            'role-list' => [
                'title' => 'Role',
                'routeName' => 'role.index',
                'icon' => 'mdi mdi-account-settings menu-icon',
            ],
            'permission-list' => [
                'title' => 'Permission',
                'routeName' => 'permission.index',
                'icon' => 'mdi mdi-account-settings menu-icon',
            ],
            'setting-list' => [
                'title' => 'Setting',
                'routeName' => 'settings.index',
                'icon' => 'mdi mdi-account-settings menu-icon',
            ],
        ]
    ],
    // 'user' => [
    //     'title' => 'User',
    //     'routeName' => 'user.index',
    //     'additional_query' => '',
    //     'icon' => 'mdi mdi-account-multiple menu-icon',
    // ],
    // 'role' => [
    //     'title' => 'Role',
    //     'routeName' => 'role.index',
    //     'additional_query' => '',
    //     'icon' => 'mdi mdi-account-settings menu-icon',
    // ],
    // 'permission' => [
    //     'title' => 'Permission',
    //     'routeName' => 'permission.index',
    //     'additional_query' => '',
    //     'icon' => 'mdi mdi-account-key menu-icon',
//        'sub_menu' => [
//            'User' => [
//                'title' => 'Users',
//                'routeName' => 'user.index',
//                'icon' => 'mdi mdi-account-multiple menu-icon',
//            ],
//            'roles' => [
//                'title' => 'Role',
//                'routeName' => 'role.index',
//                'icon' => 'mdi mdi-account-settings menu-icon',
//            ],
//            'permission' => [
//                'title' => 'Permission',
//                'routeName' => 'permission.index',
//                'icon' => 'mdi mdi-account-key menu-icon',
//            ],
//        ]
    // ],
    // 'setting' => [
    //     'title' => 'Setting',
    //     'routeName' => 'settings.index',
    //     'additional_query' => '',
    //     'icon' => 'mdi mdi-settings menu-icon',
    // ],
];
