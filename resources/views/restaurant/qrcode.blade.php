@extends('restaurant.layouts.resturant_layout')
@section('content')






        <div class="flex justify-center flex-col items-center  gap-10 p-10">
            <p class="">Qr Code For Resturant</p>
            <img id="qrCodeImage" class="my-6" src="data:image/png;base64, {!!  base64_encode($qrCode) !!}"/>
            <a  class="bg-blue-600 text-blue-700 w-2auto h-5" href="data:image/png;base64, {!!  base64_encode($qrCode) !!}" download="qrcode.png">Download QR Code</a>

        </div>


<!-- Form for Color Selection -->
<form id="colorForm">
    <label for="foregroundColor">Foreground Color:</label>
    <input type="color" id="foregroundColor" name="foregroundColor" value="#000000">

    <label for="backgroundColor">Background Color:</label>
    <input type="color" id="backgroundColor" name="backgroundColor" value="#ffffff">

    <button type="submit">Generate QR Code</button>
</form>

<!-- JavaScript to Handle Form Submission and QR Code Generation -->
<script>
    document.getElementById('colorForm').addEventListener('submit', function(event) {
        event.preventDefault();

        // Get selected colors
        var foregroundColor = document.getElementById('foregroundColor').value;
        var backgroundColor = document.getElementById('backgroundColor').value;

        // Send AJAX request to regenerate QR code with selected colors
        fetch('/restaurant/generate-qrcode', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({
                foregroundColor: foregroundColor,
                backgroundColor: backgroundColor
            })
        })
        .then(response => response.json())
        .then(data => {
            // Update QR code image with the newly generated QR code
            document.getElementById('qrCodeImage').src = data.qrCode;
        })
        .catch(error => console.error('Error:', error));
    });
</script>

@endsection
