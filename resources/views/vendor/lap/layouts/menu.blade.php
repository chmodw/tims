<li{!! request()->is('dashboard') ? ' class="active"' : '' !!}>
    <a href="{{ route('dashboard') }}"><i class="fal fa-fw fa-tachometer mr-3"></i>Dashboard</a>
</li>

<li id="program-options">
    <a href="" >
        <i class="fal fa-fw fa-file-alt mr-3"></i>Programs<i class="fa fa-caret-down ml-3"></i>
    </a>
    <ul>
        <li class="second-list-item">
            <a href="{{ route('programs', 'LocalProgram')}}">Local Program</a>
        </li>
        <li class="second-list-item">
            <a href="{{ route('programs', 'ForeignProgram')}}">Foreign Program</a>
        </li>
        <li class="second-list-item">
            <a href="{{ route('programs', 'InHouseProgram')}}">In-House Program</a>
        </li>
        <li class="second-list-item">
            <a href="{{ route('programs', 'PostGradProgram')}}">Post-Grad Program</a>
        </li>
    </ul>
</li>
@can('Read Roles')
    <li{!! request()->is('roles') ? ' class="active"' : '' !!}>
        <a href="{{ route('roles') }}"><i class="fal fa-fw fa-shield-alt mr-3"></i>Roles</a>
    </li>
@endcan
@can('Read Users')
    <li{!! request()->is('users') ? ' class="active"' : '' !!}>
        <a href="{{ route('users') }}"><i class="fal fa-fw fa-user mr-3"></i>Users</a>
    </li>
@endcan
@can('Read Activity Logs')
    <li{!! request()->is('activity_logs') ? ' class="active"' : '' !!}>
        <a href="{{ route('activity_logs') }}"><i class="fal fa-fw fa-file-alt mr-3"></i>Activity Logs</a>
    </li>
@endcan
@can('Read Docs')
    <li{!! request()->is('docs') ? ' class="active"' : '' !!}>
        <a href="{{ route('docs') }}"><i class="fal fa-fw fa-book mr-3"></i>Docs</a>
    </li>
@endcan
@can('Update Settings')
    <li{!! request()->is('settings') ? ' class="active"' : '' !!}>
        <a href="{{ route('settings') }}"><i class="fal fa-fw fa-cog mr-3"></i>Settings</a>
    </li>
@endcan