@extends('restaurant.layouts.resturant_layout')
@section('content')
{{-- display msg errors --}}

{{-- @if($errors->any())

<ul>
    @foreach ($errors->all() as $error)

        <li class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400" role="alert">
            <span class="font-medium">Danger alert!</span> {{ $error }}
          </li>

</ul>

@endif --}}

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
        <a href="/restaurant/operatores/create"
        class="mainBg self-end  rounded-md w-30 text-white flex justify-center
        items-center mt-4 mr-4 px-4 py-1 transition-shadow box-border color-opacity-87   shadow-md shadow-blue-300"
        >Add New</a>
        <div class="px-9 pt-5 flex justify-between items-stretch flex-wrap min-h-[70px] pb-0 bg-transparent">
            <h3 class="mb-4 text-3xl font-semibold text-gray-500">Plan List </h3>


        </div>
        <!-- end card header -->
        <!-- card body  -->
        <div class="flex-auto block py-8 pt-6 px-9">
          <div class="overflow-x-auto">
            <table class="w-full my-0 align-middle text-dark border-neutral-200">
              <thead class="align-bottom bg-gray-200 p-8">
                <tr class="font-semibold text-[0.95rem] text-secondary-dark p-4">
                  <th class="p-4 text-start">Name</th>
                  <th class="p-4 text-start ">email</th>


                  <th class="p-4 text-start ">Actions</th>
                </tr>
              </thead>
              <tbody>


                @forelse ($operators as $operatore)

                <tr class="border-b border-dashed last:border-b-0">
                    <td class="p-3 pl-0">
                      <div class="flex items-center">

                        <div class="flex flex-col justify-start">
                          <a href="javascript:void(0)" class="mb-1 font-semibold transition-colors duration-200 ease-in-out text-lg/normal text-secondary-inverse hover:text-primary">
                           {{ $operatore['name']}}
                            </a>
                        </div>
                      </div>
                    </td>

                    <td class="p-3 pr-0 text-start">
                      <span class="text-center align-baseline inline-flex px-2 py-1 mr-auto items-center font-semibold text-base/none text-success bg-success-light rounded-lg">
                        {{ $operatore['email']}}</span>
                    </td>

                    <td class="p-3 pr-12 text-start">
                      <form method="POST" action="{{route('operatores.destroy',['operatore'=>$operatore['id']])}}"
                         class=" hover:text-red-800 duration-200 text-center align-baseline inline-flex px-4 py-3 mr-auto items-center font-semibold text-[.95rem] leading-none text-primary bg-primary-light rounded-lg text-red-500">
                        @csrf()
                        @method('delete')
                        <input value="delete" type="submit" class="cursor-pointer">

                    </form>
                    <a href="{{route('operatores.edit',['operatore'=>$operatore['id']])}}">Update</a>
                    </td>


                  </tr>

                  @empty
                  <tr>
                      <td colspan="6" class="text-center py-4">
                          No data available
                      </td>
                  </tr>
                @endforelse

              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection
