<?php
require_once __DIR__ . '/../backend/config/Database.php';
require_once __DIR__ . '/../backend/Repository/UserRep.php';

use backend\Repository\UserRep;

$userRep = new UserRep();
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$perPage = 10;
$users = $userRep->getUsers();
$totalUsers = count($users);
$totalPages = ceil($totalUsers / $perPage);
$users = array_slice($users, ($page - 1) * $perPage, $perPage);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Client Accounts</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-4">
<h2>Client Accounts</h2>
<button class="btn btn-primary mb-3" onclick="showAddUserForm()">Add Account</button>

<!-- User Table -->
<table class="table table-bordered">
    <thead>
    <tr>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Email</th>
        <th>Company</th>
        <th>Position</th>
        <th>Actions</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($users as $user): ?>
        <tr>
            <td><?= htmlspecialchars($user['first_name']) ?></td>
            <td><?= htmlspecialchars($user['last_name']) ?></td>
            <td><?= htmlspecialchars($user['email']) ?></td>
            <td><?= htmlspecialchars($user['company_name']) ?></td>
            <td><?= htmlspecialchars($user['position']) ?></td>
            <td>
                <button class="btn btn-warning btn-sm" onclick="editUser('<?= $user['email'] ?>')">Edit</button>
                <button class="btn btn-danger btn-sm" onclick="deleteUser('<?= $user['email'] ?>')">Delete</button>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>

<!-- Pagination -->
<nav>
    <ul class="pagination">
        <?php for ($i = 1; $i <= $totalPages; $i++): ?>
            <li class="page-item <?= ($i == $page) ? 'active' : '' ?>">
                <a class="page-link" href="?page=<?= $i ?>"> <?= $i ?> </a>
            </li>
        <?php endfor; ?>
    </ul>
</nav>

<!-- User Form Modal -->
<div id="userForm" class="modal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">User Form</h5>
                <button type="button" class="btn-close" onclick="hideUserForm()"></button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="editEmail">
                <input type="text" id="firstName" class="form-control mb-2" placeholder="First Name">
                <input type="text" id="lastName" class="form-control mb-2" placeholder="Last Name">
                <input type="email" id="email" class="form-control mb-2" placeholder="Email">
                <input type="text" id="company" class="form-control mb-2" placeholder="Company (Optional)">
                <input type="text" id="position" class="form-control mb-2" placeholder="Position (Optional)">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="saveUser()">Save</button>
                <button type="button" class="btn btn-secondary" onclick="hideUserForm()">Cancel</button>
            </div>
        </div>
    </div>
</div>
<script src="script.js"></script>
</body>
</html>
