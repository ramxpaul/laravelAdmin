<!DOCTYPE html>
<html>

<head>
    <title>Admin Data</title>

    <!-- Latest compiled and minified Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />

    <!-- custom css -->
    <style>
        .m-r-1em {
            margin-right: 1em;
        }

        .m-b-1em {
            margin-bottom: 1em;
        }

        .m-l-1em {
            margin-left: 1em;
        }

        .mt0 {
            margin-top: 0;
        }
    </style>

</head>

<body>
    @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

    <!-- container -->
    <div class="container">
        <div class="page-header">
            <h1>Read Admins</h1>
            <br>
            {{'Welcome , '.auth()->user()->email}}
            <br>

            @include('messages')

        </div>

        <a href="{{url('admins/create')}}" class='btn btn-primary m-r-1em' >+ Account</a>   <a href="{{url('logout')}}" class='btn btn-primary m-r-1em' >Logout</a>

        <br>

        <table class='table table-hover table-responsive table-bordered'>

            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>image</th>
                <th>action</th>
            </tr>


            @foreach ($data as $key => $admin)
                <tr>

                    <td>{{ $admin->id }}</td>
                    <td>{{ $admin->name }}</td>
                    <td>{{ $admin->email }}</td>
                    <td><img src="{{url('images/admins/'.$admin->image)}}"  width="80px" height="80px" ></td>

                    <td>
                        <a href='' data-toggle="modal" data-target="#modal_single_del{{ $admin->id }}"
                            class='btn btn-danger m-r-1em'>Remove</a>

                        <a href='{{ url('admins/edit/' . $admin->id) }}' class='btn btn-primary m-r-1em'>Update</a>
                    </td>
                </tr>






                <div class="modal" id="modal_single_del{{ $admin->id }}" tabindex="-1" role="dialog">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">

                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                <h5 class="modal-title alert alert-danger">Delete Confirmation</h5>
                            </div>

                            <div class="modal-body">
                               Are you Sure That You Want To Remove Admin : {{ $admin->name }} !!!!
                            </div>
                            <div class="modal-footer">
                                <form action="{{ url('admins/delete/') }}" method="post">

                                    @method('delete')
                                    @csrf

                                    <input type="hidden" name="id" value="{{ $admin->id }}">

                                    <div class="not-empty-record">
                                        <button type="submit" class="btn btn-primary">Delete</button>
                                        <button type="button" class="btn btn-secondary"
                                            data-dismiss="modal">close</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
            <!-- end table -->
        </table>

    </div>
    <!-- end .container -->


    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>

    <!-- Latest compiled and minified Bootstrap JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <!-- confirm delete record will be here -->

</body>

</html>
