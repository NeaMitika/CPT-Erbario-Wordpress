<?php
/**
 * The template for displaying archive for our CPT
 *
 * @since 1.0.0
 */
?>

<div class="tabella">

<?php
if(have_posts()) :
	while(have_posts()) : the_post(); ?>

		<div class="riga">
			<div class="nome-cognome col"><?php echo get_the_title( $post->ID, 'title', true ); ?> </div>
			<div class="data col"><?php echo get_post_meta($post->ID, 'data', true); ?>  </div>
			<div class="codice-barre col"><?php echo get_post_meta($post->ID, 'codice-barre', true); ?>  </div>
			<div class="prezzo-acquisto col"><?php echo get_post_meta($post->ID, 'prezzo-acquisto', true); ?>  </div>
			<div class="prezzo-vendita col"><?php echo get_post_meta($post->ID, 'location', true); ?>  </div>

		</div>

		<?php
	endwhile; 
endif;
?>

</div>

<?php

