<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Json extends CI_Controller {
    var $versi;
    function __construct()
    {
		parent::__construct();
		$this->load->model('Dashboard_model');
		$this->load->model('Login_model');
        $this->versi = "1.00";
	}

    function header()
    {
        header('Content-Type: application/json');
    }

    function getmenu()
    {
        $this->header();
        $data_sapi = $this->Dashboard_model->get_all_menucatalogSapi()->result();
        $data_kambing = $this->Dashboard_model->get_all_menucatalogKambing()->result();
        $response = array();
        $response['data_menu_sapi'] = array();
        $response['data_menu_kambing'] = array();
        foreach ($data_sapi as $sapi_hasil)
        {
            $sapis[] = array(
                "kodejenis"     =>  $sapi_hasil->id_kategori,
                "kategori"      =>  $sapi_hasil->nama_kategori,
                "gambar"        =>  "http://rumahcendekiabogor.com/qurbanqu/assets/images/".$sapi_hasil->gambar,
            );
        }
        foreach ($data_kambing as $kambing_hasil)
        {
            $kambings[] = array(
                "kodejenis"     =>  $kambing_hasil->id_kategori,
                "kategori"      =>  $kambing_hasil->nama_kategori,
                "gambar"        =>  "http://rumahcendekiabogor.com/qurbanqu/assets/images/".$kambing_hasil->gambar,
            );
        }
        if($data_sapi || $data_kambing){
            $response['data_menu_sapi'] = $sapis;
            $response['data_menu_kambing'] = $kambings;
            $response['versi'] = $this->versi;
            $response['status_sistem'] = "success";
            echo json_encode($response,TRUE);    
        }else{
            $response['versi'] = $this->versi;
            $response['status_sistem'] = "failed";
            echo json_encode($response,TRUE);           
        }
    }


	function gethewan()
	{
	    $this->header();
        $data_sapi = $this->Dashboard_model->get_all_catalogSapi()->result();
        $data_kambing = $this->Dashboard_model->get_all_catalogKambing()->result();
        $response = array();
        $response['data_sapi'] = array();
        $response['data_kambing'] = array();
        foreach ($data_sapi as $sapi_hasil)
        {
            $total_jml = 0;
            $jmlCatalogKeranjang = $this->Dashboard_model->get_total_keranjangBY($sapi_hasil->id_catalog); 
            foreach ($jmlCatalogKeranjang->result_array() as $value1) {
              $total_jml += $value1['jml'];
            }
            if($sapi_hasil->bobot > 200 && $sapi_hasil->bobot <= 450){$bobotsapi = "1";}
            elseif($sapi_hasil->bobot > 450 && $sapi_hasil->bobot <= 600){$bobotsapi = "2";}
            elseif($sapi_hasil->bobot > 600 && $sapi_hasil->bobot <= 850){$bobotsapi = "3";}
            elseif($sapi_hasil->bobot > 850 && $sapi_hasil->bobot <= 1100){$bobotsapi = "4";}
            elseif($sapi_hasil->bobot > 1100 && $sapi_hasil->bobot <= 1350){$bobotsapi = "5";}
            $total = "Rp. ".number_format($sapi_hasil->harga * $sapi_hasil->bobot);
            $sapis[] = array(
                "id_catalog"    =>  $sapi_hasil->id_catalog,
                "kodejenis"     =>  $sapi_hasil->id_kategori,
                "kodebobot"     =>  $bobotsapi,
                "kategori"      =>  $sapi_hasil->nama_kategori,
                "no_eartag"     =>  $sapi_hasil->no_eartag,
                "bobot"         =>  $sapi_hasil->bobot." Kg",
                "hargaperkg"    =>  "Rp. ".number_format($sapi_hasil->harga)." /Kg",
                "harga"         =>  $total,
                "usia"          =>  $sapi_hasil->usia,
                "reseller"      =>  "$total_jml",
                "gambar"        =>  "http://rumahcendekiabogor.com/qurbanqu/assets/images/".$sapi_hasil->gambar,
                "status_sale"   =>  $sapi_hasil->status_sale,
            );
        }

        foreach ($data_kambing as $kambing_hasil)
        {
            $total_jml = 0;
            $jmlCatalogKeranjang = $this->Dashboard_model->get_total_keranjangBY($kambing_hasil->id_catalog); 
            foreach ($jmlCatalogKeranjang->result_array() as $value1) {
              $total_jml += $value1['jml'];
            }
            if($kambing_hasil->bobot > 30 && $kambing_hasil->bobot <= 45){$bobotkambing = "1";}
            elseif($kambing_hasil->bobot > 45 && $kambing_hasil->bobot <= 60){$bobotkambing = "2";}
            elseif($kambing_hasil->bobot > 60 && $kambing_hasil->bobot <= 75){$bobotkambing = "3";}
            elseif($kambing_hasil->bobot > 75 && $kambing_hasil->bobot <= 90){$bobotkambing = "4";}
            elseif($kambing_hasil->bobot > 90 && $kambing_hasil->bobot <= 105){$bobotkambing = "5";}
            $total = "Rp. ".number_format($kambing_hasil->harga * $kambing_hasil->bobot);
            $kambings[] = array(
                "id_catalog"    =>  $kambing_hasil->id_catalog,
                "kodejenis"     =>  $kambing_hasil->id_kategori,
                "kodebobot"     =>  $bobotkambing,
                "kategori"      =>  $kambing_hasil->nama_kategori,
                "no_eartag"     =>  $kambing_hasil->no_eartag,
                "bobot"         =>  $kambing_hasil->bobot." Kg",
                "hargaperkg"    =>  "Rp. ".number_format($kambing_hasil->harga)." /Kg",
                "harga"         =>  $total,
                "usia"          =>  $kambing_hasil->usia,
                "reseller"      =>  "$total_jml",
                "gambar"        =>  "http://rumahcendekiabogor.com/qurbanqu/assets/images/".$kambing_hasil->gambar,
                "status_sale"   =>  $kambing_hasil->status_sale,
            );
        }
        if($data_sapi || $data_kambing){
            $response['data_sapi'] = $sapis;
            $response['data_kambing'] = $kambings;
            $response['versi'] = $this->versi;
            $response['status_sistem'] = "success";
            echo json_encode($response,TRUE);    
        }else{
            $response['versi'] = $this->versi;
            $response['status_sistem'] = "failed";
            echo json_encode($response,TRUE);           
        }
	}
	
	function getcarihewan()
	{
	    $this->header();
        $bobot = $this->input->get('bobot');
        $batas_awal = $bobot;
        $batas_akhir = $bobot+100;
        $data_sapi = $this->Dashboard_model->get_all_catalogSapiCari($batas_awal,$batas_akhir);
        $data_kambing = $this->Dashboard_model->get_all_catalogKambingCari($batas_awal,$batas_akhir);
        $response = array();
        $response['data_sapi'] = array();
        $response['data_kambing'] = array();
        if($data_sapi->num_rows() > 0){
            foreach ($data_sapi->result() as $sapi_hasil)
            {
                $total_jml = 0;
                $jmlCatalogKeranjang = $this->Dashboard_model->get_total_keranjangBY($sapi_hasil->id_catalog); 
                foreach ($jmlCatalogKeranjang->result_array() as $value1) {
                  $total_jml += $value1['jml'];
                }
                if($sapi_hasil->bobot > 200 && $sapi_hasil->bobot <= 450){$bobotsapi = "1";}
                elseif($sapi_hasil->bobot > 450 && $sapi_hasil->bobot <= 600){$bobotsapi = "2";}
                elseif($sapi_hasil->bobot > 600 && $sapi_hasil->bobot <= 850){$bobotsapi = "3";}
                elseif($sapi_hasil->bobot > 850 && $sapi_hasil->bobot <= 1100){$bobotsapi = "4";}
                elseif($sapi_hasil->bobot > 1100 && $sapi_hasil->bobot <= 1350){$bobotsapi = "5";}
                $total = "Rp. ".number_format($sapi_hasil->harga * $sapi_hasil->bobot);
                $sapis[] = array(
                    "id_catalog"    =>  $sapi_hasil->id_catalog,
                    "kodejenis"     =>  $sapi_hasil->id_kategori,
                    "kodebobot"     =>  $bobotsapi,
                    "kategori"      =>  $sapi_hasil->nama_kategori,
                    "no_eartag"     =>  $sapi_hasil->no_eartag,
                    "bobot"         =>  $sapi_hasil->bobot." Kg",
                    "hargaperkg"    =>  "Rp. ".number_format($sapi_hasil->harga)." /Kg",
                    "harga"         =>  $total,
                    "usia"          =>  $sapi_hasil->usia,
                    "reseller"      =>  "$total_jml",
                    "gambar"        =>  "http://rumahcendekiabogor.com/qurbanqu/assets/images/".$sapi_hasil->gambar,
                    "status_sale"   =>  $sapi_hasil->status_sale,
                );
            }
        }else{
            $sapis = array();
        }
        if($data_kambing->num_rows() > 0){
            foreach ($data_kambing->result() as $kambing_hasil)
            {
                $total_jml = 0;
                $jmlCatalogKeranjang = $this->Dashboard_model->get_total_keranjangBY($kambing_hasil->id_catalog); 
                foreach ($jmlCatalogKeranjang->result_array() as $value1) {
                  $total_jml += $value1['jml'];
                }
                if($kambing_hasil->bobot > 30 && $kambing_hasil->bobot <= 45){$bobotkambing = "1";}
                elseif($kambing_hasil->bobot > 45 && $kambing_hasil->bobot <= 60){$bobotkambing = "2";}
                elseif($kambing_hasil->bobot > 60 && $kambing_hasil->bobot <= 75){$bobotkambing = "3";}
                elseif($kambing_hasil->bobot > 75 && $kambing_hasil->bobot <= 90){$bobotkambing = "4";}
                elseif($kambing_hasil->bobot > 90 && $kambing_hasil->bobot <= 105){$bobotkambing = "5";}
                $total = "Rp. ".number_format($kambing_hasil->harga * $kambing_hasil->bobot);
                $kambings[] = array(
                    "id_catalog"    =>  $kambing_hasil->id_catalog,
                    "kodejenis"     =>  $kambing_hasil->id_kategori,
                    "kodebobot"     =>  $bobotkambing,
                    "kategori"      =>  $kambing_hasil->nama_kategori,
                    "no_eartag"     =>  $kambing_hasil->no_eartag,
                    "bobot"         =>  $kambing_hasil->bobot." Kg",
                    "hargaperkg"    =>  "Rp. ".number_format($kambing_hasil->harga)." /Kg",
                    "harga"         =>  $total,
                    "usia"          =>  $kambing_hasil->usia,
                    "reseller"      =>  "$total_jml",
                    "gambar"        =>  "http://rumahcendekiabogor.com/qurbanqu/assets/images/".$kambing_hasil->gambar,
                    "status_sale"   =>  $kambing_hasil->status_sale,
                );
            }
        }else{
            $kambings = array();
        }
        if($data_sapi || $data_kambing){
            $response['data_sapi'] = $sapis;
            $response['data_kambing'] = $kambings;
            $response['versi'] = $this->versi;
            $response['status_sistem'] = "success";
            echo json_encode($response,TRUE);    
        }else{
            $response['versi'] = $this->versi;
            $response['status_sistem'] = "failed";
            echo json_encode($response,TRUE);           
        }
	}
	
	function loginreseller()
    {
        $this->header();
        $username = $this->input->get('username');
        $password = $this->input->get('password');

        // $username = "Reseller1";
        // $password = "0287a512c8bc9f9004d052574ea49e04";

        $result = $this->Login_model->loginreseller($username, $password)->result();
        // $data['data'] = $result;
        $response = array();
        $response['data'] = array();
        $response['keranjang'] = array();
        $response['myorder'] = array();
        foreach ($result as $hasil)
        {
            if(empty($hasil->foto)){$foto = "user.png";}else{$foto = $hasil->foto;}
            $total_seluruhkeranjang = 0; 
            $total_seluruhmyorder = 0; 
            $keranjang = $this->Dashboard_model->get_all_keranjangBYJSON($hasil->id_reselleradmin);
            if($keranjang->num_rows()>0){
                foreach ($keranjang->result() as $value) {
                    $total_jml = 0;
                    $jmlCatalogKeranjang = $this->Dashboard_model->get_total_keranjangBY($value->id_catalog); 
                    foreach ($jmlCatalogKeranjang->result_array() as $value1) {
                        $total_jml += $value1['jml'];
                    }
                    $total_harga = $value->harga * $value->bobot;
                    $total = "Rp. ".number_format($value->harga * $value->bobot);
                    $keranjangs[] = array(
                        "id_keranjang"  => $value->id_keranjang,
                        "id_catalog"    => $value->id_catalog,
                        "jenis"         => $value->jenis,
                        "kategori"      => $value->nama_kategori,
                        "no_eartag"     => $value->no_eartag,
                        "bobot"         => $value->bobot." Kg",
                        "hargaperkg"    => "Rp. ".number_format($value->harga)." /Kg",
                        "harga"         => $total,
                        "usia"          => $value->usia,
                        "totalReseller" => $total_jml." Reseller",
                    );
                    $total_seluruhkeranjang += $total_harga;
                }
            }else{
                $keranjangs = array();
            }

            $myorder = $this->Dashboard_model->get_all_myorderBYJSON($hasil->id_reselleradmin);
            if($myorder->num_rows()>0){
                foreach ($myorder->result() as $value) {
                    $total_jml = 0;
                    $jmlCatalogKeranjang = $this->Dashboard_model->get_total_keranjangBY($value->id_catalog); 
                    foreach ($jmlCatalogKeranjang->result_array() as $value1) {
                        $total_jml += $value1['jml'];
                    }
                    $total_harga = $value->harga * $value->bobot;
                    $total = "Rp. ".number_format($value->harga * $value->bobot);
                    $myorders[] = array(
                        "id_keranjang"  => $value->id_keranjang,
                        "id_catalog"    => $value->id_catalog,
                        "jenis"         => $value->jenis,
                        "kategori"      => $value->nama_kategori,
                        "no_eartag"     => $value->no_eartag,
                        "bobot"         => $value->bobot." Kg",
                        "hargaperkg"    => "Rp. ".number_format($value->harga)." /Kg",
                        "harga"         => $total,
                        "usia"          => $value->usia,
                        "totalReseller" => $total_jml." Reseller",
                    );
                    $total_seluruhmyorder += $total_harga;
                }
            }else{
                $myorders = array();
            }    
            $posts = array(
                "id_reselleradmin"  => $hasil->id_reselleradmin,
                "nama"              => $hasil->nama,
                "email"             => $hasil->email,
                "username"          => $hasil->username,
                "password"          => $hasil->password,
                "no_telp"           => $hasil->no_telp,
                "alamat"            => $hasil->alamat,
                "code"              => $hasil->code,
                "foto"              => "http://rumahcendekiabogor.com/qurbanqu/assets/images/gambar_user/".$foto,
                "aktif_state"       => $hasil->aktif_state,
            );
        }
        if($result){
            $response['data'] = $posts;
            $response['keranjang'] = $keranjangs;
            $response['myorder'] = $myorders;
            $response['total_harga_keranjang'] = "Rp. ".number_format($total_seluruhkeranjang);
            $response['total_harga_myorder'] = "Rp. ".number_format($total_seluruhmyorder);
            $response['versi'] = $this->versi;
            $response['status_sistem'] = "success";
            echo json_encode($response);    
        }else{
            $response['versi'] = $this->versi;
            $response['status_sistem'] = "failed";
            echo json_encode($response);            
        }
    }
    
    function addcart()
    {
        $this->header();
        $id_catalog = $this->input->get('id_catalog');
        $id_reselleradmin = $this->input->get('id_reselleradmin');

        // $id_catalog = "2";
        // $id_reselleradmin = "2";

        $DataCatalog=$this->db->query("SELECT * FROM tbl_catalog WHERE id_catalog='$id_catalog'");
        $hasilCatalog = $DataCatalog->result_array();
        if($hasilCatalog[0]['status_sale'] < 2){
            $DataKeranjang=$this->db->query("SELECT * FROM tbl_keranjang WHERE id_catalog='$id_catalog' && id_reselleradmin='$id_reselleradmin'");
            if($DataKeranjang->num_rows() > 0){
                $data["error"] = "true";
                $data['status'] = "Sudah";
                $data['status_sale'] = $hasilCatalog[0]['status_sale'];
                echo json_encode($data);
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
                    $data["error"] = "false";
                    $data['status'] = "Berhasil";
                    $data['status_sale'] = $hasilCatalog[0]['status_sale'];
                    echo json_encode($data);
                }else{
                    $data["error"] = "true";
                    $data['status'] = "Gagal";
                    $data['status_sale'] = $hasilCatalog[0]['status_sale'];
                    echo json_encode($data);
                }
            }
        }else{
            $data["error"] = "true";
            $data['status'] = "Sedang Transaksi";
            $data['status_sale'] = $hasilCatalog[0]['status_sale'];
            echo json_encode($data);
        }
    }

    function orderhewan()
    {
        $this->header();
        date_default_timezone_set("Asia/Jakarta");
        $tgl = date("Y-m-d H:i:s");
        $id_catalog = $this->input->post('id_catalog');
        $id_reselleradmin = $this->input->post('id_reselleradmin');
        $nama_customer = $this->input->post('nama_customer');
        $alamat_customer = $this->input->post('alamat_customer');
        $no_telp_customer = $this->input->post('no_telp_customer');
        $type_bayar = $this->input->post('type_bayar');
        $jml = $this->input->post('jml');
        $tanggal_pengiriman = $this->input->post('tanggal_pengiriman');
        $jml_data = count($id_catalog);
        for($i=0;$i<$jml_data;$i++)
        {
            $cekcustomer = $this->Dashboard_model->get_all_customerBY4($id_reselleradmin,$id_catalog[$i]);
            $kirimdata['id_catalog'] = $id_catalog[$i];
            $kirimdata['id_reselleradmin'] = $id_reselleradmin;
            $kirimdata['nama_customer'] = $nama_customer;
            $kirimdata['alamat_customer'] = $alamat_customer;
            $kirimdata['no_telp_customer'] = $no_telp_customer;
            $kirimdata['type_bayar'] = $type_bayar[$i];
            $kirimdata['jml'] = $jml[$i];
            $kirimdata['tanggal_pengiriman'] = $tanggal_pengiriman[$i];
            $kirimdata['status'] = "1";
            if($cekcustomer->num_rows() > 0){
                $success = $this->Dashboard_model->update_customer($kirimdata,$id_catalog[$i]);
            }else{
                $kirimdata['update_date'] = $tgl;
                $success = $this->Dashboard_model->insert_customer($kirimdata);
                if($success){
                    $customer = $this->Dashboard_model->get_all_customerBY4($id_reselleradmin,$id_catalog[$i]);
                    $kirimdata2['update_upload'] = $tgl;
                    $kirimdata2['id_customer'] = $customer[0]['id_customer'];
                    $berhasilmasuk = $this->Dashboard_model->insert_bukti($kirimdata2);
                }
            }
        }

        if($berhasilmasuk){
            $data['status'] = "Berhasil";
            echo json_encode($data);
        }else{
            $data['status'] = "Gagal";
            echo json_encode($data);
        }
    }
}