<div class="main-table">
    <div class="table-name table-pagination">
        <h4>Experți</h4>
    </div>
    <table role="table" class="table-view" id="show-dossier-table">
      <thead class="table-column-names">
          <tr>
              <th class="table-column table-dossier-number">No.</th>
              <th class="table-column table-dossier-date">Numele</th>
              <th class="table-column table-applicant">Prenumele</th>
              <th class="table-column table-case-type">Funcția</th>
              <th class="table-column table-case-number">Data creării</th>
              <th class="table-column table-expert">Stare</th>
              <th class="table-column table-location">Stagiar</th>
          </tr>
      </thead>
      <tbody class="table-body" id="show-dossier-table-body">
          <input type="hidden" id="delete-check" value="{{$DeleteStatus}}">
          <input type="hidden" id="update-check" value="{{$UpdateStatus}}">
          <input type="hidden" id="routeAction" value="{{$routeAction}}">         
          @foreach ($data as $key=>$item)
                <tr onclick="employeeDetailedData('{{ $item->experts_id }}', 'expert')">
                    <td class="table-row">{{ $key+1 }}</td>
                    <td class="table-row">{{ $item->expert_name }}</td>
                    <td class="table-row">{{ $item->expert_surname }}</td>
                    <td class="table-row">{{ $item->function }}</td>
                    <td class="table-row">{{ $item->expert_created_at }}</td>
                    <td class="table-row">{{ $item->active }}</td>
                    <td class="table-row">{{ $item->novice }}</td>
                </tr>
          @endforeach
      </tbody>
    </table>
    <div class="table-pagination">
        <div class="table-pages">
            {{$data->links() }}  
        </div>
    </div>    
</div>

<hr class="main-panel-divider">

<div class="main-table">
    <div class="table-name table-pagination">
        <h4>Utilizatori</h4>
    </div>
    <table role="table" class="table-view" id="show-dossier-table">
      <thead class="table-column-names">
          <tr>
              <th class="table-column table-dossier-number">No.</th>
              <th class="table-column table-dossier-date">Nume</th>
              <th class="table-column table-applicant">Nume de utilizator</th>
              <th class="table-column table-case-type">Email</th>
              <th class="table-column table-case-number">Data creării</th>
              <th class="table-column table-expert">Tipul de acces</th>
          </tr>
      </thead>
      <tbody class="table-body" id="show-dossier-table-body">
          <input type="hidden" id="delete-check" value="{{$DeleteStatus}}">
          <input type="hidden" id="update-check" value="{{$UpdateStatus}}">
          <input type="hidden" id="routeAction" value="{{$routeAction}}">         
          @foreach ($data as $key=>$item)
                <tr onclick="employeeDetailedData('{{ $item->id }}', 'user')">
                    <td class="table-row">{{ $key+1 }}</td>
                    <td class="table-row">{{ $item->name }}</td>
                    <td class="table-row">{{ $item->username }}</td>
                    <td class="table-row">{{ $item->email }}</td>
                    <td class="table-row">{{ $item->user_created_at }}</td>
                    <td class="table-row">{{ $item->accesstype }}</td>
                </tr>
          @endforeach
      </tbody>
    </table>
    <div class="table-pagination">
        <div class="table-pages">
            {{$data->links() }}  
        </div>
    </div>    
</div>