<!doctype html>
<html lang="en-US">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title><?php echo $this->config->item('site_title'); if(isset($title))echo " ".$this->config->item('site_title_delimiter')." ".$title . ' | Dove Việt Nam';?></title>
    <meta name="description" content="Dove">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta property="og:url" content="<?php echo base_url(); ?>">
    <meta property="og:title" content="Tham dự sự kiện Dove Ngôi Nhà Hoa Lan Tỏa Sắc">
    <meta property="og:type" content="article" />
    <meta property="og:image" content="<?php echo base_url(); ?>public/fb-background.jpg">
    <meta property="og:description" content="Chia sẻ 1 đóa lan xanh tỏa sắc MANG TÊN BẠN để nhận vé dự sự kiện VIP với các đặc quyền hấp dẫn vào ngày 05 & 06/03/16 tại Hồ Bán Nguyệt Q7, HCM. Khám phá ngay!">

    <link rel="apple-touch-icon" href="<?php echo base_url(); ?>public/apple-touch-icon.png">
    <link rel="icon" href="<?php echo base_url(); ?>public/favicon.ico" type="image/vnd.microsoft.icon" />
    <!-- Place <?php echo base_url(); ?>public/favicon.ico in the root directory -->
    <link href='//fonts.googleapis.com/css?family=Open+Sans:300,400,700&subset=latin,latin-ext,vietnamese' rel='stylesheet' type='text/css'>

    <link rel="stylesheet" href="<?php echo base_url(); ?>public/styles/main.css">

    <script>
        window.fbAsyncInit = function() {
            FB.init({
                appId      : '<?php echo $this->config->item('app_id'); ?>',
                xfbml      : true,
                version    : 'v2.5'
            });
        };

        (function(d, s, id){
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) {return;}
            js = d.createElement(s); js.id = id;
            js.src = "//connect.facebook.net/en_US/sdk.js";
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));
    </script>

  <script>
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
      (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
      m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

    ga('create', 'UA-71704815-2', 'auto');
    ga('send', 'pageview');

  </script>

</head>
<body>

<?php echo $content; ?>

<script src="<?php echo base_url(); ?>public/scripts/main.js"></script>

<script src="<?php echo base_url(); ?>public/js/vendor/jquery.js"></script>
<script src="<?php echo base_url(); ?>public/scripts/util.js"></script>
<script src="<?php echo base_url(); ?>public/scripts/dove.function.js"></script>

</body>
</html>