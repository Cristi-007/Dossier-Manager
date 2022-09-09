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

    @switch($table)
        @case("Temei examinare / Tipul cauzei")
            <div class="table-name table-pagination" id="employee-register-header">
                <h4>Înregistrare - Temei examinate / Tip cauză</h4>
            </div>

            <form action="{{ route('RegisterNomenclature') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="admin-container">
                    <div class="expert-register-container">
                        <input type="hidden" name="checker" id="checker" value="Temei examinare / Tipul cauzei">
                    
                        <label for="action_type">Tip cauză</label>
                        <input class="form-control" type="text" id="action_type" name="action_type" placeholder="...." 
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
            
                <input type="hidden" id="register-check" value="{{$notificationCheck}}">
            </div>
            <div class="atention">
                <span style="font-size: 15px"> * ex: "Cauza penala" -> "C.P.". </span>
            </div>
            <div class="employee-btn-container">
                <button type="submit" class="register-button" id="submit">Integistreaza</button>
            </div>
    
            </form>
            @break

        @case("Tipul examinării")
            <div class="table-name table-pagination" id="employee-register-header">
                <h4>Înregistrare - Tip examinare</h4>
            </div>

            <form action="{{ route('RegisterNomenclature') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="admin-container">
                    <div class="expert-register-container">
                        <input type="hidden" name="checker" id="checker" value="Tipul examinării">

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
            
                <input type="hidden" id="register-check" value="{{$notificationCheck}}">
            </div>
            <div class="atention">
                <span style="font-size: 15px"> * ex: "Dactiloscopică".</span>
            </div>
            <div class="employee-btn-container">
                <button type="submit" class="register-button" id="submit">Integistreaza</button>
            </div>
    
            </form>
            @break

        @case("Clasificarea expertizei")
            <div class="table-name table-pagination" id="employee-register-header">
                <h4>Înregistrare - Clasificare expertiză</h4>
            </div>

            <form action="{{ route('RegisterNomenclature') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="admin-container">
                    <div class="expert-register-container">
                        <input type="hidden" name="checker" id="checker" value="Clasificarea expertizei">

                        <label for="expertise_type">Clasificare expertiză</label>
                        <input class="form-control" type="text" id="expertise_type" name="expertise_type" placeholder="...." 
                                    value="{{old('expertise_type')}}">
                        <br>
    
                    <div class="checkbox-div">
                        <input type="checkbox" id="novice" name="novice" checked/>
                        <label for="novice" class="switch-label"></label>
                        <label for="novice" class="text-gray-700 novice-label">Înregistrare activă</label>
                    </div>
                    <br>
                </div>
        
                <input type="hidden" id="register-check" value="{{$notificationCheck}}">
            </div>
            <div class="atention">
                <span style="font-size: 15px"> * ex: "Repetată".</span>
            </div>
            <div class="employee-btn-container">
                <button type="submit" class="register-button" id="submit">Integistreaza</button>
            </div>
    
            </form>
            @break


        @case("Tipul obiectului")
            <div class="table-name table-pagination" id="employee-register-header">
                <h4>Înregistrare - Tip obiect</h4>
            </div>

            <form action="{{ route('RegisterNomenclature') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="admin-container">
                    <div class="object_type-container">
                        <input type="hidden" name="checker" id="checker" value="Tipul obiectului">

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
            
                <input type="hidden" id="register-check" value="{{$notificationCheck}}">
            </div>
            <div class="atention">
                <span style="font-size: 15px"> * ex: "Telefon mobil" -> "t/m".</span>
            </div>
            <div class="employee-btn-container">
                <button type="submit" class="register-button" id="submit">Integistreaza</button>
            </div>
    
            </form>
            @break


        @case("Genul expertizei")
            <div class="table-name table-pagination" id="employee-register-header">
                <h4>Înregistrare - Gen expertiză</h4>
            </div>

            <form action="{{ route('RegisterNomenclature') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="admin-container">
                    <div class="expert-register-container">
                        <input type="hidden" name="checker" id="checker" value="Genul expertizei">

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
            
                <input type="hidden" id="register-check" value="{{$notificationCheck}}">
            </div>
            <div class="atention">
                <span style="font-size: 15px"> * ex: "Rapord de expertiză judiciară" -> "R.E.J.".</span>
            </div>
            <div class="employee-btn-container">
                <button type="submit" class="register-button" id="submit">Integistreaza</button>
            </div>
    
            </form>
            @break


        @case("Subdiviziuni")
            <div class="table-name table-pagination" id="employee-register-header">
                <h4>Înregistrare - Subdiviziune</h4>
            </div>

            <form action="{{ route('RegisterNomenclature') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="admin-container">
                    <div class="expert-register-container">
                        <input type="hidden" name="checker" id="checker" value="Subdiviziuni">

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
            
                <input type="hidden" id="register-check" value="{{$notificationCheck}}">
            </div>
            <div class="atention">
                <span style="font-size: 15px"> * ex: "Inspectoratul genral al poliției" -> "I.G.P.".</span>
            </div>
            <div class="employee-btn-container">
                <button type="submit" class="register-button" id="submit">Integistreaza</button>
            </div>
    
            </form>
            @break  
            

            @case("Unitati")
            <div class="table-name table-pagination" id="employee-register-header">
                <h4>Înregistrare - Unitate</h4>
            </div>

            <form action="{{ route('RegisterNomenclature') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="admin-container">
                    <div class="expert-register-container">
                        <input type="hidden" name="checker" id="checker" value="Unitati">

                        <label for="subdivision_select">Subdiviziunea</label>
                        <select class="form-control" name="subdivision_select" id="subdivision_select">
                            <option value='0' selected> Selectați subdiviziunea</option>
                            @foreach ($subdivisions as $item)
                                <option value={{ $item->subdivisions_id }} {{ old('subdivision_select') }}> 
                                   {{$item->abbreviation}}
                                </option>
                            @endforeach
                        </select>
                        <br>

                        <label for="department">Denumire unitate</label>
                        <input class="form-control" type="text" id="department" name="department" placeholder="...." 
                                    value="{{old('department')}}">
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
            
                <input type="hidden" id="register-check" value="{{$notificationCheck}}">
            </div>
            <div class="atention">
                <span style="font-size: 15px"> * ex: "Inspectoratul de poliție Ciocana" -> "I.P. Ciocana".</span>
            </div>
            <div class="employee-btn-container">
                <button type="submit" class="register-button" id="submit">Integistreaza</button>
            </div>
    
            </form>
            @break  

    @endswitch
</div>
@endsection