<?php include "header.php"; ?>

<div class="tag_title">
  <div class="container">
    <div class="title_page1">DISTRIBUIDOR</div>
  </div>
</div>

<div class="container">
  <div class="img_empresa">
    <img src="img/img_distribuidor.jpg" class="img_cem">
  </div>
  <div class="info_empresa">
    <div class="title1_empresa">QUERO SER UM DISTRIBUIDOR</div>
    <div class="title2_empresa">PREENCHA O FORMULÁRIO ABAIXO E NOS ENVIE</div>
    <form method="post" action="">
      <input type="text" name="nome" class="input_form" placeholder="Seu Nome" required>
      <input type="email" name="email" class="input_form" placeholder="Seu e-mail" required>
      <input type="number" name="fone" class="input_form" placeholder="Seu Telefone" required>
      <input type="text" name="cidade" class="input_form" placeholder="Em qual cidade você irá fazer a distribuição?" required>
      <input type="submit" class="bt_enviar" name="ENVIAR">
    </form>
  </div>
</div>


<br><br>


<div class="modo_usar">
  <div class="container">
    <div class="title_2">VANTAGENS</div>
    <div class="text_modo">
      Produtos de Altíssima Qualidade<BR>
Alta Lucratividade <BR>
Suporte Técnico <BR>
Trabalhe de acordo com seu horário
    </div>
  </div>
</div>



<!--SEJA UM DISTRIBUIDOR -->
<?php include "s_contato.php"; ?>

<!--FOOTER -->
<?php include "footer.php"; ?>
