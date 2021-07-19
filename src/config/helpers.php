<?php
/**
 * @author: nguyentinh
 * @create: 11/15/19, 5:49 PM
 */
if (!function_exists('base_url')) {
    /**
     * Generate a HTTPS url for the application.
     *
     * @param string $path
     * @param mixed  $parameters
     *
     * @return string
     */
    function base_url($path = '', $parameters = []): string
    {
        return url($path, $parameters, env('APP_SSL', false));
    }
}

if (!function_exists('admin_url')) {
    /**
     * Generate a HTTPS url for the application.
     *
     * @param string $path
     * @param mixed  $parameters
     *
     * @return string
     */
    function admin_url($path = 'dashboard', $parameters = []): string
    {
        return url('admin/' . $path, $parameters, env('APP_SSL', false));
    }
}

if (!function_exists('create_line')) {
    function create_line($num = 0): string
    {
        $line = '';
        for ($i = 0; $i < $num; ++$i) {
            $line .= '-';
        }

        return $line;
    }
}
