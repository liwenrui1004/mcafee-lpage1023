<?php
/**
 * Main Template File
 * 
 * This file serves as the default template when no more specific template is found
 * For McAfee landing page theme, always use the page-mcafee-landing.php template
 */

get_header();
?>

<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php bloginfo('name'); ?> - <?php bloginfo('description'); ?></title>
    <?php wp_head(); ?>
    <style>
        body {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
            margin: 0;
            padding: 0;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .welcome-container {
            max-width: 800px;
            margin: 4rem 2rem;
            padding: 3rem;
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.3);
            text-align: center;
        }
        
        .shield-icon {
            font-size: 5rem;
            margin-bottom: 1rem;
            animation: pulse 2s ease-in-out infinite;
        }
        
        @keyframes pulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.1); }
        }
        
        h1 {
            color: #dc2626;
            font-size: 2.5rem;
            margin-bottom: 1rem;
            font-weight: 800;
        }
        
        .subtitle {
            font-size: 1.2rem;
            color: #666;
            margin: 2rem 0;
            line-height: 1.8;
        }
        
        .cta-button {
            display: inline-block;
            padding: 1.25rem 2.5rem;
            background: linear-gradient(135deg, #dc2626 0%, #991b1b 100%);
            color: white;
            text-decoration: none;
            border-radius: 12px;
            font-weight: bold;
            font-size: 1.1rem;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(220, 38, 38, 0.3);
            margin: 1rem 0.5rem;
        }
        
        .cta-button:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 25px rgba(220, 38, 38, 0.4);
        }
        
        .cta-button.secondary {
            background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%);
            box-shadow: 0 4px 15px rgba(37, 99, 235, 0.3);
        }
        
        .cta-button.secondary:hover {
            box-shadow: 0 6px 25px rgba(37, 99, 235, 0.4);
        }
        
        .instructions {
            margin-top: 3rem;
            padding: 2rem;
            background: #f8fafc;
            border-radius: 12px;
            text-align: left;
        }
        
        .instructions h3 {
            color: #1a1f2e;
            margin-bottom: 1rem;
        }
        
        .instructions ol {
            line-height: 2;
            color: #475569;
        }
        
        .instructions ol li {
            margin-bottom: 0.5rem;
        }
        
        .instructions code {
            background: #e2e8f0;
            padding: 0.25rem 0.5rem;
            border-radius: 4px;
            font-family: 'Courier New', monospace;
            font-size: 0.9rem;
        }
        
        .features {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1.5rem;
            margin: 2rem 0;
        }
        
        .feature-card {
            padding: 1.5rem;
            background: #f1f5f9;
            border-radius: 12px;
            transition: transform 0.3s ease;
        }
        
        .feature-card:hover {
            transform: translateY(-5px);
        }
        
        .feature-icon {
            font-size: 2rem;
            margin-bottom: 0.5rem;
        }
        
        .feature-title {
            font-weight: bold;
            color: #1e293b;
            margin-bottom: 0.5rem;
        }
        
        .feature-text {
            color: #64748b;
            font-size: 0.9rem;
            line-height: 1.6;
        }
        
        @media (max-width: 768px) {
            .welcome-container {
                margin: 2rem 1rem;
                padding: 2rem 1.5rem;
            }
            
            h1 {
                font-size: 1.8rem;
            }
            
            .subtitle {
                font-size: 1rem;
            }
            
            .cta-button {
                display: block;
                width: 100%;
                margin: 0.5rem 0;
            }
        }
    </style>
</head>

<body <?php body_class(); ?>>

<div class="welcome-container">
    <div class="shield-icon">🛡️</div>
    
    <h1><?php bloginfo('name'); ?></h1>
    
    <p class="subtitle">
        Welcome to the Professional Cybersecurity Product Review Center!<br>
        Please create a new page and use the "<strong>McAfee Landing Page</strong>" template to view the complete landing page content.
    </p>
    
    <div class="features">
        <div class="feature-card">
            <div class="feature-icon">⚡</div>
            <div class="feature-title">High-Conversion Design</div>
            <div class="feature-text">Anxiety marketing + solution dual structure</div>
        </div>
        
        <div class="feature-card">
            <div class="feature-icon">📊</div>
            <div class="feature-title">Complete Data Tracking</div>
            <div class="feature-text">GA4 + Facebook Pixel</div>
        </div>
        
        <div class="feature-card">
            <div class="feature-icon">📱</div>
            <div class="feature-title">Responsive Design</div>
            <div class="feature-text">Perfect for all devices</div>
        </div>
        
        <div class="feature-card">
            <div class="feature-icon">🔒</div>
            <div class="feature-title">GDPR Compliant</div>
            <div class="feature-text">Built-in cookie management</div>
        </div>
    </div>
    
    <div>
        <a href="<?php echo admin_url('post-new.php?post_type=page'); ?>" class="cta-button">
            📝 Create Landing Page
        </a>
        <a href="<?php echo admin_url('themes.php'); ?>" class="cta-button secondary">
            🎨 Theme Settings
        </a>
    </div>
    
    <div class="instructions">
        <h3>📖 Quick Start Guide</h3>
        <ol>
            <li>Go to <strong>Pages → Add New</strong></li>
            <li>Enter page title, e.g.: "Cybersecurity Product Recommendations"</li>
            <li>Find <strong>Page Attributes → Template</strong> on the right side</li>
            <li>Select <strong>McAfee Landing Page</strong> template</li>
            <li>Click the "Publish" button</li>
            <li>Visit that page to see the complete landing page effect!</li>
        </ol>
        
        <p style="margin-top: 1.5rem; padding-top: 1.5rem; border-top: 1px solid #e2e8f0; color: #64748b;">
            💡 <strong>Tip:</strong> After creating the page, you can configure McAfee, Norton, and Bitdefender affiliate links in the "Affiliate Link Settings" box on the right side.
        </p>
    </div>
    
    <div style="margin-top: 2rem; padding-top: 2rem; border-top: 1px solid #e2e8f0; color: #94a3b8; font-size: 0.9rem;">
        <p>Need help? Check <code>README.md</code> and <code>INSTALLATION-GUIDE.md</code> in the theme directory</p>
        <p style="margin-top: 0.5rem;">&copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?>. All rights reserved.</p>
    </div>
</div>

<?php wp_footer(); ?>

</body>
</html>
