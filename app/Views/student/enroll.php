<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="enrollments-container">
    <h2 class="page-title">Your Enrollments</h2>

    <?php if (!empty($enrollments)): ?>
        <div class="export-section">
            <a href="<?= site_url('student/export') ?>" class="btn-export">
                ⬇ Export to CSV
            </a>
        </div>

        <div class="table-wrapper">
            <table class="enrollments-table">
                <thead>
                    <tr>
                        <th>Course Name</th>
                        <th>Course Code</th>
                        <th>Duration</th>
                        <th>Price</th>
                        <th>Enrollment Date</th>
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
        <div class="alert-warning">
            ⚠ You have not enrolled in any courses yet.
        </div>
    <?php endif; ?>
</div>

<style>
/* Container */
.enrollments-container {
    max-width: 1100px;
    margin: 50px auto;
    padding: 0 20px;
}

/* Page Title */
.page-title {
    text-align: center;
    font-size: 2rem;
    font-weight: bold;
    color: #224abe;
    margin-bottom: 40px;
}

/* Export button */
.export-section {
    display: flex;
    justify-content: flex-end;
    margin-bottom: 20px;
}
.btn-export {
    background: linear-gradient(135deg, #28a745, #218838);
    color: #fff;
    padding: 10px 20px;
    border-radius: 25px;
    text-decoration: none;
    font-weight: 600;
    transition: 0.3s ease;
}
.btn-export:hover {
    background: linear-gradient(135deg, #218838, #28a745);
}

/* Table Wrapper */
.table-wrapper {
    border-radius: 10px;
    overflow: hidden;
    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
}

/* Table */
.enrollments-table {
    width: 100%;
    border-collapse: collapse;
    font-size: 0.95rem;
}
.enrollments-table thead {
    background: #224abe;
    color: #fff;
}
.enrollments-table th,
.enrollments-table td {
    padding: 12px 15px;
    text-align: left;
    border-bottom: 1px solid #ddd;
}
.enrollments-table tbody tr:nth-child(even) {
    background: #f9f9f9;
}
.enrollments-table tbody tr:hover {
    background: #eef2ff;
}

/* Empty Alert */
.alert-warning {
    text-align: center;
    background: #fff3cd;
    color: #856404;
    padding: 15px;
    border-radius: 8px;
    font-size: 1rem;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
}
</style>

<?= $this->endSection() ?>
