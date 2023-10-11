<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <title>Document</title>
</head>
<body>
 <div class="container">
    <h3 class="text-center mt-3"><b class="text-danger">my categories</b></h3>
    <a href="{{ route('categories.create') }}" class="btn btn-primary">create new category</a>
    <table class="table">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">name</th>
            <th scope="col">edit</th>
            <th scope="col">delete</th>
          </tr>
        </thead>
        <tbody>

            @foreach ($categories as $category )
            <tr>
                <form action="{{ route('categories.destroy',$category->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <th scope="row">{{ $loop->index }}</th>
                    <td>{{ $category->name }}</td>
                    <td><a href="{{ route('categories.edit',$category->id) }}" class="btn btn-primary">edit</a></td>
                    <td><button type="submit" class="btn btn-danger">delete</button></td>
                </form>
            </tr>
            @endforeach

        </tbody>
      </table>
 </div>
</body>
</html>
