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

<h2 class="mb-4">Students List</h2>

<form method="get" class="mb-3">
    <div class="input-group">
        <input type="text" name="search" class="form-control" placeholder="Search by name, email, or phone" value="<?= esc($search ?? '') ?>">
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
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($students)): ?>
            <?php foreach ($students as $student): ?>
                <tr>
                    <td><?= esc($student['id']) ?></td>

                    <!--  Profile Image with Fallback -->
                    <td>
                        <?php
                        $defaultImg = base_url('images/default-profile.png');
                        $profilePic = !empty($student['profile_pic']) && file_exists(FCPATH . 'uploads/' . $student['profile_pic'])
                            ? base_url('uploads/' . $student['profile_pic'])
                            : $defaultImg;
                        ?>
                        <img src="<?= esc($profilePic) ?>" alt="Profile Image" style="width:50px; height:50px; object-fit:cover; border-radius:50%;">
                    </td>

                    <td><?= esc($student['full_name']) ?></td>
                    <td><?= esc($student['email']) ?></td>
                    <td><?= esc($student['phone']) ?></td>
                    <td><?= esc($student['age']) ?></td>
                    <td><?= esc($student['gender']) ?></td>
                    <td><?= esc($student['address']) ?></td>
                    <td>
                        <a href="<?= base_url('admin/edit/' . $student['id']) ?>" class="btn btn-warning btn-sm">Edit</a>
                        <a href="<?= base_url('admin/delete/' . $student['id']) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this student?')">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="9" class="text-center">No students found.</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>

<!--  Pagination -->
<div class="mt-4">
    <?= $pager->links() ?>
</div>

<?= $this->endSection() ?>
