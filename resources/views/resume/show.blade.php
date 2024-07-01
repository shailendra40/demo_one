<!-- show.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Show Resume</title>
</head>

<body>
    <h1>Resume Details</h1>

    <div>
        <p>Name: {{ $resume->name }}<p>
        <p>Email: {{ $resume->email }}</p>
        <p>Phone: {{ $resume->phone }}</p>
        <p>Address: {{ $resume->address }}</p>
        <p>Qualification: {{ $resume->qualification }}</p>
        <p>Experience: {{ $resume->experience }}</p>
        <p>Image: {{ $resume->images }}</p>

        <div class="image-gallery">
            @foreach(json_decode($resume->image) as $imageName)
                <img src="{{ asset('uploads/images/' . $imageName) }}" alt="Resume Image" height="100" width="100">
            @endforeach
        </div>
    </div>
</body>
</html>
