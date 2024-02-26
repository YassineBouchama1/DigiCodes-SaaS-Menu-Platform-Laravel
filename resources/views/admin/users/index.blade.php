@extends('admin/layouts/admin_layout')
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

{{-- display msg if  successfylly --}}
@if ($message = Session::get('success'))

<div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400" role="alert">
    <span class="font-medium">Success alert!</span> {{$message}}
  </div>
@endif

<div class="w-full overflow-x-auto flex flex-col">
    <a href="/admin/users/create"
    class="mainBg self-end  rounded-md w-30 text-white flex justify-center
    items-center mt-4 mr-4 px-4 py-1 transition-shadow box-border color-opacity-87   shadow-md shadow-blue-300"
    >Add New</a>
    <table class="w-full whitespace-no-wrap">
      <thead>
        <tr
          class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800"
        >
          <th class="px-4 py-3">Name</th>
          <th class="px-4 py-3">Email</th>

          <th class="px-4 py-3">Action</th>
        </tr>
      </thead>
      <tbody
        class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800"
      >
      @forelse ($users as $user)

        <tr class="text-gray-700 dark:text-gray-400">
          <td class="px-4 py-3">

              <div>
                <p class="font-semibold"> {{ $user['name']}}</p>

          </td>
          <td class="px-4 py-3 text-sm">
            {{ $user['email']}}
          </td>

          <td>
            <form method="POST" action="{{route('users.destroy',['user'=>$user['id']])}}">
               @csrf()
               @method('delete')
               <button type="submit" class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded inline-flex items-center">
                Delete
              </button>
           </form>

           <a class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded inline-flex items-center" href="{{route('users.edit',['user'=>$user['id']])}}">Update</a>

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


@endsection
