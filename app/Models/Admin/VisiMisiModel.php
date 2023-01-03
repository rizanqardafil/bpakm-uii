<?php

namespace App\Models\Admin;

use CodeIgniter\Model;

class VisiMisiModel extends Model
{
    protected $table = 'visi_misi';
    protected $primaryKey = "id_visi_misi";
    protected $useTimestamps = true;
    protected $allowedFields = [
        'nama_konten', 'slug_visi_misi', 'isi_visi',
        'isi_misi', 'path_gambar_visi', 'path_gambar_misi'
    ];

    public function getVisiMisi($slug_visi_misi = '')
    {
        if ($slug_visi_misi) {
            $visi_misi = $this->where('slug_visi_misi', $slug_visi_misi)
                ->orderBy('created_at', 'DESC')
                ->first();

            return $visi_misi;
        }

        $visi_misi = $this->orderBy('created_at', 'DESC')
            ->findAll(1);

        return $visi_misi;
    }
}
