function search() {
    var searchInput, fechaInput, table, tr, td, i, txtValue;
    searchInput = document.getElementById("searchInput");
    fechaInput = document.getElementById("fechaInput");
    table = document.getElementById("resolutionsTable");
    tr = table.getElementsByTagName("tr");

    for (i = 1; i < tr.length; i++) { // Comenzar desde 1 para omitir la fila de encabezados
        td = tr[i].getElementsByTagName("td");
        var textFound = false;
        var dateFound = false;

        // Buscar por texto
        if (searchInput.value !== "") {
            for (var j = 0; j < td.length; j++) {
                txtValue = td[j].textContent || td[j].innerText;
                if (txtValue.toLowerCase().indexOf(searchInput.value.toLowerCase()) > -1) {
                    textFound = true;
                    break;
                }
            }
        } else {
            textFound = true; // Si no se ingresa texto, se considera como coincidencia
        }

        // Buscar por rango de fecha
        if (fechaInput.value !== "") {
            var fecha = td[2].textContent || td[2].innerText; // Índice 2 para la columna de fecha
            var fechaInicio = moment(fechaInput.value.split(" - ")[0]).startOf('day');
            var fechaFin = moment(fechaInput.value.split(" - ")[1]).endOf('day');
            var fechaActual = moment(fecha);

            if (fechaActual.isBetween(fechaInicio, fechaFin, null, '[]')) {
                dateFound = true;
            }
        } else {
            dateFound = true; // Si no se ingresa rango de fecha, se considera como coincidencia
        }

        // Mostrar u ocultar la fila según los resultados de búsqueda
        if (textFound && dateFound) {
            tr[i].style.display = "";
        } else {
            tr[i].style.display = "none";
        }
    }
}

$(document).ready(function() {
    // Inicializar el selector de rango de fecha
    $('#fechaInput').daterangepicker({
        autoUpdateInput: false,
        locale: {
            cancelLabel: 'Limpiar',
            applyLabel: 'Aplicar',
            format: 'YYYY-MM-DD'
        }
    });
    
    // Actualizar la fecha en el campo de entrada al seleccionar un rango de fecha
    $('#fechaInput').on('apply.daterangepicker', function(ev, picker) {
        $(this).val(picker.startDate.format('YYYY-MM-DD') + ' - ' + picker.endDate.format('YYYY-MM-DD'));
        search();
    });
    
    // Limpiar la fecha en el campo de entrada al hacer clic en "Limpiar"
    $('#fechaInput').on('cancel.daterangepicker', function(ev, picker) {
        $(this).val('');
        search();
    });
});
