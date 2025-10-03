<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

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

<style>
    /* Reset */
    * { margin: 0; padding: 0; box-sizing: border-box; }
    body { font-family: 'Segoe UI', Arial, sans-serif; color: #333; line-height: 1.6; }

    /* Hero */
    .hero {
        position: relative;
     
        color: #fff;
        text-align: center;
        padding: 120px 20px;
        width: 1100px;
    }
    .hero-overlay {
        position: absolute;
        top:0; left:0; right:0; bottom:0;
        background: rgba(34, 74, 190, 0.8);
    }
    .hero-content {
        position: relative;
        max-width: 700px;
        margin: auto;
        z-index: 2;
    }
    .hero h1 {
        font-size: 3rem;
        font-weight: 700;
        margin-bottom: 20px;
        line-height: 1.2;
    }
    .hero p {
        font-size: 1.2rem;
        margin-bottom: 30px;
    }

    /* Features */
    .features {
        padding: 70px 20px;
        background: #f9f9f9;
    }
    .features-grid {
        max-width: 1100px;
        margin: auto;
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 25px;
    }
    .feature-card {
        background: #fff;
        border-radius: 12px;
        padding: 30px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        text-align: center;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .feature-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 10px 25px rgba(0,0,0,0.15);
    }
    .feature-card .icon {
        font-size: 2.5rem;
        margin-bottom: 15px;
    }
    .feature-card h3 {
        margin-bottom: 12px;
        font-size: 1.3rem;
        color: #224abe;
    }
    .feature-card p {
        color: #555;
        font-size: 1rem;
    }

    /* Call to Action */
    .cta {
        background: linear-gradient(135deg, #224abe, #4e73df);
        color: #fff;
        padding: 80px 20px;
        text-align: center;
        width: 1100px;
    }
    .cta-box {
        max-width: 650px;
        margin: auto;
    }
    .cta h2 {
        font-size: 2.4rem;
        margin-bottom: 15px;
        font-weight: bold;
    }
    .cta p {
        font-size: 1.1rem;
        margin-bottom: 30px;
        color: #e0e0e0;
    }

    /* Buttons */
    .btn-main {
        display: inline-block;
        padding: 14px 32px;
        border-radius: 35px;
        background: #ffd700;
        color: #224abe;
        text-decoration: none;
        font-weight: bold;
        font-size: 1rem;
        transition: all 0.3s ease;
    }
    .btn-main:hover {
        background: #ffb700;
        transform: scale(1.08);
    }
    .btn-main.big {
        font-size: 1.2rem;
        padding: 16px 38px;
    }
</style>

<?= $this->endSection() ?>
