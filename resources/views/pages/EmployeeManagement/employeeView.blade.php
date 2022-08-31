@extends('layouts.app')  


@section('content')
<div class="main-panel-data-header" id="main-panel-data-header">
    <h1>Manager Angajați</h1> 
</div>

<div class="main-panel-content">
    <div class="data-view-container">
        <div class="data-view-table">
            <div class="table-header">
                <div class="employee-register-btn">
                    <a href="{{route('RegisterEmployeeView')}}" class="btn btn-primary btn-format">+&nbsp; add new</a>
                </div>
            </div>
            <div id="paginatedTable">
                @include('pages.EmployeeManagement.employeePaginatedTable')
            </div>
        </div>
    </div>
</div>
    @include('pages.modals.employee_detailed_data')
@endsection