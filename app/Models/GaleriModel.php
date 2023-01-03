<?php

namespace App\Models;

use CodeIgniter\Model;

class GaleriModel extends Model
{
    protected $table = 'galeri_foto';
    protected $primaryKey = "id_galeri_foto";
    protected $useTimestamps = true;
    protected $allowedFields = ['nama_foto', 'slug_galeri_foto', 'path_foto', 'id_album'];

    public function getAlbum($album_name = '', $limit = 0, $offset = 0)
    {
        $builder = $this->db->table('album');
        $builder->select('id_album, nama_album, slug_album, path_cover');
        $builder->orderBy('album.created_at', 'DESC');

        if (!$album_name) $builder->like('album.nama_album', $album_name);

        $result = $builder->get($limit, $offset)->getResult();


        foreach ($result as $r) {
            $images = $this->getImage($r->slug_album);

            foreach ($images as $image) {
                $r->nama_gambar_album[] = $image->nama_foto;
                $r->path_gambar_album[] = $image->path_foto;
            }
        }

        return $result;
    }

    public function getImage($slug_album = '', $slug_galeri_foto = '')
    {
        $builder = $this->db->table($this->table);
        $builder->select('galeri_foto.id_galeri_foto, 
        galeri_foto.nama_foto, galeri_foto.slug_galeri_foto, galeri_foto.path_foto,
        album.nama_album, album.slug_album, album.id_album');
        $builder->join('album', 'album.id_album = galeri_foto.id_album', 'left');
        $builder->orderBy('galeri_foto.created_at', 'ASC');

        if ($slug_album) {
            $builder->where('album.slug_album', $slug_album);
        }

        if ($slug_galeri_foto) {
            $builder->where('galeri_foto.slug_galeri_foto', $slug_galeri_foto);
        }

        $results = $builder->get()->getResult();

        return $results;
    }

    public function getVideo($video_name = '', $limit = 0, $offset = 0)
    {
        $builder = $this->db->table('galeri_video');
        $builder->select('id_galeri_video, nama_video, slug_galeri_video, path_video');
        $builder->orderBy('created_at', 'DESC');

        if (!$video_name) $builder->like('galeri_video.nama_video', $video_name);

        $results = $builder->get($limit, $offset)->getResult();

        foreach ($results as $result) {
            $result->path_video = $this->getUniqueCode($result->path_video);
        }

        return $results;
    }

    public function getUniqueCode($url_link)
    {
        $url_link = trim($url_link);
        $unique_token = '';
        // $link_length = strlen($url_link);
        $slash_position = strrpos($url_link, '/');
        $equal_position = stripos($url_link, '=');

        $unique_token = substr($url_link, $slash_position + 1, 11);

        if ($equal_position) {
            $unique_token = substr($url_link, $equal_position + 1, 11);
        }

        return $unique_token;
    }
}
