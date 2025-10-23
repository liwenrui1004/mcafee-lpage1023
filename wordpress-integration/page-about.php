<?php
/**
 * Template Name: About Us Page
 * Description: About Us page for the security review website
 */

if (!defined('ABSPATH')) {
    exit;
}
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Learn about our mission to help users find the best security solutions for their digital lives.">
    <title>About Us | <?php bloginfo('name'); ?></title>
    
    <?php wp_head(); ?>
    
    <style>
        :root {
            --primary-color: #2563eb;
            --secondary-color: #1a1f2e;
            --success-green: #10b981;
            --text-dark: #1e293b;
            --text-muted: #64748b;
            --light-bg: #f8fafc;
            --light-secondary: #f1f5f9;
            --font-system: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: var(--font-system);
            line-height: 1.6;
            color: var(--text-dark);
            background: var(--light-bg);
        }

        /* Header */
        .site-header {
            background: white;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            position: sticky;
            top: 0;
            z-index: 100;
            padding: 1rem 0;
        }

        .header-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .site-logo {
            font-size: 1.5rem;
            font-weight: bold;
            color: var(--primary-color);
            text-decoration: none;
        }

        .site-nav {
            display: flex;
            gap: 2rem;
        }

        .site-nav a {
            color: var(--text-dark);
            text-decoration: none;
            transition: color 0.3s;
        }

        .site-nav a:hover {
            color: var(--primary-color);
        }

        /* Hero Section */
        .hero-section {
            background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%);
            color: white;
            padding: 4rem 2rem;
            text-align: center;
        }

        .hero-section h1 {
            font-size: 3rem;
            margin-bottom: 1rem;
        }

        .hero-section p {
            font-size: 1.25rem;
            opacity: 0.9;
            max-width: 700px;
            margin: 0 auto;
        }

        /* Content Section */
        .content-section {
            max-width: 1200px;
            margin: 4rem auto;
            padding: 0 2rem;
        }

        .about-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
            margin-top: 3rem;
        }

        .about-card {
            background: white;
            padding: 2rem;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .about-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.12);
        }

        .about-card h3 {
            color: var(--primary-color);
            font-size: 1.5rem;
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .about-card p {
            color: var(--text-muted);
            line-height: 1.8;
        }

        .mission-section {
            background: var(--light-secondary);
            padding: 3rem 2rem;
            border-radius: 16px;
            margin: 3rem 0;
        }

        .mission-section h2 {
            color: var(--text-dark);
            font-size: 2rem;
            margin-bottom: 1.5rem;
            text-align: center;
        }

        .mission-section p {
            color: var(--text-muted);
            font-size: 1.1rem;
            line-height: 1.8;
            max-width: 800px;
            margin: 0 auto 1rem;
        }

        .values-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 2rem;
            margin-top: 2rem;
        }

        .value-item {
            text-align: center;
            padding: 1.5rem;
        }

        .value-icon {
            font-size: 3rem;
            margin-bottom: 1rem;
        }

        .value-item h4 {
            color: var(--text-dark);
            margin-bottom: 0.5rem;
        }

        .value-item p {
            color: var(--text-muted);
            font-size: 0.95rem;
        }

        /* Footer */
        .site-footer {
            background: var(--secondary-color);
            color: white;
            padding: 2rem;
            margin-top: 4rem;
            text-align: center;
        }

        .footer-links {
            display: flex;
            justify-content: center;
            gap: 2rem;
            margin-bottom: 1rem;
            flex-wrap: wrap;
        }

        .footer-links a {
            color: white;
            text-decoration: none;
            opacity: 0.8;
            transition: opacity 0.3s;
        }

        .footer-links a:hover {
            opacity: 1;
        }

        @media (max-width: 768px) {
            .hero-section h1 {
                font-size: 2rem;
            }

            .site-nav {
                flex-direction: column;
                gap: 1rem;
            }

            .header-container {
                flex-direction: column;
                gap: 1rem;
            }
        }
    </style>
</head>
<body>

<!-- Header -->
<header class="site-header">
    <div class="header-container">
        <a href="<?php echo esc_url(home_url('/')); ?>" class="site-logo">
            🛡️ Security Review
        </a>
        <nav class="site-nav">
            <a href="<?php echo esc_url(home_url('/')); ?>">Home</a>
            <a href="<?php echo esc_url(home_url('/about')); ?>">About Us</a>
            <a href="<?php echo esc_url(home_url('/contact')); ?>">Contact Us</a>
            <a href="<?php echo esc_url(home_url('/privacy-policy')); ?>">Privacy Policy</a>
        </nav>
    </div>
</header>

<!-- Hero Section -->
<section class="hero-section">
    <h1>About Us</h1>
    <p>Helping millions protect their digital lives with honest, comprehensive security software reviews</p>
</section>

<!-- Content Section -->
<section class="content-section">
    
    <!-- Mission -->
    <div class="mission-section">
        <h2>Our Mission</h2>
        <p>
            In today's digital age, cybersecurity threats are more prevalent than ever. Our mission is to empower individuals and businesses with the knowledge they need to make informed decisions about their digital security.
        </p>
        <p>
            We provide comprehensive, unbiased reviews of the leading security software products, helping you find the perfect protection for your unique needs. Through rigorous testing and analysis, we ensure you have access to accurate, up-to-date information about the tools that keep you safe online.
        </p>
    </div>

    <!-- What We Do -->
    <h2 style="text-align: center; margin: 3rem 0 2rem; color: var(--text-dark);">What We Do</h2>
    <div class="about-grid">
        <div class="about-card">
            <h3>🔍 In-Depth Reviews</h3>
            <p>
                We conduct thorough, hands-on testing of every security product we review. Our team of experts evaluates features, performance, ease of use, and value to give you complete, honest assessments.
            </p>
        </div>

        <div class="about-card">
            <h3>📊 Expert Comparisons</h3>
            <p>
                We compare leading security solutions side-by-side, highlighting strengths and weaknesses to help you understand which product best fits your specific security needs and budget.
            </p>
        </div>

        <div class="about-card">
            <h3>📚 Educational Content</h3>
            <p>
                Beyond reviews, we provide educational resources to help you understand cybersecurity threats and best practices for staying safe online in an ever-evolving digital landscape.
            </p>
        </div>

        <div class="about-card">
            <h3>🔄 Continuous Updates</h3>
            <p>
                Cybersecurity is constantly changing. We regularly update our reviews to reflect the latest features, pricing changes, and emerging threats to ensure you have current information.
            </p>
        </div>

        <div class="about-card">
            <h3>💯 Unbiased Approach</h3>
            <p>
                While we may earn commissions from affiliate links, our reviews remain objective and honest. We prioritize your security needs above all else and only recommend products we truly believe in.
            </p>
        </div>

        <div class="about-card">
            <h3>🤝 Community Support</h3>
            <p>
                We're here to help. Our team is available to answer questions, provide guidance, and assist you in finding the right security solution for your digital life.
            </p>
        </div>
    </div>

    <!-- Our Values -->
    <h2 style="text-align: center; margin: 3rem 0 2rem; color: var(--text-dark);">Our Core Values</h2>
    <div class="values-grid">
        <div class="value-item">
            <div class="value-icon">🎯</div>
            <h4>Transparency</h4>
            <p>We're open about our testing methods, affiliate relationships, and review criteria.</p>
        </div>

        <div class="value-item">
            <div class="value-icon">🏆</div>
            <h4>Excellence</h4>
            <p>We maintain the highest standards in our research, testing, and content quality.</p>
        </div>

        <div class="value-item">
            <div class="value-icon">🔒</div>
            <h4>Trust</h4>
            <p>Your security is our priority. We only recommend solutions we would use ourselves.</p>
        </div>

        <div class="value-item">
            <div class="value-icon">💡</div>
            <h4>Innovation</h4>
            <p>We stay ahead of emerging threats and evolving security technologies.</p>
        </div>
    </div>

</section>

<!-- Footer -->
<footer class="site-footer">
    <div class="footer-links">
        <a href="<?php echo esc_url(home_url('/')); ?>">Home</a>
        <a href="<?php echo esc_url(home_url('/about')); ?>">About</a>
        <a href="<?php echo esc_url(home_url('/contact')); ?>">Contact</a>
        <a href="<?php echo esc_url(home_url('/privacy-policy')); ?>">Privacy</a>
        <a href="<?php echo esc_url(home_url('/terms-of-service')); ?>">Terms</a>
    </div>
    <p>&copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?>. All rights reserved.</p>
</footer>

<?php wp_footer(); ?>
</body>
</html>

