<style>
    a.links {
        border-bottom: 2px solid transparent;
        color: #333;
        margin-right: 15px;
        transition: border-bottom-color 0.3s;
    }

    a.links:hover {
        border-bottom-color: #497AE4;
    }

    a.links.active {
    border-bottom-color: #497AE4;
}

</style>



<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                
                <a class="navbar-brand" href="{{ url('/') }}">
                <img src="storage/admin-portal.png" alt="logo" width="80px" heigth="80px">
                </a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">
                    @guest
                    @else
                        <div class="navbar-nav ms-5">
                            <a class="nav-link links" aria-current="page" href="companies">Companies</a>
                            <a class="nav-link links" href="employees">Employees</a>
                        </div>
                    @endguest
                    </ul>                  
                    

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item ms-sm-5">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            <!-- @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif -->
                        @else

                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <script>
    // Get the current URL
    const currentUrl = window.location.href;

    // Get all navigation links
    const navLinks = document.querySelectorAll('.nav-link');

    // Loop through each navigation link
    navLinks.forEach(link => {
        // Check if the link's href matches the current URL
        if (link.href === currentUrl) {
            link.classList.add('active');
        }
    });
</script>






