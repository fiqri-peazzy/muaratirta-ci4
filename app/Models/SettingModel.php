<?php

namespace App\Models;

use CodeIgniter\Model;

class SettingModel extends Model
{
    protected $table = 'settings';
    protected $primaryKey = 'id';
    protected $returnType = 'object';
    protected $useTimestamps = true;
    protected $allowedFields = ['key', 'value', 'type', 'label', 'description', 'group', 'options'];

    /**
     * Get setting by key
     */
    public function getSetting($key, $default = null)
    {
        $setting = $this->where('key', $key)->first();
        return $setting ? $setting->value : $default;
    }

    /**
     * Update or create setting
     */
    public function setSetting($key, $value)
    {
        $setting = $this->where('key', $key)->first();

        if ($setting) {
            return $this->update($setting->id, ['value' => $value]);
        }

        return $this->insert(['key' => $key, 'value' => $value]);
    }

    /**
     * Get all settings by group
     */
    public function getByGroup($group = null)
    {
        if ($group) {
            return $this->where('group', $group)->orderBy('id', 'ASC')->findAll();
        }
        return $this->orderBy('group', 'ASC')->orderBy('id', 'ASC')->findAll();
    }

    /**
     * Get settings grouped
     */
    public function getAllGrouped()
    {
        $settings = $this->orderBy('group', 'ASC')->orderBy('id', 'ASC')->findAll();
        $grouped = [];

        foreach ($settings as $setting) {
            $grouped[$setting->group][] = $setting;
        }

        return $grouped;
    }

    /**
     * Get settings as key-value array
     */
    public function getAllAsArray()
    {
        $settings = $this->findAll();
        $array = [];

        foreach ($settings as $setting) {
            $array[$setting->key] = $setting->value;
        }

        return $array;
    }
}
