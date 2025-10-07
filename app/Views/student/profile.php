<?= $this->extend('layouts/main') ?>

<?= $this->section('title') ?>
    Profile
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<?php if (session()->getFlashdata('success')): ?>
    <div class="alert success">
        <span class="icon">✔</span>
        <?= session()->getFlashdata('success') ?>
        <button class="close-btn" onclick="this.parentElement.style.display='none'">x</button>
    </div>
<?php endif; ?>

<div class="profile-card">
    <div class="profile-header">
        <span class="icon">👤</span>
        <h4>Profile Details</h4>
    </div>

    <div class="profile-body">
        <div class="profile-left">
            <?php if (!empty($user['profile_pic']) && file_exists(FCPATH . 'uploads/' . $user['profile_pic'])): ?>
                <img src="<?= base_url('uploads/' . $user['profile_pic']) ?>" 
                     alt="Profile Picture" 
                     class="profile-pic">
            <?php else: ?>
                <div class="profile-placeholder">👤</div>
                <p class="no-pic">No profile picture uploaded.</p>
            <?php endif; ?>
        </div>

        <div class="profile-right">
            <table class="profile-table">
                <tbody>
                    <tr>
                        <th>Full Name:</th>
                        <td><?= esc($user['full_name']) ?></td>
                    </tr>
                    <tr>
                        <th>Email:</th>
                        <td><?= esc($user['email']) ?></td>
                    </tr>
                    <tr>
                        <th>Phone:</th>
                        <td><?= esc($user['phone']) ?></td>
                    </tr>
                    <tr>
                        <th>Age:</th>
                        <td><?= esc($user['age']) ?></td>
                    </tr>
                    <tr>
                        <th>Gender:</th>
                        <td><?= esc($user['gender']) ?></td>
                    </tr>
                    <tr>
                        <th>Address:</th>
                        <td><?= esc($user['address']) ?></td>
                    </tr>
                </tbody>
            </table>

            <a href="<?= base_url('student/updateView') ?>" class="btn-primary">
                ✏ Update Profile
            </a>
        </div>
    </div>
</div>

<style>
/* Alerts */
.alert {
    padding: 12px 16px;
    border-radius: 6px;
    margin-bottom: 20px;
    position: relative;
    display: flex;
    align-items: center;
    font-size: 0.95rem;
}
.alert.success {
    background: #d4edda;
    color: #155724;
}
.alert .icon {
    margin-right: 8px;
    font-weight: bold;
}
.alert .close-btn {
    background: none;
    border: none;
    font-size: 18px;
    font-weight: bold;
    position: absolute;
    right: 12px;
    cursor: pointer;
    color: inherit;
}

/* Profile Card */
.profile-card {
    background: #fff;
    border-radius: 12px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    padding: 20px;
}

/* Header */
.profile-header {
    display: flex;
    align-items: center;
    background: #224abe;
    color: #fff;
    padding: 15px;
    border-radius: 10px 10px 0 0;
}
.profile-header .icon {
    font-size: 1.5rem;
    margin-right: 10px;
}

/* Body Layout */
.profile-body {
    display: flex;
    flex-wrap: wrap;
    gap: 30px;
    padding: 20px;
}

/* Left side */
.profile-left {
    flex: 1;
    min-width: 220px;
    text-align: center;
}
.profile-pic {
    width: 220px;
    height: 220px;
    border-radius: 50%;
    object-fit: cover;
    border: 3px solid #224abe;
    box-shadow: 0 4px 8px rgba(0,0,0,0.2);
}
.profile-placeholder {
    width: 220px;
    height: 220px;
    border-radius: 50%;
    background: #aaa;
    color: #fff;
    font-size: 6rem;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto;
}
.no-pic {
    margin-top: 10px;
    font-style: italic;
    color: #777;
}

/* Right side */
.profile-right {
    flex: 2;
    min-width: 280px;
}
.profile-table {
    width: 100%;
    border-collapse: collapse;
    margin-bottom: 20px;
}
.profile-table th {
    text-align: left;
    width: 150px;
    padding: 8px 10px;
    color: #224abe;
    font-weight: 600;
}
.profile-table td {
    padding: 8px 10px;
    color: #333;
}

/* Button */
.btn-primary {
    display: inline-block;
    padding: 10px 20px;
    background: linear-gradient(135deg, #4e73df, #224abe);
    color: #fff;
    border-radius: 25px;
    text-decoration: none;
    font-weight: bold;
    transition: 0.3s ease;
}
.btn-primary:hover {
    background: linear-gradient(135deg, #224abe, #4e73df);
}
</style>

<?= $this->endSection() ?>
