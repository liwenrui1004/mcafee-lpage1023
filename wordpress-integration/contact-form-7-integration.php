<?php
/**
 * Contact Form 7 Integration for McAfee Landing Page
 * 
 * 此文件提供Contact Form 7表单的快速集成代码
 * 
 * 使用说明:
 * 1. 安装并激活Contact Form 7插件
 * 2. 创建下面的表单
 * 3. 将生成的短代码替换到落地页模板中
 */

// 阻止直接访问
if (!defined('ABSPATH')) {
    exit;
}

/**
 * ============================================
 * Contact Form 7 表单配置
 * ============================================
 * 
 * 在WordPress后台 → 联系表单 → 新建表单
 * 将以下代码粘贴到"表单"标签中
 */

/*
============================================
表单HTML代码（复制到Contact Form 7）
============================================

<div class="mcafee-contact-form">
    <div class="form-row">
        <div class="form-group">
            <label for="your-name">您的姓名 *</label>
            [text* your-name id:your-name class:form-control placeholder "请输入您的姓名"]
        </div>
    </div>

    <div class="form-row">
        <div class="form-group">
            <label for="your-email">邮箱地址 *</label>
            [email* your-email id:your-email class:form-control placeholder "example@email.com"]
        </div>
    </div>

    <div class="form-row">
        <div class="form-group">
            <label for="your-phone">联系电话</label>
            [tel your-phone id:your-phone class:form-control placeholder "请输入您的电话号码"]
        </div>
    </div>

    <div class="form-row">
        <div class="form-group">
            <label for="product-interest">感兴趣的产品 *</label>
            [select* product-interest id:product-interest class:form-control "McAfee Total Protection" "McAfee LiveSafe" "McAfee AntiVirus Plus" "Norton 360 Deluxe" "Bitdefender Total Security"]
        </div>
    </div>

    <div class="form-row">
        <div class="form-group">
            <label for="your-message">您的问题或需求 *</label>
            [textarea* your-message id:your-message class:form-control placeholder "请详细描述您的问题或需求..." rows:5]
        </div>
    </div>

    <div class="form-row">
        <div class="form-group">
            [acceptance acceptance-terms class:form-checkbox] 我已阅读并同意 <a href="/privacy-policy" target="_blank">隐私政策</a> 和 <a href="/terms-of-service" target="_blank">使用条款</a>
        </div>
    </div>

    <div class="form-row">
        <div class="form-group">
            [acceptance newsletter class:form-checkbox] 订阅安全资讯邮件（每周最多1封）
        </div>
    </div>

    <div class="form-row">
        [submit class:cta-button "立即获取免费咨询 →"]
    </div>
</div>

============================================
邮件模板配置（复制到"邮件"标签）
============================================

--- 发送给管理员的邮件 ---

收件人: admin@yoursite.com
发件人: [your-name] <[your-email]>
主题: 新的McAfee产品咨询 - [product-interest]

邮件正文:
您收到一条来自McAfee落地页的新咨询

【联系信息】
姓名: [your-name]
邮箱: [your-email]
电话: [your-phone]
感兴趣的产品: [product-interest]

【咨询内容】
[your-message]

【其他信息】
订阅邮件: [newsletter]
提交时间: [_date] [_time]
IP地址: [_remote_ip]
页面URL: [_url]

---

--- 发送给用户的自动回复 ---

收件人: [your-email]
发件人: 网络安全评测中心 <noreply@yoursite.com>
主题: 感谢咨询！我们会尽快回复您

邮件正文:
亲爱的 [your-name]，

感谢您对我们推荐的 [product-interest] 感兴趣！

我们已收到您的咨询：
"[your-message]"

我们的安全专家会在24小时内通过邮箱 [your-email] 联系您。

在等待期间，您可以：
• 查看完整的产品对比: https://yoursite.com/compare
• 阅读安全防护指南: https://yoursite.com/guide
• 了解最新威胁情报: https://yoursite.com/threats

如有紧急问题，请拨打客服热线：400-XXX-XXXX

祝您生活愉快！

网络安全评测中心
https://yoursite.com

---

============================================
消息提示配置（复制到"消息"标签）
============================================

提交成功: 
✓ 感谢您的咨询！我们会在24小时内回复您。请查收确认邮件。

提交失败: 
✗ 提交失败，请稍后重试。如持续出现问题，请直接拨打客服热线。

验证失败: 
⚠ 请检查标记为红色的必填字段。

垃圾邮件: 
⚠ 您的提交被识别为垃圾信息。如有误判，请联系我们。

邮件发送失败: 
✗ 邮件发送失败。请检查邮箱地址是否正确。

*/

/**
 * ============================================
 * 自定义CSS样式（添加到functions.php）
 * ============================================
 */
function mcafee_cf7_custom_styles() {
    if (is_page_template('page-mcafee-landing.php')) {
        ?>
        <style>
            /* Contact Form 7 自定义样式 */
            .mcafee-contact-form {
                max-width: 600px;
                margin: 0 auto;
            }

            .mcafee-contact-form .form-row {
                margin-bottom: 1.5rem;
            }

            .mcafee-contact-form .form-group {
                display: flex;
                flex-direction: column;
            }

            .mcafee-contact-form label {
                font-weight: 600;
                margin-bottom: 0.5rem;
                color: var(--text-dark);
                font-size: 0.95rem;
            }

            .mcafee-contact-form .form-control {
                width: 100%;
                padding: 0.75rem 1rem;
                border: 2px solid #e2e8f0;
                border-radius: 8px;
                font-size: 1rem;
                transition: all 0.3s ease;
                font-family: inherit;
            }

            .mcafee-contact-form .form-control:focus {
                outline: none;
                border-color: #dc2626;
                box-shadow: 0 0 0 3px rgba(220, 38, 38, 0.1);
            }

            .mcafee-contact-form textarea.form-control {
                resize: vertical;
                min-height: 120px;
            }

            .mcafee-contact-form .form-checkbox {
                display: flex;
                align-items: flex-start;
                gap: 0.5rem;
                font-size: 0.9rem;
                line-height: 1.6;
            }

            .mcafee-contact-form .form-checkbox input[type="checkbox"] {
                margin-top: 0.25rem;
                width: 18px;
                height: 18px;
                cursor: pointer;
            }

            .mcafee-contact-form .cta-button {
                width: 100%;
                padding: 1rem 2rem;
                background: var(--gradient-danger);
                color: white;
                border: none;
                border-radius: 12px;
                font-size: 1.1rem;
                font-weight: bold;
                cursor: pointer;
                transition: all 0.3s ease;
                box-shadow: 0 4px 15px rgba(220, 38, 38, 0.3);
            }

            .mcafee-contact-form .cta-button:hover {
                transform: translateY(-2px);
                box-shadow: 0 6px 20px rgba(220, 38, 38, 0.4);
            }

            /* 错误样式 */
            .mcafee-contact-form .wpcf7-not-valid {
                border-color: #dc2626 !important;
                background-color: rgba(220, 38, 38, 0.05);
            }

            .mcafee-contact-form .wpcf7-not-valid-tip {
                color: #dc2626;
                font-size: 0.85rem;
                margin-top: 0.25rem;
            }

            /* 成功/失败消息 */
            .wpcf7-response-output {
                margin: 1.5rem 0;
                padding: 1rem 1.5rem;
                border-radius: 8px;
                border: none !important;
                font-size: 1rem;
            }

            .wpcf7-mail-sent-ok {
                background: #d1fae5;
                color: #065f46;
            }

            .wpcf7-mail-sent-ng,
            .wpcf7-validation-errors {
                background: #fee2e2;
                color: #991b1b;
            }

            /* 加载动画 */
            .wpcf7 form.submitting .cta-button {
                opacity: 0.7;
                cursor: not-allowed;
            }

            .wpcf7 form.submitting .cta-button::after {
                content: '';
                display: inline-block;
                width: 16px;
                height: 16px;
                margin-left: 10px;
                border: 2px solid white;
                border-top-color: transparent;
                border-radius: 50%;
                animation: spin 0.6s linear infinite;
            }

            @keyframes spin {
                to { transform: rotate(360deg); }
            }

            /* 响应式 */
            @media (max-width: 768px) {
                .mcafee-contact-form {
                    padding: 0 1rem;
                }
            }
        </style>
        <?php
    }
}
add_action('wp_head', 'mcafee_cf7_custom_styles');

/**
 * ============================================
 * Contact Form 7 钩子和自定义功能
 * ============================================
 */

/**
 * 保存提交数据到自定义数据库表
 */
function mcafee_cf7_save_to_database($contact_form) {
    $submission = WPCF7_Submission::get_instance();

    if ($submission) {
        $posted_data = $submission->get_posted_data();
        
        global $wpdb;
        $table_name = $wpdb->prefix . 'mcafee_leads';
        
        $wpdb->insert(
            $table_name,
            array(
                'name' => sanitize_text_field($posted_data['your-name'] ?? ''),
                'email' => sanitize_email($posted_data['your-email'] ?? ''),
                'message' => sanitize_textarea_field($posted_data['your-message'] ?? ''),
                'submitted_at' => current_time('mysql'),
                'ip_address' => $_SERVER['REMOTE_ADDR'] ?? '',
                'product_interest' => sanitize_text_field($posted_data['product-interest'] ?? ''),
                'phone' => sanitize_text_field($posted_data['your-phone'] ?? ''),
            ),
            array('%s', '%s', '%s', '%s', '%s', '%s', '%s')
        );
    }
}
add_action('wpcf7_before_send_mail', 'mcafee_cf7_save_to_database');

/**
 * 添加自定义字段到数据库表
 */
function mcafee_update_leads_table() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'mcafee_leads';
    
    // 检查表是否存在
    if ($wpdb->get_var("SHOW TABLES LIKE '$table_name'") != $table_name) {
        return;
    }
    
    // 检查并添加新列
    $columns = $wpdb->get_col("DESC {$table_name}", 0);
    
    if (!in_array('product_interest', $columns)) {
        $wpdb->query("ALTER TABLE {$table_name} ADD product_interest VARCHAR(100) AFTER message");
    }
    
    if (!in_array('phone', $columns)) {
        $wpdb->query("ALTER TABLE {$table_name} ADD phone VARCHAR(20) AFTER product_interest");
    }
}
add_action('admin_init', 'mcafee_update_leads_table');

/**
 * 添加Google Analytics转化追踪
 */
function mcafee_cf7_add_ga_tracking() {
    if (is_page_template('page-mcafee-landing.php')) {
        ?>
        <script>
        document.addEventListener('wpcf7mailsent', function(event) {
            // Google Analytics 4
            if (typeof gtag !== 'undefined') {
                gtag('event', 'form_submit', {
                    'event_category': 'lead_generation',
                    'event_label': 'mcafee_contact_form',
                    'value': 1
                });
            }
            
            // Facebook Pixel
            if (typeof fbq !== 'undefined') {
                fbq('track', 'Lead', {
                    content_name: 'McAfee Contact Form'
                });
            }
            
            // 可选：显示自定义感谢消息
            console.log('表单提交成功！转化事件已发送。');
        }, false);
        </script>
        <?php
    }
}
add_action('wp_footer', 'mcafee_cf7_add_ga_tracking');

/**
 * 自定义验证规则
 */
function mcafee_cf7_custom_validation($result, $tag) {
    $tag = new WPCF7_Shortcode($tag);
    
    // 验证电话号码格式（中国手机号）
    if ('your-phone' == $tag->name) {
        $phone = isset($_POST['your-phone']) ? trim($_POST['your-phone']) : '';
        
        if (!empty($phone) && !preg_match('/^1[3-9]\d{9}$/', $phone)) {
            $result->invalidate($tag, '请输入有效的中国大陆手机号码');
        }
    }
    
    return $result;
}
add_filter('wpcf7_validate_tel', 'mcafee_cf7_custom_validation', 10, 2);
add_filter('wpcf7_validate_tel*', 'mcafee_cf7_custom_validation', 10, 2);

/**
 * 垃圾邮件防护 - 蜜罐字段
 */
function mcafee_cf7_spam_protection($spam) {
    if ($spam) {
        return $spam;
    }
    
    $submission = WPCF7_Submission::get_instance();
    
    if ($submission) {
        $posted_data = $submission->get_posted_data();
        
        // 检查隐藏的蜜罐字段（需要在表单中添加）
        if (!empty($posted_data['honeypot'])) {
            $spam = true;
        }
        
        // 检查提交时间（太快可能是机器人）
        if (isset($posted_data['form_load_time'])) {
            $load_time = intval($posted_data['form_load_time']);
            $submit_time = time();
            
            if (($submit_time - $load_time) < 3) {
                $spam = true; // 3秒内提交视为机器人
            }
        }
    }
    
    return $spam;
}
add_filter('wpcf7_spam', 'mcafee_cf7_spam_protection');

/**
 * 邮件发送失败时记录日志
 */
function mcafee_cf7_mail_failed($contact_form) {
    $submission = WPCF7_Submission::get_instance();
    
    if ($submission) {
        $posted_data = $submission->get_posted_data();
        
        error_log(sprintf(
            'CF7邮件发送失败 - 姓名: %s, 邮箱: %s, 时间: %s',
            $posted_data['your-name'] ?? 'N/A',
            $posted_data['your-email'] ?? 'N/A',
            current_time('mysql')
        ));
    }
}
add_action('wpcf7_mail_failed', 'mcafee_cf7_mail_failed');

/**
 * 重定向到感谢页面（可选）
 */
function mcafee_cf7_thank_you_redirect() {
    ?>
    <script>
    document.addEventListener('wpcf7mailsent', function(event) {
        // 延迟2秒后跳转到感谢页面
        setTimeout(function() {
            location = '<?php echo home_url('/thank-you'); ?>';
        }, 2000);
    }, false);
    </script>
    <?php
}
// 取消注释以启用重定向
// add_action('wp_footer', 'mcafee_cf7_thank_you_redirect');

/**
 * ============================================
 * 使用说明
 * ============================================
 * 
 * 1. 安装Contact Form 7插件
 * 2. 在WordPress后台创建新表单，使用上面的表单HTML代码
 * 3. 配置邮件模板和消息
 * 4. 复制生成的短代码，例如: [contact-form-7 id="123" title="McAfee咨询表单"]
 * 5. 在page-mcafee-landing.php模板中添加短代码
 * 
 * 添加方式:
 * <?php echo do_shortcode('[contact-form-7 id="123" title="McAfee咨询表单"]'); ?>
 * 
 * 或直接在HTML中:
 * [contact-form-7 id="123" title="McAfee咨询表单"]
 */

