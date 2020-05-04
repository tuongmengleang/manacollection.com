@extends('admin.layouts.contentLayoutMaster')

@section('title', 'Users Management')

@section('vendor-style')
        <!-- vendor css files -->
        <link rel="stylesheet" type="text/css" href="{{ asset('vendors/css/tables/datatable/datatables.min.css') }}">
@endsection
@section('content')

  <!-- Zero configuration table -->
  <section id="basic-datatable">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-content">
            <div class="card-body card-dashboard">
              <div class="table-responsive">
                <table class="table dt-data">
                  <thead>
                  <tr>
                    <th>Avatar</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Status</th>
                    <th>Role</th>
                    <th>Created At</th>
                    <th>Actions</th>
                  </tr>
                  </thead>
                  <tbody>

                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!--/ Zero configuration table -->

@endsection
@section('vendor-script')
        <!-- vendor files -->
        <script src="{{ asset('vendors/js/tables/datatable/datatables.min.js') }}"></script>
        <script src="{{ asset('vendors/js/tables/datatable/datatables.bootstrap4.min.js') }}"></script>
@endsection

@section('page-script')
  <script>
    $(document).ready(function () {
      $('.dt-data').DataTable({
        order: [[ 5, "desc" ]],
        processing: true,
        serverSide: true,
        ajax: '{{ route('admin.user.datatable') }}',
        columns: [
          { data: 'avatar', name: 'avatar', orderable: false, searchable: false, class: 'text-center' },
          { data: 'name', name: 'name' },
          { data: 'email', name: 'email' },
          { data: 'active', name: 'active', orderable: false, class: 'text-center' },
          { data: 'role', name: 'role', orderable: false, class: 'text-center' },
          { data: 'created_at', name: 'created_at' },
          { data: 'actions', name: 'actions', orderable: false, searchable: false, class: 'text-center' }
        ]
      });
    })
  </script>
  @endsection
