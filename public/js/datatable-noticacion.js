$(document).ready(function() {
    $('.table').DataTable({
        "bInfo": false,
        "ordering": false,
        dom: 'rtip',
        pageLength: 5,

        language: {
            processing:     "Procesando...",
            search:         "Buscar:",
            lengthMenu:    "Mostrar _MENU_ Entradas",
            info:           "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
            infoEmpty:      "Mostrando 0 a 0 de 0 Entradas",
            infoFiltered:   "(Filtrado de _MAX_ total entradas)",
            infoPostFix:    "",
            loadingRecords: "Cargando...",
            zeroRecords:    "Sin resultados encontrados",
            emptyTable:     "No hay información",
            paginate: {
                first:      "primero",
                previous:   "<",
                next:       ">",
                last:       "Ultimo"
            },
            aria: {
                sortAscending:  ": Activar para ordenar la columna en orden ascendente",
                sortDescending: " Activar para ordenar la columna en orden descendente."
            },
        },
    });
});