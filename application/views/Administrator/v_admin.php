<!-- page content -->
<div class="right_col" role="main">
  <div align="right" style="font-weight: bold; font-size: 20px; font-family: cursive;"><?php $this->load->view('tampilan/jam_aktif'); ?></div>
  <div class="row">
  	<div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel">
        <div class="x_title">
          <h2>Data Administrator & Reseller<small>Tambah Ubah Hapus</small></h2>
          <div class="nav navbar-right panel_toolbox">
          		<a href="<?=base_url('addadmin')?>" class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="bottom" title="tambah data"><i class="fa fa-plus"></i> Tambah Data</a>
          </div>
          <div class="clearfix"></div>
        </div>
        <div class="x_content">
          <table id="Dataadmin" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
					  <thead>
					    <tr>
					      <th>Nama</th>
					      <th>Email</th>
					      <th width="5%">Actived</th>
					      <th width="10%">Opsi</th>
					    </tr>
					  </thead>
					  <tbody>
					  	<?php foreach ($data_admin as $value) { ?>
					      <tr>
					        <td><?=$value['nama']?></td>
					        <td><?=$value['email']?></td>
					        <td align="center">
					        	<div class="onoffswitchAdmin">
					        		<input type="hidden" value="<?=$value['id_reselleradmin'];?>"/>
					        		<input type="checkbox" class="js-switch" <?php if($value['aktif_state'] == 1){echo"checked";}else{echo"unchecked";}?>/>&nbsp;
					        	</div>
					        </td>
					        <td align="center">
										<a href="<?= base_url('editadmin/').$value['id_reselleradmin'];?>" class="btn btn-success btn-xs" data-toggle="tooltip" data-placement="top" title="ubah data"><i class="fa fa-edit"></i></a>
										<a href="<?= base_url('deleteadmin/').$value['id_reselleradmin'];?>" class="btn btn-danger btn-xs" data-toggle="tooltip" data-placement="top" title="hapus data" onclick="return confirm('Anda yakin menghapus data ini?')"><i class="fa fa-remove"></i></a>
										<a href="<?= base_url('detailadmin/').$value['id_reselleradmin'];?>" id="detail_admin" data-toggle="modal" data-target="#modal_detail_admin" class="btn btn-info btn-xs" title="lihat data"><i class="fa fa-search"></i></a>
					        </td>
					      </tr>
					    <?php } ?>
					  </tbody>
					</table>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- /page content -->
<div class="modal fade" id="modal_detail_admin" tabindex="-1" role="dialog" aria-labelledby="largeModal3" aria-hidden="true"></div>