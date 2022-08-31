@extends('layouts.app')  


@section('content')

<div class="main-panel-data-header" id="main-panel-data-header">
    <h1>Manager Angajați</h1> 
</div>


<div class="main-panel-content">

    @if ($errors->any())
        <div class="alert alert-danger">
          <ul>
              @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
              @endforeach
          </ul>
        </div><br/>
      @endif

    <div class="table-name table-pagination" id="employee-register-header">
        <h4>Înregistrare Angajat</h4>
    </div>

        <form action="" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="admin-container">

                <div class="expert-register-container">
                    <h4>Date angajat / expert</h4>
                    <br>
                    <label for="expert_name">Nume expert</label>
                    <input class="form-control" type="text" id="expert_name" name="expert_name" placeholder="Nume" 
                                value="{{old('expert_name')}}">
                    <br>

                    <label for="expert_surname">Prenume expert</label>
                    <input class="form-control" type="text" id="expert_surname" name="expert_surname" placeholder="Prenume / Familie" 
                                value="{{old('expert_surname')}}">
                    <br> 

                    <label for="function">Funcția</label>
                    <input class="form-control" type="text" id="function" name="function" placeholder="Funcția" 
                                value="{{old('function')}}">
                    <br>
                    <br>

                <div class="checkbox-div">
                    <input type="checkbox" id="novice" name="novice"/>
                    <label for="novice" class="switch-label"></label>
                    <label for="novice" class="text-gray-700 novice-label">Stagiar</label>
                </div>
                <br>
                
                <div class="checkbox-div">
                    <input type="checkbox" id="active" name="active" checked/>
                    <label for="active" class="switch-label"></label>
                    <label for="active" class="text-gray-700 user-label">Utilizator activ</label>
                </div>
            </div>
        


            <div class="user-register-container">
                <h4>Date utilizator de sistem</h4>
                <br>

                <label for="name">Nume</label>
                    <input class="form-control" type="text" id="user_name" name="user_name" placeholder="Nume" 
                            value="{{old('user_name')}}" required>
                <br>

                <label for="username">Username</label>
                    <input class="form-control" type="text" id="username" name="username" placeholder="Username" 
                            value="{{old('username')}}" required>
                <br>

                <label for="email">Email</label>
                    <input class="form-control" type="email" id="email" name="email" placeholder="Email" 
                            value="{{old('email')}}" required>
                <br>

                <label for="password">Parola</label>
                    <input class="form-control" type="password" id="password" name="password" placeholder="Parola" 
                            value="{{old('password')}}" required autocomplete="new-password">
                <br>


                <div class="user-accesstype-container">
                    <label for="user-accesstype-label">Tipul de acces în sistem: </label>
                        <select class="form-select form-select-sm" name="user-accesstype" id="user-accesstype">
                            <option value="0" selected>. . . . .</option>
                            <option value="1">Administrator</option>
                            <option value="2">Worker</option>
                            <option value="3">Utilizator</option>
                        </select>
                </div>
            </div>
        </div>
        <div class="atention">
            <span style="font-size: 15px"> * expertul și utilizatorul de sistem sunt înregistrați concomitent!</span>
        </div>
        <div class="employee-btn-container">
            <button type="submit" class="register-button" id="submit">Integistreaza</button>
        </div>

        </form>
</div>
@endsection