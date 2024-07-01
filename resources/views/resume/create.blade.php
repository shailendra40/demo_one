    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Create</title>
    </head>
    <body>
        <h1 style="text-align: center">RESUME</h1>

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
            <form action="{{ route('resume.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" name="name" id="name" class="form-control" value="{{ old('name')}}">
                    @error('name')
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" id="email" class="form-control" value="{{ old('email')}}">
                    @error('email')
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="phone" class="form-label">Phone</label>
                    <input type="numeric" name="phone" id="phone" class="form-control" value="{{ old('phone')}}">
                    @error('phone')
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="address" class="form-label">Address</label>
                    <input type="text" name="address" id="address" class="form-control" value="{{ old('address')}}">
                    @error('address')
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="qualification" class="form-label">Qualification</label>
                    <input type="text" name="qualification" id="qualification" class="form-control" value="{{ old('qualification')}}">
                    @error('qualification')
                    @enderror
                </div>

                    <div class="mb-3">
                        <label for="experience" class="form-label">Experience</label>
                        <input type="text" name="experience" id="experience" class="form-control" value="{{ old('experience')}}">
                        @error('experience')
                        @enderror
                    </div>

                    <div class="mb-3">
                    <label for="images">Images</label>
                    <div id="image-preview" name="d-flex flex-wrap"></div>
                    <input type="file" id="input-file-now-custom-3" name="image[]" multiple onchange="previewImages(event)">
                    <br><br>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
    </form>

    <script>
        function previewImages(event) {
            const preview = document.getElementById('image-preview');
            preview.innerHTML = ''; // Clear previous previews
            const files = event.target.files;
            if (files) {
                [...files].forEach(file => {
                    const reader = new FileReader();
                    reader.onload = function (e) {
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
    </body>
    </html>
