<?php require_once __DIR__ . '/../includes/header.php'; ?>

<div class="container mt-4">
    <div class="row">
        <div class="col-md-12">
            <h2>Admin Dashboard</h2>
            <div class="row mt-4">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Total Users</h5>
                            <p class="card-text display-4"><?= $totalUsers ?></p>
                            <a href="/admin/users" class="btn btn-primary">Manage Users</a>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="mt-4">
                <h3>Recent Users</h3>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Username</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Created At</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($recentUsers as $user): ?>
                            <tr>
                                <td><?= htmlspecialchars($user['username']) ?></td>
                                <td><?= htmlspecialchars($user['email']) ?></td>
                                <td><?= htmlspecialchars($user['role']) ?></td>
                                <td><?= htmlspecialchars($user['created_at']) ?></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
