<div class="wrap center-align">
	<h1><span class="grey-text" style="font-size: 8rem">404</span> <br><br> Página não encontrada</h1>

	<p>
		<?php if (! empty($message) && $message !== '(null)') : ?>
		<?= esc($message) ?>
		<?php else : ?>
		Desculpe-nos! Não conseguimos encontrar a página que você está procurando.
		<?php endif ?>
	</p>
</div>
