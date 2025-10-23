/** @type {import('next').NextConfig} */
const nextConfig = {
  images: {
    domains: ['localhost', 'res.cloudinary.com'],
  },
  env: {
    STRAPI_URL: process.env.STRAPI_URL || 'http://localhost:1337',
  },
}

module.exports = nextConfig
