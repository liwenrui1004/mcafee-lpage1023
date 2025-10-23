import type { Metadata } from 'next'
import { Inter, Poppins } from 'next/font/google'
import './globals.css'
import { Toaster } from 'react-hot-toast'

const inter = Inter({ 
  subsets: ['latin'],
  variable: '--font-inter',
})

const poppins = Poppins({ 
  subsets: ['latin'],
  weight: ['300', '400', '500', '600', '700', '800', '900'],
  variable: '--font-poppins',
})

export const metadata: Metadata = {
  title: 'McAfee 官方优惠 - 2025年最佳防病毒软件推荐',
  description: '获取McAfee官方最新优惠，选择最适合您的网络安全解决方案。6种保护计划，30天退款保证，专业评测推荐。',
  keywords: 'McAfee, 防病毒软件, 网络安全, 优惠, 官方渠道, 安全防护',
  authors: [{ name: 'AntivirusProGuide' }],
  openGraph: {
    title: 'McAfee 官方优惠 - 2025年最佳防病毒软件推荐',
    description: '获取McAfee官方最新优惠，选择最适合您的网络安全解决方案。',
    type: 'website',
    locale: 'zh_CN',
  },
  twitter: {
    card: 'summary_large_image',
    title: 'McAfee 官方优惠 - 2025年最佳防病毒软件推荐',
    description: '获取McAfee官方最新优惠，选择最适合您的网络安全解决方案。',
  },
  robots: {
    index: true,
    follow: true,
  },
}

export default function RootLayout({
  children,
}: {
  children: React.ReactNode
}) {
  return (
    <html lang="zh-CN" className={`${inter.variable} ${poppins.variable}`}>
      <body className="font-sans antialiased">
        {children}
        <Toaster 
          position="top-right"
          toastOptions={{
            duration: 4000,
            style: {
              background: '#363636',
              color: '#fff',
            },
          }}
        />
      </body>
    </html>
  )
}
