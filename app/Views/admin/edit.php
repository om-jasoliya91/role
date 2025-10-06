<?= $this->extend('layouts/admin') ?>

<?= $this->section('content') ?>

<h3 class="mb-4">Edit Student</h3>

<div class="col-md-8 mx-auto">
    <div class="card shadow p-4">
        <?php if (session()->getFlashdata('errors')): ?>
            <div class="alert alert-danger">
                <ul class="mb-0">
                    <?php foreach (session()->getFlashdata('errors') as $error): ?>
                        <li><?= esc($error) ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <form method="post" action="<?= base_url('admin/edit/' . esc($student['id'])) ?>" enctype="multipart/form-data">
            <?= csrf_field() ?>

            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" id="username" name="username" class="form-control" value="<?= esc(old('username', $student['username'])) ?>" required>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" id="email" name="email" class="form-control" value="<?= esc(old('email', $student['email'])) ?>" required>
            </div>

            <div class="mb-3">
                <label for="full_name" class="form-label">Full Name</label>
                <input type="text" id="full_name" name="full_name" class="form-control" value="<?= esc(old('full_name', $student['full_name'])) ?>" required>
            </div>

            <div class="mb-3">
                <label for="phone" class="form-label">Phone</label>
                <input type="text" id="phone" name="phone" class="form-control" value="<?= esc(old('phone', $student['phone'])) ?>" required>
            </div>

            <div class="mb-3">
                <label for="age" class="form-label">Age</label>
                <input type="number" id="age" name="age" class="form-control" value="<?= esc(old('age', $student['age'])) ?>" required>
            </div>

            <div class="mb-3">
                <label for="gender" class="form-label">Gender</label>
                <select id="gender" name="gender" class="form-select" required>
                    <option value="" disabled <?= old('gender', $student['gender']) ? '' : 'selected' ?>>Select gender</option>
                    <option value="male" <?= old('gender', $student['gender']) === 'male' ? 'selected' : '' ?>>Male</option>
                    <option value="female" <?= old('gender', $student['gender']) === 'female' ? 'selected' : '' ?>>Female</option>
                    <option value="other" <?= old('gender', $student['gender']) === 'other' ? 'selected' : '' ?>>Other</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="address" class="form-label">Address</label>
                <textarea id="address" name="address" class="form-control" required><?= esc(old('address', $student['address'])) ?></textarea>
            </div>

            <div class="mb-3">
                <label class="form-label d-block">Current Profile Picture</label>
                <?php
                $defaultImg = base_url('images/default-profile.png');
                $profilePic = !empty($student['profile_pic']) && file_exists(FCPATH . 'uploads/' . $student['profile_pic'])
                    ? base_url('uploads/' . $student['profile_pic'])
                    : $defaultImg;
                ?>
                <img src="<?= esc($profilePic) ?>" alt="Profile Picture" style="width:100px; height:100px; object-fit:cover; border-radius:8px;">
            </div>

            <div class="mb-3">
                <label for="profile_pic" class="form-label">Change Profile Picture (optional)</label>
                <input type="file" id="profile_pic" name="profile_pic" class="form-control" accept="image/*">
                <small class="text-muted">Leave blank to keep current picture.</small>
            </div>
            

            <div class="d-grid">
                <button type="submit" class="btn btn-primary">Update Student</button>
            </div>

            <div class="mt-3">
                <a href="<?= base_url('admin/stdView') ?>">Back to Students List</a>
            </div>
        </form>
    </div>
</div>

<?= $this->endSection() ?>
