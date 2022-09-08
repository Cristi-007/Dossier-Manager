function showPaginatedTables(page) {
    var sPath = window.location.pathname;

    switch(sPath) {
        case '/dashboard':
            sEntries = 10;
            sUrl = "/dashboard" + "?page=" + page
        break;

        case '/viewDossier':
            sEntries = document.getElementById('entries-per-page').value;
            sUrl = "/viewDossier" + "?page=" + page;
        break;

        case '/employee_manager_view':
            sEntries = 10;
            sUrl = "/employee_manager_view" + "?page=" + page;
        break;
    }


    $.ajax({
        url: sUrl,
        type: 'GET',
        data: { 
            entryPerPage: sEntries,
        },
        success: function (data) {
            $('#paginatedTable').html(data);
        },
        fail: function () {
            console.log("Failed to load data!");
        }
    })
}

$(document).ready(function(e) {

    $(document).on('click', '.pagination a', function (event) {
        event.preventDefault();
        var pageNumber = $(this).attr('href').split('page=')[1];
        showPaginatedTables(pageNumber);
    });

 
})