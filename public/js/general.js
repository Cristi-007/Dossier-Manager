$(document).ready(function(e) {

    $(document).on('click', '.pagination a', function (event) {
        event.preventDefault();
        var pageNumber = $(this).attr('href').split('page=')[1];
        
        $.ajax({
            url: "/employee_manager_view" + "?page=" + page,
            type: 'GET',
            data: { },
            success: function (data) {
                $('#paginatedTable').html(data);
            },
            fail: function () {
                console.log("Failed to load data!");
            }
        })
    });


 
})