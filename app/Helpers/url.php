<?php
if (!function_exists('base_url')) {
    function base_url($url = "")
    {
        global $config;
        return $config['base_url'] . $url;
    }
}
if (!function_exists('redirect_to')) {
    function redirect_to($url)
    {
        global $config;
        $path = $config['base_url'] . $url;
        if (!empty($url))
            return header("Location: " . $path);
        return FALSE;
    }
}
if (!function_exists('get_mod')) {
    function get_mod()
    {
        $mod = isset($_POST['mod']) ? $_POST['mod'] : 'home';
        return $mod;
    }
}
