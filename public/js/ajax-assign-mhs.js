$(document).ready(function() {
  let table_modal;
  let map_data_pkl = new Map();

  $(document).on("click", ".btn-assign-mhs", function(e){
    let nama = $(this).data('nama');
    let nip = $(this).data('nip');

    $("#data-nama").html(": " + nama);
    $("#data-nip").html(": " + nip);

    $.ajax({
      type: "GET",
      url: "/dospem/assign_mhs_bimbingan/" + nip + "/get_data_mhs",
      success: function (response) {
        $('#tabel-modal').html(response.view);
        if (table_modal) {
          table_modal.destroy();
        }
        table_modal = simpleDatatable2();
      }
    });

    
  });

  $(document).on('click', 'td.details-control', function (e) {
    let tr = $(this).closest('tr');
    let row = table_modal.row(tr);
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


  $(document).on('click', '#btn-edit', function (e) {
    var checkboxes = document.querySelectorAll('input[type="checkbox"]');
    checkboxes.forEach((checkbox) => {
      checkbox.removeAttribute("disabled");
    });

    if($(this).hasClass("edit")){
      $(this).html("Edit Mhs Bimbingan");
      checkboxes.forEach((checkbox) => {
        checkbox.setAttribute("disabled", "disabled");
      });
    }else{
      $(this).html("Simpan Perubahan");
      checkboxes.forEach((checkbox) => {
        checkbox.removeAttribute("disabled");
      });
    }
    
    $(this).toggleClass('edit');
  });





});