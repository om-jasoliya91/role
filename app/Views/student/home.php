    <?= $this->extend('layouts/main') ?>

    <?= $this->section('content') ?>

    <?= $this->endSection() ?>
    <?= $this->extend('layouts/main') ?>

    <?= $this->section('content') ?>

    <!-- Hero Section -->
    <section class="bg-primary text-white text-center py-5">
        <div class="container">
            <h1 class="display-4 fw-bold mb-3">Welcome to Student Portal</h1>
            <p class="lead mb-4">Explore a variety of courses and take your learning to the next level with us.</p>
            <a href="<?= base_url('student/course') ?>" class="btn btn-lg btn-light text-primary fw-semibold rounded-pill px-4 shadow">
                Browse Courses
                <i class="bi bi-arrow-right ms-2"></i>
            </a>
        </div>
    </section>

    <!-- Features Section -->
    <section class="py-5">
        <div class="container">
            <div class="row text-center g-4">
                <div class="col-md-4">
                    <div class="p-4 border rounded-4 shadow-sm h-100">
                        <i class="bi bi-journal-bookmark fs-1 text-primary mb-3"></i>
                        <h5 class="fw-semibold mb-2">Wide Range of Courses</h5>
                        <p class="text-muted">Choose from various courses tailored to your interests and career goals.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="p-4 border rounded-4 shadow-sm h-100">
                        <i class="bi bi-people fs-1 text-primary mb-3"></i>
                        <h5 class="fw-semibold mb-2">Expert Instructors</h5>
                        <p class="text-muted">Learn from experienced professionals and industry experts.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="p-4 border rounded-4 shadow-sm h-100">
                        <i class="bi bi-clock-history fs-1 text-primary mb-3"></i>
                        <h5 class="fw-semibold mb-2">Flexible Learning</h5>
                        <p class="text-muted">Access courses anytime, anywhere, at your own pace.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Call to Action Section -->
    <section class="bg-light py-5 text-center">
        <div class="container">
            <h2 class="fw-bold mb-3">Ready to start learning?</h2>
            <p class="mb-4 text-secondary">Sign up today and unlock your full potential.</p>
            <a href="<?= base_url('register') ?>" class="btn btn-primary btn-lg rounded-pill px-5 shadow">
                Register Now
                <i class="bi bi-person-plus ms-2"></i>
            </a>
        </div>
    </section>

    <?= $this->endSection() ?>
