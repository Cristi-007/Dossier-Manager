@extends('layouts.app')  


@section('content')
<div class="main-panel-data-header" id="main-panel-data-header">
    <h1>Lista dosarelor înregistrate</h1> 
</div>

<div class="main-panel-content">
    <div class="data-view-container">
        <div class="data-view-table">
            <div class="table-header">
                <div class="entries-per-page">
                    <div class="entries">
                        <select class="form-select form-select-sm" name="entries-per-page" id="entries-per-page" onchange="">
                            <option value="10">10</option>
                            <option value="20">20</option>
                            <option value="50">50</option>
                        </select>
                    </div>
                    <span> înregistrări pe pagină</span>
                </div>
                <div class="table-search">
                    <div class="search-box">
                        <input type="text" placeholder="Search..." class="search" id="search" oninput="searchDossier(value)">
                    </div>
                </div>
            </div>
            <div id="paginatedTable">
                @include('pages.DossierManagement.dossierPaginatedTable')
            </div>
        </div>
    </div>
</div>
    @include('pages.modals.dossierDetailedData')
@endsection