# 页面模板设置指南

本指南说明如何在 WordPress 中设置新创建的三个页面模板。

## 📄 创建的页面模板

我们为页眉链接创建了以下三个独立的 WordPress 页面模板：

1. **About Us** (`page-about.php`) - 关于我们页面
2. **Contact Us** (`page-contact.php`) - 联系我们页面
3. **Privacy Policy** (`page-privacy-policy.php`) - 隐私政策页面

---

## 🚀 安装步骤

### 第一步：上传文件到 WordPress 主题

将以下文件上传到你的 WordPress 主题目录：

```
/wp-content/themes/你的主题名称/
├── page-about.php
├── page-contact.php
├── page-privacy-policy.php
└── page-mcafee-landing.php (已存在)
```

### 第二步：在 WordPress 后台创建页面

#### 1. 创建 About Us 页面

1. 登录 WordPress 后台
2. 进入 **页面 > 新建页面**
3. 页面标题输入：`About Us`
4. 在右侧 **页面属性** 中，选择模板：**About Us Page**
5. 设置 Slug（固定链接）为：`about`
6. 点击 **发布**

#### 2. 创建 Contact Us 页面

1. 进入 **页面 > 新建页面**
2. 页面标题输入：`Contact Us`
3. 在右侧 **页面属性** 中，选择模板：**Contact Us Page**
4. 设置 Slug（固定链接）为：`contact`
5. 点击 **发布**

#### 3. 创建 Privacy Policy 页面

1. 进入 **页面 > 新建页面**
2. 页面标题输入：`Privacy Policy`
3. 在右侧 **页面属性** 中，选择模板：**Privacy Policy Page**
4. 设置 Slug（固定链接）为：`privacy-policy`
5. 点击 **发布**

---

## 📋 页面功能说明

### 🏢 About Us (关于我们)

**功能特点：**
- 现代化的英雄区（Hero Section）设计
- 公司使命和愿景展示
- 6 个特色服务卡片：
  - 深度产品评测
  - 专业对比分析
  - 教育性内容
  - 持续更新
  - 公正客观
  - 社区支持
- 4 个核心价值展示（透明、卓越、信任、创新）
- 完全响应式设计

**自定义建议：**
- 修改公司名称和 Logo（第 248 行）
- 更新公司使命描述（第 260-267 行）
- 根据实际情况修改服务内容（第 271-310 行）

### 📧 Contact Us (联系我们)

**功能特点：**
- 功能完整的联系表单（带防护机制）
- 表单验证和 WordPress nonce 安全保护
- 自动发送邮件到网站管理员邮箱
- 成功/失败提示消息
- 联系信息卡片：
  - 电子邮件联系方式
  - 响应时间说明
  - 社交媒体链接
  - 在线聊天提示
- FAQ 部分（6 个常见问题）
- 完全响应式设计

**表单字段：**
- 姓名（必填）
- 邮箱（必填）
- 主题（下拉选择，必填）
- 消息内容（必填）

**自定义建议：**
- 修改联系邮箱（第 445-454 行）
- 更新社交媒体链接（第 467-472 行）
- 根据需要修改 FAQ 内容（第 481-509 行）

### 🔒 Privacy Policy (隐私政策)

**功能特点：**
- 专业的法律文档格式
- 目录导航（11 个章节）
- 详细的隐私条款说明：
  1. 介绍
  2. 收集的信息
  3. 信息使用方式
  4. Cookie 和追踪技术
  5. 第三方服务
  6. 联盟链接和广告
  7. 数据安全
  8. 用户权利（GDPR / CCPA）
  9. 儿童隐私
  10. 政策变更
  11. 联系方式
- 自动显示最后更新日期
- 响应式设计，易于阅读

**自定义建议：**
- 更新隐私联系邮箱（第 482、510 行）
- 根据实际业务修改数据收集和使用条款
- 如果不适用 GDPR/CCPA，可以删除相关章节

---

## 🎨 设计特点

所有三个页面都采用统一的设计风格：

- **配色方案：**
  - 主色：蓝色 (#2563eb)
  - 次色：深灰 (#1a1f2e)
  - 成功色：绿色 (#10b981)
  - 背景：浅灰 (#f8fafc)

- **响应式设计：**
  - 桌面端：完整布局
  - 平板端：自适应网格
  - 移动端：单列布局

- **用户体验：**
  - 流畅的过渡动画
  - 悬停效果
  - 清晰的视觉层次
  - 易于阅读的排版

---

## 🔗 页面链接设置

页面模板已经包含了正确的内部链接：

```php
// 页眉导航链接
home_url('/') - 首页
home_url('/about') - 关于我们
home_url('/contact') - 联系我们
home_url('/privacy-policy') - 隐私政策
```

这些链接会自动与你创建的页面 Slug 匹配。

---

## ⚙️ 配置建议

### 1. 邮件设置（Contact Us 页面）

确保 WordPress 邮件功能正常工作：

- 方案 A：使用 SMTP 插件（推荐）
  - 安装 "WP Mail SMTP" 或 "Easy WP SMTP"
  - 配置 SMTP 服务器（如 Gmail、SendGrid、Mailgun）

- 方案 B：使用主机提供的邮件服务
  - 确认主机支持 PHP mail() 函数
  - 测试邮件发送功能

### 2. 导航菜单设置

在 WordPress 后台：

1. 进入 **外观 > 菜单**
2. 创建新菜单或编辑现有菜单
3. 将创建的页面添加到菜单：
   - Home
   - About Us
   - Contact Us
   - Privacy Policy
4. 设置菜单位置（主菜单/页眉菜单）

### 3. 固定链接设置

确保 WordPress 使用友好的 URL 结构：

1. 进入 **设置 > 固定链接**
2. 选择 **文章名** 或 **自定义结构**
3. 保存更改

---

## 🧪 测试清单

创建页面后，请测试以下功能：

### About Us 页面
- [ ] 页面正确显示
- [ ] 所有卡片和内容可读
- [ ] 响应式布局正常
- [ ] 页眉和页脚链接正常工作

### Contact Us 页面
- [ ] 表单可以正常提交
- [ ] 表单验证正常工作
- [ ] 成功提交后显示确认消息
- [ ] 管理员收到邮件通知
- [ ] 所有必填字段验证正常

### Privacy Policy 页面
- [ ] 所有章节正确显示
- [ ] 目录锚点链接正常工作
- [ ] 日期自动更新
- [ ] 内容易于阅读

---

## 📝 自定义修改

### 修改网站名称和 Logo

在每个模板文件中找到：

```php
<a href="<?php echo esc_url(home_url('/')); ?>" class="site-logo">
    🛡️ Security Review
</a>
```

替换为你的网站名称或 Logo 图片：

```php
<a href="<?php echo esc_url(home_url('/')); ?>" class="site-logo">
    <img src="<?php echo get_template_directory_uri(); ?>/images/logo.png" alt="Your Site Name">
</a>
```

### 修改配色方案

在 `<style>` 标签中的 `:root` 部分修改 CSS 变量：

```css
:root {
    --primary-color: #2563eb;    /* 主色调 */
    --secondary-color: #1a1f2e;  /* 次色调 */
    --success-green: #10b981;    /* 成功色 */
    --text-dark: #1e293b;        /* 深色文本 */
    --text-muted: #64748b;       /* 浅色文本 */
}
```

### 修改联系邮箱

在 Contact Us 和 Privacy Policy 页面中查找：

```php
<?php echo antispambot('support@example.com'); ?>
```

替换为你的实际邮箱地址。

---

## 🆘 常见问题

### Q: 为什么看不到模板选项？
**A:** 确保文件已正确上传到主题目录，并刷新 WordPress 后台。

### Q: 联系表单不发送邮件？
**A:** 检查 WordPress 邮件设置，建议安装 SMTP 插件。

### Q: 如何修改页面内容？
**A:** 直接编辑对应的 PHP 模板文件，修改 HTML 内容部分。

### Q: 可以添加更多页面吗？
**A:** 可以！参考现有模板创建新的页面模板文件。

---

## 📚 相关文件

- `page-about.php` - About Us 页面模板
- `page-contact.php` - Contact Us 页面模板  
- `page-privacy-policy.php` - Privacy Policy 页面模板
- `page-mcafee-landing.php` - McAfee 落地页模板
- `START-HERE.md` - McAfee 落地页安装指南

---

## 💡 提示

1. **备份：** 在修改文件前，建议先备份原文件
2. **测试：** 在开发环境测试后再部署到生产环境
3. **SEO：** 考虑为每个页面添加 meta 描述和关键词
4. **性能：** 如果页面较多，考虑使用缓存插件
5. **安全：** 定期更新 WordPress 和所有插件

---

**创建日期：** 2025-10-22  
**版本：** 1.0  
**状态：** ✅ 完成

