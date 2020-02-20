        <!-- page catalog -->
        <div class="right_col" role="main">
          <div align="right" style="font-weight: bold; font-size: 20px; font-family: cursive;"><?php $this->load->view('tampilan/jam_aktif'); ?></div>
          <?php if($this->session->userdata('ses_level') != 3){ ?>
            <div class="row">
            	<div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Data Kategori<small>Tambah Ubah Hapus</small></h2>
                    <div class="nav navbar-right panel_toolbox">
                    		<a href="<?=base_url('addcomprokategori')?>" class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="bottom" title="tambah data"><i class="fa fa-plus"></i> Tambah Data</a>
                    </div>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_catalog">
                    <table id="Datakategori" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                      <thead>
                        <tr>
                          <th>Jenis</th>
                          <th>Kategori</th>
                          <th width="5%">Actived</th>
                          <th width="10%">Opsi</th>
                        </tr>
                      </thead>
                      <tbody>
                      	<?php foreach ($data_kategori as $value_kategori) { ?>
  	                      <tr>
  	                        <td><?php if($value_kategori['jenis'] == 1){echo"Sapi";}else{echo"Kambing";}?></td>
  	                        <td><?=$value_kategori['nama_kategori']?></td>
  	                        <td align="center">
                              <div class="onoffswitchKategori">
                                <input type="hidden" value="<?=$value_kategori['id_kategori'];?>"/>
                                <input type="checkbox" class="js-switch" <?php if($value_kategori['aktif_state'] == 1){echo"checked";}else{echo"unchecked";}?>/>&nbsp;
                              </div>
                            </td>
  	                        <td align="center">
                    					<a href="<?=base_url('editcomprokategori/').$value_kategori['id_kategori']?>" class="btn btn-info btn-xs" data-toggle="tooltip" data-placement="top" title="ubah data"><i class="fa fa-edit"></i></a>
                    					<a href="<?=base_url('deletecomprokategori/').$value_kategori['id_kategori']?>" class="btn btn-danger btn-xs" data-toggle="tooltip" data-placement="top" title="hapus data"><i class="fa fa-remove"></i></a>
  	                        </td>
  	                      </tr>
  	                    <?php } ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          <?php } ?>

          <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="x_panel">
                <div class="x_title">
                  <h2>Data Catalog<small>Tambah Ubah Hapus</small></h2>
                  <?php if($this->session->userdata('ses_level') != 3){ ?>
                    <div class="nav navbar-right panel_toolbox">
                        <a href="<?=base_url('addcomprocatalog')?>" class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="bottom" title="tambah data"><i class="fa fa-plus"></i> Tambah Data</a>
                    </div>
                  <?php } ?>
                  <div class="clearfix"></div>
                </div>
                <div class="x_catalog">
                  <table id="Datacatalog" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                    <thead>
                      <tr>
                        <th width="15%">Kategori</th>
                        <th width="5%">No_eartag</th>
                        <th width="10%">Bobot</th>
                        <th>Usia</th>
                        <th width="15%">Harga</th>
                        <th width="15%">Status</th>
                        <?php if($this->session->userdata('ses_level') != 3){ ?>
                          <th width="5%">Actived</th>
                        <?php } ?>
                        <th width="5%">Opsi</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach ($data_catalog as $value_catalog) { ?>
                        <tr>
                          <td><?=$value_catalog['nama_kategori']?></td>
                          <td><?=$value_catalog['no_eartag']?></td>
                          <td><?=$value_catalog['bobot']." Kg";?></td>
                          <td><?=$value_catalog['usia']?></td>
                          <td><?="Rp. ".number_format($value_catalog['harga'],2)." /Kg";?></td>
                          <?php 
                            $total_jml = 0;
                            $jmlCatalogKeranjang = $this->Dashboard_model->get_total_keranjangBY($value_catalog['id_catalog']); 
                            foreach ($jmlCatalogKeranjang->result_array() as $value1) {
                              $total_jml += $value1['jml'];
                            }
                          ?>
                          <td align="center">
                            <!-- <?php if($value_catalog['status_sale'] == 0){$style="alert-success";$tulisan="Belum Terjual";}elseif($value_catalog['status_sale'] == 1){$style="alert-warning";$tulisan="Dipesan";}elseif($value_catalog['status_sale'] == 2){$style="alert-danger";$tulisan="Sudah Terjual";} ?> -->
                            <?php if($value_catalog['status_sale'] == 0){?>
                              <img src="<?=base_url('assets/images/ordernow.png')?>" width="40%" data-toggle="tooltip" data-placement="top" title="Belum dipesan">
                            <?php }elseif($value_catalog['status_sale'] == 1){?>
                              <img src="<?=base_url('assets/images/reserved.png')?>" width="60%" data-toggle="tooltip" data-placement="top" title="Dipesan (<?=$total_jml.' orang'?>)">
                            <?php }elseif($value_catalog['status_sale'] == 2){?>
                              <img src="<?=base_url('assets/images/paid.png')?>" width="60%" data-toggle="tooltip" data-placement="top" title="Proses Pembayaran">
                            <?php }elseif($value_catalog['status_sale'] == 3){?>
                              <img src="<?=base_url('assets/images/verified.png')?>" width="70%" data-toggle="tooltip" data-placement="top" title="Proses Pembayaran">
                            <?php }elseif($value_catalog['status_sale'] == 4){?>
                              <img src="<?=base_url('assets/images/approved.png')?>" width="70%" data-toggle="tooltip" data-placement="top" title="Proses Pembayaran">
                            <?php }elseif($value_catalog['status_sale'] == 5){?>
                              <img src="<?=base_url('assets/images/soldout.png')?>" width="70%" data-toggle="tooltip" data-placement="top" title="Proses Pembayaran">
                            <?php } ?>
                            <!-- <div class="<?=$style?>" style="font-size: 12px; text-align: center; font-weight: bold; border-radius: 5px; height: 25px; padding-top: 5px; padding-right: 5px; padding-left: 5px; color: black;" data-toggle="tooltip" data-placement="top" title="Reseller Book"><?=$tulisan?> -->
                            <!-- <?php if($value_catalog['status_sale'] == 1){echo " ".$total_jml." orang";} ?> -->
                            <!-- </div> -->
                          </td>
                          <?php if($this->session->userdata('ses_level') != 3){ ?>
                            <td align="center">
                              <div class="onoffswitchCatalog">
                                <input type="hidden" value="<?=$value_catalog['id_catalog'];?>"/>
                                <input type="checkbox" class="js-switch" <?php if($value_catalog['status_sale'] == 0){echo"";}elseif($value_catalog['status_sale'] == 1){echo"disabled='disabled'";}elseif($value_catalog['status_sale'] == 2){echo"disabled='disabled'";}elseif($value_catalog['status_sale'] == 3){echo"disabled='disabled'";}elseif($value_catalog['status_sale'] == 4){echo"disabled='disabled'";}elseif($value_catalog['status_sale'] == 5){echo"disabled='disabled'";} ?> <?php if($value_catalog['aktif_state'] == 1){echo"checked";}else{echo"unchecked";}?>/>&nbsp;
                              </div>
                            </td>
                          <?php } ?>
                          <td align="center">
                            <?php if($this->session->userdata('ses_level') != 3){ ?>
                              <a href="<?=base_url('editcomprocatalog/').$value_catalog['id_catalog']."/".$value_catalog['id_kategori']?>" class="btn btn-info btn-xs" data-toggle="tooltip" data-placement="top" title="ubah data"><i class="fa fa-edit"></i></a>
                              <a href="<?=base_url('deletecomprocatalog/').$value_catalog['id_catalog']?>" class="btn btn-danger btn-xs" data-toggle="tooltip" data-placement="top" title="hapus data"><i class="fa fa-remove"></i></a>
                            <?php } ?>
                            <?php if($value_catalog['status_sale'] == 0 || $value_catalog['status_sale'] == 1){?>
                              <a href="<?=base_url('addkeranjang/').$value_catalog['id_catalog']."/".$this->session->userdata('ses_idadmin')?>" class="btn btn-success btn-xs" data-toggle="tooltip" data-placement="top" title="Tambah Keranjang"><i class="fa fa-shopping-cart"></i></a>
                            <?php }else{ ?>
                              <a href="#" class="btn btn-success btn-xs" data-toggle="tooltip" data-placement="top" title="Tambah Keranjang" disabled><i class="fa fa-shopping-cart"></i></a>
                            <?php } ?>
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
        <!-- /page catalog -->