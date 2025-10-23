# 🚀 网站部署指南

本指南将帮助你将 McAfee Landing Page 部署到你自己的服务器上。

## 📋 目录
- [准备工作](#准备工作)
- [方案一：使用传统Web服务器（推荐）](#方案一使用传统web服务器推荐)
- [方案二：使用静态网站托管](#方案二使用静态网站托管)
- [方案三：使用WordPress集成](#方案三使用wordpress集成)
- [域名配置](#域名配置)
- [SSL证书配置](#ssl证书配置)
- [性能优化建议](#性能优化建议)

---

## 📦 准备工作

### 1. 检查需要部署的文件

你的项目包含以下文件，都需要上传到服务器：

```
站点文件（必需）：
├── preview-english.html    # 主页
├── about.html             # 关于页面
├── contact.html           # 联系页面
└── privacy-policy.html    # 隐私政策页面

WordPress集成文件（可选）：
└── wordpress-integration/
    └── page-mcafee-landing.php
```

### 2. 服务器要求

**最低配置：**
- 任何支持静态HTML的Web服务器
- 10 MB 存储空间
- 支持 HTTPS（推荐）

**推荐配置：**
- Nginx 1.18+ 或 Apache 2.4+
- 至少 1 GB RAM
- SSL证书（Let's Encrypt免费）
- CDN（如 Cloudflare，可选但推荐）

---

## 🌐 方案一：使用传统Web服务器（推荐）

### A. 使用 Nginx（推荐）

#### 1. 安装 Nginx

**Ubuntu/Debian:**
```bash
sudo apt update
sudo apt install nginx -y
```

**CentOS/RHEL:**
```bash
sudo yum install nginx -y
```

#### 2. 上传文件到服务器

使用 SFTP/SCP 上传文件到服务器：

```bash
# 方法1: 使用 SCP
scp preview-english.html about.html contact.html privacy-policy.html \
    user@your-server.com:/var/www/html/

# 方法2: 使用 SFTP
sftp user@your-server.com
put preview-english.html
put about.html
put contact.html
put privacy-policy.html
```

或者使用 FTP 客户端（如 FileZilla）：
- 主机：your-server.com
- 端口：22（SFTP）
- 上传到：`/var/www/html/`

#### 3. 配置 Nginx

创建站点配置文件：

```bash
sudo nano /etc/nginx/sites-available/mcafee-landing
```

添加以下配置：

```nginx
server {
    listen 80;
    listen [::]:80;
    server_name yourdomain.com www.yourdomain.com;

    root /var/www/html;
    index preview-english.html index.html;

    # 日志文件
    access_log /var/log/nginx/mcafee-access.log;
    error_log /var/log/nginx/mcafee-error.log;

    # 主页路由
    location / {
        try_files $uri $uri/ =404;
    }

    # 设置主页为 preview-english.html
    location = / {
        rewrite ^ /preview-english.html permanent;
    }

    # Gzip 压缩
    gzip on;
    gzip_vary on;
    gzip_min_length 1024;
    gzip_types text/css text/javascript application/javascript text/html;

    # 缓存静态资源
    location ~* \.(html|css|js|jpg|jpeg|png|gif|ico|svg|woff|woff2)$ {
        expires 7d;
        add_header Cache-Control "public, immutable";
    }

    # 安全头部
    add_header X-Frame-Options "SAMEORIGIN" always;
    add_header X-Content-Type-Options "nosniff" always;
    add_header X-XSS-Protection "1; mode=block" always;
}
```

#### 4. 启用站点并重启 Nginx

```bash
# 创建符号链接启用站点
sudo ln -s /etc/nginx/sites-available/mcafee-landing /etc/nginx/sites-enabled/

# 测试配置
sudo nginx -t

# 重启 Nginx
sudo systemctl restart nginx

# 设置开机自启
sudo systemctl enable nginx
```

### B. 使用 Apache

#### 1. 安装 Apache

```bash
# Ubuntu/Debian
sudo apt install apache2 -y

# CentOS/RHEL
sudo yum install httpd -y
```

#### 2. 上传文件

```bash
# 上传到 Apache 默认目录
scp *.html user@your-server.com:/var/www/html/
```

#### 3. 配置 Apache

创建虚拟主机配置：

```bash
sudo nano /etc/apache2/sites-available/mcafee-landing.conf
```

添加配置：

```apache
<VirtualHost *:80>
    ServerName yourdomain.com
    ServerAlias www.yourdomain.com
    DocumentRoot /var/www/html

    DirectoryIndex preview-english.html index.html

    <Directory /var/www/html>
        Options -Indexes +FollowSymLinks
        AllowOverride All
        Require all granted
    </Directory>

    # 重写规则：主页指向 preview-english.html
    RewriteEngine On
    RewriteRule ^/?$ /preview-english.html [L]

    ErrorLog ${APACHE_LOG_DIR}/mcafee-error.log
    CustomLog ${APACHE_LOG_DIR}/mcafee-access.log combined
</VirtualHost>
```

#### 4. 启用站点

```bash
# 启用站点
sudo a2ensite mcafee-landing.conf

# 启用重写模块
sudo a2enmod rewrite

# 重启 Apache
sudo systemctl restart apache2

# 设置开机自启
sudo systemctl enable apache2
```

---

## ☁️ 方案二：使用静态网站托管

### A. Netlify（最简单，免费）

#### 1. 通过拖拽部署

1. 访问 [Netlify](https://www.netlify.com/)
2. 注册/登录账号
3. 将所有 HTML 文件打包成 ZIP
4. 拖拽 ZIP 文件到 Netlify Drop
5. 自动获得一个 `.netlify.app` 域名
6. 可以绑定自定义域名

#### 2. 通过 Netlify CLI

```bash
# 安装 Netlify CLI
npm install -g netlify-cli

# 登录
netlify login

# 初始化并部署
netlify init
netlify deploy --prod
```

### B. Vercel（免费，快速）

```bash
# 安装 Vercel CLI
npm install -g vercel

# 部署
vercel

# 绑定域名
vercel --prod
```

### C. GitHub Pages（免费）

1. 创建 GitHub 仓库
2. 上传所有 HTML 文件
3. 将 `preview-english.html` 重命名为 `index.html`
4. 在仓库设置中启用 GitHub Pages
5. 访问 `https://yourusername.github.io/repo-name/`

### D. Cloudflare Pages（免费，全球CDN）

1. 访问 [Cloudflare Pages](https://pages.cloudflare.com/)
2. 连接 Git 仓库或直接上传文件
3. 自动部署并获得全球 CDN
4. 免费 SSL 和 DDoS 防护

---

## 🔧 方案三：使用WordPress集成

如果你的服务器已经运行 WordPress：

### 1. 上传 PHP 文件

```bash
# 上传到 WordPress 主题目录
scp wordpress-integration/page-mcafee-landing.php \
    user@server:/var/www/html/wp-content/themes/your-theme/
```

### 2. 在 WordPress 中创建页面

1. 登录 WordPress 管理后台
2. 创建新页面
3. 在页面属性中选择模板："McAfee Landing Page"
4. 发布页面

### 3. 设置固定链接

在 WordPress 设置 → 固定链接中，选择"文章名"或自定义结构。

---

## 🌍 域名配置

### 1. DNS 记录配置

登录你的域名注册商（如 GoDaddy, Namecheap, 阿里云等），添加以下 DNS 记录：

**A 记录（指向服务器IP）：**
```
类型: A
主机: @
值: 你的服务器IP地址
TTL: 3600
```

**WWW 子域名：**
```
类型: A 或 CNAME
主机: www
值: 你的服务器IP 或 yourdomain.com
TTL: 3600
```

### 2. 等待 DNS 传播

DNS 更改通常需要 1-48 小时传播，可以使用以下工具检查：
- https://www.whatsmydns.net/
- `nslookup yourdomain.com`
- `dig yourdomain.com`

---

## 🔒 SSL证书配置

### 使用 Let's Encrypt（免费，推荐）

#### 1. 安装 Certbot

```bash
# Ubuntu/Debian
sudo apt install certbot python3-certbot-nginx -y

# CentOS/RHEL
sudo yum install certbot python3-certbot-nginx -y
```

#### 2. 获取证书

**Nginx:**
```bash
sudo certbot --nginx -d yourdomain.com -d www.yourdomain.com
```

**Apache:**
```bash
sudo certbot --apache -d yourdomain.com -d www.yourdomain.com
```

#### 3. 自动续期

```bash
# 测试自动续期
sudo certbot renew --dry-run

# Certbot 会自动创建 cron job 进行续期
```

### 使用 Cloudflare SSL（最简单）

如果使用 Cloudflare 作为 DNS：
1. 登录 Cloudflare
2. 选择你的域名
3. 点击 SSL/TLS
4. 选择 "Full" 或 "Full (strict)"
5. 自动获得免费 SSL 证书

---

## ⚡ 性能优化建议

### 1. 启用 Gzip 压缩

**Nginx:**
```nginx
gzip on;
gzip_vary on;
gzip_min_length 1024;
gzip_types text/css text/javascript application/javascript text/html;
```

**Apache:**
```apache
<IfModule mod_deflate.c>
    AddOutputFilterByType DEFLATE text/html text/css text/javascript application/javascript
</IfModule>
```

### 2. 设置浏览器缓存

**Nginx:**
```nginx
location ~* \.(html|css|js|jpg|jpeg|png|gif|ico)$ {
    expires 7d;
    add_header Cache-Control "public, immutable";
}
```

**Apache (.htaccess):**
```apache
<IfModule mod_expires.c>
    ExpiresActive On
    ExpiresByType text/html "access plus 1 day"
    ExpiresByType text/css "access plus 7 days"
    ExpiresByType application/javascript "access plus 7 days"
    ExpiresByType image/jpeg "access plus 30 days"
    ExpiresByType image/png "access plus 30 days"
</IfModule>
```

### 3. 使用 CDN（内容分发网络）

#### Cloudflare（推荐，免费）
1. 注册 Cloudflare 账号
2. 添加你的网站
3. 更新域名 NS 记录指向 Cloudflare
4. 启用 CDN 和缓存
5. 免费获得：
   - 全球 CDN
   - DDoS 防护
   - 自动 SSL
   - 缓存优化

### 4. 优化图片（如果后续添加）

```bash
# 安装图片优化工具
sudo apt install optipng jpegoptim

# 优化 PNG
optipng -o7 *.png

# 优化 JPEG
jpegoptim --strip-all --max=85 *.jpg
```

### 5. HTTP/2 支持

**Nginx（需要 SSL）:**
```nginx
listen 443 ssl http2;
listen [::]:443 ssl http2;
```

---

## 🔍 部署检查清单

部署完成后，检查以下项目：

- [ ] 所有 HTML 文件已上传
- [ ] 主页（preview-english.html）可以访问
- [ ] 所有内部链接正常工作（About, Contact, Privacy）
- [ ] 页眉和页脚链接正常
- [ ] 表单提交功能正常（如果需要后端处理）
- [ ] 移动端响应式设计正常
- [ ] SSL 证书已安装并生效
- [ ] HTTP 自动重定向到 HTTPS
- [ ] DNS 记录正确配置
- [ ] 网站在不同浏览器中显示正常
- [ ] Gzip 压缩已启用
- [ ] 缓存策略已配置

---

## 🐛 常见问题解决

### 问题1：页面显示 404 错误
**解决：**
- 检查文件是否正确上传到服务器
- 检查文件权限：`chmod 644 *.html`
- 检查 Nginx/Apache 配置是否正确

### 问题2：CSS/样式不显示
**解决：**
- 检查文件编码是否为 UTF-8
- 清除浏览器缓存
- 检查控制台是否有错误

### 问题3：无法访问网站
**解决：**
- 检查防火墙是否开放 80/443 端口：
  ```bash
  sudo ufw allow 80
  sudo ufw allow 443
  ```
- 检查 Web 服务器是否运行：
  ```bash
  sudo systemctl status nginx
  # 或
  sudo systemctl status apache2
  ```

### 问题4：SSL 证书错误
**解决：**
- 确保域名 DNS 已正确指向服务器
- 重新运行 certbot
- 检查证书有效期：`sudo certbot certificates`

---

## 📞 需要帮助？

如果遇到问题，可以：
1. 检查服务器日志：`sudo tail -f /var/log/nginx/error.log`
2. 使用在线工具测试：https://www.ssllabs.com/ssltest/
3. 查看 Nginx/Apache 官方文档

---

## 🎉 部署完成！

恭喜！你的网站现在应该已经成功部署了。

**下一步：**
1. 测试所有页面和链接
2. 提交网站到搜索引擎（Google Search Console）
3. 设置网站分析（Google Analytics）
4. 定期备份网站文件
5. 监控网站性能和安全性

**建议：**
- 定期更新内容
- 监控服务器资源使用
- 保持 SSL 证书更新
- 定期备份数据库（如果使用）

---

**最后更新：** 2024年10月

**祝你部署顺利！** 🚀

