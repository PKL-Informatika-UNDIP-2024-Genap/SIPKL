function simpleDatatable() {
	const table = new DataTable('#myTable', {
		columnDefs: [
				{
						searchable: false,
						orderable: false,
						targets: [0,"action","lampiran"]
				},
				{
						targets: ['hari_tanggal'],
						render: DataTable.render.datetime( "dddd, D MMMM YYYY", "id"),
				},
				{
						targets: ['tanggal'],
						render: DataTable.render.datetime( "D MMMM YYYY", "id"),
				},
		],
		order: [[1, 'asc']],
		lengthMenu: [5, 10, 25, 50],
		pageLength: 10
	});

	$('#myTable_filter input').css('width', '200px');
	
	table
			.on('order.dt search.dt', function () {
					let i = 1;
	
					table
							.cells(null, 0, { search: 'applied', order: 'applied' })
							.every(function (cell) {
									this.data(i++);
							});
			})
			.draw();

	return table;
}

function simpleDatatable2() {
	const table = new DataTable('#myTable2', {
		columnDefs: [
			{
				searchable: false,
				orderable: false,
				targets: [0, 'action']
			},
			{
				searchable: true,
				visible: false, 
				targets: ['judul-pkl', 'instansi-pkl']
			},
			{
				"className": "text-center", "targets": "assign"
			}
		],
		order: [[1, 'asc']],
		lengthMenu: [5, 10, 25, 50],
		pageLength: 10
	});

	$('#myTable_filter input').css('width', '200px');
	
	table
			.on('order.dt search.dt', function () {
					let i = 1;
	
					table
							.cells(null, 0, { search: 'applied', order: 'applied' })
							.every(function (cell) {
									this.data(i++);
							});
			})
			.draw();

	return table;
}

function datatableWithCustomFilter(id_filter, column_index) {
	const table = new DataTable('#myTable', {
    columnDefs: [
      {
        searchable: false,
        orderable: false,
        targets: [0, "action"]
      },
			{
				targets: ['hari_tanggal'],
				render: DataTable.render.datetime( "dddd, D MMMM YYYY", "id"),
			},
    ],
    order: [[1, 'asc']],
    lengthMenu: [5, 10, 25, 50],
    pageLength: 10,
    buttons: [
      {
        extend: 'excelHtml5',
        text: 'Export to Excel',
        filename: 'export_nilai',
        exportOptions: {
          columns: ':visible', // Ini akan mengekspor semua kolom yang terlihat
          columns: ':not(:last-child)' // Ini akan mengekspor semua kolom kecuali kolom terakhir
        }
      },
			{
        extend: 'excelHtml5',
        text: 'Export to Excel',
        filename: 'export_jadwal_seminar',
        exportOptions: {
          columns: ':visible', // Ini akan mengekspor semua kolom yang terlihat
          columns: ':not(:last-child)' // Ini akan mengekspor semua kolom kecuali kolom terakhir
        }
      }
    ],
    "initComplete": function (settings, json) {
      $.fn.dataTable.ext.search.push(
        function (settings, data, index) {
          if (settings.nTable.id !== 'myTable') {
            return true;
          }
          var selectedFilter = $(id_filter).val();
					var selectedJadwal = $('#jadwal').val();
					let dataTgl = moment(data[1], "dddd, D MMMM YYYY").format("YYYY-MM-DD");
          if (selectedFilter == "") {
						if (selectedJadwal == "") {
            	return true;
						}
						if (selectedJadwal == "Mendatang" && dataTgl >= moment().format("YYYY-MM-DD")) {
              return true;
            }
						if (selectedJadwal == "Terlewat" && dataTgl < moment().format("YYYY-MM-DD")) {
							return true;
						}
          }
          if (selectedFilter == data[column_index]) {
            if (selectedJadwal == "") {
              return true;
            }
            if (selectedJadwal == "Mendatang" && dataTgl >= moment().format("YYYY-MM-DD")) {
              return true;
            }
						if (selectedJadwal == "Terlewat" && dataTgl < moment().format("YYYY-MM-DD")) {
							return true;
						}
          }
          return false;
        }
      )
    }
  });

	$(id_filter).on('change', function () {
		table.draw();
	});
	$('#jadwal').on('change', function () {
		table.draw();
	});

  $('#myTable_filter input').css('width', '200px');
  table.on('order.dt search.dt', function () {
    let i = 1;
    table
      .cells(null, 0, { search: 'applied', order: 'applied' })
      .every(function (cell) {
        this.data(i++);
      });
  }).draw();

	return table;
}
