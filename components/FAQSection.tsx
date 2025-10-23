'use client'

import { useState, useEffect } from 'react'
import { motion, AnimatePresence } from 'framer-motion'
import { FiPlus, FiMinus, FiHelpCircle } from 'react-icons/fi'
import { getFAQs } from '@/lib/api'
import { FAQ } from '@/types'

export default function FAQSection() {
  const [faqs, setFaqs] = useState<FAQ[]>([])
  const [openItems, setOpenItems] = useState<Set<string>>(new Set())

  useEffect(() => {
    const fetchFAQs = async () => {
      const faqsData = await getFAQs()
      setFaqs(faqsData)
    }
    fetchFAQs()
  }, [])

  const toggleItem = (id: string) => {
    const newOpenItems = new Set(openItems)
    if (newOpenItems.has(id)) {
      newOpenItems.delete(id)
    } else {
      newOpenItems.add(id)
    }
    setOpenItems(newOpenItems)
  }

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
    <section id="faq" className="py-20 bg-gray-50">
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
            常见问题解答
            <span className="block text-gradient">为您答疑解惑</span>
          </motion.h2>
          <motion.p 
            variants={itemVariants}
            className="text-xl text-gray-600 max-w-3xl mx-auto"
          >
            我们整理了用户最关心的问题，如果您还有其他疑问，请随时联系我们的客服团队
          </motion.p>
        </motion.div>

        <motion.div
          className="max-w-4xl mx-auto"
          variants={containerVariants}
          initial="hidden"
          whileInView="visible"
          viewport={{ once: true }}
        >
          <div className="space-y-4">
            {faqs.map((faq) => {
              const isOpen = openItems.has(faq.id)
              
              return (
                <motion.div
                  key={faq.id}
                  variants={itemVariants}
                  className="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden"
                >
                  <button
                    onClick={() => toggleItem(faq.id)}
                    className="w-full px-8 py-6 text-left flex items-center justify-between hover:bg-gray-50 transition-colors duration-200"
                  >
                    <div className="flex items-center space-x-4">
                      <div className="w-8 h-8 bg-primary-100 rounded-full flex items-center justify-center flex-shrink-0">
                        <FiHelpCircle className="w-4 h-4 text-primary-600" />
                      </div>
                      <h3 className="text-lg font-semibold text-gray-900">
                        {faq.question}
                      </h3>
                    </div>
                    <div className="flex-shrink-0 ml-4">
                      {isOpen ? (
                        <FiMinus className="w-5 h-5 text-primary-600" />
                      ) : (
                        <FiPlus className="w-5 h-5 text-gray-400" />
                      )}
                    </div>
                  </button>
                  
                  <AnimatePresence>
                    {isOpen && (
                      <motion.div
                        initial={{ height: 0, opacity: 0 }}
                        animate={{ height: 'auto', opacity: 1 }}
                        exit={{ height: 0, opacity: 0 }}
                        transition={{ duration: 0.3 }}
                        className="overflow-hidden"
                      >
                        <div className="px-8 pb-6">
                          <div className="pl-12">
                            <p className="text-gray-700 leading-relaxed">
                              {faq.answer}
                            </p>
                          </div>
                        </div>
                      </motion.div>
                    )}
                  </AnimatePresence>
                </motion.div>
              )
            })}
          </div>
        </motion.div>

        <motion.div
          className="mt-16"
          variants={containerVariants}
          initial="hidden"
          whileInView="visible"
          viewport={{ once: true }}
        >
          <motion.div 
            variants={itemVariants}
            className="bg-white rounded-3xl p-12 shadow-2xl border border-gray-100 text-center"
          >
            <h3 className="text-3xl font-bold text-gray-900 mb-4">
              还有其他问题？
            </h3>
            <p className="text-xl text-gray-600 mb-8 max-w-2xl mx-auto">
              我们的专业客服团队随时为您提供帮助，解答您的任何疑问
            </p>
            
            <div className="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
              <div className="text-center">
                <div className="w-16 h-16 bg-primary-100 rounded-2xl flex items-center justify-center mx-auto mb-4">
                  <span className="text-2xl">📞</span>
                </div>
                <h4 className="font-semibold text-gray-900 mb-2">电话咨询</h4>
                <p className="text-gray-600">400-123-4567</p>
                <p className="text-sm text-gray-500">24/7全天候服务</p>
              </div>
              
              <div className="text-center">
                <div className="w-16 h-16 bg-primary-100 rounded-2xl flex items-center justify-center mx-auto mb-4">
                  <span className="text-2xl">💬</span>
                </div>
                <h4 className="font-semibold text-gray-900 mb-2">在线客服</h4>
                <p className="text-gray-600">即时响应</p>
                <p className="text-sm text-gray-500">平均响应时间 &lt; 30秒</p>
              </div>
              
              <div className="text-center">
                <div className="w-16 h-16 bg-primary-100 rounded-2xl flex items-center justify-center mx-auto mb-4">
                  <span className="text-2xl">📧</span>
                </div>
                <h4 className="font-semibold text-gray-900 mb-2">邮件支持</h4>
                <p className="text-gray-600">support@mcafee-lp.com</p>
                <p className="text-sm text-gray-500">24小时内回复</p>
              </div>
            </div>

            <div className="flex flex-col sm:flex-row gap-4 justify-center">
              <a href="tel:400-123-4567" className="btn-primary">
                立即咨询
              </a>
              <a href="mailto:support@mcafee-lp.com" className="btn-secondary">
                发送邮件
              </a>
            </div>
          </motion.div>
        </motion.div>
      </div>
    </section>
  )
}

