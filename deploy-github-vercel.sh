#!/bin/bash

# 🚀 一键部署脚本：GitHub + Vercel
# 使用方法：bash deploy-github-vercel.sh

echo "🚀 开始部署到 GitHub + Vercel..."
echo ""

# 颜色定义
GREEN='\033[0;32m'
BLUE='\033[0;34m'
YELLOW='\033[1;33m'
NC='\033[0m' # No Color

# 步骤 1: 检查 Git 是否安装
echo -e "${BLUE}📋 步骤 1/6: 检查 Git...${NC}"
if ! command -v git &> /dev/null; then
    echo -e "${YELLOW}⚠️  Git 未安装，请先安装 Git:${NC}"
    echo "   访问: https://git-scm.com/downloads"
    exit 1
fi
echo -e "${GREEN}✅ Git 已安装${NC}"
echo ""

# 步骤 2: 初始化 Git 仓库（如果还没有）
echo -e "${BLUE}📋 步骤 2/6: 初始化 Git 仓库...${NC}"
if [ ! -d ".git" ]; then
    git init
    echo -e "${GREEN}✅ Git 仓库初始化完成${NC}"
else
    echo -e "${GREEN}✅ Git 仓库已存在${NC}"
fi
echo ""

# 步骤 3: 创建 .gitignore
echo -e "${BLUE}📋 步骤 3/6: 创建 .gitignore...${NC}"
cat > .gitignore << 'EOF'
# 系统文件
.DS_Store
Thumbs.db
desktop.ini

# 编辑器文件
.vscode/
.idea/
*.swp
*.swo
*~

# Python 临时文件
__pycache__/
*.py[cod]
*$py.class
*.pyc

# 日志文件
*.log

# 环境变量
.env
.env.local

# Node modules (如果将来需要)
node_modules/

# 构建输出
dist/
build/
EOF
echo -e "${GREEN}✅ .gitignore 创建完成${NC}"
echo ""

# 步骤 4: 添加所有文件
echo -e "${BLUE}📋 步骤 4/6: 添加文件到 Git...${NC}"
git add .
echo -e "${GREEN}✅ 文件已添加${NC}"
echo ""

# 步骤 5: 提交
echo -e "${BLUE}📋 步骤 5/6: 提交更改...${NC}"
git commit -m "Initial commit: McAfee Landing Page" 2>/dev/null || echo -e "${YELLOW}ℹ️  没有新的更改需要提交${NC}"
echo ""

# 步骤 6: 推送到 GitHub
echo -e "${BLUE}📋 步骤 6/6: 准备推送到 GitHub...${NC}"
echo ""
echo -e "${YELLOW}⚠️  请按照以下步骤操作：${NC}"
echo ""
echo -e "${GREEN}1️⃣  在 GitHub 上创建新仓库：${NC}"
echo "   🔗 访问: https://github.com/new"
echo "   📝 仓库名: mcafee-landing-page"
echo "   📝 描述: Security Review Landing Page"
echo "   ✅ 选择: Public 或 Private"
echo "   ❌ 不要选择: Initialize with README"
echo ""
echo -e "${GREEN}2️⃣  创建后，运行以下命令：${NC}"
echo ""
echo -e "${BLUE}   git branch -M main${NC}"
echo -e "${BLUE}   git remote add origin https://github.com/YOUR-USERNAME/mcafee-landing-page.git${NC}"
echo -e "${BLUE}   git push -u origin main${NC}"
echo ""
echo -e "${GREEN}3️⃣  在 Vercel 上部署：${NC}"
echo "   🔗 访问: https://vercel.com/new"
echo "   📝 选择: Import Git Repository"
echo "   📝 选择你的 GitHub 仓库: mcafee-landing-page"
echo "   📝 项目名称: mcafee-landing-page"
echo "   📝 Framework Preset: Other"
echo "   📝 Root Directory: ./"
echo "   ✅ 点击 Deploy"
echo ""
echo -e "${GREEN}4️⃣  配置自定义域名（可选）：${NC}"
echo "   📝 在 Vercel 项目设置中添加你的域名"
echo "   📝 在域名 DNS 中添加 CNAME 记录"
echo ""
echo -e "${GREEN}🎉 完成！你的网站将在几分钟内上线！${NC}"
echo ""
echo -e "${YELLOW}💡 以后更新网站只需要：${NC}"
echo -e "   ${BLUE}git add .${NC}"
echo -e "   ${BLUE}git commit -m \"更新内容\"${NC}"
echo -e "   ${BLUE}git push${NC}"
echo -e "   ${GREEN}✨ Vercel 会自动部署新版本！${NC}"
echo ""

