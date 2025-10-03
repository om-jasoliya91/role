<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title><?= esc($title) ?></title>
    <style>
        /* Reset + Base */
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: Arial, sans-serif;
            background: #f4f7fa;
            color: #333;
            display: flex;
            justify-content: center;
            align-items: flex-start;
            min-height: 100vh;
            padding: 30px;
        }

        .form-container {
            background: #fff;
            padding: 25px 30px;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            width: 100%;
            max-width: 700px;
        }

        h3 {
            text-align: center;
            margin-bottom: 20px;
            color: #222;
        }

        form {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
        }

        label {
            font-weight: bold;
            font-size: 14px;
            margin-bottom: 5px;
            display: block;
        }

        input, select, textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 6px;
            font-size: 14px;
        }

        input:focus, select:focus, textarea:focus {
            border-color: #007bff;
            outline: none;
        }

        .full-width {
            grid-column: 1 / -1;
        }

        button {
            background: #007bff;
            color: #fff;
            border: none;
            padding: 12px;
            border-radius: 6px;
            cursor: pointer;
            font-size: 16px;
            font-weight: bold;
            transition: background 0.3s ease;
            width: 100%;
        }

        button:hover {
            background: #0056b3;
        }

        .alert {
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 6px;
            font-size: 14px;
        }
        .alert-success { background: #d4edda; color: #155724; }
        .alert-danger { background: #f8d7da; color: #721c24; }

        .error {
            color: red;
            font-size: 13px;
            margin-top: 5px;
        }

        .link {
            text-align: center;
            margin-top: 15px;
            font-size: 14px;
        }

        .link a {
            color: #007bff;
            text-decoration: none;
        }

        .link a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h3><?= esc($title) ?></h3>

        <!-- Success Flash Message -->
        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
        <?php endif; ?>

        <?php $errors = session()->getFlashdata('errors'); ?>

        <!-- Form -->
        <form method="post" action="<?= esc($action) ?>" enctype="multipart/form-data" novalidate>
            <?= csrf_field() ?>

            <!-- Username -->
            <div>
                <label>Username</label>
                <input type="text" name="username" value="<?= old('username') ?>" required>
                <?php if (isset($errors['username'])): ?>
                    <div class="error"><?= esc($errors['username']) ?></div>
                <?php endif; ?>
            </div>

            <!-- Email -->
            <div>
                <label>Email</label>
                <input type="email" name="email" value="<?= old('email') ?>" required>
                <?php if (isset($errors['email'])): ?>
                    <div class="error"><?= esc($errors['email']) ?></div>
                <?php endif; ?>
            </div>

            <!-- Password -->
            <div>
                <label>Password</label>
                <input type="password" name="password" required>
                <?php if (isset($errors['password'])): ?>
                    <div class="error"><?= esc($errors['password']) ?></div>
                <?php endif; ?>
            </div>

            <!-- Full Name -->
            <div>
                <label>Full Name</label>
                <input type="text" name="full_name" value="<?= old('full_name') ?>" required>
                <?php if (isset($errors['full_name'])): ?>
                    <div class="error"><?= esc($errors['full_name']) ?></div>
                <?php endif; ?>
            </div>

            <!-- Phone -->
            <div>
                <label>Phone</label>
                <input type="text" name="phone" value="<?= old('phone') ?>" required>
                <?php if (isset($errors['phone'])): ?>
                    <div class="error"><?= esc($errors['phone']) ?></div>
                <?php endif; ?>
            </div>

            <!-- Age -->
            <div>
                <label>Age</label>
                <input type="number" name="age" value="<?= old('age') ?>" required>
                <?php if (isset($errors['age'])): ?>
                    <div class="error"><?= esc($errors['age']) ?></div>
                <?php endif; ?>
            </div>

            <!-- Gender -->
            <div>
                <label>Gender</label>
                <select name="gender" required>
                    <option value="">-- Select --</option>
                    <option value="Male" <?= old('gender') == 'Male' ? 'selected' : '' ?>>Male</option>
                    <option value="Female" <?= old('gender') == 'Female' ? 'selected' : '' ?>>Female</option>
                    <option value="Other" <?= old('gender') == 'Other' ? 'selected' : '' ?>>Other</option>
                </select>
                <?php if (isset($errors['gender'])): ?>
                    <div class="error"><?= esc($errors['gender']) ?></div>
                <?php endif; ?>
            </div>

            <!-- Address -->
            <div class="full-width">
                <label>Address</label>
                <textarea name="address" rows="3" required><?= old('address') ?></textarea>
                <?php if (isset($errors['address'])): ?>
                    <div class="error"><?= esc($errors['address']) ?></div>
                <?php endif; ?>
            </div>

            <!-- Profile Picture -->
            <div class="full-width">
                <label>Profile Picture</label>
                <input type="file" name="profile_pic" required>
                <?php if (isset($errors['profile_pic'])): ?>
                    <div class="error"><?= esc($errors['profile_pic']) ?></div>
                <?php endif; ?>
            </div>

            <div class="full-width">
                <button type="submit"><?= esc($buttonText) ?></button>
            </div>
        </form>

        <div class="link">
            <p>Already have an account? <a href="<?= base_url('login') ?>">Login here</a></p>
        </div>
    </div>
</body>
</html>
