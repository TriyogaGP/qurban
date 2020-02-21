<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('Dashboard_model');
		$this->load->library('upload');
		if($this->session->userdata('masuk') != TRUE){
			$url=base_url();
			echo $this->session->set_flashdata('error','Anda tidak boleh masuk Panel Dashboard, silahkan login terlebih dahulu ..');
			redirect($url);
			// echo '<script language="javascript">alert("Anda tidak boleh masuk Panel Dashboard, silahkan login terlebih dahulu .."); document.location="'.$url.'";</script>';
		}
	}

	private function tampilanViewHeader(){
		// $data = array(
  //     'jml_keranjang' => $this->Dashboard_model->get_all_keranjangbulanBY($this->session->userdata('ses_idadmin'))->num_rows(),
  //     'jml_customer' => $this->Dashboard_model->get_all_customerBY2($this->session->userdata('ses_idadmin'))->num_rows(),
  //   );
		$this->load->view('tampilan/header', $data);
	}

	private function tampilanViewFooter(){
		$this->load->view('tampilan/footer');
	}

	function time_since($original)
	{
	  date_default_timezone_set('Asia/Jakarta');
	  $chunks = array(
	      array(60 * 60 * 24 * 365, 'tahun'),
	      array(60 * 60 * 24 * 30, 'bulan'),
	      array(60 * 60 * 24 * 7, 'minggu'),
	      array(60 * 60 * 24, 'hari'),
	      array(60 * 60, 'jam'),
	      array(60, 'menit'),
	  );
	  $today = time();
	  $since = $today - $original;
	 
	  if ($since > 604800)
	  {
	    $print = date("M jS", $original);
	    if ($since > 31536000)
	    {
	      $print .= ", " . date("Y", $original);
	    }
	    return $print;
	  }
	 
	  for ($i = 0, $j = count($chunks); $i < $j; $i++)
	  {
	    $seconds = $chunks[$i][0];
	    $name = $chunks[$i][1];
	 
	    if (($count = floor($since / $seconds)) != 0)
	      break;
	  }
	 
	  $print = ($count == 1) ? '1 ' . $name : "$count {$name}";
	  return $print . ' yang lalu';
	}

	function index(){
		$this->tampilanViewHeader();
		$this->load->view('dashboard');
		$this->tampilanViewFooter();
	}

	function admin(){
		$data = array(
      'data_admin' => $this->Dashboard_model->get_all_admin()->result_array(),
    );
		$this->tampilanViewHeader();
		$this->load->view('Administrator/v_admin', $data);
		$this->tampilanViewFooter();
	}

	function addadmin(){
		$this->tampilanViewHeader();
		$this->load->view('Administrator/add_admin');
		$this->tampilanViewFooter();
	}

	function saveadmin(){
		$this->form_validation->set_rules('inputNama','Input Nama Lengkap', 'required');
		$this->form_validation->set_rules('inputEmail','Input Email', 'required|valid_email');
		$this->form_validation->set_rules('inputUsername','Input Username', 'required|min_length[1]|max_length[25]');
		$this->form_validation->set_rules('inputPassword','Input Password', 'required|min_length[6]|max_length[15]');
		$this->form_validation->set_rules('inputTelepon','Input Telepon', 'required|max_length[15]');
		$this->form_validation->set_rules('level','Pilih Level', 'required');
 		
    if ($this->form_validation->run() == FALSE) { 
    	$this->session->set_flashdata('info', 'Coba cek lagi data input anda, kemungkinan terdapat kesalahan !!! Terimakasih ..');
  		redirect('admin');
		}else{
			$config['upload_path'] = './assets/images/gambar_user/'; //path folder
     	$config['allowed_types'] = 'jpg|png|jpeg|bmp'; //type yang dapat diakses bisa anda sesuaikan
     	$config['encrypt_name'] = FALSE; //Enkripsi nama yang terupload

	    $this->upload->initialize($config);
      if(!empty($_FILES['foto']['name'])){

	    	if ($this->upload->do_upload('foto')){
        	$gbr = $this->upload->data();
        	$file_gbr = str_replace(" ", "_", $gbr['file_name']);
          $config['image_library']='gd2';
          $config['source_image']='./assets/images/gambar_user/'.$file_gbr;
          $config['create_thumb']= FALSE;
          $config['maintain_ratio']= FALSE;
          $config['quality']= '50%';
          $config['width']= 200;
          $config['height']= 200;
          $config['new_image']= './assets/images/gambar_user/'.$file_gbr;
          $this->load->library('image_lib', $config);
          $this->image_lib->resize();
          $gambar = $file_gbr;
        }
                  
        $set = '123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
				$code = substr(str_shuffle($set), 0, 15);
    		$inputNama = $this->input->post('inputNama');
    		$inputEmail = $this->input->post('inputEmail');
    		$inputUsername = $this->input->post('inputUsername', true);
    		$inputPassword = md5($this->input->post('inputPassword', true));
    		$inputTelepon = $this->input->post('inputTelepon');
    		$inputAlamat = $this->input->post('inputAlamat');
    		$inputCode = $code;
    		$level = $this->input->post('level');
				$kirimdata['id_role'] = $level;
    		$kirimdata['nama'] = $inputNama;
				$kirimdata['email'] = $inputEmail;
				$kirimdata['username'] = $inputUsername;
				$kirimdata['password'] = $inputPassword;
				$kirimdata['no_telp'] = $inputTelepon;
				$kirimdata['alamat'] = $inputAlamat;
				$kirimdata['foto'] = $gambar;
				$kirimdata['code'] = $code;
				$kirimdata['aktif_state'] = "1";
				$success = $this->Dashboard_model->insert_admin($kirimdata);
				
	 			if($success){
	 				$this->session->set_flashdata('success', 'Data berhasil disimpan !!! Terimakasih ..');
	    		redirect('admin');
	 			}else{
	 				$this->session->set_flashdata('error', 'Data gagal disimpan !!! Terimakasih ..');
	    		redirect('admin');
	 			}
     	}else{
      	$set = '123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
				$code = substr(str_shuffle($set), 0, 15);
    		$inputNama = $this->input->post('inputNama');
    		$inputEmail = $this->input->post('inputEmail');
    		$inputUsername = $this->input->post('inputUsername', true);
    		$inputPassword = md5($this->input->post('inputPassword', true));
    		$inputTelepon = $this->input->post('inputTelepon');
    		$inputAlamat = $this->input->post('inputAlamat');
    		$inputCode = $code;
    		$level = $this->input->post('level');
				$kirimdata['id_role'] = $level;
    		$kirimdata['nama'] = $inputNama;
				$kirimdata['email'] = $inputEmail;
				$kirimdata['username'] = $inputUsername;
				$kirimdata['password'] = $inputPassword;
				$kirimdata['no_telp'] = $inputTelepon;
				$kirimdata['alamat'] = $inputAlamat;
				$kirimdata['foto'] = '';
				$kirimdata['code'] = $code;
				$kirimdata['aktif_state'] = "1";
				$success = $this->Dashboard_model->insert_admin($kirimdata);
				
	 			if($success){
	 				$this->session->set_flashdata('success', 'Data berhasil disimpan !!! Terimakasih ..');
	    		redirect('admin');
	 			}else{
	 				$this->session->set_flashdata('error', 'Data gagal disimpan !!! Terimakasih ..');
	    		redirect('admin');
	 			}
     	}
		}
	}

	function editadmin($id_reselleradmin){
		$data = array(
      'data_admin' => $this->Dashboard_model->get_all_adminBY($id_reselleradmin)->result_array(),
    );
    $this->tampilanViewHeader();
		$this->load->view('Administrator/edit_admin', $data);
		$this->tampilanViewFooter();
	}

	function updateadmin(){
		$this->form_validation->set_rules('inputNama','Input Nama Lengkap', 'required');
		$this->form_validation->set_rules('inputEmail','Input Email', 'required|valid_email');
		$this->form_validation->set_rules('inputUsername','Input Username', 'required|min_length[1]|max_length[25]');
		$this->form_validation->set_rules('inputTelepon','Input Telepon', 'required|max_length[15]');
		$this->form_validation->set_rules('level','Pilih Level', 'required');
		$admin_id = $this->input->post('admin_id');
 		
    if ($this->form_validation->run() == FALSE) { 
    	$this->session->set_flashdata('info', 'Coba cek lagi data input anda, kemungkinan terdapat kesalahan !!! Terimakasih ..');
  		redirect('editadmin/'.$admin_id);
		}else{
			$config['upload_path'] = './assets/images/gambar_user/'; //path folder
     	$config['allowed_types'] = 'jpg|png|jpeg|bmp'; //type yang dapat diakses bisa anda sesuaikan
     	$config['encrypt_name'] = FALSE; //Enkripsi nama yang terupload

	    $this->upload->initialize($config);
      if(!empty($_FILES['foto']['name'])){

	    	if ($this->upload->do_upload('foto')){
        	$gbr = $this->upload->data();
        	$file_gbr = str_replace(" ", "_", $gbr['file_name']);
          $config['image_library']='gd2';
          $config['source_image']='./assets/images/gambar_user/'.$file_gbr;
          $config['create_thumb']= FALSE;
          $config['maintain_ratio']= FALSE;
          $config['quality']= '50%';
          $config['width']= 200;
          $config['height']= 200;
          $config['new_image']= './assets/images/gambar_user/'.$file_gbr;
          $this->load->library('image_lib', $config);
          $this->image_lib->resize();
          $gambar = $file_gbr;
        }
                  
    		$inputNama = $this->input->post('inputNama');
    		$inputEmail = $this->input->post('inputEmail');
    		$inputUsername = $this->input->post('inputUsername', true);
    		$inputTelepon = $this->input->post('inputTelepon');
    		$inputAlamat = $this->input->post('inputAlamat');
    		$level = $this->input->post('level');
				$kirimdata['id_role'] = $level;
    		$kirimdata['nama'] = $inputNama;
				$kirimdata['email'] = $inputEmail;
				$kirimdata['username'] = $inputUsername;
				if(!empty($this->input->post('inputPassword'))){
    			$inputPassword = md5($this->input->post('inputPassword', true)); 
					$kirimdata['password'] = $inputPassword;
    		}
				$kirimdata['no_telp'] = $inputTelepon;
				$kirimdata['alamat'] = $inputAlamat;
				if($this->input->post('nilai') == 1){
					$kirimdata['foto'] = $gambar;
				}
				$kirimdata['aktif_state'] = "1";
				$success = $this->Dashboard_model->update_admin($kirimdata,$admin_id);
				
	 			if($success){
	 				$this->session->set_flashdata('success', 'Data berhasil diubah !!! Terimakasih ..');
	    		redirect('admin');
	 			}else{
	 				$this->session->set_flashdata('error', 'Data gagal diubah !!! Terimakasih ..');
	    		redirect('admin');
	 			}
     	}else{
    		$inputNama = $this->input->post('inputNama');
    		$inputEmail = $this->input->post('inputEmail');
    		$inputUsername = $this->input->post('inputUsername', true);
    		$inputTelepon = $this->input->post('inputTelepon');
    		$inputAlamat = $this->input->post('inputAlamat');
    		$level = $this->input->post('level');
				$kirimdata['id_role'] = $level;
    		$kirimdata['nama'] = $inputNama;
				$kirimdata['email'] = $inputEmail;
				$kirimdata['username'] = $inputUsername;
				if(!empty($this->input->post('inputPassword'))){
    			$inputPassword = md5($this->input->post('inputPassword', true)); 
					$kirimdata['password'] = $inputPassword;
    		}
				$kirimdata['no_telp'] = $inputTelepon;
				$kirimdata['alamat'] = $inputAlamat;
				if($this->input->post('nilai') == 1){
					$kirimdata['foto'] = '';
				}
				$kirimdata['aktif_state'] = "1";
				$success = $this->Dashboard_model->update_admin($kirimdata,$admin_id);
				
	 			if($success){
	 				$this->session->set_flashdata('success', 'Data berhasil diubah !!! Terimakasih ..');
	    		redirect('admin');
	 			}else{
	 				$this->session->set_flashdata('error', 'Data gagal diubah !!! Terimakasih ..');
	    		redirect('admin');
	 			}
     	}
		}
	}
	
	function detailadmin($id_reselleradmin){
		$data = array(
      'data_admin' => $this->Dashboard_model->get_all_adminBY($id_reselleradmin)->result_array(),
    );
		$this->load->view('Administrator/detail_admin', $data);
	}

	function updateActivedAdmin(){
		$kirimdata['aktif_state'] = $_GET['aktif_state'];
		$data = $this->Dashboard_model->update_admin($kirimdata,$_GET['id']);	
		echo json_encode($data);
	}
	
	function deleteadmin($id_reselleradmin){
    $success = $this->Dashboard_model->hapus_admin($id_reselleradmin);
    if($success){
			$this->session->set_flashdata('success', 'Data berhasil dihapus !!! Terimakasih ..');
			redirect('admin');
		}else{
			$this->session->set_flashdata('error', 'Data gagal dihapus !!! Terimakasih ..');
			redirect('admin');
		}
	}

	function compro(){
		$data = array(
      'data_kategori' => $this->Dashboard_model->get_all_kategori()->result_array(),
      'data_catalog' => $this->Dashboard_model->get_all_catalog()->result_array(),
    );
		$this->tampilanViewHeader();
		$this->load->view('Compro/v_compro', $data);
		$this->tampilanViewFooter();
	}

	function addcomprokategori(){
		$this->tampilanViewHeader();
		$this->load->view('Compro/add_compro_kategori');
		$this->tampilanViewFooter();
	}

	function savecomprokategori(){
		$this->form_validation->set_rules('inputKategori','Input Kategori', 'required');
		$this->form_validation->set_rules('jenis','Input Jenis Hewan', 'required');
 		
    if ($this->form_validation->run() == FALSE) { 
    	$this->session->set_flashdata('info', 'Coba cek lagi data input anda, kemungkinan terdapat kesalahan !!! Terimakasih ..');
  		redirect('compro');
		}else{
  		$inputKategori = $this->input->post('inputKategori');
  		$jenis = $this->input->post('jenis');
			$kirimdata['nama_kategori'] = $inputKategori;
			$kirimdata['jenis'] = $jenis;
			$kirimdata['aktif_state'] = "1";
			$success = $this->Dashboard_model->insert_kategori($kirimdata);
			
 			if($success){
 				$this->session->set_flashdata('success', 'Data berhasil disimpan !!! Terimakasih ..');
    		redirect('compro');
 			}else{
 				$this->session->set_flashdata('error', 'Data gagal disimpan !!! Terimakasih ..');
    		redirect('compro');
 			}
 		}
	}

	function editcomprokategori($id_kategori){
		$data = array(
      'data_kategori' => $this->Dashboard_model->get_all_kategoriBY($id_kategori)->result_array(),
    );
    $this->tampilanViewHeader();
		$this->load->view('Compro/edit_compro_kategori', $data);
		$this->tampilanViewFooter();
	}

	function updatecomprokategori(){
		$this->form_validation->set_rules('inputKategori','Input Kategori', 'required');
		$this->form_validation->set_rules('jenis','Input Jenis Hewan', 'required');
 		$kategori_id = $this->input->post('kategori_id');

    if ($this->form_validation->run() == FALSE) { 
    	$this->session->set_flashdata('info', 'Coba cek lagi data input anda, kemungkinan terdapat kesalahan !!! Terimakasih ..');
  		redirect('editcomprokategori/'.$kategori_id);
		}else{
  		$inputKategori = $this->input->post('inputKategori');
  		$jenis = $this->input->post('jenis');
			$kirimdata['nama_kategori'] = $inputKategori;
			$kirimdata['jenis'] = $jenis;
			$success = $this->Dashboard_model->update_kategori($kirimdata,$kategori_id);
			
 			if($success){
 				$this->session->set_flashdata('success', 'Data berhasil diubah !!! Terimakasih ..');
    		redirect('compro');
 			}else{
 				$this->session->set_flashdata('error', 'Data gagal diubah !!! Terimakasih ..');
    		redirect('compro');
 			}
 		}
	}

	function updateActivedKategori(){
		$kirimdata['aktif_state'] = $_GET['aktif_state'];
		$data = $this->Dashboard_model->update_kategori($kirimdata,$_GET['id']);	
		echo json_encode($data);
	}

	function deletecomprokategori($id_kategori){
    $success = $this->Dashboard_model->hapus_kategori($id_kategori);
    if($success){
			$this->session->set_flashdata('success', 'Data berhasil dihapus !!! Terimakasih ..');
			redirect('compro');
		}else{
			$this->session->set_flashdata('error', 'Data gagal dihapus !!! Terimakasih ..');
			redirect('compro');
		}
	}

	function addcomprocatalog(){
		$data = array(
      'data_kategori' => $this->Dashboard_model->get_all_kategoriWHERE()->result_array(),
    );
		$this->tampilanViewHeader();
		$this->load->view('Compro/add_compro_catalog', $data);
		$this->tampilanViewFooter();
	}

	function savecomprocatalog(){
		$this->form_validation->set_rules('selectKategori','Select kategori', 'required');
		$this->form_validation->set_rules('inputNoeartag','Input No Eartag', 'required');
		$this->form_validation->set_rules('inputBobot','Input Bobot Hewan', 'required');
		$this->form_validation->set_rules('inputUsia','Input Usia Hewan', 'required');
		$this->form_validation->set_rules('inputHarga','Input Harga', 'required');
 		
    if ($this->form_validation->run() == FALSE) { 
    	$this->session->set_flashdata('info', 'Coba cek lagi data input anda, kemungkinan terdapat kesalahan !!! Terimakasih ..');
  		redirect('compro');
		}else{
  		$selectKategori = $this->input->post('selectKategori');
  		$inputNoeartag = $this->input->post('inputNoeartag');
  		$inputBobot = $this->input->post('inputBobot');
  		$inputUsia = $this->input->post('inputUsia');
  		$inputHarga = $this->input->post('inputHarga');
			$kirimdata['id_kategori'] = $selectKategori;
			$kirimdata['no_eartag'] = $inputNoeartag;
			$kirimdata['bobot'] = $inputBobot;
			$kirimdata['usia'] = $inputUsia;
			$kirimdata['harga'] = $inputHarga;
			$kirimdata['status_sale'] = "0";
			$kirimdata['aktif_state'] = "1";
			$success = $this->Dashboard_model->insert_catalog($kirimdata);
			
 			if($success){
 				$this->session->set_flashdata('success', 'Data berhasil disimpan !!! Terimakasih ..');
    		redirect('compro');
 			}else{
 				$this->session->set_flashdata('error', 'Data gagal disimpan !!! Terimakasih ..');
    		redirect('compro');
 			}
 		}
	}

	function editcomprocatalog($id_catalog,$id_kategori){
		$data = array(
      'data_kategoriBY' => $this->Dashboard_model->get_all_kategoriBY($id_kategori)->result_array(),
      'data_kategori' => $this->Dashboard_model->get_all_kategoriWHERE()->result_array(),
      'data_catalog' => $this->Dashboard_model->get_all_catalogBY($id_catalog)->result_array(),
    );
    $this->tampilanViewHeader();
		$this->load->view('Compro/edit_compro_catalog', $data);
		$this->tampilanViewFooter();
	}

	function updatecomprocatalog(){
		$this->form_validation->set_rules('selectKategori','Select kategori', 'required');
		$this->form_validation->set_rules('inputNoeartag','Input No Eartag', 'required');
		$this->form_validation->set_rules('inputBobot','Input Bobot Hewan', 'required');
		$this->form_validation->set_rules('inputUsia','Input Usia Hewan', 'required');
		$this->form_validation->set_rules('inputHarga','Input Harga', 'required');
 		$catalog_id = $this->input->post('catalog_id');
 		$kategori_id = $this->input->post('kategori_id');
 		
    if ($this->form_validation->run() == FALSE) { 
    	$this->session->set_flashdata('info', 'Coba cek lagi data input anda, kemungkinan terdapat kesalahan !!! Terimakasih ..');
  		redirect('editcomprocatalog/'.$catalog_id."/".$kategori_id);
		}else{
  		$selectKategori = $this->input->post('selectKategori');
  		$inputNoeartag = $this->input->post('inputNoeartag');
  		$inputBobot = $this->input->post('inputBobot');
  		$inputUsia = $this->input->post('inputUsia');
  		$inputHarga = $this->input->post('inputHarga');
  		$status = $this->input->post('status');
			$kirimdata['id_kategori'] = $selectKategori;
			$kirimdata['no_eartag'] = $inputNoeartag;
			$kirimdata['bobot'] = $inputBobot;
			$kirimdata['usia'] = $inputUsia;
			$kirimdata['harga'] = $inputHarga;
			$kirimdata['status_sale'] = $status;
			if($status == 0){
				$kirimdata['aktif_state'] = "1";
			}elseif($status == 1 || $status == 2){
				$kirimdata['aktif_state'] = "0";
			}
			$success = $this->Dashboard_model->update_catalog($kirimdata,$catalog_id);
			
 			if($success){
 				$this->session->set_flashdata('success', 'Data berhasil diubah !!! Terimakasih ..');
    		redirect('compro');
 			}else{
 				$this->session->set_flashdata('error', 'Data gagal diubah !!! Terimakasih ..');
    		redirect('compro');
 			}
 		}
	}

	function updateActivedCatalog(){
		$kirimdata['aktif_state'] = $_GET['aktif_state'];
		$data = $this->Dashboard_model->update_catalog($kirimdata,$_GET['id']);	
		echo json_encode($data);
	}

	function deletecomprocatalog($id_catalog){
    $success = $this->Dashboard_model->hapus_catalog($id_catalog);
    if($success){
			$this->session->set_flashdata('success', 'Data berhasil dihapus !!! Terimakasih ..');
			redirect('compro');
		}else{
			$this->session->set_flashdata('error', 'Data gagal dihapus !!! Terimakasih ..');
			redirect('compro');
		}
	}

	function keranjang(){
		if($this->session->userdata('ses_level') != 3){
			$data = array(
	      'data_keranjang' => $this->Dashboard_model->get_all_keranjangbulan(),
	    );
		}else{
			$data = array(
	      'data_keranjang' => $this->Dashboard_model->get_all_keranjangbulanBY($this->session->userdata('ses_idadmin')),
	    );
		}
		$this->tampilanViewHeader();
		$this->load->view('Keranjang/v_keranjang', $data);
		$this->tampilanViewFooter();
	}

	function viewkeranjang(){
		if($this->session->userdata('ses_level') != 3){
			$data = array(
	      'data_keranjang' => $this->Dashboard_model->get_all_keranjangbulan(),
	    );
		}else{
			$data = array(
	      'data_keranjang' => $this->Dashboard_model->get_all_keranjangbulanBY($this->session->userdata('ses_idadmin')),
	    );
		}
		// $this->tampilanViewHeader();
		$this->load->view('Keranjang/view_keranjang', $data);
		// $this->tampilanViewFooter();
	}

	function lookkeranjangReseller(){
		if($this->session->userdata('ses_level') != 3){
			$data_keranjang = $this->Dashboard_model->get_all_keranjangbulan();
		}else{
			$data_keranjang = $this->Dashboard_model->get_all_keranjangbulan($this->session->userdata('ses_idadmin'));
		}
		$total_seluruh = 0; 
		foreach ($data_keranjang->result_array() as $value) {
			$total_jml = 0;
			$jmlCatalogKeranjang = $this->Dashboard_model->get_total_keranjangBY($value['id_catalog']); 
    		foreach ($jmlCatalogKeranjang->result_array() as $value1) {
    			$total_jml += $value1['jml'];
    		}
    		$data[]=array(
    			'totalreseller' => $total_jml,
    		);
		}
    	echo json_encode($data);
	}

	function addkeranjang($id_catalog,$id_reselleradmin){
    $DataKeranjang=$this->db->query("SELECT * FROM tbl_keranjang WHERE id_catalog='$id_catalog' && id_reselleradmin='$id_reselleradmin'");
		if($DataKeranjang->num_rows() > 0){ 
			$this->session->set_flashdata('info', 'Data sudah berada di keranjang !!! Terimakasih ..');
			redirect('compro');
		}else{
			date_default_timezone_set("Asia/Jakarta");
			$tgl = date("Y-m-d H:i:s");
			$kirimdata['id_catalog'] = $id_catalog;
			$kirimdata['id_reselleradmin'] = $id_reselleradmin;
			$kirimdata['update_date'] = $tgl;
			$kirimdata2['status_sale'] = "1";
			$kirimdata2['aktif_state'] = "0";
			$this->Dashboard_model->update_catalog($kirimdata2,$id_catalog);
			$success = $this->Dashboard_model->insert_keranjang($kirimdata);
			if($success){
				$this->session->set_flashdata('success', 'Data berhasil masuk keranjang !!! Terimakasih ..');
				redirect('keranjang');
			}else{
				$this->session->set_flashdata('error', 'Data gagal masuk keranjang !!! Terimakasih ..');
				redirect('keranjang');
			}
		}
	}

	function paidkeranjang($id_reselleradmin,$id_catalog){
		date_default_timezone_set("Asia/Jakarta");
		$tgl = date("Y-m-d H:i:s");
		$kirimdata['id_catalog'] = $id_catalog;
		$kirimdata['id_reselleradmin'] = $id_reselleradmin;
		$kirimdata['update_date'] = $tgl;
		$kirimdata2['status_sale'] = "2";
		$kirimdata2['aktif_state'] = "0";
		$this->Dashboard_model->update_catalog($kirimdata2,$id_catalog);
		$success = $this->Dashboard_model->insert_customer($kirimdata);
		if($success){
			$customer = $this->Dashboard_model->get_all_customerBY4($id_reselleradmin,$id_catalog)->result_array(); 
			$kirimdata3['update_upload'] = $tgl;
			$kirimdata3['id_customer'] = $customer[0]['id_customer'];
			$this->Dashboard_model->insert_bukti($kirimdata3);
			$this->session->set_flashdata('success', 'Data berhasil masuk keranjang !!! Terimakasih ..');
			redirect('customer/0');
		}else{
			$this->session->set_flashdata('error', 'Data gagal masuk keranjang !!! Terimakasih ..');
			redirect('customer/0');
		}
	}

	function deletekeranjang($id_reselleradmin,$id_catalog){
		$total_jml = 0;
		$jmlCatalogKeranjang = $this->Dashboard_model->get_total_keranjangBY($id_catalog); 
		foreach ($jmlCatalogKeranjang->result_array() as $value1) {
			$total_jml += $value1['jml'];
		}
		if($total_jml == 1){
			$kirimdata2['status_sale'] = "0";
			$kirimdata2['aktif_state'] = "1";
			$this->Dashboard_model->update_catalog($kirimdata2,$id_catalog);
    	$success = $this->Dashboard_model->hapus_keranjang($id_reselleradmin,$id_catalog);
		}else{
    	$success = $this->Dashboard_model->hapus_keranjang($id_reselleradmin,$id_catalog);
		}
    	if($success){
			$this->session->set_flashdata('success', 'Data keranjang berhasil dihapus !!! Terimakasih ..');
			redirect('compro');
		}else{
			$this->session->set_flashdata('error', 'Data keranjang gagal dihapus !!! Terimakasih ..');
			redirect('compro');
		}
	}

	function deleteallkeranjang($id_reselleradmin){
		$CatalogKeranjang = $this->Dashboard_model->get_all_keranjangBY2($id_reselleradmin); 
		foreach ($CatalogKeranjang->result_array() as $value) {
			$id_catalog = $value['id_catalog'];
			$total_jml = 0;
			$jmlCatalogKeranjang = $this->Dashboard_model->get_total_keranjangBY($id_catalog); 
			foreach ($jmlCatalogKeranjang->result_array() as $value1) {
				$total_jml += $value1['jml'];
			}
			if($total_jml == 1){
				$kirimdata2['status_sale'] = "0";
				$kirimdata2['aktif_state'] = "1";
				$this->Dashboard_model->update_catalog($kirimdata2,$id_catalog);
	    	$success = $this->Dashboard_model->hapus_keranjang($id_reselleradmin,$id_catalog);
			}else{
	    	$success = $this->Dashboard_model->hapus_keranjang($id_reselleradmin,$id_catalog);
			}
		}
	    if($success){
			$this->session->set_flashdata('success', 'Seluruh data keranjang berhasil dihapus !!! Terimakasih ..');
			redirect('compro');
		}else{
			$this->session->set_flashdata('error', 'Seluruh data keranjang gagal dihapus !!! Terimakasih ..');
			redirect('compro');
		}
	}

	function PemilihanCheckoutKeranjang(){
		$kirimdata['pilihan'] = $_GET['pilihan'];
		$kirimdata['id_catalog'] = $_GET['id_catalog'];
		$kirimdata['id_reselleradmin'] = $_GET['id_reselleradmin'];
		$kirimdata['id_keranjang'] = $_GET['id_keranjang'];
		if($_GET['pilihan'] == 1){
			$data = $this->Dashboard_model->insert_pilihankeranjang($kirimdata);	
		}elseif($_GET['pilihan'] == 0){
			$data = $this->Dashboard_model->hapus_pilihankeranjang($_GET['id_keranjang']);	
		}
		echo json_encode($data);
	}

	function checkoutallkeranjang(){
		$pilihan = $this->input->post('pilihkeranjang');
		$jumlahpilihan = count($pilihan);
		for($i=0;$i<$jumlahpilihan;$i++){
			$pembagi = explode(" " , $pilihan[$i]);
			$id_catalog = $pembagi[0];
			$id_keranjang = $pembagi[1];
			$id_reselleradmin = $this->session->userdata('ses_idadmin');

			date_default_timezone_set("Asia/Jakarta");
			$tgl = date("Y-m-d H:i:s");
			$kirimdata['id_catalog'] = $id_catalog;
			$kirimdata['id_reselleradmin'] = $id_reselleradmin;
			$kirimdata['update_date'] = $tgl;
			$kirimdata2['status_sale'] = "2";
			$kirimdata2['aktif_state'] = "0";
			$this->Dashboard_model->update_catalog($kirimdata2,$id_catalog);
			$this->Dashboard_model->insert_customer($kirimdata);	
			$customer = $this->Dashboard_model->get_all_customerBY4($id_reselleradmin,$id_catalog)->result_array(); 
			$kirimdata3['update_upload'] = $tgl;
			$kirimdata3['id_customer'] = $customer[0]['id_customer'];
			$this->Dashboard_model->insert_bukti($kirimdata3);
			$success = $this->Dashboard_model->hapus_pilihankeranjang($id_keranjang);
		}
		if($success){
			$this->session->set_flashdata('success', 'Data berhasil di CheckOut, Silahkan isi data customer !!! Terimakasih ..');
			redirect('editcustomerbanyak/'.$id_reselleradmin);
		}else{
			$this->session->set_flashdata('error', 'Data gagal di CheckOut !!! Terimakasih ..');
			redirect('customer/0');
		}
	}

	function customer($id_notifikasi = 0){
		if($this->session->userdata('ses_level') != 3){
			if($id_notifikasi != 0){
				$data = array(
		      'data_customer' => $this->Dashboard_model->get_all_customerBYNotif($id_notifikasi),
		    );
		  }else{
		    $data = array(
		      'data_customer' => $this->Dashboard_model->get_all_customer(),
		    );
		  }
		}else{
			$data = array(
	      'data_customer' => $this->Dashboard_model->get_all_customerBY($this->session->userdata('ses_idadmin')),
	    );
		}
		$this->tampilanViewHeader();
		$this->load->view('Customer/v_customer', $data);
		$this->tampilanViewFooter();
	}

	function viewcustomer($id_notifikasi = 0){
		if($this->session->userdata('ses_level') != 3){
			if($id_notifikasi != 0){
				$data = array(
		      'data_customer' => $this->Dashboard_model->get_all_customerBYNotif($id_notifikasi),
		    );
		  }else{
		    $data = array(
		      'data_customer' => $this->Dashboard_model->get_all_customer(),
		    );
		  }
		}else{
			$data = array(
	      'data_customer' => $this->Dashboard_model->get_all_customerBY($this->session->userdata('ses_idadmin')),
	    );
		}
		// $this->tampilanViewHeader();
		$this->load->view('Customer/view_customer', $data);
		// $this->tampilanViewFooter();
	}

	function editcustomer($id_customer){
		$data = array(
      'data_customer' => $this->Dashboard_model->get_all_customerBY3($id_customer)->result_array(),
    );
    $this->tampilanViewHeader();
		$this->load->view('Customer/edit_customer', $data);
		$this->tampilanViewFooter();
	}

	function updatecustomer(){
		$this->form_validation->set_rules('inputNama','input Nama Customer', 'required');
		$this->form_validation->set_rules('inputAlamat','Input Alamat Customer', 'required');
		$this->form_validation->set_rules('inputNotelp','Input Np Telp Customer', 'required');
 		$catalog_id = $this->input->post('catalog_id');
 		
    if ($this->form_validation->run() == FALSE) { 
    	$this->session->set_flashdata('info', 'Coba cek lagi data input anda, kemungkinan terdapat kesalahan !!! Terimakasih ..');
  		redirect('editcustomer/'.$catalog_id);
		}else{
  		$inputNama = $this->input->post('inputNama');
  		$inputAlamat = $this->input->post('inputAlamat');
  		$inputNotelp = $this->input->post('inputNotelp');
  		$inputJml = preg_replace("/[^0-9]/", "", $this->input->post('inputJml'));
  		$selectTypebayar = $this->input->post('selectTypebayar');
  		$inputTglpengiriman = $this->input->post('inputTglpengiriman');
			$kirimdata['nama_customer'] = $inputNama;
			$kirimdata['alamat_customer'] = $inputAlamat;
			$kirimdata['no_telp_customer'] = $inputNotelp;
			$kirimdata['type_bayar'] = $selectTypebayar;
			$kirimdata['jml'] = $inputJml;
			$kirimdata['tanggal_pengiriman'] = $inputTglpengiriman;
			$kirimdata['status'] = "1";
			$success = $this->Dashboard_model->update_customer($kirimdata,$catalog_id);
			
 			if($success){
 				$this->session->set_flashdata('success', 'Data berhasil diubah !!! Terimakasih ..');
    		redirect('customer/0');
 			}else{
 				$this->session->set_flashdata('error', 'Data gagal diubah !!! Terimakasih ..');
    		redirect('customer/0');
 			}
 		}
	}

	function deletecustomer($id_customer,$id_catalog){
		$kirimdata2['status_sale'] = "1";
		$kirimdata2['aktif_state'] = "0";
		$bukti_upload = $this->Dashboard_model->get_all_buktiupload($id_customer)->result_array();
		unlink("assets/images/gambar_bukti/".$bukti_upload[0]['bukti']);
		$this->Dashboard_model->update_catalog($kirimdata2,$id_catalog);
    $this->Dashboard_model->hapus_bukti($id_customer);
    $success = $this->Dashboard_model->hapus_customer($id_customer);
    if($success){
			$this->session->set_flashdata('success', 'Data berhasil dihapus !!! Terimakasih ..');
			redirect('customer/0');
		}else{
			$this->session->set_flashdata('error', 'Data gagal dihapus !!! Terimakasih ..');
			redirect('customer/0');
		}
	}

	function editcustomerbanyak($id_reselleradmin){
		$data = array(
      'data_customer' => $this->Dashboard_model->get_all_customerBYBanyak($id_reselleradmin),
    );
    $this->tampilanViewHeader();
		$this->load->view('Customer/edit_customer_banyak', $data);
		$this->tampilanViewFooter();
	}

	function updatecustomerbanyak(){
		$totalcustomer = $this->input->post('catalog_id');
		$banyaknya = count($totalcustomer);
		for($i=0;$i<$banyaknya;$i++){
			$catalog_id = $this->input->post('catalog_id')[$i];
			$inputJml = preg_replace("/[^0-9]/", "", $this->input->post('inputJml')[$i]);
			$selectTypebayar = $this->input->post('selectTypebayar')[$i];
			$pembagi = explode(" " , $selectTypebayar);
			$tipebayar = $pembagi[0];
			$inputTglpengiriman = $this->input->post('inputTglpengiriman')[$i];
			$inputNama = $this->input->post('inputNama')[0];
			$inputAlamat = $this->input->post('inputAlamat')[0];
			$inputNotelp = $this->input->post('inputNotelp')[0];
			$kirimdata['nama_customer'] = $inputNama;
			$kirimdata['alamat_customer'] = $inputAlamat;
			$kirimdata['no_telp_customer'] = $inputNotelp;
			$kirimdata['type_bayar'] = $tipebayar;
			$kirimdata['jml'] = $inputJml;
			$kirimdata['tanggal_pengiriman'] = $inputTglpengiriman;
			$kirimdata['status'] = "1";
			$success = $this->Dashboard_model->update_customer($kirimdata,$catalog_id);	
		}
 			if($success){
 				$this->session->set_flashdata('success', 'Data berhasil diubah !!! Terimakasih ..');
    		redirect('customer/0');
 			}else{
 				$this->session->set_flashdata('error', 'Data gagal diubah !!! Terimakasih ..');
    		redirect('customer/0');
 			}
	}

	function uploadbukti($id_customer){
		$data = array(
      'data_customer' => $this->Dashboard_model->get_all_customerBYupload($id_customer)->result_array(),
    );
    $this->tampilanViewHeader();
		$this->load->view('Customer/upload_bukti', $data);
		$this->tampilanViewFooter();
	}

	function updateuploadbukti(){
		date_default_timezone_set("Asia/Jakarta");
		$tgl = date("Y-m-d H:i:s");                
		$upload_tgl = date("Y-m-d_His");                
 		$upload_id = $this->input->post('upload_id');
 		$catalog_id = $this->input->post('catalog_id');
		$data_catalog = $this->Dashboard_model->get_all_customerBYCatalog($catalog_id)->result_array();	
		if($data_catalog[0]['type_bayar'] == 1){
    	$namanya = $this->input->post('inputKode')."_DP1_".$upload_tgl;
		}elseif($data_catalog[0]['type_bayar'] == 2){			
    	$namanya = $this->input->post('inputKode')."_LUNAS_".$upload_tgl;
    }
		$config['upload_path'] = './assets/images/gambar_bukti/'; //path folder
   	$config['allowed_types'] = 'jpg|png|jpeg'; //type yang dapat diakses bisa anda sesuaikan
   	$config['encrypt_name'] = FALSE; //Enkripsi nama yang terupload
   	$config['file_name'] = $namanya; //Enkripsi nama yang terupload

    $this->upload->initialize($config);
    if(!empty($_FILES['bukti']['name'])){

    	if ($this->upload->do_upload('bukti')){
      	$gbr = $this->upload->data();
      	$file_gbr = str_replace(" ", "_", $gbr['file_name']);
        $config['image_library']='gd2';
        $config['source_image']='./assets/images/gambar_bukti/'.$file_gbr;
        $config['create_thumb']= FALSE;
        $config['maintain_ratio']= FALSE;
        $config['quality']= '50%';
        $config['width']= 500;
        $config['height']= 500;
        $config['new_image']= './assets/images/gambar_bukti/'.$file_gbr;
        $this->load->library('image_lib', $config);
        $this->image_lib->resize();
        $gambar = $file_gbr;
      }
			$kirimdata2['dari'] = $this->session->userdata('ses_idadmin');
			$kirimdata2['ke'] = "1";
			if($data_catalog[0]['type_bayar'] == 1){
				$kirimdata2['tujuan'] = "pengiriman bukti DP 1";
			}elseif($data_catalog[0]['type_bayar'] == 2){			
				$kirimdata2['tujuan'] = "pengiriman bukti LUNAS";
			}
			$kirimdata2['id_catalog'] = $catalog_id;
			$kirimdata2['updatetgl_pesan'] = $tgl;
			$kirimdata2['status_pesan'] = "0";
			$this->Dashboard_model->insert_notif($kirimdata2);

			$kirimdata3['status_sale'] = "3";
			$kirimdata3['aktif_state'] = "0";
			$this->Dashboard_model->update_catalog($kirimdata3,$catalog_id);

			$kirimdata['bukti'] = $gambar;
			$kirimdata['update_upload'] = $tgl;
			$kirimdata['status_upload'] = "1";
			$success = $this->Dashboard_model->update_bukti($kirimdata,$upload_id);
			
 			if($success){
 				$this->session->set_flashdata('success', 'Data berhasil disimpan !!! Terimakasih ..');
    		redirect('customer/0');
 			}else{
 				$this->session->set_flashdata('error', 'Data gagal disimpan !!! Terimakasih ..');
    		redirect('customer/0');
 			}
   	}
	}

	function updateuploadbuktipelunasan(){
		date_default_timezone_set("Asia/Jakarta");
		$tgl = date("Y-m-d H:i:s");                
		$upload_tgl = date("Y-m-d_His");                
 		$upload_id = $this->input->post('upload_id');
 		$catalog_id = $this->input->post('catalog_id');
 		$customer_id = $this->input->post('customer_id');
 		$harga = $this->input->post('harga');
    $namanya = $this->input->post('inputKode')."_DP2_LUNAS_".$upload_tgl;
		$config['upload_path'] = './assets/images/gambar_bukti/'; //path folder
   	$config['allowed_types'] = 'jpg|png|jpeg'; //type yang dapat diakses bisa anda sesuaikan
   	$config['encrypt_name'] = FALSE; //Enkripsi nama yang terupload
   	$config['file_name'] = $namanya; //Enkripsi nama yang terupload

    $this->upload->initialize($config);
    if(!empty($_FILES['bukti']['name'])){

    	if ($this->upload->do_upload('bukti')){
      	$gbr = $this->upload->data();
      	$file_gbr = str_replace(" ", "_", $gbr['file_name']);
        $config['image_library']='gd2';
        $config['source_image']='./assets/images/gambar_bukti/'.$file_gbr;
        $config['create_thumb']= FALSE;
        $config['maintain_ratio']= FALSE;
        $config['quality']= '50%';
        $config['width']= 500;
        $config['height']= 500;
        $config['new_image']= './assets/images/gambar_bukti/'.$file_gbr;
        $this->load->library('image_lib', $config);
        $this->image_lib->resize();
        $gambar = $file_gbr;
      }
			$kirimdata2['dari'] = $this->session->userdata('ses_idadmin');
			$kirimdata2['ke'] = "1";
			$kirimdata2['tujuan'] = "pengiriman bukti DP 2 LUNAS";
			$kirimdata2['id_catalog'] = $catalog_id;
			$kirimdata2['updatetgl_pesan'] = $tgl;
			$kirimdata2['status_pesan'] = "0";
			$this->Dashboard_model->insert_notif($kirimdata2);

			$kirimdata3['status_sale'] = "3";
			$kirimdata3['aktif_state'] = "0";
			$this->Dashboard_model->update_catalog($kirimdata3,$catalog_id);

			$kirimdata4['type_bayar'] = "2";
			$kirimdata4['jml'] = $harga;
			$this->Dashboard_model->update_customer($kirimdata4,$catalog_id);

			$kirimdata['id_customer'] = $customer_id;
			$kirimdata['bukti'] = $gambar;
			$kirimdata['update_upload'] = $tgl;
			$kirimdata['status_upload'] = "1";
			$success = $this->Dashboard_model->insert_bukti($kirimdata);
			
 			if($success){
 				$this->session->set_flashdata('success', 'Data berhasil disimpan !!! Terimakasih ..');
    		redirect('customer/0');
 			}else{
 				$this->session->set_flashdata('error', 'Data gagal disimpan !!! Terimakasih ..');
    		redirect('customer/0');
 			}
   	}
	}

	function downloadbukti($gbr){
		force_download('assets/images/gambar_bukti/'.$gbr,NULL);
	}

	function lihatnotif($id_notifikasi){
		$kirimdata['status_pesan'] = "1";
		$this->Dashboard_model->update_notif($kirimdata,$id_notifikasi);
   	redirect('customer/'.$id_notifikasi);
	}

	function pelunasan($id_notifikasi){
		$kirimdata['status_pesan'] = "1";
		$this->Dashboard_model->update_notif($kirimdata,$id_notifikasi);
    $data_customer = $this->Dashboard_model->get_all_customerBYNotif($id_notifikasi)->result_array();
   	redirect('uploadbuktiDPLUNAS/'.$data_customer[0]['id_customer']);
	}

	function uploadbuktiDPLUNAS($id_customer){
		$data = array(
      'data_customer' => $this->Dashboard_model->get_all_customerBYupload($id_customer)->result_array(),
    );
    $this->tampilanViewHeader();
		$this->load->view('Customer/upload_bukti_pelunasan_DP', $data);
		$this->tampilanViewFooter();
	}

	function approvepembelian($id_customer){
		$data_customer = $this->Dashboard_model->get_all_customerBY3($id_customer)->result_array();	
		date_default_timezone_set("Asia/Jakarta");
		$tgl = date("Y-m-d H:i:s");
		$kirimdata['dari'] = $this->session->userdata('ses_idadmin');
		$kirimdata['ke'] = $data_customer[0]['id_reselleradmin'];
		if($data_customer[0]['type_bayar'] == 1){
			$kirimdata['tujuan'] = "silahkan melakukan pelunasan";
		}elseif($data_customer[0]['type_bayar'] == 2){
			$kirimdata['tujuan'] = "pengiriman hewan qurban";
		}
		$kirimdata['id_catalog'] = $data_customer[0]['id_catalog'];
		$kirimdata['updatetgl_pesan'] = $tgl;
		$kirimdata['status_pesan'] = "0";
		$this->Dashboard_model->insert_notif($kirimdata);

		if($data_customer[0]['type_bayar'] == 2){
			$kirimdata2['status_sale'] = "4";
			$kirimdata2['aktif_state'] = "0";
			$this->Dashboard_model->update_catalog($kirimdata2,$data_customer[0]['id_catalog']);	
		}
		redirect('keranjang');
	}

	function getnotifAdmin(){
		$output = '';
		date_default_timezone_set('Asia/Jakarta');	
		$notif = $this->Dashboard_model->get_notifAdmin($this->session->userdata('ses_idadmin'));	
		$total = $notif->num_rows();
		if($total > 0){
			foreach ($notif->result_array() as $value) {
				if($value['type_bayar'] == 1){$type = "DP";}else{$type = "LUNAS";}
				$pesan = "<b>".$value['nama']."</b> telah upload bukti pembayaran <b>".$type."</b> atas nama customer <b>".$value['nama_customer']."</b> untuk pembelian hewan qurban jenis <b>".$value['nama_kategori']."</b> dengan eartag <b>".$value['no_eartag']."</b>";
				$output .='
				<li align="justify">
					<a href="'.base_url('lihatnotif/').$value['id_notifikasi'].'">
	          <span>
	          	<span><b>'.$value['nama'].'</b></span>
	            <span class="time">'.$value['updatetgl_pesan'].'</span>
						</span>
						<span class="message">'
							.$pesan.
						'</span>
	        </a>
				</li>';
			}
		}else{
			$output .='<li align="center"><b>Tidak Ada Notifikasi</b></li>';
		}
		$data = array(
			"pesan" => $output,
			"total" => $total,
		);
		echo json_encode($data);
	}

	function getnotifReseller(){
		$output = '';
		date_default_timezone_set('Asia/Jakarta');	
		$notif = $this->Dashboard_model->get_notifReseller($this->session->userdata('ses_idadmin'));	
		$total = $notif->num_rows();
		if($total > 0){
			foreach ($notif->result_array() as $value) {
				$tanggal_kirim = date('Y-m-d', strtotime($value['tanggal_pengiriman']));
				$awal  = date_create($tanggal_kirim);
				$akhir = date_create(); // waktu sekarang
				$diff  = date_diff($awal,$akhir);
				if($diff->days <= 7){$batas = "<br><b>Batas PELUNASAN anda : ".$diff->days." hari lagi !!!</b>";}else{$batas="";}
				if($value['type_bayar'] == 1){ 
					if($value['tujuan'] == "refundDP"){ 
						$pesan = "<b>Admin</b> meminta maaf kepada <b>".$value['nama']."</b> karena pembelian hewan qurban atas nama customer <b>".$value['nama_customer']."</b> jenis <b>".$value['nama_kategori']."</b> dengan eartag <b>".$value['no_eartag']."</b> dibatalkan atau tidak di proses, Pengembalian uang DP akan segara kami urus. Silahkan hubungi Admin. Terimakasih !!!";
						$link = '';
					}else{
						$pesan = "<b>Admin</b> telah menyetujui pembelian hewan qurban atas nama customer <b>".$value['nama_customer']."</b> jenis <b>".$value['nama_kategori']."</b> dengan eartag <b>".$value['no_eartag']."</b>, Silahkan melakukan <b>PELUNASAN</b>. Waktu anda hanya di berikan seminggu sebelum tanggal pengiriman yaitu <b>".date("D, d M Y", strtotime($value['tanggal_pengiriman']))."</b>. ".$batas;
						$link = ' href="'.base_url('pelunasan/').$value['id_notifikasi'].'"';
					}
				}elseif($value['type_bayar'] == 2){
					if($value['tujuan'] == "refund"){ 
						$pesan = "<b>Admin</b> meminta maaf kepada <b>".$value['nama']."</b> karena pembelian hewan qurban atas nama customer <b>".$value['nama_customer']."</b> jenis <b>".$value['nama_kategori']."</b> dengan eartag <b>".$value['no_eartag']."</b> dibatalkan atau tidak di proses, Pengembalian uang akan segara kami urus. Silahkan hubungi Admin. Terimakasih !!!";
						$link = '';
					}else{
						$pesan = "<b>Admin</b> telah menyetujui pembelian hewan qurban atas nama customer <b>".$value['nama_customer']."</b> jenis <b>".$value['nama_kategori']."</b> dengan eartag <b>".$value['no_eartag']."</b>, Hewan qurban akan dikirimkan pada tanggal <b>".date("D, d M Y", strtotime($value['tanggal_pengiriman']))."</b>";
						$link = '';
					}
				}
				$output .='
				<li align="justify">
					<a'.$link.'>
	          <span>
	          	<span><b>Admin</b></span>
	            <span class="time">'.$value['updatetgl_pesan'].'</span>
						</span>
						<span class="message">'
							.$pesan.
						'</span>
	        </a>
				</li>';
			}
		}else{
			$output .='<li align="center"><b>Tidak Ada Notifikasi</b></li>';
		}
		$data = array(
			"pesan" => $output,
			"total" => $total,
		);
		echo json_encode($data);
	}

	function getjmlKeranjang(){
		$jml_keranjang = $this->Dashboard_model->get_all_keranjangbulanBY($this->session->userdata('ses_idadmin'))->num_rows();
		$data = array(
			"total" => $jml_keranjang,
		);
		echo json_encode($data);
	}

	function getjmlCustomer(){
    $jml_customer = $this->Dashboard_model->get_all_customerBY2($this->session->userdata('ses_idadmin'))->num_rows();
		$data = array(
			"total" => $jml_customer,
		);
		echo json_encode($data);
	}

	function historykeranjang(){
		if($this->session->userdata('ses_level') != 3){
			$data = array(
	      'data_keranjang' => $this->Dashboard_model->get_all_keranjang(),
	    );
		}else{
			$data = array(
	      'data_keranjang' => $this->Dashboard_model->get_all_keranjangBY($this->session->userdata('ses_idadmin')),
	    );
		}
		$this->tampilanViewHeader();
		$this->load->view('Keranjang/history_keranjang', $data);
		$this->tampilanViewFooter();
	}

	function Fetchhistorykeranjang(){
		$output = '';
		$dari = '';
		$ke = '';
		if($this->input->post('dari') && $this->input->post('ke'))
	  {
	   $dari = date("Y-m-d",strtotime($this->input->post('dari')));
	   $ke = date("Y-m-d",strtotime($this->input->post('ke')));
	  }
		if($this->session->userdata('ses_level') != 3){
	      $data_keranjang = $this->Dashboard_model->get_all_keranjangFilter($dari,$ke);
		}else{
	      $data_keranjang = $this->Dashboard_model->get_all_keranjangFilterBY($dari,$ke,$this->session->userdata('ses_idadmin'));
		}

		$output .= 
			'<table class="table table-striped table-bordered" cellspacing="0" width="100%">
        <thead>
          <tr align="center" style="font-weight: bold;">
            <td width="10%">Tanggal Pemesanan</td>
            <td width="15%">Nama</td>
            <td width="15%">Kategori</td>
            <td width="10%">No Eartag</td>
            <td width="15%" align="right">Sub Total</td>
          </tr>
        </thead>';
      if($data_keranjang->num_rows() > 0){
          $total_seluruh = 0; 
          foreach ($data_keranjang->result_array() as $value) {
				    $output .='
				          <tr align="center">
				            <td style="vertical-align: middle;">'.date("d M Y",strtotime($value["update_date"])).'</td>
				            <td style="vertical-align: middle;">'.$value['nama'].'</td>
				            <td style="vertical-align: middle;">'.$value['nama_kategori'].'</td>
				            <td style="vertical-align: middle;">'.$value['no_eartag'].' <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="Bobot ('.$value['bobot'].'Kg), Harga ('.$value['harga'].')"></i></td>
				            <td style="vertical-align: middle;" align="right">';
				            $total = $value['harga'] * $value['bobot'];
				    $output .='Rp. '.number_format($total,2).'</td></tr>';
					$total_seluruh += $total; }
				    $output .='
				        <tr align="center">
				          <td style="vertical-align: middle;" colspan="4" align="right"><b>Total Keseluruhan</b></td>
				          <td style="vertical-align: middle;" width="15%" align="right"><b>Rp. ';
				    $output .=number_format($total_seluruh,2).'</b></td></tr>';
    	}else{
    		$output .= 
    			'<tr align="center">
          	<td style="vertical-align: middle;" colspan="5" align="center"><b>Data yang di cari tidak di temukan .. Terima Kasih ..</b></td></tr>';
    		$output .=
    			'</table>'; 

      }
		echo $output;
	}

	function historycustomer(){
		if($this->session->userdata('ses_level') != 3){
	    $data = array(
	      'data_customer' => $this->Dashboard_model->get_all_customer(),
	    );
		}else{
			$data = array(
	      'data_customer' => $this->Dashboard_model->get_all_customerBY($this->session->userdata('ses_idadmin')),
	    );
		}
		$this->tampilanViewHeader();
		$this->load->view('Customer/history_customer', $data);
		$this->tampilanViewFooter();
	}

	function Fetchhistorycustomer(){
		if($this->session->userdata('ses_level') != 3){
	    $data = array(
	      'data_customer' => $this->Dashboard_model->get_all_customer(),
	    );
		}else{
			$data = array(
	      'data_customer' => $this->Dashboard_model->get_all_customerBY($this->session->userdata('ses_idadmin')),
	    );
		}
		$this->tampilanViewHeader();
		$this->load->view('Customer/history_customer', $data);
		$this->tampilanViewFooter();
	}

}
?>