<div class="header">
    <!-- Collapsible Search Bar -->
    <div class="search-bar-collapsible">
        <span class="material-symbols-outlined">search</span>
        <input type="text" class="search-input" placeholder="Search People">
    </div>

    <!-- Icons -->
    <div class="icon-group">
        <span class="material-symbols-outlined">person_add</span>
        <span class="material-symbols-outlined">contacts</span>
        <span class="material-symbols-outlined">calendar_today</span>

        <!-- Mobile Search Toggle -->
        <span class="material-symbols-outlined search-toggle">search</span>
        <span class="material-symbols-outlined">star</span>

        <!-- Profile Avatar -->
        <div class="avatar-wrapper">
            <div class="avatar" id="avatarBtn">
                <img src="https://cdn-icons-png.flaticon.com/512/149/149071.png" alt="User">
            </div>
            <div class="dropdown" id="dropdownMenu">
                <a href="#"><span class="material-symbols-outlined">account_circle</span> View Profile</a>
                <a href="{{ url('admin/logout') }}"><span class="material-symbols-outlined">logout</span> Logout</a>
            </div>
        </div>
    </div>
</div>
<div class="search-bar-dropdown">
    <div class="d-flex align-center">

        <span class="material-symbols-outlined">search</span>
        <input type="text" placeholder="Search People">
    </div>
</div>
<script>
    // Show/hide search input    on icon click (mobile)
    $(function() {
        $('.search-toggle').on('click', function(e) {
            if ($(window).width() <= 900) {
                e.stopPropagation();
                $('.search-bar-dropdown').slideToggle(200, function() {
                    if ($(this).is(':visible')) {
                        $(this).find('input').focus();
                    }
                });
            }
        });

        $(document).on('click', function(e) {
            if (!$(e.target).closest('.search-bar-dropdown, .search-toggle').length) {
                $('.search-bar-dropdown').slideUp(200);
            }
        });
    });

    const avatarBtn = document.getElementById('avatarBtn');
    const dropdownMenu = document.getElementById('dropdownMenu');

    avatarBtn.addEventListener('click', () => {
        dropdownMenu.style.display = dropdownMenu.style.display === 'flex' ? 'none' : 'flex';
    });

    // Optional: Close dropdown if clicked outside
    document.addEventListener('click', (e) => {
        if (!avatarBtn.contains(e.target) && !dropdownMenu.contains(e.target)) {
            dropdownMenu.style.display = 'none';
        }
    });
</script>
{{-- <div class="header">
            <div class="header-content">
                <nav class="navbar navbar-expand">
                    <div class="collapse navbar-collapse justify-content-between">
                        <div class="header-left">
                            <div class="search_bar dropdown">
                                <span class="search_icon p-3 c-pointer" data-toggle="dropdown">
                                    <i class="mdi mdi-magnify"></i>
                                </span>
                                <div class="dropdown-menu p-0 m-0">
                                    <form>
                                        <input class="form-control" type="search" placeholder="Search" aria-label="Search">
                                    </form>
                                </div>
                            </div>
                        </div>

                        <ul class="navbar-nav header-right">
                            <li class="nav-item dropdown notification_dropdown">
                                <a class="nav-link" href="#" role="button" data-toggle="dropdown">
                                    <i class="mdi mdi-bell"></i>
                                    <div class="pulse-css"></div>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <ul class="list-unstyled">
                                        <li class="media dropdown-item">
                                            <span class="success"><i class="ti-user"></i></span>
                                            <div class="media-body">
                                                <a href="#">
                                                    <p><strong>Martin</strong> has added a <strong>customer</strong> Successfully
                                                    </p>
                                                </a>
                                            </div>
                                            <span class="notify-time">3:20 am</span>
                                        </li>
                                        <li class="media dropdown-item">
                                            <span class="primary"><i class="ti-shopping-cart"></i></span>
                                            <div class="media-body">
                                                <a href="#">
                                                    <p><strong>Jennifer</strong> purchased Light Dashboard 2.0.</p>
                                                </a>
                                            </div>
                                            <span class="notify-time">3:20 am</span>
                                        </li>
                                        <li class="media dropdown-item">
                                            <span class="danger"><i class="ti-bookmark"></i></span>
                                            <div class="media-body">
                                                <a href="#">
                                                    <p><strong>Robin</strong> marked a <strong>ticket</strong> as unsolved.
                                                    </p>
                                                </a>
                                            </div>
                                            <span class="notify-time">3:20 am</span>
                                        </li>
                                        <li class="media dropdown-item">
                                            <span class="primary"><i class="ti-heart"></i></span>
                                            <div class="media-body">
                                                <a href="#">
                                                    <p><strong>David</strong> purchased Light Dashboard 1.0.</p>
                                                </a>
                                            </div>
                                            <span class="notify-time">3:20 am</span>
                                        </li>
                                        <li class="media dropdown-item">
                                            <span class="success"><i class="ti-image"></i></span>
                                            <div class="media-body">
                                                <a href="#">
                                                    <p><strong> James.</strong> has added a<strong>customer</strong> Successfully
                                                    </p>
                                                </a>
                                            </div>
                                            <span class="notify-time">3:20 am</span>
                                        </li>
                                    </ul>
                                    <a class="all-notification" href="#">See all notifications <i
                                            class="ti-arrow-right"></i></a>
                                </div>
                            </li>
                            <li class="nav-item dropdown header-profile">
                                <a class="nav-link" href="#" role="button" data-toggle="dropdown">
                                    <i class="mdi mdi-account"></i> 
                                </a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a href="{{ asset('theme/app-profile.html') }}') }}" class="dropdown-item">
                                        <i class="icon-user"></i>

                                        <span class="ml-2">Profile </span>
                                    </a>
                                    <a href="{{ asset('theme/email-inbox.html') }}" class="dropdown-item">
                                        <i class="icon-envelope-open"></i>
                                        <span class="ml-2">Inbox </span>
                                    </a>
                                    <a href="{{ url('admin/logout') }}" class="dropdown-item">
                                        <i class="icon-key"></i>
                                        <span class="ml-2">Logout </span>
                                    </a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
        </div> --}}
