<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{

    public function laporan_pdf()
    {

        $data = array(
            "dataku" => array(
                "nama" => "app",
                "url" => "localhost/app_kasir"
            )
        );

        $this->load->library('pdf');

        $this->pdf->setPaper('A4', 'potrait');
        $this->pdf->filename = "cetak.pdf";
        $this->pdf->load_view('laporan_pdf', $data);
    }
    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('level') != 1) {
            $this->session->set_flashdata('pesan', ' <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                            Anda harus login terlebih dahulu
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>');
            redirect('auth');
        }
    }


    public function index()
    {
        $data['title'] = 'Aplikasi Kasir';
        $data['petugas'] = $this->petugas->GetPetugas()->result_array();
        $data['pelanggan'] = $this->pelanggan->GetPelanggan()->result_array();
        $data['produk'] = $this->produk->GetProduk()->result_array();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('admin/index', $data);
        $this->load->view('templates/footer', $data);
    }

    // ------------------------------------------------------------------------
    // Petugas
    // ------------------------------------------------------------------------

    public function petugas()
    {
        $data['title'] = 'Aplikasi Kasir';
        $data['petugas'] = $this->petugas->GetPetugas()->result_array();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('admin/petugas/index', $data);
        $this->load->view('templates/footer', $data);
    }
    public function tambahpetugas()
    {
        $data['title'] = 'Aplikasi Kasir';

        $this->form_validation->set_rules('nama', 'Nama', 'trim|required', [
            'required' => 'Nama wajib diisi'
        ]);
        $this->form_validation->set_rules('jenis_kelamin', 'Jenis Kelamin', 'trim|required', [
            'required' => 'Jenis Kelamin wajib diisi'
        ]);
        $this->form_validation->set_rules('alamat', 'Alamat', 'trim|required', [
            'required' => 'Alamat wajib diisi'
        ]);
        $this->form_validation->set_rules('username', 'Username', 'trim|required|is_unique[tb_user.username]', [
            'required' => 'Username wajib diisi',
            'is_unique' => 'Username sudah terdaftar'
        ]);
        $this->form_validation->set_rules('password', 'Password', 'trim|required|matches[konformasi_password]', [
            'required' => 'Password wajib diisi',
            'matches' => 'Password tidak sama dengan konfirmasi password'
        ]);
        $this->form_validation->set_rules('konformasi_password', 'Konfirmasi Password', 'trim|required|matches[password]', [
            'required' => 'Konfirmasi Password wajib diisi',
            'matches' => 'Password tidak sama dengan konfirmasi password'
        ]);


        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('admin/petugas/tambah', $data);
            $this->load->view('templates/footer', $data);
        } else {
            $nama = htmlspecialchars($this->input->post('nama'));
            $jenis_kelamin = htmlspecialchars($this->input->post('jenis_kelamin'));
            $alamat = htmlspecialchars($this->input->post('alamat'));
            $username = htmlspecialchars($this->input->post('username'));
            $password = htmlspecialchars($this->input->post('password'));

            $config['upload_path'] = './assets/img/petugas/';
            $config['allowed_types'] = 'jpg|png|jpeg';
            $config['max_size']  = 1024 * 10;
            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('foto')) {
                $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            Foto gagal di upload
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>');
                redirect('admin/tambahpetugas');
            } else {
                $data = [
                    'username' => $username,
                    'password' => password_hash($password, PASSWORD_DEFAULT),
                    'level' => 2
                ];
                $this->db->insert('tb_user', $data);
                $id_user = $this->db->insert_id();
                $foto = $this->upload->data();
                $data = [
                    'nama' => $nama,
                    'jenis_kelamin' => $jenis_kelamin,
                    'alamat' => $alamat,
                    'foto' => $foto['file_name'],
                    'id_user' => $id_user
                ];
                $this->db->insert('tb_petugas', $data);
                $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
            Data berhasil ditambah
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>');
                redirect('admin/petugas');
            }
        }
    }

    public function editpetugas($id = 0)
    {
        $data['petugas'] = $this->petugas->GetPetugasById($id)->row_array();
        if ($data['petugas'] == null) {
            redirect('admin/petugas');
        }
        $data['title'] = 'Aplikasi Kasir';
        $this->form_validation->set_rules('nama', 'Nama', 'trim|required', [
            'required' => 'Nama wajib diisi'
        ]);
        $this->form_validation->set_rules('jenis_kelamin', 'Jenis Kelamin', 'trim|required', [
            'required' => 'Jenis Kelamin wajib diisi'
        ]);
        $this->form_validation->set_rules('alamat', 'Alamat', 'trim|required', [
            'required' => 'Alamat wajib diisi'
        ]);



        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('admin/petugas/edit', $data);
            $this->load->view('templates/footer', $data);
        } else {
            $foto_lama = htmlspecialchars($this->input->post('foto_lama'));
            $nama = htmlspecialchars($this->input->post('nama'));
            $jenis_kelamin = htmlspecialchars($this->input->post('jenis_kelamin'));
            $alamat = htmlspecialchars($this->input->post('alamat'));

            if ($_FILES['foto']['name']) {
                // Delete the existing image file
                unlink('./assets/img/petugas/' . $foto_lama);

                $config['upload_path']   = './assets/img/petugas/';
                $config['allowed_types'] = 'jpg|jpeg|png';
                $config['max_size']      = 1024 * 10;

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('foto')) {
                    $upload_data = $this->upload->data();
                    $foto = $upload_data['file_name'];
                } else {
                    $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            Foto gagal di upload
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>');
                    redirect('admin/editpetugas/' . $id);
                }
            } else {
                $foto = $foto_lama;
            }

            $data = [
                'nama' => $nama,
                'jenis_kelamin' => $jenis_kelamin,
                'alamat' => $alamat,
                'foto' => $foto
            ];

            $this->db->update('tb_petugas', $data, ['id_user' => $id]);
            $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
            Data berhasil diedit
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>');
            redirect('admin/petugas');
        }
    }

    public function hapuspetugas($id = 0)
    {
        $data['petugas'] = $this->petugas->GetPetugasById($id)->row_array();
        if ($data['petugas'] == null) {
            redirect('admin/petugas');
        }
        unlink('./assets/img/petugas/' . $data['petugas']['foto']);
        $this->db->delete('tb_petugas', ['id_user' => $id]);
        $this->db->delete('tb_user', ['id_user' => $id]);
        $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
            Data berhasil dihapus
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>');
        redirect('admin/petugas');
    }
    // ------------------------------------------------------------------------
    // Pelanggan
    // ------------------------------------------------------------------------

    public function pelanggan()
    {
        $data['title'] = 'Aplikasi Kasir';
        $data['pelanggan'] = $this->pelanggan->GetPelanggan()->result_array();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('admin/pelanggan/index', $data);
        $this->load->view('templates/footer', $data);
    }

    public function tambahpelanggan()
    {
        $data['title'] = 'Aplikasi Kasir';
        $data['pelanggan'] = $this->pelanggan->GetIdPelanggan()->row_array();

        $this->form_validation->set_rules('id_pelanggan', 'ID Pelanggan', 'trim|required', [
            'required' => 'ID Pelanggan wajib diisi'
        ]);
        $this->form_validation->set_rules('nama', 'Nama', 'trim|required', [
            'required' => 'Nama wajib diisi'
        ]);
        $this->form_validation->set_rules('alamat', 'Alamat', 'trim|required', [
            'required' => 'Alamat wajib diisi'
        ]);
        $this->form_validation->set_rules('no_telepon', 'No Telepon', 'trim|required|min_length[12]|max_length[15]', [
            'required' => 'No Telepon wajib diisi',
            'min_length' => 'No Telepon minimal 12 digit angka',
            'max_length' => 'No Telepon maksimal 15 digit angka'
        ]);



        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('admin/pelanggan/tambah', $data);
            $this->load->view('templates/footer', $data);
        } else {
            $nama = htmlspecialchars($this->input->post('nama'));
            $id_pelanggan = htmlspecialchars($this->input->post('id_pelanggan'));
            $alamat = htmlspecialchars($this->input->post('alamat'));
            $no_telepon = htmlspecialchars($this->input->post('no_telepon'));

            $data = [
                'nama' => $nama,
                'id_pelanggan' => $id_pelanggan,
                'alamat' => $alamat,
                'no_telepon' => $no_telepon
            ];
            $this->db->insert('tb_pelanggan', $data);
            $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
            Data berhasil ditambah
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>');
            redirect('admin/pelanggan');
        }
    }

    public function editpelanggan($id = 0)
    {
        $data['title'] = 'Aplikasi Kasir';

        $data['pelanggan'] = $this->pelanggan->GetPelangganById($id)->row_array();
        if ($data['pelanggan'] == null) {
            redirect('admin/pelanggan');
        }
        $this->form_validation->set_rules('id_pelanggan', 'ID Pelanggan', 'trim|required', [
            'required' => 'ID Pelanggan wajib diisi'
        ]);
        $this->form_validation->set_rules('nama', 'Nama', 'trim|required', [
            'required' => 'Nama wajib diisi'
        ]);
        $this->form_validation->set_rules('alamat', 'Alamat', 'trim|required', [
            'required' => 'Alamat wajib diisi'
        ]);
        $this->form_validation->set_rules('no_telepon', 'No Telepon', 'trim|required|min_length[12]|max_length[15]', [
            'required' => 'No Telepon wajib diisi',
            'min_length' => 'No Telepon minimal 12 digit angka',
            'max_length' => 'No Telepon maksimal 15 digit angka'
        ]);


        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('admin/pelanggan/edit', $data);
            $this->load->view('templates/footer', $data);
        } else {
            $nama = htmlspecialchars($this->input->post('nama'));
            $id_pelanggan = htmlspecialchars($this->input->post('id_pelanggan'));
            $alamat = htmlspecialchars($this->input->post('alamat'));
            $no_telepon = htmlspecialchars($this->input->post('no_telepon'));

            $data = [
                'nama' => $nama,
                'id_pelanggan' => $id_pelanggan,
                'alamat' => $alamat,
                'no_telepon' => $no_telepon
            ];
            $this->db->update('tb_pelanggan', $data, ['id_pelanggan' => $id]);
            $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
            Data berhasil diedit
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>');
            redirect('admin/pelanggan');
        }
    }

    public function hapuspelanggan($id = 0)
    {
        $data['title'] = 'Aplikasi Kasir';

        $data['pelanggan'] = $this->pelanggan->GetPelangganById($id)->row_array();
        if ($data['pelanggan'] == null) {
            redirect('admin/pelanggan');
        }

        $this->db->delete('tb_pelanggan', ['id_pelanggan' => $id]);
        $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
            Data berhasil dihapus
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>');
        redirect('admin/pelanggan');
    }
    // ------------------------------------------------------------------------
    // Produk
    // ------------------------------------------------------------------------

    public function produk()
    {
        $data['title'] = 'Aplikasi Kasir';
        $data['produk'] = $this->produk->GetProduk()->result_array();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('admin/produk/index', $data);
        $this->load->view('templates/footer', $data);
    }

    public function tambahproduk()
    {
        $data['title'] = 'Aplikasi Kasir';
        $this->form_validation->set_rules('nama_produk', 'Nama Produk', 'trim|required', [
            'required' => 'Nama produk wajib diisi'
        ]);
        $this->form_validation->set_rules('harga', 'Harga', 'trim|required', [
            'required' => 'Harga wajib diisi'
        ]);
        $this->form_validation->set_rules('stok', 'Stok', 'trim|required', [
            'required' => 'Stok wajib diisi'
        ]);

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('admin/produk/tambah', $data);
            $this->load->view('templates/footer', $data);
        } else {
            $nama_produk = htmlspecialchars($this->input->post('nama_produk'));
            $harga = htmlspecialchars($this->input->post('harga'));
            $stok = htmlspecialchars($this->input->post('stok'));

            $data = [
                'nama_produk' => $nama_produk,
                'harga' => $harga,
                'stok' => $stok
            ];
            $this->db->insert('tb_produk', $data);
            $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
            Data berhasil ditambah
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>');
            redirect('admin/produk');
        }
    }

    public function editproduk($id = 0)
    {
        $data['produk'] = $this->produk->GetProdukById($id)->row_array();
        if ($data['produk'] == null) {
            redirect('admin/produk');
        }
        $data['title'] = 'Aplikasi Kasir';
        $this->form_validation->set_rules('nama_produk', 'Nama Produk', 'trim|required', [
            'required' => 'Nama produk wajib diisi'
        ]);
        $this->form_validation->set_rules('harga', 'Harga', 'trim|required', [
            'required' => 'Harga wajib diisi'
        ]);
        $this->form_validation->set_rules('stok', 'Stok', 'trim|required', [
            'required' => 'Stok wajib diisi'
        ]);

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('admin/produk/edit', $data);
            $this->load->view('templates/footer', $data);
        } else {
            $nama_produk = htmlspecialchars($this->input->post('nama_produk'));
            $harga = htmlspecialchars($this->input->post('harga'));
            $stok = htmlspecialchars($this->input->post('stok'));

            $data = [
                'nama_produk' => $nama_produk,
                'harga' => $harga,
                'stok' => $stok
            ];
            $this->db->update('tb_produk', $data, ['id_produk' => $id]);
            $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
            Data berhasil diedit
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>');
            redirect('admin/produk');
        }
    }

    public function hapusproduk($id = 0)
    {
        $data['produk'] = $this->produk->GetProdukById($id)->row_array();
        if ($data['produk'] == null) {
            redirect('admin/produk');
        }

        $this->db->delete('tb_produk', ['id_produk' => $id]);
        $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
            Data berhasil dihapus
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>');
        redirect('admin/produk');
    }

    public function gantipassword()
    {
        $data['title'] = 'Aplikasi Kasir';
        $this->form_validation->set_rules('password', 'Password', 'trim|required|matches[konfirmasi_password]', [
            'required' => 'Password wajib diisi',
            'matches' => 'Password harus sama dengan konfirmasi password'
        ]);
        $this->form_validation->set_rules('konfirmasi_password', 'Konfirmasi Password', 'trim|required|matches[password]', [
            'required' => 'Password wajib diisi',
            'matches' => 'Password harus sama dengan konfirmasi password'
        ]);

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('admin/gantipassword', $data);
            $this->load->view('templates/footer', $data);
        } else {
            $password = htmlspecialchars($this->input->post('password'));
            $id_user = $this->session->userdata('id_user');
            $data = ['password' => password_hash($password, PASSWORD_DEFAULT)];
            $this->db->update('tb_user', $data, ['id_user' => $id_user]);
            $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
            Password berhasil diganti
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>');
            redirect('admin/gantipassword');
        }
    }

    public function stokproduk($id = 0)
    {
        $data['produk'] = $this->produk->GetProdukById($id)->row_array();
        if ($data['produk'] == null) {
            redirect('admin/produk');
        }

        $stok = htmlspecialchars_decode($this->input->post('stok'));

        $stok_baru = $stok + $data['produk']['stok'];
        $data = ['stok' => $stok_baru];
        $this->db->update('tb_produk', $data, ['id_produk' => $id]);
        $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
            Stok berhasil di tambah
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>');
        redirect('admin/produk');
    }

    public function laporan()
    {
        $data['title'] = 'Aplikasi Kasir';
        $tanggal_awal = $this->input->post('tanggal_awal');
        $tanggal_akhir = $this->input->post('tanggal_akhir');

        // Periksa apakah nilai null sebelum menggunakan htmlspecialchars
        if (isset($tanggal_awal))
            $tanggal_awal = htmlspecialchars($tanggal_awal);
        if (isset($tanggal_akhir))
            $tanggal_akhir = htmlspecialchars($tanggal_akhir);

        $data['tanggal'] = ['awal' => $tanggal_awal, 'akhir' => $tanggal_akhir];
        $data['transaksi'] = $this->penjualan->FilterPenjualan($tanggal_awal, $tanggal_akhir)->result_array();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('admin/laporan', $data);
        $this->load->view('templates/footer', $data);
    }

    public function cetaklaporan($tanggal_awal = 0, $tanggal_akhir = 0)
    {
        $data['transaksi'] = $this->penjualan->FilterPenjualan($tanggal_awal, $tanggal_akhir)->result_array();
        if ($data['transaksi'] == null) {
            redirect('admin/laporan');
        }
        $data['tanggal'] = ['awal' => $tanggal_awal, 'akhir' => $tanggal_akhir];
        $data['title'] = 'Aplikasi Kasir';
        $this->load->library('pdf');
        $this->pdf->setPaper('A4', 'potrait');
        $this->pdf->filename = "Laporan Bulanan.pdf";
        $this->pdf->load_view('admin/cetaklaporan', $data);
    }
}

/* End of file Admin.php */
