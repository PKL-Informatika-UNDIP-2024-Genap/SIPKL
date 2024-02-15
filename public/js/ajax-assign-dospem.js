$(document).ready(function() {
  let nim_mhs;
  let table = simpleDatatable2();

  $(document).on('click', '.btn-assign-dospem', function (e) {
    nim_mhs = $(this).data('nim');
    let id_dospem = $(this).attr('data-id-dospem');
    
    $("#dosen-pembimbing").find("option").removeAttr('selected');

    if(id_dospem != null){
      $("#dosen-pembimbing").val(id_dospem).trigger('change');
      console.log(id_dospem);
    }

    $("#dosen-pembimbing").removeClass("is-invalid");
    $("#dosen-pembimbing-err").html("");
  });

  $(document).on('click', 'td.details-control', function (e) {
    let tr = $(this).closest('tr');
    let row = table.row(tr);
 
    if (row.child.isShown()) {
      row.child.hide();
      tr.removeClass('shown');
    }
    else {
      row.child(
        '<div class="row">'+
        '<div class="col-md-4">'+
        '<dl>' +
        '<dt>Instansi PKL:</dt>' +
        '<dd>' + tr.attr("data-judul") +'</dd>' +
        '</dl>'+
        '</div>'+
        '<div class="col-md-8">'+
        '<dl>' +
        '<dt>Judul PKL:</dt>' +
        '<dd>' + tr.attr("data-instansi") +'</dd>' +
        '</dl>'+
        '</div>'+
        '</div>'
      ).show();
      tr.addClass('shown');
    }
  });

  $(document).on('click', '#simpan-dospem', function (e) {
    let id_dospem = $('#dosen-pembimbing').val();
    let nama_dospem = $("#dosen-pembimbing option:selected").text();

    $("#dosen-pembimbing").removeClass("is-invalid");
    $("#dosen-pembimbing-err").html("");

    if(id_dospem == null){
      $("#dosen-pembimbing").addClass("is-invalid");
      $("#dosen-pembimbing-err").html("Dosen Pembimbing harus dipilih");
    }else{
      $.ajax({
        type: "POST",
        url: "/mhs/assign_dospem/"+nim_mhs+"/update_dospem",
        data: {
          id_dospem: id_dospem,
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
          targetRow.find('.btn-assign-dospem').attr("data-id-dospem", id_dospem);
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