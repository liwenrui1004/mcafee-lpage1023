'use client'

import { useState, useEffect } from 'react'
import { motion } from 'framer-motion'
import { FiStar, FiUser } from 'react-icons/fi'
import { BsChatQuote } from 'react-icons/bs'
import { Swiper, SwiperSlide } from 'swiper/react'
import { Navigation, Pagination, Autoplay } from 'swiper/modules'
import { getTestimonials } from '@/lib/api'
import { Testimonial } from '@/types'

// Import Swiper styles
import 'swiper/css'
import 'swiper/css/navigation'
import 'swiper/css/pagination'

export default function TestimonialsSection() {
  const [testimonials, setTestimonials] = useState<Testimonial[]>([])

  useEffect(() => {
    const fetchTestimonials = async () => {
      const testimonialsData = await getTestimonials()
      setTestimonials(testimonialsData)
    }
    fetchTestimonials()
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

  const renderStars = (rating: number) => {
    return Array.from({ length: 5 }, (_, index) => (
      <FiStar
        key={index}
        className={`w-5 h-5 ${
          index < rating ? 'text-yellow-400 fill-current' : 'text-gray-300'
        }`}
      />
    ))
  }

  return (
    <section id="testimonials" className="py-20 bg-white">
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
            用户真实评价
            <span className="block text-gradient">50万+用户的选择</span>
          </motion.h2>
          <motion.p 
            variants={itemVariants}
            className="text-xl text-gray-600 max-w-3xl mx-auto"
          >
            听听我们的用户是如何评价McAfee安全防护服务的
          </motion.p>
        </motion.div>

        {/* Testimonials Carousel */}
        <motion.div
          variants={containerVariants}
          initial="hidden"
          whileInView="visible"
          viewport={{ once: true }}
        >
          <Swiper
            modules={[Navigation, Pagination, Autoplay]}
            spaceBetween={30}
            slidesPerView={1}
            navigation
            pagination={{ clickable: true }}
            autoplay={{
              delay: 5000,
              disableOnInteraction: false,
            }}
            breakpoints={{
              768: {
                slidesPerView: 2,
              },
              1024: {
                slidesPerView: 3,
              },
            }}
            className="testimonials-swiper"
          >
            {testimonials.map((testimonial) => (
              <SwiperSlide key={testimonial.id}>
                <motion.div
                  variants={itemVariants}
                  className="bg-white rounded-2xl p-8 shadow-lg hover:shadow-xl transition-all duration-300 border border-gray-100 h-full"
                >
                  {/* Quote Icon */}
                  <div className="flex justify-center mb-6">
                    <div className="w-12 h-12 bg-primary-100 rounded-full flex items-center justify-center">
                      <BsChatQuote className="w-6 h-6 text-primary-600" />
                    </div>
                  </div>

                  {/* Rating */}
                  <div className="flex justify-center mb-4">
                    <div className="flex space-x-1">
                      {renderStars(testimonial.rating)}
                    </div>
                  </div>

                  {/* Content */}
                  <p className="text-gray-700 text-center mb-6 leading-relaxed">
                    "{testimonial.content}"
                  </p>

                  {/* User Info */}
                  <div className="text-center">
                    <div className="flex items-center justify-center mb-2">
                      <div className="w-12 h-12 bg-gray-200 rounded-full flex items-center justify-center mr-3">
                        {testimonial.avatar ? (
                          <img
                            src={testimonial.avatar}
                            alt={testimonial.name}
                            className="w-12 h-12 rounded-full object-cover"
                          />
                        ) : (
                          <FiUser className="w-6 h-6 text-gray-500" />
                        )}
                      </div>
                      <div>
                        <h4 className="font-semibold text-gray-900">{testimonial.name}</h4>
                        <p className="text-sm text-gray-600">{testimonial.location}</p>
                      </div>
                    </div>
                    <div className="text-sm text-primary-600 font-medium">
                      {testimonial.plan}
                    </div>
                  </div>
                </motion.div>
              </SwiperSlide>
            ))}
          </Swiper>
        </motion.div>

        {/* Stats Section */}
        <motion.div
          className="mt-20"
          variants={containerVariants}
          initial="hidden"
          whileInView="visible"
          viewport={{ once: true }}
        >
          <motion.div 
            variants={itemVariants}
            className="bg-gradient-to-r from-primary-600 to-accent-600 rounded-3xl p-12 text-white"
          >
            <div className="grid grid-cols-1 md:grid-cols-4 gap-8 text-center">
              <div>
                <div className="text-4xl font-bold mb-2">50万+</div>
                <div className="text-primary-100">满意用户</div>
              </div>
              <div>
                <div className="text-4xl font-bold mb-2">99.9%</div>
                <div className="text-primary-100">客户满意度</div>
              </div>
              <div>
                <div className="text-4xl font-bold mb-2">4.9/5</div>
                <div className="text-primary-100">平均评分</div>
              </div>
              <div>
                <div className="text-4xl font-bold mb-2">24/7</div>
                <div className="text-primary-100">技术支持</div>
              </div>
            </div>
          </motion.div>
        </motion.div>

        {/* Trust Indicators */}
        <motion.div
          className="mt-16"
          variants={containerVariants}
          initial="hidden"
          whileInView="visible"
          viewport={{ once: true }}
        >
          <motion.div 
            variants={itemVariants}
            className="text-center"
          >
            <h3 className="text-2xl font-bold text-gray-900 mb-8">
              权威机构认证
            </h3>
            <div className="grid grid-cols-2 md:grid-cols-4 gap-8 items-center opacity-60">
              <div className="bg-gray-100 rounded-lg p-6 h-20 flex items-center justify-center">
                <span className="text-gray-500 font-semibold">AV-TEST</span>
              </div>
              <div className="bg-gray-100 rounded-lg p-6 h-20 flex items-center justify-center">
                <span className="text-gray-500 font-semibold">AV-Comparatives</span>
              </div>
              <div className="bg-gray-100 rounded-lg p-6 h-20 flex items-center justify-center">
                <span className="text-gray-500 font-semibold">SE Labs</span>
              </div>
              <div className="bg-gray-100 rounded-lg p-6 h-20 flex items-center justify-center">
                <span className="text-gray-500 font-semibold">MRG Effitas</span>
              </div>
            </div>
          </motion.div>
        </motion.div>
      </div>
    </section>
  )
}
