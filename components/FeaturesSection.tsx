'use client'

import { useState, useEffect } from 'react'
import { motion } from 'framer-motion'
import { FiShield, FiZap, FiLock, FiEye, FiCpu, FiWifi, FiDownload } from 'react-icons/fi'
import { getFeatures } from '@/lib/api'
import { Feature } from '@/types'

const iconMap = {
  'brain': FiCpu,
  'shield': FiShield,
  'zap': FiZap,
  'lock': FiLock,
  'eye': FiEye,
  'cpu': FiCpu,
  'wifi': FiWifi,
  'download': FiDownload,
}

export default function FeaturesSection() {
  const [features, setFeatures] = useState<Feature[]>([])
  const [activeCategory, setActiveCategory] = useState<string>('all')

  useEffect(() => {
    const fetchFeatures = async () => {
      const featuresData = await getFeatures()
      setFeatures(featuresData)
    }
    fetchFeatures()
  }, [])

  const categories = ['all', '安全防护', '隐私保护', '性能优化']
  const filteredFeatures = activeCategory === 'all' 
    ? features 
    : features.filter(feature => feature.category === activeCategory)

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
    <section id="features" className="py-20 bg-gray-50">
      <div className="container-custom">
        <motion.div
          className="text-center mb-16"
          variants={containerVariants}
          initial="hidden"
          whileInView="visible"
          viewport={{ once: true }}
        >
          <motion.h2 
            variants={itemVariants}
            className="text-4xl lg:text-5xl font-bold text-gray-900 mb-6"
          >
            强大的安全防护
            <span className="block text-gradient">功能特性</span>
          </motion.h2>
          <motion.p 
            variants={itemVariants}
            className="text-xl text-gray-600 max-w-3xl mx-auto"
          >
            McAfee采用最先进的安全技术，为您提供全方位的网络安全保护
          </motion.p>
        </motion.div>

        {/* Category Filter */}
        <motion.div
          className="flex flex-wrap justify-center gap-4 mb-12"
          variants={containerVariants}
          initial="hidden"
          whileInView="visible"
          viewport={{ once: true }}
        >
          {categories.map((category) => (
            <motion.button
              key={category}
              variants={itemVariants}
              onClick={() => setActiveCategory(category)}
              className={`px-6 py-3 rounded-full font-semibold transition-all duration-200 ${
                activeCategory === category
                  ? 'bg-primary-600 text-white shadow-lg'
                  : 'bg-white text-gray-600 hover:bg-primary-50 hover:text-primary-600'
              }`}
            >
              {category === 'all' ? '全部功能' : category}
            </motion.button>
          ))}
        </motion.div>

        {/* Features Grid */}
        <motion.div
          className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8"
          variants={containerVariants}
          initial="hidden"
          whileInView="visible"
          viewport={{ once: true }}
        >
          {filteredFeatures.map((feature, index) => {
            const IconComponent = iconMap[feature.icon as keyof typeof iconMap] || FiShield
            
            return (
              <motion.div
                key={feature.id}
                variants={itemVariants}
                className="group"
              >
                <div className="bg-white rounded-2xl p-8 shadow-lg hover:shadow-xl transition-all duration-300 group-hover:-translate-y-2 border border-gray-100 h-full">
                  <div className="w-16 h-16 bg-primary-100 rounded-2xl flex items-center justify-center mb-6 group-hover:bg-primary-600 transition-colors duration-300">
                    <IconComponent className="w-8 h-8 text-primary-600 group-hover:text-white transition-colors duration-300" />
                  </div>
                  
                  <h3 className="text-xl font-semibold text-gray-900 mb-4">
                    {feature.title}
                  </h3>
                  
                  <p className="text-gray-600 leading-relaxed">
                    {feature.description}
                  </p>

                  <div className="mt-4">
                    <span className="inline-block px-3 py-1 bg-primary-50 text-primary-600 text-sm font-medium rounded-full">
                      {feature.category}
                    </span>
                  </div>
                </div>
              </motion.div>
            )
          })}
        </motion.div>

        {/* Additional Features Showcase */}
        <motion.div
          className="mt-20"
          variants={containerVariants}
          initial="hidden"
          whileInView="visible"
          viewport={{ once: true }}
        >
          <motion.div 
            variants={itemVariants}
            className="bg-white rounded-3xl p-12 shadow-2xl border border-gray-100"
          >
            <div className="grid lg:grid-cols-2 gap-12 items-center">
              <div>
                <h3 className="text-3xl font-bold text-gray-900 mb-6">
                  AI驱动的智能防护
                </h3>
                <p className="text-lg text-gray-600 mb-8">
                  McAfee采用最新的人工智能技术，能够实时学习和识别新型威胁，
                  为您提供比传统防病毒软件更强大的保护能力。
                </p>
                
                <div className="space-y-4">
                  <div className="flex items-center space-x-3">
                    <div className="w-2 h-2 bg-primary-600 rounded-full"></div>
                    <span className="text-gray-700">99.6%的威胁检测率</span>
                  </div>
                  <div className="flex items-center space-x-3">
                    <div className="w-2 h-2 bg-primary-600 rounded-full"></div>
                    <span className="text-gray-700">实时威胁情报更新</span>
                  </div>
                  <div className="flex items-center space-x-3">
                    <div className="w-2 h-2 bg-primary-600 rounded-full"></div>
                    <span className="text-gray-700">零日攻击防护</span>
                  </div>
                </div>
              </div>
              
              <div className="relative">
                <div className="bg-gradient-to-br from-primary-50 to-accent-50 rounded-2xl p-8">
                  <div className="text-center">
                    <div className="w-24 h-24 bg-primary-600 rounded-3xl flex items-center justify-center mx-auto mb-6">
                      <FiCpu className="w-12 h-12 text-white" />
                    </div>
                    <h4 className="text-2xl font-bold text-gray-900 mb-4">AI安全引擎</h4>
                    <div className="space-y-3">
                      <div className="flex justify-between items-center">
                        <span className="text-gray-600">威胁检测率</span>
                        <span className="text-2xl font-bold text-primary-600">99.6%</span>
                      </div>
                      <div className="flex justify-between items-center">
                        <span className="text-gray-600">误报率</span>
                        <span className="text-2xl font-bold text-success-600">0.1%</span>
                      </div>
                      <div className="flex justify-between items-center">
                        <span className="text-gray-600">响应时间</span>
                        <span className="text-2xl font-bold text-accent-600">&lt;1秒</span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </motion.div>
        </motion.div>
      </div>
    </section>
  )
}
