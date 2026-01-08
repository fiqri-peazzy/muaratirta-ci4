<?php

namespace App\Models;

use CodeIgniter\Model;

class User extends Model
{
    protected $table            = 'users';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = true;
    protected $protectFields    = true;
    
    protected $allowedFields    = [
        'username',
        'email',
        'password',
        'nm_lengkap',
        'no_hp',
        'profile_pict',
        'level',
        'is_active'
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules = [
        'username'   => 'required|min_length[3]|max_length[100]|is_unique[users.username,id,{id}]',
        'email'      => 'required|valid_email|is_unique[users.email,id,{id}]',
        'password'   => 'required|min_length[6]',
        'nm_lengkap' => 'required|min_length[3]|max_length[250]',
        'no_hp'      => 'permit_empty|max_length[25]',
        'level'      => 'required|in_list[1,2,3]',
    ];

    protected $validationMessages = [
        'username' => [
            'required'    => 'Username wajib diisi',
            'min_length'  => 'Username minimal 3 karakter',
            'is_unique'   => 'Username sudah digunakan',
        ],
        'email' => [
            'required'     => 'Email wajib diisi',
            'valid_email'  => 'Email tidak valid',
            'is_unique'    => 'Email sudah terdaftar',
        ],
        'password' => [
            'required'    => 'Password wajib diisi',
            'min_length'  => 'Password minimal 6 karakter',
        ],
    ];

    protected $skipValidation = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = ['hashPassword'];
    protected $beforeUpdate   = ['hashPassword'];

    /**
     * Hash password before insert/update
     */
    protected function hashPassword(array $data)
    {
        if (!isset($data['data']['password'])) {
            return $data;
        }

        $data['data']['password'] = password_hash($data['data']['password'], PASSWORD_BCRYPT);
        return $data;
    }

    /**
     * Find user by username or email
     */
    public function findByUsernameOrEmail($identifier)
    {
        return $this->where('username', $identifier)
                    ->orWhere('email', $identifier)
                    ->where('is_active', '1')
                    ->first();
    }

    /**
     * Verify user credentials
     */
    public function verifyPassword($user, $password)
    {
        return password_verify($password, $user->password);
    }

    /**
     * Get user level name
     */
    public function getLevelName($level)
    {
        $levels = [
            '1' => 'Admin',
            '2' => 'Customer Service',
            '3' => 'Publikasi',
        ];

        return $levels[$level] ?? 'Unknown';
    }

    /**
     * Check if user has permission
     */
    public function hasPermission($userId, $requiredLevel)
    {
        $user = $this->find($userId);
        
        if (!$user) {
            return false;
        }

        // Level 1 (Admin) has access to everything
        if ($user->level == '1') {
            return true;
        }

        // Check if user level matches required level
        return $user->level == $requiredLevel;
    }
}