        <?php date_default_timezone_set("Asia/Jakarta"); $tahun = date("Y");?>
        <!-- footer content -->
        <footer>
          <div class="pull-right">
            <p>©<?= $tahun?> All Rights Reserved. <?=constant('TITLE')?></p>
          </div>
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
      </div>
    </div>

    <?php $this->load->view('tampilan/js'); ?>
	
  </body>
</html>