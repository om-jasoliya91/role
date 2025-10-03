<?= $this->extend('layouts/admin') ?>
<?= $this->section('content') ?>

<div class="container my-5">
    <h2 class="mb-4 text-center">Enrollments Grouped by User</h2>

    <?php if (!empty($groupedEnrollments)): ?>
        <table class="table table-striped table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>User ID</th>
                    <th>User Name</th>
                    <th>Courses</th>
                    <th>Durations</th>
                    <th>Prices</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($groupedEnrollments as $userId => $data): ?>
                    <tr>
                        <td><?= esc($userId) ?></td>
                        <td><?= esc($data['user']['name']) ?></td>
                        <td><?= esc(implode(', ', array_column($data['courses'], 'course_name'))) ?></td>
                        <td><?= esc(implode(', ', array_column($data['courses'], 'duration'))) ?></td>
                        <td>
                            <?= implode(', ', array_map(fn($price) => '$' . number_format($price, 2), array_column($data['courses'], 'price'))) ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <div class="alert alert-warning text-center">No enrollments found.</div>
    <?php endif; ?>
</div>

<?= $this->endSection() ?>
