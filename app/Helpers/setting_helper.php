<?php
if (!function_exists('get_setting')) {
    /**
     * Get setting value by key
     */
    function get_setting($key, $default = null)
    {
        $model = new \App\Models\SettingModel();
        return $model->getSetting($key, $default);
    }
}

if (!function_exists('set_setting')) {
    /**
     * Set setting value
     */
    function set_setting($key, $value)
    {
        $model = new \App\Models\SettingModel();
        return $model->setSetting($key, $value);
    }
}
