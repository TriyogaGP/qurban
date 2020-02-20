<div class="modal-dialog">
  <div class="modal-content">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
        <h4 class="modal-title" id="myModalLabel">Detail Data Administrator & Reseller</h4>
    </div>
    <div class="modal-body">
      <div align="center">
        <?php if(!empty($data_admin[0]['foto']) || $data_admin[0]['foto'] != NULL){ ?>
          <img src="<?= base_url('assets/images/gambar_user/').$data_admin[0]['foto'];?>" width="25%" title="<?= $data_admin[0]['nama']?>">
        <?php }else{ ?>
          <img src="<?= base_url('assets/production/images/user.png');?>" width="25%" title="Tidak ada Foto">
        <?php } ?>
      </div>
      <table width="100%">
        <tr>
          <td width="30%">Nama Lengkap</td>
          <td>: <?= $data_admin[0]['nama']?></td>
        </tr>
        <tr>
          <td width="30%">Email</td>
          <td>: <?= $data_admin[0]['email']?></td>
        </tr>
        <tr>
          <td width="30%">Username</td>
          <td>: <?= $data_admin[0]['username']?></td>
        </tr>
        <tr>
          <td width="30%">Kata Sandi</td>
          <td>: <?= $data_admin[0]['password']?></td>
        </tr>
        <tr>
          <td width="30%">Telepon</td>
          <td>: <?= $data_admin[0]['no_telp']?></td>
        </tr>
        <tr>
          <td width="30%">Alamat</td>
          <td>: <?php if(!empty($data_admin[0]['alamat'])){echo $data_admin[0]['alamat'];}else{echo "-";} ?></td>
        </tr>
      </table>
    </div>
  </div>
</div>