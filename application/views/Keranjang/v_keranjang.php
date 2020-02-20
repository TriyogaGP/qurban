<!-- page content -->
<?php if($data_keranjang->num_rows() > 0){ ?>
	<div class="right_col" role="main">
	  <div align="right" style="font-weight: bold; font-size: 20px; font-family: cursive;"><?php $this->load->view('tampilan/jam_aktif'); ?></div>
	  <div class="row">
	  	<div class="col-md-12 col-sm-12 col-xs-12">
	      <div class="x_panel">
	        <div class="x_title">
	          <h2>Data Keranjang Bulan <?php date_default_timezone_set("Asia/Jakarta"); $bulan = tanggal_indo(date("m")); echo $bulan;?></h2>
	          <div class="nav navbar-right panel_toolbox">
					    <?php if($this->session->userdata('ses_level') == 3){ ?>
	          		<a href="<?=base_url('compro')?>" class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="bottom" title="Lihat Catalog"><i class="fa fa-eye"></i> Lihat Catalog</a>
	          	<?php } ?>
	          </div>
	          <div class="clearfix"></div>
	        </div>
	        <div class="x_content">
	        	<div id="loadkeranjang">
	        		<?php $this->load->view('Keranjang/view_keranjang'); ?>
	          </div>
	        </div>
	      </div>
	    </div>
	  </div>
	</div>
<?php }else{$this->session->set_flashdata('info', 'Keranjang kosong !!! Terimakasih ..'); redirect('compro');} ?>
<!-- /page content -->
<?php 
	function tanggal_indo($tanggal)
	{
	    $bulan = array (1 =>   'Januari',
	          'Februari',
	          'Maret',
	          'April',
	          'Mei',
	          'Juni',
	          'Juli',
	          'Agustus',
	          'September',
	          'Oktober',
	          'November',
	          'Desember'
	        );
	    // $split = explode('-', $tanggal);
	    $split = $tanggal;
	    return $bulan[ (int)$split[1] ];
	}
?>
