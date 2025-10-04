<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="container my-5">
    <h2 class="text-center fw-bold mb-5 text-primary">🎓 Available Courses</h2>

    <!-- Flash Messages -->
    <?php foreach (['success', 'error', 'info'] as $type): ?>
        <?php if ($message = session()->getFlashdata($type)): ?>
            <div class="alert alert-<?= $type === 'error' ? 'danger' : $type ?> text-center">
                <?= esc($message) ?>
            </div>
        <?php endif; ?>
    <?php endforeach; ?>

    <?php if (!empty($courses)): ?>
        <div class="row g-4">
            <?php foreach ($courses as $course): ?>
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100 border-0 shadow-sm course-card">
                        <div class="card-body">
                            <h5 class="card-title text-primary"><?= esc($course['course_name']) ?></h5>
                            <p class="text-muted mb-3"><small><?= esc($course['course_code']) ?></small></p>

                            <ul class="list-unstyled mb-3">
                                <li><strong>Duration:</strong> <?= esc($course['duration']) ?></li>
                                <li><strong>Price:</strong> $<?= number_format($course['price'], 2) ?></li>
                                <li>
                                    <strong>Status:</strong>
                                    <span class="badge <?= strtolower($course['status']) === 'active' ? 'bg-success' : 'bg-danger' ?>">
                                        <?= ucfirst($course['status']) ?>
                                    </span>
                                </li>
                            </ul>

                            <?php if (in_array($course['id'], $enrolledCourseIds)): ?>
                                <button class="btn btn-secondary w-100" disabled>
                                    ✔ Already Enrolled
                                </button>
                            <?php else: ?>
                                <a href="<?= base_url('student/course/' . $course['id']) ?>" class="btn btn-primary w-100">
                                    Apply Now →
                                </a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <div class="alert alert-warning text-center mt-4">
            No courses available.
        </div>
    <?php endif; ?>
</div>

<!-- Optional Styling (Bootstrap + Hover Animation) -->
<style>
.course-card {
    transition: all 0.3s ease;
    border-radius: 10px;
}
.course-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 10px 24px rgba(0, 0, 0, 0.15);
}
.btn-primary {
    background: linear-gradient(135deg, #4e73df, #224abe);
    border: none;
}
.btn-primary:hover {
    background: linear-gradient(135deg, #224abe, #4e73df);
    transform: scale(1.03);
}
</style>

<?= $this->endSection() ?>  
