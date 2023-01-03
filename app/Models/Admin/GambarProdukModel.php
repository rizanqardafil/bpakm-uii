<?php

namespace App\Models\Admin;

use CodeIgniter\Model;

class GambarProdukModel extends Model
{
    protected $table = 'gambar_produk';
    protected $primaryKey = "id_gambar";
    protected $useTimestamps = true;
    protected $allowedFields = ['nama_gambar', 'slug_gambar', 'path_gambar', 'path_nama_gambar', 'id_produk'];


    public function getImages($slug_gambar = '')
    {
        $builder = $this->db->table('gambar_produk');
        $builder->select('gambar_produk.id_gambar, gambar_produk.nama_gambar, gambar_produk.slug_gambar, 
        gambar_produk.path_gambar, gambar_produk.path_nama_gambar, produk.id_produk, produk.nama_produk');
        $builder->join('produk', 'gambar_produk.id_produk = produk.id_produk', 'left');
        $builder->orderBy('gambar_produk.created_at', 'DESC');

        if ($slug_gambar) {
            $builder->where('gambar_produk.slug_gambar', $slug_gambar);
            // return $order;
        }

        $images = $builder->get()->getResult();

        return $images;
    }
}
