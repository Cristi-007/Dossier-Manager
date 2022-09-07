<div class="main-table">
    <table role="table" class="table-view" id="show-dossier-table">
      <thead class="table-column-names">
          <tr>
              <th class="table-column table-dossier-number">Nr. dosar</th>
              <th class="table-column table-dossier-date">Data dosar</th>
              <th class="table-column table-applicant">Solicitant</th>
              <th class="table-column table-case-type">Tip cauză</th>
              <th class="table-column table-case-number">Număr cauză</th>
              <th class="table-column table-expert">Expert / Executor</th>
              <th class="table-column table-location">Locație pachet(e)</th>
              <th class="table-column table-dossier-state">Stare dosar</th>
          </tr>
      </thead>
      <tbody class="table-body" id="show-dossier-table-body">
          <input type="hidden" id="delete-check" value="{{$DeleteStatus}}">
          <input type="hidden" id="update-check" value="{{$UpdateStatus}}">
          <input type="hidden" id="routeAction" value="{{$routeAction}}">         
          @foreach ($dossiers as $dossier)
              <tr onclick="showDossierDetailedData('{{ $dossier->dossiers_id }}')">
                  <td class="table-row">{{ $dossier->dossier_number }}</td>
                  <td class="table-row">{{ $dossier->dossier_date }}</td>
                  <td class="table-row">{{ $dossier->subdivision_abbreviation == '' ? $dossier->subdivision : 
                                              ($dossier->department_abbreviation == 'NoDepartment' ? $dossier->subdivision : $dossier->subdivision_abbreviation . ' / ') }}
                                        {{ $dossier->department_abbreviation == 'NoDepartment' ? '' : $dossier->department_abbreviation }} 
                                          <br> 
                                        {{ $dossier->case_officer }}</td>
                  <td class="table-row">{{ $dossier->action_type }}</td>
                  <td class="table-row">{{ $dossier->action_number }}</td>
                  <td class="table-row">{{ $dossier->expert }}</td>
                  <td class="table-row">{{ $dossier->location }}</td>
                  <td class="table-row">{{ $dossier->dossier_state }}</td>
              </tr>
          @endforeach
      </tbody>
    </table>
</div>
<div class="table-pagination">
    <div class="table-pages">
        {{$dossiers->links() }}  
    </div>
</div>