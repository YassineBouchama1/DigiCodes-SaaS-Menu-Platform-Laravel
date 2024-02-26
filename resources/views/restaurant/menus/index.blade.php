@extends('restaurant.layouts.resturant_layout')

@section('content')
{{-- display msg errors --}}

@if($errors->any())

<ul>
    @foreach ($errors->all() as $error)

        <li class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400" role="alert">
            <span class="font-medium">Danger alert!</span> {{ $error }}
          </li>
@endforeach
</ul>

@endif
@if ($message = Session::get('success'))

<div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400" role="alert">
    <span class="font-medium">Success alert!</span> {{$message}}
  </div>
@endif

<main class="flex gap-6 flex-col md:flex-row">




     <form class=" basis-1/3 " action="{{route('menus.store')}}"  method="POST">
@csrf
  <div class="p-4  bg-white rounded-sm transition-shadow box-border color-opacity-87   shadow-md backdrop-blur-md">
     <h4 class="mb-4 text-3xl font-semibold text-gray-500">Create Categories</h4>
     <hr>
     <label for="Title"
     class="flex flex-col gap-y-1 mt-2 font-bold text-gray-400">
          Title
         <input  type="text" id="title" name="title"
     class="rounded-sm border-md border-gray-200 forced-colors:text-blue-600"
         placeholder="Enter title">
     </label>
     <label for="Title"
     class="flex flex-col gap-y-1 mt-2 font-bold text-gray-400">
     Description
         <input  type="text" id="description" name="description"
     class="rounded-sm border-md border-gray-200 forced-colors:text-blue-600"
         placeholder="Enter description">
     </label>
     <button type="submit"
     class="mainBg rounded-md w-full text-white flex justify-center
     items-center mt-4 px-4 py-1 transition-shadow box-border color-opacity-87   shadow-md shadow-blue-300"
     ><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-device-floppy" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
      <path stroke="none" d="M0 0h24v24H0z" fill="none" />
      <path d="M6 4h10l4 4v10a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2" />
      <path d="M12 14m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
      <path d="M14 4l0 4l-6 0l0 -4" />
    </svg>Save</button>
  </div>
</form>





    <div class="w-full overflow-x-auto p-4 flex flex-col basis-4/3 bg-white rounded-sm transition-shadow box-border color-opacity-87   shadow-md backdrop-blur-md">

        <table class="w-full whitespace-no-wrap">
            <thead>
                <tr
          class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800"
        >
          <th class="px-4 py-3">title</th>

          <th class="px-4 py-3">description</th>
          <th class="px-4 py-3">Action</th>
        </tr>
    </thead>
    <tbody
    class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800"
    >
    @forelse ($menus as $item)
      <tr class="text-gray-700 dark:text-gray-400">
        <td class="px-4 py-3">

            <div class="flex flex-col justify-center">

              <p class="font-semibold">{{$item['title']}}</p>
            </div>

        </td>

        <td class="px-4 py-3 text-xs">
            <span
            class="px-2 py-1 font-semibold leading-tight"
            >
            {{$item['description']}}
        </span>
    </td>
    <td>
        <form method="POST" action="{{route('menus.destroy',['menu'=>$item['id']])}}"
            >
            @csrf()
            @method('delete')
            <button type="submit" class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded inline-flex items-center">
                Delete
            </button>
        </form>

        {{-- <a class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded inline-flex items-center" href="{{route('menus.index',['menu'=>$item['id']])}}">Update</a> --}}

    </td>
</tr>
@empty
<tr>
    <td colspan="6" class="px-4 py-3 text-xs">
        No data available
    </td>
</tr>
@endforelse

</tbody>
</table>
</div>
</main>

@endsection

