<?php
/**
 * The template for displaying our CPT
 * @since	1.0.0
 */
?>
<!doctype html>
<html <?php language_attributes(); ?>>
	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="profile" href="https://gmpg.org/xfn/11">
		<!-- Favicons -->
		<link rel="apple-touch-icon" sizes="180x180" href="<?php echo get_stylesheet_directory_uri();?>/img/favicon/apple-touch-icon.png">
		<link rel="icon" type="image/png" sizes="32x32" href="<?php echo get_stylesheet_directory_uri();?>/img/favicon/favicon-32x32.png">
		<link rel="icon" type="image/png" sizes="16x16" href="<?php echo get_stylesheet_directory_uri();?>/img/favicon/favicon-16x16.png">
		<link rel="manifest" href="<?php echo get_stylesheet_directory_uri();?>/img/favicon/site.webmanifest">
		<link rel="mask-icon" href="<?php echo get_stylesheet_directory_uri();?>/img/favicon/safari-pinned-tab.svg" color="#0d6efd">
		<meta name="msapplication-TileColor" content="#ffffff">
		<meta name="theme-color" content="#ffffff">
		<title><?php echo get_the_title( $post->ID, 'title', true ); ?></title>
		<!-- Loads the internal WP jQuery -->
		<?php wp_enqueue_script('jquery'); ?>
		<?php wp_head(); ?>
	</head>

	<body class="container-fluid">
		<div class="row min-vh-100">
			<div class="col-lg-5">
				<div class="sticky-top pt-lg-1 px-lg-4 text-center">
					<h1 class="text-center m-0 pt-4 josefin-normal-600 fs-1"><?php echo get_the_title( $post->ID, 'title', true ); ?></h1>
					<p class="fst-italic fs-6 m-0 josefin-normal-600">Leucanthemum vulgare</p>
					<figure class="figure mb-0 pt-4">	
						<?php echo get_the_post_thumbnail( $post->ID, array('500', '600'), array('class' => 'figure-img img-fluid rounded img-thumbnail w-75') ); ?> 
					</figure>

					<div class="py-4 d-flex justify-content-around erbario">
						<a tabindex="0" class="btn btn-lg" role="button" data-bs-toggle="popover" data-bs-trigger="active" title="Dismissible popover" data-bs-content="And here's some amazing content. It's very engaging. Right?"><i class="fab fa-canadian-maple-leaf"></i></a>
						<a tabindex="0" class="btn btn-lg" role="button" data-bs-toggle="popover" data-bs-trigger="active" title="Dismissible popover" data-bs-content="And here's some amazing content. It's very engaging. Right?"><i class="fas fa-seedling"></i></a>
						<a tabindex="0" class="btn btn-lg" role="button" data-bs-toggle="popover" data-bs-trigger="active" title="Dismissible popover" data-bs-content="And here's some amazing content. It's very engaging. Right?"><i class="fas fa-snowflake"></i></a>
						<a tabindex="0" class="btn btn-lg" role="button" data-bs-toggle="popover" data-bs-trigger="active" title="Dismissible popover" data-bs-content="And here's some amazing content. It's very engaging. Right?"><i class="fas fa-sun"></i></a>
						<a tabindex="0" class="btn btn-lg" role="button" data-bs-toggle="popover" data-bs-trigger="active" title="É comestibile?" data-bs-content="I germogli primaverili possono essere aggiunti alle insalate, ma devono essere usati con parsimonia."><i class="fas fa-utensils"></i></a>
					</div>

					<!-- Nav tabs -->
					<ul class="nav nav-tabs justify-content-between" id="myTab" role="tablist">
						<li class="nav-item" role="presentation">
						<button class="nav-link active" id="genere-tab" data-bs-toggle="tab" data-bs-target="#genere" type="button" role="tab" aria-controls="genere" aria-selected="true">Genere</button>
						</li>
						<li class="nav-item" role="presentation">
						<button class="nav-link" id="famiglia-tab" data-bs-toggle="tab" data-bs-target="#famiglia" type="button" role="tab" aria-controls="famiglia" aria-selected="false">Famiglia</button>
						</li>
						<li class="nav-item" role="presentation">
						<button class="nav-link" id="dominio-tab" data-bs-toggle="tab" data-bs-target="#dominio" type="button" role="tab" aria-controls="dominio" aria-selected="false">Dominio</button>
						</li>    
						<li class="nav-item" role="presentation">
						<button class="nav-link" id="regno-tab" data-bs-toggle="tab" data-bs-target="#regno" type="button" role="tab" aria-controls="regno" aria-selected="false">Regno</button>
						</li>    
					</ul>                
					<!-- Tab panes -->
					<div class="tab-content text-start p-lg-2 container p-3 mb-4">
						<div class="tab-pane active" id="genere" role="tabpanel" aria-labelledby="genere-tab">		
							<?php
								if (get_the_terms( get_the_ID(), 'genere'  )) {
									foreach ( get_the_terms( get_the_ID(), 'genere' ) as $genere ) {
										echo '<h5>' .$genere->name. '</h5>';
										echo $genere->description;
									}
								}
							?>
						</div>
						<div class="tab-pane" id="famiglia" role="tabpanel" aria-labelledby="famiglia-tab">
							<?php
								if (get_the_terms( get_the_ID(), 'famiglia'  )) {
									foreach ( get_the_terms( get_the_ID(), 'famiglia' ) as $famiglia ) {
										echo '<h5>' .$famiglia->name. '</h5>';
										echo $famiglia->description;
									}
								}
							?>										
						</div>
						<div class="tab-pane" id="dominio" role="tabpanel" aria-labelledby="dominio-tab">
							<?php
								if (get_the_terms( get_the_ID(), 'dominio'  )) {
									foreach ( get_the_terms( get_the_ID(), 'dominio' ) as $dominio ) {
										echo '<h5>' .$dominio->name. '</h5>';
										echo $dominio->description;
									}
								}
							?>
						</div>
						<div class="tab-pane" id="regno" role="tabpanel" aria-labelledby="regno-tab">
							<?php
								if (get_the_terms( get_the_ID(), 'regno'  )) {
									foreach ( get_the_terms( get_the_ID(), 'regno' ) as $regno ) {
										echo '<h5>' .$regno->name. '</h5>';
										echo $regno->description;
									}
								}
							?>
						</div>
					</div>
				</div>
			</div>
			<div class="col-lg-7 bg-dark text-white p-4 p-lg-5 position-relative">
				<div class="mt-3 mt-lg-0">
					<h2 class="mb-lg-3">Descrizione</h2>
					<?php echo get_post_meta( $post->ID, '_descrizione_pianta', true ); ?>
				</div>
				<div class="my-5">
					<h2 class="mb-lg-4">Dove trovarla</h2>
					<?php echo get_post_meta( $post->ID, '_dove_trovarla', true ); ?>
				</div>
				<div class="position-absolute bottom-0 end-0 p-lg-5 p-4">
					<span class="text-muted fs-6">Fonte wiki/Echium_vulgare</span>
				</div>
			</div>
		</div>
		<?php wp_footer(); ?>
	</body>
</html>
<?php