<?php
namespace Carbonite\Theme;

class Activation
{
    public function __construct()
    {
        add_action('after_switch_theme', [$this, 'permalinks']);
        add_action('after_switch_theme', [$this, 'pages']);
    }

    /**
     * Set and refresh rewrite rules
     */
    public function permalinks()
    {
        global $wp_rewrite;
        $wp_rewrite->set_permalink_structure('/%postname%/');
        $wp_rewrite->flush_rules();
    }

    /**
     * Add Default Pages
     */
    public function pages()
    {
        if (isset($_GET['activated']) && is_admin()) {
            // Set Lorem Ipsum content
            $lorem = file_get_contents('http://loripsum.net/api');

            // Set Privacy content
            $policy = '<h3>What is this Privacy Policy for?</h3><p>This privacy policy is for this website <b>~[www.insertwebsiteurlhere.com]~</b> and served by <b>~[Insert Website Name Here]~</b> <span style="font-size: 1em;">and governs the privacy of its users who choose to use it.</span></p><p>The policy sets out the different areas where user privacy is concerned and outlines the obligations &amp; requirements of the users, the website and website owners. Furthermore, the way this website processes, stores and protects user data and information will also be detailed within this policy.</p><h3>The Website</h3><p>This website and its owners take a proactive approach to user privacy and ensure the necessary steps are taken to protect the privacy of its users throughout their visiting experience. This website complies with all UK national laws and requirements for user privacy.</p><h3>Use of Cookies</h3><p>This website uses cookies to better the users experience while visiting the website. Where applicable this website uses a cookie control system allowing the user on their first visit to the website to allow or disallow the use of cookies on their computer/device. This complies with recent legislation requirements for websites to obtain explicit consent from users before leaving behind or reading files such as cookies on a user’s computer/device.</p><p>Cookies are small files saved to the user’s computers hard drive that track, save and store information about the user’s interactions and usage of the website. This allows the website, through its server to provide the users with a tailored experience within this website.<br>Users are advised that if they wish to deny the use and saving of cookies from this website on to their computers hard drive they should take necessary steps within their web browsers security settings to block all cookies from this website and its external serving vendors.</p><p>This website uses tracking software to monitor its visitors to better understand how they use it. This software is provided by Google Analytics which uses cookies to track visitor usage. The software will save a cookie to your computers hard drive in order to track and monitor your engagement and usage of the website, but will not store, save or collect personal information. You can read Google’s privacy policy here for further information [ <a href="http://www.google.com/privacy.html" target="_blank" rel="noopener">http://www.google.com/privacy.html </a>].</p><p>Other cookies may be stored on your computers hard drive by external vendors when this website uses referral programs, sponsored links or adverts. Such cookies are used for conversion and referral tracking and typically expire after 30 days, though some may take longer. No personal information is stored, saved or collected.</p><h3>Contact &amp; Communication</h3><p>Users contacting this website and/or its owners do so at their own discretion and provide any such personal details requested at their own risk. Your personal information is kept private and stored securely until a time it is no longer required or has no use, as detailed in the Data Protection Act 1998. Every effort has been made to ensure a safe and secure form to email submission process but advises users using such form to email processes that they do so at their own risk.</p><p>This website and its owners use any information submitted to provide you with further information about the products/services they offer or to assist you in answering any questions or queries you may have submitted. This includes using your details to subscribe you to any email newsletter program the website operates but only if this was made clear to you and your express permission was granted when submitting any form to email process. Or whereby you the consumer have previously purchased from or enquired about purchasing from the company a product or service that the email newsletter relates to. This is by no means an entire list of your user rights in regard to receiving email marketing material. Your details are not passed on to any third parties.</p><h3>Email Newsletter</h3><p>This website operates an email newsletter program, used to inform subscribers about products and services supplied by this website. Users can subscribe through an online automated process should they wish to do so but do so at their own discretion. Some subscriptions may be manually processed through the prior written agreement with the user.</p><p>Subscriptions are taken in compliance with UK Spam Laws detailed in the Privacy and Electronic Communications Regulations 2003. All personal details relating to subscriptions are held securely and in accordance with the Data Protection Act 1998. No personal details are passed on to third parties nor shared with companies/people outside of the company that operates this website. Under the Data Protection Act 1998, you may request a copy of personal information held about you by this website’s email newsletter program. A small fee will be payable. If you would like a copy of the information held on you please write to the business address at the bottom of this policy.</p><p>Email marketing campaigns published by this website or its owners may contain tracking facilities within the actual email. Subscriber activity is tracked and stored in a database for future analysis and evaluation. Such tracked activity may include; the opening of emails, forwarding of emails, the clicking of links within the email content, times, dates, and frequency of activity [this is by no far a comprehensive list].<br>This information is used to refine future email campaigns and supply the user with more relevant content based on their activity.</p><p>In compliance with UK Spam Laws and the Privacy and Electronic Communications Regulations 2003 subscribers are given the opportunity to unsubscribe at any time through an automated system. This process is detailed in the footer of each email campaign. If an automated un-subscription system is unavailable clear instructions on how to unsubscribe will by detailed instead.</p><h3>External Links</h3><p>Although this website only looks to include quality, safe and relevant external links, users are advised adopt a policy of caution before clicking any external web links mentioned throughout this website.</p><p>The owners of this website cannot guarantee or verify the contents of any externally linked website despite their best efforts. Users should, therefore, note they click on external links at their own risk and this website and its owners cannot be held liable for any damages or implications caused by visiting any external links mentioned.</p><h3>Adverts and Sponsored Links</h3><p>This website may contain sponsored links and adverts. These will typically be served through our advertising partners, to whom may have detailed privacy policies relating directly to the adverts they serve.</p><p>Clicking on any such adverts will send you to the advertisers website through a referral program which may use cookies and will track the number of referrals sent from this website. This may include the use of cookies which may, in turn, be saved on your computers hard drive. Users should, therefore, note they click on sponsored external links at their own risk and this website and its owners cannot be held liable for any damages or implications caused by visiting any external links mentioned.</p><h3>Social Media Platforms</h3><p>Communication, engagement, and actions taken through external social media platforms that this website and its owners participate on are custom to the terms and conditions as well as the privacy policies held with each social media platform respectively.</p><p>Users are advised to use social media platforms wisely and communicate/engage upon them with due care and caution in regard to their own privacy and personal details. This website nor its owners will ever ask for personal or sensitive information through social media platforms and encourage users wishing to discuss sensitive details to contact them through primary communication channels such as by telephone or email.</p><p>This website may use social sharing buttons which help share web content directly from web pages to the social media platform in question. Users are advised before using such social sharing buttons that they do so at their own discretion and note that the social media platform may track and save your request to share a web page respectively through your social media platform account.</p><h3>Shortened Links in Social Media</h3><p>This website and its owners through their social media platform accounts may share web links to relevant web pages. By default, some social media platforms shorten lengthy URLs [web addresses] (this is an example: http://bit.ly/1U4FXPU).</p><p>Users are advised to take caution and good judgment before clicking any shortened URLs published on social media platforms by this website and its owners. Despite the best efforts to ensure only genuine URLs are published many social media platforms are prone to spam and hacking and therefore this website and its owners cannot be held liable for any damages or implications caused by visiting any shortened links.</p>';

            // Setup default pages
            $pages = [
                [
                    'title' => 'Home',
                    'content' => '',
                    'order' => '-1',
                    'frontpage' => true
                ],
                [
                    'title' => 'News',
                    'content' => '',
                    'order' => '1',
                    'blogpage' => true
                ],
                [
                    'title' => 'Cookies and Privacy Policy',
                    'content' => $policy,
                    'order' => '-1'
                ]
            ];

            // Delete the Sample Page
            wp_delete_post(2, true);

            // Loop through and add pages
            foreach ($pages as $page) {
                $pageExists = get_page_by_title($page['title']);
                if (!isset($pageExists)) {
                    $this->insertPost($page);
                }
            }
        }
    }

    /**
     * Insert the new page
     *
     * @param array $page
     */
    public function insertPost($page)
    {
        $title = $page['title'];
        $content = isset($page['content']) ? $page['content'] : '';
        $order = isset($page['order']) ? $page['order'] : 0;

        $pageData = [
            'post_type' => 'page',
            'post_title' => $title,
            'post_status' => 'publish',
            'post_content' => $content,
            'menu_order' => $order
        ];
        $newPage = wp_insert_post($pageData);

        if (isset($page['frontpage']) && $page['frontpage'] === true) {
            update_option('page_on_front', $newPage);
            update_option('show_on_front', 'page');
        }
        if (isset($page['blogpage']) && $page['blogpage'] === true) {
            update_option('page_for_posts', $newPage);
        }
    }

}
