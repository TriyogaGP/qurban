<!-- page content -->
<div class="right_col" role="main">
  <div align="right" style="font-weight: bold; font-size: 20px; font-family: cursive;"><?php $this->load->view('tampilan/jam_aktif'); ?></div>
  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel">
        <div class="x_title">
          <h2>Ubah Data Customer</h2>
          <div class="nav navbar-right panel_toolbox">
          </div>
          <div class="clearfix"></div>
        </div>
        <div class="x_content">
          <form action="<?=base_url('updateuploadbuktipelunasan')?>" method="POST" enctype="multipart/form-data" class="form-horizontal form-label-left">
            <input type="hidden" id="upload_id" name="upload_id" value="<?= $data_customer[0]['id_upload'];?>">
            <input type="hidden" id="catalog_id" name="catalog_id" value="<?= $data_customer[0]['id_catalog'];?>">
            <input type="hidden" id="customer_id" name="customer_id" value="<?= $data_customer[0]['id_customer'];?>">
            <?php $total = $data_customer[0]['bobot']*$data_customer[0]['harga'] ?>
            <input type="hidden" id="harga" name="harga" value="<?= $total;?>">
            <div class="item form-group">
              <label class="control-label col-md-2 col-sm-3 col-xs-12" for="inputNama">Nama Customer <span class="required"></span></label>
              <div class="col-md-8 col-sm-6 col-xs-12">  
                <input id="inputNama" class="form-control col-md-7 col-xs-12" name="inputNama" placeholder="input Nama Customer" required="required" type="text" value="<?=$data_customer[0]['nama_customer'];?>"readonly autocomplete="off">
              </div>
            </div>
            <div class="item form-group">
              <label class="control-label col-md-2 col-sm-3 col-xs-12" for="inputKode">Kode Upload <span class="required"></span></label>
              <div class="col-md-8 col-sm-6 col-xs-12">  
                <input id="inputKode" class="form-control col-md-7 col-xs-12" name="inputKode" placeholder="input Nama Customer" required="required" type="text" value="<?=$data_customer[0]['no_eartag'].'_'.$data_customer[0]['nama_kategori'].'_'.$data_customer[0]['nama_customer'];?>"readonly autocomplete="off">
              </div>
            </div>
            <div class="item form-group">
              <label class="control-label col-md-2 col-sm-3 col-xs-12" for="bukti">Upload Bukti <span class="required">*</span></label>
              <div class="col-md-8 col-sm-6 col-xs-12">
                <input id="bukti" name="bukti" placeholder="input Foto" class="form-control col-md-7 col-xs-12" type="file" required="required">
                <b>Note : Bukti harus *.jpg, *.jpeg, atau *.png</b>
              </div>
            </div>
            <div class="form-group">
              <div class="col-md-3 col-md-offset-2">
                <button type="reset" class="btn btn-primary">Batal</button>
                <button type="submit" class="upload btn btn-success" disabled>Upload</button>
              </div>
            </div>
            <b>* Required (Harus di isi)</b>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- /page content -->
<script type='text/javascript' src='http://code.jquery.com/jquery.min.js'></script>
<script type="text/javascript">
  $('#bukti').change(function(){
    if($('#bukti').val()==''){
      $('.upload').attr('disabled',true)
    } 
    else{
      $('.upload').attr('disabled',false);
    }
  });
</script>