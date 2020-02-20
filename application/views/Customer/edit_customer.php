<!-- page content -->
<div class="right_col" role="main">
  <div align="right" style="font-weight: bold; font-size: 20px; font-family: cursive;"><?php $this->load->view('tampilan/jam_aktif'); ?></div>
  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel">
        <div class="x_title">
          <h2>Ubah Data Customer</h2>
          <div class="nav navbar-right panel_toolbox">
              <a href="<?=base_url('customer')?>" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="bottom" title="Kembali"><i class="fa fa-reply"></i> Kembali</a>
          </div>
          <div class="clearfix"></div>
        </div>
        <div class="x_content">
          <form action="<?=base_url('updatecustomer')?>" method="POST" enctype="multipart/form-data" class="form-horizontal form-label-left">
            <?php $total = $data_customer[0]['harga'] * $data_customer[0]['bobot']; ?>
            <input type="hidden" id="catalog_id" name="catalog_id" value="<?= $data_customer[0]['id_catalog'];?>">
            <div class="hargatotal" data-harga="<?= $total;?>"></div>
            <div class="item form-group">
              <label class="control-label col-md-2 col-sm-3 col-xs-12" for="inputNoeartag">No Eartag <span class="required"></span></label>
              <div class="col-md-8 col-sm-6 col-xs-12">  
                <input id="inputNoeartag" class="form-control col-md-7 col-xs-12" name="inputNoeartag" placeholder="input No Eartag" required="required" type="text" maxLength="3" onkeyup="validAngkatelp(this)" value="<?=$data_customer[0]['no_eartag'];?>"readonly autocomplete="off">
              </div>
            </div>
            <div class="item form-group">
              <label class="control-label col-md-2 col-sm-3 col-xs-12" for="inputNoeartag">Nama Ketegori <span class="required"></span></label>
              <div class="col-md-8 col-sm-6 col-xs-12">  
                <input id="inputNoeartag" class="form-control col-md-7 col-xs-12" name="inputNoeartag" placeholder="input No Eartag" required="required" type="text" maxLength="3" onkeyup="validAngkatelp(this)" value="<?=$data_customer[0]['nama_kategori'];?>"readonly autocomplete="off">
              </div>
            </div>
            <div class="item form-group">
              <label class="control-label col-md-2 col-sm-3 col-xs-12" for="inputNama">Nama Customer <span class="required">*</span></label>
              <div class="col-md-8 col-sm-6 col-xs-12">  
                <input id="inputNama" class="form-control col-md-7 col-xs-12" name="inputNama" placeholder="input Nama Customer" required="required" type="text" value="<?=$data_customer[0]['nama_customer'];?>" onfocus="(this.value=='<?= $data_customer[0]['nama_customer'];?>') && (this.value='')" onblur="(this.value=='') && (this.value='<?= $data_customer[0]['nama_customer'];?>')" autocomplete="off">
              </div>
            </div>
            <div class="item form-group">
              <label class="control-label col-md-2 col-sm-3 col-xs-12" for="inputAlamat">Alamat Customer <span class="required">*</span></label>
              <div class="col-md-8 col-sm-6 col-xs-12">  
                <textarea id="inputAlamat" name="inputAlamat" class="form-control col-md-7 col-xs-12" placeholder="input alamat" required="required" onfocus="(this.value=='<?=$data_customer[0]['alamat_customer'];?>') && (this.value='')" onblur="(this.value=='') && (this.value='<?=$data_customer[0]['alamat_customer'];?>')" autocomplete="off"><?=$data_customer[0]['alamat_customer'];?></textarea>
              </div>
            </div>
            <div class="item form-group">
              <label class="control-label col-md-2 col-sm-3 col-xs-12" for="inputNotelp">No Telp Customer <span class="required">*</span></label>
              <div class="col-md-8 col-sm-6 col-xs-12">  
                <input id="inputNotelp" class="form-control col-md-7 col-xs-12" name="inputNotelp" placeholder="input No Telp Customer" required="required" type="text" value="<?=$data_customer[0]['no_telp_customer'];?>" onfocus="(this.value=='<?= $data_customer[0]['no_telp_customer'];?>') && (this.value='')" onblur="(this.value=='') && (this.value='<?= $data_customer[0]['no_telp_customer'];?>')" maxLength="15" onkeyup="validAngkatelp(this)" autocomplete="off">
              </div>
            </div>
            <div class="item form-group">
              <label class="control-label col-md-2 col-sm-3 col-xs-12">Jenis Bayar <span class="required">*</span></label>
              <div class="col-md-0 col-sm-0 col-xs-8">
                <select name="selectTypebayar" id="selectTypebayar" class="form-control col-md-7 col-xs-12 Typebayar">
                  <?php if($data_customer[0]['type_bayar'] == 0){ ?>
                    <option value="#" disabled>---Pilih---</option>
                  <?php }elseif($data_customer[0]['type_bayar'] > 0){ ?>
                    <option value="<?=$data_customer[0]['type_bayar'];?>" selected><?php if($data_customer[0]['type_bayar'] == 1){echo"DP";}elseif($data_customer[0]['type_bayar'] == 2){echo"LUNAS";} ?></option>
                  <?php } ?>
                  <option value="1">DP</option>
                  <option value="2">LUNAS</option>
                </select>
              </div>
            </div>
            <div class="item form-group">
              <label class="control-label col-md-2 col-sm-3 col-xs-12" for="inputJml">Jumlah Bayar <span class="required">*</span></label>
              <div class="col-md-8 col-sm-6 col-xs-12">  
                <input id="inputJml" class="form-control col-md-7 col-xs-12 inputJml" name="inputJml" placeholder="input Jumlah Bayar" required="required" type="text" value="<?=$data_customer[0]['jml'];?>" readonly autocomplete="off">
              </div>
            </div>
            <div class="item form-group">
              <label class="control-label col-md-2 col-sm-3 col-xs-12" for="inputTglpengiriman">Tanggal Pengiriman <span class="required">*</span></label>
              <div class="col-md-8 col-sm-6 col-xs-12">  
                <input id="inputTglpengiriman" class="form-control col-md-7 col-xs-12 inputTglpengiriman" name="inputTglpengiriman" placeholder="input Tanggal Pengiriman" required="required" type="text" value="<?=$data_customer[0]['tanggal_pengiriman'];?>">
              </div>
            </div>
            <div class="form-group">
              <div class="col-md-3 col-md-offset-2">
                <button type="reset" class="btn btn-primary">Batal</button>
                <button type="submit" class="btn btn-success">Simpan</button>
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
<script src="<?=base_url('assets/')?>vendors/jquery/dist/jquery.min.js"></script>
<script type="text/javascript">
  $('.Typebayar').change(function(){
    let tipe = this.value;
    let harga = $('.hargatotal').attr('data-harga');
    let DP = (harga/100)*20; 
    var inputJml = document.getElementById("inputJml");
    if(tipe == 1){
      inputJml.value = formatRupiah(DP);
    }else if(tipe == 2){
      inputJml.value = formatRupiah(harga);
    }
  });

  function formatRupiah(num)
  {
    return num.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1.")
  }
</script>