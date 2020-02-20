<!-- page content -->
<div class="right_col" role="main">
  <div align="right" style="font-weight: bold; font-size: 20px; font-family: cursive;"><?php $this->load->view('tampilan/jam_aktif'); ?></div>
  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel">
        <div class="x_title">
          <h2>Tambah Catalog</h2>
          <div class="nav navbar-right panel_toolbox">
              <a href="<?=base_url('compro')?>" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="bottom" title="Kembali"><i class="fa fa-reply"></i> Kembali</a>
          </div>
          <div class="clearfix"></div>
        </div>
        <div class="x_content">
          <form action="<?=base_url('savecomprocatalog')?>" method="POST" enctype="multipart/form-data" class="form-horizontal form-label-left">
            <div class="item form-group">
              <label class="control-label col-md-2 col-sm-3 col-xs-12" for="selectKategori">Kategori <span class="required">*</span></label>
              <div class="col-md-8 col-sm-6 col-xs-12">  
                <select id="selectKategori" class="form-control col-md-7 col-xs-12" name="selectKategori" required>
                  <option value="" selected disabled>--- Kategori ---</option>
                  <?php foreach ($data_kategori as $kategori) { ?>
                    <option value="<?=$kategori['id_kategori']?>"><?=$kategori['nama_kategori']?></option>
                  <?php } ?>
                </select>
              </div>
            </div>
            <div class="item form-group">
              <div class="col-md-3 col-sm-6 col-xs-12">
                <?php 
                  $DataEartag=$this->db->query("SELECT * FROM tbl_catalog ORDER BY id_catalog DESC LIMIT 1");
                  if($DataEartag->num_rows() > 0){ 
                    $noEartag = $DataEartag->result_array();
                    $last = $noEartag[0]['no_eartag'];
                    $lastNoEartag = substr($last, 0, 3);
                    $Last_no_eartag = $lastNoEartag + 1;
                    $no_eartag = sprintf('%03s', $Last_no_eartag);
                  }else{
                    $no_eartag = "001";
                  }
                ?>
                <label for="inputNoeartag">No Eartag <span class="required">*</span></label>
                <input id="inputNoeartag" class="form-control col-md-7 col-xs-12" name="inputNoeartag" placeholder="input No Eartag" required="required" type="text" maxLength="3" onkeyup="validAngkatelp(this)" value="<?=$no_eartag?>" autocomplete="off" readonly>
              </div>
              <div class="col-md-3 col-sm-6 col-xs-12">
                <label for="inputBobot">Bobot Hewan <span class="required">*</span></label>
                <input id="inputBobot" class="form-control col-md-7 col-xs-12" name="inputBobot" placeholder="input Bobot Hewan (Kg)" required="required" type="text" maxLength="5" onkeyup="validAngkatelp(this)" autocomplete="off">
              </div>
              <div class="col-md-3 col-sm-6 col-xs-12">
                <label for="inputUsia">Usia Hewan <span class="required">*</span></label>
                <input id="inputUsia" class="form-control col-md-7 col-xs-12" name="inputUsia" placeholder="input Usia Hewan" required="required" type="text" autocomplete="off">
              </div>
              <div class="col-md-3 col-sm-6 col-xs-12">
                <label for="inputHarga">Harga/Kg <span class="required">*</span></label>
                <input id="inputHarga" class="form-control col-md-7 col-xs-12" name="inputHarga" placeholder="input Harga/Kg" required="required" type="text" maxLength="6" onkeyup="validAngkatelp(this)" autocomplete="off">
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