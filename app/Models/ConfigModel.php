<?php

namespace App\Models;

use CodeIgniter\Model;

class ConfigModel extends Model
{
    protected $table = 'config';
    protected $primaryKey = 'id_config';
    protected $useTimestamps = true;
    protected $allowedFields = [
        'namaweb', 'email', 'telepon', 'logo', 'icon',
        'link_drive_laporan', 'keyword', 'metatext'
    ];

    public function getConfig()
    {
        $config = $this->orderBy('id_config', 'ASC')
            ->findAll(1);

        return $config;
    }
}
