<?php

return [
    'dashboard' => [
        'title' => 'Dashboard',
        'routeName' => 'dashboard',
        'icon' => 'mdi mdi-home menu-icon',
    ],
    'master' => [
        'title' => 'Master',
        'routeName' => 'master-groups.index',
        'additional_query' => '',
        'icon' => 'mdi mdi-comment-text-outline menu-icon',
        'sub_menu' => [
            'master-group' => [
                'title' => 'Master Group',
                'routeName' => 'master-groups.index',
                'icon' => 'mdi mdi-flag menu-icon',
            // ],
            // 'ability-master-course' => [
            //     'title' => 'Master Ability Course',
            //     'routeName' => 'master-ability-courses.index',
            //     'icon' => 'mdi mdi-flag menu-icon',
            // ],
            // 'ability-master-course-level' => [
            //     'title' => 'Master Ability Level',
            //     'routeName' => 'master-ability-course-levels.index',
            //     'icon' => 'mdi mdi-flag menu-icon',
            // ],
            // 'ability-course' => [
            //     'title' => 'Kursus Ability',
            //     'routeName' => 'ability-courses.index',
            //     'additional_query' => '',
            //     'icon' => 'mdi mdi-flag menu-icon',
            // ],
            // 'ability-question' => [
            //     'title' => 'Test / Pertanyaan',
            //     'routeName' => 'ability-course-questions.index',
            //     'additional_query' => '',
            //     'icon' => 'mdi mdi-flag menu-icon',
            ]
        ]
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
            'letter-hiragana' => [
                'title' => 'Hiragana',
                'routeName' => 'letter-hiragana-list',
                'additional_query' => 'hiragana',
                'cid' => 1,
                'icon' => 'mdi mdi-flag menu-icon',
            ],
            'letter-katakana' => [
                'title' => 'Katakana',
                'routeName' => 'letter-katakana-list',
                'additional_query' => 'katakana',
                'cid' => 2,
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
                'title' => 'Partikel Edukasi',
                'routeName' => 'particle-educations.index',
                'icon' => 'mdi mdi-flag menu-icon',
            ],
            'particle-education-detail' => [
                'title' => 'Partikel Edukasi Detail',
                'routeName' => 'particle-education-details.index',
                'icon' => 'mdi mdi-flag menu-icon',
            ],
            'particle-course' => [
                'title' => 'Partikel Kursus',
                'routeName' => 'particle-courses.index',
                'additional_query' => '',
                'icon' => 'mdi mdi-flag menu-icon',
            ],
            'particle-question' => [
                'title' => 'Test / Pertanyaan',
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
                'title' => 'Pola Chapter',
                'routeName' => 'pattern-chapters.index',
                'icon' => 'mdi mdi-flag menu-icon',
            ],
            'pattern-lesson' => [
                'title' => 'Pola Lesson',
                'routeName' => 'pattern-lessons.index',
                'icon' => 'mdi mdi-flag menu-icon',
            ],
            'pattern-course' => [
                'title' => 'Pola Course',
                'routeName' => 'pattern-courses.index',
                'additional_query' => '',
                'icon' => 'mdi mdi-flag menu-icon',
            ],
            'pattern-question' => [
                'title' => 'Test / Pertanyaan',
                'routeName' => 'pattern-course-questions.index',
                'additional_query' => '',
                'icon' => 'mdi mdi-flag menu-icon',
            ]
        ]
    ],
    'room-5' => [
        'title' => 'Room 5',
        'routeName' => 'master-groups.index',
        'additional_query' => '',
        'icon' => 'mdi mdi-comment-text-outline menu-icon',
        'sub_menu' => [
            'kanji-group' => [
                'title' => 'Master Group',
                'routeName' => 'master-groups.index',
                'icon' => 'mdi mdi-flag menu-icon',
            ],
            'kanji-chapter' => [
                'title' => 'Chapter',
                'routeName' => 'kanji-chapters.index',
                'icon' => 'mdi mdi-flag menu-icon',
            ],
            'kanji-education' => [
                'title' => 'Kanji Edukasi',
                'routeName' => 'kanji-educations.index',
                'additional_query' => '',
                'icon' => 'mdi mdi-flag menu-icon',
            ],
            'kanji-sample' => [
                'title' => 'Contoh Kanji',
                'routeName' => 'kanji-samples.index',
                'additional_query' => '',
                'icon' => 'mdi mdi-flag menu-icon',
            ],
            'kanji-course' => [
                'title' => 'Kursus Kanji',
                'routeName' => 'kanji-courses.index',
                'additional_query' => '',
                'icon' => 'mdi mdi-flag menu-icon',
            ],
            'kanji-question' => [
                'title' => 'Test / Pertanyaan',
                'routeName' => 'kanji-course-questions.index',
                'additional_query' => '',
                'icon' => 'mdi mdi-flag menu-icon',
            ]
        ]
    ],
    'room-6' => [
        'title' => 'Room 6',
        'routeName' => 'vocabularies.index',
        'additional_query' => '',
        'icon' => 'mdi mdi-comment-text-outline menu-icon',
        'sub_menu' => [
            'vocabularies' => [
                'title' => 'Vocabularies/Kosa kata',
                'routeName' => 'vocabularies.index',
                'icon' => 'mdi mdi-flag menu-icon',
            ],
            'vocabulary-course' => [
                'title' => 'Kursus Vocabulary',
                'routeName' => 'vocabulary-courses.index',
                'additional_query' => '',
                'icon' => 'mdi mdi-flag menu-icon',
            ],
            'vocabulary-question' => [
                'title' => 'Test / Pertanyaan',
                'routeName' => 'vocabulary-course-questions.index',
                'additional_query' => '',
                'icon' => 'mdi mdi-flag menu-icon',
            ]
        ]
    ],
    'room-7' => [
        'title' => 'Room 7',
        'routeName' => 'ability-course-chapters.index',
        'additional_query' => '',
        'icon' => 'mdi mdi-comment-text-outline menu-icon',
        'sub_menu' => [
            'ability-course-chapter' => [
                'title' => 'Ability Course Chapter',
                'routeName' => 'ability-course-chapters.index',
                'icon' => 'mdi mdi-flag menu-icon',
            ],
            // 'ability-master-course-level' => [
            //     'title' => 'Master Ability Level',
            //     'routeName' => 'master-ability-course-levels.index',
            //     'icon' => 'mdi mdi-flag menu-icon',
            // ],
            'ability-course' => [
                'title' => 'Kursus Ability',
                'routeName' => 'ability-courses.index',
                'additional_query' => '',
                'icon' => 'mdi mdi-flag menu-icon',
            ],
            'ability-question-group' => [
                'title' => 'Group Test / Pertanyaan',
                'routeName' => 'ability-course-question-groups.index',
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
