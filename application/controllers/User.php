<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
    }
    public function index()
    {
        $data['title'] = 'My Profile';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])
            ->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('user/index', $data);
        $this->load->view('templates/footer');
    }


    public function edit()
    {
        $data['title'] = 'Edit Profile';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();

        $this->form_validation->set_rules('name', 'Full Name', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('user/edit', $data);
            $this->load->view('templates/footer');
        } else {
            $name = $this->input->post('name');
            $email = $this->input->post('email');


            // cek gambar yang akan diupload
            $upload_image = $_FILES['image']['name'];

            if ($upload_image) {
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size'] = '2048';
                $config['upload_path'] = './assets/img/profile/';

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('image')) {
                    $new_image = $this->upload->data('file_name');
                    $this->db->set('image', $new_image);
                } else {
                    echo $this->upload->display_errors();
                }
            }

            $this->db->set('name', $name);
            $this->db->where('email', $email);
            $this->db->update('user');

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Your profile has been updated!</div>');
            redirect('user');
        }
    }

    public function changePassword()
    {
        $data['title'] = 'Change Password';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])
            ->row_array();

        $this->form_validation->set_rules('current_password', 'Current Password', 'required|trim');
        $this->form_validation->set_rules('new_password1', 'New Password', 'required|trim|min_length[4]|matches[new_password2]');
        $this->form_validation->set_rules('new_password2', 'Confirm New Password', 'required|trim|min_length[4]|matches[new_password1]');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('user/changepassword', $data);
            $this->load->view('templates/footer');
        } else {
            $current_password = $this->input->post('current_password');
            $new_password = $this->input->post('new_password1');
            if (!password_verify($current_password, $data['user']['password'])) {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
               Wrong current password!</div>');
                redirect('user/changepassword');
            } else {
                if ($current_password == $new_password) {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                    new password cannot be the same as current password!</div>');
                    redirect('user/changepassword');
                } else {
                    //password ok
                    $password_hash = password_hash($new_password, PASSWORD_DEFAULT);

                    $this->db->set('password', $password_hash);
                    $this->db->where('email', $this->session->userdata('email'));
                    $this->db->update('user');

                    $this->session->set_flashdata('flash', 'Diubah');
                    redirect('user/changepassword');
                }
            }
        }
    }

    public function submenuinputdataobat()
    {

        $data['title'] = 'Input Data Obat';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();

        $this->load->model('User_model', 'user');

        // load library Awal pagination
        $this->load->library('pagination');

        // ambil data keyword

        if ($keyword = $this->input->post('submit'));
        $data['keyword'] = $this->input->post('keyword');

        //config
        $config['total_rows'] = $this->user->countAllPeoples();
        $config['per_page'] = 6;

        // initialize
        $this->pagination->initialize($config);

        $data['start'] = $this->uri->segment(3);
        $data['subMenuInputDataObat'] = $this->user->getPeoples($config['per_page'], $data['start'], $data['keyword']);

        // akhir pagination

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('user/submenuinputdataobat', $data);
        $this->load->view('templates/footer');
    }

    public function hapus($id)
    {
        $this->load->model('User_model', 'user');
        $this->user->getHapusDataObat($id);
        $this->session->set_flashdata('flash', 'Dihapus');
        redirect('user/submenuinputdataobat');
    }


    public function ubah()
    {
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();

        $this->form_validation->set_rules('kode_obat', 'Kode_obat', 'required');
        $this->form_validation->set_rules('nama_obat', 'Nama_obat', 'required');
        $this->form_validation->set_rules('jenis_obat', 'Jenis_obat', 'required');
        $this->form_validation->set_rules('satuan', 'Satuan', 'required');
        $this->form_validation->set_rules('klasifikasi_obat', 'Klasifikasi_obat', 'required');
        $this->form_validation->set_rules('jumlah', 'Jumlah', 'required|numeric');
        $this->form_validation->set_rules('status', 'Status', 'required');
        $this->form_validation->set_rules('persediaan', 'Persediaan', 'required|numeric');
        $this->form_validation->set_rules('expiret', 'Expiret', 'required');
        $this->form_validation->set_rules('harga_beli', 'Harga_beli', 'required|numeric');
        $this->form_validation->set_rules('harga_jual', 'Harga_jual', 'required|numeric');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('user/submenuinputdataobat', $data);
            $this->load->view('templates/footer');
        } else {
            $id_data_obat = $this->input->post('id_data_obat');
            $kode_obat = $this->input->post('kode_obat');
            $nama_obat = $this->input->post('nama_obat');
            $jenis_obat = $this->input->post('jenis_obat');
            $satuan = $this->input->post('satuan');
            $klasifikasi_obat = $this->input->post('klasifikasi_obat');
            $jumlah = $this->input->post('jumlah');
            $status = $this->input->post('status');
            $persediaan = $this->input->post('persediaan');
            $expiret = $this->input->post('expiret');
            $harga_beli = $this->input->post('harga_beli');
            $harga_jual = $this->input->post('harga_jual');

            $this->db->set('kode_obat', $kode_obat);
            $this->db->set('nama_obat', $nama_obat);
            $this->db->set('jenis_obat', $jenis_obat);
            $this->db->set('satuan', $satuan);
            $this->db->set('klasifikasi_obat', $klasifikasi_obat);
            $this->db->set('jumlah', $jumlah);
            $this->db->set('status', $status);
            $this->db->set('persediaan', $persediaan);
            $this->db->set('expiret', $expiret);
            $this->db->set('harga_beli', $harga_beli);
            $this->db->set('harga_jual', $harga_jual);
            $this->db->where('id_data_obat', $id_data_obat);
            $this->db->update('tbl_input_data_obat');

            $this->session->set_flashdata('flash', 'Diubah');
            redirect('user/submenuinputdataobat');
        }
    }

    public function tambahdataobat()
    {

        $data['title'] = 'Input Data Obat';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();

        $this->load->model('User_model', 'user');

        $data['subMenuInputDataObat'] = $this->user->getSubMenuInputDataObat();

        $data['submenuinputdataobat'] = $this->db->get('tbl_input_data_obat')->result_array();

        $this->form_validation->set_rules('kode_obat', 'Kode_obat', 'required');
        $this->form_validation->set_rules('nama_obat', 'Nama_obat', 'required');
        $this->form_validation->set_rules('jenis_obat', 'Jenis_obat', 'required');
        $this->form_validation->set_rules('satuan', 'Satuan', 'required');
        $this->form_validation->set_rules('klasifikasi_obat', 'Klasifikasi_obat', 'required');
        $this->form_validation->set_rules('jumlah', 'Jumlah', 'required');
        $this->form_validation->set_rules('status', 'Status', 'required');
        $this->form_validation->set_rules('persediaan', 'Persediaan', 'required');
        $this->form_validation->set_rules('expiret', 'Expiret', 'required');
        $this->form_validation->set_rules('harga_beli', 'Harga_beli', 'required');
        $this->form_validation->set_rules('harga_jual', 'Harga_jual', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('user/tambahdataobat', $data);
            $this->load->view('templates/footer');
        } else {
            $data = [
                'kode_obat' => $this->input->post('kode_obat'),
                'nama_obat' => $this->input->post('nama_obat'),
                'jenis_obat' => $this->input->post('jenis_obat'),
                'satuan' => $this->input->post('satuan'),
                'klasifikasi_obat' => $this->input->post('klasifikasi_obat'),
                'jumlah' => $this->input->post('jumlah'),
                'status' => $this->input->post('status'),
                'persediaan' => $this->input->post('persediaan'),
                'expiret' => $this->input->post('expiret'),
                'harga_beli' => $this->input->post('harga_beli'),
                'harga_jual' => $this->input->post('harga_jual')

            ];
            $this->db->insert('tbl_input_data_obat', $data);
            // swithalert flas data
            $this->session->set_flashdata('flash', 'Ditambahkan');
            redirect('user/submenuinputdataobat');
        }
    }
}
