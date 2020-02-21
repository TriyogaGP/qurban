<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Cronjob extends CI_Controller {
    function __construct()
    {
		parent::__construct();
		$this->load->model('Dashboard_model');
	}

	function deleteDailyKeranjangPesan()
	{
		date_default_timezone_set("Asia/Jakarta");
		$waktu = date("Y-m-d H:i:s");
		$DataCronjob=$this->db->query("SELECT A.update_date,A.id_catalog,B.status_sale,B.id_catalog FROM tbl_keranjang AS A INNER JOIN tbl_catalog AS B ON A.id_catalog=B.id_catalog WHERE DATE_ADD(A.update_date, INTERVAL 1 HOUR)<'$waktu' && B.status_sale='1'")->result();
		foreach ($DataCronjob as $value) {
			$total_jml = 0;
			$jmlCatalogKeranjang = $this->Dashboard_model->get_total_keranjangBY($value->id_catalog); 
			foreach ($jmlCatalogKeranjang->result_array() as $value1) {
				$total_jml += $value1['jml'];
			}
			if($total_jml == 1){
				$kirimdata['status_sale'] = "0";
				$kirimdata['aktif_state'] = "1";
	    		$this->Dashboard_model->hapus_keranjang($value->id_reselleradmin,$value->id_catalog);
				$this->Dashboard_model->update_catalog($kirimdata,$value->id_catalog);
			}else{
	    		$this->Dashboard_model->hapus_keranjang($value->id_reselleradmin,$value->id_catalog);
			}
		}
	}

	function deleteDailyKeranjangPaid()
	{
		date_default_timezone_set("Asia/Jakarta");
		$waktu = date("Y-m-d H:i:s");
		$DataCronjob=$this->db->query("SELECT A.id_catalog,A.id_reselleradmin,B.status_sale,B.id_catalog,C.id_customer,C.id_catalog,C.id_reselleradmin,C.update_date,C.status FROM tbl_keranjang AS A INNER JOIN tbl_catalog AS B ON A.id_catalog=B.id_catalog INNER JOIN tbl_customer AS C ON C.id_catalog=A.id_catalog WHERE DATE_ADD(C.update_date, INTERVAL 1 HOUR)<'$waktu' && B.status_sale='2' && C.status='0'");
		if($DataCronjob->num_rows() > 0){
			foreach ($DataCronjob->result() as $value) {
				$kirimdata['status_sale'] = "0";
				$kirimdata['aktif_state'] = "1";
				$this->Dashboard_model->update_catalog($kirimdata,$value->id_catalog);
	    		$this->Dashboard_model->hapus_keranjang($value->id_reselleradmin,$value->id_catalog);
	    		$this->Dashboard_model->hapus_customer($value->id_reselleradmin,$value->id_catalog);
			}
		}
	}

	function deleteDailyKeranjangPaidDP()
	{
		date_default_timezone_set("Asia/Jakarta");
		$waktu = date("Y-m-d H:i:s");
		$DataCronjob=$this->db->query("SELECT A.id_catalog,A.id_reselleradmin,B.status_sale,B.id_catalog,C.id_customer,C.id_catalog,C.id_reselleradmin,C.tanggal_pengiriman,C.update_date,C.status FROM tbl_keranjang AS A INNER JOIN tbl_catalog AS B ON A.id_catalog=B.id_catalog INNER JOIN tbl_customer AS C ON C.id_catalog=A.id_catalog INNER JOIN tbl_upload_bukti AS D ON D.id_customer=C.id_customer INNER JOIN tbl_notifikasi AS E ON E.dari=C.id_reselleradmin WHERE DAY(C.tanggal_pengiriman)>'$waktu' && MONTH(C.tanggal_pengiriman)>'$waktu' && HOUR(C.tanggal_pengiriman)>'$waktu' && MINUTE(C.tanggal_pengiriman)>'$waktu' && B.status_sale='3' && C.status='1'");
		if($DataCronjob->num_rows() > 0){
			foreach ($DataCronjob->result() as $value) {
				$kirimdata['dari'] = $value['dari'];
				$kirimdata['ke'] = $value['ke'];
				$kirimdata['tujuan'] = "refundDP";
				$kirimdata['id_catalog'] = $value['id_catalog'];
				$kirimdata['updatetgl_pesan'] = $waktu;
				$kirimdata['status_pesan'] = "0";
				$this->Dashboard_model->insert_notif($kirimdata);

				$kirimdata2['status_sale'] = "0";
				$kirimdata2['aktif_state'] = "1";
				$this->Dashboard_model->update_catalog($kirimdata2,$value->id_catalog);
	    		$this->Dashboard_model->hapus_keranjang($value->id_reselleradmin,$value->id_catalog);
	    		$this->Dashboard_model->hapus_customer($value->id_reselleradmin,$value->id_catalog);
	    		unlink("assets/images/gambar_bukti/".$value['bukti']);
	    		$this->Dashboard_model->hapus_bukti($value->id_customer);
			}
		}
	}

	function deleteDailyKeranjangVerified()
	{
		date_default_timezone_set("Asia/Jakarta");
		$waktu = date("Y-m-d H:i:s");
		$DataCronjob=$this->db->query("SELECT A.id_catalog,A.id_reselleradmin,B.status_sale,B.id_catalog,C.id_customer,C.id_catalog,C.id_reselleradmin,C.update_date,C.status,D.id_customer,D.update_upload,D.status_upload FROM tbl_keranjang AS A INNER JOIN tbl_catalog AS B ON A.id_catalog=B.id_catalog INNER JOIN tbl_customer AS C ON C.id_catalog=A.id_catalog INNER JOIN tbl_upload_bukti AS D ON D.id_customer=C.id_customer WHERE DATE_ADD(D.update_upload, INTERVAL 1 DAY)<'$waktu' && B.status_sale='2' && C.status='1' && D.status_upload='0'");
		if($DataCronjob->num_rows() > 0){
			foreach ($DataCronjob->result() as $value) {
				$kirimdata['status_sale'] = "0";
				$kirimdata['aktif_state'] = "1";
				$this->Dashboard_model->update_catalog($kirimdata,$value->id_catalog);
	    		$this->Dashboard_model->hapus_keranjang($value->id_reselleradmin,$value->id_catalog);
	    		$this->Dashboard_model->hapus_customer($value->id_reselleradmin,$value->id_catalog);
	    		$this->Dashboard_model->hapus_bukti($value->id_customer);
			}
		}
	}

	function deleteDailyKeranjangApproved()
	{
		date_default_timezone_set("Asia/Jakarta");
		$waktu = date("Y-m-d H:i:s");
		$DataCronjob=$this->db->query("SELECT A.id_catalog,A.id_reselleradmin,B.status_sale,B.id_catalog,C.id_customer,C.id_catalog,C.id_reselleradmin,C.update_date,C.status,D.id_customer,D.bukti,D.update_upload,D.status_upload,E.updatetgl_pesan,E.dari,E.ke,E.tujuan,E.status_pesan FROM tbl_keranjang AS A INNER JOIN tbl_catalog AS B ON A.id_catalog=B.id_catalog INNER JOIN tbl_customer AS C ON C.id_catalog=A.id_catalog INNER JOIN tbl_upload_bukti AS D ON D.id_customer=C.id_customer INNER JOIN tbl_notifikasi AS E ON E.dari=C.id_reselleradmin WHERE DATE_ADD(E.updatetgl_pesan, INTERVAL 1 DAY)<'$waktu' && B.status_sale='3' && C.status='1' && D.status_upload='1' && E.status_pesan='0'");
		if($DataCronjob->num_rows() > 0){
			foreach ($DataCronjob->result() as $value) {
				$kirimdata['dari'] = $value['dari'];
				$kirimdata['ke'] = $value['ke'];
				$kirimdata['tujuan'] = "refund";
				$kirimdata['id_catalog'] = $value['id_catalog'];
				$kirimdata['updatetgl_pesan'] = $waktu;
				$kirimdata['status_pesan'] = "0";
				$this->Dashboard_model->insert_notif($kirimdata);

				$kirimdata2['status_sale'] = "0";
				$kirimdata2['aktif_state'] = "1";
				$this->Dashboard_model->update_catalog($kirimdata2,$value->id_catalog);
	    		$this->Dashboard_model->hapus_keranjang($value->id_reselleradmin,$value->id_catalog);
	    		$this->Dashboard_model->hapus_customer($value->id_reselleradmin,$value->id_catalog);
	    		unlink("assets/images/gambar_bukti/".$value['bukti']);
	    		$this->Dashboard_model->hapus_bukti($value->id_customer);
			}
		}
	}

	function soldout()
	{
		date_default_timezone_set("Asia/Jakarta");
		$waktu = date("Y-m-d H:i:s");
		$DataCronjob=$this->db->query("SELECT A.id_catalog,A.id_reselleradmin,B.status_sale,B.id_catalog,C.id_customer,C.id_catalog,C.id_reselleradmin,C.update_date,C.status,D.id_customer,D.bukti,D.update_upload,D.status_upload,E.updatetgl_pesan,E.id_notifikasi,E.dari,E.ke,E.tujuan,E.status_pesan FROM tbl_keranjang AS A INNER JOIN tbl_catalog AS B ON A.id_catalog=B.id_catalog INNER JOIN tbl_customer AS C ON C.id_catalog=A.id_catalog INNER JOIN tbl_upload_bukti AS D ON D.id_customer=C.id_customer INNER JOIN tbl_notifikasi AS E ON E.ke=C.id_reselleradmin WHERE DATE_ADD(E.updatetgl_pesan, INTERVAL 1 DAY)<'$waktu' && B.status_sale='4' && C.status='1' && D.status_upload='1'");
		if($DataCronjob->num_rows() > 0){
			foreach ($DataCronjob->result() as $value) {
				if($value->tujuan == "pengiriman hewan qurban"){
					$kirimdata['status_sale'] = "5";
					$kirimdata['aktif_state'] = "0";
					$this->Dashboard_model->update_catalog($kirimdata,$value->id_catalog);
				}
				$kirimdata2['status_pesan'] = "1";
				$this->Dashboard_model->update_notif($kirimdata2,$value->id_notifikasi);
			}
		}
	}
}