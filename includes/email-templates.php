<?php
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Professional Email Template System
 */
class WNS_Email_Templates {
    
    public static function get_email_wrapper($content, $title = '') {
        $site_name = get_bloginfo('name');
        $site_url = home_url();
        $logo_url = get_site_icon_url(200) ?: $site_url . '/wp-content/uploads/2023/logo.png';
        
        return '
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>' . esc_html($title ?: $site_name) . '</title>
    <!--[if mso]>
    <noscript>
        <xml>
            <o:OfficeDocumentSettings>
                <o:PixelsPerInch>96</o:PixelsPerInch>
            </o:OfficeDocumentSettings>
        </xml>
    </noscript>
    <![endif]-->
    <style>
        /* Reset and base styles */
        body, table, td, p, a, li, blockquote {
            -webkit-text-size-adjust: 100%;
            -ms-text-size-adjust: 100%;
        }
        
        table, td {
            mso-table-lspace: 0pt;
            mso-table-rspace: 0pt;
        }
        
        img {
            -ms-interpolation-mode: bicubic;
            border: 0;
            height: auto;
            line-height: 100%;
            outline: none;
            text-decoration: none;
        }
        
        /* Main styles */
        body {
            margin: 0 !important;
            padding: 0 !important;
            background-color: #f8f9fa;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
            line-height: 1.6;
            color: #333333;
        }
        
        .email-container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }
        
        .email-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            padding: 30px 40px;
            text-align: center;
        }
        
        .email-header .logo {
            max-width: 60px;
            height: auto;
            margin-bottom: 15px;
            border-radius: 8px;
        }
        
        .email-header h1 {
            color: #ffffff;
            font-size: 24px;
            font-weight: 700;
            margin: 0;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        
        .email-body {
            padding: 40px;
        }
        
        .post-card {
            border: 1px solid #e9ecef;
            border-radius: 12px;
            overflow: hidden;
            margin-bottom: 30px;
            transition: transform 0.2s ease;
        }
        
        .post-image {
            width: 100%;
            height: 200px;
            object-fit: cover;
            display: block;
        }
        
        .post-content {
            padding: 25px;
        }
        
        .post-title {
            font-size: 22px;
            font-weight: 700;
            color: #2c3e50;
            margin: 0 0 15px 0;
            line-height: 1.3;
        }
        
        .post-title a {
            color: #2c3e50;
            text-decoration: none;
        }
        
        .post-title a:hover {
            color: #667eea;
        }
        
        .post-excerpt {
            color: #6c757d;
            font-size: 16px;
            line-height: 1.6;
            margin: 0 0 20px 0;
        }
        
        .post-meta {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-bottom: 20px;
            font-size: 14px;
            color: #6c757d;
        }
        
        .post-date {
            background-color: #f8f9fa;
            padding: 4px 12px;
            border-radius: 20px;
            font-weight: 500;
        }
        
        .read-more-btn {
            display: inline-block;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: #ffffff !important;
            padding: 12px 24px;
            border-radius: 25px;
            text-decoration: none;
            font-weight: 600;
            font-size: 14px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
        }
        
        .read-more-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(102, 126, 234, 0.4);
        }
        
        .email-footer {
            background-color: #f8f9fa;
            padding: 30px 40px;
            text-align: center;
            border-top: 1px solid #e9ecef;
        }
        
        .social-links {
            margin: 20px 0;
        }
        
        .social-links a {
            display: inline-block;
            margin: 0 10px;
            width: 40px;
            height: 40px;
            background-color: #667eea;
            border-radius: 50%;
            text-align: center;
            line-height: 40px;
            color: #ffffff !important;
            text-decoration: none;
            transition: all 0.3s ease;
        }
        
        .social-links a:hover {
            background-color: #764ba2;
            transform: translateY(-2px);
        }
        
        .footer-text {
            font-size: 14px;
            color: #6c757d;
            margin: 15px 0;
        }
        
        .unsubscribe-link {
            color: #6c757d !important;
            text-decoration: underline;
            font-size: 12px;
        }
        
        /* Responsive styles */
        @media only screen and (max-width: 600px) {
            .email-container {
                margin: 10px;
                border-radius: 8px;
            }
            
            .email-header,
            .email-body,
            .email-footer {
                padding: 20px !important;
            }
            
            .email-header h1 {
                font-size: 20px;
            }
            
            .post-title {
                font-size: 18px;
            }
            
            .post-content {
                padding: 20px;
            }
            
            .post-meta {
                flex-direction: column;
                align-items: flex-start;
                gap: 8px;
            }
        }
        
        /* Dark mode support */
        @media (prefers-color-scheme: dark) {
            .email-container {
                background-color: #1a1a1a;
            }
            
            .email-body {
                background-color: #1a1a1a;
                color: #e9ecef;
            }
            
            .post-card {
                background-color: #2d2d2d;
                border-color: #404040;
            }
            
            .post-title,
            .post-title a {
                color: #e9ecef;
            }
            
            .email-footer {
                background-color: #2d2d2d;
                border-color: #404040;
            }
        }
    </style>
</head>
<body>
    <div style="background-color: #f8f9fa; padding: 20px 0;">
        <div class="email-container">
            <div class="email-header">
                <img src="' . esc_url($logo_url) . '" alt="' . esc_attr($site_name) . '" class="logo">
                <h1>' . esc_html($site_name) . '</h1>
            </div>
            
            <div class="email-body">
                ' . $content . '
            </div>
            
            <div class="email-footer">
                ' . self::get_social_links() . '
                <div class="footer-text">
                    <p>You\'re receiving this email because you subscribed to our newsletter.</p>
                    <p><a href="{unsubscribe_link}" class="unsubscribe-link">Unsubscribe</a> | <a href="' . esc_url($site_url) . '" style="color: #6c757d;">Visit our website</a></p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>';
    }
    
    public static function get_new_post_template($post) {
        $post_title = get_the_title($post->ID);
        $post_url = get_permalink($post->ID);
        $post_excerpt = has_excerpt($post->ID) ? get_the_excerpt($post->ID) : wp_trim_words(strip_tags($post->post_content), 30);
        $post_date = get_the_date('F j, Y', $post->ID);
        $author_name = get_the_author_meta('display_name', $post->post_author);
        
        // Get featured image
        $featured_image = '';
        if (has_post_thumbnail($post->ID)) {
            $image_url = get_the_post_thumbnail_url($post->ID, 'large');
            $featured_image = '<img src="' . esc_url($image_url) . '" alt="' . esc_attr($post_title) . '" class="post-image">';
        }
        
        $content = '
        <div style="margin-bottom: 30px;">
            <h2 style="color: #2c3e50; font-size: 28px; font-weight: 700; margin: 0 0 20px 0; text-align: center;">
                🎉 New Post Published!
            </h2>
            <p style="text-align: center; color: #6c757d; font-size: 16px; margin: 0 0 30px 0;">
                We just published something new that we think you\'ll love.
            </p>
        </div>
        
        <div class="post-card">
            ' . $featured_image . '
            <div class="post-content">
                <div class="post-meta">
                    <span class="post-date">' . esc_html($post_date) . '</span>
                    <span>By ' . esc_html($author_name) . '</span>
                </div>
                
                <h3 class="post-title">
                    <a href="' . esc_url($post_url) . '">' . esc_html($post_title) . '</a>
                </h3>
                
                <p class="post-excerpt">' . esc_html($post_excerpt) . '</p>
                
                <div style="text-align: center; margin-top: 25px;">
                    <a href="' . esc_url($post_url) . '" class="read-more-btn">Read Full Article</a>
                </div>
            </div>
        </div>
        
        <div style="background-color: #f8f9fa; padding: 25px; border-radius: 8px; text-align: center; margin-top: 30px;">
            <h4 style="color: #2c3e50; margin: 0 0 15px 0;">Stay Connected</h4>
            <p style="color: #6c757d; margin: 0; font-size: 14px;">
                Don\'t miss out on our latest updates. Follow us on social media for more great content!
            </p>
        </div>';
        
        return self::get_email_wrapper($content, 'New Post: ' . $post_title);
    }
    
    public static function get_welcome_template($email) {
        $site_name = get_bloginfo('name');
        
        $content = '
        <div style="text-align: center; margin-bottom: 40px;">
            <h2 style="color: #2c3e50; font-size: 32px; font-weight: 700; margin: 0 0 15px 0;">
                Welcome to ' . esc_html($site_name) . '! 🎉
            </h2>
            <p style="color: #6c757d; font-size: 18px; margin: 0;">
                Thanks for joining our community of awesome readers!
            </p>
        </div>
        
        <div style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); padding: 30px; border-radius: 12px; text-align: center; margin: 30px 0;">
            <h3 style="color: #ffffff; font-size: 24px; margin: 0 0 15px 0;">
                You\'re All Set! ✨
            </h3>
            <p style="color: #ffffff; font-size: 16px; margin: 0; opacity: 0.9;">
                You\'ll now receive our latest posts and exclusive content directly in your inbox.
            </p>
        </div>
        
        <div style="background-color: #f8f9fa; padding: 25px; border-radius: 8px; margin: 30px 0;">
            <h4 style="color: #2c3e50; margin: 0 0 15px 0; text-align: center;">What to Expect</h4>
            <ul style="color: #6c757d; padding-left: 20px; margin: 0;">
                <li style="margin-bottom: 8px;">📧 Weekly newsletter with our best content</li>
                <li style="margin-bottom: 8px;">🚀 Instant notifications for new posts</li>
                <li style="margin-bottom: 8px;">💎 Exclusive content just for subscribers</li>
                <li style="margin-bottom: 8px;">🎯 No spam, just quality content</li>
            </ul>
        </div>
        
        <div style="text-align: center; margin: 30px 0;">
            <a href="' . esc_url(home_url()) . '" class="read-more-btn">Explore Our Website</a>
        </div>
        
        <div style="text-align: center; margin-top: 40px; padding-top: 30px; border-top: 1px solid #e9ecef;">
            <p style="color: #6c757d; font-size: 14px; margin: 0;">
                Have questions? Just reply to this email - we\'d love to hear from you!
            </p>
        </div>';
        
        return self::get_email_wrapper($content, 'Welcome to ' . $site_name);
    }
    
    public static function get_verification_template($verify_link) {
        $site_name = get_bloginfo('name');
        
        $content = '
        <div style="text-align: center; margin-bottom: 40px;">
            <h2 style="color: #2c3e50; font-size: 28px; font-weight: 700; margin: 0 0 15px 0;">
                Almost There! 🔐
            </h2>
            <p style="color: #6c757d; font-size: 16px; margin: 0;">
                Please verify your email address to complete your subscription.
            </p>
        </div>
        
        <div style="background-color: #fff3cd; border: 1px solid #ffeaa7; padding: 25px; border-radius: 8px; margin: 30px 0; text-align: center;">
            <h3 style="color: #856404; margin: 0 0 15px 0;">⚡ One Click Away</h3>
            <p style="color: #856404; margin: 0 0 20px 0;">
                Click the button below to verify your email and start receiving our awesome content!
            </p>
            <a href="' . esc_url($verify_link) . '" class="read-more-btn" style="background: linear-gradient(135deg, #f39c12 0%, #e67e22 100%);">
                Verify My Email
            </a>
        </div>
        
        <div style="background-color: #f8f9fa; padding: 20px; border-radius: 8px; margin: 30px 0;">
            <p style="color: #6c757d; font-size: 14px; margin: 0; text-align: center;">
                <strong>Can\'t click the button?</strong> Copy and paste this link into your browser:<br>
                <a href="' . esc_url($verify_link) . '" style="color: #667eea; word-break: break-all;">' . esc_url($verify_link) . '</a>
            </p>
        </div>
        
        <div style="text-align: center; margin-top: 30px;">
            <p style="color: #6c757d; font-size: 14px; margin: 0;">
                This verification link will expire in 24 hours for security reasons.
            </p>
        </div>';
        
        return self::get_email_wrapper($content, 'Verify Your Email - ' . $site_name);
    }
    
    public static function get_newsletter_template($subject, $content) {
        $formatted_content = '
        <div style="margin-bottom: 30px;">
            <h2 style="color: #2c3e50; font-size: 28px; font-weight: 700; margin: 0 0 20px 0; text-align: center;">
                📬 ' . esc_html($subject) . '
            </h2>
        </div>
        
        <div style="background-color: #ffffff; padding: 0; border-radius: 8px;">
            ' . wp_kses_post($content) . '
        </div>
        
        <div style="background-color: #f8f9fa; padding: 25px; border-radius: 8px; text-align: center; margin-top: 30px;">
            <h4 style="color: #2c3e50; margin: 0 0 15px 0;">Enjoying Our Content?</h4>
            <p style="color: #6c757d; margin: 0 0 15px 0; font-size: 14px;">
                Share this newsletter with friends who might be interested!
            </p>
            <a href="' . esc_url(home_url()) . '" class="read-more-btn">Visit Our Website</a>
        </div>';
        
        return self::get_email_wrapper($formatted_content, $subject);
    }
    
    private static function get_social_links() {
        $facebook = get_option('wns_facebook_url', '');
        $twitter = get_option('wns_twitter_url', '');
        $instagram = get_option('wns_instagram_url', '');
        $linkedin = get_option('wns_linkedin_url', '');
        
        $social_html = '<div class="social-links">';
        
        if ($facebook) {
            $social_html .= '<a href="' . esc_url($facebook) . '" target="_blank">📘</a>';
        }
        if ($twitter) {
            $social_html .= '<a href="' . esc_url($twitter) . '" target="_blank">🐦</a>';
        }
        if ($instagram) {
            $social_html .= '<a href="' . esc_url($instagram) . '" target="_blank">📷</a>';
        }
        if ($linkedin) {
            $social_html .= '<a href="' . esc_url($linkedin) . '" target="_blank">💼</a>';
        }
        
        $social_html .= '</div>';
        
        return $social_html;
    }
}