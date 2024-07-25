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
        <div class="header mb-3 mt-3">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <a href="{{ route('books.create') }}" class="btn btn-primary md-2"><i class="fa-solid fa-circle-plus"></i> Add Book</a>
                </div>
            </div>
        </div>

        @if(session()->has('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fa-sharp text-success fa-solid fa-circle-check"></i>
                <strong>Success!</strong> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @elseif (session()->has('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fa-solid fa-circle-exclamation"></i>
                <strong>Gagal!</strong> {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th class="text-center" scope="col">No</th>
                        <th class="text-center" scope="col">Cover</th>
                        <th class="text-center" scope="col">Name</th>
                        <th class="text-center" scope="col">Author</th>
                        <th class="text-center" scope="col">Status</th>
                        <th class="text-center" scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($books as $book)
                        <tr>
                            <th class="text-center" width="5%" scope="row">{{ $loop->iteration}}</th>
                            <td class="text-center" width="20%">
                                <img src="{{ asset('storage/' . $book->cover_image) }}" class="rounded img-fluid">
                            </td>
                            <td class="text-start" width="25%"><span class="d-block">{{ $book->name }}</span></td>
                            <td class="text-start" width="15%">{{ $book->author }}</td>
                            <td class="text-start" width="15%">{{ $book->is_published ? 'Published' : 'Not Published' }}</td>
                            <td width="15%">
                                <a href="" class="mb-2 d-block fs-6 badge bg-info" style="width: 60%;margin: auto"><i class="fa-solid fa-eye"></i> Detail</a>
                                <a href="" class="mb-2 d-block fs-6 badge bg-warning" style="width: 60%;margin: auto"><i class="fa-solid fa-pen-to-square"></i> Edit</a>

                                <form action="" method="POST" style="width: 60%; margin:auto">
                                    @csrf
                                    @method('DELETE')
                                    <button class="badge fs-6 bg-danger border-0" style="width: 100%" onclick="return confirm('Apa kamu Yakin?..')"><i class="fa-solid fa-trash"></i> Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr class="text-center">
                            <td colspan="7" class="">
                                Data Buku Belum Tersedia.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            {{ $books->links() }}
    </div>
</body>
</html>
