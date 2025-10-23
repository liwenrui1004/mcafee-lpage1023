export interface SiteSettings {
  heroTitle: string
  heroSubtitle: string
  heroCtaText: string
  heroCtaLink: string
  countdownEndDate: string
}

export interface PricingPlan {
  id: string
  name: string
  price: number
  originalPrice: number
  description: string
  features: string[]
  isPopular: boolean
  ctaText: string
  ctaLink: string
}


export interface FAQ {
  id: string
  question: string
  answer: string
}

export interface Feature {
  id: string
  title: string
  description: string
  icon: string
  category: string
}

export interface TrustBadge {
  id: string
  title: string
  description: string
  icon: string
}

export interface Testimonial {
  id: string
  name: string
  avatar?: string
  rating: number
  content: string
  location: string
  plan: string
}
