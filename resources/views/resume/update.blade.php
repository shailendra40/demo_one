<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit Details</title>
</head>

<body>

    <h1 style="text-align: center">Edit Details</h1>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    @if (session('success'))
        <div style="color: green;">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div style="color: red;">
            {{ session('error') }}
        </div>
    @endif

    {{-- @section('content') --}}

    <div class="container">
        <form action="{{ route('resume.update', $resume->id) }}" method="POST" enctype="multipart/form-data">
            @csrf

            {{-- <form action="{{ route('resume.update', $resume->id) }}" method="POST" enctype="multipart/form-data">
            @csrf --}}

            <input type="hidden" name="id" value="{{ $resume->id }}">

            <div class="mb-3">
                <label class="m-3" for="name" class="form-label">Name</label>
                <input class="m-3" type="text" name="name" value="{{ $resume->name }}"
                    placeholder="Enter Name" /><br>
            </div>

            <div class="mb-3">
                <label class="m-3" for="email" class="form-label">Email</label>
                <input class="m-3" type="email" name="email" value="{{ $resume->email }}"
                    placeholder="Enter Email" /><br>
            </div>

            <div class="mb-3">
                <label class="m-3" for="phone" class="form-label">Phone</label>
                <input class="m-3" type="text" name="phone" value="{{ $resume->phone }}"
                    placeholder="Enter Phone" /><br>
            </div>

            <div class="mb-3">
                <label class="m-3" for="address" class="form-label">Address</label>
                <input class="m-3" type="text" name="address" value="{{ $resume->address }}"
                    placeholder="Enter Address" /><br>
            </div>

            <div class="mb-3">
                <label class="m-3" for="qualification" class="form-label">Qualification</label>
                <input class="m-3" type="text" name="qualification"
                    value="{{ $resume->qualification }}"placeholder="Enter Qualification" /><br>
            </div>

            <div class="mb-3">
                <label class="m-3" for="experience" class="form-label">Experience</label>
                <input class="m-3" type="text" name="experience" value="{{ $resume->experience }}"
                    placeholder="Enter Experience" /><br>
            </div>



            <div class="mb-3">
                <label class="m-3">Images</label>
                <input class="m-3" type="file" name="image[]" id="input-file-now-custom-3" class="form-control"
                    multiple onchange="previewImages(event)">
                <br>
                <div id="image-preview" class="d-flex flex-wrap">
                    @if ($resume)
                        @foreach (json_decode($resume->image) as $imageName)
                            <img src="{{ asset('uploads/images/' . $imageName) }}" alt="Resume Image" height="100"
                                width="100">
                        @endforeach
                    @endif
                </div>
            </div>


            <script>
                function previewImages(event) {
                    const preview = document.getElementById('image-preview');
                    preview.innerHTML = ''; // Clear previous previews

                    const files = event.target.files;

                    if (files) {
                        [...files].forEach(file => {
                            const reader = new FileReader();

                            reader.onload = function(e) {
                                const img = document.createElement('img');
                                img.src = e.target.result;
                                img.style.width = '100px'; // Set desired width
                                img.style.height = '100px'; // Set desired height
                                img.style.margin = '5px'; // Set margin between images
                                preview.appendChild(img);
                            }

                            reader.readAsDataURL(file);
                        });
                    }
                }

                function validateForm() {
                    const files = document.getElementById('input-file-now-custom-3').files;
                    if (!files || files.length === 0) {
                        alert('Please select at least one image.');
                        return false;
                    }
                    return true;
                }
            </script>
            <button type="submit" class="btn btn-success">Update</button>
        </form>

    </div>
</body>

</html>
