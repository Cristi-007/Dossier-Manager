@extends('layouts.app')  
{{-- ['activePage' => 'table', 'titlePage' => __('Table List')] --}}

@section('content')
<div class="main-panel-data-header" id="main-panel-data-header">
    <h1>Înregistrare dosar</h1> 
</div>

<div class="main-panel-content">
    <div class="data-add-container">
{{-- error shower --}}
    @if ($errors->any())
        <div class="alert alert-danger">
          <ul>
              @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
              @endforeach
          </ul>
        </div><br/>
      @endif

        <form action="" method="POST" enctype="multipart/form-data">
            @csrf

            <label for="subdivision">Instituție</label>
            <select class="form-control" name="subdivision" id="subdivision" onchange="refineDepartments(value)"> 
                <option value='0'> ..... </option>
                @foreach ($subdivisions as $item)
                    <option value={{ $item->subdivisions_id }} {{ old('subdivision') == $item->subdivisions_id ? 'selected' : '0' }}> 
                        {{ ucwords(strtolower($item->subdivision)) }}
                    </option>
                @endforeach
            </select>
            <br>


            <label for="department">Unitate</label>
                <select class="form-control" name="department" id="department" aria-valuenow="0">
            </select>
            <br>

            <label class="switch">
                <input type="checkbox" checked>
                <span class="slider round"></span>
            </label>

            <label for="case_officer_name">Nume</label>
            <input class="form-control" type="text" id="case_officer_name" name="case_officer_name" placeholder="Nume" value="{{old('case_officer_name')}}">
            <br> 
            
            <label for="case_officer_surname">Prenume</label>
            <input class="form-control" type="text" id="case_officer_surname" name="case_officer_surname" 
                    placeholder="Prenume / Familie" value="{{old('case_officer_surname')}}">
            <br>
            <hr class="main-panel-divider">
        
            
            <label for="dossier_number">Număr dosar</label>
            <input class="form-control" type="text" id="dossier_number" name="dossier_number" placeholder="34/12/1-C-" value="{{old('dossier_number')}}">
            <br>

            <label for="dossier_date">Data înregistrării</label>
            <input class="form-control" type="date" id="dossier_date" name="dossier_date" value="{{ old('dossier_date', date('Y-m-d')) }}"
                min="2000-01-01" max="2050-12-31">
            <br>

            <label for="request_no">Număr solicitare</label>
            <input class="form-control" type="text" id="request_no" name="request_no" placeholder="Numar solicitare" value="{{old('request_no')}}">
            <br>

            <label for="request_date">Data solicitării</label>
            <input class="form-control" type="date" id="request_date" name="request_date" value="{{ old('request_date', date('Y-m-d')) }}"
            min="2000-01-01" max="2050-12-31">
            <br>

            <hr class="main-panel-divider">

            <label for="case_type">Temei examinare</label>
            <select class="form-control" name="case_type" id="case_type">
                <option value='0' selected> ..... </option>
                @foreach ($actionTypes as $item)
                    <option value={{ $item->action_types_id }} {{ old('case_type') == $item->action_types_id ? 'selected' : '0' }}> 
                        {{ ucwords(strtolower($item->action_type)) }} / {{ $item->abbreviation}} 
                    </option>
                @endforeach
            </select>
            <br>
        
            <label for="case_no">Număr cauză</label>
            <input class="form-control" type="text" id="case_no" name="case_no" placeholder="Numar Cauza" value="{{old('case_no')}}">
            <br>

            <hr class="main-panel-divider">

            <label for="package_no">Număr pachete</label>
            <input class="form-control" type="number" id="package_no" name="package_no" placeholder="....." 
                min="1" max="500" value="{{old('package_no')}}">
            <br>

            <label for="storage_location">Locația de păstrare</label>
            <input class="form-control" type="text" name="storage_location" id="storage_location" placeholder="Raft..." value="{{old('storage_location')}}">
            <br>

            <hr class="main-panel-divider">

            <label for="expertise_type">Tipul expertizei</label>
            <select class="form-control" name="expertise_type" id="expertise_type">
                <option value='0' selected> ..... </option>
                @foreach ($expertiseTypes as $item)
                    <option value={{ $item->expertise_types_id }} {{ old('expertise_type') == $item->expertise_types_id ? 'selected' : '0' }}> 
                        {{ ucwords(strtolower($item->expertise_type)) }} 
                    </option>
                @endforeach
            </select>
            <br>

            <label for="expertise_deadline">Termen</label>
            <select class="form-control" name="expertise_deadline" id="expertise_deadline" aria-valuetext="In termen" aria-valuenow="1">
                <option value="1">În termen</option>
                <option value='2' {{ old('expertise_deadline') == 2 ? 'selected' : '1' }}>Urgent</option>
            </select>
            <br>


            <label for="dossier_state">Stare dosar</label>
            <select class="form-control" name="dossier_state" id="dossier_state" aria-valuetext="Camera de pastrare" aria-valuenow="1">
                <option value="1">Camera de păstrare</option>
                <option value="2" {{ old('dossier_state') == 2 ? 'selected' : '' }}>În executare</option>
                <option value="3" {{ old('dossier_state') == 3 ? 'selected' : '' }}>Executat</option>
            </select>
            <br>

            <label for="expert">Expert</label>
            <select class="form-control" name="expert" id="expert" aria-valuetext="Nume/Prenume" aria-valuenow="0">
                <option value='0' selected> ..... </option>
                @foreach ($experts as $item)
                    @if ($item->active == 1)
                    <option value={{ $item->experts_id }} {{ old('expert') == $item->experts_id ? 'selected' : '' }}> 
                        {{ ucwords(strtolower($item->expert_name)) .' '. 
                            ucwords(strtolower($item->expert_surname)) }} 
                    </option>
                    @endif
                @endforeach
            </select>
            <br>

            <hr class="main-panel-divider">
            
            <label for="file">Act dispunere (pdf)</label>
            <input type="file" class="form-control" id="file" name="file" value="{{old('file')}}">
            <br>

            <label for="notes">Detalii / Note</label>
            <textarea class="form-control" name="notes" id="notes" placeholder="....." >{{old("notes")}}</textarea>
            <br>

            <input type="hidden" id="test-id" value="{{$notificationCheck}}">
            <button type="submit" class="register-button" id="submit">Integistreaza</button>
        </form>
    </div>
</div>
@endsection