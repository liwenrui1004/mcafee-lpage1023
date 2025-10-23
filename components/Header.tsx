'use client'

import { useState, useEffect } from 'react'
import { FiMenu, FiX, FiShield, FiPhone, FiMail } from 'react-icons/fi'

export default function Header() {
  const [isMenuOpen, setIsMenuOpen] = useState(false)
  const [isScrolled, setIsScrolled] = useState(false)

  useEffect(() => {
    const handleScroll = () => {
      setIsScrolled(window.scrollY > 20)
    }

    window.addEventListener('scroll', handleScroll)
    return () => window.removeEventListener('scroll', handleScroll)
  }, [])

  return (
    <header className={`fixed top-0 left-0 right-0 z-50 transition-all duration-300 ${
      isScrolled ? 'bg-white shadow-lg' : 'bg-transparent'
    }`}>
      <div className="container-custom">
        <div className="flex items-center justify-between py-4">
          {/* Logo */}
          <div className="flex items-center space-x-2">
            <div className="flex items-center justify-center w-10 h-10 bg-primary-600 rounded-lg">
              <FiShield className="w-6 h-6 text-white" />
            </div>
            <div>
              <h1 className="text-xl font-bold text-gray-900">McAfee优惠</h1>
              <p className="text-xs text-gray-600">官方授权渠道</p>
            </div>
          </div>

          {/* Desktop Navigation */}
          <nav className="hidden lg:flex items-center space-x-8">
            <a href="#pricing" className="text-gray-700 hover:text-primary-600 transition-colors">
              价格方案
            </a>
            <a href="#features" className="text-gray-700 hover:text-primary-600 transition-colors">
              功能特性
            </a>
            <a href="#testimonials" className="text-gray-700 hover:text-primary-600 transition-colors">
              用户评价
            </a>
            <a href="#faq" className="text-gray-700 hover:text-primary-600 transition-colors">
              常见问题
            </a>
            <a href="#contact" className="text-gray-700 hover:text-primary-600 transition-colors">
              联系我们
            </a>
          </nav>

          {/* Contact Info */}
          <div className="hidden lg:flex items-center space-x-4">
            <div className="flex items-center space-x-2 text-sm text-gray-600">
              <FiPhone className="w-4 h-4" />
              <span>400-123-4567</span>
            </div>
            <div className="flex items-center space-x-2 text-sm text-gray-600">
              <FiMail className="w-4 h-4" />
              <span>support@mcafee-lp.com</span>
            </div>
          </div>

          {/* Mobile Menu Button */}
          <button
            onClick={() => setIsMenuOpen(!isMenuOpen)}
            className="lg:hidden p-2 rounded-lg hover:bg-gray-100 transition-colors"
          >
            {isMenuOpen ? <FiX className="w-6 h-6" /> : <FiMenu className="w-6 h-6" />}
          </button>
        </div>

        {/* Mobile Menu */}
        {isMenuOpen && (
          <div className="lg:hidden bg-white border-t border-gray-200 shadow-lg">
            <nav className="py-4 space-y-4">
              <a 
                href="#pricing" 
                className="block px-4 py-2 text-gray-700 hover:text-primary-600 hover:bg-gray-50 transition-colors"
                onClick={() => setIsMenuOpen(false)}
              >
                价格方案
              </a>
              <a 
                href="#features" 
                className="block px-4 py-2 text-gray-700 hover:text-primary-600 hover:bg-gray-50 transition-colors"
                onClick={() => setIsMenuOpen(false)}
              >
                功能特性
              </a>
              <a 
                href="#testimonials" 
                className="block px-4 py-2 text-gray-700 hover:text-primary-600 hover:bg-gray-50 transition-colors"
                onClick={() => setIsMenuOpen(false)}
              >
                用户评价
              </a>
              <a 
                href="#faq" 
                className="block px-4 py-2 text-gray-700 hover:text-primary-600 hover:bg-gray-50 transition-colors"
                onClick={() => setIsMenuOpen(false)}
              >
                常见问题
              </a>
              <a 
                href="#contact" 
                className="block px-4 py-2 text-gray-700 hover:text-primary-600 hover:bg-gray-50 transition-colors"
                onClick={() => setIsMenuOpen(false)}
              >
                联系我们
              </a>
            </nav>
            
            {/* Mobile Contact Info */}
            <div className="px-4 py-4 border-t border-gray-200 space-y-2">
              <div className="flex items-center space-x-2 text-sm text-gray-600">
                <FiPhone className="w-4 h-4" />
                <span>400-123-4567</span>
              </div>
              <div className="flex items-center space-x-2 text-sm text-gray-600">
                <FiMail className="w-4 h-4" />
                <span>support@mcafee-lp.com</span>
              </div>
            </div>
          </div>
        )}
      </div>
    </header>
  )
}
