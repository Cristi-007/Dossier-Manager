function showNomenclature(type) {
    if (type != 0) {

        $.ajax({
            url: 'showNomenclature',
            type: 'POST',
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            data: { table_name: type },

            success: function (data) {
                let tableColumnNames = "";
                let tableData = "";
                let departmentColumnNames = "";

                switch (type) {
                    case "action_types":
                        tableColumnNames += `<tr>
                                <th class="table-column table-dossier-number">No.</th>
                                <th class="table-column table-dossier-date">Tipul cauzei</th>
                                <th class="table-column table-applicant">Prescurtare</th>
                                <th class="table-column table-applicant">Stare</th>
                                <th class="table-column table-case-type">Data înregistrării</th>
                            </tr>`;
                        break;
                
                    case "examination_types":
                        tableColumnNames += `<tr>
                                <th class="table-column table-dossier-number">No.</th>
                                <th class="table-column table-dossier-date">Tipul examinării</th>
                                <th class="table-column table-applicant">Stare</th>
                                <th class="table-column table-case-type">Data înregistrării</th>
                            </tr>`;
                        break;


                    case "expertise_types":
                        tableColumnNames += `<tr>
                                <th class="table-column table-dossier-number">No.</th>
                                <th class="table-column table-dossier-date">Clasificarea expertizei</th>
                                <th class="table-column table-applicant">Stare</th>
                                <th class="table-column table-case-type">Data înregistrării</th>
                            </tr>`;
                        break;


                    case "object_types":
                        tableColumnNames += `<tr>
                                <th class="table-column table-dossier-number">No.</th>
                                <th class="table-column table-dossier-date">Tipul obiectului</th>
                                <th class="table-column table-applicant">Prescurtare</th>
                                <th class="table-column table-applicant">Stare</th>
                                <th class="table-column table-case-type">Data înregistrării</th>
                            </tr>`;
                        break;


                    case "report_types":
                        tableColumnNames += `<tr>
                                <th class="table-column table-dossier-number">No.</th>
                                <th class="table-column table-dossier-date">Genul expertizeii</th>
                                <th class="table-column table-applicant">Prescurtare</th>
                                <th class="table-column table-applicant">Stare</th>
                                <th class="table-column table-case-type">Data înregistrării</th>
                            </tr>`;
                        break;


                    case "subdivisions":
                        tableColumnNames += `<tr>
                                <th class="table-column table-dossier-number">No.</th>
                                <th class="table-column table-dossier-date">Denumire subdiviziune</th>
                                <th class="table-column table-applicant">Prescurtare</th>
                                <th class="table-column table-applicant">Stare</th>
                                <th class="table-column table-case-type">Data înregistrării</th>
                                <th class="table-column table-case-type">Action</th>
                            </tr>`;

                        departmentColumnNames += `<tr>
                                <th class="table-column table-dossier-number">No.</th>
                                <th class="table-column table-dossier-date">Denumire unitate</th>
                                <th class="table-column table-applicant">Prescurtare</th>
                                <th class="table-column table-applicant">Stare</th>
                                <th class="table-column table-case-type">Data înregistrării</th>
                                <th class="table-column table-case-type">Action</th>
                            </tr>`;
                        break;

                    default:
                        break;
                }

                
                $.each(data, function(index, element){
                    switch (type) {
                        case "action_types":
                            tableData += `<tr onclick="nomenclatureDetailedData(${ element.action_types_id }, '${ type}')">
                                    <td class="table-row">${ index+1 }</td>
                                    <td class="table-row">${ element.action_type }</td>
                                    <td class="table-row">${ element.abbreviation }</td>
                                    <td class="table-row">${ element.active }</td>
                                    <td class="table-row">${ element.created_at }</td>
                                </tr>`
                            break;
                    
                        case "examination_types":
                            tableData += `<tr onclick="nomenclatureDetailedData(${ element.examination_types_id }, '${ type}')">
                                    <td class="table-row">${ index+1 }</td>
                                    <td class="table-row">${ element.examination_type }</td>
                                    <td class="table-row">${ element.active }</td>
                                    <td class="table-row">${ element.created_at }</td>
                                </tr>`
                            break;
    
    
                        case "expertise_types":
                            tableData += `<tr onclick="nomenclatureDetailedData(${ element.expertise_types_id }, '${ type}')">
                                    <td class="table-row">${ index+1 }</td>
                                    <td class="table-row">${ element.expertise_type }</td>
                                    <td class="table-row">${ element.active }</td>
                                    <td class="table-row">${ element.created_at }</td>
                                </tr>`
                            break;
    
    
                        case "object_types":
                            tableData += `<tr onclick="nomenclatureDetailedData(${ element.object_types_id }, '${ type}')">
                                    <td class="table-row">${ index+1 }</td>
                                    <td class="table-row">${ element.object_type }</td>
                                    <td class="table-row">${ element.abbreviation }</td>
                                    <td class="table-row">${ element.active }</td>
                                    <td class="table-row">${ element.created_at }</td>
                                </tr>`
                            break;
    
    
                        case "report_types":
                            tableData += `<tr onclick="nomenclatureDetailedData(${ element.report_types_id }, '${ type}')">
                                    <td class="table-row">${ index+1 }</td>
                                    <td class="table-row">${ element.report_type }</td>
                                    <td class="table-row">${ element.abbreviation }</td>
                                    <td class="table-row">${ element.active }</td>
                                    <td class="table-row">${ element.created_at }</td>
                                </tr>`
                            break;
    
    
                        case "subdivisions":
                            tableData += `<tr onclick="refinedDepartmentsNomenclature(${ element.subdivisions_id })">
                                    <td class="table-row">${ index+1 }</td>
                                    <td class="table-row">${ element.subdivision }</td>
                                    <td class="table-row">${ element.abbreviation }</td>
                                    <td class="table-row">${ element.active }</td>
                                    <td class="table-row">${ element.created_at }</td>
                                    <td class="table-row"><a class="edit-table-btn" title="Edit" data-toggle="tooltip" 
                                                            onclick="nomenclatureDetailedData(${ element.subdivisions_id }, '${ type }')">
                                            <i class="material-icons">&#xE254;</i></a>
                                    </td>
                                </tr>`;
                            break;
    
                        default:
                            break;
                    }
                })


                if(type === 'subdivisions') {
                    finalHTMLdata = `<div class="main-table">
                    <div class="table-name table-pagination">
                        <h4>Subdiviziuni</h4>
                    </div>
                    <div class="table-header">
                    <div class="employee-register-btn">
                        <a href="/nomenclatures_register/Subdiviziuni" class="btn btn-primary btn-format" 
                                >+&nbsp; add new</a>
                    </div>
                    </div>
                    <table role="table" class="table-view" id="show-subdivisions-table">
                        <thead class="table-column-names">
                            ${ tableColumnNames }
                        </thead>
                    <tbody class="table-body" id="show-subdivisions-table-body">
                            ${ tableData }
                    </tbody> </table> </div> <br> <br>
                    
                    <hr class="main-panel-divider">
                    
                    <div class="main-table">
                        <div class="table-name table-pagination">
                            <h4>Unități</h4>
                        </div>
                        <div class="table-header">
                        <div class="employee-register-btn">
                        <a href="/nomenclatures_register/Unitati" class="btn btn-primary btn-format" 
                                >+&nbsp; add new</a>
                    </div>
                        </div>
                        <table role="table" class="table-view" id="show-departments-table">
                            <thead class="table-column-names">
                                ${ departmentColumnNames }
                            </thead>
                        <tbody class="table-body" id="show-departments-table-body">

                        </tbody> </table> </div> <br> <br> `;
                } else {
                    finalHTMLdata = `<div class="main-table">
                    <div class="table-name table-pagination">
                        <h4>${ $("#nomenclature-select option:selected").text()}</h4>
                    </div>
                    <div class="table-header">
                    <div class="employee-register-btn">
                        <a href="/nomenclatures_register/${ $("#nomenclature-select option:selected").text() }" class="btn btn-primary btn-format" 
                                >+&nbsp; add new</a>
                    </div>
                    </div>
                    <table role="table" class="table-view" id="show-nomenclatures-table">
                        <thead class="table-column-names">
                            ${ tableColumnNames }
                        </thead>
                    <tbody class="table-body" id="show-nomenclatures-table-body">
                            ${ tableData }
                    </tbody> </table> </div> <br> <br>`;
                }
   
                $('#paginatedTable').empty();
                $('#paginatedTable').append(finalHTMLdata)

            },
            fail: function () {
                console.log("Failed to load data!");
            }
        })

    } else {
        $('#paginatedTable').empty();
    }
}


function refinedDepartmentsNomenclature(id) {

       $.ajax({
            url: 'departments',
            type: 'POST',
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            data: { subdivision_id: id },

            success: function (data) {
                let tableData = "";
                let i = 1;

                $.each(data, function(index, element){
                    if (element['department'] === null && element['abbreviation'] === null) {

                    } else {
                        tableData += `<tr>
                            <td class="table-row">${ i++ }</td>
                            <td class="table-row">${ element.department }</td>
                            <td class="table-row">${ element.abbreviation }</td>
                            <td class="table-row">${ element.active }</td>
                            <td class="table-row">${ element.created_at }</td>
                            <td class="table-row"><a class="edit" title="Edit" data-toggle="tooltip" 
                                                    onclick="nomenclatureDetailedData(${ element.departments_id }, 'departments')">
                                                    <i class="material-icons">&#xE254;</i></a>
                        </td> </tr>`;
                    }
                })

                $('#show-departments-table-body').empty();
                $('#show-departments-table-body').append(tableData)
            }
        })
}


function nomenclatureDetailedData(id, type) {
 
    $.ajax({
        url: 'getNomenclatureDetailedData',
        type: 'POST',
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        data: { 
            item_id: id,
            DBtable: type,
        },

        success: function(result) {
            $.each(result, function(index, element){
                data = element
            })

            $('#ModalShow').modal("show")
            $('#modal-title').empty()
            $('#data-container').empty()

            switch (type) {
                case "action_types":
                    $('#modal-title').append(`${data.action_type}`)
                    $('#data-container').append(`
                        <input type="hidden" id="action_type_id" name="action_type_id" value="${data.action_types_id}">
            
                        <div class="" id="action_type_container">
                            <strong><label for="action_type">Tipul cauzei:</label></strong>
                            <input class="form-control" type="text" id="action_type" 
                                name="action_type" value="${data.action_type}">
                        <br> 
                        </div>
                            
                        <div class="" id="abbreviation_container">
                            <strong><label for="abbreviation">Prescurtare:</label></strong>
                            <input class="form-control" type="text" id="abbreviation" 
                                name="abbreviation" value="${data.abbreviation}">
                        <br>
                        </div>

                        <div class="" id="active_container">
                        <strong><label for="active">Stare:</label></strong>
                        <select class="form-control" name="active" id="active">
                            <option value="1" ${data.active === 1 ? 'selected': ''}>Activ</option>
                            <option value="0" ${data.active === 0 ? 'selected': ''}>Inactiv</option>
                        </select>
                        <br>
                        </div>`)

                    break;
            
                case "examination_types":
                    $('#modal-title').append(`${data.examination_type}`)
                    $('#data-container').append(`
                        <input type="hidden" id="examination_type_id" name="examination_type_id" value="${data.examination_types_id}">
            
                        <div class="" id="examination_type_container">
                            <strong><label for="examination_type">Tipul examinării:</label></strong>
                            <input class="form-control" type="text" id="examination_type" 
                                name="examination_type" value="${data.examination_type}">
                        <br> 
                        </div>

                        <div class="" id="active_container">
                        <strong><label for="active">Stare:</label></strong>
                        <select class="form-control" name="active" id="active">
                            <option value="1" ${data.active === 1 ? 'selected': ''}>Activ</option>
                            <option value="0" ${data.active === 0 ? 'selected': ''}>Inactiv</option>
                        </select>
                        <br>
                        </div>`)
                    break;


                case "expertise_types":
                    $('#modal-title').append(`${data.expertise_type}`)
                    $('#data-container').append(`
                        <input type="hidden" id="expertise_type_id" name="expertise_type_id" value="${data.expertise_types_id}">
            
                        <div class="" id="expertise_type_container">
                            <strong><label for="expertise_type">Clasificarea expertizei:</label></strong>
                            <input class="form-control" type="text" id="expertise_type" 
                                name="expertise_type" value="${data.expertise_type}">
                        <br> 
                        </div>

                        <div class="" id="active_container">
                        <strong><label for="active">Stare:</label></strong>
                        <select class="form-control" name="active" id="active">
                            <option value="1" ${data.active === 1 ? 'selected': ''}>Activ</option>
                            <option value="0" ${data.active === 0 ? 'selected': ''}>Inactiv</option>
                        </select>
                        <br>
                        </div>`)
                    break;


                case "object_types":
                    $('#modal-title').append(`${data.object_type}`)
                    $('#data-container').append(`
                        <input type="hidden" id="object_type_id" name="object_type_id" value="${data.object_types_id}">
            
                        <div class="" id="object_type_container">
                            <strong><label for="object_type">Tipul obiectului:</label></strong>
                            <input class="form-control" type="text" id="object_type" 
                                name="object_type" value="${data.object_type}">
                        <br> 
                        </div>
                            
                        <div class="" id="abbreviation_container">
                            <strong><label for="abbreviation">Prescurtare:</label></strong>
                            <input class="form-control" type="text" id="abbreviation" 
                                name="abbreviation" value="${data.abbreviation}">
                        <br>
                        </div>

                        <div class="" id="active_container">
                        <strong><label for="active">Stare:</label></strong>
                        <select class="form-control" name="active" id="active">
                            <option value="1" ${data.active === 1 ? 'selected': ''}>Activ</option>
                            <option value="0" ${data.active === 0 ? 'selected': ''}>Inactiv</option>
                        </select>
                        <br>
                        </div>`)
                    break;


                case "report_types":
                    $('#modal-title').append(`${data.report_type}`)
                    $('#data-container').append(`
                        <input type="hidden" id="report_type_id name="report_type_id" value="${data.report_types_id}">
            
                        <div class="" id="report_type_container">
                            <strong><label for="report_type">Genul expertizei:</label></strong>
                            <input class="form-control" type="text" id="report_type" 
                                name="report_type" value="${data.report_type}">
                        <br> 
                        </div>
                            
                        <div class="" id="abbreviation_container">
                            <strong><label for="abbreviation">Prescurtare:</label></strong>
                            <input class="form-control" type="text" id="abbreviation" 
                                name="abbreviation" value="${data.abbreviation}">
                        <br>
                        </div>

                        <div class="" id="active_container">
                        <strong><label for="active">Stare:</label></strong>
                        <select class="form-control" name="active" id="active">
                            <option value="1" ${data.active === 1 ? 'selected': ''}>Activ</option>
                            <option value="0" ${data.active === 0 ? 'selected': ''}>Inactiv</option>
                        </select>
                        <br>
                        </div>`)
                    break;


                case "subdivisions":
                    $('#modal-title').append(`${data.subdivision}`)
                    $('#data-container').append(`
                        <input type="hidden" id="subdivision_id" name="subdivision_id" value="${data.subdivisions_id}">
            
                        <div class="" id="subdivision_container">
                            <strong><label for="subdivision">Denumire subdiviziune:</label></strong>
                            <input class="form-control" type="text" id="subdivision" 
                                name="subdivision" value="${data.subdivision}">
                        <br> 
                        </div>
                            
                        <div class="" id="abbreviation_container">
                            <strong><label for="abbreviation">Prescurtare:</label></strong>
                            <input class="form-control" type="text" id="abbreviation" 
                                name="abbreviation" value="${data.abbreviation}">
                        <br>
                        </div>

                        <div class="" id="active_container">
                        <strong><label for="active">Stare:</label></strong>
                        <select class="form-control" name="active" id="active">
                            <option value="1" ${data.active === 1 ? 'selected': ''}>Activ</option>
                            <option value="0" ${data.active === 0 ? 'selected': ''}>Inactiv</option>
                        </select>
                        <br>
                        </div>`)
                    break;

                    case "departments":
                        $('#modal-title').append(`${data.department}`)
                        $('#data-container').append(`
                            <input type="hidden" id="department_id" name="department_id" value="${data.departments_id}">
                
                            <div class="" id="department_container">
                                <strong><label for="department">Denumire subdiviziune:</label></strong>
                                <input class="form-control" type="text" id="department" 
                                    name="department" value="${data.department}">
                            <br> 
                            </div>
                                
                            <div class="" id="abbreviation_container">
                                <strong><label for="abbreviation">Prescurtare:</label></strong>
                                <input class="form-control" type="text" id="abbreviation" 
                                    name="abbreviation" value="${data.abbreviation}">
                            <br>
                            </div>
    
                            <div class="" id="active_container">
                            <strong><label for="active">Stare:</label></strong>
                            <select class="form-control" name="active" id="active">
                                <option value="1" ${data.active === 1 ? 'selected': ''}>Activ</option>
                                <option value="0" ${data.active === 0 ? 'selected': ''}>Inactiv</option>
                            </select>
                            <br>
                            </div>`)
                        break;

                default:
                    break;
            }
        },
    })
}