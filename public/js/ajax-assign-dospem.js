$(document).ready(function() {
  let nim_mhs;
  let map_data_pkl = new Map();
  let table = simpleDatatable2();

  $(document).on('click', '.btn-assign-dospem', function (e) {
    nim_mhs = $(this).data('nim');

    $("#dosen-pembimbing").removeClass("is-invalid");
    $("#dosen-pembimbing-err").html("");
  });

  $(document).on('click', 'td.details-control', function (e) {
    let tr = $(this).closest('tr');
    let row = table.row(tr);
    let instansi_pkl;
    let judul_pkl;
 
    if (row.child.isShown()) {
      row.child.hide();
      tr.removeClass('shown');
    }
    else {
      if($(this).hasClass("clicked")){
        row.child(
          '<dl>' +
          '<dt>Instansi PKL:</dt>' +
          '<dd>' + map_data_pkl.get(tr.data("nim"))[0] +'</dd>' +
          '</dl>'+
          '<dl>' +
          '<dt>Judul PKL:</dt>' +
          '<dd>' + map_data_pkl.get(tr.data("nim"))[1] +'</dd>' +
          '</dl>'
        ).show();
      }else{
        row.child('<span class="spinner-border spinner-border-sm" aria-hidden="true"></span> Loading...').show();
        $.ajax({
          type: "GET",
          url: "/dospem/assign_mhs_bimbingan/"+tr.data('nim')+"/get_data_pkl",
          success: function (response) {
            instansi_pkl = response.instansi_pkl;
            judul_pkl = response.judul_pkl;
          },
          error: function (response) {
            console.error('Error:', response);
            Swal.fire({
              title: 'Error!',
              text: 'Terjadi kesalahan saat mengambil data.',
              icon: 'error',
            });
          },
          complete: function () {
            row.child(
              '<dl>' +
              '<dt>Instansi PKL:</dt>' +
              '<dd>' + instansi_pkl +'</dd>' +
              '</dl>'+
              '<dl>' +
              '<dt>Judul PKL:</dt>' +
              '<dd>' + judul_pkl +'</dd>' +
              '</dl>'
            ).show();

            map_data_pkl.set(tr.data("nim"), [instansi_pkl, judul_pkl]);
          }
        });
        $(this).addClass("clicked");
      }

      tr.addClass('shown');
    }
  });


  $(document).on('click', '#simpan-dospem', function (e) {
    let nip_dospem = $('#dosen-pembimbing').val();
    let nama_dospem = $("#dosen-pembimbing option:selected").text();

    $("#dosen-pembimbing").removeClass("is-invalid");
    $("#dosen-pembimbing-err").html("");

    if(nip_dospem == null){
      $("#dosen-pembimbing").addClass("is-invalid");
      $("#dosen-pembimbing-err").html("Dosen Pembimbing harus dipilih");
    }else{
      $.ajax({
        type: "POST",
        url: "/mhs/assign_dospem/"+nim_mhs+"/update_dospem",
        data: {
          nip_dospem: nip_dospem
        },
        dataType: "json",
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function (response) {
          $("#modal-assign-dospem").modal("hide");
          Swal.fire({
            title: "Success",
            text: "Data Dosen Pembimbing berhasil disimpan.",
            icon: "success",
            showConfirmButton: false,
            timer: 1500
          });
          var targetRow = $("tr[data-nim='" + nim_mhs + "']");
          targetRow.find('.kolom-nama-dospem').html(nama_dospem);
        },
        error: function (response) {
          console.error('Error:', response);
          Swal.fire({
            title: 'Error!',
            text: 'Terjadi kesalahan saat menyimpan data.',
            icon: 'error',
          });
        }
      });
    }
    

  });
  


  $('.select2bs4').select2({
    theme: 'bootstrap4',
    dropdownParent: "#modal-assign-dospem"
  })

});