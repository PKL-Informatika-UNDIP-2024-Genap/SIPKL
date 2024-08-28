$(document).ready(function() {
  $(document).on("click", ".btn-edit", function(e){
    $("#form-edit :input").each(function () {
      $(this).removeClass("is-invalid");
      $(this).siblings(".invalid-feedback").html("");
    });
  
    var nama = $(this).data('nama');
    var value = $(this).attr('data-value');
    var id = $(this).data('id');
  
    $("#nama-edit").val(nama);
    $("#value-edit").val(value);
    $("#id").val(id);
  });

  $(document).on('click', '#update-informasi', function (e) {
    e.preventDefault();
    let nama = $("#nama-edit").val();
    let value = $("#value-edit").val();
    let id = $("#id").val();

    $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

    $.ajax({
      type: "put",
      url: "/informasi/kelola_informasi_lain/"+ id +"/update",
      data: {
        id: id,
        nama: nama,
        value: value,
      },
      dataType: "json",
      success: function (response) {
        $("#modal_edit").modal("hide");
        Swal.fire({
          title: "Success",
          text: 'Data "' + nama + '" Berhasil Diupdate',
          icon: "success",
          showConfirmButton: false,
          timer: 1500
        });
        // update_tabel_dokumen();
        var targetRow = $("tr[data-id='" + id + "']");
        targetRow.find('.kolom-value').html(value);
        targetRow.find('.btn-edit').attr("data-value", value);
      },
      error: function (response) {
        var errorResponse = $.parseJSON(response.responseText);
        if (errorResponse.errors && errorResponse.errors.value) {
          $("#value-edit").addClass("is-invalid");
          $("#value-edit-err").html(errorResponse.errors.value);
        }else{
          $("#value-edit").removeClass("is-invalid");
          $("#value-edit-err").html("");
        }
      }
    });

  });
});