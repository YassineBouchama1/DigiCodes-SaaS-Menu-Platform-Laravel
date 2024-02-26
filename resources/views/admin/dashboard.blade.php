@extends('admin/layouts/admin_layout')

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
               Resturants
             </p>
             <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">
               {{count($Restaurant)}}
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
               Users
             </p>
             <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">
               {{count($Users)}}
             </p>
           </div>
         </div>
       </div>


     </div>

   @endsection
