<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_dashboard extends CI_Controller {

	function __construct()
    {
		parent::__construct();
		$this->load->model('Login_model');
	}

	public function index()
	{
		$this->load->view('login');
	}

	public function auth(){
        $inputEmail=htmlspecialchars($this->input->post('inputEmail',TRUE),ENT_QUOTES);
        $inputPassword=htmlspecialchars($this->input->post('inputPassword',TRUE),ENT_QUOTES);
        $cekauth=$this->Login_model->auth($inputEmail,$inputPassword);
        if($cekauth->num_rows() > 0){
        	$data=$cekauth->row_array();
        	$this->session->set_userdata('masuk',TRUE);
            $this->session->set_userdata('ses_idadmin',$data['id_reselleradmin']);
        	$this->session->set_userdata('ses_nama',$data['nama']);
            $this->session->set_userdata('ses_email',$data['email']);
            $this->session->set_userdata('ses_foto',$data['foto']);
            $this->session->set_userdata('ses_level',$data['id_role']);
            $level = $this->session->userdata('ses_level'); if($level == 1){$sbg="Super Admin";}elseif($level == 2){$sbg="Administrator";}
            echo $this->session->set_flashdata('success','Selamat Datang <b>'.$data['nama'].'</b> di Panel Dashboard <b>'.$sbg.'</b>');
			redirect('dashboard');
            // echo '<script language="javascript">alert("Selamat Datang '.$data['nama'].' di Panel Dashboard '.$sbg.'"); document.location="dashboard";</script>';
        }else{
			echo $this->session->set_flashdata('error','Tidak bisa masuk Panel Dashboard, mungkin ada kesalahan saat menginput data !!! Username Atau Password Salah !!');
			redirect('login');
			// echo '<script language="javascript">alert("Tidak bisa masuk Panel Dashboard, mungkin ada kesalahan saat menginput data !!!"); document.location="login";</script>';
        }
    }

    public function logout(){
        // $this->session->sess_destroy();
        $level = $this->session->userdata('ses_level'); if($level == 1){$sbg="Super Admin";}elseif($level == 2){$sbg="Administrator";}
        echo $this->session->set_flashdata('info','Selamat Tinggal, Anda sudah keluar dari Panel Dashboard '.$sbg.' !!!');
		redirect('login');
        // echo '<script language="javascript">alert("Selamat Tinggal, Anda sudah keluar dari Panel Dashboard '.$sbg.' !!!"); document.location="login";</script>';
    }
}
?>