<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title><?= esc($title) ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body>
    <div class="container mt-5">

        <h3><?= esc($title) ?></h3>

        <!-- Success / Error Flash Messages -->
        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
        <?php endif; ?>

        <?php if (isset($errors) && is_array($errors)): ?>
            <div class="alert alert-danger">
                <ul class="mb-0">
                    <?php foreach ($errors as $error): ?>
                        <li><?= esc($error) ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <!-- Form -->
        <form method="post" action="<?= esc($action) ?>" enctype="multipart/form-data" novalidate>
            <?= csrf_field() ?>

            <div class="row g-3">
                <div class="col-md-6">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" name="username" value="<?= old('username') ?>" class="form-control" required>
                </div>

                <div class="col-md-6">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" value="<?= old('email') ?>" class="form-control" required>
                </div>

                <div class="col-md-6">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" required>
                </div>

                <div class="col-md-6">
                    <label for="full_name" class="form-label">Full Name</label>
                    <input type="text" name="full_name" value="<?= old('full_name') ?>" class="form-control" required>
                </div>

                <div class="col-md-4">
                    <label for="phone" class="form-label">Phone</label>
                    <input type="text" name="phone" value="<?= old('phone') ?>" class="form-control" required>
                </div>

                <div class="col-md-4">
                    <label for="age" class="form-label">Age</label>
                    <input type="number" name="age" value="<?= old('age') ?>" class="form-control" required>
                </div>

                <div class="col-md-4">
                    <label for="gender" class="form-label">Gender</label>
                    <select name="gender" class="form-select" required>
                        <option value="">-- Select --</option>
                        <option value="Male" <?= old('gender') == 'Male' ? 'selected' : '' ?>>Male</option>
                        <option value="Female" <?= old('gender') == 'Female' ? 'selected' : '' ?>>Female</option>
                        <option value="Other" <?= old('gender') == 'Other' ? 'selected' : '' ?>>Other</option>
                    </select>
                </div>

                <div class="col-12">
                    <label for="address" class="form-label">Address</label>
                    <textarea name="address" class="form-control" rows="3" required><?= old('address') ?></textarea>
                </div>

                <div class="col-12">
                    <label for="profile_pic" class="form-label">Profile Picture</label>
                    <input type="file" name="profile_pic" class="form-control" required>
                </div>
            </div>

            <div class="mt-4">
                <button type="submit" class="btn btn-primary"><?= esc($buttonText) ?></button>
            </div>
        </form>

        <div class="mt-3">
            <p>Already have an account? <a href="<?= base_url('login') ?>">Login here</a></p>
        </div>
    </div>
</body>
</html>
