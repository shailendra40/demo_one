<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Index</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>


    <title>Laravel Ajax Data Fetch Example</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>


    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: ##A569BD;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th,
        td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid rgb(255, 0, 0);
        }

        th {
            background-color: rgb(0, 255, 0);
            font-weight: bold;
        }

        td {
            background-color: #95A5A6;
        }

        a {
            text-decoration: none;
            color: #D35400;
        }

        a:hover {
            text-decoration: underline;
        }

        th {
            text-align: center;
            /* Aligns the content of <th> cells in the center */
            color: rgb(68, 15, 52);
            /* Sets the color of text in <th> cells to aqua */
        }
    </style>
</head>

<body>
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

    <table border="1">
        <thead>
            <tr>
                <th>
                    Name
                </th>
                <th>
                    Email
                </th>
                <th>
                    Phone
                </th>
                <th>
                    Address
                </th>
                <th>
                    Qualification
                </th>
                <th>
                    Experiences
                </th>
                <th>
                    Image
                </th>
                <th>
                    Delete
                </th>
                <th>
                    Update
                </th>
                <th>
                    Show
                </th>
            </tr>
        </thead>
        <tbody>

            @foreach ($resumes as $resume)

                <tr>
                    <td>
                        {{ $resume->name }}
                    </td>
                    <td>
                        {{ $resume->email }}
                    </td>
                    <td>
                        {{ $resume->phone }}
                    </td>
                    <td>
                        {{ $resume->address }}
                    </td>
                    <td>
                        {{ $resume->qualification }}
                    </td>
                    <td>
                        {{ $resume->experience }}
                    </td>

                    <td>
                        @if ($resume->image)
                            @php
                                $imageNames = json_decode($resume->image, true);
                            @endphp

                            @if (is_array($imageNames) && !empty($imageNames))
                                @foreach ($imageNames as $imageName)
                                    <img src="{{ asset('uploads/images/' . $imageName) }}" width="80" height="80"
                                        title="resume" />
                                @endforeach
                            @endif
                        @endif
                    </td>
                    </td>
                    <div>
                        <td>
                            <!-- Delete Button -->
                            <button type="button" class="btn btn-danger" data-toggle="modal"
                                data-target="#deleteModal{{ $resume->id }}">
                                Delete
                            </button>
                        </td>

                        <td>
                            <!-- Edit Button -->
                            <button type="button" class="btn btn-primary" data-toggle="modal"
                                data-target="#editModal{{ $resume->id }}">
                                Edit
                            </button>
                        </td>

                        <td>
                            <!-- Preview Button -->
                            <button type="button" class="btn btn-primary" data-toggle="modal"
                                data-target="#previewModal{{ $resume->id }}">
                                Preview
                            </button>
                        </td>

                    </div>
            @endforeach
        </tbody>
    </table>
    {{-- {{ $resumes->links() }} --}}

    @foreach ($resumes as $resume)
        <!-- Delete Modal -->
        <div class="modal fade" id="deleteModal{{ $resume->id }}" tabindex="-1" role="dialog"
            aria-labelledby="deleteModalLabel{{ $resume->id }}" aria-hidden="true">
            <!-- Modal content for delete confirmation -->
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Are you sure delete?</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Confirm It</p>
                    </div>
                    <div class="modal-footer">
                        <!-- Form to handle deletion -->
                        <form method="GET" action="{{ route('resume.delete', $resume->id) }}"
                            enctype="multipart/form-data">
                            @csrf
                            @method('DELETE')
                            <!-- Buttons for confirmation -->
                            <button type="submit" class="btn btn-primary">Yes</button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>


        <!-- Edit Modal -->

        <div class="modal fade" id="editModal{{ $resume->id }}" tabindex="-1" role="dialog"
            aria-labelledby="editModalLabel{{ $resume->id }}" aria-hidden="true">

            <!-- Modal content for editing -->

            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Are you sure edit?</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Confirm It</p>
                    </div>
                    <div class="modal-footer">
                        <!-- Form to handle edit -->
                        {{-- <form method="GET" action="{{ route('resume.update', $resume->id) }}"
                            enctype="multipart/form-data">
                            @csrf --}}
                            {{-- @method('PUT') --}}
                            <a href="{{ route('resume.update', $resume->id) }}">
                                <button class="btn btn-primary">Yes</button>
                            </a>
                            <button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
                        {{-- </form> --}}
                    </div>
                </div>
            </div>
        </div>
        </div>

        {{-- <h1 style="text-align: center">Edit Details</h1>

                        <link rel="stylesheet"
                            href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
                            integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm"
                            crossorigin="anonymous">

                        @if (session('success'))
                            <div style="color: green;">
                                {{ session('success') }}
                            </div>
                        @endif

                        @if (session('error'))
                            <div style="color: red;">
                                {{ session('error') }}
                            </div>
                        @endif --}}



        {{-- @section('content') --}}




        {{-- <div class="container">
                            <form action="{{ route('resume.update', $resume->id) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf

                                <form action="{{ route('resume.update', $resume->id) }}" method="POST" enctype="multipart/form-data">
                                 @csrf

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
                                    <input class="m-3" type="text" name="phone"
                                        value="{{ $resume->phone }}" placeholder="Enter Phone" /><br>
                                </div>

                                <div class="mb-3">
                                    <label class="m-3" for="address" class="form-label">Address</label>
                                    <input class="m-3" type="text" name="address"
                                        value="{{ $resume->address }}" placeholder="Enter Address" /><br>
                                </div>

                                <div class="mb-3">
                                    <label class="m-3" for="qualification"
                                        class="form-label">Qualification</label>
                                    <input class="m-3" type="text" name="qualification"
                                        value="{{ $resume->qualification }}"placeholder="Enter Qualification" /><br>
                                </div>

                                <div class="mb-3">
                                    <label class="m-3" for="experience" class="form-label">Experience</label>
                                    <input class="m-3" type="text" name="experience"
                                        value="{{ $resume->experience }}" placeholder="Enter Experience" /><br>
                                </div>

                                <div class="mb-3">
                                    <label class="m-3">Images</label>
                                    <input class="m-3" type="file" name="image[]" id="input-file-now-custom-3" class="form-control" multiple onchange="previewImages(event)">
                                    <br>
                                    <div id="image-preview" class="d-flex flex-wrap">
                                        @if ($resume)
                                        @foreach (json_decode($resume->image) as $imageName)
                    <img src="{{ asset('uploads/images/' . $imageName) }}" alt="Resume Image" height="100" width="100">
                @endforeach --}}
        {{-- @endif --}}
        {{-- </div> --}}



        {{-- @include('resume.index') --}}


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
        {{-- <button type="submit" class="btn btn-success">Update</button> --}}


        {{-- <button type="submit" class="btn btn-primary">Yes</button> --}}


        {{-- <button type="button" class="btn btn-danger" data-dismiss="modal">No</button> --}}
        {{-- </form>

    </div>
    <div class="modal-footer">
        <form method="GET" action="{{ route('resume.edit', $resume->id) }}" enctype="multipart/form-data">
            @csrf

            @method('UPDATE') --}}
        <!-- Other form fields -->
        <!-- Buttons for confirmation -->

        {{-- <button type="submit" class="btn btn-primary">Yes</button>
            <button type="button" class="btn btn-danger" data-dismiss="modal">No</button> --}}
        {{-- </form>
    </div> --}}
        {{-- </div>
    </div>
    </div>
    </div> --}}






        <!-- Preview Modal -->
        <div class="modal fade" id="previewModal{{ $resume->id }}" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel{{ $resume->id }}" aria-hidden="true">
            <!-- Modal content for previewing -->
            <!-- ... -->
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Preview</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">


                            {{-- <button type="button" id="resume" data-url="{{ route('resume.preview', $resume->id) }}">
                            Show Resume
                        </button> --}}


                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        {{-- <p>Confirm It</p> --}}
                        {{-- <p><strong>ID:</strong> <span id="resume-id">{{ $resume->id }}</span></p>
                    <p><strong>Name:</strong> <span id="resume-name">{{ $resume->name }}</span></p>
                    <p><strong>Email:</strong> <span id="resume-email">{{ $resume->email }}</span></p>
                    <p><strong>Phone:</strong> <span id="resume-phone">{{ $resume->phone }}</span></p>
                    <p><strong>Address:</strong> <span id="resume-address">{{ $resume->address }}</span></p>
                    <p><strong>Qualification:</strong> <span id="resume-qualification">{{ $resume->qualification }}</span></p>
                    <p><strong>Experiences:</strong> <span id="resume-experience">{{ $resume->experience }}</span></p>
                    <p><strong>Image:</strong> <img id="resume-image" src="" alt="Resume Image" width="100" height="100">{{ $resume->image }}</p> --}}

                        {{-- <p><strong>Image:</strong> <span id="resume-id">{{ $resume->image }}</span></p> --}}


                        {{-- <p><strong>ID:</strong> <span id="resume/show-id">{{ $resume->show }}</span></p> --}}

                        @include('resume.show')


                        {{-- <div class="mb-3"> --}}
                        {{-- <label class="m-3">Images</label> --}}
                        {{-- <input class="m-3" type="file" name="image[]" id="input-file-now-custom-3" class="form-control" multiple onchange="previewImages(event)">
                        <br> --}}


                        {{-- <div id="image-preview" class="d-flex flex-wrap">
                            @if ($resume)
                                @foreach (json_decode($resume->image) as $imageName)
                                    <img src="{{ asset('uploads/images/' . $imageName) }}" alt="Resume Image" height="100" width="100">
                                @endforeach
                            @endif --}}


                        {{-- </div> --}}

                        {{-- </div> --}}
                    </div>

                    <script type="text/javascript">
                        >
                        $(document).ready(function() {

                            /* When click show user */
                            $('body').on('click', '#resume', function() {
                                var resumeURL = $(this).data('url');
                                $.get(resumeURL, function(data) {
                                    $('#resumeShowModal').modal('resume');
                                    $('#resume-id').text(data.id);
                                    $('#resume-name').text(data.name);
                                    $('#resume-email').text(data.email);
                                    $('#resume-phone').text(data.phone);
                                    $('#resume-address').text(data.address);
                                    $('#resume-qualification').text(data.qualification);
                                    $('#resume-experience').text(data.experience);
                                    $('#resume-image').text(data.image);
                                    $('#resume-image').attr('src', data
                                    .image); // Set the 'src' attribute for the image


                                })
                            });
                        });
                    </script>

                    <div class="modal-footer">
                        {{-- <button type="button" class="btn btn-primary">Yes</button> --}}
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        </div>
    @endforeach

    @if ($resumes->lastPage() > 1)
        <div class="d-flex justify-content-center">
            <ul class="pagination">

                <!-- Previous Page Link -->
                <li class="page-item {{ $resumes->onFirstPage() ? 'disabled' : '' }}">
                    <a class="page-link" href="{{ $resumes->previousPageUrl() }}">
                        Previous
                    </a>
                </li>

                <!-- First Page Link -->
                <li class="page-item">
                    <a class="page-link" href="{{ $resumes->url(1) }}">1</a>
                </li>

                <!-- Display ellipsis if more pages before current page -->
                @if ($resumes->currentPage() > 3)
                    <li class="page-item disabled">
                        <span class="page-link">...</span>
                    </li>
                @endif

                <!-- Page Numbers -->
                @for ($i = max(2, $resumes->currentPage() - 1); $i <= min($resumes->currentPage() + 1, $resumes->lastPage() - 1); $i++)
                    <li class="page-item {{ $resumes->currentPage() === $i ? 'active' : '' }}">
                        <a class="page-link" href="{{ $resumes->url($i) }}">{{ $i }}</a>
                    </li>
                @endfor

                <!-- Display ellipsis if more pages after current page -->
                @if ($resumes->currentPage() < $resumes->lastPage() - 2)
                    <li class="page-item disabled">
                        <span class="page-link">...</span>
                    </li>
                @endif

                <!-- Last Page Link -->
                <li class="page-item">
                    <a class="page-link"
                        href="{{ $resumes->url($resumes->lastPage()) }}">{{ $resumes->lastPage() }}</a>
                </li>

                <!-- Next Page Link -->
                <li class="page-item {{ !$resumes->hasMorePages() ? 'disabled' : '' }}">
                    <a class="page-link" href="{{ $resumes->nextPageUrl() }}">
                        Next
                    </a>
                </li>
            </ul>
        </div>
    @endif
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Bootstrap JS and Popper.js -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    @push('scripts')
        <script>
            $(document).ready(function() {
                    @foreach ($resumes as $resume)
                        $('#deleteModal{{ $resume->id }}').on('show.bs.modal', function(event) {
                            var modal = $(this);
                            $.get('{{ route('resume.delete', $resume->id) }}', function(data) {
                                modal.find('.modal-content').html(data);
                            });
                        });

                        $('#editModal{{ $resume->id }}').on('show.bs.modal', function(event) {
                            var modal = $(this);
                            $.get('{{ route('resume.edit', $resume->id) }}', function(data) {
                                modal.find('.modal-content').html(data);
                            });
                        });

                        $('#previewModal{{ $resume->id }}').on('show.bs.modal', function(event) {
                            var modal = $(this);
                            $.get('{{ route('resume.preview', $resume->id) }}', function(data) {
                                modal.find('.modal-content').html(data);
                            });
                        });
                    });
            @endforeach
        </script>
    @endpush

</body>

</html>
