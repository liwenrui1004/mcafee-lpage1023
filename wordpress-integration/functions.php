<?php
/**
 * McAfee Landing Page Theme Functions
 * 
 * This file manages all theme functionality
 * If you're using a child theme, add this content to your child theme's functions.php
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

/**
 * 1. Load Theme Styles and Scripts
 */
function mcafee_landing_enqueue_assets() {
    // Only load resources on pages using the McAfee Landing Page template
    if (is_page_template('page-mcafee-landing.php')) {
        
        // Load custom CSS (if CSS is separated to external file)
        // wp_enqueue_style('mcafee-landing-style', get_template_directory_uri() . '/assets/css/mcafee-landing.css', array(), '1.0.0');
        
        // Load custom JavaScript (if JS is separated to external file)
        // wp_enqueue_script('mcafee-landing-script', get_template_directory_uri() . '/assets/js/mcafee-landing.js', array('jquery'), '1.0.0', true);
        
        // Pass WordPress variables to JavaScript
        wp_localize_script('jquery', 'mcafeeData', array(
            'ajaxUrl' => admin_url('admin-ajax.php'),
            'nonce' => wp_create_nonce('mcafee_landing_nonce'),
            'homeUrl' => home_url('/'),
        ));
    }
}
add_action('wp_enqueue_scripts', 'mcafee_landing_enqueue_assets');

/**
 * 2. Remove WordPress Default Headers and Footers
 * (Because our landing page has its own complete HTML structure)
 */
function mcafee_landing_remove_default_headers() {
    if (is_page_template('page-mcafee-landing.php')) {
        // Remove unnecessary WordPress header information
        remove_action('wp_head', 'rsd_link');
        remove_action('wp_head', 'wlwmanifest_link');
        remove_action('wp_head', 'wp_generator');
        remove_action('wp_head', 'start_post_rel_link');
        remove_action('wp_head', 'index_rel_link');
        remove_action('wp_head', 'adjacent_posts_rel_link');
        remove_action('wp_head', 'wp_shortlink_wp_head');
        
        // Remove Emoji support (reduce load time)
        remove_action('wp_head', 'print_emoji_detection_script', 7);
        remove_action('wp_print_styles', 'print_emoji_styles');
    }
}
add_action('template_redirect', 'mcafee_landing_remove_default_headers');

/**
 * 3. Add Theme Support
 */
function mcafee_landing_theme_support() {
    // Add page title support
    add_theme_support('title-tag');
    
    // Add featured image support (for SEO)
    add_theme_support('post-thumbnails');
    
    // Add automatic feed links
    add_theme_support('automatic-feed-links');
    
    // HTML5 support
    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
    ));
}
add_action('after_setup_theme', 'mcafee_landing_theme_support');

/**
 * 4. Form Submission Handler (Ajax)
 * Handles contact form submissions on the page
 */
function mcafee_landing_handle_form_submission() {
    // Verify nonce
    check_ajax_referer('mcafee_landing_nonce', 'nonce');
    
    // Get form data
    $name = sanitize_text_field($_POST['name'] ?? '');
    $email = sanitize_email($_POST['email'] ?? '');
    $message = sanitize_textarea_field($_POST['message'] ?? '');
    $phone = sanitize_text_field($_POST['phone'] ?? '');
    $product_interest = sanitize_text_field($_POST['product_interest'] ?? '');
    
    // Validate data
    if (empty($name) || empty($email) || empty($message)) {
        wp_send_json_error(array('message' => 'Please fill in all required fields'));
        return;
    }
    
    if (!is_email($email)) {
        wp_send_json_error(array('message' => 'Please enter a valid email address'));
        return;
    }
    
    // Send email to administrator
    $to = get_option('admin_email');
    $subject = 'New Lead from McAfee Landing Page';
    $body = "Name: $name\nEmail: $email\n";
    if (!empty($phone)) {
        $body .= "Phone: $phone\n";
    }
    if (!empty($product_interest)) {
        $body .= "Product Interest: $product_interest\n";
    }
    $body .= "\nMessage:\n$message";
    
    $headers = array('Content-Type: text/plain; charset=UTF-8', 'Reply-To: ' . $email);
    
    $sent = wp_mail($to, $subject, $body, $headers);
    
    if ($sent) {
        // Optional: Save to database
        global $wpdb;
        $table_name = $wpdb->prefix . 'mcafee_leads';
        $wpdb->insert(
            $table_name,
            array(
                'name' => $name,
                'email' => $email,
                'phone' => $phone,
                'message' => $message,
                'product_interest' => $product_interest,
                'submitted_at' => current_time('mysql'),
                'ip_address' => $_SERVER['REMOTE_ADDR'] ?? '',
            ),
            array('%s', '%s', '%s', '%s', '%s', '%s', '%s')
        );
        
        wp_send_json_success(array('message' => 'Thank you for your message! We will get back to you soon.'));
    } else {
        wp_send_json_error(array('message' => 'Sending failed. Please try again later.'));
    }
}
add_action('wp_ajax_mcafee_submit_form', 'mcafee_landing_handle_form_submission');
add_action('wp_ajax_nopriv_mcafee_submit_form', 'mcafee_landing_handle_form_submission');

/**
 * 5. Create Database Table (for storing form submissions)
 * Runs when theme is activated
 */
function mcafee_landing_create_database() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'mcafee_leads';
    $charset_collate = $wpdb->get_charset_collate();
    
    $sql = "CREATE TABLE IF NOT EXISTS $table_name (
        id mediumint(9) NOT NULL AUTO_INCREMENT,
        name varchar(100) NOT NULL,
        email varchar(100) NOT NULL,
        phone varchar(50),
        message text NOT NULL,
        product_interest varchar(100),
        submitted_at datetime DEFAULT CURRENT_TIMESTAMP NOT NULL,
        ip_address varchar(45),
        PRIMARY KEY  (id),
        KEY email (email),
        KEY submitted_at (submitted_at)
    ) $charset_collate;";
    
    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($sql);
}
add_action('after_switch_theme', 'mcafee_landing_create_database');

/**
 * 6. Add Custom Meta Boxes for Affiliate Links
 * Allows setting affiliate links for each page
 */
function mcafee_landing_add_meta_boxes() {
    add_meta_box(
        'mcafee_affiliate_links',
        'Affiliate Link Settings',
        'mcafee_landing_meta_box_callback',
        'page',
        'side',
        'default'
    );
}
add_action('add_meta_boxes', 'mcafee_landing_add_meta_boxes');

/**
 * Meta Box Callback Function
 */
function mcafee_landing_meta_box_callback($post) {
    // Add nonce for security
    wp_nonce_field('mcafee_landing_save_meta', 'mcafee_landing_meta_nonce');
    
    // Get current values
    $mcafee_link = get_post_meta($post->ID, '_mcafee_affiliate_link', true);
    $norton_link = get_post_meta($post->ID, '_norton_affiliate_link', true);
    $bitdefender_link = get_post_meta($post->ID, '_bitdefender_affiliate_link', true);
    
    ?>
    <p>
        <label for="mcafee_affiliate_link"><strong>McAfee Affiliate Link:</strong></label><br>
        <input type="url" id="mcafee_affiliate_link" name="mcafee_affiliate_link" 
               value="<?php echo esc_attr($mcafee_link); ?>" 
               placeholder="https://www.mcafee.com/?ref=YOUR_ID" 
               style="width: 100%; margin-top: 5px;">
    </p>
    
    <p>
        <label for="norton_affiliate_link"><strong>Norton Affiliate Link:</strong></label><br>
        <input type="url" id="norton_affiliate_link" name="norton_affiliate_link" 
               value="<?php echo esc_attr($norton_link); ?>" 
               placeholder="https://www.norton.com/?aff=YOUR_ID" 
               style="width: 100%; margin-top: 5px;">
    </p>
    
    <p>
        <label for="bitdefender_affiliate_link"><strong>Bitdefender Affiliate Link:</strong></label><br>
        <input type="url" id="bitdefender_affiliate_link" name="bitdefender_affiliate_link" 
               value="<?php echo esc_attr($bitdefender_link); ?>" 
               placeholder="https://www.bitdefender.com/?partner=YOUR_ID" 
               style="width: 100%; margin-top: 5px;">
    </p>
    
    <p style="color: #666; font-size: 12px;">
        💡 <strong>Tip:</strong> Leave blank to use default links. These links will be automatically 
        inserted into the landing page buttons.
    </p>
    <?php
}

/**
 * Save Meta Box Data
 */
function mcafee_landing_save_meta_boxes($post_id) {
    // Verify nonce
    if (!isset($_POST['mcafee_landing_meta_nonce']) || 
        !wp_verify_nonce($_POST['mcafee_landing_meta_nonce'], 'mcafee_landing_save_meta')) {
        return;
    }
    
    // Check if this is an autosave
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    
    // Check user permissions
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }
    
    // Save/Update affiliate links
    if (isset($_POST['mcafee_affiliate_link'])) {
        update_post_meta($post_id, '_mcafee_affiliate_link', esc_url_raw($_POST['mcafee_affiliate_link']));
    }
    
    if (isset($_POST['norton_affiliate_link'])) {
        update_post_meta($post_id, '_norton_affiliate_link', esc_url_raw($_POST['norton_affiliate_link']));
    }
    
    if (isset($_POST['bitdefender_affiliate_link'])) {
        update_post_meta($post_id, '_bitdefender_affiliate_link', esc_url_raw($_POST['bitdefender_affiliate_link']));
    }
}
add_action('save_post', 'mcafee_landing_save_meta_boxes');

/**
 * 7. Add Settings Page
 * For tracking codes and other global settings
 */
function mcafee_landing_add_settings_page() {
    add_options_page(
        'McAfee Landing Page Settings',
        'McAfee Landing',
        'manage_options',
        'mcafee-landing-settings',
        'mcafee_landing_settings_page'
    );
}
add_action('admin_menu', 'mcafee_landing_add_settings_page');

/**
 * Settings Page Content
 */
function mcafee_landing_settings_page() {
    ?>
    <div class="wrap">
        <h1>McAfee Landing Page Settings</h1>
        <form method="post" action="options.php">
            <?php
            settings_fields('mcafee_landing_settings');
            do_settings_sections('mcafee-landing-settings');
            submit_button();
            ?>
        </form>
    </div>
    <?php
}

/**
 * Register Settings
 */
function mcafee_landing_register_settings() {
    // Register settings
    register_setting('mcafee_landing_settings', 'mcafee_google_analytics_id');
    register_setting('mcafee_landing_settings', 'mcafee_facebook_pixel_id');
    register_setting('mcafee_landing_settings', 'mcafee_default_mcafee_link');
    register_setting('mcafee_landing_settings', 'mcafee_default_norton_link');
    register_setting('mcafee_landing_settings', 'mcafee_default_bitdefender_link');
    
    // Add settings section
    add_settings_section(
        'mcafee_landing_tracking_section',
        'Tracking & Analytics',
        'mcafee_landing_tracking_section_callback',
        'mcafee-landing-settings'
    );
    
    add_settings_section(
        'mcafee_landing_affiliate_section',
        'Default Affiliate Links',
        'mcafee_landing_affiliate_section_callback',
        'mcafee-landing-settings'
    );
    
    // Add settings fields - Tracking
    add_settings_field(
        'mcafee_google_analytics_id',
        'Google Analytics ID',
        'mcafee_landing_google_analytics_field',
        'mcafee-landing-settings',
        'mcafee_landing_tracking_section'
    );
    
    add_settings_field(
        'mcafee_facebook_pixel_id',
        'Facebook Pixel ID',
        'mcafee_landing_facebook_pixel_field',
        'mcafee-landing-settings',
        'mcafee_landing_tracking_section'
    );
    
    // Add settings fields - Affiliate Links
    add_settings_field(
        'mcafee_default_mcafee_link',
        'Default McAfee Link',
        'mcafee_landing_default_mcafee_field',
        'mcafee-landing-settings',
        'mcafee_landing_affiliate_section'
    );
    
    add_settings_field(
        'mcafee_default_norton_link',
        'Default Norton Link',
        'mcafee_landing_default_norton_field',
        'mcafee-landing-settings',
        'mcafee_landing_affiliate_section'
    );
    
    add_settings_field(
        'mcafee_default_bitdefender_link',
        'Default Bitdefender Link',
        'mcafee_landing_default_bitdefender_field',
        'mcafee-landing-settings',
        'mcafee_landing_affiliate_section'
    );
}
add_action('admin_init', 'mcafee_landing_register_settings');

/**
 * Section Callbacks
 */
function mcafee_landing_tracking_section_callback() {
    echo '<p>Configure your tracking and analytics codes below. These will be automatically injected into your landing pages.</p>';
}

function mcafee_landing_affiliate_section_callback() {
    echo '<p>Set default affiliate links that will be used if page-specific links are not configured.</p>';
}

/**
 * Field Callbacks
 */
function mcafee_landing_google_analytics_field() {
    $value = get_option('mcafee_google_analytics_id');
    echo '<input type="text" name="mcafee_google_analytics_id" value="' . esc_attr($value) . '" placeholder="G-XXXXXXXXXX" style="width: 300px;">';
    echo '<p class="description">Enter your Google Analytics 4 Measurement ID (e.g., G-XXXXXXXXXX)</p>';
}

function mcafee_landing_facebook_pixel_field() {
    $value = get_option('mcafee_facebook_pixel_id');
    echo '<input type="text" name="mcafee_facebook_pixel_id" value="' . esc_attr($value) . '" placeholder="123456789012345" style="width: 300px;">';
    echo '<p class="description">Enter your Facebook Pixel ID (15-16 digit number)</p>';
}

function mcafee_landing_default_mcafee_field() {
    $value = get_option('mcafee_default_mcafee_link');
    echo '<input type="url" name="mcafee_default_mcafee_link" value="' . esc_attr($value) . '" placeholder="https://www.mcafee.com/?ref=YOUR_ID" style="width: 100%; max-width: 500px;">';
}

function mcafee_landing_default_norton_field() {
    $value = get_option('mcafee_default_norton_link');
    echo '<input type="url" name="mcafee_default_norton_link" value="' . esc_attr($value) . '" placeholder="https://www.norton.com/?aff=YOUR_ID" style="width: 100%; max-width: 500px;">';
}

function mcafee_landing_default_bitdefender_field() {
    $value = get_option('mcafee_default_bitdefender_link');
    echo '<input type="url" name="mcafee_default_bitdefender_link" value="' . esc_attr($value) . '" placeholder="https://www.bitdefender.com/?partner=YOUR_ID" style="width: 100%; max-width: 500px;">';
}

/**
 * 8. Inject Tracking Codes
 */
function mcafee_landing_inject_tracking_codes() {
    if (!is_page_template('page-mcafee-landing.php')) {
        return;
    }
    
    // Google Analytics
    $ga_id = get_option('mcafee_google_analytics_id');
    if (!empty($ga_id)) {
        ?>
        <!-- Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=<?php echo esc_attr($ga_id); ?>"></script>
        <script>
            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
            gtag('js', new Date());
            gtag('config', '<?php echo esc_js($ga_id); ?>');
        </script>
        <?php
    }
    
    // Facebook Pixel
    $fb_id = get_option('mcafee_facebook_pixel_id');
    if (!empty($fb_id)) {
        ?>
        <!-- Facebook Pixel Code -->
        <script>
            !function(f,b,e,v,n,t,s)
            {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
            n.callMethod.apply(n,arguments):n.queue.push(arguments)};
            if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
            n.queue=[];t=b.createElement(e);t.async=!0;
            t.src=v;s=b.getElementsByTagName(e)[0];
            s.parentNode.insertBefore(t,s)}(window, document,'script',
            'https://connect.facebook.net/en_US/fbevents.js');
            fbq('init', '<?php echo esc_js($fb_id); ?>');
            fbq('track', 'PageView');
        </script>
        <noscript>
            <img height="1" width="1" style="display:none" 
                 src="https://www.facebook.com/tr?id=<?php echo esc_attr($fb_id); ?>&ev=PageView&noscript=1"/>
        </noscript>
        <!-- End Facebook Pixel Code -->
        <?php
    }
}
add_action('wp_head', 'mcafee_landing_inject_tracking_codes');

/**
 * 9. Admin Dashboard Widget - Recent Leads
 */
function mcafee_landing_add_dashboard_widget() {
    wp_add_dashboard_widget(
        'mcafee_leads_widget',
        '🛡️ Recent McAfee Landing Page Leads',
        'mcafee_landing_dashboard_widget_content'
    );
}
add_action('wp_dashboard_setup', 'mcafee_landing_add_dashboard_widget');

/**
 * Dashboard Widget Content
 */
function mcafee_landing_dashboard_widget_content() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'mcafee_leads';
    
    // Check if table exists
    if ($wpdb->get_var("SHOW TABLES LIKE '$table_name'") != $table_name) {
        echo '<p>No leads table found. Please activate the theme to create the database table.</p>';
        return;
    }
    
    $leads = $wpdb->get_results("SELECT * FROM $table_name ORDER BY submitted_at DESC LIMIT 5");
    
    if (empty($leads)) {
        echo '<p>No leads yet. Waiting for first submission...</p>';
        return;
    }
    
    echo '<table style="width: 100%; border-collapse: collapse;">';
    echo '<thead><tr style="border-bottom: 2px solid #ddd;">
            <th style="text-align: left; padding: 8px;">Name</th>
            <th style="text-align: left; padding: 8px;">Email</th>
            <th style="text-align: left; padding: 8px;">Product</th>
            <th style="text-align: left; padding: 8px;">Date</th>
          </tr></thead>';
    echo '<tbody>';
    
    foreach ($leads as $lead) {
        echo '<tr style="border-bottom: 1px solid #eee;">';
        echo '<td style="padding: 8px;">' . esc_html($lead->name) . '</td>';
        echo '<td style="padding: 8px;"><a href="mailto:' . esc_attr($lead->email) . '">' . esc_html($lead->email) . '</a></td>';
        echo '<td style="padding: 8px;">' . esc_html($lead->product_interest ?: 'N/A') . '</td>';
        echo '<td style="padding: 8px;">' . esc_html(date('M j, Y', strtotime($lead->submitted_at))) . '</td>';
        echo '</tr>';
    }
    
    echo '</tbody></table>';
    echo '<p style="margin-top: 15px;"><a href="' . admin_url('admin.php?page=mcafee-leads') . '" class="button button-primary">View All Leads →</a></p>';
}

/**
 * 10. Admin Menu - View All Leads
 */
function mcafee_landing_add_leads_page() {
    add_menu_page(
        'McAfee Leads',
        'McAfee Leads',
        'manage_options',
        'mcafee-leads',
        'mcafee_landing_leads_page_content',
        'dashicons-shield',
        30
    );
}
add_action('admin_menu', 'mcafee_landing_add_leads_page');

/**
 * Leads Page Content
 */
function mcafee_landing_leads_page_content() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'mcafee_leads';
    
    // Handle lead deletion
    if (isset($_GET['action']) && $_GET['action'] === 'delete' && isset($_GET['id'])) {
        $id = intval($_GET['id']);
        $wpdb->delete($table_name, array('id' => $id), array('%d'));
        echo '<div class="notice notice-success"><p>Lead deleted successfully.</p></div>';
    }
    
    $leads = $wpdb->get_results("SELECT * FROM $table_name ORDER BY submitted_at DESC");
    
    ?>
    <div class="wrap">
        <h1 class="wp-heading-inline">McAfee Landing Page Leads</h1>
        <a href="<?php echo admin_url('admin.php?page=mcafee-leads&action=export'); ?>" class="page-title-action">Export to CSV</a>
        <hr class="wp-header-end">
        
        <?php if (empty($leads)): ?>
            <p>No leads found yet.</p>
        <?php else: ?>
            <table class="wp-list-table widefat fixed striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Product Interest</th>
                        <th>Message</th>
                        <th>Date</th>
                        <th>IP Address</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($leads as $lead): ?>
                        <tr>
                            <td><?php echo esc_html($lead->id); ?></td>
                            <td><?php echo esc_html($lead->name); ?></td>
                            <td><a href="mailto:<?php echo esc_attr($lead->email); ?>"><?php echo esc_html($lead->email); ?></a></td>
                            <td><?php echo esc_html($lead->phone ?: 'N/A'); ?></td>
                            <td><?php echo esc_html($lead->product_interest ?: 'N/A'); ?></td>
                            <td><?php echo esc_html(wp_trim_words($lead->message, 10)); ?></td>
                            <td><?php echo esc_html(date('M j, Y g:i A', strtotime($lead->submitted_at))); ?></td>
                            <td><?php echo esc_html($lead->ip_address); ?></td>
                            <td>
                                <a href="<?php echo admin_url('admin.php?page=mcafee-leads&action=delete&id=' . $lead->id); ?>" 
                                   onclick="return confirm('Are you sure you want to delete this lead?');" 
                                   class="button button-small">Delete</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>
    <?php
}

/**
 * 11. Export Leads to CSV
 */
function mcafee_landing_export_leads() {
    if (!isset($_GET['page']) || $_GET['page'] !== 'mcafee-leads' || 
        !isset($_GET['action']) || $_GET['action'] !== 'export') {
        return;
    }
    
    if (!current_user_can('manage_options')) {
        wp_die('Unauthorized access');
    }
    
    global $wpdb;
    $table_name = $wpdb->prefix . 'mcafee_leads';
    $leads = $wpdb->get_results("SELECT * FROM $table_name ORDER BY submitted_at DESC", ARRAY_A);
    
    if (empty($leads)) {
        wp_die('No leads to export');
    }
    
    // Set headers for CSV download
    header('Content-Type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename=mcafee-leads-' . date('Y-m-d') . '.csv');
    
    $output = fopen('php://output', 'w');
    
    // Add CSV headers
    fputcsv($output, array('ID', 'Name', 'Email', 'Phone', 'Product Interest', 'Message', 'Date', 'IP Address'));
    
    // Add data
    foreach ($leads as $lead) {
        fputcsv($output, $lead);
    }
    
    fclose($output);
    exit;
}
add_action('admin_init', 'mcafee_landing_export_leads');

/**
 * 12. SEO Optimization
 */
function mcafee_landing_seo_meta() {
    if (!is_page_template('page-mcafee-landing.php')) {
        return;
    }
    
    // Only add if Yoast or other SEO plugins are not active
    if (!function_exists('wpseo_auto_load') && !class_exists('RankMath')) {
        ?>
        <meta name="description" content="Protect your digital life with top-rated security software. Expert reviews of McAfee, Norton, and Bitdefender. Get up to 60% off today.">
        <meta name="keywords" content="antivirus software, cybersecurity, McAfee, Norton, Bitdefender, online security, malware protection">
        <meta property="og:title" content="Top Cybersecurity Solutions 2025 - Expert Reviews & Comparisons">
        <meta property="og:description" content="Protect your devices with military-grade security. Compare McAfee, Norton & Bitdefender. Save up to 60% today.">
        <meta property="og:type" content="website">
        <meta property="og:url" content="<?php echo esc_url(get_permalink()); ?>">
        <meta property="og:image" content="<?php echo esc_url(get_template_directory_uri() . '/assets/images/og-image.jpg'); ?>">
        <meta name="twitter:card" content="summary_large_image">
        <meta name="twitter:title" content="Top Cybersecurity Solutions 2025">
        <meta name="twitter:description" content="Expert reviews of leading security software. Get protected today.">
        <?php
    }
}
add_action('wp_head', 'mcafee_landing_seo_meta', 1);

/**
 * 13. Performance Optimization - Defer non-critical CSS/JS
 */
function mcafee_landing_optimize_assets($tag, $handle) {
    if (is_page_template('page-mcafee-landing.php')) {
        // Defer non-critical JavaScript
        if (strpos($handle, 'jquery') === false) {
            return str_replace(' src', ' defer src', $tag);
        }
    }
    return $tag;
}
add_filter('script_loader_tag', 'mcafee_landing_optimize_assets', 10, 2);

/**
 * 14. Security Hardening
 */
// Disable XML-RPC
add_filter('xmlrpc_enabled', '__return_false');

// Remove WordPress version
function mcafee_landing_remove_version() {
    return '';
}
add_filter('the_generator', 'mcafee_landing_remove_version');

// Disable file editing
if (!defined('DISALLOW_FILE_EDIT')) {
    define('DISALLOW_FILE_EDIT', true);
}

?>
