function showNomenclature(type) {

    if (type != 0) {
        $.ajax({
            url: 'showNomenclature',
            type: 'POST',
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            data: { table_name: type },
    
            beforeSend: function() {
                $('#loader').show();
            },
    
            success: function(result) {
                console.log(result)
            },
        })
    



    } else {

    }
}