<?php

if (!function_exists('is_logged_in')) {
    /**
     * Check if user is logged in
     */
    function is_logged_in()
    {
        $session = \Config\Services::session();
        return $session->get('is_logged_in') === true;
    }
}

if (!function_exists('get_user_data')) {
    /**
     * Get user session data
     */
    function get_user_data($key = null)
    {
        $session = \Config\Services::session();

        if ($key === null) {
            return [
                'user_id'      => $session->get('user_id'),
                'username'     => $session->get('username'),
                'email'        => $session->get('email'),
                'nm_lengkap'   => $session->get('nm_lengkap'),
                'profile_pict' => $session->get('profile_pict'),
                'level'        => $session->get('level'),
                'level_name'   => $session->get('level_name'),
            ];
        }

        return $session->get($key);
    }
}

if (!function_exists('user_id')) {
    /**
     * Get current user id
     */
    function user_id()
    {
        $session = \Config\Services::session();
        return $session->get('user_id');
    }
}

if (!function_exists('user_name')) {
    /**
     * Get current user name
     */
    function user_name()
    {
        $session = \Config\Services::session();
        return $session->get('nm_lengkap') ?? $session->get('username');
    }
}

if (!function_exists('user_level')) {
    /**
     * Get user level
     */
    function user_level()
    {
        $session = \Config\Services::session();
        return $session->get('level');
    }
}

if (!function_exists('is_admin')) {
    /**
     * Check if user is admin (level 1)
     */
    function is_admin()
    {
        return user_level() == '1';
    }
}

if (!function_exists('is_cs')) {
    /**
     * Check if user is CS (level 2)
     */
    function is_cs()
    {
        return user_level() == '2';
    }
}

if (!function_exists('is_publikasi')) {
    /**
     * Check if user is Publikasi (level 3)
     */
    function is_publikasi()
    {
        return user_level() == '3';
    }
}

if (!function_exists('has_access')) {
    /**
     * Check if user has access to specific levels
     */
    function has_access($allowedLevels = [])
    {
        $userLevel = user_level();

        // Admin always has access
        if ($userLevel == '1') {
            return true;
        }

        return in_array($userLevel, $allowedLevels);
    }
}

if (!function_exists('profile_picture')) {
    /**
     * Get user profile picture URL
     */
    function profile_picture()
    {
        $session = \Config\Services::session();
        $profilePict = $session->get('profile_pict') ?? 'default.png';

        return base_url('uploads/profile/' . $profilePict);
    }
}

if (!function_exists('user_initials')) {
    /**
     * Get user initials from name
     */
    function user_initials()
    {
        $session = \Config\Services::session();
        $name = $session->get('nm_lengkap') ?? 'User';

        $words = explode(' ', $name);
        $initials = '';

        foreach ($words as $word) {
            $initials .= strtoupper(substr($word, 0, 1));
        }

        return substr($initials, 0, 2);
    }
}
