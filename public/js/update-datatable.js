table = new DataTable('#myTable', {
  columnDefs: [
      {
          searchable: false,
          orderable: false,
          targets: 0
      }
  ],
  order: [[1, 'asc']],
  lengthMenu: [5, 10, 25, 50],
  pageLength: 10
});

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