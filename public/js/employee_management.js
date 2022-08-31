function employeeDetailedData(id, section) {
    
    $.ajax({
        url: 'expertDetailedData',
        type: 'POST',
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        data: { 
            item_id: id,
            section: section
        },

        beforeSend: function() {
            $('#loader').show();
        },

        success: function(result) {
            $('#ModalShow').modal("show")
            $('#modal-title').empty()
            $('#data-container').empty()

            switch (section) {
                case 'expert':
                    $('#modal-title').append(`${result.data[0].expert_name} ${result.data[0].expert_surname}`)
                    $('#data-container').append(`
                        <input type="hidden" id="expert_id" name="expert_id" value="${result.data[0].experts_id}">
        
                            <div class="" id="expert_name_container">
                                <strong><label for="expert_name">Nume expert:</label></strong>
                                <input class="form-control" type="text" id="expert_name" 
                                    name="expert_name" value="${result.data[0].expert_name}">
                            <br> 
                            </div>
                        
                            <div class="" id="expert_surname_container">
                                <strong><label for="expert_surname">Prenume expert:</label></strong>
                                <input class="form-control" type="text" id="expert_surname" 
                                    name="expert_surname" value="${result.data[0].expert_surname}">
                            <br>
                            </div>
        
                            <div class="" id="function_container">
                                <strong><label for="function">Funcția:</label></strong>
                                <input class="form-control" type="text" id="function" name="function" value="${result.data[0].function}">
                            <br>
                            </div>
        
                            <div class="" id="novice_container">
                            <strong><label for="novice">Stagiar:</label></strong>
                            <select class="form-control" name="novice" id="novice">
                                <option value="1" ${result.data[0].novice == 'Da' ? 'selected': ''}>Da</option>
                                <option value="0" ${result.data[0].novice == 'Nu' ? 'selected': ''}>Nu</option>
                            </select>
                            <br>
                            </div>
        
                            <div class="" id="active_container">
                            <strong><label for="active">Stare:</label></strong>
                            <select class="form-control" name="active" id="active">
                                <option value="1" ${result.data[0].active == 'Activ' ? 'selected': ''}>Activ</option>
                                <option value="0" ${result.data[0].active == 'Inactiv' ? 'selected': ''}>Inactiv</option>
                            </select>
                            <br>
                            </div>
                            </div> `)
                    break;
            
                case 'user':
                    $('#modal-title').append(`${result.data[0].username}`)
                    $('#data-container').append(`
                        <input type="hidden" id="user_id" name="user_id" value="${result.data[0].id}">
        
                            <div class="" id="name_container">
                                <strong><label for="name">Nume:</label></strong>
                                <input class="form-control" type="text" id="name" 
                                    name="name" value="${result.data[0].name}">
                            <br> 
                            </div>
                        
                            <div class="" id="username_container">
                                <strong><label for="username">Nume de utilizator:</label></strong>
                                <input class="form-control" type="text" id="username" 
                                    name="username" value="${result.data[0].username}">
                            <br>
                            </div>
        
                            <div class="" id="email_container">
                                <strong><label for="function">Email:</label></strong>
                                <input class="form-control" type="text" id="email" name="email" value="${result.data[0].email}">
                            <br>
                            </div>
        
                            <div class="" id="accesstype_container">
                            <strong><label for="accesstype">Tipul de acces în sistem:</label></strong>
                            <select class="form-control" name="accesstype" id="accesstype">
                                <option value="Administrator" ${result.data[0].accesstype == 'Administrator' ? 'selected': ''}>Administrator</option>
                                <option value="Worker" ${result.data[0].accesstype == 'Worker' ? 'selected': ''}>Worker</option>
                                <option value="Utilizator" ${result.data[0].accesstype == 'User' ? 'selected': ''}>Utilizator</option>
                            </select>
                            <br>
                            </div>
                            </div> `)
                    break;
            }  
        },
    })
}


function showPaginatedEmployeeList(page){
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
}




$(document).ready(function(e) {

    $(document).on('click', '.pagination a', function (event) {
        event.preventDefault();
        var pageNumber = $(this).attr('href').split('page=')[1];
        showPaginatedEmployeeList(pageNumber);
    });


 
})