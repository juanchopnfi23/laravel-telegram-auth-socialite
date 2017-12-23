@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    <table>
                        <thead>
                            <tr>
                                <td>id</td>
                                <td>name</td>
                                <td>email</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach( $users as $user ) : ?>
                                <tr>
                                    <td><?php echo $user["id"]; ?></td>
                                    <td><?php echo $user["name"]; ?></td>
                                    <td><?php echo $user["email"]; ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
