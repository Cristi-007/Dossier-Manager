
function notify(notifyType) {

    switch (notifyType) {
        case "RegisterSuccess":
            $('.content').html(` <div class="alert alert_default alert-success">
                <div class="notification-header">
                    <p><strong>Success:</strong></p>
                    <button type="button" class="btn-close btn-close-size" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                <small><em>Dosar înregistrat.</em></small>
            </div> `);
        break;

        case "RegisterError":
            $('.content').html(` <div class="alert alert_default alert-error">
                <div class="notification-header">
                    <p><strong>Error:</strong></p>
                    <button type="button" class="btn-close btn-close-size" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                <small><em>A survenit o eroare la înregistrarea dosarului.</em></small>
            </div> `);
        break;

        case "UpdateSuccess":
            $('.content').html(` <div class="alert alert_default alert-success">
                <div class="notification-header">
                    <p><strong>Success:</strong></p>
                    <button type="button" class="btn-close btn-close-size" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                <small><em>Datele dosarului au fost actualizate.</em></small>
            </div> `);
        break;

        case "UpdateError":
            $('.content').html(` <div class="alert alert_default alert-error">
                <div class="notification-header">
                    <p><strong>Error:</strong></p>
                    <button type="button" class="btn-close btn-close-size" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                <small><em>A survenit o eroare la actualizarea datelor.</em></small>
            </div> `);
        break;

        case "DeleteSuccess":
            $('.content').html(` <div class="alert alert_default alert-success">
                <div class="notification-header">
                    <p><strong>Success:</strong></p>
                    <button type="button" class="btn-close btn-close-size" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                <small><em>Dosarul a fost șters.</em></small>
            </div> `);
        break;

        case "DeleteError":
            $('.content').html(` <div class="alert alert_default alert-error">
                <div class="notification-header">
                    <p><strong>Error:</strong></p>
                    <button type="button" class="btn-close btn-close-size" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                <small><em>A survenit o eroare la ștergerea înregistrării.</em></small>
            </div> `);
         break;


        case "EmployeeRegisterSuccess":
            $('.content').html(` <div class="alert alert_default alert-success">
                <div class="notification-header">
                    <p><strong>Success:</strong></p>
                    <button type="button" class="btn-close btn-close-size" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                <small><em>Angajat înregistrat cu succes (Expert + Utilizator).</em></small>
            </div> `);
         break

        case "EmployeeRegisterError":
            $('.content').html(` <div class="alert alert_default alert-error">
                <div class="notification-header">
                    <p><strong>Error:</strong></p>
                    <button type="button" class="btn-close btn-close-size" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                <small><em>A survenit o eroare la înregistrarea angajatului. Nu au fost efectuate modificări.</em></small>
            </div> `);
         break;


         case "EmployeeUpdateSuccess":
            $('.content').html(` <div class="alert alert_default alert-success">
                <div class="notification-header">
                    <p><strong>Success:</strong></p>
                    <button type="button" class="btn-close btn-close-size" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                <small><em>Datele angajatului au fost actualizate.</em></small>
            </div> `);
        break;

        case "EmployeeUpdateError":
            $('.content').html(` <div class="alert alert_default alert-error">
                <div class="notification-header">
                    <p><strong>Error:</strong></p>
                    <button type="button" class="btn-close btn-close-size" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                <small><em>A survenit o eroare la actualizarea datelor.</em></small>
            </div> `);
        break;
        

    
        default:
            $('.content').html(` <div class="alert alert_default">
                <div class="notification-header">
                    <p><strong>Unknown:</strong></p>
                    <button type="button" class="btn-close btn-close-size" data-bs-dismiss="alert" aria-label="Close"></button>
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
