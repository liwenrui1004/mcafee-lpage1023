'use client'

import { FiShield, FiPhone, FiMail, FiMapPin, FiClock, FiFacebook, FiTwitter, FiInstagram, FiLinkedin } from 'react-icons/fi'

export default function Footer() {
  const currentYear = new Date().getFullYear()

  return (
    <footer className="bg-gray-900 text-white">
      <div className="container-custom">
        {/* Main Footer Content */}
        <div className="py-16">
          <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            {/* Company Info */}
            <div className="space-y-6">
              <div className="flex items-center space-x-3">
                <div className="w-10 h-10 bg-primary-600 rounded-lg flex items-center justify-center">
                  <FiShield className="w-6 h-6 text-white" />
                </div>
                <div>
                  <h3 className="text-xl font-bold">McAfee优惠</h3>
                  <p className="text-sm text-gray-400">官方授权渠道</p>
                </div>
              </div>
              
              <p className="text-gray-300 leading-relaxed">
                我们提供最值得信赖的McAfee官方优惠服务，让您享受专业级网络安全保护。
                30天退款保证，24/7技术支持。
              </p>

              <div className="flex space-x-4">
                <a href="#" className="w-10 h-10 bg-gray-800 rounded-lg flex items-center justify-center hover:bg-primary-600 transition-colors">
                  <FiFacebook className="w-5 h-5" />
                </a>
                <a href="#" className="w-10 h-10 bg-gray-800 rounded-lg flex items-center justify-center hover:bg-primary-600 transition-colors">
                  <FiTwitter className="w-5 h-5" />
                </a>
                <a href="#" className="w-10 h-10 bg-gray-800 rounded-lg flex items-center justify-center hover:bg-primary-600 transition-colors">
                  <FiInstagram className="w-5 h-5" />
                </a>
                <a href="#" className="w-10 h-10 bg-gray-800 rounded-lg flex items-center justify-center hover:bg-primary-600 transition-colors">
                  <FiLinkedin className="w-5 h-5" />
                </a>
              </div>
            </div>

            {/* Quick Links */}
            <div>
              <h4 className="text-lg font-semibold mb-6">快速导航</h4>
              <ul className="space-y-3">
                <li>
                  <a href="#pricing" className="text-gray-300 hover:text-white transition-colors">
                    价格方案
                  </a>
                </li>
                <li>
                  <a href="#features" className="text-gray-300 hover:text-white transition-colors">
                    功能特性
                  </a>
                </li>
                <li>
                  <a href="#testimonials" className="text-gray-300 hover:text-white transition-colors">
                    用户评价
                  </a>
                </li>
                <li>
                  <a href="#faq" className="text-gray-300 hover:text-white transition-colors">
                    常见问题
                  </a>
                </li>
                <li>
                  <a href="#contact" className="text-gray-300 hover:text-white transition-colors">
                    联系我们
                  </a>
                </li>
              </ul>
            </div>

            {/* Products */}
            <div>
              <h4 className="text-lg font-semibold mb-6">产品方案</h4>
              <ul className="space-y-3">
                <li>
                  <a href="#" className="text-gray-300 hover:text-white transition-colors">
                    AI驱动全面保护
                  </a>
                </li>
                <li>
                  <a href="#" className="text-gray-300 hover:text-white transition-colors">
                    广告拦截器
                  </a>
                </li>
                <li>
                  <a href="#" className="text-gray-300 hover:text-white transition-colors">
                    专业级安全
                  </a>
                </li>
                <li>
                  <a href="#" className="text-gray-300 hover:text-white transition-colors">
                    家庭保护套件
                  </a>
                </li>
                <li>
                  <a href="#" className="text-gray-300 hover:text-white transition-colors">
                    高性能版本
                  </a>
                </li>
              </ul>
            </div>

            {/* Contact Info */}
            <div>
              <h4 className="text-lg font-semibold mb-6">联系我们</h4>
              <div className="space-y-4">
                <div className="flex items-center space-x-3">
                  <FiPhone className="w-5 h-5 text-primary-400 flex-shrink-0" />
                  <div>
                    <p className="text-gray-300">400-123-4567</p>
                    <p className="text-sm text-gray-400">24/7客服热线</p>
                  </div>
                </div>
                
                <div className="flex items-center space-x-3">
                  <FiMail className="w-5 h-5 text-primary-400 flex-shrink-0" />
                  <div>
                    <p className="text-gray-300">support@mcafee-lp.com</p>
                    <p className="text-sm text-gray-400">技术支持邮箱</p>
                  </div>
                </div>
                
                <div className="flex items-center space-x-3">
                  <FiMapPin className="w-5 h-5 text-primary-400 flex-shrink-0" />
                  <div>
                    <p className="text-gray-300">北京市朝阳区</p>
                    <p className="text-sm text-gray-400">科技园区A座</p>
                  </div>
                </div>
                
                <div className="flex items-center space-x-3">
                  <FiClock className="w-5 h-5 text-primary-400 flex-shrink-0" />
                  <div>
                    <p className="text-gray-300">周一至周日</p>
                    <p className="text-sm text-gray-400">9:00 - 21:00</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        {/* Trust Badges */}
        <div className="py-8 border-t border-gray-800">
          <div className="grid grid-cols-2 md:grid-cols-4 gap-6 text-center">
            <div className="flex flex-col items-center space-y-2">
              <div className="w-12 h-12 bg-success-600 rounded-full flex items-center justify-center">
                <FiShield className="w-6 h-6 text-white" />
              </div>
              <p className="text-sm text-gray-300">30天退款保证</p>
            </div>
            
            <div className="flex flex-col items-center space-y-2">
              <div className="w-12 h-12 bg-primary-600 rounded-full flex items-center justify-center">
                <span className="text-white font-bold">✓</span>
              </div>
              <p className="text-sm text-gray-300">官方正版授权</p>
            </div>
            
            <div className="flex flex-col items-center space-y-2">
              <div className="w-12 h-12 bg-accent-600 rounded-full flex items-center justify-center">
                <span className="text-white font-bold">24/7</span>
              </div>
              <p className="text-sm text-gray-300">专业技术支持</p>
            </div>
            
            <div className="flex flex-col items-center space-y-2">
              <div className="w-12 h-12 bg-yellow-600 rounded-full flex items-center justify-center">
                <span className="text-white font-bold">★</span>
              </div>
              <p className="text-sm text-gray-300">独立评测推荐</p>
            </div>
          </div>
        </div>

        {/* Bottom Bar */}
        <div className="py-6 border-t border-gray-800">
          <div className="flex flex-col md:flex-row justify-between items-center space-y-4 md:space-y-0">
            <div className="text-gray-400 text-sm">
              © {currentYear} McAfee优惠. 保留所有权利.
            </div>
            
            <div className="flex flex-wrap justify-center md:justify-end space-x-6 text-sm">
              <a href="#" className="text-gray-400 hover:text-white transition-colors">
                隐私政策
              </a>
              <a href="#" className="text-gray-400 hover:text-white transition-colors">
                服务条款
              </a>
              <a href="#" className="text-gray-400 hover:text-white transition-colors">
                免责声明
              </a>
              <a href="#" className="text-gray-400 hover:text-white transition-colors">
                网站地图
              </a>
            </div>
          </div>
        </div>
      </div>
    </footer>
  )
}
