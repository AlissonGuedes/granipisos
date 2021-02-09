<?php include "header.php"; ?>

<div class="tag_title">
  <div class="container">
    <div class="title_page1">CONTATO</div>
  </div>
</div>

<div class="container">
  <div class="img_empresa">
    <img src="img/img_contato.jpg" class="img_cem">
  </div>
  <div class="info_empresa">
    <div class="title1_empresa">FALE CONOSCO</div>
    <div class="title2_empresa">PREENCHA O FORMULÁRIO ABAIXO E NOS ENVIE</div>
    <form method="post" action="">
      <input type="text" name="nome" class="input_form" placeholder="Seu Nome" required>
      <input type="email" name="email" class="input_form" placeholder="Seu e-mail" required>
      <input type="number" name="fone" class="input_form" placeholder="Seu Telefone" required>
      <input type="text" name="assunto" class="input_form" placeholder="Assunto" required>
      <textarea name="mensagem" class="input_form" placeholder="Escreva a sua mensagem aqui" rows="5" style="font-family: 'Montserrat', sans-serif;" required></textarea>
      <input type="submit" class="bt_enviar" name="ENVIAR">
    </form>
  </div>
</div>

<br><br>

<!--SEJA UM DISTRIBUIDOR -->
<?php include "s_contato.php"; ?>

<!--Google Maps-->
<div class="mapag">
  <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1315.1283705198737!2d-50.4258596078572!3d-21.20229624860985!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x9496415a03ef5e89%3A0x6de181779a029358!2sR.%20S%C3%A3o%20Domingos%20-%20Santa%20Luzia%2C%20Ara%C3%A7atuba%20-%20SP!5e0!3m2!1spt-BR!2sbr!4v1600775797319!5m2!1spt-BR!2sbr" class="size_map" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
</div>

<!--FOOTER -->
<?php include "footer.php"; ?>
