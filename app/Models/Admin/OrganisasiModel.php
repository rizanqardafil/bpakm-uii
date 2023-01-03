<?php

namespace App\Models\Admin;

use CodeIgniter\Model;

class OrganisasiModel extends Model
{
    protected $table = 'organisasi';
    protected $primaryKey = "id_organisasi";
    protected $useTimestamps = true;
    protected $allowedFields = ['nama', 'slug_organisasi', 'keterangan', 'image'];

    public function getOrganizations($slug_organisasi = '')
    {
        if ($slug_organisasi) {
            $organisasi = $this->where('slug_organisasi', $slug_organisasi)
                ->orderBy('created_at', 'DESC')
                ->first();

            return $organisasi;
        }

        $organisasi = $this->orderBy('created_at', 'DESC')
            ->findAll(1);

        return $organisasi;
    }
}
