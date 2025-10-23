<?php
/**
 * Template Name: Contact Us Page
 * Description: Contact Us page with contact form
 */

if (!defined('ABSPATH')) {
    exit;
}

// Handle form submission
$form_submitted = false;
$form_error = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['contact_form_nonce'])) {
    if (wp_verify_nonce($_POST['contact_form_nonce'], 'contact_form_submit')) {
        $name = sanitize_text_field($_POST['name']);
        $email = sanitize_email($_POST['email']);
        $subject = sanitize_text_field($_POST['subject']);
        $message = sanitize_textarea_field($_POST['message']);
        
        // Email to site admin
        $to = get_option('admin_email');
        $email_subject = 'Contact Form: ' . $subject;
        $email_body = "Name: $name\n";
        $email_body .= "Email: $email\n\n";
        $email_body .= "Message:\n$message";
        $headers = array('Content-Type: text/plain; charset=UTF-8', "Reply-To: $email");
        
        if (wp_mail($to, $email_subject, $email_body, $headers)) {
            $form_submitted = true;
        } else {
            $form_error = true;
        }
    }
}
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Get in touch with us for questions, support, or feedback about security software reviews.">
    <title>Contact Us | <?php bloginfo('name'); ?></title>
    
    <?php wp_head(); ?>
    
    <style>
        :root {
            --primary-color: #2563eb;
            --secondary-color: #1a1f2e;
            --success-green: #10b981;
            --danger-red: #dc2626;
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

        .contact-container {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 3rem;
            margin-top: 3rem;
        }

        /* Contact Form */
        .contact-form-wrapper {
            background: white;
            padding: 2.5rem;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        }

        .contact-form-wrapper h2 {
            color: var(--text-dark);
            margin-bottom: 1.5rem;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            color: var(--text-dark);
            font-weight: 500;
        }

        .form-group input,
        .form-group textarea,
        .form-group select {
            width: 100%;
            padding: 0.75rem 1rem;
            border: 2px solid #e2e8f0;
            border-radius: 8px;
            font-family: var(--font-system);
            font-size: 1rem;
            transition: border-color 0.3s;
        }

        .form-group input:focus,
        .form-group textarea:focus,
        .form-group select:focus {
            outline: none;
            border-color: var(--primary-color);
        }

        .form-group textarea {
            min-height: 150px;
            resize: vertical;
        }

        .submit-btn {
            background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%);
            color: white;
            padding: 1rem 2rem;
            border: none;
            border-radius: 8px;
            font-size: 1.1rem;
            font-weight: 600;
            cursor: pointer;
            width: 100%;
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .submit-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(37, 99, 235, 0.3);
        }

        .form-message {
            padding: 1rem;
            border-radius: 8px;
            margin-bottom: 1.5rem;
            text-align: center;
        }

        .form-message.success {
            background: #d1fae5;
            color: #065f46;
            border: 2px solid var(--success-green);
        }

        .form-message.error {
            background: #fee2e2;
            color: #991b1b;
            border: 2px solid var(--danger-red);
        }

        /* Contact Info */
        .contact-info {
            display: flex;
            flex-direction: column;
            gap: 2rem;
        }

        .info-card {
            background: white;
            padding: 2rem;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        }

        .info-card h3 {
            color: var(--primary-color);
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 1.3rem;
        }

        .info-card p {
            color: var(--text-muted);
            line-height: 1.8;
        }

        .info-card a {
            color: var(--primary-color);
            text-decoration: none;
        }

        .info-card a:hover {
            text-decoration: underline;
        }

        .contact-item {
            display: flex;
            align-items: start;
            gap: 1rem;
            margin-bottom: 1rem;
        }

        .contact-icon {
            font-size: 1.5rem;
            flex-shrink: 0;
        }

        /* FAQ Section */
        .faq-section {
            margin-top: 4rem;
            background: var(--light-secondary);
            padding: 3rem 2rem;
            border-radius: 16px;
        }

        .faq-section h2 {
            text-align: center;
            margin-bottom: 2rem;
            color: var(--text-dark);
        }

        .faq-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
        }

        .faq-item {
            background: white;
            padding: 1.5rem;
            border-radius: 8px;
        }

        .faq-item h4 {
            color: var(--primary-color);
            margin-bottom: 0.5rem;
        }

        .faq-item p {
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

            .contact-container {
                grid-template-columns: 1fr;
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
    <h1>Contact Us</h1>
    <p>Have questions? We're here to help. Get in touch with our team.</p>
</section>

<!-- Content Section -->
<section class="content-section">
    
    <div class="contact-container">
        <!-- Contact Form -->
        <div class="contact-form-wrapper">
            <h2>Send Us a Message</h2>
            
            <?php if ($form_submitted): ?>
                <div class="form-message success">
                    ✅ Thank you! Your message has been sent successfully. We'll get back to you soon.
                </div>
            <?php elseif ($form_error): ?>
                <div class="form-message error">
                    ❌ Sorry, there was an error sending your message. Please try again later.
                </div>
            <?php endif; ?>
            
            <form method="POST" action="">
                <?php wp_nonce_field('contact_form_submit', 'contact_form_nonce'); ?>
                
                <div class="form-group">
                    <label for="name">Your Name *</label>
                    <input type="text" id="name" name="name" required placeholder="John Doe">
                </div>
                
                <div class="form-group">
                    <label for="email">Email Address *</label>
                    <input type="email" id="email" name="email" required placeholder="john@example.com">
                </div>
                
                <div class="form-group">
                    <label for="subject">Subject *</label>
                    <select id="subject" name="subject" required>
                        <option value="">Select a topic...</option>
                        <option value="General Inquiry">General Inquiry</option>
                        <option value="Product Question">Product Question</option>
                        <option value="Review Request">Review Request</option>
                        <option value="Partnership">Partnership Opportunity</option>
                        <option value="Technical Support">Technical Support</option>
                        <option value="Feedback">Feedback</option>
                        <option value="Other">Other</option>
                    </select>
                </div>
                
                <div class="form-group">
                    <label for="message">Your Message *</label>
                    <textarea id="message" name="message" required placeholder="Tell us how we can help you..."></textarea>
                </div>
                
                <button type="submit" class="submit-btn">Send Message</button>
            </form>
        </div>

        <!-- Contact Information -->
        <div class="contact-info">
            <div class="info-card">
                <h3>📧 Email Us</h3>
                <div class="contact-item">
                    <span class="contact-icon">💼</span>
                    <div>
                        <strong>General Inquiries:</strong><br>
                        <a href="mailto:<?php echo antispambot('support@example.com'); ?>"><?php echo antispambot('support@example.com'); ?></a>
                    </div>
                </div>
                <div class="contact-item">
                    <span class="contact-icon">🤝</span>
                    <div>
                        <strong>Partnership:</strong><br>
                        <a href="mailto:<?php echo antispambot('partners@example.com'); ?>"><?php echo antispambot('partners@example.com'); ?></a>
                    </div>
                </div>
            </div>

            <div class="info-card">
                <h3>⏰ Response Time</h3>
                <p>
                    We typically respond to all inquiries within 24-48 hours during business days. 
                    For urgent security-related questions, please mark your message as "high priority."
                </p>
            </div>

            <div class="info-card">
                <h3>🌐 Connect With Us</h3>
                <p>
                    Follow us on social media for the latest security news, product updates, and cybersecurity tips.
                </p>
                <div style="margin-top: 1rem; display: flex; gap: 1rem; font-size: 1.5rem;">
                    <a href="#" style="text-decoration: none;">📘</a>
                    <a href="#" style="text-decoration: none;">🐦</a>
                    <a href="#" style="text-decoration: none;">💼</a>
                    <a href="#" style="text-decoration: none;">📺</a>
                </div>
            </div>

            <div class="info-card">
                <h3>💬 Live Chat</h3>
                <p>
                    Our live chat support is available Monday through Friday, 9 AM - 6 PM EST. 
                    Click the chat icon in the bottom right corner to start a conversation.
                </p>
            </div>
        </div>
    </div>

    <!-- FAQ Section -->
    <div class="faq-section">
        <h2>Frequently Asked Questions</h2>
        <div class="faq-grid">
            <div class="faq-item">
                <h4>How do I choose the right security software?</h4>
                <p>Check our detailed comparison tables and reviews. We break down features, pricing, and performance to help you make an informed decision.</p>
            </div>

            <div class="faq-item">
                <h4>Are your reviews unbiased?</h4>
                <p>Yes! While we earn commissions from affiliate links, all reviews are based on hands-on testing and honest evaluation of each product.</p>
            </div>

            <div class="faq-item">
                <h4>Can you review a specific product?</h4>
                <p>We're always looking to expand our reviews. Send us a request using the form above, and we'll consider it for future coverage.</p>
            </div>

            <div class="faq-item">
                <h4>Do you offer technical support?</h4>
                <p>We provide guidance on choosing security software, but for technical issues with specific products, please contact the vendor directly.</p>
            </div>

            <div class="faq-item">
                <h4>How often do you update reviews?</h4>
                <p>We regularly update our reviews to reflect new features, pricing changes, and emerging threats in the cybersecurity landscape.</p>
            </div>

            <div class="faq-item">
                <h4>Can I partner with you?</h4>
                <p>Yes! We welcome partnership inquiries. Please use the contact form above and select "Partnership Opportunity" as the subject.</p>
            </div>
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

