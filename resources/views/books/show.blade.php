<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Book Detail</title>

    {{-- Bootstrap CDN --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"/>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital@0;1&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: "Poppins", sans-serif;
            font-weight: 400;
            font-style: normal;
        }
        a {
            text-decoration: none
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="container justify-content-center d-flex align-items-center">
            <div class="card mt-3 mb-3" style="width: 50%;">
                <img src="{{ asset('storage/' . $book->cover_image) }}" class="card-img-top rounded" >
                <div class="card-body">
                  <h5 class="card-header bg-transparent p-1">
                    <span class="d-block">
                      {{ $book->name }}
                    </span>
                    <span>
                        @if ($book->is_published)
                            <small class=" opacity-75 fw-medium fs-6"><i class="fa-sharp fs-6 text-success fa-solid fa-circle-check"></i> Publised</small>
                        @else
                            <small class=" opacity-75 fw-medium fs-6"><i class="fa-solid fs-6 text-danger fa-circle-xmark"></i> Not Publised</small>
                        @endif
                    </span>
                  </h5>
                  <article class="card-text mt-2 mb-2 pb-1 border-bottom">{!! $book->description !!}</article>
                  <span class="card-text d-block text-body-secondary">Dibuat  : {{ $book->created_at->diffForHumans() }}</span>
                  <span class="card-text d-block text-body-secondary">Penulis : {{ $book->author }}</span>
                  <a class="btn btn-primary mt-3" href="{{ route('books.index') }}">Back</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
