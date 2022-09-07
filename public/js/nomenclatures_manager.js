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
                            tableData += `<tr onclick="nomenclatureDetailedData(${ element.action_types_id, type })">
                                    <td class="table-row">${ index+1 }</td>
                                    <td class="table-row">${ element.action_type }</td>
                                    <td class="table-row">${ element.abbreviation }</td>
                                    <td class="table-row">${ element.active }</td>
                                    <td class="table-row">${ element.creted_at }</td>
                                </tr>`
                            break;
                    
                        case "examination_types":
                            tableData += `<tr onclick="nomenclatureDetailedData(${ element.examination_types_id, type })">
                                    <td class="table-row">${ index+1 }</td>
                                    <td class="table-row">${ element.examination_type }</td>
                                    <td class="table-row">${ element.active }</td>
                                    <td class="table-row">${ element.creted_at }</td>
                                </tr>`
                            break;
    
    
                        case "expertise_types":
                            tableData += `<tr onclick="nomenclatureDetailedData(${ element.examination_types_id, type })">
                                    <td class="table-row">${ index+1 }</td>
                                    <td class="table-row">${ element.expertise_type }</td>
                                    <td class="table-row">${ element.active }</td>
                                    <td class="table-row">${ element.creted_at }</td>
                                </tr>`
                            break;
    
    
                        case "object_types":
                            tableData += `<tr onclick="nomenclatureDetailedData(${ element.object_types_id, type })">
                                    <td class="table-row">${ index+1 }</td>
                                    <td class="table-row">${ element.object_type }</td>
                                    <td class="table-row">${ element.abbreviation }</td>
                                    <td class="table-row">${ element.active }</td>
                                    <td class="table-row">${ element.creted_at }</td>
                                </tr>`
                            break;
    
    
                        case "report_types":
                            tableData += `<tr onclick="nomenclatureDetailedData(${ element.reports_id, type })">
                                    <td class="table-row">${ index+1 }</td>
                                    <td class="table-row">${ element.report_type }</td>
                                    <td class="table-row">${ element.abbreviation }</td>
                                    <td class="table-row">${ element.active }</td>
                                    <td class="table-row">${ element.creted_at }</td>
                                </tr>`
                            break;
    
    
                        case "subdivisions":
                            tableData += `<tr onclick="refinedDepartmentsNomenclature(${ element.subdivisions_id })">
                                    <td class="table-row">${ index+1 }</td>
                                    <td class="table-row">${ element.subdivision }</td>
                                    <td class="table-row">${ element.abbreviation }</td>
                                    <td class="table-row">${ element.active }</td>
                                    <td class="table-row">${ element.creted_at }</td>
                                    <td class="table-row"><a class="edit-table-btn" title="Edit" data-toggle="tooltip" 
                                                            onclick='nomenclatureDetailedData(${ element.subdivisions_id, type })'>
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
                        <input type="hidden" id="update-check" value="{UpdateStatus}">
                        <input type="hidden" id="routeAction" value="{routeAction}">
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
                        <input type="hidden" id="update-check" value="{UpdateStatus}">
                        <input type="hidden" id="routeAction" value="{routeAction}">
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
    
            beforeSend: function() {
                $('#loader').show();
            },

            success: function (data) {
                let tableData = "";
                let i = 1;

                $.each(data, function(index, element){

                    if (element['department'] === null && element['abbreviation'] === null) {

                    } else {
                        tableData += `<tr onclick="">
                            <td class="table-row">${ i++ }</td>
                            <td class="table-row">${ element.department }</td>
                            <td class="table-row">${ element.abbreviation }</td>
                            <td class="table-row">${ element.active == 0 ? 'Inactiv' : 'Activ'}</td>
                            <td class="table-row">${ element.creted_at }</td>
                            <td class="table-row"><a class="edit" title="Edit" data-toggle="tooltip" 
                                                    onclick='nomenclatureDetailedData(${ element.subdivisions_id, 'departments' })'>
                                                    <i class="material-icons">&#xE254;</i></a>
                        </td> </tr>`;
                    }
                })

                $('#show-departments-table-body').empty();
                $('#show-departments-table-body').append(tableData)
            }
        })
}


function nomenclatureDetailedData(id, test) {
    
    $.ajax({
        url: 'getNomenclatureDetailedData',
        type: 'POST',
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        data: { 
            item_id: id,
            DBtable: document.getElementById('nomenclature-select').value
        },

        beforeSend: function() {
            $('#loader').show();
        },

        success: function(result) {

            console.log(result)

            // let test = document.getElementById('nomenclature-select').value;

            $('#ModalShow').modal("show")
            $('#modal-title').empty()
            $('#data-container').empty()

            $('#modal-title').append(`${result[0].subdivision}`)


            switch (test) {
                case "action_types":
                   


                    break;
            
                case "examination_types":

                    break;


                case "expertise_types":

                    break;


                case "object_types":

                    break;


                case "report_types":

                    break;


                case "subdivisions":
                    $('#modal-title').append(`${result[0].subdivision}`)

                    $('#data-container').append(`
                        <input type="hidden" id="expert_id" name="expert_id" value="${result[0].experts_id}">
                
                        <div class="" id="expert_name_container">
                            <strong><label for="expert_name">Nume expert:</label></strong>
                            <input class="form-control" type="text" id="expert_name" 
                                    name="expert_name" value="${result[0].expert_name}">
                                    <br> 
                                    </div>
                                
                                    <div class="" id="expert_surname_container">
                                        <strong><label for="expert_surname">Prenume expert:</label></strong>
                                        <input class="form-control" type="text" id="expert_surname" 
                                            name="expert_surname" value="${result[0].expert_surname}">
                                    <br>
                                    </div>
                
                                    <div class="" id="function_container">
                                        <strong><label for="function">Funcția:</label></strong>
                                        <input class="form-control" type="text" id="function" name="function" value="${result[0].function}">
                                    <br>
                                    </div>
                
                                    <div class="" id="novice_container">
                                    <strong><label for="novice">Stagiar:</label></strong>
                                    <select class="form-control" name="novice" id="novice">
                                        <option value="1" ${result[0].novice == 'Da' ? 'selected': ''}>Da</option>
                                        <option value="0" ${result[0].novice == 'Nu' ? 'selected': ''}>Nu</option>
                                    </select>
                                    <br>
                                    </div>
                
                                    <div class="" id="active_container">
                                    <strong><label for="active">Stare:</label></strong>
                                    <select class="form-control" name="active" id="active">
                                        <option value="1" ${result[0].active == 'Activ' ? 'selected': ''}>Activ</option>
                                        <option value="0" ${result[0].active == 'Inactiv' ? 'selected': ''}>Inactiv</option>
                                    </select>
                                    <br>
                                    </div>
                                    </div> `)
                    break;

                default:
                    break;
            }




            // switch (section) {
            //     case 'expert':
            //         
            //         break;
            
            //     case 'user':
            //         $('#modal-title').append(`${result.data[0].username}`)
            //         $('#data-container').append(`
            //             <input type="hidden" id="user_id" name="user_id" value="${result.data[0].id}">
        
            //                 <div class="" id="name_container">
            //                     <strong><label for="name">Nume:</label></strong>
            //                     <input class="form-control" type="text" id="name" 
            //                         name="name" value="${result.data[0].name}">
            //                 <br> 
            //                 </div>
                        
            //                 <div class="" id="username_container">
            //                     <strong><label for="username">Nume de utilizator:</label></strong>
            //                     <input class="form-control" type="text" id="username" 
            //                         name="username" value="${result.data[0].username}">
            //                 <br>
            //                 </div>
        
            //                 <div class="" id="email_container">
            //                     <strong><label for="function">Email:</label></strong>
            //                     <input class="form-control" type="text" id="email" name="email" value="${result.data[0].email}">
            //                 <br>
            //                 </div>
        
            //                 <div class="" id="accesstype_container">
            //                 <strong><label for="accesstype">Tipul de acces în sistem:</label></strong>
            //                 <select class="form-control" name="accesstype" id="accesstype">
            //                     <option value="Administrator" ${result.data[0].accesstype == 'Administrator' ? 'selected': ''}>Administrator</option>
            //                     <option value="Worker" ${result.data[0].accesstype == 'Worker' ? 'selected': ''}>Worker</option>
            //                     <option value="Utilizator" ${result.data[0].accesstype == 'User' ? 'selected': ''}>Utilizator</option>
            //                 </select>
            //                 <br>
            //                 </div>
            //                 </div> `)
            //         break;
            // }  
        },
    })
}