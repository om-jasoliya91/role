<?= $this->extend('layouts/admin') ?>
<?= $this->section('content') ?>
<style>
.pagination {
    display: flex;
    list-style: none;
    justify-content: center;
    padding-left: 0;
    margin-top: 20px;
}

.pagination li {
    margin: 0 5px;
}

.pagination li a,
.pagination li span {
    display: block;
    padding: 8px 12px;
    background-color: #f1f1f1;
    color: #333;
    border: 1px solid #ccc;
    border-radius: 4px;
    text-decoration: none;
    transition: background-color 0.2s, color 0.2s;
}

.pagination li a:hover {
    background-color: #007bff;
    color: white;
    border-color: #007bff;
}

.pagination li.active span {
    background-color: #007bff;
    color: white;
    border-color: #007bff;
    cursor: default;
}
</style>

<h2 class="mb-4"><?= esc($title) ?></h2>

<form method="get" class="mb-3">
    <div class="input-group">
        <input type="text" name="search" class="form-control" placeholder="Search by name, email, or phone"
            value="<?= esc($search) ?>">
        <button class="btn btn-primary" type="submit">Search</button>
    </div>
</form>

<table class="table table-bordered table-striped align-middle">
    <thead class="table-dark">
        <tr>
            <th>ID</th>
            <th>Profile Image</th>
            <th>Full Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Age</th>
            <th>Gender</th>
            <th>Address</th>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($students)): ?>
        <?php foreach ($students as $student): ?>
        <tr>
            <td><?= esc($student['id']) ?></td>
            <td>
                <?php
                $defaultImg = base_url('images/default-profile.png');
                $profilePic = !empty($student['profile_pic']) && file_exists(FCPATH . 'uploads/' . $student['profile_pic'])
                    ? base_url('uploads/' . $student['profile_pic'])
                    : $defaultImg;
                ?>
                <img src="<?= esc($profilePic) ?>" alt="Profile"
                    style="width:50px; height:50px; object-fit:cover; border-radius:50%;">
            </td>
            <td><?= esc($student['full_name']) ?></td>
            <td><?= esc($student['email']) ?></td>
            <td><?= esc($student['phone']) ?></td>
            <td><?= esc($student['age']) ?></td>
            <td><?= esc($student['gender']) ?></td>
            <td><?= esc($student['address']) ?></td>
        </tr>
        <?php endforeach; ?>
        <?php else: ?>
        <tr>
            <td colspan="8" class="text-center">No students found.</td>
        </tr>
        <?php endif; ?>
    </tbody>
</table>

<!-- Pagination -->
<?php if ($pager): ?>
<div class="mt-4 d-flex justify-content-center">
    <?= $pager->links() ?>
</div>
<?php endif; ?>

<?= $this->endSection() ?>
