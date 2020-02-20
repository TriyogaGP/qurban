<style type="text/css">
  .field-icon {
    float: right;
    margin-right: 10px;
    margin-top: -33px;
    position: relative;
    z-index: 2;
  }
</style>
<!-- page content -->
<div class="right_col" role="main">
  <div align="right" style="font-weight: bold; font-size: 20px; font-family: cursive;"><?php $this->load->view('tampilan/jam_aktif'); ?></div>
  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel">
        <div class="x_title">
          <h2>Tambah Administrator & Reseller</h2>
          <div class="nav navbar-right panel_toolbox">
              <a href="<?=base_url('admin')?>" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="bottom" title="Kembali"><i class="fa fa-reply"></i> Kembali</a>
          </div>
          <div class="clearfix"></div>
        </div>
        <div class="x_content">
          <form action="<?=base_url('saveadmin')?>" method="POST" enctype="multipart/form-data" class="form-horizontal form-label-left">
            <div class="item form-group">
              <label class="control-label col-md-2 col-sm-3 col-xs-12" for="inputNama">Nama <span class="required">*</span></label>
              <div class="col-md-8 col-sm-6 col-xs-12">  
                <input id="inputNama" class="form-control col-md-7 col-xs-12" name="inputNama" placeholder="input Nama Lengkap" required="required" type="text" autocomplete="off">
              </div>
            </div>
            <div class="item form-group">
              <label class="control-label col-md-2 col-sm-3 col-xs-12" for="inputEmail">Email <span class="required">*</span></label>
              <div class="col-md-8 col-sm-6 col-xs-12">
                <input id="inputEmail" class="form-control col-md-7 col-xs-12" name="inputEmail" placeholder="input Email" required="required" type="email" autocomplete="off">
              </div>
            </div>
            <div class="item form-group">
              <label class="control-label col-md-2 col-sm-3 col-xs-12" for="inputUsername">Username <span class="required">*</span></label>
              <div class="col-md-8 col-sm-6 col-xs-12">
                <input id="inputUsername" class="form-control col-md-7 col-xs-12" name="inputUsername" placeholder="input Username" required="required" type="text" autocomplete="off">
              </div>
            </div>
            <div class="item form-group">
              <label class="control-label col-md-2 col-sm-3 col-xs-12" for="inputPassword">Kata Sandi <span class="required">*</span></label>
              <div class="col-md-5 col-sm-3 col-xs-12">
                <input id="inputPassword" class="form-control col-md-7 col-xs-12" name="inputPassword" placeholder="input Kata Sandi" required="required" type="password" onkeyup="passwordStrength(this.value)" autocomplete="off">
                <span toggle="#inputPassword" class="fa fa-fw fa-eye field-icon toggle-password"></span>
              </div>
              <div class="col-md-3 col-sm-6 col-xs-12">
                <div style="margin-top: 10px; font-weight: bold;" id="status"></div>
              </div>
            </div>
            <div class="item form-group">
              <label class="control-label col-md-2 col-sm-3 col-xs-12" for="inputTelepon">Telepon <span class="required">*</span></label>
              <div class="col-md-8 col-sm-6 col-xs-12">
                <input id="inputTelepon" class="form-control col-md-7 col-xs-12" name="inputTelepon" placeholder="input Telepon" type="text" required="required" maxLength="15" onkeyup="validAngkatelp(this)" autocomplete="off">
              </div>
            </div>
            <div class="item form-group">
              <label class="control-label col-md-2 col-sm-3 col-xs-12" for="inputAlamat">Alamat</span></label>
              <div class="col-md-8 col-sm-6 col-xs-12">
                <textarea id="inputAlamat" name="inputAlamat" class="form-control col-md-7 col-xs-12" placeholder="input alamat"></textarea>
              </div>
            </div>
            <div class="item form-group">
              <label class="control-label col-md-2 col-sm-3 col-xs-12" for="file">Foto</label>
              <div class="col-md-8 col-sm-6 col-xs-12">
                <input id="foto" name="foto" placeholder="input Foto" class="form-control col-md-7 col-xs-12" type="file">
              </div>
            </div>
            <div class="item form-group">
              <label class="control-label col-md-2 col-sm-3 col-xs-12">Role ID <span class="required">*</span></label>
              <div class="col-md-0 col-sm-0 col-xs-6">
                <div class="radio">
                  <label><input type="radio" name="level" class="flat" value="1"> Super Admin</label>
                  <label><input type="radio" name="level" class="flat" value="2"> Administrator</label>
                  <label><input type="radio" name="level" class="flat" value="3" checked> Reseller</label>
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