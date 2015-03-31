$(document).ready(function() {
    $('#project-table').DataTable({
        "order": [[ 3, 'dec' ]],
        "pageLength": 50
    });

    $('#status-table').DataTable({
        "order": [[ 2, 'asc' ]],
        "pageLength": 50
    });

} );