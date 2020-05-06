<html>
<head>
  <link rel="stylesheet" href="{{ asset(mix('admin/css/bootstrap.css')) }}">
</head>
<body>
  <table class="table table-bordered">
    <thead>
    <tr>
      {{--    <th>Avatar</th>--}}
      <th>Name</th>
      <th>Email</th>
      <th>Status</th>
      <th>Role</th>
      <th>Created At</th>
    </tr>
    </thead>
    <tbody>
    @if ($admins)
      @foreach($admins as $admin)
        <tr>
          {{--          <td>--}}
          {{--            <div class="avatar avatar-lg">--}}
          {{--              <img src="{{ $admin->avatar }}" alt="">--}}
          {{--            </div>--}}
          {{--          </td>--}}
          <td>{{ $admin->name }}</td>
          <td>{{ $admin->email }}</td>
          <td>{!! $admin->active_badge !!}</td>
          <td>{!! $admin->role_badge !!}</td>
          <td>{{ $admin->created_at }}</td>

        </tr>
      @endforeach
    @endif
    </tbody>
  </table>

</body>
</html>
