<?php
/**
 * Template Name: McAfee Landing Page
 * Description: McAfee安全产品落地页模板
 * 
 * 使用说明：
 * 1. 将此文件放在您的WordPress主题目录下
 * 2. 在WordPress后台创建新页面
 * 3. 在页面属性中选择"McAfee Landing Page"模板
 * 4. 发布页面
 */

// 阻止直接访问
if (!defined('ABSPATH')) {
    exit;
}

// 获取头部（但不输出默认的header.php）
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="你的数字生活正在被24小时监控 - 立即获取顶级安全防护方案">
    <title><?php wp_title('|', true, 'right'); bloginfo('name'); ?></title>
    
    <?php wp_head(); // WordPress必需的头部钩子 ?>
    
    <style>
        /* ============================================
           CSS 变量系统
        ============================================ */
        :root {
            /* 焦虑色系 */
            --danger-red: #dc2626;
            --danger-dark: #991b1b;
            --warning-orange: #f97316;
            --dark-bg: #0f1419;
            --dark-secondary: #1a1f2e;
            
            /* 希望色系 */
            --success-green: #10b981;
            --primary-blue: #2563eb;
            --light-bg: #f8fafc;
            --light-secondary: #f1f5f9;
            
            /* 中性色 */
            --text-dark: #1e293b;
            --text-light: #e2e8f0;
            --text-muted: #64748b;
            
            /* 渐变 */
            --gradient-danger: linear-gradient(135deg, #dc2626 0%, #991b1b 100%);
            --gradient-success: linear-gradient(135deg, #10b981 0%, #059669 100%);
            --gradient-primary: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%);
            
            /* 间距 */
            --spacing-xs: 0.5rem;
            --spacing-sm: 1rem;
            --spacing-md: 2rem;
            --spacing-lg: 4rem;
            --spacing-xl: 6rem;
            
            /* 其他颜色 */
            --secondary-color: #1a1f2e;
            
            /* 字体 */
            --font-system: -apple-system, BlinkMacSystemFont, "Segoe UI", "Noto Sans SC", sans-serif;
        }

        /* ============================================
           全局重置
        ============================================ */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            font-family: var(--font-system);
            line-height: 1.6;
            overflow-x: hidden;
        }

        /* ============================================
           屏幕容器基础
        ============================================ */
        .screen {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: var(--spacing-md);
            position: relative;
        }

        .container {
            max-width: 1200px;
            width: 100%;
            margin: 0 auto;
        }

        /* 注意：此处省略了大量CSS代码以保持文件可读性 */
        /* 完整CSS请从原HTML文件的<style>标签中复制 */
        /* 或使用下面的方式加载外部CSS文件 */
    </style>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); // WordPress 5.2+ 必需 ?>

<!-- ============================================
     内容区域 - 从原HTML复制所有内容
============================================ -->

<!-- 首屏：焦虑制造 -->
<section id="anxiety" class="screen screen-anxiety">
    <div class="container">
        <!-- 破碎盾牌图标 -->
        <div class="broken-shield">
            <svg viewBox="0 0 100 120" xmlns="http://www.w3.org/2000/svg">
                <!-- 盾牌主体 -->
                <path d="M50 10 L90 25 L90 55 Q90 85 50 110 Q10 85 10 55 L10 25 Z" 
                      fill="none" 
                      stroke="#dc2626" 
                      stroke-width="3"
                      stroke-dasharray="5,5"/>
                
                <!-- 裂缝效果 -->
                <path d="M50 20 L55 50 L45 80" 
                      stroke="#dc2626" 
                      stroke-width="2.5"
                      stroke-linecap="round"/>
                <path d="M30 40 L50 50 L70 45" 
                      stroke="#dc2626" 
                      stroke-width="2"
                      stroke-linecap="round"/>
                
                <!-- X 标记 -->
                <line x1="35" y1="45" x2="65" y2="75" 
                      stroke="#dc2626" 
                      stroke-width="4"
                      stroke-linecap="round"/>
                <line x1="65" y1="45" x2="35" y2="75" 
                      stroke="#dc2626" 
                      stroke-width="4"
                      stroke-linecap="round"/>
            </svg>
        </div>

        <h1 class="anxiety-title">
            <span class="text-danger">你的数据正在被监控</span><br>
            <span class="text-highlight">每秒39次网络攻击正在发生</span>
        </h1>

        <div class="anxiety-stats">
            <div class="stat-item">
                <div class="stat-number" data-target="2456789">0</div>
                <div class="stat-label">今日已发生攻击次数</div>
            </div>
            <div class="stat-item">
                <div class="stat-number" data-target="156789">0</div>
                <div class="stat-label">设备正面临风险</div>
            </div>
            <div class="stat-item">
                <div class="stat-number" data-target="890123">0</div>
                <div class="stat-label">个人信息已泄露</div>
            </div>
        </div>

        <div class="warning-box">
            <div class="warning-icon">⚠️</div>
            <div>
                <div class="warning-title">您的设备可能已被攻击</div>
                <div class="warning-text">
                    最新研究表明：<strong>73%的家庭设备</strong>存在安全漏洞，
                    <strong>平均每台设备有9.7个未修复的高危漏洞</strong>
                </div>
            </div>
        </div>

        <a href="#solution" class="cta-button pulse-animation">
            立即获取保护方案 →
        </a>

        <div class="social-proof">
            ⭐⭐⭐⭐⭐ 已有 <strong>2,458,932</strong> 用户选择信赖
        </div>
    </div>
</section>

<!-- 注意：这里省略了大量HTML内容 -->
<!-- 请从原landing-page-v2-anxiety-marketing.html文件复制所有section -->
<!-- 包括：威胁展示、解决方案、产品对比、价格表、FAQ、页脚等 -->

<!-- 示例：解决方案区域的开始 -->
<section id="solution" class="screen screen-solution">
    <div class="container">
        <h2 class="section-title">
            <span class="text-success">✓</span> 顶级安全专家推荐的解决方案
        </h2>
        <!-- ... 继续复制原内容 ... -->
    </div>
</section>

<!-- ============================================
     页脚
============================================ -->
<footer style="background: var(--dark-bg); color: var(--text-light); padding: var(--spacing-lg) var(--spacing-md);">
    <div class="container">
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: var(--spacing-md); margin-bottom: var(--spacing-lg);">
            <!-- 品牌信息 -->
            <div>
                <h3 style="color: var(--danger-red); margin-bottom: var(--spacing-sm); font-size: 1.5rem;">
                    🛡️ 网络安全评测中心
                </h3>
                <p style="color: rgba(255,255,255,0.8); line-height: 1.8; font-size: 0.95rem;">
                    我们致力于为用户提供专业、客观的网络安全产品评测和推荐，帮助您在数字时代保护个人隐私和数据安全。
                </p>
            </div>

            <!-- 快速链接 -->
            <div>
                <h4 style="margin-bottom: var(--spacing-sm); color: white;">快速链接</h4>
                <ul style="list-style: none; line-height: 2;">
                    <li><a href="<?php echo esc_url(home_url('/about')); ?>" style="color: rgba(255,255,255,0.8); text-decoration: none; transition: color 0.3s;" onmouseover="this.style.color='white'" onmouseout="this.style.color='rgba(255,255,255,0.8)'">关于我们</a></li>
                    <li><a href="<?php echo esc_url(home_url('/reviews')); ?>" style="color: rgba(255,255,255,0.8); text-decoration: none; transition: color 0.3s;" onmouseover="this.style.color='white'" onmouseout="this.style.color='rgba(255,255,255,0.8)'">产品评测</a></li>
                    <li><a href="<?php echo esc_url(home_url('/blog')); ?>" style="color: rgba(255,255,255,0.8); text-decoration: none; transition: color 0.3s;" onmouseover="this.style.color='white'" onmouseout="this.style.color='rgba(255,255,255,0.8)'">安全博客</a></li>
                    <li><a href="<?php echo esc_url(home_url('/contact')); ?>" style="color: rgba(255,255,255,0.8); text-decoration: none; transition: color 0.3s;" onmouseover="this.style.color='white'" onmouseout="this.style.color='rgba(255,255,255,0.8)'">联系我们</a></li>
                </ul>
            </div>

            <!-- 法律信息 -->
            <div>
                <h4 style="margin-bottom: var(--spacing-sm); color: white;">法律信息</h4>
                <ul style="list-style: none; line-height: 2;">
                    <li><a href="<?php echo esc_url(home_url('/privacy-policy')); ?>" style="color: rgba(255,255,255,0.8); text-decoration: none; transition: color 0.3s;" onmouseover="this.style.color='white'" onmouseout="this.style.color='rgba(255,255,255,0.8)'">隐私政策</a></li>
                    <li><a href="<?php echo esc_url(home_url('/terms-of-service')); ?>" style="color: rgba(255,255,255,0.8); text-decoration: none; transition: color 0.3s;" onmouseover="this.style.color='white'" onmouseout="this.style.color='rgba(255,255,255,0.8)'">使用条款</a></li>
                    <li><a href="<?php echo esc_url(home_url('/affiliate-disclosure')); ?>" style="color: rgba(255,255,255,0.8); text-decoration: none; transition: color 0.3s;" onmouseover="this.style.color='white'" onmouseout="this.style.color='rgba(255,255,255,0.8)'">联盟披露</a></li>
                    <li><a href="<?php echo esc_url(home_url('/cookie-policy')); ?>" style="color: rgba(255,255,255,0.8); text-decoration: none; transition: color 0.3s;" onmouseover="this.style.color='white'" onmouseout="this.style.color='rgba(255,255,255,0.8)'">Cookie政策</a></li>
                </ul>
            </div>

            <!-- 联系方式 -->
            <div>
                <h4 style="margin-bottom: var(--spacing-sm); color: white;">联系我们</h4>
                <ul style="list-style: none; line-height: 2;">
                    <li style="color: rgba(255,255,255,0.8);">📧 Email: <?php echo antispambot('support@example.com'); ?></li>
                    <li style="color: rgba(255,255,255,0.8);">📱 客服热线: 400-XXX-XXXX</li>
                    <li style="color: rgba(255,255,255,0.8);">🕐 工作时间: 9:00-18:00 (工作日)</li>
                </ul>
            </div>
        </div>

        <!-- 页脚底部 -->
        <div style="border-top: 1px solid rgba(255,255,255,0.1); padding-top: var(--spacing-md); text-align: center; color: rgba(255,255,255,0.7); font-size: 0.9rem;">
            <p>&copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?>. 保留所有权利.</p>
            <p style="margin-top: 0.5rem; font-size: 0.85rem;">
                本网站包含联盟链接。通过推荐链接购买产品我们可能获得佣金，但不会增加您的成本。
            </p>
        </div>
    </div>
</footer>

<!-- ============================================
     JavaScript代码
============================================ -->
<script>
    // 从原HTML文件复制所有JavaScript代码
    // 包括：数字动画、Cookie管理、表单验证等
    
    // 数字滚动动画
    function animateNumbers() {
        const counters = document.querySelectorAll('.stat-number');
        counters.forEach(counter => {
            const target = parseInt(counter.getAttribute('data-target'));
            const duration = 2000;
            const step = target / (duration / 16);
            let current = 0;

            const timer = setInterval(() => {
                current += step;
                if (current >= target) {
                    counter.textContent = target.toLocaleString();
                    clearInterval(timer);
                } else {
                    counter.textContent = Math.floor(current).toLocaleString();
                }
            }, 16);
        });
    }

    // 当页面加载时执行动画
    window.addEventListener('load', animateNumbers);

    // Cookie管理代码
    // ... 从原HTML复制所有Cookie相关函数 ...
</script>

<?php wp_footer(); // WordPress必需的页脚钩子 ?>

</body>
</html>

