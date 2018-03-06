<?php ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Index Page</title>
        <link rel="stylesheet" href="{{asset('css/app.css')}}">
        <link rel="stylesheet" href="{{asset('js/datatables/dataTables.bootstrap.css')}}">

    </head>
    <body>
        <div class="container">
            <h1>Category</h1><br />
            <a href="{{action('CategoryController@create')}}" class="btn btn-success" style="float: right;">ADD</a>
            <a href="{{action('ProductController@index')}}" class="btn btn-success" style="float: right;">Products</a><br />
            
            <br />
            @if (\Session::has('success'))
            <div class="alert alert-success">
                <p>{{ \Session::get('success') }}</p>
            </div><br />
            @endif
            <table class="table table-striped" id="Product">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Edit Action</th>
                        <th>Delete Action</th> 
                        <th></th> 
                    </tr>
                </thead>
                <tbody>
                    @if($categories)
                    @foreach($categories as $category)
                    <tr>
                        <td>{{$category['id']}}</td>
                        <td>{{$category['name']}}</td>
                        <td><a href="{{action('CategoryController@edit', $category['id'])}}" class="btn btn-warning">Edit</a></td>
                        <td>
                            <form action="{{action('CategoryController@destroy', $category['id'])}}" method="post">
                                {{csrf_field()}}
                                <input name="_method" type="hidden" value="DELETE">
                                <button class="btn btn-danger" type="submit">Delete</button>
                            </form>
                        </td>
                        <td><a href="{{url('category_product/'.$category['id'])}}" class="btn btn-success">View Products</a></td>
                    </tr>
                    @endforeach
                    @else
                    <tr>
                        <td>NO DATA AVAILABLE</td>    
                    </tr>
                    @endif    
                </tbody>
            </table>
        </div>
    </body>
    <script type="text/javascript" src="{{asset('js/jquery.js')}}"></script>
    <script src="{{asset('js/datatables/jquery.dataTables.min.js')}}"></script>
    <script type="text/javascript">
$(document).ready(function () {
    $("#Product").DataTable({
        "paging": true,
        "autoWidth": true,
        "searching": false,
        "ordering": false,
        "lengthMenu": [2, 5, 10, 25, 50, 75, 100],
        "lengthChange": true,
    });
});
    </script>
</html>

