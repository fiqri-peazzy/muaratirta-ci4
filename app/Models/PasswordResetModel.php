<?php

namespace App\Models;

use CodeIgniter\Model;

class PasswordResetModel extends Model
{
    protected $table = 'password_resets';
    protected $primaryKey = 'id';
    protected $returnType = 'object';
    protected $useTimestamps = false;
    protected $allowedFields = [
        'email',
        'token',
        'created_at',
        'expires_at'
    ];

    /**
     * Generate OTP token
     */
    public function generateOTP()
    {
        return str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);
    }

    /**
     * Create password reset token
     */
    public function createResetToken($email)
    {
        // Delete old tokens for this email
        $this->where('email', $email)->delete();

        $token = $this->generateOTP();
        $expiresAt = date('Y-m-d H:i:s', strtotime('+15 minutes'));

        $data = [
            'email' => $email,
            'token' => $token,
            'created_at' => date('Y-m-d H:i:s'),
            'expires_at' => $expiresAt
        ];

        if ($this->insert($data)) {
            return $token;
        }

        return false;
    }

    /**
     * Verify OTP token
     */
    public function verifyToken($email, $token)
    {
        $reset = $this->where('email', $email)
            ->where('token', $token)
            ->first();

        if (!$reset) {
            return false;
        }

        // Check if token is expired
        if (strtotime($reset->expires_at) < time()) {
            $this->delete($reset->id);
            return false;
        }

        return true;
    }

    /**
     * Delete token after use
     */
    public function deleteToken($email)
    {
        return $this->where('email', $email)->delete();
    }

    /**
     * Clean expired tokens
     */
    public function cleanExpiredTokens()
    {
        return $this->where('expires_at <', date('Y-m-d H:i:s'))->delete();
    }
}
