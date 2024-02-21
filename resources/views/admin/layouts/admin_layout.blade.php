<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/tabler-icons.min.css" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class=" flex  flex-row w-full  bg-[#f0f5f9] text-base font-normal leading-5 font-sans">

            @include('admin/layouts.sideBar')
             <!--  inside page  -->
  <div class="w-full mx-auto block lg:ml-[260px]  px-5  rounded-lg lg:px-0  box-border ">


    <!-- Header Start -->
            @include('admin/layouts.Header')

               <!-- Header Start -->

                <!--  start page content  -->
    <main class="rounded-[18px] h-full m-6 bg-[#f4f6f9]">

                <!-- Content specific to each page will be injected here -->
                @yield('content')

            </main>
    <!--  end page content  -->


        </div>

    </body>
</html>
