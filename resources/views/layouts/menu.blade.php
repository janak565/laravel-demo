<!-- need to remove -->
<li class="nav-item">
    {{auth()->user()->role}}
    <a href="{{ route(auth()->user()->role.'.home') }}" class="nav-link active">
        <i class="nav-icon fas fa-home"></i>
        <p>Home</p>
    </a>
 
    
    <a href="{{ route(auth()->user()->role.'.editprofile') }}" class="nav-link">
        <i class="nav-icon fas fa-home"></i>
        <p>Update Profle</p>
    </a>
</li>
