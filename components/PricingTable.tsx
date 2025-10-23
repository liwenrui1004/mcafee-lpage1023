'use client'

import { useState, useEffect } from 'react'
import { motion } from 'framer-motion'
import { FiCheck, FiStar, FiShield, FiZap, FiUsers, FiCloud, FiCpu } from 'react-icons/fi'
import { getPricingPlans } from '@/lib/api'
import { PricingPlan } from '@/types'

const planIcons = {
  'AI驱动的全面保护': FiZap,
  '广告和追踪器拦截器': FiShield,
  '35年以上的安全卓越': FiStar,
  '完整家庭保护': FiUsers,
  '高级安全套件': FiCloud,
  '超轻高性能': FiCpu,
}

export default function PricingTable() {
  const [pricingPlans, setPricingPlans] = useState<PricingPlan[]>([])
  const [selectedPlan, setSelectedPlan] = useState<number | null>(null)

  useEffect(() => {
    const fetchPlans = async () => {
      const plans = await getPricingPlans()
      setPricingPlans(plans)
    }
    fetchPlans()
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

  const handlePlanSelect = (planId: number) => {
    setSelectedPlan(planId)
    // 这里可以添加跳转到购买页面的逻辑
    console.log('Selected plan:', planId)
  }

  return (
    <section id="pricing" className="py-20 bg-white">
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
            选择最适合您的
            <span className="block text-gradient">安全防护方案</span>
          </motion.h2>
          <motion.p 
            variants={itemVariants}
            className="text-xl text-gray-600 max-w-3xl mx-auto"
          >
            6种专业防护方案，满足不同用户需求。所有方案均提供30天退款保证和专业技术支持。
          </motion.p>
        </motion.div>

        <motion.div
          className="grid grid-cols-1 lg:grid-cols-3 gap-8"
          variants={containerVariants}
          initial="hidden"
          whileInView="visible"
          viewport={{ once: true }}
        >
          {pricingPlans.map((plan, index) => {
            const IconComponent = planIcons[plan.title as keyof typeof planIcons] || FiShield
            const isFeatured = plan.isFeatured
            
            return (
              <motion.div
                key={plan.id}
                variants={itemVariants}
                className={`relative ${isFeatured ? 'lg:scale-105' : ''}`}
              >
                {/* Featured Badge */}
                {isFeatured && (
                  <div className="absolute -top-4 left-1/2 transform -translate-x-1/2 z-10">
                    <div className="bg-gradient-to-r from-primary-600 to-accent-600 text-white px-6 py-2 rounded-full text-sm font-semibold shadow-lg">
                      {plan.badge || '最受欢迎'}
                    </div>
                  </div>
                )}

                <div className={`card p-8 h-full transition-all duration-300 ${
                  isFeatured 
                    ? 'border-2 border-primary-500 shadow-2xl' 
                    : 'hover:shadow-xl'
                } ${selectedPlan === plan.id ? 'ring-2 ring-primary-500' : ''}`}>
                  {/* Plan Header */}
                  <div className="text-center mb-8">
                    <div className={`w-16 h-16 rounded-2xl flex items-center justify-center mx-auto mb-4 ${
                      isFeatured ? 'bg-primary-600' : 'bg-primary-100'
                    }`}>
                      <IconComponent className={`w-8 h-8 ${
                        isFeatured ? 'text-white' : 'text-primary-600'
                      }`} />
                    </div>
                    
                    <h3 className="text-2xl font-bold text-gray-900 mb-2">
                      {plan.title}
                    </h3>
                    
                    <p className="text-gray-600 mb-6">
                      {plan.description}
                    </p>

                    {/* Pricing */}
                    <div className="mb-6">
                      <div className="flex items-center justify-center space-x-2 mb-2">
                        <span className="text-3xl font-bold text-gray-400 line-through">
                          ¥{plan.originalPrice}
                        </span>
                        <span className="text-sm text-gray-500">原价</span>
                      </div>
                      <div className="text-5xl font-bold text-primary-600 mb-2">
                        ¥{plan.discountPrice}
                      </div>
                      <div className="text-sm text-gray-500">
                        支持 {plan.devices} 台设备
                      </div>
                    </div>
                  </div>

                  {/* Features */}
                  <div className="space-y-4 mb-8">
                    {plan.features.map((feature, featureIndex) => (
                      <div key={featureIndex} className="flex items-center space-x-3">
                        <FiCheck className="w-5 h-5 text-success-600 flex-shrink-0" />
                        <span className="text-gray-700">{feature}</span>
                      </div>
                    ))}
                  </div>

                  {/* CTA Button */}
                  <button
                    onClick={() => handlePlanSelect(plan.id)}
                    className={`w-full py-4 px-6 rounded-lg font-semibold text-lg transition-all duration-200 transform hover:scale-105 ${
                      isFeatured
                        ? 'btn-primary'
                        : selectedPlan === plan.id
                        ? 'btn-accent'
                        : 'btn-secondary'
                    }`}
                  >
                    {plan.ctaText}
                  </button>

                  {/* Additional Info */}
                  <div className="mt-6 text-center text-sm text-gray-500">
                    <div className="flex items-center justify-center space-x-4">
                      <span>✓ 30天退款保证</span>
                      <span>✓ 24/7技术支持</span>
                    </div>
                  </div>
                </div>
              </motion.div>
            )
          })}
        </motion.div>

        {/* Bottom CTA */}
        <motion.div
          className="mt-16 text-center"
          variants={containerVariants}
          initial="hidden"
          whileInView="visible"
          viewport={{ once: true }}
        >
          <motion.div 
            variants={itemVariants}
            className="bg-gradient-to-r from-primary-50 to-accent-50 rounded-2xl p-8 border border-primary-200"
          >
            <h3 className="text-2xl font-bold text-gray-900 mb-4">
              不确定选择哪个方案？
            </h3>
            <p className="text-gray-600 mb-6 max-w-2xl mx-auto">
              我们的安全专家可以为您推荐最适合的防护方案。免费咨询，无任何义务。
            </p>
            <div className="flex flex-col sm:flex-row gap-4 justify-center">
              <a href="#contact" className="btn-primary">
                免费咨询专家
              </a>
              <a href="#faq" className="btn-secondary">
                查看常见问题
              </a>
            </div>
          </motion.div>
        </motion.div>
      </div>
    </section>
  )
}
