<!DOCTYPE html>
<html lang="">
    <head>
        <!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-103782697-13"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-103782697-13');
</script>

        <link rel="shortcut icon" href="<?php echo base_url() ?>assets/images/favicon.ico" type="image/x-icon">
        <link rel="canonical" href="<?php echo base_url() ?>">
        <meta name="adx:sections" content="<?php echo base_url() ?>">
        <meta http-equiv="content-type" content="text/html">
        <meta charset="utf-8">
        <meta name="author" content="<?php echo base_url() ?>">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="<?php if(isset($seoDescription)) echo $seoDescription; ?>">
        <meta name="keywords" content="<?php if(isset($seoKeywords)) echo $seoKeywords; ?>">
        <meta property="og:type" content="website">
        <meta property="og:description" content="<?php if(isset($seoDescription)) echo $seoDescription; ?>">
        <meta property="og:url" content="<?php echo base_url() ?>">
        <meta property="og:site_name" content="">
        <meta property="og:title" content="<?php 
                if(isset($seoTitle))
                    echo $seoTitle;
                else
                    echo "Home";
            ?>" />
        <meta property="og:image"         content="" />
        <link rel="canonical" href="<?php echo base_url() ?>">
        <title>
            <?php 
                if(isset($seoTitle))
                    echo $seoTitle;
                else
                    echo "Home";
            ?>
        </title>
        
        <link href="<?php echo base_url() ?>assets/css/fe_styles.css?v=1.0.4" rel="stylesheet">
        <link href="<?php echo base_url() ?>assets/css/pl_common.css?v=1.0.4" rel="stylesheet">
        <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/responsive.css?v=1.0.4">
        <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/owl.carousel.min.css">
        <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/owl.theme.default.min.css">
        <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/smoothproducts.css">
        <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/datepicker.css">
        <link href="https://fonts.googleapis.com/css?family=Anton|Cormorant+Garamond|Roboto" rel="stylesheet">
        <link href="<?php echo base_url() ?>assets/css/font-awesome.min.css" rel="stylesheet">
        <link href="<?php echo base_url() ?>assets/css/pl_bootstrap.min.css" rel="stylesheet">
        <link href="<?php echo base_url() ?>public/theme/css/animate.css" rel="stylesheet">
        <link href="<?php echo base_url() ?>public/theme/css/styles.css" rel="stylesheet">
        <link href="<?php echo base_url() ?>public/theme/css/commons.css" rel="stylesheet">
        <script src="<?php echo base_url() ?>assets/js/pl_jquery.js"></script>
        <script src="<?php echo base_url() ?>assets/js/owl.carousel.js"></script>
    </head>
    <body>
        <div id="fb-root"></div>
        <script>(function(d, s, id) {
          var js, fjs = d.getElementsByTagName(s)[0];
          if (d.getElementById(id)) return;
          js = d.createElement(s); js.id = id;
          js.src = 'https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v2.12&appId=<?php echo $configs['iconsContactConfig']['value']->idAppFacebook; ?>&autoLogAppEvents=1';
          fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));</script>
        <?php $this->load->view('frontend/module/menu_mobile'); ?>
        <!-- END MENU MOBILE -->
        <!-- START CONTENT -->
        <div id="page-content">
            <div class="wrapper wrap-overflow">
                <!-- START HEADER -->
                <!-- <?php $this->load->view('frontend/module/top_bar'); ?> -->
                <?php $this->load->view('frontend/module/header'); ?>
                <!-- END HEADER -->
                <!-- START NAV MD LG -->
                <?php $this->load->view('frontend/module/menu'); ?>
                <!-- END NAV MD LG -->
                <!-- START COLLECTION -->
                <?php if(isset($component, $view))
                        $this->load->view('frontend/components/'.$component.'/'.$view);
                    else
                        $this->load->view('frontend/components/errors/Error404');
                ?>
                <!-- END COLLECTION -->
                <!-- START FOOTER -->
                <?php $this->load->view('frontend/module/footer'); ?>
                <?php $this->load->view('frontend/module/contact'); ?>
                <div class="mini-icon" style=" position: fixed; bottom: 0; right: 0;z-index: 999999 ">

                    <?php 

                        if (isset($configs['iconsContactConfig']['value']->frameSubizChat) && $configs['iconsContactConfig']['value']->frameSubizChat != '') {

                            echo $configs['iconsContactConfig']['value']->frameSubizChat;

                        }

                    ?>

                </div>
                <!-- END FOOTER -->
            </div>
        </div>
        <div class="modal wow bounceInUp modal-view-product" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content modal-view-product-result">
                    <div class="modal-header">
                        <h4>Chi tiết sản phẩm</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body modal-detail-product" style="padding: 5px;">
                    
                    </div>
                </div>
            </div>
        </div>
        <!-- END CONTENT -->
        <script src="<?php echo base_url() ?>public/theme/js/wow.min.js" type="text/javascript"></script>
        
        <script src="<?php echo base_url() ?>assets/js/smoothproducts.js"></script>
        <script src="<?php echo base_url() ?>assets/js/moment.js"></script>
        <script src="<?php echo base_url() ?>assets/js/datepicker.js"></script>
        <script>
            new WOW().init();
        </script>
        <script src="<?php echo base_url() ?>assets/js/pl_bootstrap.min.js"></script>
        <script src="<?php echo base_url() ?>assets/js/ScriptToolTip.js"></script>
        <script src="<?php echo base_url() ?>assets/js/jquery.toaster.js"></script>
        <script src="<?php echo base_url() ?>assets/js/uploadajax.js?v=1.0.4"></script>
        <script src="<?php echo base_url() ?>assets/js/ajax.js?v=1.0.4"></script>

        <script type="text/javascript">
            $(window).load(function() {
                $('.sp-wrap').smoothproducts();
            });
        </script>
        <script src="https://apis.google.com/js/platform.js" async defer></script>
        <?php 
            if(isset($seo_google)) {
                echo $seo_google;
            }
        ?>
        <?php 
            if(isset($seo_facebook)) {
                echo $seo_facebook;
            }
        ?>
<!-- Google Code dành cho Thẻ tiếp thị lại -->
<!--------------------------------------------------
Không thể liên kết thẻ tiếp thị lại với thông tin nhận dạng cá nhân hay đặt thẻ tiếp thị lại trên các trang có liên quan đến danh mục nhạy cảm. Xem thêm thông tin và hướng dẫn về cách thiết lập thẻ trên: http://google.com/ads/remarketingsetup
--------------------------------------------------->
<script type="text/javascript">
/* <![CDATA[ */
var google_conversion_id = 809110375;
var google_custom_params = window.google_tag_params;
var google_remarketing_only = true;
/* ]]> */
</script>
<script type="text/javascript" src="//www.googleadservices.com/pagead/conversion.js">
</script>
<noscript>
<div style="display:inline;">
<img height="1" width="1" style="border-style:none;" alt="" src="//googleads.g.doubleclick.net/pagead/viewthroughconversion/809110375/?guid=ON&amp;script=0"/>
</div>
</noscript>

    </body>
</html>