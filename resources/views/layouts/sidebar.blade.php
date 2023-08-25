<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="{{ route(auth()->user()->role.'.home') }}" class="brand-link">
    @if(auth()->user()->images)
        <img src="{{ URL::asset('uploads/'.auth()->user()->images->file) }}"
             alt="AdminLTE Logo"
             class="brand-image img-circle elevation-3">
             @endif 
        <span class="brand-text font-weight-light">{{ config('app.name') }}</span>
    </a>

    <div class="sidebar">
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                @include('layouts.menu')
            </ul>
        </nav>
    </div>

</aside>
