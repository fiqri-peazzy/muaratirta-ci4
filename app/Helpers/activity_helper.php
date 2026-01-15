<?php

if (!function_exists('log_activity')) {
    /**
     * Log user activity
     * 
     * @param string $activityType Type of activity (create, update, delete, login, etc)
     * @param string $module Module name (pengaduan, artikel, user, etc)
     * @param string $description Activity description
     * @param string $status Activity status (success, failed, pending)
     * @return bool
     */
    function log_activity($activityType, $module, $description, $status = 'success')
    {
        $activityModel = new \App\Models\ActivityLogModel();
        return $activityModel->logActivity($activityType, $module, $description, $status);
    }
}

if (!function_exists('get_recent_activities')) {
    /**
     * Get recent activities
     * 
     * @param int $limit
     * @return array
     */
    function get_recent_activities($limit = 10)
    {
        $activityModel = new \App\Models\ActivityLogModel();
        return $activityModel->getRecentActivities($limit);
    }
}

if (!function_exists('get_today_activities')) {
    /**
     * Get today's activities
     * 
     * @return array
     */
    function get_today_activities()
    {
        $activityModel = new \App\Models\ActivityLogModel();
        return $activityModel->getTodayActivities();
    }
}
