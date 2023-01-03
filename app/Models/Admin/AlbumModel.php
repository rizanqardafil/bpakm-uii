<?php

namespace App\Models\Admin;

use CodeIgniter\Model;

class AlbumModel extends Model
{
    protected $table = 'album';
    protected $primaryKey = "id_album";
    protected $useTimestamps = true;
    protected $allowedFields = ['nama_album', 'slug_album', 'path_cover'];

    public function getAlbums($slug_album = '', $order_by = 'created_at', $type_order = 'DESC')
    {
        if ($slug_album) {
            $album = $this->where('slug_album', $slug_album)
                ->orderBy($order_by, $type_order)
                ->first();

            return $album;
        }

        $albums = $this->orderBy($order_by, $type_order)
            ->findAll();

        return $albums;
    }
}
