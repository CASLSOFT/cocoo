$(function () {
    // $('.js-basic-example').DataTable({
    //     responsive: true
    // });

    // Exportable table
    $('.js-exportable').DataTable({
        serverSide: true,
        ajax: '/article.index',
        ajax: '{{ url('/requisiciones/list') }}',
        dom: 'Bfrtip',
        responsive: true,
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ],
        language: {
            "decimal":        "",
            "emptyTable":     "No data available in table",
            "info":           "Showing _START_ to _END_ of _TOTAL_ entries",
            "infoEmpty":      "Mostrando 0 to 0 de 0 registros",
            "infoFiltered":   "(filtered from _MAX_ total entries)",
            "infoPostFix":    "",
            "thousands":      ",",
            "lengthMenu":     "Ver _MENU_ registros",
            "loadingRecords": "Loading...",
            "processing":     "Processing...",
            "search":         "Buscar:",
            "zeroRecords":    "No matching records found",
            "paginate": {
                "first":      "First",
                "last":       "Last",
                "next":       "Siguiente",
                "previous":   "Anterior"
            }
        }
    });
});