<header class="z-[995] sticky mainBg   px-5   min-h-[70px]  duration-300 ease-in-out flex  w-full box-border  items-center justify-between  top-0 right-0 color-opacity-87   shadow-md backdrop-blur-md">



    <button id="toggleSideBar" class="text-white"><i class="lg:hidden  flex ti ti-menu-2 text-xl cursor-pointer  "> </i></button>



    <div class="  flex justify-center items-center gap-x-4 text-white">

        <div class="hidden relative flex items-center w-full  rounded-full  border-2	 py-1 bg-white overflow-hidden">
            <div class="grid place-items-center h-full w-12 text-gray-300">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
            </div>

        </div>


        <div class="flex  gap-x-4">








            <!-- Settings Dropdown -->
            <div class=" sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                            <div>{{ Auth::user()->name }}</div>

                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-dropdown-link>
                        <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                            {{ __('Dashboard') }}
                        </x-responsive-nav-link>
                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')" onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>


        </div>





    </div>


</header>


<script>
    const IMG_URL = 'http://localhost/blog/backend/';
    document.addEventListener('DOMContentLoaded', function() {
        let logoutDashboard = document.getElementById('logoutDashboard')
        let toggleSideBar = document.getElementById('toggleSideBar');
        let sidebar_dash = document.getElementById('sidebar_dash');
        // header dahsboard info admin
        let ProfileImg = document.getElementById('ProfileImg')
        let username_admin = document.getElementById('username_admin')

        toggleSideBar.addEventListener('click', onToggle);


        ProfileImg.src = `${IMG_URL}${localStorage.getItem('image_admin')}`
        username_admin.textContent = localStorage.getItem('username_admin')

        function onToggle() {
            if (sidebar_dash.classList.contains('left-[-100%]')) {
                sidebar_dash.classList.remove('left-[-100%]');
                sidebar_dash.classList.add('left-5');
            } else {
                sidebar_dash.classList.remove('left-5');
                sidebar_dash.classList.add('left-[-100%]');
            }
        }



        logoutDashboard.addEventListener('click', function() {
            console.log('clicklogout')
            localStorage.clear()

            window.location.reload()
        })


    });
</script>
