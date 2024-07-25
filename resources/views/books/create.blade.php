<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Books Data</title>

    {{-- Bootstrap CDN --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"/>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital@0;1&display=swap" rel="stylesheet">

    {{-- Trix --}}
    <link rel="stylesheet" type="text/css" href="https://unpkg.com/trix@2.0.8/dist/trix.css">
    <script type="text/javascript" src="https://unpkg.com/trix@2.0.8/dist/trix.umd.min.js"></script>
    <style>
        trix-toolbar [data-trix-button-group="file-tools"]{
            display: none
        }
    </style>

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
        <div class="pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Add New Book</h1>
        </div>
        <div class="col-lg-8 mb-3">
            <form action="{{ route('books.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                {{-- name --}}
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" autofocus value="{{old('name')}}">
                    @error('name')
                        <div class="invalid-feedback">
                            {{ $message}}
                        </div>
                    @enderror
                </div>

                {{-- author --}}
                <div class="mb-3">
                    <label for="author" class="form-label">Author</label>
                    <input type="text" class="form-control @error('author') is-invalid @enderror" id="author" name="author"  value="{{old('author')}}">
                    @error('author')
                        <div class="invalid-feedback">
                            {{ $message}}
                        </div>
                    @enderror
                </div>

                {{-- Status --}}
                <div class="mb-3">
                    <label for="is_published" class="form-label">Status</label>
                    <select class="form-select" name="is_published">
                        <option value="1">Publised</option>
                        <option value="0">No Publised</option>
                    </select>
                    @error('is_published')
                        <div class="invalid-feedback">
                            {{ $message}}
                        </div>
                    @enderror
                </div>

                {{-- image --}}
                <div class="mb-3">
                    <label for="cover_image" class="form-label">Cover Image</label>
                    <img class="img-preview rounded img-fluid mb-3 col-sm-5">
                    <input class="form-control @error('cover_image') is-invalid @enderror" type="file" id="cover_image" name="cover_image" onchange="imgPreview()">
                    @error('cover_image')
                        <div class="invalid-feedback">
                            {{ $message}}
                        </div>
                    @enderror
                </div>

                {{-- description --}}
                <div class="mb-3">
                    @error('description')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                    <label for="category_id" class="form-label">Description</label>
                    <input id="description" type="hidden" name="description" value="{{old('description')}}">
                    <trix-editor input="description"></trix-editor>
                </div>

                {{-- submit --}}
                <button type="submit" class="btn btn-primary">Submit</button>
                <a href="{{ route('books.index') }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>

    <script>
        function imgPreview() {
            const image = document.querySelector("#cover_image");
            const imgPreview = document.querySelector(".img-preview");

            imgPreview.style.display = 'block';

            const oFReader = new FileReader();
            oFReader.readAsDataURL(image.files[0]);

            oFReader.onload = function(oFREvent) {
                imgPreview.src = oFREvent.target.result;
            }
        }
        document.addEventListener('trix-file-accept', function(e) {
            e.preventDefault();
        })
    </script>
</body>
</html>
