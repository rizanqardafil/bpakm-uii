<?php

namespace App\Models\Admin;

use CodeIgniter\Model;

class PenulisModel extends Model
{
    protected $table = 'penulis';
    protected $primaryKey = "id_penulis";
    protected $useTimestamps = true;
    protected $allowedFields = ['nama_penulis', 'slug_penulis', 'path_gambar'];

    public function getWriters($slug_writer = '', $order_by = 'created_at', $type_order = 'DESC')
    {
        if ($slug_writer) {
            $writer = $this->where('slug_penulis', $slug_writer)
                ->orderBy($order_by, $type_order)
                ->first();

            return $writer;
        }

        $writers = $this->orderBy($order_by, $type_order)
            ->findAll();

        return $writers;
    }
}
