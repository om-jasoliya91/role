<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<link rel="stylesheet" href="/css/style.css">
<!-- Hero Section -->
<section class="hero">
    <div class="hero-overlay"></div>
    <div class="hero-content">
        <h1>🚀 Welcome to Student Portal</h1>
        <p>Unlock your future with high-quality courses, expert guidance, and flexible learning.</p>
        <a href="<?= base_url('student/course') ?>" class="btn-main">
            Browse Courses →
        </a>
    </div>
</section>

<!-- Features Section -->
<section class="features">
    <div class="features-grid">
        <div class="feature-card">
            <div class="icon">📘</div>
            <h3>Wide Range of Courses</h3>
            <p>Choose from various courses tailored to your interests and career goals.</p>
        </div>
        <div class="feature-card">
            <div class="icon">👩‍🏫</div>
            <h3>Expert Instructors</h3>
            <p>Learn from experienced professionals and industry experts.</p>
        </div>
        <div class="feature-card">
            <div class="icon">⏰</div>
            <h3>Flexible Learning</h3>
            <p>Access courses anytime, anywhere, at your own pace.</p>
        </div>
    </div>
</section>

<!-- Call to Action -->
<section class="cta">
    <div class="cta-box">
        <h2>🎯 Ready to start learning?</h2>
        <p>Join thousands of students already building their future with us.</p>
        <a href="<?= base_url('register') ?>" class="btn-main big">
            Register Now +
        </a>
    </div>
</section>


  
<?= $this->endSection() ?>
