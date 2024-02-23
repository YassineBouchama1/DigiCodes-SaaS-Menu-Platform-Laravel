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





   <form action="{{route('menuitems.update',['menuitem'=>$menuitem['id']]) }}"  method="POST" enctype="multipart/form-data"
   class="h-full w-full p-4 flex flex-col md:flex-row justify-between gap-4">
    @csrf()
    @method('PUT')
    <div class="w-full p-4 bg-white rounded-sm transition-shadow box-border color-opacity-87   shadow-md backdrop-blur-md">
<h3 class="mb-4 text-3xl font-semibold text-gray-500">Update Menu Items</h3>
<label for="Title"
class="flex flex-col gap-y-1 mt-8">
     Title
    <input  type="text" id="title" name="title" value="{{$menuitem['title']}}"
class="rounded-sm border-md border-gray-200 forced-colors:text-blue-600"
    placeholder="Enter title">
</label>

<label for="price"
class="flex flex-col gap-y-1 mt-8">
price
    <input  type="number" id="price" name="price" value="{{$menuitem['price']}}"
class="rounded-sm border-md border-gray-200 forced-colors:text-blue-600"
    placeholder="Enter price">
</label>

<label for="description"
class="flex flex-col gap-y-1 mt-8">
description
    <input  type="text" id="max_menu_items" name="description" value="{{$menuitem['description']}}"
class="rounded-sm border-md border-gray-200 forced-colors:text-blue-600"
    placeholder="Enter description">
</label>

<label for="password_confirmation"
class="flex flex-col gap-y-1 mt-8">
Categories
<select name="menu_id">

    <option value="1">Piza</option>
    <option value="2">Piza2</option>
</select>
</label>

<label for="password_confirmation"
class="flex flex-col lg:flex-row gap-y-1 mt-8 ">







</label>
    </div>

    <div class=" basis-1/3 	flex  flex-col gap-6">



<div class="p-4  bg-white rounded-sm transition-shadow box-border color-opacity-87   shadow-md backdrop-blur-md">

    <input name="image" type="file">
        {{-- <div id="image-preview" class="max-w-sm p-6 mb-4 bg-gray-100 border-dashed border-2 border-gray-400 rounded-lg items-center mx-auto text-center cursor-pointer">
            <input id="image" name="image" type="file" class="" >
            <label for="image" class="cursor-pointer">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8 text-gray-700 mx-auto mb-4">
              <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5m-13.5-9L12 3m0 0l4.5 4.5M12 3v13.5" />
            </svg>
            <h5 class="mb-2 text-xl font-bold tracking-tight text-gray-700">Upload picture</h5>
            <p class="font-normal text-sm text-gray-400 md:px-6">Choose photo size should be less than <b class="text-gray-600">2mb</b></p>
            <p class="font-normal text-sm text-gray-400 md:px-6">and should be in <b class="text-gray-600">JPG, PNG, or GIF</b> format.</p>
            <span id="filename" class="text-gray-500 bg-gray-200 z-50"></span>
          </label>
        </div> --}}


 </div>

 <div class="p-4 h-40 bg-white rounded-sm transition-shadow box-border color-opacity-87   shadow-md backdrop-blur-md">
    <h4 class="mb-4 text-3xl font-semibold text-gray-500">Update</h4>
    <hr>

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



    </div>
   </from>



<script>
    const uploadInput = document.getElementById('image');
    const filenameLabel = document.getElementById('filename');
    const imagePreview = document.getElementById('image-preview');

    // Check if the event listener has been added before
    let isEventListenerAdded = false;

    uploadInput.addEventListener('change', (event) => {
      const file = event.target.files[0];

      if (file) {
        // filenameLabel.textContent = file.name;

        const reader = new FileReader();
        reader.onload = (e) => {
          imagePreview.innerHTML =
            `<img src="${e.target.result}" class="max-h-48 rounded-lg mx-auto" alt="Image preview" />`;
          imagePreview.classList.remove('border-dashed', 'border-2', 'border-gray-400');

          // Add event listener for image preview only once
          if (!isEventListenerAdded) {
            imagePreview.addEventListener('click', () => {
              uploadInput.click();
            });

            isEventListenerAdded = true;
          }
        };
        reader.readAsDataURL(file);
      } else {
        // filenameLabel.textContent = '';
        imagePreview.innerHTML =
          `<div class="bg-gray-200 h-48 rounded-lg flex items-center justify-center text-gray-500">No image preview</div>`;
        imagePreview.classList.add('border-dashed', 'border-2', 'border-gray-400');

        // Remove the event listener when there's no image
        imagePreview.removeEventListener('click', () => {
          uploadInput.click();
        });

        isEventListenerAdded = false;
      }
    });


  </script>

@endsection
