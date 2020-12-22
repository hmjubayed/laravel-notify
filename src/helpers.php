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

if (! function_exists('notify_js')) {
    /**
     * @return string
     */
    function notify_js(): string
    {
        $driver  = config('notify.default');
        $scripts = config('notify.'.$driver.'.notify_js');

        return '<script type="text/javascript" src="'.implode('"></script><script type="text/javascript" src="', $scripts).'"></script>';
    }
}

if (! function_exists('notify_css')) {
    /**
     * @return string
     */
    function notify_css(): string
    {
        $driver  = config('notify.default');
        $styles = config('notify.'.$driver.'.notify_css');

        return '<link rel="stylesheet" type="text/css" href="'.implode('"><link rel="stylesheet" type="text/css" href="', $styles).'">';
    }
}


//alert
if (!function_exists('alert')) {

    /**
     * Helper alert()->info() without facade: Alert::info()
     *
     * @param null        $title
     * @param null        $content
     * @param bool|string $icon
     * @return \Illuminate\Foundation\Application|mixed
     */
    function alert($title = null, $content = null, $icon = true)
    {
        $notifier = app('alert');

        if (!is_null($title)) {
            return $notifier->info($title, $content, $icon);
        }

        return $notifier;
    }
}

if (!function_exists('alert_icon')) {

    /**
     * Get the icon for the notify level
     *
     * @param $level
     * @return string
     */
    function alert_icon($level)
    {
        switch ($level) {
            case 'danger':
                return 'fas fa-fw fa-times';
                break;
            case 'warning':
                return 'fas fa-fw fa-warning';
                break;
            case 'success':
                return 'fas fa-fw fa-check';
                break;
            default: // info / default
                return 'fas fa-fw fa-info';
                break;
        }
    }
}
