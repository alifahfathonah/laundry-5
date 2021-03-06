<?php

namespace App\Models;

use CodeIgniter\Model;

class TransaksiModel extends Model
{
    // nama tabel
    protected $table = 'transaksi';
    // nama primary key
    protected $primaryKey = 'id_transaksi';
    // tipe data return
    protected $returnType = 'object';
    // fields yang dapat diubah
    protected $allowedFields = [
        'id_transaksi',
        'tanggal',
        'nama_pelanggan',
        'berat',
        'id_paket',
        'harga_total',
        'status_bayar',
        'status_laundry'
    ];

    // method untuk get data
    // jika ID ada isinya, maka get data sesuai ID
    public function _get($id = null)
    {
        if ($id == null) {
            return $this->findAll();
        } else {
            return $this->find($id);
        }
    }

    // method untuk get data terakhir
    // join dengan tabel paket untuk mendapatkan nama paket
    public function _getLast()
    {
        $result = $this->select('*')
            ->join('paket', 'paket.id_paket = transaksi.id_paket')
            ->orderBy('id_transaksi', 'DESC')
            ->limit(1)
            ->get()
            ->getResult();
        return $result;
    }

    // method untuk get data
    // join dengan tabel paket untuk mendapatkan nama paket
    public function _getWithPaket($id = null)
    {
        if ($id == null) {
            $result = $this->select('transaksi.*, paket.nama_paket')
                ->join('paket', 'paket.id_paket = transaksi.id_paket')
                ->get()
                ->getResult();
            return $result;
        } else {
            $result = $this->select('transaksi.*, paket.nama_paket')
                ->join('paket', 'paket.id_paket = transaksi.id_paket')
                ->where('transaksi.id_transaksi', $id)
                ->get()
                ->getResult();
            return $result;
        }
    }

    // method untuk insert data
    public function _insert($data)
    {
        $this->insert($data);
    }

    // method untuk update data
    public function _update($id, $data)
    {
        $this->update($id, $data);
    }

    // method untuk delete data
    public function _delete($id)
    {
        $this->delete($id);
    }
}
