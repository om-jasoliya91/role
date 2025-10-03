<?= $this->extend('layouts/main') ?>

<?= $this->section('title') ?>
    Profile
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<?php if (session()->getFlashdata('success')): ?>
    <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
        <i class="bi bi-check-circle-fill me-2"></i>
        <?= session()->getFlashdata('success') ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<div class="card shadow rounded-4">
    <div class="card-header bg-primary text-white d-flex align-items-center">
        <i class="bi bi-person-circle fs-3 me-3"></i>
        <h4 class="mb-0">Profile Details</h4>
    </div>
    <div class="card-body">
        <div class="row g-4">
            <div class="col-md-4 text-center">
                <?php if (!empty($user['profile_pic']) && file_exists(FCPATH . 'uploads/' . $user['profile_pic'])): ?>
                    <img src="<?= base_url('uploads/' . $user['profile_pic']) ?>" 
                         alt="Profile Picture" 
                         class="img-fluid rounded-circle border border-3 border-primary shadow-sm" 
                         style="max-width: 220px;">
                <?php else: ?>
                    <div class="bg-secondary text-white rounded-circle d-flex align-items-center justify-content-center mx-auto shadow-sm" 
                         style="width: 220px; height: 220px; font-size: 6rem;">
                        <i class="bi bi-person"></i>
                    </div>
                    <p class="mt-3 text-muted fst-italic">No profile picture uploaded.</p>
                <?php endif; ?>
            </div>

            <div class="col-md-8">
                <table class="table table-borderless fs-5">
                    <tbody>
                        <tr>
                            <th scope="row" style="width: 160px;">
                                <i class="bi bi-person-fill text-primary me-2"></i> Full Name:
                            </th>
                            <td><?= esc($user['full_name']) ?></td>
                        </tr>
                        <tr>
                            <th scope="row">
                                <i class="bi bi-envelope-fill text-primary me-2"></i> Email:
                            </th>
                            <td><?= esc($user['email']) ?></td>
                        </tr>
                        <tr>
                            <th scope="row">
                                <i class="bi bi-telephone-fill text-primary me-2"></i> Phone:
                            </th>
                            <td><?= esc($user['phone']) ?></td>
                        </tr>
                        <tr>
                            <th scope="row">
                                <i class="bi bi-calendar-fill text-primary me-2"></i> Age:
                            </th>
                            <td><?= esc($user['age']) ?></td>
                        </tr>
                        <tr>
                            <th scope="row">
                                <i class="bi bi-gender-<?= strtolower($user['gender']) === 'male' ? 'male' : (strtolower($user['gender']) === 'female' ? 'female' : 'transgender') ?> text-primary me-2"></i> Gender:
                            </th>
                            <td><?= esc($user['gender']) ?></td>
                        </tr>
                        <tr>
                            <th scope="row">
                                <i class="bi bi-geo-alt-fill text-primary me-2"></i> Address:
                            </th>
                            <td><?= esc($user['address']) ?></td>
                        </tr>
                    </tbody>
                </table>

                <a href="<?= base_url('student/updateView') ?>" class="btn btn-primary mt-4 px-4 fw-semibold rounded-pill shadow-sm">
                    <i class="bi bi-pencil-square me-2"></i> Update Profile
                </a>
            </div>
        </div>
    </div>
</div>

<style>
    /* Increase icon size slightly in table headers */
    table th i {
        font-size: 1.3rem;
    }
</style>

<?= $this->endSection() ?>
