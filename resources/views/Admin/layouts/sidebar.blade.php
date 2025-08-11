{{-- <button class="sidebar-toggle" id="sidebarToggle">
    <span>&#9776;</span>
</button> --}}
<div class="sidebar">
    <div class="px-4 mb-3 logo" style="display: flex; align-items: center; justify-content: space-between;">
        <img src="{{ asset('assets/images/blue_bg_logo.svg') }}" alt="Logo" />
        <span class="sidebar-close" id="sidebarClose"
            style="display: none; font-size: 26px; cursor: pointer;">&times;</span>
    </div>
    {{-- <div class="px-4 mb-3 logo">
        <img src="{{ asset('assets/images/blue_bg_logo.svg') }}" alt="Logo" />
    </div> --}}

    <div class="menu-item" id="welcome"><i class="fas fa-hand-sparkles"></i> Welcome</div>

    <div class="section-title">Profile</div>
    <div class="menu-item" id="dashboard"><i class="fas fa-gauge"></i> Dashboard</div>

    <div class="menu-item" id="myProfile"><i class="fas fa-user"></i> My Profile</div>

    <div class="section-title">My Company</div>
    <div class="menu-item" id="peopleMenu">
        <i class="fas fa-user-friends"></i> People
        <span class="chevron"><i class="fas fa-chevron-right"></i></span>
    </div>
    <div class="menu-item" id="companyMenu">
        <i class="fas fa-building"></i> Company
        <span class="chevron"><i class="fas fa-chevron-right"></i></span>
    </div>
</div>

<!-- Submenu Flyout for People -->
<div id="submenuPeople" class="submenu-panel" style="display:none;">
    <div class="submenu-header">
        <span class="back-arrow" id="closePeople">&lsaquo;</span>
        People
    </div>
    <ul>
        <li><a href="https://hr.breathehr.com/employees" class="sidenav-menu__link" tabindex="0" target="_self"
                rel="" data-element-id="side-nav-l2-item-prefix-our_people">Our people</a></li>
        <li><a href="https://hr.breathehr.com/employees/new" class="sidenav-menu__link" tabindex="0" target="_self"
                rel="" data-element-id="side-nav-l2-item-prefix-add_new_people">Add new</a></li>
        <li><a href="https://hr.breathehr.com/employees/data" class="sidenav-menu__link" tabindex="0" target="_self"
                rel="" data-element-id="side-nav-l2-item-prefix-data">Data</a></li>
    </ul>
</div>

<!-- Submenu Flyout for Company -->
<div id="submenuCompany" class="submenu-panel" style="display:none;">
    <div class="submenu-header">
        <span class="back-arrow" id="closeCompany">&lsaquo;</span>
        Company
    </div>
    <ul>
        <li><a href="{{ route('company.index') }}" class="sidenav-menu__link">Company List</a></li>
        
        <!-- Add more company submenu items as needed -->
    </ul>
</div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script>
    $(function() {
        // Handle People menu click
        $('#peopleMenu').on('click', function() {
            $('.submenu-panel').hide();
            $('#submenuPeople').show();
            $('.menu-item').removeClass('active');
            $(this).addClass('active');
        });

        // Handle Company menu click
        $('#companyMenu').on('click', function() {
            $('.submenu-panel').hide();
            $('#submenuCompany').show();
            $('.menu-item').removeClass('active');
            $(this).addClass('active');
        });

        // Close submenu when back arrow is clicked
        $('#closePeople').on('click', function() {
            $('#submenuPeople').hide();
            $('.menu-item').removeClass('active');
        });
        $('#closeCompany').on('click', function() {
            $('#submenuCompany').hide();
            $('.menu-item').removeClass('active');
        });

        // Optional: handle other menu items
        $('#welcome, #dashboard, #myProfile').on('click', function() {
            $('.submenu-panel').hide();
            $('.menu-item').removeClass('active');
            $(this).addClass('active');
        });

        // Sidebar toggle for mobile
        $('#sidebarToggle').on('click', function() {
            $('.sidebar').toggleClass('open');
            $('body').toggleClass('sidebar-open');

        });


        // Optional: close sidebar when clicking overlay
        $(document).on('click', '.sidebar-overlay', function() {
            $('.sidebar').removeClass('open');
            $('body').removeClass('sidebar-open');
        });

        $('#sidebarClose').on('click', function() {
            $('.sidebar').removeClass('open');
            $('body').removeClass('sidebar-open');
            $('.sidebar-overlay').hide();
        });
    });
</script>
{{-- <div class="sidebar">
    <div class="px-4 mb-3 logo">
        <img src="{{ asset('assets/images/blue_bg_logo.svg') }}" alt="Logo" />
    </div>

    <div class="menu-item" onclick="setActive(this)"><i class="fas fa-hand-sparkles"></i> Welcome</div>

    <div class="section-title">Profile</div>
    <div class="menu-item" onclick="setActive(this)"><i class="fas fa-gauge"></i> Dashboard</div>

    <div class="menu-item" onclick="setActive(this)"><i class="fas fa-user"></i> My Profile</div>


    <div class="section-title">My Company</div>
    <div class="menu-item" onclick="toggleSubmenu('submenuCompany', this)">
        <i class="fas fa-user-friends"></i> People
        <span class="chevron"><i class="fas fa-chevron-right"></i></span>
    </div>
    <div class="menu-item" onclick="toggleSubmenu('submenuCompany', this)">
        <i class="fas fa-building"></i> Company
        <span class="chevron"><i class="fas fa-chevron-right"></i></span>
    </div>
</div>

<!-- Submenu Flyout -->
<div id="submenuCompany" class="submenu-panel">
    <div class="submenu-header">
        <span class="back-arrow" onclick="closeSubmenu('submenuCompany')">&lsaquo;</span>
        Company
    </div>
    <ul>
        <li><a href="https://hr.breathehr.com/employees" class="sidenav-menu__link" tabindex="0" target="_self"
                rel="" data-element-id="side-nav-l2-item-prefix-our_people">Our people</a></li>
        <li><a href="https://hr.breathehr.com/employees/new" class="sidenav-menu__link" tabindex="0" target="_self"
                rel="" data-element-id="side-nav-l2-item-prefix-add_new_people">Add new</a></li>
        <li><a href="https://hr.breathehr.com/employees/data" class="sidenav-menu__link" tabindex="0" target="_self"
                rel="" data-element-id="side-nav-l2-item-prefix-data">Data</a></li>
    </ul>
</div>
<script>
    let lastActive = null;

    function setActive(el) {
        document.querySelectorAll('.menu-item').forEach(item => item.classList.remove('active'));
        el.classList.add('active');
        document.querySelectorAll('.submenu-panel').forEach(panel => panel.classList.remove('active'));
    }

    function toggleSubmenu(id, el) {
        const panel = document.getElementById(id);
        const isActive = panel.classList.contains('active');

        document.querySelectorAll('.submenu-panel').forEach(p => p.classList.remove('active'));
        document.querySelectorAll('.menu-item').forEach(item => item.classList.remove('active'));

        if (!isActive) {
            panel.classList.add('active');
            el.classList.add('active');
            lastActive = el;
        } else {
            panel.classList.remove('active');
            el.classList.remove('active');
        }
    }

    function closeSubmenu(id) {
        const panel = document.getElementById(id);
        panel.classList.remove('active');
        if (lastActive) lastActive.classList.remove('active');
    }
</script> --}}
