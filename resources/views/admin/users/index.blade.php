@extends('admin.layouts.contentLayoutMaster')

@section('title', __('general.users_management'))

@section('vendor-style')
        <!-- vendor css files -->
        <link rel="stylesheet" href="{{ asset(mix('admin/vendors/css/tables/datatable/datatables.min.css')) }}">
        <link rel="stylesheet" href="{{ asset(mix('admin/vendors/css/file-uploaders/dropzone.min.css')) }}">
        <link rel="stylesheet" href="{{ asset(mix('admin/vendors/css/tables/datatable/extensions/dataTables.checkboxes.css')) }}">
@endsection
@section('page-style')
  {{-- Page css files --}}
  <link rel="stylesheet" href="{{ asset(mix('admin/css/plugins/file-uploaders/dropzone.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('admin/css/pages/data-list-view.css')) }}">
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
      <table class="table data-list-view">
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

@endsection
@section('vendor-script')
        <!-- vendor files -->
        <script src="{{ asset(mix('admin/vendors/js/extensions/dropzone.min.js')) }}"></script>
        <script src="{{ asset(mix('admin/vendors/js/tables/datatable/datatables.min.js')) }}"></script>
        <script src="{{ asset(mix('admin/vendors/js/tables/datatable/datatables.buttons.min.js')) }}"></script>
        <script src="{{ asset(mix('admin/vendors/js/tables/datatable/datatables.bootstrap4.min.js')) }}"></script>
        <script src="{{ asset(mix('admin/vendors/js/tables/datatable/buttons.bootstrap.min.js')) }}"></script>
        <script src="{{ asset(mix('admin/vendors/js/tables/datatable/dataTables.select.min.js')) }}"></script>
        <script src="{{ asset(mix('admin/vendors/js/tables/datatable/datatables.checkboxes.min.js')) }}"></script>
@endsection

@section('page-script')
{{--  <script src="{{ asset(mix('admin/js/scripts/users/data-list-view.js')) }}"></script>--}}
  <script>
    $(document).ready(function() {
      "use strict"
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
            className: "btn-outline-primary"
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

      // Close sidebar
      $(".hide-data-sidebar, .cancel-data-btn, .overlay-bg").on("click", function() {
        $(".add-new-data").removeClass("show")
        $(".overlay-bg").removeClass("show")
        $("#data-name, #data-price").val("")
        $("#data-category, #data-status").prop("selectedIndex", 0)
      })
    });
  </script>
  @endsection
