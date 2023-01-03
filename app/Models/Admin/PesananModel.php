<?php

namespace App\Models\Admin;

use CodeIgniter\Model;
use DateTime;

class PesananModel extends Model
{
    protected $table = 'pesanan';
    protected $primaryKey = "id_pesanan";
    protected $useTimestamps = true;
    protected $allowedFields = ['tanggal_pinjam', 'tanggal_kembali', 'id_produk'];

    public function getOrders($id_pesanan = 0)
    {
        $builder = $this->db->table('pesanan');
        $builder->select('pesanan.id_pesanan, pesanan.tanggal_pinjam, 
        pesanan.tanggal_kembali, produk.id_produk, produk.nama_produk');
        $builder->join('produk', 'pesanan.id_produk = produk.id_produk', 'left');
        $builder->orderBy('pesanan.created_at', 'DESC');

        if ($id_pesanan) {
            $builder->where('pesanan.id_pesanan', $id_pesanan);

            $order = $builder->get()->getResult();

            foreach ($order as $o) {
                $date_pinjam = new DateTime($o->tanggal_pinjam);
                $date_kembali = new DateTime($o->tanggal_kembali);

                $o->tanggal_pinjam = $date_pinjam->format('Y-m-d');
                $o->tanggal_kembali = $date_kembali->format('Y-m-d');
            }

            return $order;
        }

        $orders = $builder->get()->getResult();

        setlocale(LC_TIME, 'id_ID.utf8');

        foreach ($orders as $order) {
            $order->tanggal_pinjam = strftime('%d %B %Y', strtotime($order->tanggal_pinjam));
            $order->tanggal_kembali = strftime('%d %B %Y', strtotime($order->tanggal_kembali));
        }

        return $orders;
    }
}
