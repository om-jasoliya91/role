<?= $this->extend('layouts/admin') ?>

<?= $this->section('content') ?>

<!-- Your existing form HTML goes here -->

<h3><?= esc($title) ?></h3>

<form method="post" action="<?= esc($action) ?>" enctype="multipart/form-data">
    <?= csrf_field() ?>

    <!-- form fields -->
    <div class="mb-3">
        <label>Username</label>
        <input type="text" name="username" value="<?= old('username') ?>" class="form-control" required>
    </div>

    <!-- Add other fields similarly -->

    <button type="submit" class="btn btn-primary"><?= esc($buttonText) ?></button>
</form>

<?= $this->endSection() ?>
