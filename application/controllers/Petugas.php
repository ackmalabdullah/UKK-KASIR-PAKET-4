<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Petugas extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('level') != 2) {
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
        $id_user = $this->session->userdata('id_user');
        $data['petugas'] = $this->petugas->GetPetugasById($id_user)->row_array();
        $data['penjualan'] = $this->penjualan->GetIdPenjualan()->row_array();
        $data['pelanggan'] = $this->pelanggan->GetPelanggan()->result_array();

        $this->form_validation->set_rules('id_pelanggan', 'ID Pelanggan', 'trim|required', [
            'required' => 'Pelanggan wajib dipilih'
        ]);
        $this->form_validation->set_rules('jumlah_produk', 'Jumlah Produk', 'trim|required', [
            'required' => 'Jumlah produk wajib dipilih'
        ]);

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('petugas/index', $data);
            $this->load->view('templates/footer', $data);
        } else {
            $id_penjualan = htmlspecialchars($this->input->post('id_penjualan'));
            $id_pelanggan = htmlspecialchars($this->input->post('id_pelanggan'));
            $jumlah_produk = htmlspecialchars($this->input->post('jumlah_produk'));
            $tanggal = date('Y-m-d');

            $data = [
                'id_penjualan' => $id_penjualan,
                'id_pelanggan' => $id_pelanggan,
                'jumlah_produk' => $jumlah_produk,
                'tanggal_penjualan' => $tanggal
            ];
            $this->db->insert('tb_penjualan', $data);
            $this->session->set_flashdata('pesan', ' <div class="alert alert-success alert-dismissible fade show" role="alert">
                                            Penjualan berhasil diinput pilih produk
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>');
            redirect('petugas/pilihproduk/' . $id_penjualan);
        }
    }

    public function pilihproduk($id_penjualan = 0)
    {
        $data['penjualan'] = $this->penjualan->GetPenjualanById($id_penjualan)->row_array();
        if ($data['penjualan'] == null) {
            redirect('petugas');
        }

        $this->form_validation->set_rules('id_produk[]', 'Produk', 'trim|required', [
            'required' => 'Produk wajib dipilih'
        ]);
        $this->form_validation->set_rules('jumlah_produk[]', 'Jumlah Produk', 'trim|required', [
            'required' => 'Jumlah produk wajib dipilih'
        ]);

        $data['title'] = 'Aplikasi Kasir';
        $id_user = $this->session->userdata('id_user');
        $data['petugas'] = $this->petugas->GetPetugasById($id_user)->row_array();
        $data['produk'] = $this->produk->GetProduk()->result_array();
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('petugas/pilihproduk', $data);
            $this->load->view('templates/footer', $data);
        } else {
            $id_penjualan = htmlspecialchars($this->input->post('id_penjualan'));
            $id_produk = $this->input->post('id_produk[]');

            for ($i = 0; $i < count($id_produk); $i++) {

                $data[$i] = [
                    'id_penjualan' => $id_penjualan,
                    'id_produk' =>  $this->input->post('id_produk[' . $i . ']'),
                    'jumlah_produk' => $this->input->post('jumlah_produk[' . $i . ']'),
                ];
                $this->db->insert('tb_detailpenjualan', $data[$i]);
                $produk[$i] = $this->produk->GetProdukById($this->input->post('id_produk[' . $i . ']'))->row_array();
                $jumlah_produk[$i] = $produk[$i]['stok'] - $this->input->post('jumlah_produk[' . $i . ']');
                $data[$i] = ['stok' => $jumlah_produk[$i]];
                $this->db->update('tb_produk', $data[$i], ['id_produk' => $this->input->post('id_produk[' . $i . ']')]);
            }


            $this->session->set_flashdata('pesan', ' <div class="alert alert-success alert-dismissible fade show" role="alert">
                                            Silahkan bayar
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>');
            redirect('petugas/bayar/' . $id_penjualan);
        }
    }

    public function bayar($id_penjualan = 0)
    {
        $data['penjualan'] = $this->penjualan->GetDetailPenjualanById($id_penjualan)->result_array();
        if ($data['penjualan'] == null) {
            redirect('petugas');
        }

        $this->form_validation->set_rules('bayar', 'Bayar', 'trim|required', [
            'required' => 'Bayar Wajib diisi'
        ]);
        $data['title'] = 'Aplikasi Kasir';
        $id_user = $this->session->userdata('id_user');
        $data['petugas'] = $this->petugas->GetPetugasById($id_user)->row_array();
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('petugas/bayar', $data);
            $this->load->view('templates/footer', $data);
        } else {
            $bayar = htmlspecialchars($this->input->post('bayar'));
            $total_bayar = htmlspecialchars($this->input->post('total_bayar'));
            if ($bayar < $total_bayar) {
                $this->session->set_flashdata('pesan', ' <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                            Uang anda kurang
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>');
                redirect('petugas/bayar/' . $id_penjualan);
            }
            $data = [
                'bayar' => $bayar,
                'total_bayar' => $total_bayar
            ];

            $this->db->update('tb_penjualan', $data, ['id_penjualan' => $id_penjualan]);
            $this->session->set_flashdata('pesan', ' <div class="alert alert-success alert-dismissible fade show" role="alert">
                                            Berhasil dibayar
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>');
            redirect('petugas/detailpenjualan/' . $id_penjualan);
        }
    }

    public function detailpenjualan($id_penjualan = 0)
    {
        $data['penjualan'] = $this->penjualan->GetDetailPenjualanById($id_penjualan)->result_array();
        if ($data['penjualan'] == null) {
            redirect('petugas');
        }
        $data['title'] = 'Aplikasi Kasir';
        $id_user = $this->session->userdata('id_user');
        $data['petugas'] = $this->petugas->GetPetugasById($id_user)->row_array();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('petugas/detailpenjualan', $data);
        $this->load->view('templates/footer', $data);
    }

    public function transaksi()
    {
        $data['title'] = 'Aplikasi Kasir';
        $id_user = $this->session->userdata('id_user');
        $data['transaksi'] = $this->penjualan->GetPenjualan()->result_array();
        $data['petugas'] = $this->petugas->GetPetugasById($id_user)->row_array();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('petugas/transaksi', $data);
        $this->load->view('templates/footer', $data);
    }

    // ------------------------------------------------------------------------
    // Produk
    // ------------------------------------------------------------------------

    public function produk()
    {
        $id_user = $this->session->userdata('id_user');
        $data['petugas'] = $this->petugas->GetPetugasById($id_user)->row_array();
        $data['title'] = 'Aplikasi Kasir';
        $data['produk'] = $this->produk->GetProduk()->result_array();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('petugas/produk/index', $data);
        $this->load->view('templates/footer', $data);
    }

    public function tambahproduk()
    {
        $data['title'] = 'Aplikasi Kasir';
        $id_user = $this->session->userdata('id_user');
        $data['petugas'] = $this->petugas->GetPetugasById($id_user)->row_array();
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
            $this->load->view('petugas/produk/tambah', $data);
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
            redirect('petugas/produk');
        }
    }

    public function editproduk($id = 0)
    {
        $data['produk'] = $this->produk->GetProdukById($id)->row_array();
        if ($data['produk'] == null) {
            redirect('petugas/produk');
        }
        $data['title'] = 'Aplikasi Kasir';
        $id_user = $this->session->userdata('id_user');
        $data['petugas'] = $this->petugas->GetPetugasById($id_user)->row_array();
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
            $this->load->view('petugas/produk/edit', $data);
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
            redirect('petugas/produk');
        }
    }

    public function hapusproduk($id = 0)
    {
        $data['produk'] = $this->produk->GetProdukById($id)->row_array();
        if ($data['produk'] == null) {
            redirect('petugas/produk');
        }

        $this->db->delete('tb_produk', ['id_produk' => $id]);
        $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
            Data berhasil dihapus
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>');
        redirect('petugas/produk');
    }


    public function stokproduk($id = 0)
    {
        $data['produk'] = $this->produk->GetProdukById($id)->row_array();
        if ($data['produk'] == null) {
            redirect('petugas/produk');
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
        redirect('petugas/produk');
    }

    public function cetak($id_penjualan = 0)
    {
        $data['penjualan'] = $this->penjualan->GetDetailPenjualanById($id_penjualan)->result_array();
        if ($data['penjualan'] == null) {
            redirect('petugas');
        }
        $data['title'] = 'Aplikasi Kasir';
        $id_penjualan = $data['penjualan'][0]['id_penjualan'];
        $this->load->library('pdf');
        $this->pdf->setPaper('A4', 'potrait');
        $this->pdf->filename = "$id_penjualan.pdf";
        $this->pdf->load_view('petugas/cetak', $data);
    }

    public function laporan()
    {
        $data['title'] = 'Aplikasi Kasir';
        $id_user = $this->session->userdata('id_user');
        $data['petugas'] = $this->petugas->GetPetugasById($id_user)->row_array();

        // Periksa apakah input tidak kosong sebelum menggunakan htmlspecialchars
        $tanggal_awal = $this->input->post('tanggal_awal');
        $tanggal_akhir = $this->input->post('tanggal_akhir');
        if (!empty($tanggal_awal)) {
            $tanggal_awal = htmlspecialchars($tanggal_awal);
        }
        if (!empty($tanggal_akhir)) {
            $tanggal_akhir = htmlspecialchars($tanggal_akhir);
        }

        $data['tanggal'] = ['awal' => $tanggal_awal, 'akhir' => $tanggal_akhir];
        $data['transaksi'] = $this->penjualan->FilterPenjualan($tanggal_awal, $tanggal_akhir)->result_array();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('petugas/laporan', $data);
        $this->load->view('templates/footer', $data);
    }

    public function cetaklaporan($tanggal_awal = 0, $tanggal_akhir = 0)
    {
        $data['transaksi'] = $this->penjualan->FilterPenjualan($tanggal_awal, $tanggal_akhir)->result_array();
        if ($data['transaksi'] == null) {
            redirect('petugas/laporan');
        }
        $data['tanggal'] = ['awal' => $tanggal_awal, 'akhir' => $tanggal_akhir];
        $data['title'] = 'Aplikasi Kasir';
        $this->load->library('pdf');
        $this->pdf->setPaper('A4', 'potrait');
        $this->pdf->filename = "Laporan Bulanan.pdf";
        $this->pdf->load_view('petugas/cetaklaporan', $data);
    }

    public function gantipassword()
    {
        $data['title'] = 'Aplikasi Kasir';
        $id_user = $this->session->userdata('id_user');
        $data['petugas'] = $this->petugas->GetPetugasById($id_user)->row_array();
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
            $this->load->view('petugas/gantipassword', $data);
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
            redirect('petugas/gantipassword');
        }
    }

    public function profile()
    {
        $id = $this->session->userdata('id_user');
        $data['petugas'] = $this->petugas->GetPetugasById($id)->row_array();

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
            $this->load->view('petugas/profile', $data);
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
                    redirect('petugas/profile/' . $id);
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
            redirect('petugas/profile');
        }
    }
}

/* End of file Petugas.php */
