var base_url = "http://rumahcendekiabogor.com/qurbanqu/";
//Pnotify
  let flashData = $('.flash-data').data('dataflash');
  let validasi = $('.flash-data').data('validasi');
  console.log(flashData);
  console.log(validasi);
  if(flashData){
    new PNotify({
      title: 'Pemberitahuan !!!',
      text: flashData,
      type: validasi,
      delay: 3000,
      styling: 'bootstrap3'
    });
  }

//Admin
  $(document).ready(function(){
    $('a#detail_admin').click(function(){
      var url = $(this).attr('href');
      $.ajax({
        url : url,
        success:function(response){
          $('#modal_detail_admin').html(response);
        }
      });
    });
  });

//tambahan
  $(function () {
    CKEDITOR.replace('ckeditor',{
      filebrowserImageBrowseUrl : base_url+'assets/kcfinder/browse.php',
      height: '400px'             
    });
  });
  
  function validAngkatelp(a)
  {
    if(!/^[0-9.]+$/.test(a.value))
    {
    a.value = a.value.substring(0,a.value.length-1000);
    }
  }

  $(document).ready(function () {
    $(".toggle-password").click(function() {
      $(this).toggleClass("fa-eye fa-eye-slash");
      var input = $($(this).attr("toggle"));
      if (input.attr("type") == "password") {
        input.attr("type", "text");
      } else {
        input.attr("type", "password");
      }
    });
  });

  $(document).ready(function () {
    $('#checkshow').click(function () {
      $('#foto').removeAttr('disabled');
      document.getElementById('checkshow').style.display = "none";
      document.getElementById('checkhide').style.display = "block";
      document.getElementById('nilai').value = 1;
    });
    $('#checkhide').click(function () {
      $('#foto').attr('disabled', 'disabled');
      document.getElementById('checkshow').style.display = "block";
      document.getElementById('checkhide').style.display = "none";
      document.getElementById('nilai').value = 0;
    });
  });

  function passwordStrength(p){
    let status = document.getElementById('status');
    let regex = new Array();
    regex.push("[A-Z]");
    regex.push("[a-z]");
    regex.push("[0-9]");
   
    let passed = 0;
      for(let x = 0; x < regex.length;x++){
        if(new RegExp(regex[x]).test(p)){
          console.log(passed++);
        }
      }

    let strength = null;
    let color = null;

    switch(passed){
      case 0:
      case 1:
        strength = "Tidak Aman";
        color = "#FF3232";
      break;
      case 2:
        strength = "Cukup Aman";
        color = "#E1D441";
      break;
      case 3:
        strength = "Sangat Aman";
        color = "#27D644";
      break;
      case 4:
      break;
    }
    status.innerHTML = strength;
    status.style.color = color;
  }

  $(document).ready(function () {
    //category switch
    $('.onoffswitchAdmin').change(function () {
      var id = $(this).children(':hidden').val();
      if ($(this).children(':checked').length === 0)
      {
          var aktif_state = 0;
      }
      else
      {
          var aktif_state = 1;
      }
      console.log(aktif_state);
      $.ajax({
        type: 'GET',
        url: base_url + "Dashboard/updateActivedAdmin",
        data: {aktif_state: aktif_state, id: id},
        success: function (response) {
          console.log(response);
          // $('.tampildata').load(base_url+'viewadmin');
        }
      });
    });

    $('.onoffswitchKategori').change(function () {
      var id = $(this).children(':hidden').val();
      if ($(this).children(':checked').length === 0)
      {
          var aktif_state = 0;
      }
      else
      {
          var aktif_state = 1;
      }
      console.log(aktif_state);
      $.ajax({
        type: 'GET',
        url: base_url + "Dashboard/updateActivedKategori",
        data: {aktif_state: aktif_state, id: id},
        success: function (response) {
          console.log(response);
          // $('.tampildata').load(base_url+'viewadmin');
        }
      });
    });

    $('.onoffswitchCatalog').change(function () {
      var id = $(this).children(':hidden').val();
      if ($(this).children(':checked').length === 0)
      {
          var aktif_state = 0;
      }
      else
      {
          var aktif_state = 1;
      }
      console.log(aktif_state);
      $.ajax({
        type: 'GET',
        url: base_url + "Dashboard/updateActivedCatalog",
        data: {aktif_state: aktif_state, id: id},
        success: function (response) {
          console.log(response);
          // $('.tampildata').load(base_url+'viewadmin');
        }
      });
    });
  });

//datatable dan Counter
  // $("#CountDownTimer").TimeCircles({ time: { Days: { show: false }, Hours: { show: false } }});
  $(document).ready(function () {
    $('#Dataadmin').DataTable();
    $('#Datakategori').DataTable();
    $('#Datacatalog').DataTable();
  });