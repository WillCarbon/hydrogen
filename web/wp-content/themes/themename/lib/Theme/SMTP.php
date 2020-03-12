<?php

namespace Carbonite\Theme;

/**
 * Class SMTP
 * @package Carbonite\Theme
 */
class SMTP
{
    /**
     * SMTP constructor.
     */
    public function __construct()
    {
        add_action('phpmailer_init', [$this, 'add_relay']);
    }

    /**
     * Integrate external SMTP Relay with WP's PHP Mailer
     *
     * @param \PHPMailer $PHPMailer
     */
    public function add_relay($PHPMailer)
    {
        $PHPMailer->Mailer = 'smtp';

        /**
         * Uncomment to overwrite sender with Admin email
         * Only if there are issues
         */
        #$PHPMailer->From = get_option('admin_email');
        #$PHPMailer->FromName = get_option('blogname');
        #$PHPMailer->Sender = $PHPMailer->From;

        $PHPMailer->Host = SMTP_HOST;
        $PHPMailer->Port = SMTP_PORT;
        $PHPMailer->SMTPSecure = SMTP_SECURE;

        $PHPMailer->SMTPAuth = true;
        $PHPMailer->Username = SMTP_USERNAME;
        $PHPMailer->Password = SMTP_PASSWORD;
    }

}
