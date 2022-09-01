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

                switch (type) {
                    case "action_types":
                        tableColumnNames += `<tr>
                                <th class="table-column table-dossier-number">No.</th>
                                <th class="table-column table-dossier-date">Tipul cauzei</th>
                                <th class="table-column table-applicant">Abreviere</th>
                                <th class="table-column table-applicant">Stare</th>
                                <th class="table-column table-case-type">Data adăugării</th>
                            </tr>`;
                        break;
                
                    case "examination_types":
                        tableColumnNames += `<tr>
                                <th class="table-column table-dossier-number">No.</th>
                                <th class="table-column table-dossier-date">Tipul examinării</th>
                                <th class="table-column table-applicant">Stare</th>
                                <th class="table-column table-case-type">Data adăugării</th>
                            </tr>`;
                        break;


                    case "expertise_types":
                        tableColumnNames += `<tr>
                                <th class="table-column table-dossier-number">No.</th>
                                <th class="table-column table-dossier-date">Clasificarea expertizei</th>
                                <th class="table-column table-applicant">Stare</th>
                                <th class="table-column table-case-type">Data adăugării</th>
                            </tr>`;
                        break;


                    case "object_types":
                        tableColumnNames += `<tr>
                                <th class="table-column table-dossier-number">No.</th>
                                <th class="table-column table-dossier-date">Tipul obiectului</th>
                                <th class="table-column table-applicant">Abreviere</th>
                                <th class="table-column table-applicant">Stare</th>
                                <th class="table-column table-case-type">Data adăugării</th>
                            </tr>`;
                        break;


                    case "report_types":
                        tableColumnNames += `<tr>
                                <th class="table-column table-dossier-number">No.</th>
                                <th class="table-column table-dossier-date">Genul expertizeii</th>
                                <th class="table-column table-applicant">Abreviere</th>
                                <th class="table-column table-applicant">Stare</th>
                                <th class="table-column table-case-type">Data adăugării</th>
                            </tr>`;
                        break;


                    case "subdivisions":
                        tableColumnNames += `<tr>
                                <th class="table-column table-dossier-number">No.</th>
                                <th class="table-column table-dossier-date">Denumire subdiviziune</th>
                                <th class="table-column table-applicant">Abreviere</th>
                                <th class="table-column table-applicant">Stare</th>
                                <th class="table-column table-case-type">Data adăugării</th>
                            </tr>`;
                        break;

                    default:
                        break;
                }


                $.each(data, function(index, element){
                    switch (type) {
                        case "action_types":
                            tableData += `<tr onclick="">
                                    <td class="table-row">${ index+1 }</td>
                                    <td class="table-row">${ element.action_type }</td>
                                    <td class="table-row">${ element.abbreviation }</td>
                                    <td class="table-row">${ element.active }</td>
                                    <td class="table-row">${ element.creted_at }</td>
                                </tr>`
                            break;
                    
                        case "examination_types":
                            tableData += `<tr onclick="">
                                    <td class="table-row">${ index+1 }</td>
                                    <td class="table-row">${ element.examination_type }</td>
                                    <td class="table-row">${ element.active }</td>
                                    <td class="table-row">${ element.creted_at }</td>
                                </tr>`
                            break;
    
    
                        case "expertise_types":
                            tableData += `<tr onclick="">
                                    <td class="table-row">${ index+1 }</td>
                                    <td class="table-row">${ element.expertise_type }</td>
                                    <td class="table-row">${ element.active }</td>
                                    <td class="table-row">${ element.creted_at }</td>
                                </tr>`
                            break;
    
    
                        case "object_types":
                            tableData += `<tr onclick="">
                                    <td class="table-row">${ index+1 }</td>
                                    <td class="table-row">${ element.object_type }</td>
                                    <td class="table-row">${ element.abbreviation }</td>
                                    <td class="table-row">${ element.active }</td>
                                    <td class="table-row">${ element.creted_at }</td>
                                </tr>`
                            break;
    
    
                        case "report_types":
                            tableData += `<tr onclick="">
                                    <td class="table-row">${ index+1 }</td>
                                    <td class="table-row">${ element.report_type }</td>
                                    <td class="table-row">${ element.abbreviation }</td>
                                    <td class="table-row">${ element.active }</td>
                                    <td class="table-row">${ element.creted_at }</td>
                                </tr>`
                            break;
    
    
                        case "subdivisions":
                            tableData += `<tr onclick="">
                                    <td class="table-row">${ index+1 }</td>
                                    <td class="table-row">${ element.subdivision }</td>
                                    <td class="table-row">${ element.abbreviation }</td>
                                    <td class="table-row">${ element.active }</td>
                                    <td class="table-row">${ element.creted_at }</td>
                                </tr>`
                            break;
    
                        default:
                            break;
                    }
                })

                finalHTMLdata = `<div class="main-table">
                                    <div class="table-name table-pagination">
                                        <h4>${ $("#nomenclature-select option:selected").text()}</h4>
                                    </div>
                                    <div class="table-header">
                                    <div class="employee-register-btn">
                                        <a href="${route('NomenclaturesRegisterView')}" class="btn btn-primary btn-format" aria-valuenow="${ $("#nomenclature-select option:selected").text()}">+&nbsp; add new</a>
                                    </div>
                                    </div>
                                    <table role="table" class="table-view" id="show-dossier-table">
                                        <thead class="table-column-names">
                                            ${ tableColumnNames }
                                        </thead>
                                    <tbody class="table-body" id="show-dossier-table-body">
                                        <input type="hidden" id="update-check" value="{UpdateStatus}">
                                        <input type="hidden" id="routeAction" value="{routeAction}">
                                            ${ tableData }
                                    </tbody> </table> </div> <br> <br>`;
                                            
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