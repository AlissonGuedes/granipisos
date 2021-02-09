<!doctype html>
<!--[if lt IE 8 ]><html class="ie ie7" lang="pt-bt"> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="pt-br"> <![endif]-->
<!--[if (gte IE 8)|!(IE)]><!--><html lang="pt-br">
<!--<![endif]-->

<head>
  <script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
  <script src="http://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
  <script src="js/rolagem.js" type="text/javascript"></script>
  <script src="js/lightbox.js"></script>
  <script src="js/circle_plugin.js"></script>
  <script type="text/javascript" src="js/easySlider1.7.js"></script>
  <script type="text/javascript" src="js/customizado.js"></script>
  <script type="text/javascript" src="js/rhinoslider-1.05.min.js"></script>
  <script type="text/javascript" src="js/mousewheel.js"></script>
  <script type="text/javascript" src="js/easing.js"></script>
  <script type="text/javascript" src="engine1/jquery.js"></script>
  <script type="text/javascript" src="js/customizado.js"></script>
  <script type="text/javascript" src="js/jssor.slider.mini.js"></script>
  <script type="text/javascript" src="js/jquery.scrollbox.js"></script>
  <script type="text/javascript" src="js/depoimento.js"></script>
  <script type="text/javascript" src="js/sss.js"></script>
  <script type="text/javascript" src="js/jquery.pikachoose.min.js"></script>
  <script type="text/javascript" src="js/jquery.touchwipe.min.js"></script>


  <script language="javascript">
    $(document).ready(
      function (){
        $("#pikame").PikaChoose();
      });
  </script>


<script>
$(function(){
    $("#bt_menu, #bt_interesse, #bt_x").click(function(e){
        el = $(this).data('element');
        $(el).toggle();
    });
});
</script>

<script>
  $(window).on('load', function (){
    document.getElementById("carregando").style.display = "none";
    document.getElementById("corpo").style.display = "block";
  })

  /*var intervalo = setInterval(function (){
    clearInterval(intervalo);

    document.getElementById("carregando").style.display = "none";
    document.getElementById("corpo").style.display = "block";
  },5000
);*/
</script>


<script type="text/javascript" src="js/jssor.slider.mini.js"></script>

    <!-- use jssor.slider.debug.js instead for debug -->
    <script>
        jQuery(document).ready(function ($) {

            var jssor_1_SlideoTransitions = [
              [{b:5500,d:3000,o:-1,r:240,e:{r:2}}],
              [{b:-1,d:1,o:-1,c:{x:51.0,t:-51.0}},{b:0,d:1000,o:1,c:{x:-51.0,t:51.0},e:{o:7,c:{x:7,t:7}}}],
              [{b:-1,d:1,o:-1,sX:9,sY:9},{b:1000,d:1000,o:1,sX:-9,sY:-9,e:{sX:2,sY:2}}],
              [{b:-1,d:1,o:-1,r:-180,sX:9,sY:9},{b:2000,d:1000,o:1,r:180,sX:-9,sY:-9,e:{r:2,sX:2,sY:2}}],
              [{b:-1,d:1,o:-1},{b:3000,d:2000,y:180,o:1,e:{y:16}}],
              [{b:-1,d:1,o:-1,r:-150},{b:7500,d:1600,o:1,r:150,e:{r:3}}],
              [{b:10000,d:2000,x:-379,e:{x:7}}],
              [{b:10000,d:2000,x:-379,e:{x:7}}],
              [{b:-1,d:1,o:-1,r:288,sX:9,sY:9},{b:9100,d:900,x:-1400,y:-660,o:1,r:-288,sX:-9,sY:-9,e:{r:6}},{b:10000,d:1600,x:-200,o:-1,e:{x:16}}]
            ];

            var jssor_1_options = {
              $AutoPlay: true,
              $SlideDuration: 2000,
              $SlideEasing: $Jease$.$OutQuint,
              $CaptionSliderOptions: {
                $Class: $JssorCaptionSlideo$,
                $Transitions: jssor_1_SlideoTransitions
              },
              $ArrowNavigatorOptions: {
                $Class: $JssorArrowNavigator$
              },
              $BulletNavigatorOptions: {
                $Class: $JssorBulletNavigator$
              }
            };

            var jssor_1_slider = new $JssorSlider$("jssor_1", jssor_1_options);

            //responsive code begin
            //you can remove responsive code if you don't want the slider scales while window resizing
            function ScaleSlider() {
                var refSize = jssor_1_slider.$Elmt.parentNode.clientWidth;
                if (refSize) {
                    refSize = Math.min(refSize, 1920);
                    jssor_1_slider.$ScaleWidth(refSize);
                }
                else {
                    window.setTimeout(ScaleSlider, 30);
                }
            }
            ScaleSlider();
            $(window).bind("load", ScaleSlider);
            $(window).bind("resize", ScaleSlider);
            $(window).bind("orientationchange", ScaleSlider);
            //responsive code end
        });
    </script>







<!--- CONFIGURAÇÕES BÁSICAS
   ================================================== -->
	<meta charset="utf-8">
	<title>Raboni Cosméticos</title>
	<meta name="Raboni Cosméticos" content="Raboni Cosméticos">

  <meta name="description" content="" />
  <meta name="keywords" content="" />
  <meta name="robots" content="index, follow">

   <!-- Mobile Especificações Metas
  ================================================== -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

	<!-- CSS
   ================================================== -->
	<link rel="stylesheet" href="css/layout.css">
  <link rel="stylesheet" href="css/lightbox.css">
  <link href="css/sss.css" rel="stylesheet">
  <link type="text/css" href="css/css3.css" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">

  <!-- Tema navegador
  ================================================== -->
  <meta name="theme-color" content="#470926">
  <meta name="apple-mobile-web-app-status-bar-style" content="#470926">
  <meta name="msapplication-navbutton-color" content="#470926">

   <!-- Favicons
	================================================== -->
	<link rel="shortcut icon" href="favicon.png" >
</head>

<body>
<div class="carregando" id="carregando">
  <div class="logo_carregando">
    <img src="img/logo_carregando.png" class="img_cem"><br>
    <div class="loading_gif"><img src="img/loading2.gif" class="img_cem"></div>
  </div>
</div>

<div class="corpo" id="corpo">

<!-- Conteúdo LIBRAS -->

 <div vw class="enabled">
   <div vw-access-button class="active"></div>
   <div vw-plugin-wrapper>
     <div class="vw-plugin-top-wrapper"></div>
   </div>
 </div>
 <script src="https://vlibras.gov.br/app/vlibras-plugin.js"></script>
 <script>
   new window.VLibras.Widget('https://vlibras.gov.br/app');
 </script>


<header>

  <!--header-->
  <div class="container">
    <nav class="menu1">
      <a href="index.php"><div class="lk">HOME</div></a>
      <a href="quemsomos.php"><div class="lk">QUEM SOMOS</div></a>
      <ul>
        <li><a href=""><div class="lk">PRODUTOS</div></a>
          <ul>
            <li><a href="produtos_categ.php"><div class="lk_sub">Alisamento</div></a></li>
            <li><a href="produtos_categ.php"><div class="lk_sub">Tratamento Capilar</div></a></li>
          </ul>
        </li>
      </ul>
    </nav>
    <div class="shadow_l">
      <img src="img/shadow_left.png" class="img_cem">
    </div>
    <div class="logo">
      <img src="img/logo.png" class="img_cem">
    </div>
    <div class="shadow_r">
      <img src="img/shadow_right.png" class="img_cem">
    </div>
    <nav class="menu2">
      <a href="distribuidor.php"><div class="lk">DISTRIBUIDOR</div></a>
      <a href="contato.php"><div class="lk">CONTATO</div></a>
      <div class="social">
        <a href="https://www.facebook.com/Rabonicosmeticos" target="_blank"><div class="icon_social"><img src="img/icons/icon_face.png" class="img_cem"></div></a>
        <a href="https://www.instagram.com/rabonicosmeticos/" target="_blank"><div class="icon_social"><img src="img/icons/icon_insta.png" class="img_cem"></div></a>
      </div>
    </nav>
  </div>


  <!--botão mobile-->
  <div class="bt_menu_mob" data-element=".menu_mob" id="bt_menu">
    <img src="img/bt_mob.png" class="img_cem">
  </div>

  <div class="social_m">
    <a href="https://www.facebook.com/Rabonicosmeticos" target="_blank"><div class="icon_social"><img src="img/icons/icon_face.png" class="img_cem"></div></a>
    <a href="https://www.instagram.com/rabonicosmeticos/" target="_blank"><div class="icon_social"><img src="img/icons/icon_insta.png" class="img_cem"></div></a>
  </div>


</header>

<!--menu mobile-->
<div class="menu_mob">
  <ul>
    <li><a href="index.php"><div class="lk_mob">Home</div></a></li>
    <li><a href="quemsomos.php"><div class="lk_mob">Quem Somos</div></a></li>
    <li><div class="lk_mob">Produtos</div>
      <ul>
        <li><a href="produtos_categ.php"><div class="sub_mob">Alisamento</div></a>
        <li><a href="produtos_categ.php"><div class="sub_mob">Tratamento Capilar</div></a>
      </ul>
    </li>
    <li><a href="distribuidor.php"><div class="lk_mob">Distribuidor</div></a></li>
    <li><a href="contato.php"><div class="lk_mob">Contato</div></a></li>
  </ul>
</div>
