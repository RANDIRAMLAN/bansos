//  pilhan berantai kecamatan
 $(document).ready(function(){
            $("#kabKota").change(function(){ 
                $("#kecamatan").hide();
                $.ajax({
                    type: "post",
                    url: '/menu/kecamatan', 
                    data: {kabKota : $("#kabKota").val()},
                    dataType: "json",
                    beforeSend: function(e) {
                        if(e && e.overrideMimeType) {
                                e.overrideMimeType("application/json;charset=UTF-8");
                        }
                    },
                    success: function(response){
                        $("#kecamatan").html(response.kecamatan).show();
                        console.log(response);
                    },
                    error: function (xhr, ajaxOptions, thrownError) {
                        alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                    }
                });
            });
        });
// pilihan berantai kelurahan
$(document).ready(function () {
    $('#kecamatan').change(function() {
        $('#desaKelurahan').hide();
        $.ajax({
            type: "post",
            url: '/menu/desa_kelurahan',
            data: {kecamatan : $('#kecamatan').val()},
            dataType: "json",
            beforeSend: function(e) {
                        if(e && e.overrideMimeType) {
                                e.overrideMimeType("application/json;charset=UTF-8");
                        }
                    },
            success: function(response){
                        $("#desaKelurahan").html(response.desaKelurahan).show();
                        console.log(response);
                    },
           error: function (xhr, ajaxOptions, thrownError) {
                        alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                    }
        });
        
    });
});
// live search
$(document).ready(function () {
load_data();
    function load_data() {
        $.ajax({
      url: '/admin/live_search', 
      type: 'post', 
      data: {cari: $("#cari").val()},
      dataType: "json",
      beforeSend: function(e) {
        if(e && e.overrideMimeType) {
          e.overrideMimeType("application/json;charset=UTF-8");
        }
      },
      success: function(response){ 
        $("#tampil-data").html(response.data);
      },
      error: function (xhr, ajaxOptions, thrownError) { 
        alert(xhr.responseText);
      }
    });
    }

    $("#cari").keyup(function(){ 
    load_data();
  });

});
// Crud wth ajax 
$(document).ready(function () {
  tampil_data();
  $('#data_bansos').dataTable({
       "bPaginate": false,
       "bInfo": false,
       "bFilter": true,
       "bLengthChange": false,
       "pageLength": 5
    });
// tampilkan data tabel menggunakan ajax
    function tampil_data() {
      $.ajax({
          type: 'post',
          url: '/Admin/tampil_data',
          dataType: 'json',
          success: function (data) {
             let html = '';
             let i;
             let no = 1;
          for (i = 0; i < data.length; i++) {
              html += '<tr id="' + data[i].id + '">' +
                '<td>' + no++ + '</td>' +
                '<td>' + data[i].namaBansos + '</td>' +
                '<td>' + data[i].kategori + '</td>' +
                '<td>' + data[i].pendamping + '</td>' +
                '<td>' + data[i].nominal + '</td>' +
                '<td>' + data[i].tipeBansos + '</td>' +
                '<td style="text-align:right;">' +
                '<a href="javascript:void(0);" class="btn btn-info btn-sm ubahDataBansos" data-id="' + data[i].id + '" data-idbansos="' + data[i].idBansos + '"data-namabansos="' + data[i].namaBansos + '" data-kategori="'+data[i].kategori+'" data-pendamping="'+data[i].pendamping+'" data-nominal="'+data[i].nominal+'" data-tipebansos="'+data[i].tipeBansos+'"><i class="fas fa-edit"></i></a>' + ' ' +
                '<a href="javascript:void(0);" class="btn btn-danger btn-sm hapusDataBansos" data-id="' + data[i].id + '"><i class="fas fa-trash-alt"></i></a>' +
                '</td>' +
                '</tr>';
    }
    $('#daftar_data_bansos').html(html);
  }

 });
    }
    // simpan data
    $('#simpan_data').submit('click', function () {
      let idBansos = $('#idBansos').val();
      let namaBansos = $('#namaBansos').val();
      let kategori = $('#kategori').val();
      let pendamping = $('#pendamping').val();
      let nominal = $('#nominal').val();
      let tipeBansos = $('#tipeBansos').val();
      $.ajax({
        type: 'post',
        url: '/Admin/simpan_data_bansos',
        dataType: 'json',
        data: {idBansos: idBansos, namaBansos: namaBansos, kategori: kategori, pendamping: pendamping, nominal: nominal, tipeBansos: tipeBansos},
        success: function (response) {
          if (response.error){
            if(response.error.idBansos){
              $('#idBansos').addClass('is-invalid');
              $('.errorIdBansos').html(response.error.idBansos);
            }else{
              $('#idBansos').removeClass('is-invalid');
              $('.errorIdBansos').html("");
            }
              if(response.error.namaBansos){
              $('#namaBansos').addClass('is-invalid');
              $('.errorNamaBansos').html(response.error.namaBansos);
            }else{
              $('#namaBansos').removeClass('is-invalid');
              $('.errorNamaBansos').html("");
            }
            if(response.error.kategori){
              $('#kategori').addClass('is-invalid');
              $('.errorKategori').html(response.error.kategori);
            }else{
              $('#kategori').removeClass('is-invalid');
              $('.errorKategori').html("");
            }
          }else{    
          $('#idBansos').val('');
          $('#idBansos').removeClass('is-invalid');
          $('.errorIdBansos').html("");
          $('#namaBansos').val('');
          $('#namaBansos').removeClass('is-invalid');
          $('.errorNamaBansos').html("");
          $('#kategori').val('');
           $('#kategori').removeClass('is-invalid');
          $('.errorKategori').html("");
          $('#pendamping').val('');
          $('#nominal').val('');
          $('#tipeBansos').val('');
          $('#tambah_data_bansos').modal('hide');
          tampil_data();
          $('#pesan').addClass('alert');
          $('#pesan').html(response.pesan);
          setTimeout(() => {
            $('#pesan').hide();
          },5000);
          }
        },
      error: function (xhr, ajaxOptions, thrownError) { 
        alert(xhr.responseText);
      }
      });
      return false;
    });
    // ubah data
    $('#daftar_data_bansos').on('click', '.ubahDataBansos', function () {
      $('#ubah_data_bansos').modal('show');
      $('#idUbah').val($(this).data('id'));
      $('#idBansosUbah').val($(this).data('idbansos'));
      $('#namaBansosUbah').val($(this).data('namabansos'));
      $('#kategoriUbah').val($(this).data('kategori'));
      $('#kategoriLama').val($(this).data('kategori'))
      $('#pendampingUbah').val($(this).data('pendamping'));
      $('#nominalUbah').val($(this).data('nominal'));
      $('#tipeBansosUbah').val($(this).data('tipebansos'));
      $('#tipeBansosLama').val($(this).data('tipebansos'))
      $('#ubah_data').on('submit', function () {
      let id = $('#idUbah').val();
      let idBansos = $('#idBansosUbah').val();
      let namaBansos = $('#namaBansosUbah').val();
      let kategori = $('#kategoriUbah').val();
      let kategoriLama = $('KategoriLama').val();
      let pendamping = $('#pendampingUbah').val();
      let nominal = $('#nominalUbah').val();
      let tipeBansos = $('#tipeBansosUbah').val();
      let $tipebBansosLama = $('#tipeBansosLama').val()
      $.ajax({
        type: 'post',
        url: '/Admin/ubah_data_bansos',
        dataType: 'json',
        data: {id: id, idBansos: idBansos, namaBansos: namaBansos, kategori: kategori, KategoriLama: kategoriLama, pendamping: pendamping, nominal: nominal, tipeBansos: tipeBansos, $tipebBansosLama: $tipebBansosLama},
        success: function (response) {
          if (response.error){
            if(response.error.idBansos){
              $('#idBansosUbah').addClass('is-invalid');
              $('.errorIdBansos').html(response.error.idBansos);
            }else{
              $('#idBansosUbah').removeClass('is-invalid');
              $('.errorIdBansos').html("");
            }
              if(response.error.namaBansos){
              $('#namaBansosUbah').addClass('is-invalid');
              $('.errorNamaBansos').html(response.error.namaBansos);
            }else{
              $('#namaBansosUbah').removeClass('is-invalid');
              $('.errorNamaBansos').html("");
            }
            if(response.error.kategori){
              $('#kategoriUbah').addClass('is-invalid');
              $('.errorKategori').html(response.error.kategori);
            }else{
              $('#kategoriUbah').removeClass('is-invalid');
              $('.errorKategori').html("");
            }
          }else{    
          $('#idBansosUbah').val('');
          $('#idBansosUbah').removeClass('is-invalid');
          $('.errorIdBansos').html("");
          $('#namaBansosUbah').val('');
          $('#namaBansosUbah').removeClass('is-invalid');
          $('.errorNamaBansos').html("");
          $('#kategoriUbah').val('');
          $('#kategoriUbah').removeClass('is-invalid');
          $('.errorKategori').html("");
          $('#pendampingUbah').val('');
          $('#nominalUbah').val('');
          $('#tipeBansosUbah').val('');
          $('#ubah_data_bansos').modal('hide');
          tampil_data();
          $('#pesan').addClass('alert');
          $('#pesan').html(response.pesan);
          setTimeout(() => {
            $('#pesan').hide();
          },5000);
          }
        },
      error: function (xhr, ajaxOptions, thrownError) { 
        alert(xhr.responseText);
      }
      });
      return false;
      });
    });
    // delete Data Bansos
    $('#daftar_data_bansos').on('click', '.hapusDataBansos', function () {
      $('#hapus_data_bansos').modal('show');
      $('#idHapus').val($(this).data('id'));
      $('#hapus_data').on('submit', function () {
        let id = $('#idHapus').val();
        $.ajax({
          type: 'post',
          url: '/Admin/hapus_data_bansos',
          dataType: 'json',
          data: { id: id },
          success: function (response) {
          $("#" + id).remove();
          $('#idHapus').val("");
          $('#hapus_data_bansos').modal('hide');
          tampil_data()
          $('#pesan').addClass('alert');
          $('#pesan').html(response.pesan);
          setTimeout(() => {
          $('#pesan').hide();
          },5000);
                  }
      });
    return false;
      });
    });
});