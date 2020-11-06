<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       www.manoliu.it
 * @since      1.0.0
 *
 * @package    L_Erbario
 * @subpackage L_Erbario/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    L_Erbario
 * @subpackage L_Erbario/admin
 * @author     Manoliu Lucian <lucian@manoliu.it>
 */
class L_Erbario_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in L_Erbario_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The L_Erbario_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/l-erbario-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in L_Erbario_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The L_Erbario_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/l-erbario-admin.js', array( 'jquery' ), $this->version, false );

	}	

	/**
	 * Registra CPT Erbario
	 * 
	 * @since 1.0.0 
	 */ 
	public function custom_erbario_post_type() {

		$labels = array(
			'name'                  => _x( 'Erbario', 'Post Type General Name', $this->plugin_name ),
			'singular_name'         => _x( 'Erbario', 'Post Type Singular Name', $this->plugin_name ),
			'menu_name'             => __( 'Erbario', $this->plugin_name ),
			'name_admin_bar'        => __( 'Erbario', $this->plugin_name ),
			'archives'              => __( 'Archivio Erbario', $this->plugin_name ),
			'attributes'            => __( 'Attributi Erbario', $this->plugin_name ),
			'parent_item_colon'     => __( 'Genitore:', $this->plugin_name ),
			'all_items'             => __( 'Tutte le piante', $this->plugin_name ),
			'add_new_item'          => __( 'Aggiungi una pianta', $this->plugin_name ),
			'add_new'               => __( 'Aggiungi nuova pianta', $this->plugin_name ),
			'new_item'              => __( 'Nuova Pianta', $this->plugin_name ),
			'edit_item'             => __( 'Modifica Pianta', $this->plugin_name ),
			'update_item'           => __( 'Aggiorna Pianta', $this->plugin_name ),
			'view_item'             => __( 'Vedi Pianta', $this->plugin_name ),
			'view_items'            => __( 'Vedi Piante', $this->plugin_name ),
			'search_items'          => __( 'Cerca Piante', $this->plugin_name ),
			'not_found'             => __( 'Non trovato', $this->plugin_name ),
			'not_found_in_trash'    => __( 'Non trovato nel cestino', $this->plugin_name ),
			'featured_image'        => __( 'Immagine in evidenza', $this->plugin_name ),
			'set_featured_image'    => __( 'Imposta immagine in evidenza', $this->plugin_name ),
			'remove_featured_image' => __( 'Rimuovi immagine in evidenza', $this->plugin_name ),
			'use_featured_image'    => __( 'Usa come immagine predefinita', $this->plugin_name ),
			'insert_into_item'      => __( 'Aggiungi alle Piante', $this->plugin_name ),
			'uploaded_to_this_item' => __( 'Carica su questa Pianta', $this->plugin_name ),
			'items_list'            => __( 'Lista Piante', $this->plugin_name ),
			'items_list_navigation' => __( 'Navigazione lista Piante', $this->plugin_name ),
			'filter_items_list'     => __( 'Filtra lista piante', $this->plugin_name ),
		);
		$args = array(
			'label'                 => __( 'Erbario', $this->plugin_name ),
			'description'           => __( 'Descrizione Erbario', $this->plugin_name ),
			'labels'                => $labels,			
			'menu_icon' 			=> 'dashicons-erbario',
			'supports'              => array( 'title', 'revisions', 'thumbnail', 'post-formats'),
			'hierarchical'          => true,
			'public'                => true,
			'show_ui'               => true,
			'show_in_menu'          => true,
			'menu_position'         => 5,
			'show_in_admin_bar'     => true,
			'show_in_nav_menus'     => true,			
			'show_in_rest'        	=> false,
			'can_export'            => true,
			'has_archive'           => true,
			'exclude_from_search'   => false,
			'publicly_queryable'    => true,
			'capability_type'       => 'page',
			'register_meta_box_cb' 	=> array( $this, 'informazioni_aggiuntive_meta_box' ),
			'rewrite'          		=> array( 'slug' => 'pianta' ),
		);
		register_post_type( 'pianta', $args );

	}

	/**
	 * Registra meta box: Descrizione Pianta, Dove Trovarla
	 * @since	1.0.0
	 */
	public function informazioni_aggiuntive_meta_box() {

		add_meta_box(
			'descrizione-pianta',
			__( 'Descrizione Pianta', $this->plugin_name ),
			array( $this, 'descrizione_pianta_meta_box_callback'),
		);

		add_meta_box(
			'dove-trovarla-pianta',
			__( 'Dove trovarla', $this->plugin_name ),
			array( $this, 'dove_trovarla_meta_box_callback'),
		);
		
	
	}

	//Modifica le colonne nel backend del nostro CPT
	public function aggiungi_colonne_erbario( $columns ) {

		$columns = array(
			'cb' 			=> $columns['cb'],			
			'foto' 			=> __( 'Foto', $this->plugin_name ),
			'title' 		=> __( 'Pianta', $this->plugin_name ),
			'genere'		=> __( 'Genere', $this->plugin_name ),
			'famiglia'  	=> __( 'Famiglia', $this->plugin_name ),
			);

		return $columns;

	}

	//inserisci i dati nelle colonne
	public function dati_colonne_erbario( $column, $post_id ) {
		// Image column
		if ( $column === 'foto' ) {
			if ( ! get_the_post_thumbnail() ) {
				echo '<img src="' . esc_url( plugins_url( '/img/image-placeholder.jpg', __FILE__ ) ) . '" />';
			}

			else {
				echo get_the_post_thumbnail( $post_id, array( 80, 80 ) );
			}
		}

		// Colonna Genere
		if ( 'genere' === $column ) {

			if (get_the_terms( get_the_ID(), 'genere'  )) {
				foreach ( get_the_terms( get_the_ID(), 'genere' ) as $genere ) {
					echo __($genere->name) . ' ' ;
				}
			}
			
			else {
				echo 'n/d';
			}
		}

		// Colonna Famiglia
		if ( 'famiglia' === $column ) {

			if (get_the_terms( get_the_ID(), 'famiglia'  )) {
				foreach ( get_the_terms( get_the_ID(), 'famiglia' ) as $famiglia ) {
					echo __($famiglia->name) . ' ' ;
				}
			}
			
			else {
				echo 'n/d';
			}
		}
	}	

	/**
	 * Registra il callback per il meta box
	 * @since	1.0.0
	 */
	public function descrizione_pianta_meta_box_callback( $post ) {

		// Add a nonce field so we can check for it later.
		wp_nonce_field( 'descrizione_pianta_nonce', 'descrizione_pianta_nonce' );
	
		$value = get_post_meta( $post->ID, '_descrizione_pianta', true );

		//visualizza il box con l'editor di wordpress
		$impostazioni_editor = array( 
			'media_buttons' 	=> false,
			'textarea_rows'		=> 10,
		 );
		wp_editor( $value, 'descrizione_pianta', $impostazioni_editor );
	}

	public function dove_trovarla_meta_box_callback( $post ) {

		// Add a nonce field so we can check for it later.
		wp_nonce_field( 'dove_trovarla_nonce', 'dove_trovarla_nonce' );
	
		$value = get_post_meta( $post->ID, '_dove_trovarla', true );

		//visualizza il box con l'editor di wordpress
		$impostazioni_editor = array( 
			'media_buttons' 	=> false,
			'textarea_rows'		=> 10,
		 );
		wp_editor( $value, 'dove_trovarla', $impostazioni_editor );
	}

	/**
	 * When the post is saved, saves our custom data.
	 *
	 * @param int $post_id
	 */
	public function save_informazioni_aggiuntive_meta_box_data( $post_id ) {

		// Check if our nonce is set.
		if ( ! isset( $_POST['descrizione_pianta_nonce'] ) ) {
			return;
		}

		if ( ! isset( $_POST['dove_trovarla_nonce'] ) ) {
			return;
		}

		// Verify that the nonce is valid.
		if ( ! wp_verify_nonce( $_POST['descrizione_pianta_nonce'], 'descrizione_pianta_nonce' ) ) {
			return;
		}

		if ( ! wp_verify_nonce( $_POST['dove_trovarla_nonce'], 'dove_trovarla_nonce' ) ) {
			return;
		}

		// If this is an autosave, our form has not been submitted, so we don't want to do anything.
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
			return;
		}

		// Check the user's permissions.
		if ( isset( $_POST['post_type'] ) && 'page' == $_POST['post_type'] ) {

			if ( ! current_user_can( 'edit_page', $post_id ) ) {
				return;
			}

		}
		else {

			if ( ! current_user_can( 'edit_post', $post_id ) ) {
				return;
			}
		}

		/* OK, it's safe for us to save the data now. */

		// Make sure that it is set.
		if ( ! isset( $_POST['descrizione_pianta'] ) ) {
			return;
		}

		if ( ! isset( $_POST['dove_trovarla'] ) ) {
			return;
		}

		// Sanitize user input.
		$descrizioen_pianta = sanitize_text_field( $_POST['descrizione_pianta'] );
		$dove_trovarla = sanitize_text_field( $_POST['dove_trovarla'] );


		// Update the meta field in the database.
		update_post_meta( $post_id, '_descrizione_pianta', $descrizioen_pianta );
		update_post_meta( $post_id, '_dove_trovarla', $dove_trovarla );

	}

	/**
	 * Crea sezione come le categorie 
	 */	
	public function create_genere_taxonomy() {
		
		$labels = array(
			'name' => _x( 'Genere', 'genere' ),
			'singular_name' => _x( 'Genere', 'genere' ),
			'search_items' =>  __( 'Cerca genere' ),
			'all_items' => __( 'Tutti i generi' ),
			'parent_item' => __( 'Genitore genere' ),
			'parent_item_colon' => __( 'Genitore Genere:' ),
			'edit_item' => __( 'Modifica Genere' ), 
			'update_item' => __( 'Aggiorna Genere' ),
			'add_new_item' => __( 'Aggiungi nuovo Genere' ),
			'new_item_name' => __( 'Nuovo Genere' ),
			'menu_name' => __( 'Genere pianta' ),
		);    
		
		// Now register the taxonomy
		register_taxonomy('genere', array('pianta'), array(
			'hierarchical' => true,
			'labels' => $labels,
			'show_ui' => true,
			'show_in_rest' => true,
			'show_admin_column' => true,
			'query_var' => true,
			'rewrite' => array( 'slug' => 'generi' ),
		));
		
	}

		/**
	 * Crea sezione come le categorie 
	 */	
	public function create_famiglia_taxonomy() {
		
		$labels = array(
			'name' => _x( 'Famiglia', 'famiglia' ),
			'singular_name' => _x( 'Famiglia', 'famiglia' ),
			'search_items' =>  __( 'Cerca famiglia' ),
			'all_items' => __( 'Tutte le famiglie' ),
			'parent_item' => __( 'Genitore famiglia' ),
			'parent_item_colon' => __( 'Genitore Famiglia:' ),
			'edit_item' => __( 'Modifica Famiglia' ), 
			'update_item' => __( 'Aggiorna Famiglia' ),
			'add_new_item' => __( 'Aggiungi nuova Famiglia' ),
			'new_item_name' => __( 'Nuova Famiglia' ),
			'menu_name' => __( 'Famiglia Pianta' ),
		);    
		
		// Now register the taxonomy
		register_taxonomy('famiglia', array('pianta'), array(
			'hierarchical' => true,
			'labels' => $labels,
			'show_ui' => true,
			'show_in_rest' => true,
			'show_admin_column' => true,
			'query_var' => true,
			'rewrite' => array( 'slug' => 'famiglia' ),
		));
		
	}

	/**
	 * Custom Post Template per il nostro CPT 'pianta'
	 */
	public function template_custom_post_type( $template ) {
		global $post;
		
		if (is_singular( 'pianta' ) ) {
			$template = plugin_dir_path(__DIR__).'public/templates/single-pianta.php';
		}

		elseif (is_archive( 'pianta' ) ){
			$template = plugin_dir_path( __DIR__ ).'public/templates/archive-pianta.php';
		}

		return $template;
	}

}
