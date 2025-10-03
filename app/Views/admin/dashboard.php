<?= $this->extend('layouts/admin') ?>

<?= $this->section('content') ?>

<div class="container my-5">
    <h2 class="mb-4 text-center fw-bold">Admin Dashboard</h2>
    <div class="row g-4 mb-5">
        <!-- Total Students -->
        <div class="col-md-4">
            <div class="card text-white bg-primary shadow h-100">
                <div class="card-body">
                    <h5 class="card-title">Total Students</h5>
                    <p class="display-5 fw-bold"><?= esc($totalUsers) ?></p>
                </div>
            </div>
        </div>
        <!-- Total courses -->
        <div class="col-md-4">
            <div class="card text-white bg-primary shadow h-100">
                <div class="card-body">
                    <h5 class="card-title">Total Courses</h5>
                    <p class="display-5 fw-bold"><?= esc($totalCourses) ?></p>
                </div>
            </div>
        </div>
        <!-- Total Enrollment -->
        <div class="col-md-4">
            <div class="card text-white bg-primary shadow h-100">
                <div class="card-body">
                    <h5 class="card-title">Total Enrollment</h5>
                    <p class="display-5 fw-bold"><?= esc($totalEnroll) ?></p>
                </div>
            </div>
        </div>
    </div>
    <div class="text-center">
        <a href="<?= base_url('student/course') ?>" class="btn btn-lg btn-outline-primary rounded-pill px-5">Browse Courses</a>
    </div>
</div>

<?= $this->endSection() ?>
