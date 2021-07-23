<?php

defined('BASEPATH') or exit('No direct script access allowed');


class User_model extends CI_Model
{
    public function getSubMenuInputDataObat($keyword = null)

    {
        // untuk menyelek data semua yang didatdbase untuk ditampilkan dan sekalian mencari data
        $this->db->select('*');
        $this->db->from('tbl_input_data_obat');
        if (!empty($keyword)) {
            $this->db->like('nama_obat', $keyword);
        }
        return $this->db->get()->result_array();
    }



    public function getHapusDataObat($id)
    {
        $this->db->where('id_data_obat', $id);
        $this->db->delete('tbl_input_data_obat');
    }

    public function getAllPeoples()
    {
        return $this->db->get('tbl_input_data_obat')->result_array();
    }

    public function getPeoples($limit, $start, $keyword = null)
    {
        if ($keyword) {
            $this->db->like('nama_obat', $keyword);
        }
        return $this->db->get('tbl_input_data_obat', $limit, $start)->result_array();
    }

    public function countAllPeoples()
    {
        return $this->db->get('tbl_input_data_obat')->num_rows();
    }
}
