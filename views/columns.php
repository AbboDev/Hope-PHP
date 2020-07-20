<div class="main main--full">
	<section id="section-columns">
		<div class="container container--light_gray">
			<?php for ($index = 1; $index <= 12; $index++) { ?>
			<div class="row">
				<?php for ($i = 1; $i <= (12 / $index); $i++) { ?>
				<div class="column column--<?php echo $index; ?>">
					<div class="box box--element">
						<span>BOX <?php echo $index; ?></span>
					</div>
				</div>
				<?php if ((12 / $index) < 2 && $index !== 12) { ?>
				<div class="column column--<?php echo (12 - $index); ?>">
					<div class="box box--element">
						<span>BOX <?php echo (12 - $index); ?></span>
					</div>
				</div>
				<?php } elseif (($index * $i) === 10 && $index === 5) { ?>
				<div class="column column--2">
					<div class="box box--element">
						<span>BOX 2</span>
					</div>
				</div>
				<?php } ?>
				<?php } ?>
			</div>
			<?php } ?>
		</div>
	</section>
</div>