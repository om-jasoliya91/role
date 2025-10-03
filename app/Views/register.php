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

        <!-- Success Flash Message -->
        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
        <?php endif; ?>

        <!-- Error Messages -->
        <?php $errors = session()->getFlashdata('errors'); ?>

        <!-- Form -->
        <form method="post" action="<?= esc($action) ?>" enctype="multipart/form-data" novalidate>
            <?= csrf_field() ?>

            <div class="row g-3">
                <!-- Username -->
                <div class="col-md-6">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" 
                           name="username" 
                           value="<?= old('username') ?>" 
                           class="form-control <?= isset($errors['username']) ? 'is-invalid' : '' ?>" 
                           required>
                    <?php if (isset($errors['username'])): ?>
                        <div class="invalid-feedback"><?= esc($errors['username']) ?></div>
                    <?php endif; ?>
                </div>

                <!-- Email -->
                <div class="col-md-6">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" 
                           name="email" 
                           value="<?= old('email') ?>" 
                           class="form-control <?= isset($errors['email']) ? 'is-invalid' : '' ?>" 
                           required>
                    <?php if (isset($errors['email'])): ?>
                        <div class="invalid-feedback"><?= esc($errors['email']) ?></div>
                    <?php endif; ?>
                </div>

                <!-- Password -->
                <div class="col-md-6">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" 
                           name="password" 
                           class="form-control <?= isset($errors['password']) ? 'is-invalid' : '' ?>" 
                           required>
                    <?php if (isset($errors['password'])): ?>
                        <div class="invalid-feedback"><?= esc($errors['password']) ?></div>
                    <?php endif; ?>
                </div>

                <!-- Full Name -->
                <div class="col-md-6">
                    <label for="full_name" class="form-label">Full Name</label>
                    <input type="text" 
                           name="full_name" 
                           value="<?= old('full_name') ?>" 
                           class="form-control <?= isset($errors['full_name']) ? 'is-invalid' : '' ?>" 
                           required>
                    <?php if (isset($errors['full_name'])): ?>
                        <div class="invalid-feedback"><?= esc($errors['full_name']) ?></div>
                    <?php endif; ?>
                </div>

                <!-- Phone -->
                <div class="col-md-4">
                    <label for="phone" class="form-label">Phone</label>
                    <input type="text" 
                           name="phone" 
                           value="<?= old('phone') ?>" 
                           class="form-control <?= isset($errors['phone']) ? 'is-invalid' : '' ?>" 
                           required>
                    <?php if (isset($errors['phone'])): ?>
                        <div class="invalid-feedback"><?= esc($errors['phone']) ?></div>
                    <?php endif; ?>
                </div>

                <!-- Age -->
                <div class="col-md-4">
                    <label for="age" class="form-label">Age</label>
                    <input type="number" 
                           name="age" 
                           value="<?= old('age') ?>" 
                           class="form-control <?= isset($errors['age']) ? 'is-invalid' : '' ?>" 
                           required>
                    <?php if (isset($errors['age'])): ?>
                        <div class="invalid-feedback"><?= esc($errors['age']) ?></div>
                    <?php endif; ?>
                </div>

                <!-- Gender -->
                <div class="col-md-4">
                    <label for="gender" class="form-label">Gender</label>
                    <select name="gender" 
                            class="form-select <?= isset($errors['gender']) ? 'is-invalid' : '' ?>" 
                            required>
                        <option value="">-- Select --</option>
                        <option value="Male"   <?= old('gender') == 'Male' ? 'selected' : '' ?>>Male</option>
                        <option value="Female" <?= old('gender') == 'Female' ? 'selected' : '' ?>>Female</option>
                        <option value="Other"  <?= old('gender') == 'Other' ? 'selected' : '' ?>>Other</option>
                    </select>
                    <?php if (isset($errors['gender'])): ?>
                        <div class="invalid-feedback"><?= esc($errors['gender']) ?></div>
                    <?php endif; ?>
                </div>

                <!-- Address -->
                <div class="col-12">
                    <label for="address" class="form-label">Address</label>
                    <textarea name="address" 
                              class="form-control <?= isset($errors['address']) ? 'is-invalid' : '' ?>" 
                              rows="3" required><?= old('address') ?></textarea>
                    <?php if (isset($errors['address'])): ?>
                        <div class="invalid-feedback"><?= esc($errors['address']) ?></div>
                    <?php endif; ?>
                </div>

                <!-- Profile Picture -->
                <div class="col-12">
                    <label for="profile_pic" class="form-label">Profile Picture</label>
                    <input type="file" 
                           name="profile_pic" 
                           class="form-control <?= isset($errors['profile_pic']) ? 'is-invalid' : '' ?>" 
                           required>
                    <?php if (isset($errors['profile_pic'])): ?>
                        <div class="invalid-feedback"><?= esc($errors['profile_pic']) ?></div>
                    <?php endif; ?>
                </div>
            </div>

            <div class="mt-4">
                <button type="submit" class="btn btn-primary"><?= esc($buttonText) ?></button>
            </div>
        </form>

        <div class="mt-3">
            <p>Already have account? <a href="<?= base_url('login') ?>">Login here</a></p>
        </div>
    </div>
</body>
</html>
