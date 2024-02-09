let periode_pkl = $('#periode-pkl').val();
var arr_periode = $('#periode-pkl').find('option').map(function() {
  // Memeriksa apakah nilai value tidak kosong
  if ($(this).val() !== "") {
      return $(this).val();
  }
}).get();

console.log(arr_periode);

$(document).on('change', '#periode-pkl', function() {
  periode_pkl = $(this).val();

  $.ajax({
    url: '/dospem/beban_bimbingan/update_tabel_index/',
    method: 'GET',
    data: {
      periode_pkl: periode_pkl,
      arr_periode: arr_periode
    },
    success: function(response) {
      $('#tabel-index').html(response.html);
      simpleDatatable();
    },
    error: function(response) {
      console.log(response);
    }

  });
  
});