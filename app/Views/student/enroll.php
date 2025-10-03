<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="container my-5">
    <h2 class="mb-5 text-center fw-bold text-primary">Your Enrollments</h2>

    <?php if (!empty($enrollments)): ?>
        <div class="mb-4 d-flex justify-content-end">
            <a href="<?= site_url('student/export') ?>" class="btn btn-success rounded-pill shadow-sm">
                <i class="bi bi-file-earmark-spreadsheet-fill me-2"></i> Export to CSV
            </a>
        </div>

        <div class="table-responsive shadow-sm rounded-4 overflow-hidden">
            <table class="table table-striped table-bordered align-middle mb-0">
                <thead class="table-primary text-primary">
                    <tr>
                        <th scope="col">Course Name</th>
                        <th scope="col">Course Code</th>
                        <th scope="col">Duration</th>
                        <th scope="col">Price</th>
                        <th scope="col">Enrollment Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($enrollments as $enroll): ?>
                        <tr>
                            <td><?= esc($enroll['course_name']) ?></td>
                            <td><?= esc($enroll['course_code']) ?></td>
                            <td><?= esc($enroll['duration']) ?></td>
                            <td>$<?= number_format($enroll['price'], 2) ?></td>
                            <td><?= date('d M Y', strtotime($enroll['e_date'])) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php else: ?>
        <div class="alert alert-warning text-center shadow-sm" role="alert">
            <i class="bi bi-exclamation-triangle-fill me-2"></i>
            You have not enrolled in any courses yet.
        </div>
    <?php endif; ?>
</div>

<?= $this->endSection() ?>
