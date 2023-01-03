<?php

namespace App\Models\Admin;

use CodeIgniter\Model;

class GaleriVideoModel extends Model
{
    protected $table = 'galeri_video';
    protected $primaryKey = "id_galeri_video";
    protected $useTimestamps = true;
    protected $allowedFields = ['nama_video', 'slug_galeri_video', 'path_video'];

    public function getVideos($slug_video = '')
    {
        if ($slug_video) {
            $video = $this->where('slug_galeri_video', $slug_video)
                ->orderBy('created_at', 'DESC')
                ->first();

            return $video;
        }

        $videos = $this->orderBy('created_at', 'DESC')
            ->findAll();

        return $videos;
    }
}
