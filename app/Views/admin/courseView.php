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

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>All Courses</h2>
    <a href="<?= base_url('admin/courseAdd') ?>" class="btn btn-success">+ Add New Course</a>
</div>

<?php if (session()->getFlashdata('success')): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?= session()->getFlashdata('success') ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<table class="table table-bordered table-striped align-middle">
    <thead class="table-dark">
        <tr>
            <th>ID</th>
            <th>Course Name</th>
            <th>Course Code</th>
            <th>Duration</th>
            <th>Price ($)</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($courses)): ?>
            <?php foreach ($courses as $course): ?>
                <tr>
                    <td><?= esc($course['id']) ?></td>
                    <td><?= esc($course['course_name']) ?></td>
                    <td><?= esc($course['course_code']) ?></td>
                    <td><?= esc($course['duration']) ?></td>
                    <td><?= esc($course['price']) ?></td>
                    <td>
                        <span class="badge bg-<?= strtolower($course['status']) === 'active' ? 'success' : 'danger' ?>">
                            <?= ucfirst($course['status']) ?>
                        </span>
                    </td>
                    <td>
                        <a href="<?= base_url('admin/course/edit/' . $course['id']) ?>" class="btn btn-sm btn-warning">Edit</a>
                        <a href="<?= base_url('admin/course/delete/' . $course['id']) ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this course?')">Delete</a>
                    </td>
                </tr>
            <?php endforeach ?>
        <?php else: ?>
            <tr><td colspan="7" class="text-center">No courses found.</td></tr>
        <?php endif ?>
    </tbody>
</table>

<!--  Pagination -->
<div class="mt-4">
    <?= $pager->links() ?>
</div>
<?= $this->endSection() ?>
