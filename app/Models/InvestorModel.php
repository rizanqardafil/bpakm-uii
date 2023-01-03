<?php

namespace App\Models;

use CodeIgniter\Model;

class InvestorModel extends Model
{
    protected $table = 'laporan';
    protected $primaryKey = "id_laporan";
    protected $useTimestamps = true;
    protected $allowedFields = ['nama_laporan', 'slug_laporan', 'path_laporan', 'path_nama_laporan'];

    public function getOrganisasi()
    {
        $builder = $this->db->table('organisasi');
        $builder->select('id_organisasi, nama, slug_organisasi, keterangan, image');
        $builder->orderBy('id_organisasi', 'ASC');

        $result = $builder->get(1)->getResult();

        return $result;
    }

    public function getLaporan($slug_laporan = '', $order_by = 'laporan.id_laporan', $order_type = 'ASC')
    {
        $builder = $this->db->table('laporan');
        $builder->select('laporan.id_laporan, laporan.nama_laporan, laporan.slug_laporan, laporan.path_nama_laporan,
        laporan.path_laporan, COUNT(gambar_laporan.nama_gambar) AS total_gambar');
        $builder->join('gambar_laporan', 'laporan.id_laporan = gambar_laporan.id_laporan', 'left');
        $builder->orderBy($order_by, $order_type);
        $builder->groupBy('laporan.id_laporan');


        if ($slug_laporan) {
            $builder->where('laporan.slug_laporan', $slug_laporan);
        }

        $reports = $builder->get()->getResult();
        $report_images = $this->getGambarLaporan($order_by, $order_type);

        $index = 0;
        foreach ($reports as $report) {
            $report->path_laporan !== '' ? $report->status = 'TERSEDIA' : $report->status = 'BELUM TERSEDIA';
            $report->gambar_path = [];
            $report->nama_gambar = [];

            $id_laporan = $report->id_laporan;

            while ($index < sizeof($report_images)) {
                if ($report_images[$index]['id_laporan'] !== $id_laporan) {
                    break;
                };

                $report->gambar_path[] = $report_images[$index]['path_gambar'];
                $report->nama_gambar[] = $report_images[$index]['nama_gambar'];
                $index++;
            }
        }

        return $reports;
    }

    public function getGambarLaporan($order_by = 'gambar_laporan.id_laporan', $order_type = 'ASC')
    {
        $builder = $this->db->table('laporan');
        $builder->select('gambar_laporan.id_laporan, laporan.nama_laporan, laporan.slug_laporan, gambar_laporan.nama_gambar, 
        gambar_laporan.slug_gambar, gambar_laporan.path_gambar');
        $builder->join('gambar_laporan', 'laporan.id_laporan = gambar_laporan.id_laporan', 'right');
        $builder->orderBy($order_by, $order_type);

        $results = $builder->get()->getResultArray();

        return $results;
    }
}
