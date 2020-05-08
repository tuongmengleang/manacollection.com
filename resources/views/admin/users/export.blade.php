<!DOCTYPE html>
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
  <meta charset="utf-8">
  <title></title>
  <style>
    table {
      border-collapse: collapse;
      font-family: Tahoma, Geneva, sans-serif;
    }
    table td {
      padding: 15px;
    }
    table thead th, table thead td {
      background-color: #54585d;
      color: #ffffff;
      font-weight: bold;
      font-size: 13px;
      border: 1px solid #54585d;
      padding-top: 5px;
      padding-bottom: 5px;
    }
    table tbody td {
      color: #636363;
      border: 1px solid #dddfe1;
    }
    table tbody tr {
      background-color: #f9fafb;
    }
    table tbody tr:nth-child(odd) {
      background-color: #ffffff;
    }
  </style>
</head>
<body>
  <table class="table table-bordered">
    <thead>
    <tr>
      <th>Name</th>
      <th>Email</th>
      <th>Status</th>
      <th>Role</th>
      <th>Created At</th>
    </tr>
    </thead>
    <tbody>
    @if ($rows)
      @foreach($rows as $row)
        <tr>
          <td>{{ $row->name }}</td>
          <td>{{ $row->email }}</td>
          <td>{!! $row->active_badge !!}</td>
          <td>{!! $row->role_badge !!}</td>
          <td>{{ $row->created_at }}</td>
        </tr>
      @endforeach
    @endif
    </tbody>
  </table>

</body>
</html>
