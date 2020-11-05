<?php
/**
 * The template for displaying our CPT
 * @since	1.0.0
 */
?>
<!DOCTYPE html>
<html lang="it">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?php echo get_the_title( $post->ID, 'title', true ); ?></title>
</head>
<body>
	
	<h1><?php echo get_the_title( $post->ID, 'title', true ); ?></h1>
	<h2><?php echo get_post_meta( $post->ID, '_descrizione_pianta', true ); ?></h2>
	<h2><?php echo get_post_meta( $post->ID, '_dove_trovarla', true ); ?></h2>
	<?php echo get_the_post_thumbnail( $post->ID, 'large' ); ?>

	<ul>
		<?php
			if (get_the_terms( get_the_ID(), 'famiglia'  )) {
				foreach ( get_the_terms( get_the_ID(), 'famiglia' ) as $famiglia ) {
					echo '<li>' . __( $famiglia->name ) . '</li>';
				}
			}
		?>
	</ul>

	<ul>
		<?php
			if (get_the_terms( get_the_ID(), 'genere'  )) {
				foreach ( get_the_terms( get_the_ID(), 'genere' ) as $genere ) {
					echo '<li>' . __( $genere->name ) . '</li>';
				}
			}
		?>
	</ul>


</body>
</html>
<?php