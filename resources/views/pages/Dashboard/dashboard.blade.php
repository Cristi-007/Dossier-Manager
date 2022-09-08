@extends('layouts.app')  


@section('content')
<div class="main-panel-data-header" id="main-panel-data-header">
    <h1>Welcome {{ $user }}</h1> 
</div>

<div class="main-panel-content">
    <div class="data-view-container">
        <div class="data-view-table">
            <br>
            <div id="paginatedTable">
                @include('pages.DossierManagement.dossierPaginatedTable')
            </div>
        </div>
    </div>
</div>
    @include('pages.modals.employee_detailed_data')
@endsection
