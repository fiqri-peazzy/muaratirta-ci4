<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class AuthFilter implements FilterInterface
{
    /**
     * Check if user is authenticated
     */
    public function before(RequestInterface $request, $arguments = null)
    {
        $session = \Config\Services::session();

        if (!$session->get('is_logged_in')) {
            $session->set('redirect_url', current_url());
            
            return redirect()->route('login')
                           ->with('error', 'Silakan login terlebih dahulu');
        }

        if (!empty($arguments)) {
            $userLevel = $session->get('level');
            $allowedLevels = $arguments;
            if ($userLevel == '1') {
                return;
            }

            if (!in_array($userLevel, $allowedLevels)) {
                return redirect()->route('dashboard')
                               ->with('error', 'Anda tidak memiliki akses ke halaman ini');
            }
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
    }
}