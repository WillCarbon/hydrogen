<?php
namespace Carbonite\Theme;

class TrackingCodes
{
    public $googleAnalytics;
    public $googleTags;
    public $hotjarAnalytics;

    /**
     * TrackingCodes constructor.
     */
    public function __construct()
    {
        if( !class_exists('acf') )
            return;

        $this->googleAnalytics    = get_field('google_analytics', 'options')[0];
        $this->googleTags         = get_field('google_tags', 'options')[0];
        $this->hotjarAnalytics    = get_field('hotjar_analytics', 'options')[0];

        if($this->googleAnalytics['code'] != ''){
            add_action('wp_'.$this->googleAnalytics['location'], [$this, 'addGoogleAnalytics']);
        }

        if($this->hotjarAnalytics['code'] != ''){
            add_action('wp_'.$this->hotjarAnalytics['location'], [$this, 'addHotJarAnalytics']);
        }

        if($this->googleTags['code'] != ''){
            add_action('wp_'.$this->googleTags['location'], [$this, 'addGoogleTags']);
        }
    }

    /**
     * Add Google Analytics tracking code
     */
    public function addGoogleAnalytics()
    {
        echo '
        <!-- Global site tag (gtag.js) - Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id='.$this->googleAnalytics['code'].'"></script>
        <script>
         window.dataLayer = window.dataLayer || [];
         function gtag(){dataLayer.push(arguments);}
         gtag(\'js\', new Date());

         gtag(\'config\', \''.$this->googleAnalytics['code'].'\');
        </script>
        ';
    }

    /**
     * Add Hot Jar tracking code
     */
    public function addHotJarAnalytics()
    {
        echo '
        <!-- Hotjar Tracking Code -->
        <script>
            (function(h,o,t,j,a,r){
                h.hj=h.hj||function(){(h.hj.q=h.hj.q||[]).push(arguments)};
                h._hjSettings={hjid:'.$this->hotjarAnalytics['code'].',hjsv:5};
                a=o.getElementsByTagName(\'head\')[0];
                r=o.createElement(\'script\');r.async=1;
                r.src=t+h._hjSettings.hjid+j+h._hjSettings.hjsv;
                a.appendChild(r);
            })(window,document,\'//static.hotjar.com/c/hotjar-\',\'.js?sv=\');
        </script>
        ' ;
    }

    /**
     * Add Google Tags Manager tracking code
     */
    public function addGoogleTags()
    {
        echo '
        <!-- Google Tag Manager -->
        <script>
            (function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({\'gtm.start\':
            new Date().getTime(),event:\'gtm.js\'});var f=d.getElementsByTagName(s)[0],
            j=d.createElement(s),dl=l!=\'dataLayer\'?\'&l=\'+l:\'\';j.async=true;j.src=
            \'https://www.googletagmanager.com/gtm.js?id=\'+i+dl;f.parentNode.insertBefore(j,f);
        })(window,document,\'script\',\'dataLayer\',\''.$this->googleTags['code'].'\');
        </script>
        ' ;
    }
}
