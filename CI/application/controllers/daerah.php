<?php
class Daerah extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Daerah_model', 'daerah_model');
    }

    public function index()
    {
        $this->data['namaProvinsi'] = $this->daerah_model->get_nama_provinsi();
        $this->data['namaKota'] = [];
        $this->data['namaKecamatan'] = [];
        $this->load->view('daerah_view', $this->data);
    }

    public function ajax_get_kota($idProv='')
    {
        $kota = $this->daerah_model->get_nama_kota($idProv);
        echo json_encode(array_values($kota));
    }

    public function ajax_get_kec($idKota='')
    {
        $kec = $this->daerah_model->get_nama_kecamatan($idKota);
        echo json_encode(array_values($kec));
    }
}