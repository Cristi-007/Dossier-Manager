@extends('layouts.app')  


@section('content')

<div class="main-panel-data-header" id="main-panel-data-header">
    <h1>Manager Nomenclatoare</h1> 
</div>

<div class="main-panel-content">

    {{-- prelucrarea divului la erori --}}
    @if ($errors->any())
        <div class="alert alert-danger">
          <ul>
              @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
              @endforeach
          </ul>
        </div><br/>
      @endif

    @switch($nomenclature)
        @case("action_types")
            <div class="table-name table-pagination" id="employee-register-header">
                <h4>Înregistrare - Temei examinate / Tip cauză</h4>
            </div>

            <form action="" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="admin-container">
    
                    <div class="expert-register-container">
                    
                        <label for="action-type">Tip cauză</label>
                        <input class="form-control" type="text" id="action-type" name="action-type" placeholder="...." 
                                    value="{{old('action-type')}}">
                        <br>
    
                        <label for="abbreviation">Prescurtare</label>
                        <input class="form-control" type="text" id="abbreviation" name="abbreviation" placeholder="...." 
                                    value="{{old('abbreviation')}}">
                        <br> 
                        <br>
                    
                    <div class="checkbox-div">
                        <input type="checkbox" id="active" name="active" checked/>
                        <label for="active" class="switch-label"></label>
                        <label for="active" class="text-gray-700 user-label">Înregistrare activă</label>
                    </div>
                </div>
            
                <input type="hidden" id="test-id" value="{{$notificationCheck}}">
            </div>
    
            <div class="employee-btn-container">
                <button type="submit" class="register-button" id="submit">Integistreaza</button>
            </div>
    
            </form>
            @break

        @case("examination_types")
            <div class="table-name table-pagination" id="employee-register-header">
                <h4>Înregistrare - Tip examinare</h4>
            </div>

            <form action="" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="admin-container">
    
                    <div class="expert-register-container">
                        <label for="examination_type">Tip examinare</label>
                        <input class="form-control" type="text" id="examination_type" name="examination_type" placeholder="....." 
                                    value="{{old('examination_type')}}">
                        <br>
                   
                    <div class="checkbox-div">
                        <input type="checkbox" id="active" name="active" checked/>
                        <label for="active" class="switch-label"></label>
                        <label for="active" class="text-gray-700 user-label">Înregistrare activă</label>
                    </div>
                </div>
            
                <input type="hidden" id="test-id" value="{{$notificationCheck}}">
            </div>
    
            <div class="employee-btn-container">
                <button type="submit" class="register-button" id="submit">Integistreaza</button>
            </div>
    
            </form>
            @break

        @case("expertise_types")
            <div class="table-name table-pagination" id="employee-register-header">
                <h4>Înregistrare - Clasificare expertiză</h4>
            </div>

            <form action="" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="admin-container">
    
                    <div class="expert-register-container">
                        <label for="expertise_type">Clasificare expertiză</label>
                        <input class="form-control" type="text" id="expertise_type" name="expertise_type" placeholder="...." 
                                    value="{{old('expertise_type')}}">
                        <br>
    
                    <div class="checkbox-div">
                        <input type="checkbox" id="novice" name="novice"/>
                        <label for="novice" class="switch-label"></label>
                        <label for="novice" class="text-gray-700 novice-label">Înregistrare activă</label>
                    </div>
                    <br>
                </div>
        
                <input type="hidden" id="test-id" value="{{$notificationCheck}}">
            </div>
    
            <div class="employee-btn-container">
                <button type="submit" class="register-button" id="submit">Integistreaza</button>
            </div>
    
            </form>
            @break


        @case("object_types")
            <div class="table-name table-pagination" id="employee-register-header">
                <h4>Înregistrare - Tip obiect</h4>
            </div>

            <form action="" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="admin-container">
                    <div class="object_type-container">
                        <label for="object_type">Tip obiect</label>
                        <input class="form-control" type="text" id="object_type" name="object_type" placeholder="...." 
                                    value="{{old('object_type')}}">
                        <br>
    
                        <label for="abbreviation">Prescurtare</label>
                        <input class="form-control" type="text" id="abbreviation" name="abbreviation" placeholder="...." 
                                    value="{{old('abbreviation')}}">
                        <br> 

                    <div class="checkbox-div">
                        <input type="checkbox" id="active" name="active" checked/>
                        <label for="active" class="switch-label"></label>
                        <label for="active" class="text-gray-700 user-label">Înregistrare activă</label>
                    </div>
                </div>
            
                <input type="hidden" id="test-id" value="{{$notificationCheck}}">
            </div>
    
            <div class="employee-btn-container">
                <button type="submit" class="register-button" id="submit">Integistreaza</button>
            </div>
    
            </form>
            @break


        @case("report_types")
            <div class="table-name table-pagination" id="employee-register-header">
                <h4>Înregistrare - Gen expertiză</h4>
            </div>

            <form action="" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="admin-container">
    
                    <div class="expert-register-container">
                        <label for="report_type">Gen expertiză</label>
                        <input class="form-control" type="text" id="report_type" name="report_type" placeholder="...." 
                                    value="{{old('report_type')}}">
                        <br>
    
                        <label for="abbreviation">Prescurtare</label>
                        <input class="form-control" type="text" id="abbreviation" name="abbreviation" placeholder="...." 
                                    value="{{old('abbreviation')}}">
                        <br> 
                    
                    <div class="checkbox-div">
                        <input type="checkbox" id="active" name="active" checked/>
                        <label for="active" class="switch-label"></label>
                        <label for="active" class="text-gray-700 user-label">Înregistrare activă</label>
                    </div>
                </div>
            
                <input type="hidden" id="test-id" value="{{$notificationCheck}}">
            </div>
    
            <div class="employee-btn-container">
                <button type="submit" class="register-button" id="submit">Integistreaza</button>
            </div>
    
            </form>
            @break


        @case("subdivisions")
            <div class="table-name table-pagination" id="employee-register-header">
                <h4>Înregistrare - Subdiviziune / Unitate</h4>
            </div>

            <form action="" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="admin-container">
    
                    <div class="expert-register-container">
                        <label for="subdivision">Denumire subdiviziune</label>
                        <input class="form-control" type="text" id="subdivision" name="subdivision" placeholder="...." 
                                    value="{{old('subdivision')}}">
                        <br>
    
                        <label for="abbreviation">Prescurtare</label>
                        <input class="form-control" type="text" id="abbreviation" name="abbreviation" placeholder="...." 
                                    value="{{old('abbreviation')}}">
                        <br> 
                    
                    <div class="checkbox-div">
                        <input type="checkbox" id="active" name="active" checked/>
                        <label for="active" class="switch-label"></label>
                        <label for="active" class="text-gray-700 user-label">Înregistrare activă</label>
                    </div>
                </div>
            
    
                <input type="hidden" id="test-id" value="{{$notificationCheck}}">
            </div>
    
            <div class="employee-btn-container">
                <button type="submit" class="register-button" id="submit">Integistreaza</button>
            </div>
    
            </form>
            @break

    @endswitch



</div>
@endsection