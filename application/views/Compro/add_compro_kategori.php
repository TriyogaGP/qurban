<!-- page content -->
<div class="right_col" role="main">
  <div align="right" style="font-weight: bold; font-size: 20px; font-family: cursive;"><?php $this->load->view('tampilan/jam_aktif'); ?></div>
  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel">
        <div class="x_title">
          <h2>Tambah Kategori</h2>
          <div class="nav navbar-right panel_toolbox">
              <a href="<?=base_url('compro')?>" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="bottom" title="Kembali"><i class="fa fa-reply"></i> Kembali</a>
          </div>
          <div class="clearfix"></div>
        </div>
        <div class="x_content">
          <form action="<?=base_url('savecomprokategori')?>" method="POST" enctype="multipart/form-data" class="form-horizontal form-label-left">
            <div class="item form-group">
              <label class="control-label col-md-2 col-sm-3 col-xs-12" for="inputKategori">Nama Kategori <span class="required">*</span></label>
              <div class="col-md-8 col-sm-6 col-xs-12">
                <input id="inputKategori" class="form-control col-md-7 col-xs-12" name="inputKategori" placeholder="input Nama Kategori" required="required" type="text" autocomplete="off">
              </div>
            </div>
            <div class="item form-group">
              <label class="control-label col-md-2 col-sm-3 col-xs-12">Jenis Hewan <span class="required">*</span></label>
              <div class="col-md-0 col-sm-0 col-xs-6">
                <div class="radio">
                  <label><input type="radio" name="jenis" class="flat" value="1" checked> Sapi</label>
                  <label><input type="radio" name="jenis" class="flat" value="2"> Kambing</label>
                </div>
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