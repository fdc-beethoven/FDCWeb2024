<?php

$user = new User($db);
$users = $user->getAllUsers();

if (isset($_POST['action_type'])) {  
    switch ($_POST['action_type']) {
        case 'delete':
            $user->deactivateUser($_POST['user_id']);
            echo "<script> window.location.href = '?page=dashboard&delete_success=1'; 
            </script>";
            break;
        case 'edit':
            $user->editUserDetails($_POST['user_id'], $_POST['editFirstName'], $_POST['editLastName'], $_POST['editRole'], $_POST['editProfilePhoto']);
            echo "<script> window.location.href = '?page=dashboard&edit_success=1'; 
            </script>";
            break;
        case 'create':
            $user->createUser($_POST['username'], $_POST['password'], $_POST['role'], $_POST['firstName'], $_POST['lastName'], $_POST['profilePhoto']);
            echo "<script> window.location.href = '?page=dashboard&create_success=1'; 
            </script>";
            break;
    }
}

if (isset($_GET["create_success"])) {
	?> 
        <div class="alert alert-success">
            User created successfully!
        </div>
    <?php
}

if (isset($_GET["edit_success"])) {
    ?> 
        <div class="alert alert-success">
            User updated successfully!
        </div>
    <?php
}

if (isset($_GET["delete_success"])) {
    ?> 
        <div class="alert alert-success">
            User deleted successfully!
        </div>
    <?php
}
?>

<body>
    <div class="container mt-5">
        <h1 class="mb-4">Admin Dashboard</h1>

        <button class="btn btn-primary mb-3" data-toggle="modal" data-target="#createUserModal">Create User</button>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Username</th>
                    <th>Role</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
            <?php if (empty($users)): ?>
                    <tr>
                        <td colspan="6" class="text-center">No users found!</td>
                    </tr>
                    <?php else: ?>
                <?php foreach ($users as $user): ?>
                    <tr>
                        <td><?php echo $user['id']; ?></td>
                        <td><?php echo $user['username']; ?></td>
                        <td><?php echo $user['role']; ?></td>
                        <td><?php echo $user['first_name']; ?></td>
                        <td><?php echo $user['last_name']; ?></td>
                        <td>
                            <button class="btn btn-warning btn-sm" data-toggle="modal"
                                data-target="#editUserModal-<?php echo $user['id']; ?>">Edit</button>
                            <form action="?page=dashboard" method="POST">
                                <input type="hidden" name="action_type" value="delete">
                                <input type="hidden" name="user_id" value="<?php echo $user['id']; ?>">
                                <button type="submit" name="delete_user" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </td>
                    </tr>

                    <div class="modal fade" id="editUserModal-<?php echo $user['id']; ?>" tabindex="-1" role="dialog"
                        aria-labelledby="editUserModalLabel-<?php echo $user['id']; ?>" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form method="post" action="?page=dashboard">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editUserModalLabel-<?php echo $user['id']; ?>">Edit User
                                        </h5>
                                        <button type="button" class="close" data-dismiss="modal">
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <input type="hidden" name="user_id" value="<?php echo $user['id']; ?>">
                                        <div class="form-group">
                                            <label for="editUsername-<?php echo $user['id']; ?>">Username</label>
                                            <input type="text" class="form-control"
                                                id="editUsername-<?php echo $user['id']; ?>" name="editUsername"
                                                value="<?php echo $user['username']; ?>" disabled>
                                        </div>
                                        <div class="form-group">
                                            <label for="editRole-<?php echo $user['id']; ?>">Role</label>
                                            <select class="form-control" id="editRole-<?php echo $user['id']; ?>"
                                                name="editRole" required>
                                                <option value="pm" <?php if ($user['role'] == 'pm')
                                                    echo 'selected'; ?>>Manager</option>
                                                <option value="member" <?php if ($user['role'] == 'member')
                                                    echo 'selected'; ?>>Member</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="editFirstName-<?php echo $user['id']; ?>">First Name</label>
                                            <input type="text" class="form-control"
                                                id="editFirstName-<?php echo $user['id']; ?>" name="editFirstName"
                                                value="<?php echo $user['first_name']; ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="editLastName-<?php echo $user['id']; ?>">Last Name</label>
                                            <input type="text" class="form-control"
                                                id="editLastName-<?php echo $user['id']; ?>" name="editLastName"
                                                value="<?php echo $user['last_name']; ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="editProfilePhoto-<?php echo $user['id']; ?>">Profile Photo
                                                URL</label>
                                            <input type="text" class="form-control"
                                                id="editProfilePhoto-<?php echo $user['id']; ?>" name="editProfilePhoto"
                                                value="<?php echo $user['profile_photo']; ?>">
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <input type="hidden" name="action_type" value="edit">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="submit" name="edit_user" class="btn btn-primary">Save Changes</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <div class="modal fade" id="createUserModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="createUserForm" action="?page=dashboard&create_success=1" method="POST">
                    <div class="modal-header">
                        <h5 class="modal-title" id="createUserModalLabel">Create User</h5>
                        <button type="button" class="close" data-dismiss="modal">
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" class="form-control" id="username" name="username" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        <div class="form-group">
                            <label for="role">Role</label>
                            <select class="form-control" id="role" name="role" required>
                                <option value="member">Admin</option>
                                <option value="pm">Manager</option>
                                <option value="member">Member</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="firstName">First Name</label>
                            <input type="text" class="form-control" id="firstName" name="firstName" required>
                        </div>
                        <div class="form-group">
                            <label for="lastName">Last Name</label>
                            <input type="text" class="form-control" id="lastName" name="lastName" required>
                        </div>
                        <div class="form-group">
                            <label for="profilePhoto">Profile Photo URL</label>
                            <input type="text" class="form-control" id="profilePhoto" name="profilePhoto">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Create User</button>
                    </div>
                    <input type="hidden" name="user_id" value="<?php echo $_SESSION['user_id']; ?>" />
		            <input type="hidden" name="status" value="1" />
                    <input type="hidden" name="action_type" value="create" />
                </form>
            </div>
        </div>
    </div>
</body>