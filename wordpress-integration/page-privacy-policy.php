<?php
/**
 * Template Name: Privacy Policy Page
 * Description: Privacy Policy page template
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
    <meta name="description" content="Read our privacy policy to understand how we collect, use, and protect your personal information.">
    <title>Privacy Policy | <?php bloginfo('name'); ?></title>
    
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
            max-width: 900px;
            margin: 4rem auto;
            padding: 0 2rem;
        }

        .last-updated {
            background: var(--light-secondary);
            padding: 1rem 1.5rem;
            border-radius: 8px;
            margin-bottom: 2rem;
            text-align: center;
            color: var(--text-muted);
        }

        .policy-content {
            background: white;
            padding: 3rem;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        }

        .policy-content h2 {
            color: var(--text-dark);
            margin-top: 2.5rem;
            margin-bottom: 1rem;
            padding-bottom: 0.5rem;
            border-bottom: 2px solid var(--light-secondary);
            font-size: 1.75rem;
        }

        .policy-content h2:first-child {
            margin-top: 0;
        }

        .policy-content h3 {
            color: var(--primary-color);
            margin-top: 1.5rem;
            margin-bottom: 0.75rem;
            font-size: 1.3rem;
        }

        .policy-content p {
            color: var(--text-muted);
            margin-bottom: 1rem;
            line-height: 1.8;
        }

        .policy-content ul, 
        .policy-content ol {
            margin-left: 2rem;
            margin-bottom: 1rem;
            color: var(--text-muted);
        }

        .policy-content li {
            margin-bottom: 0.5rem;
            line-height: 1.8;
        }

        .policy-content strong {
            color: var(--text-dark);
        }

        .policy-content a {
            color: var(--primary-color);
            text-decoration: none;
        }

        .policy-content a:hover {
            text-decoration: underline;
        }

        .highlight-box {
            background: #dbeafe;
            border-left: 4px solid var(--primary-color);
            padding: 1.5rem;
            margin: 1.5rem 0;
            border-radius: 0 8px 8px 0;
        }

        .highlight-box p {
            margin-bottom: 0;
        }

        .table-of-contents {
            background: var(--light-secondary);
            padding: 2rem;
            border-radius: 12px;
            margin-bottom: 2rem;
        }

        .table-of-contents h3 {
            color: var(--text-dark);
            margin-bottom: 1rem;
        }

        .table-of-contents ul {
            list-style: none;
            margin: 0;
        }

        .table-of-contents li {
            margin-bottom: 0.5rem;
        }

        .table-of-contents a {
            color: var(--primary-color);
            text-decoration: none;
            transition: color 0.3s;
        }

        .table-of-contents a:hover {
            color: #1d4ed8;
            text-decoration: underline;
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

            .policy-content {
                padding: 2rem 1.5rem;
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
    <h1>Privacy Policy</h1>
    <p>Your privacy is important to us. Learn how we collect, use, and protect your information.</p>
</section>

<!-- Content Section -->
<section class="content-section">
    
    <div class="last-updated">
        <strong>Last Updated:</strong> <?php echo date('F j, Y'); ?>
    </div>

    <div class="table-of-contents">
        <h3>📋 Table of Contents</h3>
        <ul>
            <li><a href="#introduction">1. Introduction</a></li>
            <li><a href="#information-we-collect">2. Information We Collect</a></li>
            <li><a href="#how-we-use">3. How We Use Your Information</a></li>
            <li><a href="#cookies">4. Cookies and Tracking</a></li>
            <li><a href="#third-party">5. Third-Party Services</a></li>
            <li><a href="#affiliate">6. Affiliate Links</a></li>
            <li><a href="#data-security">7. Data Security</a></li>
            <li><a href="#your-rights">8. Your Rights</a></li>
            <li><a href="#children">9. Children's Privacy</a></li>
            <li><a href="#changes">10. Changes to This Policy</a></li>
            <li><a href="#contact">11. Contact Us</a></li>
        </ul>
    </div>

    <div class="policy-content">
        
        <h2 id="introduction">1. Introduction</h2>
        <p>
            Welcome to our Privacy Policy. This document explains how we collect, use, store, and protect your personal information when you visit our website and use our services. By using our website, you consent to the practices described in this policy.
        </p>
        <p>
            We are committed to protecting your privacy and ensuring you have a positive experience on our website. This policy is designed to be transparent about our data practices and your privacy rights.
        </p>

        <h2 id="information-we-collect">2. Information We Collect</h2>
        
        <h3>2.1 Information You Provide</h3>
        <p>We may collect personal information that you voluntarily provide to us, including:</p>
        <ul>
            <li><strong>Contact Information:</strong> Name, email address, phone number</li>
            <li><strong>Communication Data:</strong> Messages sent through contact forms, surveys, or customer support</li>
            <li><strong>Account Information:</strong> If you create an account, we collect username and password</li>
            <li><strong>Subscription Data:</strong> Email address for newsletter subscriptions</li>
        </ul>

        <h3>2.2 Automatically Collected Information</h3>
        <p>When you visit our website, we automatically collect certain information:</p>
        <ul>
            <li><strong>Device Information:</strong> IP address, browser type, operating system</li>
            <li><strong>Usage Data:</strong> Pages viewed, time spent on pages, click patterns</li>
            <li><strong>Referral Information:</strong> The website that referred you to our site</li>
            <li><strong>Location Data:</strong> General geographic location based on IP address</li>
        </ul>

        <h2 id="how-we-use">3. How We Use Your Information</h2>
        <p>We use the collected information for the following purposes:</p>
        <ul>
            <li><strong>Provide Services:</strong> To deliver the content and services you request</li>
            <li><strong>Communication:</strong> To respond to your inquiries and send important updates</li>
            <li><strong>Improve Website:</strong> To analyze usage patterns and improve our content</li>
            <li><strong>Marketing:</strong> To send newsletters and promotional materials (with your consent)</li>
            <li><strong>Security:</strong> To protect against fraud, abuse, and unauthorized access</li>
            <li><strong>Legal Compliance:</strong> To comply with legal obligations and enforce our terms</li>
        </ul>

        <div class="highlight-box">
            <p><strong>📌 Important:</strong> We will never sell your personal information to third parties for their marketing purposes.</p>
        </div>

        <h2 id="cookies">4. Cookies and Tracking Technologies</h2>
        <p>
            We use cookies and similar tracking technologies to enhance your browsing experience and collect analytics data.
        </p>

        <h3>4.1 Types of Cookies We Use</h3>
        <ul>
            <li><strong>Essential Cookies:</strong> Required for the website to function properly</li>
            <li><strong>Analytics Cookies:</strong> Help us understand how visitors use our website (e.g., Google Analytics)</li>
            <li><strong>Advertising Cookies:</strong> Used to deliver relevant advertisements and track campaign performance</li>
            <li><strong>Preference Cookies:</strong> Remember your settings and preferences</li>
        </ul>

        <h3>4.2 Managing Cookies</h3>
        <p>
            You can control cookies through your browser settings. Note that disabling certain cookies may affect website functionality. Most browsers allow you to:
        </p>
        <ul>
            <li>View and delete cookies</li>
            <li>Block third-party cookies</li>
            <li>Block all cookies</li>
            <li>Receive warnings before cookies are stored</li>
        </ul>

        <h2 id="third-party">5. Third-Party Services</h2>
        <p>We use various third-party services that may collect information:</p>
        <ul>
            <li><strong>Google Analytics:</strong> Website traffic analysis</li>
            <li><strong>Email Service Providers:</strong> Newsletter delivery and management</li>
            <li><strong>Content Delivery Networks (CDNs):</strong> Faster content delivery</li>
            <li><strong>Social Media Platforms:</strong> Social sharing features</li>
        </ul>
        <p>
            These third parties have their own privacy policies. We encourage you to review them.
        </p>

        <h2 id="affiliate">6. Affiliate Links and Advertising</h2>
        
        <h3>6.1 Affiliate Disclosure</h3>
        <p>
            Our website contains affiliate links to security software products. When you click these links and make a purchase, we may earn a commission at no additional cost to you. This helps support our website and allows us to continue providing free, comprehensive reviews.
        </p>

        <h3>6.2 Editorial Independence</h3>
        <p>
            Our reviews and recommendations are based on honest, hands-on testing and evaluation. Affiliate partnerships do not influence our editorial content or product ratings.
        </p>

        <h3>6.3 Advertising</h3>
        <p>
            We may display advertisements from third-party ad networks. These networks may use cookies to deliver personalized ads based on your interests.
        </p>

        <h2 id="data-security">7. Data Security</h2>
        <p>
            We implement appropriate technical and organizational measures to protect your personal information:
        </p>
        <ul>
            <li><strong>Encryption:</strong> SSL/TLS encryption for data transmission</li>
            <li><strong>Access Controls:</strong> Limited access to personal information</li>
            <li><strong>Regular Updates:</strong> Software and security patches kept current</li>
            <li><strong>Monitoring:</strong> Regular security audits and monitoring</li>
        </ul>
        <p>
            However, no method of transmission over the internet is 100% secure. We cannot guarantee absolute security.
        </p>

        <h2 id="your-rights">8. Your Privacy Rights</h2>
        <p>Depending on your location, you may have the following rights:</p>
        <ul>
            <li><strong>Access:</strong> Request a copy of your personal information</li>
            <li><strong>Correction:</strong> Request correction of inaccurate information</li>
            <li><strong>Deletion:</strong> Request deletion of your personal information</li>
            <li><strong>Portability:</strong> Receive your data in a portable format</li>
            <li><strong>Opt-Out:</strong> Unsubscribe from marketing communications</li>
            <li><strong>Objection:</strong> Object to certain data processing activities</li>
        </ul>
        <p>
            To exercise these rights, please contact us at <a href="mailto:<?php echo antispambot('privacy@example.com'); ?>"><?php echo antispambot('privacy@example.com'); ?></a>
        </p>

        <h3>8.1 GDPR Rights (EU Users)</h3>
        <p>
            If you are located in the European Union, you have additional rights under the General Data Protection Regulation (GDPR), including the right to lodge a complaint with a supervisory authority.
        </p>

        <h3>8.2 CCPA Rights (California Users)</h3>
        <p>
            California residents have specific rights under the California Consumer Privacy Act (CCPA), including the right to know what personal information is collected and the right to opt-out of the sale of personal information.
        </p>

        <h2 id="children">9. Children's Privacy</h2>
        <p>
            Our website is not directed to children under the age of 13. We do not knowingly collect personal information from children. If you are a parent or guardian and believe your child has provided us with personal information, please contact us immediately.
        </p>

        <h2 id="changes">10. Changes to This Privacy Policy</h2>
        <p>
            We may update this Privacy Policy from time to time to reflect changes in our practices or legal requirements. The "Last Updated" date at the top of this page indicates when the policy was last revised.
        </p>
        <p>
            We encourage you to review this policy periodically. Significant changes will be communicated through a notice on our website or via email.
        </p>

        <h2 id="contact">11. Contact Us</h2>
        <p>
            If you have questions, concerns, or requests regarding this Privacy Policy or our data practices, please contact us:
        </p>
        <ul>
            <li><strong>Email:</strong> <a href="mailto:<?php echo antispambot('privacy@example.com'); ?>"><?php echo antispambot('privacy@example.com'); ?></a></li>
            <li><strong>Contact Form:</strong> <a href="<?php echo esc_url(home_url('/contact')); ?>">Visit our Contact Page</a></li>
            <li><strong>Response Time:</strong> We aim to respond within 48 hours</li>
        </ul>

        <div class="highlight-box">
            <p><strong>🔒 Your Privacy Matters:</strong> We are committed to protecting your personal information and being transparent about our data practices. Thank you for trusting us with your information.</p>
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

