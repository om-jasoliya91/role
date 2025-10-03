<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="container my-5">
    <h1 class="mb-5 text-center fw-bold text-primary display-5">Available Courses</h1>

    <?php
    $alertTypes = [
        'success' => 'success',
        'error' => 'danger',
        'info' => 'info'
    ];
    ?>

    <!-- Flash Messages -->
    <?php foreach ($alertTypes as $key => $class): ?>
        <?php if (session()->getFlashdata($key)): ?>
            <div class="alert alert-<?= esc($class) ?> alert-dismissible fade show shadow-sm" role="alert">
                <?= session()->getFlashdata($key) ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>
    <?php endforeach; ?>

    <?php if (!empty($courses) && is_array($courses)): ?>
        <div class="row row-cols-1 row-cols-md-3 g-4">
            <?php foreach ($courses as $course): ?>
                <div class="col">
                    <div class="card h-100 border-0 rounded-4 shadow-sm course-card">
                        <div class="card-body d-flex flex-column p-4">
                            <div class="mb-3">
                                <h5 class="card-title fw-semibold text-primary mb-1"><?= esc($course['course_name']) ?></h5>
                                <small class="text-muted fst-italic"><?= esc($course['course_code']) ?></small>
                            </div>

                            <ul class="list-unstyled flex-grow-1 mb-4">
                                <li><strong>Duration:</strong> <?= esc($course['duration']) ?></li>
                                <li><strong>Price:</strong> $<?= number_format($course['price'], 2) ?></li>
                                <li>
                                    <strong>Status:</strong>
                                    <?php if (strtolower($course['status']) === 'active'): ?>
                                        <span class="badge bg-success">Active</span>
                                    <?php else: ?>
                                        <span class="badge bg-danger">Inactive</span>
                                    <?php endif; ?>
                                </li>
                            </ul>

                            <?php if (in_array($course['id'], $enrolledCourseIds)): ?>
                                <button class="btn btn-outline-secondary mt-auto rounded-pill fw-semibold" disabled>
                                    <i class="bi bi-check-circle-fill me-2"></i> Already Enrolled
                                </button>
                            <?php else: ?>
                                <a href="<?= base_url('student/course/' . esc($course['id'])) ?>"
                                   class="btn btn-primary mt-auto rounded-pill fw-semibold">
                                    <i class="bi bi-pencil-square me-2"></i> Apply Now
                                </a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <div class="alert alert-warning text-center shadow-sm">No courses available.</div>
    <?php endif; ?>
</div>

<style>
    /* Hover effect on cards */
    .course-card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        cursor: pointer;
        background-color: #ffffff;
    }
    .course-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 15px 30px rgba(0, 123, 255, 0.2);
    }

    /* Button tweaks */
    .btn-primary {
        transition: background-color 0.3s ease, box-shadow 0.3s ease;
    }
    .btn-primary:hover {
        background-color: #0056b3;
        box-shadow: 0 8px 20px rgba(0, 86, 179, 0.4);
    }

    /* Card title and small styling */
    .card-title {
        font-size: 1.25rem;
    }
    small.fst-italic {
        font-size: 0.9rem;
    }
</style>

<?= $this->endSection() ?>
