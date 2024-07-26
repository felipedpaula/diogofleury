<ul class="navbar-nav bg-gray-900 sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">SB Admin <sup>2</sup></div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - SITE -->
    <li class="nav-item">
        <a class="nav-link" href="/" target="_blank">
            <i class="fas fa-external-link-alt"></i>
            <span>Site</span>
        </a>
    </li>

    <!-- Nav Item - DASHBOARD -->
    <li class="nav-item">
        <a class="nav-link" href="/dashboard">
            <i class="fas fa-th-large"></i>
            <span>Dashboard</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <div class="sidebar-heading">
        Conteúdos
    </div>

    <li class="nav-item">
        <a class="nav-link" href="/admin/projetos">
            <i class="fas fa-camera"></i>
            <span>Projetos</span>
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="/admin/galerias">
            <i class="fas fa-photo-video"></i>
            <span>Galerias</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <div class="sidebar-heading">
        Configurações
    </div>

    <!-- Nav Item - USUÁRIOS -->
    <li class="nav-item">
        <a class="nav-link" href="{{route('admin.destaques.indexCategoria')}}">
            <i class="fas fa-fw fa-columns"></i>
            <span>Destaques</span>
        </a>
    </li>

     <!-- Nav Item - SOBRE MIM -->
     <li class="nav-item">
        <a class="nav-link" href="{{route('admin.sobre.index')}}">
            <i class="fas fa-user-edit"></i>
            <span>Sobre (Página)</span>
        </a>
    </li>

    <!-- Nav Item - USUÁRIOS -->
    <li class="nav-item">
        <a class="nav-link" href="{{route('admin.usuarios.index')}}">
            <i class="fas fa-users"></i>
            <span>Usuários</span>
        </a>
    </li>

    <!-- Nav Item - CONTATOS -->
    <li class="nav-item">
        <a class="nav-link" href="/admin/contatos">
            <i class="far fa-envelope"></i>
            <span>Contatos</span>
        </a>
    </li>

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline mt-5">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

     <!-- Nav Item - Pages Collapse Menu -->
    {{-- <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
            aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-cog"></i>
            <span>Components</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Custom Components:</h6>
                <a class="collapse-item" href="buttons.html">Buttons</a>
                <a class="collapse-item" href="cards.html">Cards</a>
            </div>
        </div>
    </li> --}}

    <!-- Heading -->
    {{-- <div class="sidebar-heading">
        Addons
    </div> --}}

</ul>
