$(document).ready(function() {
    $('#project-table').DataTable({
        "order": [[ 3, 'dec' ]]
    });

    $('#status-table').DataTable({
        "order": [[ 2, 'asc' ]]
    });

} );