import { SiteSettings, PricingPlan, Testimonial, FAQ, Feature, TrustBadge } from '@/types'

// Mock API functions - 在生产环境中应该连接到真实的API

export async function getSiteSettings(): Promise<SiteSettings> {
  // 模拟API调用
  return {
    heroTitle: 'McAfee 官方优惠',
    heroSubtitle: 'AI驱动全面保护，30天退款保证，专业评测推荐',
    heroCtaText: '立即获取优惠',
    heroCtaLink: '#pricing',
    countdownEndDate: new Date(Date.now() + 7 * 24 * 60 * 60 * 1000).toISOString(), // 7天后
  }
}

export async function getPricingPlans(): Promise<PricingPlan[]> {
  return [
    {
      id: '1',
      name: 'McAfee Antivirus',
      price: 199,
      originalPrice: 399,
      description: '基础防护套餐',
      features: [
        '1台设备保护',
        '病毒和恶意软件防护',
        '网页安全浏览',
        '防火墙保护',
        '自动更新',
      ],
      isPopular: false,
      ctaText: '立即购买',
      ctaLink: 'https://www.mcafee.com',
    },
    {
      id: '2',
      name: 'McAfee Total Protection',
      price: 299,
      originalPrice: 599,
      description: '全面防护套餐（推荐）',
      features: [
        '5台设备保护',
        '所有基础功能',
        '密码管理器',
        'VPN无限流量',
        '身份监控',
        '安全文件加密',
        '30天退款保证',
      ],
      isPopular: true,
      ctaText: '立即购买',
      ctaLink: 'https://www.mcafee.com',
    },
    {
      id: '3',
      name: 'McAfee Premium',
      price: 499,
      originalPrice: 999,
      description: '旗舰级防护套餐',
      features: [
        '无限设备保护',
        '所有Total Protection功能',
        '优先技术支持',
        '高级身份监控',
        '家长控制',
        '系统优化工具',
        '反垃圾邮件',
      ],
      isPopular: false,
      ctaText: '立即购买',
      ctaLink: 'https://www.mcafee.com',
    },
  ]
}

export async function getTestimonials(): Promise<Testimonial[]> {
  return [
    {
      id: '1',
      name: '张明',
      rating: 5,
      content: '使用McAfee已经三年了，非常稳定可靠。客服响应快，价格也很实惠。',
      location: '北京',
      plan: 'Total Protection'
    },
    {
      id: '2',
      name: '李娜',
      rating: 5,
      content: 'VPN功能特别好用，速度快又稳定。密码管理器也很方便，再也不用记那么多密码了。',
      location: '上海',
      plan: 'Premium'
    },
    {
      id: '3',
      name: '王强',
      rating: 5,
      content: '性价比很高，保护了全家人的设备。界面简洁，操作简单，老人也能轻松使用。',
      location: '广州',
      plan: 'Total Protection'
    },
    {
      id: '4',
      name: '赵敏',
      rating: 5,
      content: 'AI智能防护很强大，能够自动识别威胁。订阅后再也不担心网络安全问题了。',
      location: '深圳',
      plan: 'Premium'
    },
    {
      id: '5',
      name: '孙伟',
      rating: 4,
      content: '总体来说很不错，系统资源占用少，不影响电脑性能。客服服务也很到位。',
      location: '成都',
      plan: 'Antivirus'
    },
    {
      id: '6',
      name: '周芳',
      rating: 5,
      content: '家长控制功能非常实用，可以保护孩子的上网安全。价格也比其他安全软件便宜。',
      location: '杭州',
      plan: 'Total Protection'
    },
  ]
}

export async function getFAQs(): Promise<FAQ[]> {
  return [
    {
      id: '1',
      question: 'McAfee防病毒软件兼容哪些设备？',
      answer: 'McAfee Total Protection兼容Windows、Mac、iOS和Android设备。您可以在同一订阅下保护多台设备（根据所选套餐）。',
    },
    {
      id: '2',
      question: '如何激活我的McAfee订阅？',
      answer: '购买后，您将收到一封包含激活码和详细说明的电子邮件。只需下载McAfee应用程序，输入激活码即可开始使用。',
    },
    {
      id: '3',
      question: 'McAfee是否提供退款保证？',
      answer: '是的，我们提供30天退款保证。如果您对产品不满意，可以在购买后30天内申请全额退款。',
    },
    {
      id: '4',
      question: 'VPN服务有流量限制吗？',
      answer: 'McAfee Total Protection和Premium套餐包含无限VPN流量，可以安全浏览互联网，保护您的在线隐私。',
    },
    {
      id: '5',
      question: '我需要技术支持时该怎么办？',
      answer: '我们提供24/7客户支持。您可以通过电话、邮件或在线聊天联系我们的技术支持团队。Premium用户享有优先支持服务。',
    },
  ]
}

export async function getFeatures(): Promise<Feature[]> {
  return [
    {
      id: '1',
      title: 'AI智能防护',
      description: '采用最新的人工智能技术，实时学习和识别新型威胁，提供比传统防病毒软件更强大的保护。',
      icon: 'brain',
      category: '安全防护'
    },
    {
      id: '2',
      title: '全方位病毒防护',
      description: '实时扫描和清除病毒、木马、间谍软件等恶意程序，保护您的设备免受威胁。',
      icon: 'shield',
      category: '安全防护'
    },
    {
      id: '3',
      title: '智能防火墙',
      description: '监控和阻止可疑的网络活动，防止黑客入侵和数据泄露。',
      icon: 'lock',
      category: '安全防护'
    },
    {
      id: '4',
      title: 'VPN无限流量',
      description: '加密您的网络连接，保护在线隐私，安全访问各类网站和服务。',
      icon: 'wifi',
      category: '隐私保护'
    },
    {
      id: '5',
      title: '身份监控',
      description: '实时监控您的个人信息，一旦发现泄露立即通知，保护您的身份安全。',
      icon: 'eye',
      category: '隐私保护'
    },
    {
      id: '6',
      title: '密码管理器',
      description: '安全存储和管理所有密码，一键登录各类网站，再也不用记忆复杂密码。',
      icon: 'lock',
      category: '隐私保护'
    },
    {
      id: '7',
      title: '系统优化',
      description: '清理垃圾文件，优化系统性能，让您的设备运行更流畅。',
      icon: 'zap',
      category: '性能优化'
    },
    {
      id: '8',
      title: '安全下载',
      description: '在下载文件前自动扫描，确保下载的文件安全无毒。',
      icon: 'download',
      category: '性能优化'
    },
    {
      id: '9',
      title: '高性能引擎',
      description: '采用先进的扫描引擎，系统资源占用低，不影响设备性能。',
      icon: 'cpu',
      category: '性能优化'
    },
  ]
}

export async function getTrustBadges(): Promise<TrustBadge[]> {
  return [
    {
      id: '1',
      title: 'McAfee官方授权',
      description: '官方授权经销商，提供正版激活码和完整技术支持',
      icon: 'shield-check'
    },
    {
      id: '2',
      title: '权威机构认证',
      description: '通过AV-TEST、AV-Comparatives等权威机构认证',
      icon: 'certificate'
    },
    {
      id: '3',
      title: '24/7技术支持',
      description: '全天候中文客服支持，随时解答您的疑问',
      icon: 'headset'
    },
    {
      id: '4',
      title: '30天退款保证',
      description: '不满意无条件退款，让您购买无忧',
      icon: 'award'
    },
  ]
}
