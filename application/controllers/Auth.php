<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{

    public function index()
    {
        $data['title'] = 'Aplikasi Kasir';

        $this->form_validation->set_rules('username', 'Username', 'trim|required', [
            'required' => 'Username wajib diisi'
        ]);
        $this->form_validation->set_rules('password', 'Password', 'trim|required', [
            'required' => 'Password wajib diisi'
        ]);

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('auth/index', $data);
        } else {
            $username = htmlspecialchars($this->input->post('username'));
            $password = htmlspecialchars($this->input->post('password'));

            $user = $this->db->get_where('tb_user', ['username' => $username])->row_array();

            // Cek Username
            if ($user) {
                // Cek Password
                if (password_verify($password, $user['password'])) {
                    $this->session->set_userdata('level', $user['level']);
                    $this->session->set_userdata('id_user', $user['id_user']);
                    switch ($user['level']) {
                        case 1:
                            redirect('admin');
                            break;

                        default:
                            redirect('petugas');
                            break;
                    }
                } else {
                    $this->session->set_flashdata('pesan', ' <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                            Password anda salah
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>');
                    redirect('auth');
                }
            } else {
                $this->session->set_flashdata('pesan', ' <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                            Username anda tidak terdaftar
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>');
                redirect('auth');
            }
        }
    }

    public function logout()
    {
        $this->session->unset_userdata('id_user');
        $this->session->unset_userdata('level');
        $this->session->set_flashdata('pesan', ' <div class="alert alert-success alert-dismissible fade show" role="alert">
                                            Anda berhasil logout
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>');
        redirect('auth');
    }

    public function error()
    {
        $data['title'] = 'Aplikasi Kasir';
        $this->load->view('templates/header');
        $this->load->view('errors/error', $data);
    }
}

/* End of file Auth.php */
