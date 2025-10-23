'use client'

import { useState, useEffect } from 'react'
import { motion } from 'framer-motion'
import { FiShield, FiAward, FiHeadphones, FiCheckCircle } from 'react-icons/fi'
import { getTrustBadges } from '@/lib/api'
import { TrustBadge } from '@/types'

const iconMap = {
  'shield-check': FiShield,
  'certificate': FiAward,
  'headset': FiHeadphones,
  'award': FiCheckCircle,
}

export default function TrustBadges() {
  const [trustBadges, setTrustBadges] = useState<TrustBadge[]>([])

  useEffect(() => {
    const fetchBadges = async () => {
      const badges = await getTrustBadges()
      setTrustBadges(badges)
    }
    fetchBadges()
  }, [])

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
    <section className="py-16 bg-gray-50">
      <div className="container-custom">
        <motion.div
          className="text-center mb-12"
          variants={containerVariants}
          initial="hidden"
          whileInView="visible"
          viewport={{ once: true }}
        >
          <motion.h2 
            variants={itemVariants}
            className="text-3xl lg:text-4xl font-bold text-gray-900 mb-4"
          >
            为什么选择我们
          </motion.h2>
          <motion.p 
            variants={itemVariants}
            className="text-xl text-gray-600 max-w-3xl mx-auto"
          >
            我们提供最值得信赖的McAfee官方优惠服务，让您享受专业级网络安全保护
          </motion.p>
        </motion.div>

        <motion.div
          className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8"
          variants={containerVariants}
          initial="hidden"
          whileInView="visible"
          viewport={{ once: true }}
        >
          {trustBadges.map((badge, index) => {
            const IconComponent = iconMap[badge.icon as keyof typeof iconMap] || FiShield
            
            return (
              <motion.div
                key={badge.id}
                variants={itemVariants}
                className="text-center group"
              >
                <div className="bg-white rounded-2xl p-8 shadow-lg hover:shadow-xl transition-all duration-300 group-hover:-translate-y-2 border border-gray-100">
                  <div className="w-16 h-16 bg-primary-100 rounded-2xl flex items-center justify-center mx-auto mb-6 group-hover:bg-primary-600 transition-colors duration-300">
                    <IconComponent className="w-8 h-8 text-primary-600 group-hover:text-white transition-colors duration-300" />
                  </div>
                  
                  <h3 className="text-xl font-semibold text-gray-900 mb-3">
                    {badge.title}
                  </h3>
                  
                  <p className="text-gray-600 leading-relaxed">
                    {badge.description}
                  </p>
                </div>
              </motion.div>
            )
          })}
        </motion.div>

        {/* Additional Trust Indicators */}
        <motion.div
          className="mt-16 text-center"
          variants={containerVariants}
          initial="hidden"
          whileInView="visible"
          viewport={{ once: true }}
        >
          <motion.div 
            variants={itemVariants}
            className="bg-white rounded-2xl p-8 shadow-lg border border-gray-100"
          >
            <div className="grid grid-cols-1 md:grid-cols-3 gap-8">
              <div className="text-center">
                <div className="text-4xl font-bold text-primary-600 mb-2">50万+</div>
                <div className="text-gray-600">满意用户</div>
              </div>
              <div className="text-center">
                <div className="text-4xl font-bold text-success-600 mb-2">99.9%</div>
                <div className="text-gray-600">客户满意度</div>
              </div>
              <div className="text-center">
                <div className="text-4xl font-bold text-accent-600 mb-2">24/7</div>
                <div className="text-gray-600">技术支持</div>
              </div>
            </div>
          </motion.div>
        </motion.div>
      </div>
    </section>
  )
}
