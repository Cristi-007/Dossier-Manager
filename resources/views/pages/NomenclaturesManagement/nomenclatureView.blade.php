@extends('layouts.app')  


@section('content')
<div class="main-panel-data-header" id="main-panel-data-header">
    <h1>Manager Nomenclatoare</h1> 
</div>

<div class="main-panel-content">
    <div class="data-view-container">
        <div class="data-view-table">
            <div class="table-header">
                <div class="nomenclature-select-container">
                    <select class="form-select form-select-sm" name="nomenclature-select" id="nomenclature-select" onchange="showNomenclature(value)">
                        <option value="0" selected>Selectați nomenclatorul...</option>
                        <option value="action_types">Temei examinare / Tipul cauzei</option>
                        <option value="examination_types">Tipul examinării</option>
                        <option value="expertise_types">Clasificarea expertizei</option>
                        <option value="object_types">Tipul obiectului</option>
                        <option value="report_types">Genul expertizei</option>
                        <option value="subdivisions">Subdiviziuni / Unități</option> 
                    </select>
                </div>
            </div>
            <div id="paginatedTable">
                {{-- data from ajax --}}
            </div>
        </div>
    </div>
</div>
    {{-- @include('pages.modals.employee_detailed_data') --}}
@endsection