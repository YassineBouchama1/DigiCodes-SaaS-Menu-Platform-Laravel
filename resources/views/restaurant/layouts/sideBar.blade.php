

<aside id="sidebar_dash" class="z-[998] w-[260px] bg-white   h-screen  flex flex-col   fixed  top-0  lg:left-0  left-[-100%]  shadow-sm  transition-width duration-150 ease-in-out  ">
    <div class="h-[100px] p-5 flex justify-between ">
      <a class="text-center w-full " href="/admin/">

        <h1 class="text-center font-bold text-black/60 dark:text-white text-3xl">LOGO</h1>
      </a>
      <button id="toggleSideBarinside"><i class="lg:hidden  flex ti ti-x text-xl cursor-pointer  "> </i></button>

    </div>

    <!-- body sidebar -->
    <ul class="h-full  flex  flex-col   overflow-y-auto pr-5 w-full">

      <li id="mainlink" class=" mt-1 cursor-pointer	 hover:text-[#0085DB] duration-300   no-underline   whitespace-nowrap   text-lg p-2 sm:p-3 sm:pl-6 rounded-tr-full rounded-br-full   font-normal leading-6">
        <a href="./admin">
          <i class="ti ti-home h-[24px] w-[24px] "></i>
          <span>Dashboard</span>

        </a>
      </li>







    </ul>

    <!-- body sidebar -->

  </aside>


<script>

window.location.pathname;

document.addEventListener('DOMContentLoaded', function () {


    let currentPath = window.location.pathname;

    // Find the corresponding link in the sidebar and add the "active" class
    let sidebarLinks = document.querySelectorAll("#sidebar_dash a");
    let mainlink = document.getElementById("mainlink");


    let toggleSideBar = document.getElementById('toggleSideBarinside');
    let sidebar_dash = document.getElementById('sidebar_dash');

    toggleSideBar.addEventListener('click', onToggle);

    function onToggle() {
        if (sidebar_dash.classList.contains('left-[-100%]')) {
            sidebar_dash.classList.remove('left-[-100%]');
            sidebar_dash.classList.add('left-5');
        } else {
            sidebar_dash.classList.remove('left-5');
            sidebar_dash.classList.add('left-[-100%]');
        }
    }




    //
    sidebarLinks.forEach(function (link) {
        let href = link.getAttribute("href");



        // if href empty or contain index that mean
        //add active link to dashboard li
        if (href.slice(2) === '' || href.slice(2).includes('index')) {
            mainlink.classList.add( "text-gray-500");

        }

        //  //add active link to  similar text
        else if (currentPath.includes(href.slice(2))) {

            link.parentNode.classList.add( "text-[#0085DB]");
            mainlink.classList.remove( "text-[#0085DB]");
        }
    });



});




</script>

  <!--- toggle sidebar script >
