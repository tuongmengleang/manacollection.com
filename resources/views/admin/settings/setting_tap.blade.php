<!-- left menu section -->
<div class="col-md-3 mb-2 mb-md-0">
    <ul class="nav nav-pills flex-column mt-md-0 mt-1">
      <li class="nav-item">
        <a class="nav-link d-flex py-75 {{ request()->routeIs('admin.setting.general') ? 'active' : '' }}" href="{{ route('admin.setting.general') }}">
          <i class="feather icon-globe mr-50 font-medium-3"></i>
          {{ __('general.general') }}
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link d-flex py-75 {{ request()->routeIs('admin.setting.social_link') ? 'active' : '' }}"  href="{{ route('admin.setting.social_link') }}">
          <i class="feather icon-camera mr-50 font-medium-3"></i>
          {{ __('general.social_links') }}
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link d-flex py-75 {{ request()->routeIs('admin.setting.notification') ? 'active' : '' }}"  href="{{ route('admin.setting.notification') }}">
          <i class="feather icon-message-circle mr-50 font-medium-3"></i>
          {{ __('general.notifications') }}
        </a>
      </li>
      <li class="nav-item" id="permissionTap">
        <a class="nav-link d-flex py-75 {{ request()->routeIs('admin.setting.permission') ? 'active' : '' }}" href="{{ route('admin.setting.permission') }}">
          <i class="feather icon-lock mr-50 font-medium-3"></i>
          {{ __('general.permissions') }}
        </a>
      </li>
      <li class="nav-item" id="roleTap">
        <a class="nav-link d-flex py-75 {{ request()->routeIs('admin.setting.role') ? 'active' : '' }}" href="{{ route('admin.setting.role') }}">
          <i class="feather icon-tag mr-50 font-medium-3"></i>
          {{ __('general.roles') }}
        </a>
      </li>
    </ul>
  </div>