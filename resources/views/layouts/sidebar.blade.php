<nav class="sidebar-nav">
    <ul class="nav in side-menu">
        @if (Auth::user()->permName == 'superAdmin')
        <li class="menu-item-has-children">
            <a href="javascript:void(0);">
                <i class="list-icon feather feather-briefcase"></i> <span class="hide-menu">Firma</span>
            </a>
            <ul class="list-unstyled sub-menu">
                <li><a href="{{ route('company.index') }}">Firmenliste</a>
                </li>
                <li><a href="{{ route('company.create') }}">Neue Firma Erfassen</a>
                </li>
            </ul>
        </li>
        @endif

        @if (Auth::user()->permName == 'superAdmin')
        <li class="menu-item-has-children">
            <a href="javascript:void(0);">
                <i class="list-icon feather feather-user"></i> <span class="hide-menu">Benutzer</span>
            </a>
            <ul class="list-unstyled sub-menu">
                <li><a href="{{ route('user.index') }}">Benutzerliste</a>
                </li>
                <li><a href="{{ route('user.create') }}">Neue hinzufügen</a>
                </li>
            </ul>
        </li>
        @endif

        @if (in_array(Auth::user()->permName, ['superAdmin', 'chef', 'officer']))
        <li class="menu-item-has-children">
            <a href="javascript:void(0);">
                <i class="list-icon feather feather-award"></i> <span class="hide-menu">Kunden </span>
            </a>
            <ul class="list-unstyled sub-menu">
                <li><a href="{{ route('customer.index') }}">Kundenliste</a>
                </li>
                <li><a href="{{ route('customer.create') }}">Neue hinzufügen</a>
                </li>
            </ul>
        </li>
        @endif

        @if (in_array(Auth::user()->permName, ['superAdmin', 'chef', 'officer']))
        <li class="menu-item-has-children">
            <a href="javascript:void(0);">
                
                <i class="list-icon feather feather-box"></i> <span class="hide-menu">Produkte</span>
            </a>
            <ul class="list-unstyled sub-menu">
                <li><a href="{{ route('product.index') }}">Produkteliste</a>
                </li>
                <li><a href="{{ route('product.create') }}">Neue hinzufügen</a>
                </li>
            </ul>
        </li>
        @endif

        @if (Auth::user()->permName == 'superAdmin')
        <li class="menu-item-has-children">
            <a href="javascript:void(0);">
                <i class="list-icon feather feather-clipboard"></i> <span class="hide-menu">Tarif</span>
            </a>
            <ul class="list-unstyled sub-menu">
                <li><a href="{{ route('tariff.index') }}">Tarifliste</a>
                </li>
                <li><a href="{{ route('tariff.create') }}">Neue hinzufügen</a>
                </li>
            </ul>
        </li>
        @endif

        @if (in_array(Auth::user()->permName, ['superAdmin', 'chef']))
        <li class="menu-item-has-children">
            <a href="javascript:void(0);">
                <i class="list-icon feather feather-users"></i> <span class="hide-menu">Arbeiter</span>
            </a>
            <ul class="list-unstyled sub-menu">
                <li><a href="{{ route('worker.index') }}">Arbeiterliste</a>
                </li>
                <li><a href="{{ route('worker.create') }}">Neue hinzufügen</a>
                </li>
            </ul>
        </li>
        @endif

        @if (in_array(Auth::user()->permName, ['superAdmin', 'chef', 'officer']))
        <li class="menu-item-has-children">
            <a href="javascript:void(0);">
                <i class="list-icon feather feather-users"></i> <span class="hide-menu">Statistiken</span>
            </a>
            <ul class="list-unstyled sub-menu">
                <li><a href="{{ route('statistics.offer') }}">Offerte Stats</a></li>
                <li><a href="{{ route('statistics.receipt') }}">Quittung Stats</a></li>
                <li><a href="{{ route('statistics.termine') }}">Termine Stats</a></li>
            </ul>
        </li>
        @endif


        @if (in_array(Auth::user()->permName, ['superAdmin', 'chef']))
        <li class="menu-item-has-children">
            <a href="javascript:void(0);">
                <i class="list-icon feather feather-list"></i> <span class="hide-menu">Aufgaben</span>
            </a>
            <ul class="list-unstyled sub-menu">
                <li><a href="{{ route('task.index') }}">Aufgabenliste</a>
                </li>
                <li><a href="{{ route('task.create') }}">Neue hinzufügen</a>
                </li>
            </ul>
        </li>
        @endif

        @if (in_array(Auth::user()->permName, ['superAdmin', 'chef']))
        <li class="menu-item-has-children">
            <a href="javascript:void(0);">
                <i class="list-icon feather feather-phone"></i> <span class="hide-menu">ContactPerson</span>
            </a>
            <ul class="list-unstyled sub-menu">
                <li><a href="{{ route('contactPerson.index') }}">Liste</a>
                </li>
                <li><a href="{{ route('contactPerson.create') }}">Hinzufügen </a>
                </li>
            </ul>
        </li>
        @endif

        {{-- İŞÇİ PANELİ MENÜSÜ --}}
        @if (Auth::user()->permName == 'worker') 
        <li class="menu-item">
            <a href="{{ route('workerPanel.task',  ['id' => Auth::id()]) }}">
                <i class="list-icon feather feather-list"></i> <span class="hide-menu">Aufgaben</span>
            </a>
        </li>
        @endif
    </ul>
    <!-- /.side-menu -->
</nav>