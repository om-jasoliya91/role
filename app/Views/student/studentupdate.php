<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="container mt-5 d-flex justify-content-center align-items-center min-vh-100">
    <div class="col-md-6">
        <div class="card shadow p-4 rounded-4">
            <h3 class="card-title text-center mb-4">Profile Update</h3>

            <?php if (session()->getFlashdata('errors')): ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <ul class="mb-0 ps-3">
                        <?php foreach(session()->getFlashdata('errors') as $error): ?>
                            <li><?= esc($error) ?></li>
                        <?php endforeach; ?>
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>

            <?php if (session()->getFlashdata('success')): ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <?= session()->getFlashdata('success') ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>

            <form method="post" action="<?= base_url('student/studentupdate') ?>" enctype="multipart/form-data" novalidate>
                <?= csrf_field() ?>

                <div class="mb-3">
                    <label for="full_name" class="form-label">Full Name</label>
                    <input id="full_name" type="text" name="full_name" class="form-control" value="<?= old('full_name', $full_name ?? '') ?>" required>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input id="email" type="email" name="email" class="form-control" value="<?= old('email', $email ?? '') ?>" required>
                </div>

                <div class="mb-3">
                    <label for="phone" class="form-label">Phone</label>
                    <input id="phone" type="text" name="phone" class="form-control" value="<?= old('phone', $phone ?? '') ?>" required>
                </div>

                <div class="mb-3">
                    <label for="age" class="form-label">Age</label>
                    <input id="age" type="number" name="age" class="form-control" min="1" max="150" value="<?= old('age', $age ?? '') ?>" required>
                </div>

                <div class="mb-3">
                    <label for="gender" class="form-label">Gender</label>
                    <select id="gender" name="gender" class="form-select" required>
                        <option value="" disabled <?= old('gender', $gender ?? '') === '' ? 'selected' : '' ?>>Select gender</option>
                        <option value="male" <?= old('gender', $gender ?? '') === 'male' ? 'selected' : '' ?>>Male</option>
                        <option value="female" <?= old('gender', $gender ?? '') === 'female' ? 'selected' : '' ?>>Female</option>
                        <option value="other" <?= old('gender', $gender ?? '') === 'other' ? 'selected' : '' ?>>Other</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="address" class="form-label">Address</label>
                    <textarea id="address" name="address" class="form-control" rows="3" required><?= old('address', $address ?? '') ?></textarea>
                </div>

                <div class="mb-3">
                    <label for="profile_pic" class="form-label">Profile Picture <small class="text-muted">(optional)</small></label>
                    <input id="profile_pic" type="file" name="profile_pic" class="form-control" accept="image/*">
                </div>

                <div class="d-grid">
                    <button type="submit" class="btn btn-primary fw-semibold">Update Profile</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
