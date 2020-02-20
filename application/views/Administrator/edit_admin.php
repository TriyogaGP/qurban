<style type="text/css">
  .field-icon {
    float: right;
    margin-right: 10px;
    margin-top: -33px;
    position: relative;
    z-index: 2;
  }
  .field-icon2 {
    float: right;
    margin-right: 10px;
    margin-top: -23px;
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
          <h2>Ubah Administrator & Reseller</h2>
          <div class="nav navbar-right panel_toolbox">
              <a href="<?=base_url('admin')?>" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="bottom" title="Kembali"><i class="fa fa-reply"></i> Kembali</a>
          </div>
          <div class="clearfix"></div>
        </div>
        <div class="x_content">
          <form action="<?=base_url('updateadmin')?>" method="POST" enctype="multipart/form-data" class="form-horizontal form-label-left">
            <input type="hidden" id="admin_id" name="admin_id" value="<?= $data_admin[0]['id_reselleradmin'];?>">
            <div class="item form-group">
              <label class="control-label col-md-2 col-sm-3 col-xs-12" for="inputNama">Nama <span class="required">*</span></label>
              <div class="col-md-8 col-sm-6 col-xs-12">  
                <input id="inputNama" class="form-control col-md-7 col-xs-12" name="inputNama" placeholder="input Nama Lengkap" required="required" type="text" value="<?= $data_admin[0]['nama'];?>" onfocus="(this.value=='<?= $data_admin[0]['nama'];?>') && (this.value='')" onblur="(this.value=='') && (this.value='<?= $data_admin[0]['nama'];?>')" autocomplete="off">
              </div>
            </div>
            <div class="item form-group">
              <label class="control-label col-md-2 col-sm-3 col-xs-12" for="inputEmail">Email <span class="required">*</span></label>
              <div class="col-md-8 col-sm-6 col-xs-12">
                <input id="inputEmail" class="form-control col-md-7 col-xs-12" name="inputEmail" placeholder="input Email" required="required" type="email" value="<?= $data_admin[0]['email'];?>" onfocus="(this.value=='<?= $data_admin[0]['email'];?>') && (this.value='')" onblur="(this.value=='') && (this.value='<?= $data_admin[0]['email'];?>')" autocomplete="off">
              </div>
            </div>
            <div class="item form-group">
              <label class="control-label col-md-2 col-sm-3 col-xs-12" for="inputUsername">Username <span class="required">*</span></label>
              <div class="col-md-8 col-sm-6 col-xs-12">
                <input id="inputUsername" class="form-control col-md-7 col-xs-12" name="inputUsername" placeholder="input Username" required="required" type="text" value="<?= $data_admin[0]['username'];?>" onfocus="(this.value=='<?= $data_admin[0]['username'];?>') && (this.value='')" onblur="(this.value=='') && (this.value='<?= $data_admin[0]['username'];?>')" autocomplete="off">
              </div>
            </div>
            <div class="item form-group">
              <label class="control-label col-md-2 col-sm-3 col-xs-12" for="inputPassword">Kata Sandi <span class="required">*</span></label>
              <div class="col-md-5 col-sm-3 col-xs-12">
                <input id="inputPassword" class="form-control col-md-7 col-xs-12" name="inputPassword" placeholder="input Kata Sandi" type="password" onkeyup="passwordStrength(this.value)" autocomplete="off">
                <span toggle="#inputPassword" class="fa fa-fw fa-eye field-icon toggle-password"></span>
              </div>
              <div class="col-md-3 col-sm-6 col-xs-12">
                <div style="margin-top: 10px; font-weight: bold;" id="status"></div>
              </div>
            </div>
            <div class="item form-group">
              <label class="control-label col-md-2 col-sm-3 col-xs-12" for="inputTelepon">Telepon <span class="required">*</span></label>
              <div class="col-md-8 col-sm-6 col-xs-12">
                <input id="inputTelepon" class="form-control col-md-7 col-xs-12" name="inputTelepon" placeholder="input Telepon" type="text" required="required" maxLength="15" onkeyup="validAngkatelp(this)" value="<?= $data_admin[0]['no_telp'];?>" onfocus="(this.value=='<?= $data_admin[0]['no_telp'];?>') && (this.value='')" onblur="(this.value=='') && (this.value='<?= $data_admin[0]['no_telp'];?>')" autocomplete="off">
              </div>
            </div>
            <div class="item form-group">
              <label class="control-label col-md-2 col-sm-3 col-xs-12" for="inputAlamat">Alamat</span></label>
              <div class="col-md-8 col-sm-6 col-xs-12">
                <textarea id="inputAlamat" name="inputAlamat" class="form-control col-md-7 col-xs-12" placeholder="input alamat" onfocus="(this.value=='<?= $data_admin[0]['alamat'];?>') && (this.value='')" onblur="(this.value=='') && (this.value='<?= $data_admin[0]['alamat'];?>')"><?= $data_admin[0]['alamat'];?></textarea>
              </div>
            </div>
            <div class="item form-group">
              <label class="control-label col-md-2 col-sm-3 col-xs-12" for="file">Foto</label>
              <div class="col-md-8 col-sm-6 col-xs-12">
                <input id="foto" name="foto" placeholder="input Foto" class="form-control col-md-7 col-xs-12" type="file" disabled>
                <input id="nilai" name="nilai" value="1" class="form-control col-md-7 col-xs-12" type="hidden">
                <span type="button" id="checkshow" value="1" class="fa fa-eye field-icon2" data-toggle="tooltip" data-placement="top" title="aktifkan"></span>
                <span type="button" id="checkhide" value="0" class="fa fa-eye-slash field-icon2" style="display: none;" data-toggle="tooltip" data-placement="top" title="non aktifkan"></span>
                <br>
                <?php if(empty($data_admin[0]['foto'])){echo"<b>tidak ada foto</b>";}else{ ?>
                  <img src="<?= base_url('assets/images/gambar_user/').$gambar;?>" width="5%" title="<?= $nama?>">
                <?php } ?>
              </div>
            </div>
            <div class="item form-group">
              <label class="control-label col-md-2 col-sm-3 col-xs-12">Role ID <span class="required">*</span></label>
              <div class="col-md-0 col-sm-0 col-xs-6">
                <div class="radio">
                  <label><input type="radio" name="level" class="flat" value="1" <?php if($data_admin[0]['id_role'] == 1){echo "checked";}else{echo "unchecked";} ?>> Super Admin</label>
                  <label><input type="radio" name="level" class="flat" value="2" <?php if($data_admin[0]['id_role'] == 2){echo "checked";}else{echo "unchecked";} ?>> Administrator</label>
                  <label><input type="radio" name="level" class="flat" value="3" <?php if($data_admin[0]['id_role'] == 3){echo "checked";}else{echo "unchecked";} ?>> Reseller</label>
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="col-md-3 col-md-offset-2">
                <button type="reset" class="btn btn-primary">Batal</button>
                <button type="submit" class="btn btn-success">Ubah</button>
              </div>
            </div>
            <b>* Required (Harus di isi kecuali kata sandi, kosongkan jika tidak ingin diubah)</b>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- /page content -->