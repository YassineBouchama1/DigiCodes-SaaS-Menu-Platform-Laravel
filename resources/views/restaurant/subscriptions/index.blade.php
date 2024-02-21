@extends('restaurant.layouts.resturant_layout')

@section('content')
{{-- display msg errors --}}

@if ($errors->any())

<ul>
    @foreach ($errors->all() as $error)

        <li class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400" role="alert">
            <span class="font-medium">Danger alert!</span> {{ $error }}
          </li>
    @endforeach
</ul>

@endif

{{-- display msg if  successfylly --}}
@if ($message = Session::get('success'))

<div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400" role="alert">
    <span class="font-medium">Success alert!</span> {{$message}}
  </div>
@endif

<div class="flex flex-wrap -mx-3 mb-5">
  <div class="w-full max-w-full px-3 mb-6  mx-auto">
    <div class="relative flex-[1_auto] flex flex-col break-words min-w-0 bg-clip-border rounded-[.95rem] bg-white m-5">
      <div class="relative flex flex-col min-w-0 break-words border border-dashed bg-clip-border rounded-2xl border-stone-200 bg-light/30">
        <!-- card header -->

        <div class="px-9 pt-5 flex justify-between items-stretch flex-wrap min-h-[70px] pb-0 bg-transparent">
            <h3 class="mb-4 text-3xl font-semibold text-gray-500">Plan List </h3>

            <hr class="mt-10" />
            <div class="flex space-x-10 pt-10 flex-col md:flex-row">
            <div class="py-12">
              <div class="bg-white pt-4 rounded-xl space-y-6 overflow-hidden  transition-all duration-500 transform hover:-translate-y-6 hover:scale-105 shadow-xl hover:shadow-2xl cursor-pointer">
                <div class="px-8 flex justify-between items-center">
                  <h4 class="text-xl font-bold text-gray-800">Hobby</h1>
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                  </svg>
                  </div>
                  <h1 class="text-4xl text-center font-bold">$10.00</h1>
                  <p class="px-4 text-center text-sm ">It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem</p>
                  <ul class="text-center">
                    <li><a href="#" class="font-semibold">It is a long established</a></li>
                    <li><a href="#" class="font-semibold">It is a long established</a></li>
                    <li><a href="#" class="font-semibold">It is a long established</a></li>
                  </ul>
                  <div class="text-center bg-gray-200 ">
                <button class="inline-block my-6 font-bold text-gray-800">Get started today</button>
                  </div>
              </div>
            </div>
            <div class="py-12">
              <div class="bg-white  pt-4 rounded-xl space-y-6 overflow-hidden transition-all duration-500 transform hover:-translate-y-6 -translate-y-2 scale-105 shadow-xl hover:shadow-2xl cursor-pointer">
                <div class="px-8 flex justify-between items-center">
                  <h4 class="text-xl font-bold text-gray-800">Professional</h1>
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                  </div>
                  <h1 class="text-4xl text-center font-bold">$30.00</h1>
                  <p class="px-4 text-center text-sm ">It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem</p>
                  <ul class="text-center">
                    <li><a href="#" class="font-semibold">It is a long established</a></li>
                    <li><a href="#" class="font-semibold">It is a long established</a></li>
                    <li><a href="#" class="font-semibold">It is a long established</a></li>
                  </ul>
                  <div class="text-center mainBg ">
                <button class="inline-block my-6 font-bold text-white">Get started today</button>
                  </div>
              </div>
            </div>
            <div class="py-12">
              <div class="bg-white pt-4 rounded-xl space-y-6 overflow-hidden transition-all duration-500 transform hover:-translate-y-6 hover:scale-105 shadow-xl hover:shadow-2xl cursor-pointer">
                <div class="px-8 flex justify-between items-center">
                  <h4 class="text-xl font-bold text-gray-800">Business</h1>
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                  </div>
                  <h1 class="text-4xl text-center font-bold">$45.00</h1>
                  <p class="px-4 text-center text-sm ">It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem</p>
                  <ul class="text-center">
                    <li><a href="#" class="font-semibold">It is a long established</a></li>
                    <li><a href="#" class="font-semibold">It is a long established</a></li>
                    <li><a href="#" class="font-semibold">It is a long established</a></li>
                  </ul>
                  <div class="text-center bg-gray-200 ">
                <button class="inline-block my-6 font-bold text-gray-800">Get started today</button>
                  </div>
              </div>
            </div>
            </div>
          </div>
        </div>
        </div>
        <!-- end card header -->

          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection
