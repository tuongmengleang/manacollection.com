    {{-- Vendor Scripts --}}
        <script src="{{ asset(mix('admin/vendors/js/vendors.min.js')) }}"></script>
        <script src="{{ asset(mix('admin/vendors/js/ui/prism.min.js')) }}"></script>
        @yield('vendor-script')
        {{-- Theme Scripts --}}
        <script src="{{ asset(mix('admin/js/core/app-menu.js')) }}"></script>
        <script src="{{ asset(mix('admin/js/core/app.js')) }}"></script>
        <script src="{{ asset(mix('admin/js/scripts/components.js')) }}"></script>
@if($configData['blankPage'] == false)
        <script src="{{ asset(mix('admin/js/scripts/footer.js')) }}"></script>
@endif
    <script>
      $(document).ready(function () {
        const $loading = $('#loadingDiv').hide();
        $(document)
          .ajaxStart(function () {
            $loading.show();
          })
          .ajaxStop(function () {
            $loading.hide();
          });
      })
    </script>
        {{-- page script --}}
        @yield('page-script')
