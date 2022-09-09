<div class="sidebar">

    <!--
        Tip 1: de schimbat culoarea: purple | azure | green | orange | danger
        Tip 2: de schimbat / adaugat imagine la sidebar
    -->

  <div class="logo">
    <a href="{{route('dashboard')}}" class="simple-text logo-normal">
      {{ __('Evidence') }}
    </a>
  </div>

    <hr class="sidebar-divider">

  <div class="user nav-item">
    <div class="user-image">
      <div class="user-avatar">
        <img src="images/User_18.jpg" alt="" class="user-avatar-img">
      </div>
      <div class="user-name" id="user-name">
        <span>{{ ucwords(strtolower( str_replace('.', ' ', Auth::user()->username) )) }}</span>
      </div>
      
    </div>
  </div>
   <hr class="sidebar-divider">


  <div class="sidebar-wrapper">
    <ul class="nav">
      <li class="nav-item">
        <a class="nav-link" href="{{ route('dashboard') }}">
          <span class="sidebar-mini"> D </span>
          <span class="sidebar-normal">Dashboard </span>
        </a>
      </li>

@if (Auth::user()->accesstype == "Administrator")
<li class="nav-item">
  <a class="nav-link" data-bs-toggle="collapse" href="#admin-panel" id="collapse-parent" aria-expanded="false" aria-controls="admin-panel">
    <span class="sidebar-mini"> A </span>
    <span class="sidebar-normal">{{ __('Administrator') }}
      <b class="caret"></b>
    </span>
  </a>

  <div class="collapse" id="admin-panel">
    <ul class="nav">
      <li class="nav-item">
        <a class="nav-link" href="{{ route('ShowEmployeeList') }}">
          <span class="sidebar-mini"> MA </span>
          <span class="sidebar-normal"> {{ __('Manager Angajați') }} </span>
        </a>
      </li>
       <li class="nav-item">
        <a class="nav-link" href="{{ route('NomenclaturesView') }}">
          <span class="sidebar-mini"> MN </span>
          <span class="sidebar-normal">{{ __('Manager Nomenclatoare') }} </span>
        </a>
      </li>
    </ul>
  </div>

</li>
@endif

      <li class="nav-item">
        <a class="nav-link" href="{{ route('NewDossiser') }}">
          <span class="sidebar-mini"> ID </span>
          <span class="sidebar-normal">{{ __('Întegistrare Dosar') }} </span>
        </a>
      </li>


      <li class="nav-item">
        <a class="nav-link" href="{{ route('ShowDossierList') }}">
          <span class="sidebar-mini"> VD </span>
          <span class="sidebar-normal">{{ __('Vizualizare Dosare') }} </span>
        </a>
      </li>

    </ul>
  </div>
</div>











{{-- 

<div class="sidebar" data-color="orange" data-background-color="black">
    


    <div class="logo">
      <a href="{{ route('home') }}" class="simple-text logo-normal">
        {{ __('SEI Database') }}
      </a>
    </div>
    <div class="sidebar-wrapper">
      <ul class="nav">


        <li class="nav-item">
            <a class="nav-link" href="">
              <span class="sidebar-mini"> AD </span>
              <span class="sidebar-normal">{{ __('Adauga Dosar') }} </span>
            </a>
          </li>


          <li class="nav-item">
            <a class="nav-link" href="">
              <span class="sidebar-mini"> SD </span>
              <span class="sidebar-normal"> {{ __('Sterge Dosar') }} </span>
            </a>
          </li>


          <li class="nav-item">
            <a class="nav-link" href="">
              <span class="sidebar-mini"> LD </span>
              <span class="sidebar-normal"> {{ __('Lista Dosarelor') }} </span>
            </a>
          </li>

      </ul>
    </div>
  </div>
   --}}