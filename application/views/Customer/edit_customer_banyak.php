<!-- page content -->
<div class="right_col" role="main">
  <div align="right" style="font-weight: bold; font-size: 20px; font-family: cursive;"><?php $this->load->view('tampilan/jam_aktif'); ?>
  <br><br>
  <a href="<?=base_url('customer')?>" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="bottom" title="Kembali"><i class="fa fa-reply"></i> Kembali</a>
  </div>
  <form action="<?=base_url('updatecustomerbanyak')?>" method="POST" enctype="multipart/form-data" class="form-horizontal form-label-left">
    <div class="row">
      <?php if($data_customer->num_rows()>1){$cssstyle="col-md-6";}else{$cssstyle="col-md-12";} ?>
      <?php $no=1;foreach ($data_customer->result_array() as $value) { ?>
        <?php $total = $value['harga'] * $value['bobot']; ?>
        <input type="hidden" id="catalog_id" name="catalog_id[]" value="<?= $value['id_catalog'];?>">
        <input type="hidden" id="harga" name="harga[]" value="<?= $total;?>">
        <div class="<?=$cssstyle?> col-sm-12 col-xs-12">
          <div class="x_panel">
            <div class="x_title">
              <h2>Data Pesanan Hewan Qurban <?=$no++?></h2>
              <div class="nav navbar-right panel_toolbox">
              </div>
              <div class="clearfix"></div>
            </div>
            <div class="x_content">
              <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="inputNoeartag">No Eartag <span class="required"></span></label>
                <div class="col-md-9 col-sm-6 col-xs-12">  
                  <input id="inputNoeartag" class="form-control col-md-7 col-xs-12" name="inputNoeartag[]" placeholder="input No Eartag" required="required" type="text" maxLength="3" onkeyup="validAngkatelp(this)" value="<?=$value['no_eartag'];?>"readonly autocomplete="off">
                </div>
              </div>
              <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="inputNoeartag">Nama Ketegori <span class="required"></span></label>
                <div class="col-md-9 col-sm-6 col-xs-12">  
                  <input id="inputNoeartag" class="form-control col-md-7 col-xs-12" name="inputNoeartag[]" placeholder="input No Eartag" required="required" type="text" maxLength="3" onkeyup="validAngkatelp(this)" value="<?=$value['nama_kategori'];?>"readonly autocomplete="off">
                </div>
              </div>
              <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">Jenis Bayar <span class="required">*</span></label>
                <div class="col-md-0 col-sm-0 col-xs-8">
                  <select name="selectTypebayar[]" id="selectTypebayar" data-catalogID="<?= $value['id_catalog'];?>" class="form-control col-md-9 col-xs-12 Typebayar">
                    <option value="#" selected disabled>---Pilih---</option>
                    <option value="1 <?= $value['id_catalog'];?> <?= $total;?>">DP</option>
                    <option value="2 <?= $value['id_catalog'];?> <?= $total;?>">LUNAS</option>
                  </select>
                </div>
              </div>
              <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="inputJml">Jumlah Bayar <span class="required">*</span></label>
                <div class="col-md-9 col-sm-6 col-xs-12">  
                  <input id="inputJml[<?= $value['id_catalog'];?>]" class="form-control col-md-7 col-xs-12 inputJml" name="inputJml[]" placeholder="input Jumlah Bayar" required="required" type="text" value="<?=$value['jml'];?>" readonly autocomplete="off">
                </div>
              </div>
              <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="inputTglpengiriman">Tanggal Pengiriman <span class="required">*</span></label>
                <div class="col-md-9 col-sm-6 col-xs-12">  
                  <input id="inputTglpengiriman" class="form-control col-md-7 col-xs-12 inputpengiriman" name="inputTglpengiriman[]" placeholder="input Tanggal Pengiriman" required="required" type="text" value="<?=$value['tanggal_pengiriman'];?>">
                </div>
              </div>
              <b>* Required (Harus di isi)</b>
            </div>
          </div>
        </div>
      <?php } ?>
    </div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Ubah Data Biodata Customer</h2>
            <div class="nav navbar-right panel_toolbox">
            </div>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <div class="item form-group">
              <label class="control-label col-md-2 col-sm-3 col-xs-12" for="inputNama">Nama Customer <span class="required">*</span></label>
              <div class="col-md-8 col-sm-6 col-xs-12">  
                <input id="inputNama" class="form-control col-md-7 col-xs-12" name="inputNama[]" placeholder="input Nama Customer" required="required" type="text" autocomplete="off">
              </div>
            </div>
            <div class="item form-group">
              <label class="control-label col-md-2 col-sm-3 col-xs-12" for="inputAlamat">Alamat Customer <span class="required">*</span></label>
              <div class="col-md-8 col-sm-6 col-xs-12">  
                <textarea id="inputAlamat" name="inputAlamat[]" class="form-control col-md-7 col-xs-12" placeholder="input alamat" required="required" autocomplete="off"></textarea>
              </div>
            </div>
            <div class="item form-group">
              <label class="control-label col-md-2 col-sm-3 col-xs-12" for="inputNotelp">No Telp Customer <span class="required">*</span></label>
              <div class="col-md-8 col-sm-6 col-xs-12">  
                <input id="inputNotelp" class="form-control col-md-7 col-xs-12" name="inputNotelp[]" placeholder="input No Telp Customer" required="required" type="text" maxLength="15" onkeyup="validAngkatelp(this)" autocomplete="off">
              </div>
            </div>
            <div class="form-group">
              <div class="col-md-3 col-md-offset-2">
                <button type="reset" class="btn btn-primary">Batal</button>
                <button type="submit" class="btn btn-success">Simpan</button>
              </div>
            </div>
            <b>* Required (Harus di isi)</b>
          </div>
        </div>
      </div>
  </div>
  </div>
</div>
<!-- /page content -->
<script src="<?=base_url('assets/')?>vendors/jquery/dist/jquery.min.js"></script>
<script type="text/javascript">
  $(document).ready(function(){
      $('.inputpengiriman').datetimepicker({
          format: 'YYYY-MM-DD',
      });
  });

  var i, j;
  $('.Typebayar').change(function(){
    nilaiPilihan = this.value;
    hasil = nilaiPilihan.split(" ");
    let tipe = hasil[0];
    let catalogID = hasil[1];
    let total = hasil[2];
    let DP = (total/100)*20; 
    var inputJml = document.getElementById("inputJml["+catalogID+"]");
    if(tipe == 1){
      inputJml.value = formatRupiah(DP);
    }else if(tipe == 2){
      inputJml.value = formatRupiah(total);
    }
  });

  function formatRupiah(num)
  {
    return num.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1.")
  }
</script>