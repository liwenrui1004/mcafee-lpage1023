<?php
/**
 * Main Template File
 * 
 * 当没有找到更具体的模板时，此文件作为默认模板
 * 对于McAfee落地页主题，建议始终使用page-mcafee-landing.php模板
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
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", "Noto Sans SC", sans-serif;
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
        欢迎来到专业的网络安全产品评测中心！<br>
        请创建一个新页面并使用"<strong>McAfee Landing Page</strong>"模板来查看完整的落地页内容。
    </p>
    
    <div class="features">
        <div class="feature-card">
            <div class="feature-icon">⚡</div>
            <div class="feature-title">高转化率设计</div>
            <div class="feature-text">焦虑营销 + 解决方案双结构</div>
        </div>
        
        <div class="feature-card">
            <div class="feature-icon">📊</div>
            <div class="feature-title">完整数据追踪</div>
            <div class="feature-text">GA4 + Facebook Pixel</div>
        </div>
        
        <div class="feature-card">
            <div class="feature-icon">📱</div>
            <div class="feature-title">响应式设计</div>
            <div class="feature-text">完美适配所有设备</div>
        </div>
        
        <div class="feature-card">
            <div class="feature-icon">🔒</div>
            <div class="feature-title">GDPR合规</div>
            <div class="feature-text">内置Cookie管理系统</div>
        </div>
    </div>
    
    <div>
        <a href="<?php echo admin_url('post-new.php?post_type=page'); ?>" class="cta-button">
            📝 创建落地页
        </a>
        <a href="<?php echo admin_url('themes.php'); ?>" class="cta-button secondary">
            🎨 主题设置
        </a>
    </div>
    
    <div class="instructions">
        <h3>📖 快速开始指南</h3>
        <ol>
            <li>进入 <strong>页面 → 新建页面</strong></li>
            <li>输入页面标题，例如："McAfee安全产品推荐"</li>
            <li>在右侧找到 <strong>页面属性 → 模板</strong></li>
            <li>选择 <strong>McAfee Landing Page</strong> 模板</li>
            <li>点击"发布"按钮</li>
            <li>访问该页面查看完整的落地页效果！</li>
        </ol>
        
        <p style="margin-top: 1.5rem; padding-top: 1.5rem; border-top: 1px solid #e2e8f0; color: #64748b;">
            💡 <strong>提示：</strong>创建页面后，您可以在右侧的"联盟链接设置"框中配置McAfee、Norton和Bitdefender的联盟链接。
        </p>
    </div>
    
    <div style="margin-top: 2rem; padding-top: 2rem; border-top: 1px solid #e2e8f0; color: #94a3b8; font-size: 0.9rem;">
        <p>需要帮助？查看主题目录下的 <code>README.md</code> 和 <code>INSTALLATION-GUIDE.md</code></p>
        <p style="margin-top: 0.5rem;">&copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?>. 保留所有权利.</p>
    </div>
</div>

<?php wp_footer(); ?>

</body>
</html>

