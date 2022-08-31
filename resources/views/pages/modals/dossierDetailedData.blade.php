    <form action="" method="post" enctype="multipart/form-data" id="modal-form" >
        @csrf

        {{-- inlocuire la metoda @method() --}}
        <input type="hidden" name="_method" value="DELETE" id="method-name">

        <div class="modal fade text-left" id="ModalShow" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="modal-title"></h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div id="data-container">
                            {{-- data from ajax --}}
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12" id="modal-buttons-container">
                            <button type="button" class="register-button update-btn" id="update-dossier-btn" 
                                        onclick="toogleUpdateDeleteButtons()">Update</button>
                            <button type="submit" class="register-button delete-btn" id="delete-dossier-btn">Delete</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>