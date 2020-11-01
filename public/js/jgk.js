// waktu flash data
setTimeout(function () {
  $(".alert").alert("close");
}, 10000);
// tultip pada button
$(function () {
  $('[data-toggle="tooltip"]').tooltip();
});
//   tampil dan sembunyikan password
$(".fa-eye").hide();
$(".fa-eye-slash").click(function () {
  $("#password").attr("type", "text");
  $(".fa-eye-slash").hide();
  $(".fa-eye").show();
});
$(".fa-eye").click(function () {
  $("#password").attr("type", "password");
  $(".fa-eye").hide();
  $(".fa-eye-slash").show();
});

// warna pada navbar (user)
$(".user").css("color", "#007bff");
$(".user").mouseleave(function () {
  $(".user").css("color", "#007bff");
});
$(".user").mouseenter(function () {
  $(".user").css("color", "orange");
});
// tambah data banyak (input Kode Pos)
$(document).ready(function(e) {
  // tambah form
  $('.btn-add-form').click(function (e) {
    e.preventDefault();
                $('.tambah').append(`                <tr>
                    <td>
                        <div class="form-group">
                            <input type="text" class="form-control mt-n2 mb-n4" placeholder="ex: 92111-Somba Opu" id="posDesaKelurahan" name="posDesaKelurahan[]" autocomplete="off">

                        </div>
                    </td>
                    <td>
                        <div class="form-group">
                            <input type="text" class="form-control mt-n2 mb-n4" placeholder="ex: 92111" id="kodePos" name="kodePos[]" autocomplete="off">
                        </div>
                    </td>
                    <td>
                        <div class="form-group">
                            <input type="text" class="form-control mt-n2 mb-n4" placeholder="ex: Sungguminasa" id="desaKelurahan" name="desaKelurahan[]" autocomplete="off">
                        </div>
                    </td>
                    <td>
                        <div class="form-group">
                            <input type="text" class="form-control mt-n2 mb-n4" placeholder="ex: Somba Opu" name="kecamatan[]">
                        </div>
                    </td>
                    <td>
                        <div class="form-group">
                            <input type="text" name="kabKota[]" class="form-control mt-n2 mb-n4" placeholder="ex: Gowa">
                        </div>
                    </td>
                    <td class="text-center">
                        <i class="fas fa-trash button-sm btn-delete-form"></i>
                    </td>
                </tr>`);
  });
  // hapus form tambah kode pos
$(document).on('click', '.btn-delete-form', function (e) {
  e. preventDefault();
  $(this).parents('tr').remove();
});
});
// pilih data bansos untuk diubah
$(document).ready(function () {
  $('.check-all').click(function (e) {
    if($(this).is(':checked')){
      $('.check').prop('checked', true);
    }else{
      $('.check').prop('checked', false);
    } 
  });
});
// auto complate cari data keluarga baris 1
  $('#noKK1').autocomplete({
       
        source: '/admin/keluarga_autocomplete',
        focus: function(event, ui) {
            $("#noKK1").val(ui.item.noKK);
            return false;
        },
        select: function(event,ui) {
            $("#noKK1" ).val(ui.item.label);
            $("#kepalaKeluarga1").val(ui.item.kepalaKeluarga);    
            return false;
    }
});
// auto complate cari data keluarga baris 2
  $('#noKK2').autocomplete({
       
        source: '/admin/keluarga_autocomplete',
        focus: function(event, ui) {
            $("#noKK2").val(ui.item.noKK);
            return false;
        },
        select: function(event,ui) {
            $("#noKK2" ).val(ui.item.label);
            $("#kepalaKeluarga2").val(ui.item.kepalaKeluarga);    
            return false;
    }
});
// auto complate cari data keluarga baris 3
  $('#noKK3').autocomplete({
       
        source: '/admin/keluarga_autocomplete',
        focus: function(event, ui) {
            $("#noKK3").val(ui.item.noKK);
            return false;
        },
        select: function(event,ui) {
            $("#noKK3" ).val(ui.item.label);
            $("#kepalaKeluarga3").val(ui.item.kepalaKeluarga);    
            return false;
    }
});
// auto complate cari data keluarga baris 4
  $('#noKK4').autocomplete({
       
        source: '/admin/keluarga_autocomplete',
        focus: function(event, ui) {
            $("#noKK4").val(ui.item.noKK);
            return false;
        },
        select: function(event,ui) {
            $("#noKK4" ).val(ui.item.label);
            $("#kepalaKeluarga4").val(ui.item.kepalaKeluarga);    
            return false;
    }
});
// auto complate cari data keluarga baris 5
  $('#noKK5').autocomplete({
       
        source: '/admin/keluarga_autocomplete',
        focus: function(event, ui) {
            $("#noKK5").val(ui.item.noKK);
            return false;
        },
        select: function(event,ui) {
            $("#noKK5" ).val(ui.item.label);
            $("#kepalaKeluarga5").val(ui.item.kepalaKeluarga);    
            return false;
    }
});
// auto complate cari data bansos baris 1
  $('#idBansos1').autocomplete({
       
        source: '/admin/bansos_autocomplete',
        focus: function(event, ui) {
            $("#idBansos1").val(ui.item.idBansos);
            return false;
        },
        select: function(event,ui) {
            $("#idBansos1" ).val(ui.item.label);
            $("#namaBansos1").val(ui.item.namaBansos); 
            $('#kategori1').val(ui.item.kategori);
            $('#pendamping1').val(ui.item.pendamping);
            $('#nominal1').val(ui.item.nominal);   
            return false;
    }
});
// auto complate cari data bansos baris 2
  $('#idBansos2').autocomplete({
       
        source: '/admin/bansos_autocomplete',
        focus: function(event, ui) {
            $("#idBansos2").val(ui.item.idBansos);
            return false;
        },
        select: function(event,ui) {
            $("#idBansos2" ).val(ui.item.label);
            $("#namaBansos2").val(ui.item.namaBansos); 
            $('#kategori2').val(ui.item.kategori);
            $('#pendamping2').val(ui.item.pendamping);
            $('#nominal2').val(ui.item.nominal);   
            return false;
    }
});
// auto complate cari data bansos baris 3
  $('#idBansos3').autocomplete({
       
        source: '/admin/bansos_autocomplete',
        focus: function(event, ui) {
            $("#idBansos3").val(ui.item.idBansos);
            return false;
        },
        select: function(event,ui) {
            $("#idBansos3" ).val(ui.item.label);
            $("#namaBansos3").val(ui.item.namaBansos); 
            $('#kategori3').val(ui.item.kategori);
            $('#pendamping3').val(ui.item.pendamping);
            $('#nominal3').val(ui.item.nominal);   
            return false;
    }
});
// auto complate cari data bansos baris 4
  $('#idBansos4').autocomplete({
       
        source: '/admin/bansos_autocomplete',
        focus: function(event, ui) {
            $("#idBansos4").val(ui.item.idBansos);
            return false;
        },
        select: function(event,ui) {
            $("#idBansos4" ).val(ui.item.label);
            $("#namaBansos4").val(ui.item.namaBansos); 
            $('#kategori4').val(ui.item.kategori);
            $('#pendamping4').val(ui.item.pendamping);
            $('#nominal4').val(ui.item.nominal);   
            return false;
    }
});
// auto complate cari data bansos baris 5
  $('#idBansos5').autocomplete({
       
        source: '/admin/bansos_autocomplete',
        focus: function(event, ui) {
            $("#idBansos5").val(ui.item.idBansos);
            return false;
        },
        select: function(event,ui) {
            $("#idBansos5" ).val(ui.item.label);
            $("#namaBansos5").val(ui.item.namaBansos); 
            $('#kategori5').val(ui.item.kategori);
            $('#pendamping5').val(ui.item.pendamping);
            $('#nominal5').val(ui.item.nominal);   
            return false;
    }
});







