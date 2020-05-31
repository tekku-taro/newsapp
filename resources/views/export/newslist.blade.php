<table>
  <thead>
  <tr>
    @foreach ($headers as $columnName)
    <th>{{ $columnName }}</th>        
    @endforeach
  </tr>
  </thead>
  <tbody>
  @foreach ($data as $row)
    <tr>
        @foreach ($headers as $columnName)
        <td>{{ $row->{$columnName} }}</td>
            
        @endforeach
    </tr>
  @endforeach
  </tbody>
</table>