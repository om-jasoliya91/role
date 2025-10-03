<div class="sidebar d-flex flex-column p-3">

    <h4 class="text-center py-3 border-bottom border-secondary">Admin</h4>

    <a href="<?= base_url('admin/dashboard') ?>" class="text-white px-3 py-2 d-block text-decoration-none">Dashboard</a>

    <!-- Students Menu -->
    <button class="btn btn-toggle align-items-center rounded collapsed text-white px-3 py-2" 
            data-bs-toggle="collapse" data-bs-target="#students-collapse" aria-expanded="false" aria-controls="students-collapse">
        Students
    </button>
    <div class="collapse ps-4" id="students-collapse">
        <a href="<?= base_url('admin/stdAdd') ?>" class="text-white d-block py-1 text-decoration-none">Add Student</a>
        <a href="<?= base_url('admin/stdView') ?>" class="text-white d-block py-1 text-decoration-none">View Students</a>
    </div>

    <!-- Courses Menu -->
    <button class="btn btn-toggle align-items-center rounded collapsed text-white px-3 py-2 mt-3" 
            data-bs-toggle="collapse" data-bs-target="#courses-collapse" aria-expanded="false" aria-controls="courses-collapse">
        Courses
    </button>
    <div class="collapse ps-4" id="courses-collapse">
        <a href="<?= base_url('admin/courseAdd') ?>" class="text-white d-block py-1 text-decoration-none">Add Course</a>
        <a href="<?= base_url('admin/courseView') ?>" class="text-white d-block py-1 text-decoration-none">View Courses</a>
    </div>

    <!-- Enrollment Menu -->
    <button class="btn btn-toggle align-items-center rounded collapsed text-white px-3 py-2 mt-3" 
            data-bs-toggle="collapse" data-bs-target="#enrollment-collapse" aria-expanded="false" aria-controls="enrollment-collapse">
        Enrollment
    </button>
    <div class="collapse ps-4" id="enrollment-collapse">
        <a href="<?= base_url('admin/enrollView') ?>" class="text-white d-block py-1 text-decoration-none">View Enrollment</a>
    </div>

    <div class="mt-auto">
        <a href="<?= base_url('logout') ?>" class="text-white px-3 py-2 d-block text-decoration-none border-top border-secondary">Logout</a>
    </div>
</div>

<style>
    .btn-toggle {
        background: none;
        border: none;
        width: 100%;
        text-align: left;
        font-weight: 600;
        cursor: pointer;
        color: #fff;
    }
    .btn-toggle:focus {
        outline: none;
        box-shadow: none;
    }
</style>
