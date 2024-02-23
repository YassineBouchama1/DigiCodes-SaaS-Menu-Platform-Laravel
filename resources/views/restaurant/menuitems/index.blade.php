@extends('restaurant.layouts.resturant_layout')

@section('content')

<div class="w-full overflow-x-auto flex flex-col">
    <a href="/restaurant/menuitems/create"
    class="mainBg self-end  rounded-md w-30 text-white flex justify-center
    items-center mt-4 mr-4 px-4 py-1 transition-shadow box-border color-opacity-87   shadow-md shadow-blue-300"
    >Add New</a>
    <table class="w-full whitespace-no-wrap">
      <thead>
        <tr
          class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800"
        >
          <th class="px-4 py-3">title</th>
          <th class="px-4 py-3">Price</th>
          <th class="px-4 py-3">description</th>
          <th class="px-4 py-3">Action</th>
        </tr>
      </thead>
      <tbody
        class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800"
      >
        <tr class="text-gray-700 dark:text-gray-400">
          <td class="px-4 py-3">

              <div>
                <img class="w-10 h-10 rounded-full" src="/docs/images/people/profile-picture-1.jpg" alt="image menu">

                <p class="font-semibold">Burger</p>
              </div>

          </td>
          <td class="px-4 py-3 text-sm">
            50DH
          </td>
          <td class="px-4 py-3 text-xs">
            <span
              class="px-2 py-1 font-semibold leading-tight"
            >
             this is a
            </span>
          </td>
          <td>
            <button class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded inline-flex items-center">
              Delete
            </button>

            <button class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded inline-flex items-center">
              Update
            </button>
          </td>
      </tbody>
    </table>
  </div>
@endsection
