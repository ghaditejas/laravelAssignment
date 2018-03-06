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
            <h1>Products</h1>
            <a href="{{action('ProductController@create')}}" class="btn btn-success" style="float: right;">ADD</a>
            <a href="{{action('CategoryController@index')}}" class="btn btn-success" style="float: right;">Category</a><br />
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
                        <th>Price</th>
                        <th>Category</th>
                        <th>Edit Action</th>
                        <th>Delete Action</th> 
                    </tr>
                </thead>
                <tbody>
                    @if($products)
                    @foreach($products as $product)
                    <tr>
                        <td>{{$product['id']}}</td>
                        <td>{{$product['name']}}</td>
                        <td>{{$product['price']}}</td>
                        <td>{{$product['category']}}</td>
                        <td><a href="{{action('ProductController@edit', $product['id'])}}" class="btn btn-warning">Edit</a></td>
                        <td>
                            <form action="{{action('ProductController@destroy', $product['id'])}}" method="post">
                                {{csrf_field()}}
                                <input name="_method" type="hidden" value="DELETE">
                                <button class="btn btn-danger" type="submit">Delete</button>
                            </form>
                        </td>
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

