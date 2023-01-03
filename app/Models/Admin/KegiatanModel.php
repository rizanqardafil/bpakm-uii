<?php

namespace App\Models\Admin;

use CodeIgniter\Model;

class KegiatanModel extends Model
{
    protected $table = 'kegiatan';
    protected $primaryKey = "id_kegiatan";
    protected $useTimestamps = true;
    protected $allowedFields = ['judul', 'slug_kegiatan', 'sub_judul', 'image'];

    public function getActivity($slug_kegiatan = '', $order_by = 'kegiatan.updated_at', $order_type = 'DESC')
    {
        if ($slug_kegiatan) {
            $activity = $this->where('slug_kegiatan', $slug_kegiatan)
                ->orderBy($order_by, $order_type)
                ->first();

            return $activity;
        }

        $activity = $this->orderBy($order_by, $order_type)
            ->findAll(3);

        return $activity;
    }
}
