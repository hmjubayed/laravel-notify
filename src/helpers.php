<?php

use Jubayed\Notify\Notify;

if (! function_exists('notify')) {
    /**
     * @param string $message
     * @param string $type
     * @param string $title
     * @param array  $options
     *
     * @return Notify
     */
    function notify(string $message = null, string $type = 'success', string $title = '', array $options = []): Notify
    {
        if (is_null($message)) {
            return app('notify');
        }

        return app('notify')->addNotification($type, $message, $title, $options);
    }
}


