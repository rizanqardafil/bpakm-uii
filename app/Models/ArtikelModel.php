<?php

namespace App\Models;

use CodeIgniter\Model;

class ArtikelModel extends Model
{
    protected $table = 'artikel';
    protected $primaryKey = "id_artikel";
    protected $useTimestamps = true;
    protected $allowedFields = [
        'judul_artikel', 'slug_artikel', 'isi_artikel',
        'path_gambar', 'id_penulis'
    ];

    public function getAllArtikel($judul_artikel = '', $slug_artikel = '', $limit = 0, $offset = 0)
    {
        $builder = $this->db->table($this->table);
        $builder->select('artikel.id_artikel, artikel.judul_artikel, 
        artikel.slug_artikel, artikel.isi_artikel, artikel.created_at AS tanggal_terbit ,artikel.path_gambar AS cover,
        penulis.nama_penulis, penulis.id_penulis, penulis.slug_penulis, penulis.path_gambar AS gambar_penulis');
        $builder->join('penulis', 'artikel.id_penulis = penulis.id_penulis', 'left');
        $builder->orderBy('artikel.created_at', 'DESC');

        if ($slug_artikel) {
            $builder->where('artikel.slug_artikel', $slug_artikel);
        }

        if ($judul_artikel) {
            $builder->like('artikel.judul_artikel', $judul_artikel);
        }

        $results = $builder->get($limit, $offset)->getResult();

        setlocale(LC_TIME, 'id_ID.utf8');

        foreach ($results as $result) {
            $result->tanggal_terbit = strftime('%d %B %Y', strtotime($result->tanggal_terbit));
        }

        return $results;
    }
}
