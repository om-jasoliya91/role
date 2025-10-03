<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="courses-container">
    <h1 class="page-title">Available Courses</h1>

    <!-- Flash Messages -->
    <?php
    $alertTypes = [
        'success' => 'success',
        'error' => 'danger',
        'info' => 'info'
    ];
    ?>
    <?php foreach ($alertTypes as $key => $class): ?>
        <?php if (session()->getFlashdata($key)): ?>
            <div class="alert alert-<?= esc($class) ?>">
                <?= session()->getFlashdata($key) ?>
            </div>
        <?php endif; ?>
    <?php endforeach; ?>

    <?php if (!empty($courses) && is_array($courses)): ?>
        <div class="courses-grid">
            <?php foreach ($courses as $course): ?>
                <div class="course-card">

                    <!-- Header -->
                    <div class="course-header">
                        <h3><?= esc($course['course_name']) ?></h3>
                        <small><?= esc($course['course_code']) ?></small>
                    </div>

                    <!-- Info -->
                    <div class="course-body">
                        <ul>
                            <li><strong>Duration:</strong> <?= esc($course['duration']) ?></li>
                            <li><strong>Price:</strong> $<?= number_format($course['price'], 2) ?></li>
                            <li>
                                <strong>Status:</strong>
                                <?php if (strtolower($course['status']) === 'active'): ?>
                                    <span class="badge active">Active</span>
                                <?php else: ?>
                                    <span class="badge inactive">Inactive</span>
                                <?php endif; ?>
                            </li>
                        </ul>
                    </div>

                    <!-- Footer -->
                    <div class="course-footer">
                        <?php if (in_array($course['id'], $enrolledCourseIds)): ?>
                            <button class="btn disabled">✔ Already Enrolled</button>
                        <?php else: ?>
                            <a href="<?= base_url('student/course/' . esc($course['id'])) ?>" class="btn primary">
                                Apply Now →
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <div class="alert warning">No courses available.</div>
    <?php endif; ?>
</div>

<style>
/* Grid Layout */
.courses-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr); /* Force 3 per row */
    gap: 25px;
    width: 1100px;
}

/* Card */
.course-card {
    background: #fff;
    border-radius: 12px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    overflow: hidden;
    display: flex;
    flex-direction: column;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}
.course-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 12px 24px rgba(0,0,0,0.15);
}

/* Header */
.course-header {
    padding: 15px 20px 0;
}
.course-header h3 {
    font-size: 1.2rem;
    color: #224abe;
    margin-bottom: 5px;
}
.course-header small {
    color: #777;
    font-style: italic;
}

/* Body */
.course-body {
    padding: 10px 20px;
    flex-grow: 1;
}
.course-body ul {
    list-style: none;
    padding: 0;
    margin: 0;
}
.course-body li {
    margin-bottom: 8px;
    font-size: 0.95rem;
    color: #555;
}

/* Badge */
.badge {
    padding: 3px 10px;
    border-radius: 12px;
    font-size: 0.85rem;
    font-weight: bold;
}
.badge.active { background: #d4edda; color: #155724; }
.badge.inactive { background: #f8d7da; color: #721c24; }

/* Footer */
.course-footer {
    padding: 15px 20px 20px;
    text-align: center;
}
.btn {
    display: inline-block;
    padding: 10px 22px;
    border-radius: 30px;
    font-size: 0.95rem;
    text-decoration: none;
    transition: 0.3s ease;
    font-weight: bold;
}
.btn.primary {
    background: linear-gradient(135deg, #4e73df, #224abe);
    color: #fff;
}
.btn.primary:hover {
    background: linear-gradient(135deg, #224abe, #4e73df);
    transform: scale(1.05);
}
.btn.disabled {
    background: #ddd;
    color: #777;
    cursor: not-allowed;
}
</style>

<?= $this->endSection() ?>
