<?php

namespace App\Models\Admin;

use CodeIgniter\Model;

class GambarLaporanModel extends Model
{
    protected $table = 'gambar_laporan';
    protected $primaryKey = "id_gambar";
    protected $useTimestamps = true;
    protected $allowedFields = ['nama_gambar', 'slug_gambar', 'path_gambar', 'path_nama_gambar', 'id_laporan'];

    public function getImages($slug_gambar = '')
    {
        $builder = $this->db->table('gambar_laporan');
        $builder->select('gambar_laporan.id_gambar, gambar_laporan.nama_gambar, gambar_laporan.slug_gambar, 
        gambar_laporan.path_gambar, gambar_laporan.path_nama_gambar, laporan.id_laporan, laporan.nama_laporan');
        $builder->join('laporan', 'gambar_laporan.id_laporan = laporan.id_laporan', 'left');
        $builder->orderBy('gambar_laporan.created_at', 'DESC');

        if ($slug_gambar) {
            $builder->where('gambar_laporan.slug_gambar', $slug_gambar);
            // return $order;
        }

        $images = $builder->get()->getResult();

        return $images;
    }
}
