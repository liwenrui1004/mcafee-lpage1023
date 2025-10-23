'use client'

import { useState, useEffect } from 'react'
import { motion } from 'framer-motion'
import { FiShield, FiClock, FiCheck, FiStar, FiArrowRight } from 'react-icons/fi'
import { getSiteSettings } from '@/lib/api'
import { SiteSettings } from '@/types'

export default function HeroSection() {
  const [siteSettings, setSiteSettings] = useState<SiteSettings | null>(null)
  const [timeLeft, setTimeLeft] = useState({
    days: 0,
    hours: 0,
    minutes: 0,
    seconds: 0
  })

  useEffect(() => {
    const fetchSettings = async () => {
      const settings = await getSiteSettings()
      setSiteSettings(settings)
    }
    fetchSettings()
  }, [])

  useEffect(() => {
    if (!siteSettings?.countdownEndDate) return

    const timer = setInterval(() => {
      const now = new Date().getTime()
      const endDate = new Date(siteSettings.countdownEndDate).getTime()
      const difference = endDate - now

      if (difference > 0) {
        setTimeLeft({
          days: Math.floor(difference / (1000 * 60 * 60 * 24)),
          hours: Math.floor((difference % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60)),
          minutes: Math.floor((difference % (1000 * 60 * 60)) / (1000 * 60)),
          seconds: Math.floor((difference % (1000 * 60)) / 1000)
        })
      }
    }, 1000)

    return () => clearInterval(timer)
  }, [siteSettings])

  const containerVariants = {
    hidden: { opacity: 0 },
    visible: {
      opacity: 1,
      transition: {
        staggerChildren: 0.1
      }
    }
  }

  const itemVariants = {
    hidden: { y: 20, opacity: 0 },
    visible: {
      y: 0,
      opacity: 1,
      transition: {
        duration: 0.6
      }
    }
  }

  return (
    <section className="relative min-h-screen flex items-center gradient-bg overflow-hidden">
      {/* Background Elements */}
      <div className="absolute inset-0 overflow-hidden">
        <div className="absolute -top-40 -right-40 w-80 h-80 bg-primary-200 rounded-full opacity-20 animate-pulse-slow"></div>
        <div className="absolute -bottom-40 -left-40 w-96 h-96 bg-accent-200 rounded-full opacity-20 animate-pulse-slow"></div>
      </div>

      <div className="container-custom relative z-10">
        <motion.div
          className="grid lg:grid-cols-2 gap-12 items-center"
          variants={containerVariants}
          initial="hidden"
          animate="visible"
        >
          {/* Left Content */}
          <div className="space-y-8">
            <motion.div variants={itemVariants} className="space-y-4">
              <div className="inline-flex items-center px-4 py-2 bg-primary-100 text-primary-700 rounded-full text-sm font-medium">
                <FiShield className="w-4 h-4 mr-2" />
                官方授权渠道
              </div>
              
              <h1 className="text-4xl lg:text-6xl font-bold text-gray-900 leading-tight">
                {siteSettings?.heroTitle || 'McAfee 官方优惠'}
                <span className="block text-gradient">
                  2025年最佳防病毒软件
                </span>
              </h1>
              
              <p className="text-xl text-gray-600 leading-relaxed">
                {siteSettings?.heroSubtitle || 'AI驱动全面保护，30天退款保证，专业评测推荐'}
              </p>
            </motion.div>

            {/* Countdown Timer */}
            <motion.div variants={itemVariants} className="bg-white rounded-2xl p-6 shadow-lg border border-gray-100">
              <div className="flex items-center space-x-2 mb-4">
                <FiClock className="w-5 h-5 text-accent-600" />
                <span className="text-lg font-semibold text-gray-900">限时优惠倒计时</span>
              </div>
              
              <div className="grid grid-cols-4 gap-4">
                {Object.entries(timeLeft).map(([unit, value]) => (
                  <div key={unit} className="text-center">
                    <div className="bg-primary-600 text-white text-2xl font-bold py-3 px-4 rounded-lg">
                      {value.toString().padStart(2, '0')}
                    </div>
                    <div className="text-sm text-gray-600 mt-2 capitalize">
                      {unit === 'days' ? '天' : unit === 'hours' ? '小时' : unit === 'minutes' ? '分钟' : '秒'}
                    </div>
                  </div>
                ))}
              </div>
            </motion.div>

            {/* Key Benefits */}
            <motion.div variants={itemVariants} className="space-y-3">
              {[
                '✅ 官方正版授权，100%正版保证',
                '✅ 30天无理由退款保证',
                '✅ 24/7专业技术支持',
                '✅ 独立评测机构推荐'
              ].map((benefit, index) => (
                <div key={index} className="flex items-center space-x-3">
                  <FiCheck className="w-5 h-5 text-success-600 flex-shrink-0" />
                  <span className="text-gray-700">{benefit}</span>
                </div>
              ))}
            </motion.div>

            {/* CTA Buttons */}
            <motion.div variants={itemVariants} className="flex flex-col sm:flex-row gap-4">
              <a
                href={siteSettings?.heroCtaLink || '#pricing'}
                className="btn-primary text-lg px-8 py-4 inline-flex items-center justify-center group"
              >
                {siteSettings?.heroCtaText || '立即获取优惠'}
                <FiArrowRight className="w-5 h-5 ml-2 group-hover:translate-x-1 transition-transform" />
              </a>
              <a
                href="#features"
                className="btn-secondary text-lg px-8 py-4 inline-flex items-center justify-center"
              >
                了解更多功能
              </a>
            </motion.div>

            {/* Trust Indicators */}
            <motion.div variants={itemVariants} className="flex items-center space-x-6 pt-4">
              <div className="flex items-center space-x-1">
                <div className="flex">
                  {[...Array(5)].map((_, i) => (
                    <FiStar key={i} className="w-4 h-4 text-yellow-400 fill-current" />
                  ))}
                </div>
                <span className="text-sm text-gray-600 ml-2">4.9/5 用户评分</span>
              </div>
              <div className="text-sm text-gray-600">
                <span className="font-semibold text-primary-600">50万+</span> 用户选择
              </div>
            </motion.div>
          </div>

          {/* Right Content - Hero Image/Visual */}
          <motion.div 
            variants={itemVariants}
            className="relative"
          >
            <div className="relative">
              {/* Main Card */}
              <div className="bg-white rounded-3xl shadow-2xl p-8 border border-gray-100">
                <div className="text-center space-y-6">
                  <div className="w-20 h-20 bg-primary-600 rounded-2xl flex items-center justify-center mx-auto">
                    <FiShield className="w-10 h-10 text-white" />
                  </div>
                  
                  <div>
                    <h3 className="text-2xl font-bold text-gray-900 mb-2">McAfee Total Protection</h3>
                    <p className="text-gray-600">AI驱动的全面安全防护</p>
                  </div>

                  <div className="space-y-3">
                    <div className="flex justify-between items-center py-2 border-b border-gray-100">
                      <span className="text-gray-600">原价</span>
                      <span className="text-2xl font-bold text-gray-400 line-through">¥599</span>
                    </div>
                    <div className="flex justify-between items-center py-2">
                      <span className="text-gray-600">优惠价</span>
                      <span className="text-3xl font-bold text-accent-600">¥299</span>
                    </div>
                    <div className="flex justify-between items-center py-2 bg-success-50 rounded-lg px-4">
                      <span className="text-success-700 font-semibold">节省</span>
                      <span className="text-2xl font-bold text-success-600">¥300</span>
                    </div>
                  </div>

                  <button className="w-full btn-accent text-lg py-4">
                    立即购买 - 限时优惠
                  </button>
                </div>
              </div>

              {/* Floating Elements */}
              <div className="absolute -top-4 -right-4 bg-success-500 text-white px-4 py-2 rounded-full text-sm font-semibold animate-bounce-slow">
                50% OFF
              </div>
              
              <div className="absolute -bottom-4 -left-4 bg-primary-500 text-white px-4 py-2 rounded-full text-sm font-semibold">
                30天退款保证
              </div>
            </div>
          </motion.div>
        </motion.div>
      </div>
    </section>
  )
}
