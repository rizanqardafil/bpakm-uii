<?php

namespace App\Models;

use CodeIgniter\Model;

class TentangModel extends Model
{
    protected $table = 'sejarah';
    protected $primaryKey = "id_sejarah";
    protected $useTimestamps = true;
    protected $allowedFields = [
        'nama_konten', 'slug_sejarah', 'isi_sejarah',
        'isi_logo', 'path_gambar_sejarah', 'path_gambar_logo'
    ];

    public function getSejarah()
    {
        $history = $this->orderBy('id_sejarah', 'ASC')
            ->findAll(1);

        return $history;
    }

    public function getVisiMisi()
    {
        $builder = $this->db->table('visi_misi');
        $builder->orderBy('id_visi_misi', 'ASC');

        $result = $builder->get(1)->getResultArray();

        return $result;
    }
}
