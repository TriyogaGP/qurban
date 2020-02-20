<script type="text/javascript">
  $('.switchKeranjang').change(function () {
    var id = $(this).children(':hidden').val();
    let pembagi = id.split(" ");
    let id_catalog = pembagi[0];
    let id_reselleradmin = pembagi[1];
    let id_keranjang = pembagi[2];
    if ($(this).children(':checked').length === 0)
    {
        var pilihan = 0;
    }
    else
    {
        var pilihan = 1;
    }
    console.log(pilihan);
    $.ajax({
      type: 'GET',
      url: "<?=base_url('Dashboard/PemilihanCheckoutKeranjang')?>",
      data: {pilihan: pilihan, id_catalog: id_catalog, id_reselleradmin: id_reselleradmin, id_keranjang: id_keranjang},
      success: function (response) {
        console.log(response);
        // $('.tampildata').load(base_url+'viewadmin');
      }
    });
  });
</script>
<?php error_reporting(0); ?>
<!-- <script src="<?=base_url('assets/')?>myscript.js"></script> -->
<?php if($data_keranjang->num_rows() <= 0){ $url = base_url('compro'); echo '<script language="javascript">document.location="'.$url.'";</script>'; } ?>
<form method="POST" action="<?=base_url('checkoutallkeranjang')?>">
  <table class="table table-striped table-bordered" cellspacing="0" width="100%">
    <thead>
  	  <tr align="center" style="font-weight: bold;">
        <?php if($this->session->userdata('ses_level') == 3){ ?>
  	     <td width="5%">Pilih</td>
        <?php } ?>
        <td width="15%">Nama</td>
  	    <td width="15%">Kategori</td>
  	    <td width="10%">No Eartag</td>
  	    <td width="15%" align="right">Sub Total</td>
  	    <?php if($this->session->userdata('ses_level') == 3){ ?>
  	    	<td width="8%">Reseller Order</td>
  	    	<td width="8%">Opsi</td>
  	    <?php } ?>
  	  </tr>
  	</thead>
  	<?php 
  		$total_seluruh = 0; 
  		foreach ($data_keranjang->result_array() as $value) { 
  			// $now = date('Y-m-d H:i:s');
  			// $date = date_create($value['update_date']);
  	?>
      <tr align="center">
        <?php if($this->session->userdata('ses_level') == 3){ ?>
          <td style="vertical-align: middle;">
            <?php if($value['status_sale'] != 1){ ?>
              <input type="checkbox" disabled>
            <?php }else{ ?>
              <div class="switchKeranjang">
                <input type="hidden" value="<?=$value['id_catalog']?> <?=$value['id_reselleradmin']?> <?=$value['id_keranjang']?>"/>
                <?php 
                  if($this->Dashboard_model->get_all_pilihancartBY($value['id_keranjang'])->num_rows() > 0){
                  foreach ($this->Dashboard_model->get_all_pilihancartBY($value['id_keranjang'])->result_array() as $pemilihannya) {
                ?>
                  <input type="checkbox" name="pilihkeranjang[]" value="<?=$value['id_catalog']?> <?=$value['id_keranjang']?>" <?php if($pemilihannya['pilihan'] == 0){echo"unchecked";}else{echo"checked";} ?>>
                <?php }}else{ ?>
                    <input type="checkbox" unchecked>
                <?php } ?>
              </div>
            <?php } ?>
          </td>
        <?php } ?>
        <td style="vertical-align: middle;"><?=$value['nama']?></td>
        <td style="vertical-align: middle;"><?=$value['nama_kategori']?>
        </td>
        <td style="vertical-align: middle;"><?=$value['no_eartag']?> <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="<?="Bobot (".$value['bobot']."Kg), Harga (".$value['harga'].")"?>"></i></td>
        <td style="vertical-align: middle;" align="right"><?php $total = $value['harga'] * $value['bobot']; echo "Rp. ".number_format($total,2)?></td>
        <?php if($this->session->userdata('ses_level') == 3){ ?>
          <td style="vertical-align: middle;">
          	<?php 
          		$total_jml = 0;
    					$jmlCatalogKeranjang = $this->Dashboard_model->get_total_keranjangBY($value['id_catalog']); 
          		foreach ($jmlCatalogKeranjang->result_array() as $value1) {
          			$total_jml += $value1['jml'];
          		}
          	?>
          	<a href="#"><div data-toggle="tooltip" data-placement="top" title="Reseller Book"><?=$total_jml." Reseller Book";?></div></a>
          </td>
          <td style="vertical-align: middle;" align="center">
  					<?php if($value['status_sale'] != 1){ ?>
              <a href="#" class="btn btn-danger btn-xs" data-toggle="tooltip" data-placement="top" title="hapus keranjang" disabled><i class="fa fa-remove"></i></a>
  						<a href="#" class="btn btn-success btn-xs" data-toggle="tooltip" data-placement="top" title="Tidak bisa CheckOut, sudah di CheckOut yang lain" disabled><i class="fa fa-check"></i></a>
  					<?php }else{ ?>
  					  <a href="<?= base_url('deletekeranjang/').$value['id_reselleradmin']."/".$value['id_catalog'];?>" class="btn btn-danger btn-xs" data-toggle="tooltip" data-placement="top" title="hapus keranjang" onclick="return confirm('Anda yakin menghapus data ini?')"><i class="fa fa-remove"></i></a>
  						<a href="<?= base_url('paidkeranjang/').$value['id_reselleradmin']."/".$value['id_catalog'];?>" class="btn btn-success btn-xs" data-toggle="tooltip" data-placement="top" title="CheckOut hewan qurban ini?"><i class="fa fa-check"></i></a>
  					<?php } ?>
          </td>
         <?php } ?>
      </tr>
    <?php $total_seluruh += $total; } ?>
  	<tr align="center">
      <?php if($this->session->userdata('ses_level') == 3){ ?>
        <td style="vertical-align: middle;" colspan="4" align="right"><b>Total Keseluruhan</b></td>
      <?php }else{ ?>
        <td style="vertical-align: middle;" colspan="3" align="right"><b>Total Keseluruhan</b></td>
      <?php } ?>
      <td style="vertical-align: middle;" width="15%" align="right"><b><?= "Rp. ".number_format($total_seluruh,2)?></b></td>
      <?php if($this->session->userdata('ses_level') == 3){ ?>
        <td colspan="2" width="20%" align="center">
  				<!-- <a href="<?= base_url('deleteallkeranjang/').$value['id_reselleradmin'];?>" class="btn btn-danger btn-md" data-toggle="tooltip" data-placement="top" title="hapus semua keranjang" onclick="return confirm('Anda yakin menghapus data ini?')"><i class="fa fa-remove"></i> Kosongkan Keranjang</a> -->
        </td>
      <?php } ?>
    </tr>
  </table>
  <?php if($this->session->userdata('ses_level') == 3){ ?>
    <?php if($value['status_sale'] != 1){ ?>
      <div style="text-align: right; margin-right: 10px;">
        <button type="submit" class="btn btn-success btn-md" data-toggle="tooltip" data-placement="left" title="CheckOut Keranjang" disabled><i class="fa fa-check"></i> CheckOut Keranjang (<?=$this->Dashboard_model->get_all_pilihancartBY2($value['id_reselleradmin'])->num_rows();?>)</button>
      </div>
    <?php }else{ ?>
    	<div style="text-align: right; margin-right: 10px;">
    		<button type="submit" class="btn btn-success btn-md" data-toggle="tooltip" data-placement="left" title="CheckOut Keranjang"><i class="fa fa-check"></i> CheckOut Keranjang (<?=$this->Dashboard_model->get_all_pilihancartBY2($value['id_reselleradmin'])->num_rows();?>)</button>
    	</div>
    <?php } ?>
  <?php } ?>
</form>