function refineDepartments(value) {
    if(value != 0) {
        $('#department').prop('disabled', false);

        $.ajax({
            url: 'departments',
            type: 'POST', 
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            data: {
                subdivision_id: value
            },
            success: function (response) {
                $('#department').empty()
                                .append('<option value="0" selected> ..... </option>')

                $.each(response, function(index, element){
                    $('#department').append(`<option value="${element.departments_id}">${element.abbreviation}</option>`)
                })
            }
        })
    } else {
        $('#department').empty()
        .append('<option value="0" selected> ..... </option>')

        $('#department').prop('disabled', true);
    }
    
}


function showDossierDetailedData(id) {

    $.ajax({
        url: 'showDetailedDossier',
        type: 'POST',
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        data: { dossier_id: id },

        beforeSend: function() {
            $('#loader').show();
        },

        success: function(result) {
            $('#ModalShow').modal("show")
            $('#modal-title').empty()

            const dossier = result.data;
            const subdivisions = result.subdivisions;
            const actionTypes = result.actionTypes;
            const expertiseTypes = result.expertiseTypes;
            const experts = result.experts;
            const departments = result.departments;

            let htmlSubdivisions = "";
            let htmlActionTypes = "";
            let htmlExpertiseTypes = "";
            let htmlExperts = "";
            let htmlDepartments = "";


            $.each(dossier, function(index, element){
                $('#modal-title').append(`Dosar ${element.subdivision_code} ${element.dossier_number} din ${element.dossier_date}`)
                
                // getting ready select options
                $.each(subdivisions, function(index, subdivision) {
                    htmlSubdivisions += '<option value="' + subdivision.subdivisions_id + '" ' + (element.subdivision_id == subdivision.subdivisions_id ? 'selected': '') + '>';
                    htmlSubdivisions += subdivision.subdivision + ' / ' + subdivision.abbreviation + '</option>';  
                })

                $.each(departments, function(index, department) {
                    htmlDepartments += '<option value="' + department.departments_id + '" ' + (element.subdivision_id == department.subdivision_id ? 'selected': '') + '>';
                    htmlDepartments += department.abbreviation + '</option>';
                })

                $.each(actionTypes, function(index, actionType) {
                    htmlActionTypes += '<option value="' + actionType.action_types_id + '" ' + (element.action_type_id == actionType.action_types_id ? 'selected': '') + '>';
                    htmlActionTypes += actionType.action_type + ' / ' + actionType.abbreviation + '</option>';  
                })


                $.each(expertiseTypes, function(index, expertiseType) {
                    htmlExpertiseTypes += '<option value="' + expertiseType.expertise_types_id + '" ' + (element.expertise_type_id == expertiseType.expertise_types_id ? 'selected': '') + '>';
                    htmlExpertiseTypes += expertiseType.expertise_type + '</option>';  
                })


                $.each(experts, function(index, expert) {
                    htmlExperts += '<option value="' + expert.experts_id + '" ' + (element.expert_id == expert.experts_id ? 'selected': '') + '>';
                    htmlExperts += expert.expert_name + ' ' + expert.expert_surname + '</option>';  
                })
            })


            $('#data-container').empty()
            $.each(dossier, function(index, element){
                $('#data-container').append(`

                <input type="hidden" id="dossier_id" name="dossier_id" value="${element.dossiers_id}">

                <div class="" id="subdivision_container">
                    <strong><label for="subdivision">Instituție:</label></strong>
                    <select class="form-control" name="subdivision" id="subdivision" onchange="refineDepartments(value)" disabled>
                        <option value='0'> ..... </option>
                            ${ htmlSubdivisions }
                    </select>
                <br>
                </div>

                <div class="" id="department_container">
                    <strong><label for="department">Unitate:</label></strong>
                    <select class="form-control" name="department" id="department" disabled>
                        <option value='0'> ..... </option>
                        ${ htmlDepartments }
                </select>
                <br>
                </div>

                <div class="" id="case_officer_name_container">
                    <strong><label for="case_officer_name">Nume</label></strong>
                    <input class="form-control" type="text" id="case_officer_name" 
                            name="case_officer_name" value="${element.officer_name}" disabled>
                <br> 
                </div>
                
                <div class="" id="case_officer_surname_container">
                    <strong><label for="case_officer_surname">Prenume</label></strong>
                    <input class="form-control" type="text" id="case_officer_surname" 
                            name="case_officer_surname" value="${element.officer_surname}" disabled>
                <br>
                </div>

                <div class="" id="dossier_number_container">
                    <strong><label for="dossier_number">Număr dosar:</label></strong>
                    <input class="form-control" type="text" id="dossier_number" name="dossier_number" value="${element.dossier_number}" disabled>
                <br>
                </div>

                <div class="" id="dossier_date_container">
                    <strong><label for="dossier_date">Data înregistrării:</label></strong>
                    <input class="form-control" type="date" id="dossier_date" name="dossier_date" value="${element.dossier_date}"
                            min="2000-01-01" max="2050-12-31" disabled>
                <br>
                </div>
                
                <div class="" id="request_no_container">
                    <strong><label for="request_no">Număr solicitare:</label></strong>
                    <input class="form-control" type="text" id="request_no" name="request_no" value="${element.request_number}" disabled>
                <br>
                </div>

                <div class="" id="request_date_container">
                    <strong><label for="request_date">Data solicitării:</label></strong>
                    <input class="form-control" type="date" id="request_date" name="request_date" value="${element.request_date}"
                            min="2000-01-01" max="2050-12-31" disabled>
                <br>
                </div>

                <div class="" id="case_type_container">
                <strong><label for="case_type">Temei examinare:</label></strong>
                <select class="form-control" name="case_type" id="case_type" disabled>
                    <option value='0'> ..... </option>
                    ${ htmlActionTypes }
                </select>
                <br>
                </div>

                <div class="" id="case_no_container">
                    <strong><label for="case_no">Număr cauză:</label></strong>
                    <input class="form-control" type="text" id="case_no" name="case_no" value="${element.action_number}" disabled>
                <br>
                </div>

                <div class="" id="package_no_container">
                    <strong><label for="package_no">Număr pachete:</label></strong>
                    <input class="form-control" type="text" id="package_no" name="package_no" value="${element.received_packages_number}" disabled>
                <br>
                </div>

                <div class="" id="storage_location_container">
                    <strong><label for="storage_location">Locația de păstrare:</label></strong>
                    <input class="form-control" type="text" id="storage_location" name="storage_location" value="${element.location}" disabled>
                <br>
                </div>

                <div class="" id="expertise_type_container">
                <strong><label for="expertise_type">Tipul expertizei:</label></strong>
                <select class="form-control" name="expertise_type" id="expertise_type" disabled>
                    <option value='0'> ..... </option>
                    ${ htmlExpertiseTypes }
                </select>
                <br>
                </div>

                <div class="" id="expertise_deadline_container">
                <strong><label for="expertise_deadline">Termen:</label></strong>
                <select class="form-control" name="expertise_deadline" id="expertise_deadline" disabled>
                    <option value="1" ${element.expertise_deadline == 1 ? 'selected': ''}>În termen</option>
                    <option value='2' ${element.expertise_deadline == 2 ? 'selected': ''}>Urgent</option>
                </select>
                <br>
                </div>

                <div class="" id="dossier_state_container">
                <strong><label for="dossier_state">Stare dosar:</label></strong>
                <select class="form-control" name="dossier_state" id="dossier_state" disabled>
                    <option value="1" ${element.dossier_state == 'Camera de păstrare' ? 'selected': ''}>Camera de păstrare</option>
                    <option value="2" ${element.dossier_state == 'În executare' ? 'selected': ''}>În executare</option>
                    <option value="3" ${element.dossier_state == 'Executat' ? 'selected': ''}>Executat</option>
                </select>
                <br>
                </div>

                <div class="" id="expert_container">
                <strong><label for="expert">Expert:</label></strong>
                <select class="form-control" name="expert" id="expert" disabled>
                    <option value='0'> ..... </option>
                    ${ htmlExperts }
                </select>
                <br>
                </div>

                <div class="" id="file_container">
                    <strong><label for="file">Act dispunere (pdf):</label></strong>
                    <input type="file" class="form-control" id="file" name="file" value="${element.scanned_request}" disabled>
                <br>
                </div>

                <div class="" id="notes_container">
                    <strong><label for="notes">Detalii / Note:</label></strong>
                    <textarea class="form-control" name="notes" id="notes" disabled>${element.notes}</textarea>
                <br>
                </div> `)
            })
        },
    })
}


function registerDossier() {
    if (document.getElementById('test-id').value === "RegisterSuccess") {
        showNotification(document.getElementById('test-id').value)
    }
}


function toogleUpdateDeleteButtons(){
    var updateBTN = document.getElementById('update-dossier-btn');
    var deleteBTN = document.getElementById('delete-dossier-btn');
    var parentForm = document.querySelector('#data-container');
    
    if(updateBTN.textContent === "Update") {
        $.ajax({
            url: '',
            type: 'get',
            data: {},
            success: function() {
                $('#modal-buttons-container').empty();
    
                $('#modal-buttons-container').append(`
                    <button type="submit" class="register-button update-btn update-btn-active" id="update-dossier-btn" 
                            onclick="updateDossier()">Save</button>
                    <button type="button" class="register-button" id="delete-dossier-btn" 
                            onclick="toogleUpdateDeleteButtons()">Cancel</button>
                `)

                document.getElementById('method-name').value = 'PUT';
            }
        })

        
        parentForm.querySelector('#subdivision').toggleAttribute('disabled');
        parentForm.querySelector('#department').toggleAttribute('disabled');
        parentForm.querySelector('#case_officer_name').toggleAttribute('disabled');
        parentForm.querySelector('#case_officer_surname').toggleAttribute('disabled');
        parentForm.querySelector('#dossier_number').toggleAttribute('disabled');
        parentForm.querySelector('#dossier_date').toggleAttribute('disabled');
        parentForm.querySelector('#request_no').toggleAttribute('disabled');
        parentForm.querySelector('#request_date').toggleAttribute('disabled');
        parentForm.querySelector('#case_type').toggleAttribute('disabled');
        parentForm.querySelector('#case_no').toggleAttribute('disabled');
        parentForm.querySelector('#package_no').toggleAttribute('disabled');
        parentForm.querySelector('#storage_location').toggleAttribute('disabled');
        parentForm.querySelector('#expertise_type').toggleAttribute('disabled');
        parentForm.querySelector('#expertise_deadline').toggleAttribute('disabled');
        parentForm.querySelector('#dossier_state').toggleAttribute('disabled');
        parentForm.querySelector('#expert').toggleAttribute('disabled');
        parentForm.querySelector('#file').toggleAttribute('disabled');
        parentForm.querySelector('#notes').toggleAttribute('disabled');

        return
    } 
    
    if(updateBTN.textContent !== "Update") {
        $.ajax({
            url: '',
            type: 'get',
            data: {},
            success: function() {
                $('#modal-buttons-container').empty();
    
                $('#modal-buttons-container').append(`
                    <button type="button" class="register-button update-btn" id="update-dossier-btn" 
                            onclick="toogleUpdateDeleteButtons()">Update</button>
                    <button type="submit" class="register-button delete-btn" id="delete-dossier-btn">Delete</button>
                `)

                document.getElementById('method-name').value = 'DELETE';
            }
        })


        parentForm.querySelector('#subdivision').toggleAttribute('disabled');
        parentForm.querySelector('#department').toggleAttribute('disabled');
        parentForm.querySelector('#case_officer_name').toggleAttribute('disabled');
        parentForm.querySelector('#case_officer_surname').toggleAttribute('disabled');
        parentForm.querySelector('#dossier_number').toggleAttribute('disabled');
        parentForm.querySelector('#dossier_date').toggleAttribute('disabled');
        parentForm.querySelector('#request_no').toggleAttribute('disabled');
        parentForm.querySelector('#request_date').toggleAttribute('disabled');
        parentForm.querySelector('#case_type').toggleAttribute('disabled');
        parentForm.querySelector('#case_no').toggleAttribute('disabled');
        parentForm.querySelector('#package_no').toggleAttribute('disabled');
        parentForm.querySelector('#storage_location').toggleAttribute('disabled');
        parentForm.querySelector('#expertise_type').toggleAttribute('disabled');
        parentForm.querySelector('#expertise_deadline').toggleAttribute('disabled');
        parentForm.querySelector('#dossier_state').toggleAttribute('disabled');
        parentForm.querySelector('#expert').toggleAttribute('disabled');
        parentForm.querySelector('#file').toggleAttribute('disabled');
        parentForm.querySelector('#notes').toggleAttribute('disabled');

        return
    }
}


function searchDossier(value) {
        $.ajax({
            url: 'search' + "?page=" + 1,
            type: 'POST', 
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            data: {
                search_data: value,
                entryPerPage: document.getElementById('entries-per-page').value
            },
            success: function (response) {
                $('#paginatedTable').html(response);
            },
            fail: function () {
                console.log("Failed to load data!");
            }
        })
}


function showPaginatedDossierList(page) {
    $.ajax({
        url: "/viewDossier" + "?page=" + page,
        type: 'GET',
        data: { 
            entryPerPage: document.getElementById('entries-per-page').value
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
        showPaginatedDossierList(pageNumber);
    });



    $(document).on('change', '#entries-per-page', function(event) {
        event.preventDefault();
        var pageNumber = 1;
        showPaginatedDossierList(pageNumber);
    })
    

    if (window.location.pathname === "/addDossier") {
        registerDossier()
        refineDepartments(document.getElementById('subdivision').value);
    }


    if (window.location.pathname === "/viewDossier") {

        switch (document.getElementById('routeAction').value) {
            case 'update':
                showNotification(document.getElementById('update-check').value)
                break;
        
            case 'delete':
                showNotification(document.getElementById('delete-check').value)
                break;
        }
    }

 
})