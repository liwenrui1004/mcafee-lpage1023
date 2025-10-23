#!/usr/bin/env python3
"""
Simple Preview Server for McAfee Landing Page
Usage: python preview-server.py
Then open: http://localhost:8000
"""

import http.server
import socketserver
import os
import re

PORT = 8000

class PreviewHandler(http.server.SimpleHTTPRequestHandler):
    def do_GET(self):
        if self.path == '/':
            # Read the PHP file
            php_file = 'wordpress-integration/page-mcafee-landing.php'
            
            try:
                with open(php_file, 'r', encoding='utf-8') as f:
                    content = f.read()
                
                # Remove PHP code at the beginning
                content = re.sub(r'<\?php.*?\?>', '', content, flags=re.DOTALL, count=1)
                
                # Replace PHP variables with default values
                content = content.replace('<?php echo esc_url($mcafee_link); ?>', 'https://www.mcafee.com')
                content = content.replace('<?php echo esc_url($norton_link); ?>', 'https://www.norton.com')
                content = content.replace('<?php echo esc_url($bitdefender_link); ?>', 'https://www.bitdefender.com')
                
                # Replace WordPress functions
                content = content.replace('<?php language_attributes(); ?>', 'lang="en"')
                content = content.replace('<?php bloginfo(\'charset\'); ?>', 'UTF-8')
                content = content.replace('<?php wp_title(\'|\', true, \'right\'); bloginfo(\'name\'); ?>', 'McAfee Landing Page - English Preview')
                content = content.replace('<?php bloginfo(\'name\'); ?>', 'Cybersecurity Review Center')
                content = content.replace('<?php echo date(\'Y\'); ?>', '2025')
                content = content.replace('<?php echo antispambot(\'support@example.com\'); ?>', 'support@example.com')
                content = content.replace('<?php echo esc_url(home_url(\'/about\')); ?>', '#about')
                content = content.replace('<?php echo esc_url(home_url(\'/reviews\')); ?>', '#reviews')
                content = content.replace('<?php echo esc_url(home_url(\'/blog\')); ?>', '#blog')
                content = content.replace('<?php echo esc_url(home_url(\'/contact\')); ?>', '#contact')
                content = content.replace('<?php echo esc_url(home_url(\'/privacy-policy\')); ?>', '#privacy')
                content = content.replace('<?php echo esc_url(home_url(\'/terms-of-service\')); ?>', '#terms')
                content = content.replace('<?php echo esc_url(home_url(\'/affiliate-disclosure\')); ?>', '#affiliate')
                content = content.replace('<?php echo esc_url(home_url(\'/cookie-policy\')); ?>', '#cookie-policy')
                
                # Remove remaining PHP tags
                content = re.sub(r'<\?php.*?\?>', '', content, flags=re.DOTALL)
                content = content.replace('<?php wp_head(); ?>', '')
                content = content.replace('<?php body_class(); ?>', '')
                content = content.replace('<?php wp_body_open(); ?>', '')
                content = content.replace('<?php wp_footer(); ?>', '')
                
                # Send response
                self.send_response(200)
                self.send_header('Content-type', 'text/html; charset=utf-8')
                self.end_headers()
                self.wfile.write(content.encode('utf-8'))
                
            except Exception as e:
                self.send_error(500, f'Error: {str(e)}')
        else:
            super().do_GET()

# Change to script directory
os.chdir(os.path.dirname(os.path.abspath(__file__)))

# Set console encoding to UTF-8 for Windows
if os.name == 'nt':
    os.system('chcp 65001 >nul 2>&1')

print(f"""
===========================================================
   McAfee Landing Page - English Preview Server
===========================================================

Server is running on http://localhost:{PORT}

Instructions:
   1. Open your browser
   2. Go to: http://localhost:{PORT}
   3. View the English landing page!

Press Ctrl+C to stop the server

===========================================================
""")

try:
    with socketserver.TCPServer(("", PORT), PreviewHandler) as httpd:
        httpd.serve_forever()
except KeyboardInterrupt:
    print("\n\nServer stopped. Thank you!\n")

