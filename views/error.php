<div class="main main--full">
	<section id="section-error">
		<div class="container">
			<?php if ($this->askToStorage("error") !== false) {
				$error = $this->askToStorage("error"); ?>
			<h1 class="text--<?php echo $error['status']; ?>">
				<?php echo $error['code']; ?>
			</h1>
			<h2>
				<?php echo $error['desc']; ?>
			</h2>
				<?php if ($error['status'] == "danger") { ?>
				<h3>Ops... questo è imbarazzante...</h3>
				<?php } elseif ($error['status'] == "confuse") { ?>
				<h3>Uhm... qualcosa è andato storto...</h3>
				<?php } ?>
			<?php } else { ?>
			<h1 class="text--confuse">
				Niente... errori...?
			</h1>
			<h2>
				E' quindi considerabile come un errore, essendo questa la pagina per gli errori?
			</h2>
			<?php } ?>
			<a class="button button--confuse" href="<?php echo HOME_PAGE; ?>">Ritorna alla Home</a>
		</div>
	</section>
</div>