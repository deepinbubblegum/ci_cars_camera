<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= base_url('public/assets/fontawesome/css/all.css') ?> " rel="stylesheet">
    <script src="<?= base_url('public/assets/js/usermanager.js') ?> "></script>
    <title>Admin Contors</title>
</head>

<body>
    <nav class="navbar navbar-light bg-light justify-content-between">
        <a class="navbar-brand"><i class="far fa-address-card"></i></a>
        <form class="form-inline">
            <a class="btn btn btn-info my-2 my-sm-0" data-toggle="modal" data-target="#registerModal" data-whatever="@mdo" type="logout"><i class="fas fa-user-plus mr-2"></i>Add User</a>
        </form>
    </nav>
    <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Users</th>
                <th scope="col">Options</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th scope="row">1</th>
                <td>Mark</td>
                <td style="align-items: center;"><button type="button" class="btn btn-danger mx-auto"><i class="fas fa-trash-alt"></i></button></td>
            </tr>
            <tr>
                <th scope="row">2</th>
                <td>Jacob</td>
                <td>@fat</td>
            </tr>
            <tr>
                <th scope="row">3</th>
                <td>Jacob</td>
                <td>Jacob</td>
            </tr>
        </tbody>
    </table>

    <div class="modal fade" id="registerModal" tabindex="-1" aria-labelledby="registerLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="registerLabel">Register</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <small for="username">Username</small>
                            <input type="email" class="form-control" placeholder="username" id="username>
                        </div>
                        <div class="form-group">
                            <small for="password-register">Password</small>
                            <input type="password" placeholder="Password" class="form-control" id="password-register">
                        </div>
                        <div class="form-group">
                            <small for="confirm-password">Confirm Password</small>
                            <input type="password" placeholder="Confirm Password" class="form-control" id="confirm-password">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" id="register-btn" class="btn btn-primary">Register</button>
                </div>
            </div>
        </div>
    </div>
</body>

</html>