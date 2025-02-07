<?php require_once __DIR__ . '/../../includes/header.php'; ?>

<div class="container mt-4">
    <div class="row">
        <div class="col-md-12">
            <div class="d-flex justify-content-between align-items-center">
                <h2>User Management</h2>
                <a href="/admin/users/create" class="btn btn-primary">Add New User</a>
            </div>
            
            <?php if (isset($_SESSION['success'])): ?>
                <div class="alert alert-success mt-3">
                    <?= $_SESSION['success']; ?>
                    <?php unset($_SESSION['success']); ?>
                </div>
            <?php endif; ?>
            
            <?php if (isset($_SESSION['error'])): ?>
                <div class="alert alert-danger mt-3">
                    <?= $_SESSION['error']; ?>
                    <?php unset($_SESSION['error']); ?>
                </div>
            <?php endif; ?>
            
            <div class="table-responsive mt-4">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Created At</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($users as $user): ?>
                        <tr>
                            <td><?= htmlspecialchars($user['id']) ?></td>
                            <td><?= htmlspecialchars($user['username']) ?></td>
                            <td><?= htmlspecialchars($user['email']) ?></td>
                            <td><?= htmlspecialchars($user['role']) ?></td>
                            <td><?= htmlspecialchars($user['created_at']) ?></td>
                            <td>
                                <a href="/admin/users/<?= $user['id'] ?>/edit" class="btn btn-sm btn-info">Edit</a>
                                <form action="/admin/users/<?= $user['id'] ?>/delete" method="POST" class="d-inline">
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this user?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/../../includes/footer.php'; ?>
