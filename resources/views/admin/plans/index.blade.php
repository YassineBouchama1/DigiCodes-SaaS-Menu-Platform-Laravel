@extends('admin/layouts/admin_layout')

@section('content')
<div class="flex flex-wrap -mx-3 mb-5">
  <div class="w-full max-w-full px-3 mb-6  mx-auto">
    <div class="relative flex-[1_auto] flex flex-col break-words min-w-0 bg-clip-border rounded-[.95rem] bg-white m-5">
      <div class="relative flex flex-col min-w-0 break-words border border-dashed bg-clip-border rounded-2xl border-stone-200 bg-light/30">
        <!-- card header -->
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
                  <th class="p-4 text-start ">price</th>
                  <th class="p-4 text-start ">max_menu_items</th>
                  <th class="p-4  text-start ">max_media</th>
                  <th class="p-4  text-start ">max_scans</th>

                  <th class="p-4 text-start ">Actions</th>
                </tr>
              </thead>
              <tbody>
                <tr class="border-b border-dashed last:border-b-0">
                  <td class="p-3 pl-0">
                    <div class="flex items-center">

                      <div class="flex flex-col justify-start">
                        <a href="javascript:void(0)" class="mb-1 font-semibold transition-colors duration-200 ease-in-out text-lg/normal text-secondary-inverse hover:text-primary">
                             Plan Free</a>
                      </div>
                    </div>
                  </td>
                  <td class="p-3 pr-0 text-start">
                    <span class="font-semibold text-light-inverse text-md/normal">10</span>
                  </td>
                  <td class="p-3 pr-0 text-start">
                    <span class="text-center align-baseline inline-flex px-2 py-1 mr-auto items-center font-semibold text-base/none text-success bg-success-light rounded-lg">
                      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-1">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18L9 11.25l4.306 4.307a11.95 11.95 0 015.814-5.519l2.74-1.22m0 0l-5.94-2.28m5.94 2.28l-2.28 5.941" />
                      </svg> 0.00$</span>
                  </td>
                  <td class="p-3 pr-12 text-start">
                    <span class="text-center align-baseline inline-flex px-4 py-3 mr-auto items-center font-semibold text-[.95rem] leading-none text-primary bg-primary-light rounded-lg">10</span>
                  </td>
                  <td class="p-3 pr-12 text-start">
                    <span class="text-center align-baseline inline-flex px-4 py-3 mr-auto items-center font-semibold text-[.95rem] leading-none text-primary bg-primary-light rounded-lg">10</span>
                  </td>

                  <td class="p-3 pr-12 text-start">
                    <span class="text-center align-baseline inline-flex px-4 py-3 mr-auto items-center font-semibold text-[.95rem] leading-none text-primary bg-primary-light rounded-lg">10</span>
                  </td>

                  </td>
                </tr>


              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection
