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
@if ($message = Session::get('error'))

<div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400" role="alert">
    <span class="font-medium">Success alert!</span> {{$message}}
  </div>
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


                @foreach($plans as $plan)

{{-- Start plan free --}}
<form action="{{route('subscriptions.store')}}"  method="POST"
class="py-12 {{$subscription->plan['name'] == $plan['name'] ? 'pointer-events-none opacity-55' :null}}" >
@csrf()
              <div class="bg-white hover:scale-105  pt-4 rounded-xl space-y-6 overflow-hidden  transition-all duration-500 transform hover:-translate-y-6 shadow-xl hover:shadow-2xl cursor-pointer">
                  <div class="px-8 flex justify-between items-center">
                      <h4 class="text-xl font-bold text-gray-800">{{$plan['name']}}</h1>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                  </svg>
                  </div>
                  <h1 class="text-4xl text-center font-bold">{{$plan['price']}}$</h1>
                  <p class="px-4 text-center text-sm ">{{$plan['description']}}</p>
                  <ul class="text-center flex flex-col gap-3 w-full">
                    <li class="flex gap-x-2 justify-center"><p class="font-semibold">Max menu items:</p><span>{{$plan['max_menu_items']}}</span></li>
                    <li class="flex gap-x-2 justify-center"><p class="font-semibold">Max Media:</p><span>{{$plan['max_media']}}</span></li>
                    <li class="flex gap-x-2 justify-center"><p class="font-semibold">Max Scans:</p><span>{{$plan['max_scans']}}</span></li>
                  </ul>
                  <div class="text-center bg-gray-200 ">
                    <input hidden value='{{$plan['id']}}' name="plan_id">
                <button type="submit" class="inline-block my-6 font-bold text-gray-800">Get started today</button>
                  </div>
              </div>
            </form>
{{-- End plan free --}}
                @endforeach




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
