<?php if($data_customer->num_rows() <= 0){ $url = base_url('compro'); echo '<script language="javascript">document.location="'.$url.'";</script>'; } ?>
<table class="table table-striped table-bordered" cellspacing="0" width="100%">
  <thead>
	  <tr align="center" style="font-weight: bold; vertical-align: middle;">
	    <td style="vertical-align: middle;" width="8%">No Eartag</td>
	    <td style="vertical-align: middle;" width="10%">Hewan Qurban</td>
	    <td style="vertical-align: middle;" width="12%">Nama Customer</td>
	    <td style="vertical-align: middle;" width="12%">Alamat Customer</td>
	    <td style="vertical-align: middle;" width="10%">No.Telp Customer</td>
	    <td style="vertical-align: middle;" width="3%">Type Bayar</td>
	    <td style="vertical-align: middle;" width="12%">Bayar</td>
	    <td style="vertical-align: middle;" width="12%">Sisa</td>
	    <td style="vertical-align: middle;" width="10%">Opsi</td>
	  </tr>
	</thead>
	<?php 
		foreach ($data_customer->result_array() as $value) { 
			// $now = date('Y-m-d H:i:s');
			// $date = date_create($value['update_date']);
//         date_add($date, date_interval_create_from_date_string('60 minutes'));
//         $waktu = date_format($date, 'Y-m-d H:i:s');
//         $diff  = date_diff(date_create($value['update_date']), date_create($waktu));
//         $selisih = strtotime($waktu) - strtotime($now);
	?>
		<?php $id_notifikasi = $this->uri->segment(2); if($id_notifikasi == 0){$id="0";}else{$id=$value['id_notifikasi'];} ?>
		<div class="ambilnotif" data-idnotifikasi="<?=$id?>"></div>
    <tr align="center">
      <td style="vertical-align: middle;"><?=$value['no_eartag']?> <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="<?="Bobot (".$value['bobot']."Kg), Harga (".$value['harga'].")"?>"></i></td>
      <td style="vertical-align: middle;"><?=$value['nama_kategori']?></td>
      <td style="vertical-align: middle;"><?php if($value['nama_customer'] == NULL){echo"(belum di lengkapi)";}else{echo $value['nama_customer'];}?></td>
      <td style="vertical-align: middle;"><?php if($value['alamat_customer'] == NULL){echo"(belum di lengkapi)";}else{echo $value['alamat_customer'];}?></td>
      <td style="vertical-align: middle;"><?php if(empty($value['no_telp_customer'])){echo"(belum di lengkapi)";}else{echo $value['no_telp_customer'];}?></td>
      <td style="vertical-align: middle;"><?php if($value['type_bayar'] == 0){echo"(belum di pilih)";}elseif($value['type_bayar'] == 1){echo"DP";}elseif($value['type_bayar'] == 2){echo"LUNAS";}?></td>
      <td style="vertical-align: middle;" align="right"><?="Rp. ".number_format($value['jml'],2)?></td>
      <td style="vertical-align: middle;" align="right"><?php if($value['type_bayar'] == 1){$total = (($value['harga']*$value['bobot'])-$value['jml']); echo "<b>Rp. ".number_format($total,2)."</b>";}elseif($value['type_bayar'] == 2 || $value['type_bayar'] == 0){echo "Rp. ".number_format("0",2);}?></td>
       <td style="vertical-align: middle;" align="center">
      	<?php if($this->session->userdata('ses_level') == 3){ ?>
      		<?php if($value['status_sale'] == 0 || $value['status_sale'] == 1 || $value['status_sale'] == 2){ ?>
						<a href="<?= base_url('deletecustomer/').$value['id_customer']."/".$value['id_catalog'];?>" class="btn btn-danger btn-xs" data-toggle="tooltip" data-placement="top" title="hapus customer" onclick="return confirm('Anda yakin menghapus data ini?')"><i class="fa fa-remove"></i></a>
						<a href="<?= base_url('editcustomer/').$value['id_customer'];?>" class="btn btn-success btn-xs" data-toggle="tooltip" data-placement="top" title="Lengkapi Data Customer"><i class="fa fa-edit"></i></a>
      		<?php } $id=1; $buktiupload = $this->Dashboard_model->get_all_buktiupload($value['id_customer'])->result_array();foreach ($buktiupload as $buktiValue) {$status_upload = $buktiValue['status_upload'];} if($status_upload == 0){ ?>
	      		<?php if($value['status'] == 1){ ?>
								<a href="<?= base_url('uploadbukti/').$value['id_customer'];?>" class="btn btn-primary btn-xs" data-toggle="tooltip" data-placement="top" title="Upload Bukti Bayar"><i class="fa fa-upload"></i></a>
	       		<?php }else{ ?>
							<a href="#" class="btn btn-primary btn-xs" data-toggle="tooltip" data-placement="top" title="Upload Bukti Bayar" disabled><i class="fa fa-upload"></i></a>
	       		<?php } ?>
       		<?php }else{ $id=1; $buktiupload = $this->Dashboard_model->get_all_buktiupload($value['id_customer'])->result_array();foreach ($buktiupload as $buktiValue) { ?>
      			<a href="<?= base_url('downloadbukti/').$buktiValue['bukti'];?>" class="btn btn-primary btn-xs" data-toggle="tooltip" data-placement="top" title="Download Bukti Bayar DP <?=$id++?>"><i class="fa fa-download"></i></a>
	       	<?php }} ?>
       	<?php }else{ ?>
      		<?php if($value['status_sale'] == 0 || $value['status_sale'] == 1 || $value['status_sale'] == 2 || $value['status_sale'] == 3){ ?>
						<a href="<?= base_url('approvepembelian/').$value['id_customer'];?>" class="btn btn-success btn-xs" data-toggle="tooltip" data-placement="top" title="Approve Pembelian"><i class="fa fa-check"></i></a>
       		<?php } ?>
       		<?php $id=1; $buktiupload = $this->Dashboard_model->get_all_buktiupload($value['id_customer'])->result_array();foreach ($buktiupload as $buktiValue) { ?>
    				<a href="<?= base_url('downloadbukti/').$buktiValue['bukti'];?>" class="btn btn-primary btn-xs" data-toggle="tooltip" data-placement="top" title="Download Bukti Bayar DP <?=$id++?>"><i class="fa fa-download"></i></a>
     			<?php } ?>
       	<?php } ?>
      </td>
    </tr>
  <?php } ?>
</table>