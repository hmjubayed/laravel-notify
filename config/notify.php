<?php

return [

    'default' => 'toastr',

    'toastr' => [

        'class' => \Jubayed\Notify\Notifiers\Toastr::class,

        'types' => [
            'error',
            'info',
            'success',
            'warning',
        ],

        'options' => [],
    ],

    'pnotify' => [

        'class' => \Jubayed\Notify\Notifiers\Pnotify::class,

        'types' => [
            'alert',
            'error',
            'info',
            'notice',
            'success',
        ],

        'options' => [],
    ],

    'sweetalert2' => [

        'class' => \Jubayed\Notify\Notifiers\SweetAlert2::class,

        'types' => [
            'error',
            'info',
            'question',
            'success',
            'warning',
        ],

        'options' => [],
    ],
];
