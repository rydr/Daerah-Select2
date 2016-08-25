<?php
class Daerah_model extends CI_Model
{
    public function get_nama_provinsi()
    {
        $query = $this->db->query('SELECT id_prov, nama FROM provinsi ORDER BY nama ASC');
        $dropdowns = $query->result();
        if(! $dropdowns){
            $finaldropdown[''] = " - Pilih - ";
            return $finaldropdown;
        }
        else{
            foreach ($dropdowns as $dropdown){
                $dropdownlist[$dropdown->id_prov] = $dropdown->nama;
            }
            $finaldropdown = $dropdownlist;
            $finaldropdown[''] = " - Pilih - ";
            return $finaldropdown;
        }
    }

    public function get_nama_kota($idProv='')
    {
        $query = $this->db->query('SELECT id_kab, nama FROM kabupaten WHERE id_prov = '.$idProv.' ORDER BY nama ASC');
        return $dropdowns = $query->result();
    }

    public function get_nama_kecamatan($idKota='')
    {
        $query = $this->db->query('SELECT id_kec, nama FROM kecamatan WHERE id_kab = '.$idKota.' ORDER BY nama ASC');
        return $dropdowns = $query->result();
    }
}