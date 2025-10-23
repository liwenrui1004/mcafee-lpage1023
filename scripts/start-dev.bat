@echo off
chcp 65001 >nul
echo 🚀 启动 McAfee 推广站点开发环境...

REM 检查 Node.js 版本
for /f "tokens=1 delims=." %%a in ('node -v') do set node_version=%%a
set node_version=%node_version:v=%
if %node_version% LSS 18 (
    echo ❌ 错误: 需要 Node.js 18 或更高版本
    pause
    exit /b 1
)

REM 检查是否安装了依赖
if not exist "node_modules" (
    echo 📦 安装前端依赖...
    npm install
)

if not exist "strapi-config\node_modules" (
    echo 📦 安装 Strapi 依赖...
    cd strapi-config
    npm install
    cd ..
)

REM 检查环境变量文件
if not exist ".env.local" (
    echo ⚙️ 创建环境变量文件...
    copy env.example .env.local
    echo 请编辑 .env.local 文件配置必要的环境变量
)

echo ✅ 环境检查完成
echo.
echo 请分别在两个命令提示符中运行以下命令：
echo.
echo 命令提示符 1 - 启动 Strapi:
echo cd strapi-config ^&^& npm run develop
echo.
echo 命令提示符 2 - 启动 Next.js:
echo npm run dev
echo.
echo 访问地址：
echo - 前端: http://localhost:3000
echo - Strapi 后台: http://localhost:1337/admin
echo.
echo 🎉 开发环境准备就绪！
pause
