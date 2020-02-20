<!-- jQuery -->
<script src="<?=base_url('assets/')?>vendors/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="<?=base_url('assets/')?>vendors/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- FastClick -->
<script src="<?=base_url('assets/')?>vendors/fastclick/lib/fastclick.js"></script>
<!-- NProgress -->
<script src="<?=base_url('assets/')?>vendors/nprogress/nprogress.js"></script>
<!-- Chart.js -->
<script src="<?=base_url('assets/')?>vendors/Chart.js/dist/Chart.min.js"></script>
<!-- gauge.js -->
<script src="<?=base_url('assets/')?>vendors/gauge.js/dist/gauge.min.js"></script>
<!-- bootstrap-progressbar -->
<script src="<?=base_url('assets/')?>vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
<!-- iCheck -->
<script src="<?=base_url('assets/')?>vendors/iCheck/icheck.min.js"></script>
<!-- Skycons -->
<script src="<?=base_url('assets/')?>vendors/skycons/skycons.js"></script>
<!-- Flot -->
<script src="<?=base_url('assets/')?>vendors/Flot/jquery.flot.js"></script>
<script src="<?=base_url('assets/')?>vendors/Flot/jquery.flot.pie.js"></script>
<script src="<?=base_url('assets/')?>vendors/Flot/jquery.flot.time.js"></script>
<script src="<?=base_url('assets/')?>vendors/Flot/jquery.flot.stack.js"></script>
<script src="<?=base_url('assets/')?>vendors/Flot/jquery.flot.resize.js"></script>
<!-- Flot plugins -->
<script src="<?=base_url('assets/')?>vendors/flot.orderbars/js/jquery.flot.orderBars.js"></script>
<script src="<?=base_url('assets/')?>vendors/flot-spline/js/jquery.flot.spline.min.js"></script>
<script src="<?=base_url('assets/')?>vendors/flot.curvedlines/curvedLines.js"></script>
<!-- DateJS -->
<script src="<?=base_url('assets/')?>vendors/DateJS/build/date.js"></script>
<!-- JQVMap -->
<script src="<?=base_url('assets/')?>vendors/jqvmap/dist/jquery.vmap.js"></script>
<script src="<?=base_url('assets/')?>vendors/jqvmap/dist/maps/jquery.vmap.world.js"></script>
<script src="<?=base_url('assets/')?>vendors/jqvmap/examples/js/jquery.vmap.sampledata.js"></script>
<!-- bootstrap-daterangepicker -->
<script src="<?=base_url('assets/')?>vendors/moment/min/moment.min.js"></script>
<script src="<?=base_url('assets/')?>vendors/bootstrap-daterangepicker/daterangepicker.js"></script>
<!-- bootstrap-datetimepicker -->    
<script src="<?=base_url('assets/')?>vendors/bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js"></script>
<!-- PNotify -->
<script src="<?= base_url('assets/')?>vendors/pnotify/dist/pnotify.js"></script>
<script src="<?= base_url('assets/')?>vendors/pnotify/dist/pnotify.buttons.js"></script>
<script src="<?= base_url('assets/')?>vendors/pnotify/dist/pnotify.nonblock.js"></script>
<!-- Datatables -->
<script src="<?= base_url('assets/')?>vendors/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?= base_url('assets/')?>vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script src="<?= base_url('assets/')?>vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
<script src="<?= base_url('assets/')?>vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>
<script src="<?= base_url('assets/')?>vendors/datatables.net-buttons/js/buttons.flash.min.js"></script>
<script src="<?= base_url('assets/')?>vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
<script src="<?= base_url('assets/')?>vendors/datatables.net-buttons/js/buttons.print.min.js"></script>
<script src="<?= base_url('assets/')?>vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
<script src="<?= base_url('assets/')?>vendors/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
<script src="<?= base_url('assets/')?>vendors/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?= base_url('assets/')?>vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>
<script src="<?= base_url('assets/')?>vendors/datatables.net-scroller/js/dataTables.scroller.min.js"></script>
<script src="<?= base_url('assets/')?>vendors/jszip/dist/jszip.min.js"></script>
<script src="<?= base_url('assets/')?>vendors/pdfmake/build/pdfmake.min.js"></script>
<script src="<?= base_url('assets/')?>vendors/pdfmake/build/vfs_fonts.js"></script>
<!-- Switchery -->
<script src="<?= base_url('assets/')?>vendors/switchery/dist/switchery.min.js"></script>
<!-- Custom Theme Scripts -->
<script src="<?=base_url('assets/')?>build/js/custom.js"></script>
<script src="<?=base_url('assets/')?>ckeditor/ckeditor.js"></script>
<script src="<?=base_url('assets/')?>myscript.js"></script>
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> -->

<!-- <script type="text/javascript" src="<?= base_url('assets/')?>inc/TimeCircles.js"></script> -->
<!-- <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script> -->

<script type="text/javascript">
	$(document).ready(function(){
	    $('#inputTglpengiriman').datetimepicker({
	        format: 'YYYY-MM-DD',
	    });
	});

	$(document).ready(function(){
	    $('#dari').datetimepicker({
	        format: 'DD-MM-YYYY',
	    });
	});

	$(document).ready(function(){
	    $('#ke').datetimepicker({
	        format: 'DD-MM-YYYY',
	    });
	});

	// $(document).ready(function () {
	//     $('#Dataadmin').DataTable();
	//     $('#Datakategori').DataTable();
	//     $('#Datacatalog').DataTable();

	//     tampil_total_reseller();
	//     function tampil_total_reseller(){
	// 	    $.ajax({
	// 	        method: "GET",
	// 	        url   : "<?= base_url('lookkeranjangReseller'); ?>",
	// 	        dataType : 'json',
	// 	        success : function(data){
	// 	          	var html = '';
	// 	          	var i;
	// 	          	for(i=0; i<data.length; i++){
	// 	              	html += '<a href="#"><div data-toggle="tooltip" data-placement="top" title="Reseller Book">'+data[i].totalreseller+' Reseller Book</div></a>';
	// 	          	}
	// 	          	$('#showdata').html(html);
	// 	        }
	// 	    });
	//     }
	//     setInterval(function(){ 
	//       	tampil_total_reseller();
	//     }, 5000);
	//  });

	$(document).ready(function(){
	    setInterval(function(){
	        $("#loadkeranjang").load('<?php echo base_url('viewkeranjang')?>')
	    }, 5000);
	});

	$(document).ready(function(){
		let id_notifikasi = $('.ambilnotif').attr('data-idnotifikasi');
		console.log(id_notifikasi);
	    setInterval(function(){
	        $("#loadcustomer").load('<?php echo base_url('viewcustomer/')?>'+id_notifikasi)
	    }, 5000);
	});

	$(document).ready(function(){
		function notifAdmin()
		{
		  	$.ajax({
			   	method:"GET",
		   		url:"<?= base_url('getnotifAdmin'); ?>",
			   	// data:{view:view},
			   	dataType:"json",
			   	success:function(data)
		   		{
				    $('.notifikasi').html(data.pesan);
				    if(data.total > 0)
		    		{
		     			$('.total').html(data.total);
			    	}else{
			    		$('.total').html('0');
			    	}
				}
			});
		}
		notifAdmin();
		 
		setInterval(function(){ 
			notifAdmin();
		}, 5000);
	});

	$(document).ready(function(){
		function notifReseller()
		{
		  	$.ajax({
			   	method:"GET",
		   		url:"<?= base_url('getnotifReseller'); ?>",
			   	// data:{view:view},
			   	dataType:"json",
			   	success:function(data)
		   		{
				    $('.notifikasis').html(data.pesan);
				    if(data.total > 0)
		    		{
		     			$('.totall').html(data.total);
			    	}else{
			    		$('.totall').html('0');
			    	}
				}
			});
		}
		notifReseller();

		setInterval(function(){ 
			notifReseller();
		}, 5000);
	});

	$(document).ready(function(){
		load_data();
		function load_data(dari,ke)
		{
			$.ajax({
				url:"<?php echo base_url('Fetchhistorykeranjang'); ?>",
				method:"POST",
				data:{dari:dari,ke:ke},
				success:function(data){
				 	$('.hasilkeranjang').html(data);
				}
			})
		}

		$('.lihatkeranjang').click(function(){
			var dari = $('.dari').val();
			var ke = $('.ke').val();
			if(dari != '' && ke != '')
			{
			  	console.log(dari+" "+ke);
				load_data(dari,ke);
			}
			else
			{
			  	console.log(dari+" "+ke);
				load_data();
			}
		});
		$('.batalkeranjang').click(function(){
			var dari = document.getElementById('dari').value = '';
			var ke = document.getElementById('ke').value = '';
			load_data();
		});
	});
</script>