#!/bin/bash

# McAfee LP 开发环境启动脚本

echo "🚀 启动 McAfee 推广站点开发环境..."

# 检查 Node.js 版本
node_version=$(node -v | cut -d'v' -f2 | cut -d'.' -f1)
if [ "$node_version" -lt 18 ]; then
    echo "❌ 错误: 需要 Node.js 18 或更高版本"
    exit 1
fi

# 检查是否安装了依赖
if [ ! -d "node_modules" ]; then
    echo "📦 安装前端依赖..."
    npm install
fi

if [ ! -d "strapi-config/node_modules" ]; then
    echo "📦 安装 Strapi 依赖..."
    cd strapi-config
    npm install
    cd ..
fi

# 检查环境变量文件
if [ ! -f ".env.local" ]; then
    echo "⚙️ 创建环境变量文件..."
    cp env.example .env.local
    echo "请编辑 .env.local 文件配置必要的环境变量"
fi

echo "✅ 环境检查完成"
echo ""
echo "请分别在两个终端中运行以下命令："
echo ""
echo "终端 1 - 启动 Strapi:"
echo "cd strapi-config && npm run develop"
echo ""
echo "终端 2 - 启动 Next.js:"
echo "npm run dev"
echo ""
echo "访问地址："
echo "- 前端: http://localhost:3000"
echo "- Strapi 后台: http://localhost:1337/admin"
echo ""
echo "🎉 开发环境准备就绪！"
