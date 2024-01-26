function simpleDatatable() {
	const table = new DataTable('#myTable', {
		columnDefs: [
				{
						searchable: false,
						orderable: false,
						targets: [0,"action","lampiran"]
				},
		],
		order: [[1, 'asc']],
		lengthMenu: [5, 10, 25, 50],
		pageLength: 10
	});

	$('#myTable_filter input').css('width', '210px');
	
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
}

function simpleDatatable2() {
	const table = new DataTable('#myTable2', {
		columnDefs: [
			{
				searchable: false,
				orderable: false,
				targets: [0, 3]
			},
		],
		order: [[1, 'asc']],
		lengthMenu: [5, 10, 25, 50],
		pageLength: 10
	});

	$('#myTable_filter input').css('width', '210px');
	
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
