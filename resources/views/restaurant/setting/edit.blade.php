@extends('restaurant.layouts.resturant_layout')
@section('content')
{{-- display msg errors --}}
<style>
    .hiddenp {
    opacity: 0;
}
</style>
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
@if ($message = Session::get('error'))

<div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400" role="alert">
    <span class="font-medium">Danger alert!</span> {{$message}}
  </div>
@endif
<form   method="POST" action="{{route('setting.update',['restaurant'=>$restaurant->id])}}"
class="h-auto w-full p-4 flex flex-col md:flex-row justify-between gap-4">
@method('patch')
 @csrf()
 <div class="w-full p-4 bg-white rounded-sm transition-shadow box-border color-opacity-87   shadow-md backdrop-blur-md">
<h3 class="mb-4 text-3xl font-semibold text-gray-500">Informations</h3>
<label for="name"
class="flex flex-col gap-y-1 mt-8">
Name
 <input  type="text" id="name"  disabled value="{{$restaurant->name}}"
class="rounded-sm border-md border-gray-200 opacity-45"
 placeholder="Enter address">
</label>
<label for="address"
class="flex flex-col gap-y-1 mt-8">
address
 <input  type="text" id="address" name="address" value="{{$restaurant->address}}"
class="rounded-sm border-md border-gray-200 forced-colors:text-blue-600"
 placeholder="Enter address">
</label>



<label for="password"
class="flex flex-col gap-y-1 mt-8">
opening hours
<div>
  <input  type="time" id="opening_hour" name="opening_hour"
  value="{{$restaurant->opening_hour}}"
class="rounded-sm border-md border-gray-200 forced-colors:text-blue-600"
 placeholder="Enter opening_hour">
To
<input  type="time" id="closing_hour" name="closing_hour"
value="{{$restaurant->closing_hour}}"
class="rounded-sm border-md border-gray-200 forced-colors:text-blue-600"
 placeholder="Enter closing_hour">
</div>
</label>

<button type="submit" id="btnSubmit"
class="mainBg rounded-md w-full text-white flex justify-center
items-center mt-4 px-4 py-1 transition-shadow box-border color-opacity-87   shadow-md shadow-blue-300"
><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-device-floppy" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
 <path stroke="none" d="M0 0h24v24H0z" fill="none" />
 <path d="M6 4h10l4 4v10a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2" />
 <path d="M12 14m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
 <path d="M14 4l0 4l-6 0l0 -4" />
</svg>Save</button>

 </div>


</from>


{{-- <script>
    // Get the elements
    const openingHourInput = document.getElementById('opening_hour');
    const closingHourInput = document.getElementById('closing_hour');
    const saveButton = document.getElementById('btnSubmit');

    saveButton.addEventListener('click', function() {
        checkHours();
    });

    saveButton.addEventListener('mouseover', function() {
        checkHours();
        saveButton.
    });

    function checkHours() {
        const openingHour = openingHourInput.value;
        const closingHour = closingHourInput.value;

        if (openingHour === '' || closingHour === '') {
            console.log('Please fill in both opening and closing hours.');
            // saveButton.disabled = true;
            // saveButton.style.opacity = '0';

            return;
        }

        // Cconvert hours to Date objects for comparison
        const openingTime = new Date('2000-01-01T' + openingHour);
        const closingTime = new Date('2000-01-01T' + closingHour);

        // Check if opening hour is greater than closing hour
        if (openingTime >= closingTime) {
            console.log('Opening hour must be earlier than closing hour.');
        } else {
            console.log('Hours are valid.');
        }
    }
</script> --}}

@endsection
