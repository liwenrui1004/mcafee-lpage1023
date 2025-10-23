import HeroSection from '@/components/HeroSection'
import PricingTable from '@/components/PricingTable'
import FeaturesSection from '@/components/FeaturesSection'
import TestimonialsSection from '@/components/TestimonialsSection'
import TrustBadges from '@/components/TrustBadges'
import FAQSection from '@/components/FAQSection'
import Footer from '@/components/Footer'
import Header from '@/components/Header'

export default function Home() {
  return (
    <main className="min-h-screen bg-white">
      <Header />
      <HeroSection />
      <TrustBadges />
      <PricingTable />
      <FeaturesSection />
      <TestimonialsSection />
      <FAQSection />
      <Footer />
    </main>
  )
}
