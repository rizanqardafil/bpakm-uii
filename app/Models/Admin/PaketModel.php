<?php

namespace App\Models\Admin;

use CodeIgniter\Model;
use NumberFormatter;

class PaketModel extends Model
{
    protected $table = 'paket';
    protected $primaryKey = "id_paket";
    protected $useTimestamps = true;
    protected $allowedFields = ['nama_paket', 'slug_paket', 'harga', 'id_produk'];

    public function getAllPackage($slug_package = '')
    {
        $formatter = new NumberFormatter('id_ID',  NumberFormatter::CURRENCY);

        $builder = $this->db->table('paket');
        $builder->select('paket.id_paket, paket.nama_paket, paket.slug_paket, paket.harga, produk.id_produk, produk.nama_produk');
        $builder->join('produk', 'paket.id_produk = produk.id_produk', 'left');
        $builder->orderBy('paket.created_at', 'DESC');

        if ($slug_package) {
            $builder->where('paket.slug_paket', $slug_package);
            $package = $builder->get()->getResult();

            return $package;
        }

        $packages = $builder->get()->getResult();

        foreach ($packages as $package) {
            $currency = $formatter->formatCurrency($package->harga, 'IDR');
            $currency = substr($currency, 0, strrpos($currency, ','));
            $package->harga = $currency;
        }


        return $packages;
    }
}
