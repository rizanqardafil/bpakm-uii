<?php

namespace App\Controllers\Admin\Investor;

use App\Controllers\BaseController;
use App\Models\InvestorModel;

class Laporan extends BaseController
{
    protected $laporan_model;

    public function __construct()
    {
        $this->laporan_model = new InvestorModel();
    }

    public function index()
    {
        $reports = $this->laporan_model->getLaporan('', 'laporan.nama_laporan');
        $total_report = sizeof($reports);

        $data = [
            'title' =>  'Manajemen Laporan - Badan Pengelola Aset KM UII',
            'reports'   => $reports,
            'total_report'  => $total_report,
            'config'    => $this->config->getConfig(),
            'validation'    => \Config\Services::validation()
        ];

        return view('admin/dashboard/investor/laporan/index', $data);
    }

    public function tambah()
    {
        $data = [
            'title' => 'Tambah Laporan Pertanggung Jawaban - Badan Pengelola Aset KM UII',
            'config'    => $this->config->getConfig(),
            'validation'    =>  \Config\Services::validation()
        ];

        return view('admin/dashboard/investor/laporan/tambah_laporan', $data);
    }

    public function save()
    {
        if (!$this->request->getVar('csrf_test_name')) {
            session()->setFlashdata('message', 'File upload terlalu besar dan melebihi kapasitas server. Silahkan upload file < 8 MB');
            return redirect()->back()->withInput();
        }

        $this->error_message['ext_in'] = 'Ekstensi file tidak tepat. File harus berekstensi <b>.pdf</b>';
        $this->error_message['mime_in'] = 'Jenis file tidak tepat. File harus berupa <b>PDF</b>';

        $rules = [
            'nama_laporan'   =>  [
                'rules' =>  'required|is_unique[laporan.nama_laporan]|min_length[3]|max_length[255]',
                'errors'    =>  $this->error_message
            ],
            'path_laporan' =>  [
                'rules' => 'uploaded[path_laporan]|ext_in[path_laporan,pdf]|mime_in[path_laporan,application/pdf]|max_size[path_laporan,8048]',
                'errors'    => $this->error_message
            ]
        ];

        if (!$this->validate($rules)) return redirect()->to(base_url('/admin/laporan/tambah'))->withInput();

        $nama_laporan = $this->request->getPost('nama_laporan');
        $slug_laporan = url_title($nama_laporan, '-', true);

        $files = $this->request->getFile('path_laporan');
        $doc_name = substr($files->getName(), 0, strrpos($files->getName(), '.'));
        $path_laporan = $doc_name . '_' . $files->getRandomName();
        $path_nama_laporan = $files->getName();

        $files->move('uploaded/docs/', $path_laporan);

        $data = [
            'nama_laporan'     => $nama_laporan,
            'slug_laporan' => $slug_laporan,
            'path_laporan' => $path_laporan,
            'path_nama_laporan' => $path_nama_laporan
        ];

        $this->laporan_model->save($data);

        session()->setFlashdata('success', 'Berhasil Menambahkan Laporan');

        return redirect()->to(base_url('admin/laporan'));
    }

    public function update()
    {
        if (!$this->request->getVar('csrf_test_name')) {
            session()->setFlashdata('message', 'File upload terlalu besar dan melebihi kapasitas server. Silahkan upload file < 8 MB');
            return redirect()->back()->withInput();
        }

        $slug_laporan = $this->request->getPost('slug_laporan');
        $nama_laporan = $this->request->getPost('nama_laporan');
        $report = $this->laporan_model->getLaporan($slug_laporan);

        $nama_laporan_rules = 'required|min_length[3]|max_length[255]';

        ($nama_laporan !== $report[0]->nama_laporan) ? $nama_laporan_rules .= '|is_unique[laporan.nama_laporan]' :  '';

        $rules = [
            'nama_laporan'   =>  [
                'rules' =>  $nama_laporan_rules,
                'errors'    =>  $this->error_message
            ],
            'path_laporan' =>  [
                'rules' => 'ext_in[path_laporan,pdf]|mime_in[path_laporan,application/pdf]|max_size[path_laporan,8048]',
                'errors'    => $this->error_message
            ]
        ];

        if (!$this->validate($rules)) return redirect()->to(base_url('/admin/laporan/edit/' . $slug_laporan))->withInput();

        $nama_laporan = $this->request->getPost('nama_laporan');
        $slug_laporan = url_title($nama_laporan, '-', true);

        $files = $this->request->getFile('path_laporan');
        $path_laporan_old = $this->request->getPost('path_laporan');
        $path_laporan = $report[0]->path_laporan;
        $path_nama_laporan = $report[0]->path_nama_laporan;

        if ($files->getError() !== 4) {
            $doc_name = substr($files->getName(), 0, strrpos($files->getName(), '.'));
            $path_laporan = $doc_name . '_' . $files->getRandomName();
            $path_nama_laporan = $files->getName();

            $files->move('uploaded/docs/', $path_laporan);

            (is_file('uploaded/docs/' . $path_laporan_old)) ? unlink('uploaded/docs/' . $path_laporan_old) : '';
        }

        $slug_laporan = url_title($nama_laporan, '-', true);

        $data = [
            'nama_laporan'     => $nama_laporan,
            'slug_laporan' => $slug_laporan,
            'path_laporan' => $path_laporan,
            'path_nama_laporan' => $path_nama_laporan
        ];

        $this->laporan_model->update($report[0]->id_laporan, $data);

        session()->setFlashdata('success', 'Berhasil Mengubah Laporan');

        return redirect()->to(base_url('admin/laporan'));
    }

    public function edit($slug_laporan)
    {
        $report = $this->laporan_model->getLaporan($slug_laporan);

        if (!$report) throw new \CodeIgniter\Exceptions\PageNotFoundException("Laporan $slug_laporan tidak ditemukan");

        $data = [
            'title' => 'Edit Laporan - ' . $report[0]->nama_laporan,
            'report'   => $report,
            'config'    => $this->config->getConfig(),
            'validation'    => \Config\Services::validation()
        ];

        return view('admin/dashboard/investor/laporan/edit_laporan', $data);
    }

    public function delete($id)
    {
        $report = $this->laporan_model->find($id);

        $data = [
            'path_laporan' => '',
            'path_nama_laporan' => ''
        ];

        $this->laporan_model->update($report['id_laporan'], $data);

        if (is_file('uploaded/docs/' . $report['path_laporan'])) {
            unlink('uploaded/docs/' . $report['path_laporan']);
        }

        session()->setFlashdata('success', 'Berhasil Menghapus Dokumen Laporan');

        return redirect()->to(base_url('admin/laporan'));
    }
}
