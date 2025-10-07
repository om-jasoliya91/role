<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title><?= esc($title ?? 'Register') ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: #f4f6f9;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        .register-card {
            max-width: 600px;
            width: 100%;
        }
    </style>
</head>

<body>

    <div class="register-card card shadow-sm">
        <div class="card-header bg-primary text-white text-center">
            <h3 class="mb-0"><?= esc($title ?? 'Register') ?></h3>
        </div>

        <div class="card-body">

            <!-- Flash messages -->
            <?php if (session()->getFlashdata('success')): ?>
                <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
            <?php endif; ?>

            <?php if (session()->getFlashdata('errors')): ?>
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        <?php foreach (session()->getFlashdata('errors') as $error): ?>
                            <li><?= esc($error) ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>

            <form action="<?= esc($action) ?>" method="post" enctype="multipart/form-data" novalidate>
                <?= csrf_field() ?>

                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input id="username" type="text" name="username" value="<?= old('username') ?>" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input id="email" type="email" name="email" value="<?= old('email') ?>" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input id="password" type="password" name="password" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="full_name" class="form-label">Full Name</label>
                    <input id="full_name" type="text" name="full_name" value="<?= old('full_name') ?>" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="phone" class="form-label">Phone</label>
                    <input id="phone" type="text" name="phone" value="<?= old('phone') ?>" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="age" class="form-label">Age</label>
                    <input id="age" type="number" name="age" value="<?= old('age') ?>" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="gender" class="form-label">Gender</label>
                    <select id="gender" name="gender" class="form-select" required>
                        <option value="" <?= old('gender') === '' ? 'selected' : '' ?>>Select Gender</option>
                        <option value="Male" <?= old('gender') === 'Male' ? 'selected' : '' ?>>Male</option>
                        <option value="Female" <?= old('gender') === 'Female' ? 'selected' : '' ?>>Female</option>
                        <option value="Other" <?= old('gender') === 'Other' ? 'selected' : '' ?>>Other</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="address" class="form-label">Address</label>
                    <textarea id="address" name="address" class="form-control" required><?= old('address') ?></textarea>
                </div>

                <div class="mb-3">
                    <label for="profile_pic" class="form-label">Profile Picture</label>
                    <input id="profile_pic" type="file" name="profile_pic" class="form-control" required>
                </div>

                <button type="submit" class="btn btn-primary w-100"><?= esc($buttonText ?? 'Register') ?></button>
            </form>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
