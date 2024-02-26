@extends('restaurant/layouts/resturant_layout')

@section('content')
<div class="grid gap-6 mb-8 md:grid-cols-2 xl:grid-cols-4">
    <div
      class="min-w-0 rounded-lg shadow-xs overflow-hidden bg-white dark:bg-gray-800"
    >
      <div class="p-4 flex items-center">
        <div
          class="p-3 rounded-full text-orange-500 dark:text-orange-100 bg-orange-100 dark:bg-orange-500 mr-4"
        >
        <svg fill="currentColor" viewBox="0 0 20 20" class="w-5 h-5">
            <path
              d="M3 1a1 1 0 000 2h1.22l.305 1.222a.997.997 0 00.01.042l1.358 5.43-.893.892C3.74 11.846 4.632 14 6.414 14H15a1 1 0 000-2H6.414l1-1H14a1 1 0 00.894-.553l3-6A1 1 0 0017 3H6.28l-.31-1.243A1 1 0 005 1H3zM16 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM6.5 18a1.5 1.5 0 100-3 1.5 1.5 0 000 3z"
            ></path>
          </svg>
        </div>
        <div>
          <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
            Menus Items Count
          </p>
          <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">
            {{$resturantStatistic->count_menu_items}}/{{$limits->max_menu_items}}
          </p>
        </div>
      </div>
    </div>
    <div
      class="min-w-0 rounded-lg shadow-xs overflow-hidden bg-white dark:bg-gray-800"
    >
      <div class="p-4 flex items-center">
        <div
          class="p-3 rounded-full text-green-500 dark:text-green-100 bg-green-100 dark:bg-green-500 mr-4"
        >
          <svg fill="currentColor" viewBox="0 0 20 20" class="w-5 h-5">
            <path
              fill-rule="evenodd"
              d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4zm6 4a2 2 0 100-4 2 2 0 000 4z"
              clip-rule="evenodd"
            ></path>
          </svg>
        </div>
        <div>
          <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
            Meida Count
          </p>
          <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">
            {{$resturantStatistic->count_media}}/{{$limits->max_media}}
          </p>
        </div>
      </div>
    </div>
    <div
      class="min-w-0 rounded-lg shadow-xs overflow-hidden bg-white dark:bg-gray-800"
    >
      <div class="p-4 flex items-center">
        <div
          class="p-3 rounded-full text-blue-500 dark:text-blue-100 bg-blue-100 dark:bg-blue-500 mr-4"
        >
        <svg width="24" height="24" stroke-width="1.5" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M9 6.6V8.4C9 8.73137 8.73137 9 8.4 9H6.6C6.26863 9 6 8.73137 6 8.4V6.6C6 6.26863 6.26863 6 6.6 6H8.4C8.73137 6 9 6.26863 9 6.6Z" stroke="currentColor"  stroke-linecap="round" stroke-linejoin="round"/>
            <path d="M6 12H9" stroke="currentColor"  stroke-linecap="round" stroke-linejoin="round"/>
            <path d="M15 12V15" stroke="currentColor"  stroke-linecap="round" stroke-linejoin="round"/>
            <path d="M12 18H15" stroke="currentColor"  stroke-linecap="round" stroke-linejoin="round"/>
            <path d="M12 12.0111L12.01 12" stroke="currentColor"  stroke-linecap="round" stroke-linejoin="round"/>
            <path d="M18 12.0111L18.01 12" stroke="currentColor"  stroke-linecap="round" stroke-linejoin="round"/>
            <path d="M12 15.0111L12.01 15" stroke="currentColor"  stroke-linecap="round" stroke-linejoin="round"/>
            <path d="M18 15.0111L18.01 15" stroke="currentColor"  stroke-linecap="round" stroke-linejoin="round"/>
            <path d="M18 18.0111L18.01 18" stroke="currentColor"  stroke-linecap="round" stroke-linejoin="round"/>
            <path d="M12 9.01111L12.01 9" stroke="currentColor"  stroke-linecap="round" stroke-linejoin="round"/>
            <path d="M12 6.01111L12.01 6" stroke="currentColor"  stroke-linecap="round" stroke-linejoin="round"/>
            <path d="M9 15.6V17.4C9 17.7314 8.73137 18 8.4 18H6.6C6.26863 18 6 17.7314 6 17.4V15.6C6 15.2686 6.26863 15 6.6 15H8.4C8.73137 15 9 15.2686 9 15.6Z" stroke="currentColor"  stroke-linecap="round" stroke-linejoin="round"/>
            <path d="M18 6.6V8.4C18 8.73137 17.7314 9 17.4 9H15.6C15.2686 9 15 8.73137 15 8.4V6.6C15 6.26863 15.2686 6 15.6 6H17.4C17.7314 6 18 6.26863 18 6.6Z" stroke="currentColor"  stroke-linecap="round" stroke-linejoin="round"/>
            <path d="M18 3H21V6" stroke="currentColor"  stroke-linecap="round" stroke-linejoin="round"/>
            <path d="M18 21H21V18" stroke="currentColor"  stroke-linecap="round" stroke-linejoin="round"/>
            <path d="M6 3H3V6" stroke="currentColor"  stroke-linecap="round" stroke-linejoin="round"/>
            <path d="M6 21H3V18" stroke="currentColor"  stroke-linecap="round" stroke-linejoin="round"/>
            </svg>

        </div>
        <div>
          <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
            QrCode Scans
          </p>
          <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">
            {{$resturantStatistic->count_scans}}/{{$limits->max_scans}}
          </p>
        </div>
      </div>
    </div>
    <div
      class="min-w-0 rounded-lg shadow-xs overflow-hidden bg-white dark:bg-gray-800"
    >
      <div class="p-4 flex items-center">
        <div
          class="p-3 rounded-full text-teal-500 dark:text-teal-100 bg-teal-100 dark:bg-teal-500 mr-4"
        >
        <svg fill="currentColor" viewBox="0 0 20 20" class="w-5 h-5">
            <path
              d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z"
            ></path>
          </svg>
        </div>
        <div>
          <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
            Workers
          </p>

          <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">{{count($users)}}</p>
        </div>
      </div>
    </div>
  </div>






@endsection
