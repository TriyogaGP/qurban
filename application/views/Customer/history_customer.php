<!-- page content -->
<div class="right_col" role="main">
  <div align="right" style="font-weight: bold; font-size: 20px; font-family: cursive;"><?php $this->load->view('tampilan/jam_aktif'); ?></div>
  <div class="row">
  	<div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel">
        <div class="x_title">
          <h2>Data Customer</h2>
          <div class="nav navbar-right panel_toolbox">
          </div>
          <div class="clearfix"></div>
        </div>
        <div class="x_content">
        	<div class="form-horizontal form-label-left">
            <div class="item form-group">
              <div class="col-md-2 col-sm-6 col-xs-12">  
                <input id="dari" class="form-control col-md-7 col-xs-12 dari" name="dari" placeholder="Dari" type="text">
              </div>
              <div class="col-md-1 col-sm-6 col-xs-12">
                <div align="center" style="margin-top: 7px;">sampai</div>  
              </div>
              <div class="col-md-2 col-sm-6 col-xs-12">  
                <input id="ke" class="form-control col-md-7 col-xs-12 ke" name="ke" placeholder="ke" type="text">
              </div>
              <div class="col-md-3 col-sm-6 col-xs-12">  
                <button type="submit" class="btn btn-success lihatkeranjang" id="lihatkeranjang"><i class="fa fa-eye"></i> Lihat</button>
                <button type="submit" class="btn btn-danger batalkeranjang" id="batalkeranjang"><i class="fa fa-remove"></i> batal</button>
              </div>
            </div>
          </div>
          <div class="hasilcustomer"></div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- /page content -->