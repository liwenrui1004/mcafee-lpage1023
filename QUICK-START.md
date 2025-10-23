# 🚀 快速开始：GitHub + Vercel 部署

## 📋 为什么选择 GitHub + Vercel？

✅ **自动部署** - 代码推送即部署，无需手动操作  
✅ **版本控制** - 完整的修改历史，可随时回滚  
✅ **免费SSL** - 自动 HTTPS 加密  
✅ **全球CDN** - 访问速度超快  
✅ **预览部署** - 每个分支自动生成预览链接  
✅ **零配置** - 开箱即用  

---

## ⏱️ 5分钟完成部署

### 第一步：准备 GitHub 账号（1分钟）

如果还没有 GitHub 账号：
1. 访问 https://github.com/signup
2. 注册免费账号
3. 验证邮箱

### 第二步：上传代码到 GitHub（2分钟）

#### 方法A：使用 GitHub 网页（最简单）

1. **创建新仓库**
   - 访问 https://github.com/new
   - 仓库名：`mcafee-landing-page`
   - 选择：Public（公开）或 Private（私有）
   - ❌ **不要勾选** "Add a README file"
   - 点击 "Create repository"

2. **上传文件**
   - 在新创建的仓库页面，点击 "uploading an existing file"
   - 拖拽以下文件到浏览器：
     ```
     ✅ preview-english.html
     ✅ about.html
     ✅ contact.html
     ✅ privacy-policy.html
     ✅ vercel.json
     ✅ README.md
     ✅ .gitignore
     ```
   - 在底部填写提交信息：`Initial commit`
   - 点击 "Commit changes"

3. **完成！** 你的代码现在在 GitHub 上了 🎉

#### 方法B：使用命令行（推荐给开发者）

```bash
# 1. 初始化 Git（在项目文件夹中）
git init

# 2. 添加所有文件
git add .

# 3. 提交
git commit -m "Initial commit: McAfee Landing Page"

# 4. 连接到 GitHub（替换 YOUR-USERNAME）
git remote add origin https://github.com/YOUR-USERNAME/mcafee-landing-page.git

# 5. 推送
git branch -M main
git push -u origin main
```

---

### 第三步：在 Vercel 部署（2分钟）

1. **访问 Vercel**
   - 打开 https://vercel.com/signup
   - 选择 "Continue with GitHub" 登录

2. **导入项目**
   - 点击 "Add New..." → "Project"
   - 找到你的仓库 `mcafee-landing-page`
   - 点击 "Import"

3. **配置项目**（通常不需要改）
   - Project Name: `mcafee-landing-page`
   - Framework Preset: `Other`
   - Root Directory: `./`
   - **直接点击 "Deploy"**

4. **等待部署**（30秒-1分钟）
   - 看到 "Congratulations! 🎉" 就成功了！

5. **访问你的网站**
   ```
   https://mcafee-landing-page.vercel.app
   ```

---

## 🎉 完成！你的网站已上线！

现在你有：
- ✅ 公开的网站链接
- ✅ 自动 HTTPS 加密
- ✅ 全球 CDN 加速
- ✅ 免费托管

---

## 📝 以后如何更新网站？

### 方法A：使用 GitHub 网页（最简单）

1. 在 GitHub 仓库中找到要修改的文件
2. 点击文件名，然后点击 "✏️ 编辑" 按钮
3. 修改内容
4. 点击 "Commit changes"
5. **等待 30 秒，Vercel 自动部署完成！** ✨

### 方法B：使用命令行

```bash
# 1. 修改本地文件
# 2. 提交更改
git add .
git commit -m "更新页面内容"
git push

# 3. Vercel 自动部署！
```

**就是这么简单！** 每次推送代码，Vercel 都会自动部署新版本。

---

## 🌐 绑定自定义域名（可选）

如果你有自己的域名（如 `yourdomain.com`）：

### 在 Vercel 添加域名

1. 进入你的 Vercel 项目
2. 点击 "Settings" → "Domains"
3. 输入你的域名：`yourdomain.com`
4. 点击 "Add"

### 配置 DNS

在你的域名注册商（如阿里云、GoDaddy）添加 DNS 记录：

#### 方法A：使用 CNAME（推荐）

```
类型: CNAME
名称: www
值: cname.vercel-dns.com
TTL: 3600
```

#### 方法B：使用 A 记录

```
类型: A
名称: @
值: 76.76.21.21
TTL: 3600
```

### 等待生效

- DNS 传播通常需要 5 分钟 - 24 小时
- Vercel 会自动配置 SSL 证书
- 完成后你就可以用自己的域名访问了！

---

## 🔍 常见问题

### Q: GitHub 仓库应该选公开还是私有？

**A:** 都可以！
- **Public（公开）**：任何人都能看到代码，适合开源项目、展示作品
- **Private（私有）**：只有你能看到，适合商业项目

Vercel 两种都支持，都是免费的！

### Q: 我不会用命令行，可以用吗？

**A:** 完全可以！使用 GitHub 网页版上传文件就行，非常简单。

### Q: 部署需要付费吗？

**A:** 不需要！GitHub 和 Vercel 个人使用都是免费的。

**免费额度：**
- GitHub: 无限公开仓库 + 500MB 私有仓库
- Vercel: 100GB 带宽/月，足够个人网站使用

### Q: 如果我改错了怎么办？

**A:** GitHub 保存了所有历史版本，可以随时回滚：

```bash
# 查看历史
git log

# 回滚到上一个版本
git revert HEAD
git push

# 或者在 GitHub 网页查看历史并恢复
```

### Q: 网站访问速度快吗？

**A:** 非常快！Vercel 有全球 CDN，中国访问也很快（比普通服务器快得多）。

### Q: 可以看到访问统计吗？

**A:** 可以！Vercel 提供免费的分析：
- 进入项目 → "Analytics"
- 查看访问量、地理位置、设备类型等

---

## 🎯 进阶技巧

### 1. 使用分支进行开发

```bash
# 创建开发分支
git checkout -b dev

# 修改代码...

# 提交并推送
git add .
git commit -m "开发新功能"
git push origin dev

# Vercel 自动创建预览链接：
# https://mcafee-landing-page-git-dev-username.vercel.app
```

### 2. 添加环境变量

在 Vercel 项目设置中可以添加环境变量（如 API 密钥）。

### 3. 自定义构建设置

编辑 `vercel.json` 文件进行高级配置。

---

## 📞 需要帮助？

**遇到问题？**

1. **检查 Vercel 部署日志**
   - 进入项目 → "Deployments"
   - 点击最新的部署查看日志

2. **查看 GitHub 提交历史**
   - 确认文件是否正确上传

3. **测试本地文件**
   - 在浏览器直接打开 HTML 文件测试

4. **常见错误**
   - 404错误：检查文件名是否正确
   - 样式不显示：检查文件编码是否为 UTF-8
   - 域名不生效：等待 DNS 传播

---

## 🎊 恭喜！

你现在已经掌握了现代化的网站部署流程！

**下一步：**
- ⭐ 给自己的 GitHub 仓库加个 Star
- 📝 更新 README.md 添加项目说明
- 🎨 继续优化你的网站设计
- 📊 查看 Vercel Analytics 了解访问情况

**记住：**
```
改代码 → git push → 自动上线 ✨
```

就是这么简单！享受自动化部署的乐趣吧！🚀

---

**最后更新：2024年10月**

有问题欢迎在 GitHub Issues 提问！

