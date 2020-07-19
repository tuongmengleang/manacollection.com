@extends('admin.layouts.contentLayoutMaster')

@section('title', __('general.users_management'))

@section('vendor-style')
        <!-- vendor css files -->
        <link rel="stylesheet" href="{{ asset(mix('admin/vendors/css/forms/select/select2.min.css')) }}">
        <link rel="stylesheet" href="{{ asset(mix('admin/vendors/css/tables/datatable/datatables.min.css')) }}">
        <link rel="stylesheet" href="{{ asset(mix('admin/vendors/css/file-uploaders/dropzone.min.css')) }}">
        <link rel="stylesheet" href="{{ asset(mix('admin/vendors/css/tables/datatable/extensions/dataTables.checkboxes.css')) }}">
        <link rel="stylesheet" href="{{ asset('admin/vendors/css/notiflix/notiflix-2.1.2.min.css') }}">
        <link rel="stylesheet" href="{{ asset('admin/vendors/css/sweetalert2-dark/dark.min.css') }}">
@endsection
@section('page-style')
  {{-- Page css files --}}
  <link rel="stylesheet" href="{{ asset(mix('admin/css/plugins/file-uploaders/dropzone.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('admin/css/pages/data-list-view.css')) }}">

  <style>
    .validate.text{
      font-size: 13px;
      font-family: "Comic Sans MS";
    }
    .validate.text.error-validate{
      color: red;
    }

    .validate-input-error{
      border: 2px solid 	#FA8072 !important;
    }
    .select-all{
      position: absolute;
      top: -5px;
      right: 10px;
    }
    .select-all a{
      font-size: 22px;
    }
  </style>
@endsection

@section('content')

  <!-- Data list view starts -->
  <section id="data-list-view" class="data-list-view-header">
    <div class="action-btns d-none">
      <div class="btn-dropdown mr-1 mb-1">
        <div class="btn-group dropdown actions-dropodown">
          <button type="button" class="btn btn-white px-1 py-1 dropdown-toggle waves-effect waves-light" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Actions
          </button>
          <div class="dropdown-menu">
            <a class="dropdown-item" href="{{ route('admin.user.export', 'excel') }}" id="dt-export__excel"><i class="fa fa-file-excel-o"></i>Excel</a>
            <a class="dropdown-item" href="{{ route('admin.user.export', 'pdf') }}" id="dt-export__pdf"><i class="fa fa-file-pdf-o"></i>Pdf</a>
{{--            <a class="dropdown-item" href="#" id="dt-export__print"><i class="feather icon-file"></i>Print</a>--}}
          </div>
        </div>
      </div>
    </div>

    <!-- DataTable starts -->
    <div class="table-responsive">
      <table class="table data-list-view" width="100%">
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
    <!-- DataTable ends -->

  </section>
  <!-- Data list view end -->

  <!-- Admin Modal -->
  <div class="modal fade" id="inlineForm" tabindex="-1" role="dialog" aria-labelledby="permissionModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-centered modal-dialog-scrollable" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="permissionModalTitle">Admin Create</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form id="user-form">
          <div class="modal-body">
            <input type="hidden" name="hidden">
            <div class="row">
              <div class="col-12">
                <div class="form-group">
                  <label for="name">Name<strong class="text-danger">*</strong></label>
                  <input type="text" id="name" name="name" class="form-control" placeholder="Name">
                  <span id="name_validate_error" class="validate text error-validate"></span>
                </div>
              </div>
              <div class="col-12">
                <div class="form-group">
                  <label for="email">Email</label>
                  <input type="email" id="email" name="email" class="form-control" placeholder="Email address">
                  <span id="email_validate_error" class="validate text error-validate"></span>
                </div>
              </div>
              <div class="col-12">
                <div class="form-group">
                  <label for="password">Password</label>
                  <input type="password" id="password" name="password" class="form-control" placeholder="Password">
                  <span id="password_validate_error" class="validate text error-validate"></span>
                </div>
              </div>
              <div class="col-12">
                <label for="assign_role">Assign Role</label>
                <div class="form-group">
                  <div class="select-all">
                    <a href="javascript:void(0)" id="select-all" class="text-primary" title="Select All"><i class='feather icon-check'></i></a>
                    <a href="javascript:void(0)" id="deselect-all" class="text-danger" title="Deselect All"><i class='feather icon-x'></i></a>
                  </div>
                  <select name="assign_role" id="assign_role" class="select2 form-control" multiple="multiple">
                    @if(isset($roles))
                      @foreach($roles as $id => $roles)
                        <option value="{{ $id }}" data-select2-id="{{ $id }}">{{ $roles }}</option>
                      @endforeach
                    @endif
                  </select>
                  <span id="role_validate_error" class="validate text error-validate"></span>
                </div>
              </div>

            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary btn-save">{{ __('general.save_changes') }}</button>
            <button type="button" class="btn btn-warning" data-dismiss="modal">{{ __('general.cancel') }}</button>
          </div>
        </form>
      </div>
    </div>
  </div>


@endsection
@section('vendor-script')
        <!-- vendor files -->
        <script src="{{ asset(mix('admin/vendors/js/forms/select/select2.full.min.js')) }}"></script>
        <script src="{{ asset(mix('admin/vendors/js/extensions/dropzone.min.js')) }}"></script>
        <script src="{{ asset(mix('admin/vendors/js/tables/datatable/datatables.min.js')) }}"></script>
        <script src="{{ asset(mix('admin/vendors/js/tables/datatable/datatables.buttons.min.js')) }}"></script>
        <script src="{{ asset(mix('admin/vendors/js/tables/datatable/datatables.bootstrap4.min.js')) }}"></script>
        <script src="{{ asset(mix('admin/vendors/js/tables/datatable/buttons.bootstrap.min.js')) }}"></script>
        <script src="{{ asset(mix('admin/vendors/js/tables/datatable/dataTables.select.min.js')) }}"></script>
        <script src="{{ asset(mix('admin/vendors/js/tables/datatable/datatables.checkboxes.min.js')) }}"></script>
        <script src="{{ asset('admin/vendors/js/notiflix/notiflix-2.1.2.min.js') }}"></script>
        <script src="{{ asset('admin/vendors/js/sweetalert2/sweetalert2.all.min.js') }}"></script>

@endsection

@section('page-script')
  <script src="{{ asset('admin/vendors/js/forms/select/select2.js') }}"></script>
{{--  <script src="{{ asset(mix('admin/js/scripts/users/data-list-view.js')) }}"></script>--}}
  <script>
    $(document).ready(function() {
      "use strict"
      $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });
      // init list view datatable
      var dataListView = $(".data-list-view").DataTable({
        responsive: false,
        // columnDefs: [
        //   {
        //     orderable: true,
        //     targets: 0,
        //     checkboxes: { selectRow: true }
        //   }
        // ],
        dom:
          '<"top"<"actions action-btns"B><"action-filters"lf>><"clear">rt<"bottom"<"actions">p>',
        oLanguage: {
          sLengthMenu: "_MENU_",
          sSearch: ""
        },
        aLengthMenu: [[10, 15, 20, 50], [10, 15, 20, 50]],
        order: [[5, "desc"]],
        bInfo: false,
        buttons: [
          {
            text: "<i class='feather icon-plus'></i> Add New",
            action: function() {
              // $(this).removeClass("btn-secondary");
            },
            className: "btn-outline-primary add-new"
          }
        ],
        processing: true,
        serverSide: true,
        ajax: '{{ route('admin.user.datatable') }}',
        columns: [
          // { data: 'checkbox', name: 'checkbox', orderable: false, searchable: false, class: 'text-center' },
          { data: 'avatar', name: 'avatar', orderable: false, searchable: false, class: 'text-center' },
          { data: 'name', name: 'name' },
          { data: 'email', name: 'email' },
          { data: 'active', name: 'active', orderable: false, class: 'text-center' },
          { data: 'role', name: 'role', orderable: false, class: 'text-center' },
          { data: 'created_at', name: 'created_at' },
          { data: 'actions', name: 'actions', orderable: false, searchable: false, class: 'text-center' }
        ],
        initComplete: function(settings, json) {
          $(".dt-buttons .btn").removeClass("btn-secondary")
        }
      });

      dataListView.on('draw.dt', function(){
        setTimeout(function(){
          if (navigator.userAgent.indexOf("Mac OS X") != -1) {
            $(".dt-checkboxes-cell input, .dt-checkboxes").addClass("mac-checkbox")
          }
        }, 50);
      });

      // To append actions dropdown before add new button
      var actionDropdown = $(".actions-dropodown")
      actionDropdown.insertBefore($(".top .actions .dt-buttons"))

      // Scrollbar
      if ($(".data-items").length > 0) {
        new PerfectScrollbar(".data-items", { wheelPropagation: false })
      }

      $(document).on('click', "#select-all", function () {
          let $select2 = $(this).parent().siblings('.select2');
          $select2.find('option').prop('selected', 'selected');
          $select2.trigger('change');
      });
      $('#deselect-all').click(function () {
          let $select2 = $(this).parent().siblings('.select2');
          $select2.find('option').prop('selected', '');
          $select2.trigger('change');
      });

      $(document).on('click', '.add-new', function () {
          $('#user-form')[0].reset();
          $('#name_validate_error').text('');
          $("[name='name']").removeClass('validate-input-error');
          $('#email_validate_error').text('');
          $("[name='email']").removeClass('validate-input-error');
          $('#password_validate_error').text('');
          $("[name='password']").removeClass('validate-input-error');
          $("#assign_role").val('');
          $('#role_validate_error').text('');
          $(".select2-selection").removeClass('validate-input-error');
          $('ul.select2-selection__rendered').empty();
          $('#inlineForm').modal('show');
      });

      $(document).on('click', '.btn-save', function () {
        $('#name_validate_error').text('');
        $("[name='name']").removeClass('validate-input-error');
        $('#email_validate_error').text('');
        $("[name='email']").removeClass('validate-input-error');
        $('#password_validate_error').text('');
        $("[name='password']").removeClass('validate-input-error');
        $('#role_validate_error').text('');
        $(".select2-selection").removeClass('validate-input-error');

        const id = $("[name='hidden']").val();
        let name = $("[name='name']").val();
        let email = $("[name='email']").val();
        let password = $("[name='password']").val();
        let assign_role  = $("[name='assign_role']").val();
        Notiflix.Loading.Dots('Processing...');
        $.post("{{ route('admin.user.store') }}",
          {
              id: id,
              name: name,
              email: email,
              password: password,
              assign_role: assign_role
          },
          function (response) {
            // console.log(response);
            Notiflix.Loading.Remove();
            if (response.errors){
                if (response.errors.name){
                    $('#name_validate_error').text(response.errors.name);
                    $("[name='name']").addClass('validate-input-error');
                }
                if (response.errors.email){
                    $('#email_validate_error').text(response.errors.email);
                    $("[name='email']").addClass('validate-input-error');
                }
                if (response.errors.password){
                    $('#password_validate_error').text(response.errors.password);
                    $("[name='password']").addClass('validate-input-error');
                }
                if (response.errors.assign_role){
                    $('#role_validate_error').text(response.errors.assign_role);
                    $(".select2-selection").addClass('validate-input-error');
                }
            }
            else{
                $('#inlineForm').modal('hide');
                Notiflix.Notify.Success(response.message);
                dataListView.ajax.reload();
            }
          });
      });

        // Ajax Delete
        $(document).on('click', '.delete', function () {
            const id = $(this).data('id');
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.value) {
                    Swal.fire(
                        'Deleted!',
                        'Your file has been deleted.',
                        'success'
                    );
                    $.post("{{ route('admin.user.delete') }}",
                        { id: id},
                        function (response) {
                            if (response.message){
                                Notiflix.Notify.Success(response.message);
                            }
                            dataListView.ajax.reload();
                        }
                    );
                }
            });
        });

        // Ajax update
        $(document).on('click', '.edit', function () {
            const id = $(this).data('id');
            $('#name_validate_error').text('');
            $("[name='name']").removeClass('validate-input-error');
            $('#email_validate_error').text('');
            $("[name='email']").removeClass('validate-input-error');
            $('#password_validate_error').text('');
            $("[name='password']").removeClass('validate-input-error');
            $('#role_validate_error').text('');
            $(".select2-selection").removeClass('validate-input-error');
            $('ul.select2-selection__rendered').empty();
            $('#inlineForm').modal('show');
            $('#permissionModalTitle').html('User Update');
            let select = '';
            $.get("{{ route('admin.user.edit') }}", {id: id}, function (response) {
                $("[name='name']").val(response.user.name);
                $("[name='email']").val(response.user.email);
                // $("[name='password']").val(response.user.password);
                $("[name='hidden']").val(response.user.id);
                if (response.user.roles){
                    let values = [];
                    for (let i = 0 ; i < response.user.roles.length ; i++){
                        let opt = response.user.roles[i];
                        // values = '"'+ opt.name +'"';
                        values.push(opt.name);
                        $("#assign_role").val(values).trigger('change');
                        select += '<li class="select2-selection__choice" title="'+ opt.display_name +'" data-select2-id="'+ opt.name +'">' +
                            '<span class="select2-selection__choice__remove" role="presentation">×</span>'+ opt.display_name +'' +
                            '</li>';
                        $('ul.select2-selection__rendered').html(select);
                    }
                    console.log(values);
                }
            });
        });
    });
  </script>
  @endsection
