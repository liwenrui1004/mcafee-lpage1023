<?php
/**
 * McAfee Landing Page Theme Functions
 * 
 * 此文件管理主题的所有功能
 * 如果您使用的是子主题，将此内容添加到子主题的functions.php中
 */

// 阻止直接访问
if (!defined('ABSPATH')) {
    exit;
}

/**
 * 1. 加载主题样式和脚本
 */
function mcafee_landing_enqueue_assets() {
    // 仅在使用McAfee Landing Page模板的页面加载资源
    if (is_page_template('page-mcafee-landing.php')) {
        
        // 加载自定义CSS（如果将CSS分离到外部文件）
        // wp_enqueue_style('mcafee-landing-style', get_template_directory_uri() . '/assets/css/mcafee-landing.css', array(), '1.0.0');
        
        // 加载自定义JavaScript（如果将JS分离到外部文件）
        // wp_enqueue_script('mcafee-landing-script', get_template_directory_uri() . '/assets/js/mcafee-landing.js', array('jquery'), '1.0.0', true);
        
        // 传递WordPress变量到JavaScript
        wp_localize_script('mcafee-landing-script', 'mcafeeData', array(
            'ajaxUrl' => admin_url('admin-ajax.php'),
            'nonce' => wp_create_nonce('mcafee_landing_nonce'),
            'homeUrl' => home_url('/'),
        ));
    }
}
add_action('wp_enqueue_scripts', 'mcafee_landing_enqueue_assets');

/**
 * 2. 移除WordPress默认的头部和页脚
 * （因为我们的落地页有自己的完整HTML结构）
 */
function mcafee_landing_remove_default_headers() {
    if (is_page_template('page-mcafee-landing.php')) {
        // 移除不必要的WordPress头部信息
        remove_action('wp_head', 'rsd_link');
        remove_action('wp_head', 'wlwmanifest_link');
        remove_action('wp_head', 'wp_generator');
        remove_action('wp_head', 'start_post_rel_link');
        remove_action('wp_head', 'index_rel_link');
        remove_action('wp_head', 'adjacent_posts_rel_link');
        remove_action('wp_head', 'wp_shortlink_wp_head');
        
        // 移除Emoji支持（减少加载时间）
        remove_action('wp_head', 'print_emoji_detection_script', 7);
        remove_action('wp_print_styles', 'print_emoji_styles');
    }
}
add_action('template_redirect', 'mcafee_landing_remove_default_headers');

/**
 * 3. 添加主题支持
 */
function mcafee_landing_theme_support() {
    // 添加页面标题支持
    add_theme_support('title-tag');
    
    // 添加特色图片支持（用于SEO）
    add_theme_support('post-thumbnails');
    
    // 添加自动feed链接
    add_theme_support('automatic-feed-links');
    
    // HTML5支持
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
 * 4. 表单提交处理（Ajax）
 * 用于处理页面上的联系表单
 */
function mcafee_landing_handle_form_submission() {
    // 验证nonce
    check_ajax_referer('mcafee_landing_nonce', 'nonce');
    
    // 获取表单数据
    $name = sanitize_text_field($_POST['name'] ?? '');
    $email = sanitize_email($_POST['email'] ?? '');
    $message = sanitize_textarea_field($_POST['message'] ?? '');
    
    // 验证数据
    if (empty($name) || empty($email) || empty($message)) {
        wp_send_json_error(array('message' => '请填写所有必填字段'));
        return;
    }
    
    if (!is_email($email)) {
        wp_send_json_error(array('message' => '请输入有效的邮箱地址'));
        return;
    }
    
    // 发送邮件给管理员
    $to = get_option('admin_email');
    $subject = '来自McAfee落地页的新消息';
    $body = "姓名: $name\n邮箱: $email\n\n消息:\n$message";
    $headers = array('Content-Type: text/plain; charset=UTF-8');
    
    $sent = wp_mail($to, $subject, $body, $headers);
    
    if ($sent) {
        // 可选：保存到数据库
        global $wpdb;
        $table_name = $wpdb->prefix . 'mcafee_leads';
        $wpdb->insert(
            $table_name,
            array(
                'name' => $name,
                'email' => $email,
                'message' => $message,
                'submitted_at' => current_time('mysql'),
                'ip_address' => $_SERVER['REMOTE_ADDR'] ?? '',
            ),
            array('%s', '%s', '%s', '%s', '%s')
        );
        
        wp_send_json_success(array('message' => '感谢您的留言！我们会尽快回复。'));
    } else {
        wp_send_json_error(array('message' => '发送失败，请稍后重试。'));
    }
}
add_action('wp_ajax_mcafee_submit_form', 'mcafee_landing_handle_form_submission');
add_action('wp_ajax_nopriv_mcafee_submit_form', 'mcafee_landing_handle_form_submission');

/**
 * 5. 创建数据库表（用于存储表单提交）
 * 在主题激活时运行
 */
function mcafee_landing_create_database() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'mcafee_leads';
    $charset_collate = $wpdb->get_charset_collate();
    
    $sql = "CREATE TABLE IF NOT EXISTS $table_name (
        id mediumint(9) NOT NULL AUTO_INCREMENT,
        name varchar(100) NOT NULL,
        email varchar(100) NOT NULL,
        message text NOT NULL,
        submitted_at datetime DEFAULT CURRENT_TIMESTAMP NOT NULL,
        ip_address varchar(45) NOT NULL,
        PRIMARY KEY  (id),
        KEY email (email),
        KEY submitted_at (submitted_at)
    ) $charset_collate;";
    
    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($sql);
}
register_activation_hook(__FILE__, 'mcafee_landing_create_database');

/**
 * 6. 添加管理员菜单查看表单提交
 */
function mcafee_landing_admin_menu() {
    add_menu_page(
        'McAfee线索管理',
        'McAfee线索',
        'manage_options',
        'mcafee-leads',
        'mcafee_landing_leads_page',
        'dashicons-shield',
        30
    );
}
add_action('admin_menu', 'mcafee_landing_admin_menu');

/**
 * 7. 管理员页面显示表单提交
 */
function mcafee_landing_leads_page() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'mcafee_leads';
    
    // 处理删除操作
    if (isset($_GET['action']) && $_GET['action'] === 'delete' && isset($_GET['id'])) {
        $id = intval($_GET['id']);
        $wpdb->delete($table_name, array('id' => $id), array('%d'));
        echo '<div class="notice notice-success"><p>线索已删除</p></div>';
    }
    
    // 获取所有提交
    $leads = $wpdb->get_results("SELECT * FROM $table_name ORDER BY submitted_at DESC LIMIT 100");
    
    ?>
    <div class="wrap">
        <h1>📋 McAfee落地页线索管理</h1>
        
        <div class="notice notice-info">
            <p><strong>总线索数：</strong><?php echo $wpdb->get_var("SELECT COUNT(*) FROM $table_name"); ?> 条</p>
        </div>
        
        <table class="wp-list-table widefat fixed striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>姓名</th>
                    <th>邮箱</th>
                    <th>消息</th>
                    <th>提交时间</th>
                    <th>IP地址</th>
                    <th>操作</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($leads): ?>
                    <?php foreach ($leads as $lead): ?>
                        <tr>
                            <td><?php echo esc_html($lead->id); ?></td>
                            <td><?php echo esc_html($lead->name); ?></td>
                            <td><a href="mailto:<?php echo esc_attr($lead->email); ?>"><?php echo esc_html($lead->email); ?></a></td>
                            <td><?php echo esc_html(substr($lead->message, 0, 100)) . (strlen($lead->message) > 100 ? '...' : ''); ?></td>
                            <td><?php echo esc_html($lead->submitted_at); ?></td>
                            <td><?php echo esc_html($lead->ip_address); ?></td>
                            <td>
                                <a href="?page=mcafee-leads&action=delete&id=<?php echo $lead->id; ?>" 
                                   class="button button-small"
                                   onclick="return confirm('确定要删除这条线索吗？')">删除</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="7" style="text-align: center;">暂无线索数据</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    <?php
}

/**
 * 8. 添加自定义字段支持
 * 允许在后台编辑页面时自定义联盟链接
 */
function mcafee_landing_add_meta_boxes() {
    add_meta_box(
        'mcafee_affiliate_links',
        '联盟链接设置',
        'mcafee_landing_meta_box_callback',
        'page',
        'side',
        'default'
    );
}
add_action('add_meta_boxes', 'mcafee_landing_add_meta_boxes');

function mcafee_landing_meta_box_callback($post) {
    // 添加nonce字段
    wp_nonce_field('mcafee_landing_meta_box', 'mcafee_landing_meta_box_nonce');
    
    // 获取现有值
    $mcafee_link = get_post_meta($post->ID, '_mcafee_affiliate_link', true);
    $norton_link = get_post_meta($post->ID, '_norton_affiliate_link', true);
    $bitdefender_link = get_post_meta($post->ID, '_bitdefender_affiliate_link', true);
    
    ?>
    <p>
        <label for="mcafee_affiliate_link"><strong>McAfee联盟链接：</strong></label><br>
        <input type="url" id="mcafee_affiliate_link" name="mcafee_affiliate_link" 
               value="<?php echo esc_attr($mcafee_link); ?>" 
               style="width: 100%;" placeholder="https://...">
    </p>
    <p>
        <label for="norton_affiliate_link"><strong>Norton联盟链接：</strong></label><br>
        <input type="url" id="norton_affiliate_link" name="norton_affiliate_link" 
               value="<?php echo esc_attr($norton_link); ?>" 
               style="width: 100%;" placeholder="https://...">
    </p>
    <p>
        <label for="bitdefender_affiliate_link"><strong>Bitdefender联盟链接：</strong></label><br>
        <input type="url" id="bitdefender_affiliate_link" name="bitdefender_affiliate_link" 
               value="<?php echo esc_attr($bitdefender_link); ?>" 
               style="width: 100%;" placeholder="https://...">
    </p>
    <?php
}

/**
 * 9. 保存自定义字段
 */
function mcafee_landing_save_meta_box($post_id) {
    // 验证nonce
    if (!isset($_POST['mcafee_landing_meta_box_nonce'])) {
        return;
    }
    if (!wp_verify_nonce($_POST['mcafee_landing_meta_box_nonce'], 'mcafee_landing_meta_box')) {
        return;
    }
    
    // 检查自动保存
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    
    // 检查权限
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }
    
    // 保存数据
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
add_action('save_post', 'mcafee_landing_save_meta_box');

/**
 * 10. 短代码支持 - 方便在其他页面使用
 */
function mcafee_landing_affiliate_button_shortcode($atts) {
    $atts = shortcode_atts(array(
        'product' => 'mcafee',
        'text' => '立即购买',
        'style' => 'primary',
    ), $atts);
    
    $link = get_post_meta(get_the_ID(), '_' . $atts['product'] . '_affiliate_link', true);
    
    if (empty($link)) {
        return '';
    }
    
    return sprintf(
        '<a href="%s" class="affiliate-button affiliate-button-%s" target="_blank" rel="nofollow noopener">%s</a>',
        esc_url($link),
        esc_attr($atts['style']),
        esc_html($atts['text'])
    );
}
add_shortcode('mcafee_button', 'mcafee_landing_affiliate_button_shortcode');

/**
 * 11. 添加跟踪代码支持
 */
function mcafee_landing_add_tracking_codes() {
    if (is_page_template('page-mcafee-landing.php')) {
        // Google Analytics（从WordPress设置获取）
        $ga_tracking_id = get_option('mcafee_ga_tracking_id');
        if ($ga_tracking_id) {
            ?>
            <!-- Google Analytics -->
            <script async src="https://www.googletagmanager.com/gtag/js?id=<?php echo esc_attr($ga_tracking_id); ?>"></script>
            <script>
                window.dataLayer = window.dataLayer || [];
                function gtag(){dataLayer.push(arguments);}
                gtag('js', new Date());
                gtag('config', '<?php echo esc_js($ga_tracking_id); ?>');
            </script>
            <?php
        }
        
        // Facebook Pixel（从WordPress设置获取）
        $fb_pixel_id = get_option('mcafee_fb_pixel_id');
        if ($fb_pixel_id) {
            ?>
            <!-- Facebook Pixel -->
            <script>
                !function(f,b,e,v,n,t,s)
                {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
                n.callMethod.apply(n,arguments):n.queue.push(arguments)};
                if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
                n.queue=[];t=b.createElement(e);t.async=!0;
                t.src=v;s=b.getElementsByTagName(e)[0];
                s.parentNode.insertBefore(t,s)}(window, document,'script',
                'https://connect.facebook.net/en_US/fbevents.js');
                fbq('init', '<?php echo esc_js($fb_pixel_id); ?>');
                fbq('track', 'PageView');
            </script>
            <?php
        }
    }
}
add_action('wp_head', 'mcafee_landing_add_tracking_codes');

/**
 * 12. 添加设置页面
 */
function mcafee_landing_settings_menu() {
    add_options_page(
        'McAfee落地页设置',
        'McAfee落地页',
        'manage_options',
        'mcafee-landing-settings',
        'mcafee_landing_settings_page'
    );
}
add_action('admin_menu', 'mcafee_landing_settings_menu');

function mcafee_landing_settings_page() {
    // 保存设置
    if (isset($_POST['mcafee_landing_settings_submit'])) {
        check_admin_referer('mcafee_landing_settings');
        
        update_option('mcafee_ga_tracking_id', sanitize_text_field($_POST['ga_tracking_id'] ?? ''));
        update_option('mcafee_fb_pixel_id', sanitize_text_field($_POST['fb_pixel_id'] ?? ''));
        
        echo '<div class="notice notice-success"><p>设置已保存！</p></div>';
    }
    
    $ga_tracking_id = get_option('mcafee_ga_tracking_id', '');
    $fb_pixel_id = get_option('mcafee_fb_pixel_id', '');
    
    ?>
    <div class="wrap">
        <h1>🛡️ McAfee落地页设置</h1>
        
        <form method="post" action="">
            <?php wp_nonce_field('mcafee_landing_settings'); ?>
            
            <table class="form-table">
                <tr>
                    <th scope="row">
                        <label for="ga_tracking_id">Google Analytics跟踪ID</label>
                    </th>
                    <td>
                        <input type="text" id="ga_tracking_id" name="ga_tracking_id" 
                               value="<?php echo esc_attr($ga_tracking_id); ?>" 
                               class="regular-text" placeholder="G-XXXXXXXXXX">
                        <p class="description">输入您的Google Analytics 4跟踪ID</p>
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        <label for="fb_pixel_id">Facebook Pixel ID</label>
                    </th>
                    <td>
                        <input type="text" id="fb_pixel_id" name="fb_pixel_id" 
                               value="<?php echo esc_attr($fb_pixel_id); ?>" 
                               class="regular-text" placeholder="123456789012345">
                        <p class="description">输入您的Facebook Pixel ID</p>
                    </td>
                </tr>
            </table>
            
            <p class="submit">
                <input type="submit" name="mcafee_landing_settings_submit" 
                       class="button button-primary" value="保存设置">
            </p>
        </form>
    </div>
    <?php
}

