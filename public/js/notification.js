function notify(notifyType) {

    switch (notifyType) {
        case "RegisterSuccess":
            $('.content').html(` <div class="alert alert_default alert_success">
                <div class="notification-header">
                    <p><strong>Success:</strong></p>
                    <button type="button" class="btn-close btn-close-size" data-bs-dismiss="alert" aria-label="Close"
                        style="background-size: 0.70em"></button>
                </div>
                <small><em>Dosar înregistrat.</em></small>
            </div> `);
        break;

        case "RegisterError":
            $('.content').html(` <div class="alert alert_default alert-error">
                <div class="notification-header">
                    <p><strong>Error:</strong></p>
                    <button type="button" class="btn-close btn-close-size" data-bs-dismiss="alert" aria-label="Close"
                        style="background-size: 0.70em"></button>
                </div>
                <small><em>A survenit o eroare la înregistrarea dosarului.</em></small>
            </div> `);
        break;

        case "UpdateSuccess":
            $('.content').html(` <div class="alert alert_default alert_success">
                <div class="notification-header">
                    <p><strong>Success:</strong></p>
                    <button type="button" class="btn-close btn-close-size" data-bs-dismiss="alert" aria-label="Close"
                        style="background-size: 0.70em"></button>
                </div>
                <small><em>Datele dosarului au fost actualizate.</em></small>
            </div> `);
        break;

        case "UpdateError":
            $('.content').html(` <div class="alert alert_default alert-error">
                <div class="notification-header">
                    <p><strong>Error:</strong></p>
                    <button type="button" class="btn-close btn-close-size" data-bs-dismiss="alert" aria-label="Close"
                        style="background-size: 0.70em"></button>
                </div>
                <small><em>A survenit o eroare la actualizarea datelor.</em></small>
            </div> `);
        break;

        case "DeleteSuccess":
            $('.content').html(` <div class="alert alert_default alert_success">
                <div class="notification-header">
                    <p><strong>Success:</strong></p>
                    <button type="button" class="btn-close btn-close-size" data-bs-dismiss="alert" aria-label="Close"
                        style="background-size: 0.70em"></button>
                </div>
                <small><em>Dosarul a fost șters.</em></small>
            </div> `);
        break;

        case "DeleteError":
            $('.content').html(` <div class="alert alert_default alert-error">
                <div class="notification-header">
                    <p><strong>Error:</strong></p>
                    <button type="button" class="btn-close btn-close-size" data-bs-dismiss="alert" aria-label="Close"
                        style="background-size: 0.70em"></button>
                </div>
                <small><em>A survenit o eroare la ștergerea înregistrării.</em></small>
            </div> `);
         break;


        case "EmployeeRegisterSuccess":
            $('.content').html(` <div class="alert alert_default alert_success">
                <div class="notification-header">
                    <p><strong>Success:</strong></p>
                    <button type="button" class="btn-close btn-close-size" data-bs-dismiss="alert" aria-label="Close"
                        style="background-size: 0.70em"></button>
                </div>
                <small><em>Angajat înregistrat cu succes (Expert + Utilizator).</em></small>
            </div> `);
         break

        case "EmployeeRegisterError":
            $('.content').html(` <div class="alert alert_default alert-error">
                <div class="notification-header">
                    <p><strong>Error:</strong></p>
                    <button type="button" class="btn-close btn-close-size" data-bs-dismiss="alert" aria-label="Close"
                        style="background-size: 0.70em"></button>
                </div>
                <small><em>A survenit o eroare la înregistrarea angajatului. Nu au fost efectuate modificări.</em></small>
            </div> `);
         break;


         case "EmployeeUpdateSuccess":
            $('.content').html(` <div class="alert alert_default alert_success">
                <div class="notification-header">
                    <p><strong>Success:</strong></p>
                    <button type="button" class="btn-close btn-close-size" data-bs-dismiss="alert" aria-label="Close"
                        style="background-size: 0.70em"></button>
                </div>
                <small><em>Datele angajatului au fost actualizate.</em></small>
            </div> `);
        break;

        case "EmployeeUpdateError":
            $('.content').html(` <div class="alert alert_default alert-error">
                <div class="notification-header">
                    <p><strong>Error:</strong></p>
                    <button type="button" class="btn-close btn-close-size" data-bs-dismiss="alert" aria-label="Close"
                        style="background-size: 0.70em"></button>
                </div>
                <small><em>A survenit o eroare la actualizarea datelor.</em></small>
            </div> `);
        break;
        

        case "NomenclatureRegisterSuccess":
            $('.content').html(` <div class="alert alert_default alert_success">
                <div class="notification-header">
                    <p><strong>Success:</strong></p>
                    <button type="button" class="btn-close btn-close-size" data-bs-dismiss="alert" aria-label="Close"
                        style="background-size: 0.70em"></button>
                </div>
                <small><em>Nomenclatorul a fost adăugat cu succes.</em></small>
            </div> `);
        break;



        case "NomenclatureRegisterError":
            $('.content').html(` <div class="alert alert_default alert-error">
                <div class="notification-header">
                    <p><strong>Error:</strong></p>
                    <button type="button" class="btn-close btn-close-size" data-bs-dismiss="alert" aria-label="Close"
                        style="background-size: 0.70em"></button>
                </div>
                <small><em>A survenit o eroare la adăugara nomenclatorului.</em></small>
            </div> `);
        break;
       

    
        default:
            $('.content').html(` <div class="alert alert_default">
                <div class="notification-header">
                    <p><strong>Unknown:</strong></p>
                    <button type="button" class="btn-close btn-close-size" data-bs-dismiss="alert" aria-label="Close"
                        style="background-size: 0.70em"></button>
                </div>
                <small><em>A survenit o eroare necunoscută.</em></small>
            </div> `);
        break;
    }

}


function showNotification(notifyType) {
    notify(notifyType);

    setTimeout(function() {
        $('.content').empty();
    }, 10000);

}


$(document).ready(function(e) {

    if (window.location.pathname === "/addDossier") {
        if (document.getElementById('register-check').value === "RegisterSuccess") {
            showNotification(document.getElementById('register-check').value)
        }

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



    if (window.location.pathname === "/employee_manager_register") {
        switch (document.getElementById('register-check').value) {
            case 'EmployeeRegisterSuccess':
                showNotification(document.getElementById('register-check').value)
                break;
        
            case 'EmployeeRegisterError':
                showNotification(document.getElementById('register-check').value)
                break;
        }
    }


    if (window.location.pathname === "/employee_manager_view") {

        switch (document.getElementById('routeAction').value) {
            case 'update':
                showNotification(document.getElementById('update-check').value)
                break;
        }
    }


    currentLocation = window.location.pathname;
    splittedCurrentLocation = currentLocation.split('/')
    if (splittedCurrentLocation[1] === "nomenclatures_register") {
        console.log(splittedCurrentLocation)

        if(document.getElementById('register-check').value !== 'free') {
            showNotification(document.getElementById('register-check').value)
        }

    }


      // if (window.location.pathname === "/nomenclatures_view") {

    //     switch (document.getElementById('routeAction').value) {
    //         case 'update':
    //             showNotification(document.getElementById('update-check').value)
    //             break;
    //     }
    // }

})