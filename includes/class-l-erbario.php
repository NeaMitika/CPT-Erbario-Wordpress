<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       www.manoliu.it
 * @since      1.0.0
 *
 * @package    L_Erbario
 * @subpackage L_Erbario/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    L_Erbario
 * @subpackage L_Erbario/includes
 * @author     Manoliu Lucian <lucian@manoliu.it>
 */
class L_Erbario {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      L_Erbario_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $plugin_name    The string used to uniquely identify this plugin.
	 */
	protected $plugin_name;

	/**
	 * The current version of the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	protected $version;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {
		if ( defined( 'L_ERBARIO_VERSION' ) ) {
			$this->version = L_ERBARIO_VERSION;
		} else {
			$this->version = '1.0.0';
		}
		$this->plugin_name = 'l-erbario';

		$this->load_dependencies();
		$this->set_locale();
		$this->define_admin_hooks();
		$this->define_public_hooks();

	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - L_Erbario_Loader. Orchestrates the hooks of the plugin.
	 * - L_Erbario_i18n. Defines internationalization functionality.
	 * - L_Erbario_Admin. Defines all hooks for the admin area.
	 * - L_Erbario_Public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_dependencies() {

		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-l-erbario-loader.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-l-erbario-i18n.php';

		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-l-erbario-admin.php';

		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-l-erbario-public.php';

		$this->loader = new L_Erbario_Loader();

	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the L_Erbario_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_locale() {

		$plugin_i18n = new L_Erbario_i18n();

		$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );

	}

	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_admin_hooks() {

		$plugin_admin = new L_Erbario_Admin( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );

		// Registra il CPT Erbario
		$this->loader->add_action( 'init', $plugin_admin, 'custom_erbario_post_type', 0 );

		//aggiorna permalinks
		$this->loader->add_action( 'init', $plugin_admin, 'controllo_aggiornamento_permalinks', 2 );

		// Registra le taxonomies: Genere, Famiglia
		$this->loader->add_action( 'init', $plugin_admin, 'create_genere_taxonomy', 1 );
		$this->loader->add_action( 'init', $plugin_admin, 'create_famiglia_taxonomy', 1 );

		// Salva le informazioni dei metabox 
		$this->loader->add_action( 'save_post', $plugin_admin, 'save_informazioni_aggiuntive_meta_box_data' );

		// Template custom per il nostro CPT
		$this->loader->add_filter( 'template_include', $plugin_admin, 'template_custom_post_type' ) ;

		// aggiungi colonne personalizzate in impiegati
		$this->loader->add_filter( 'manage_pianta_posts_columns', $plugin_admin, 'aggiungi_colonne_erbario' );
		// aggiungi i dati nelle colonne personalizzate in impiegati
		$this->loader->add_action( 'manage_pianta_posts_custom_column', $plugin_admin, 'dati_colonne_erbario', 10, 2);

	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_public_hooks() {

		$plugin_public = new L_Erbario_Public( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_styles' );
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_scripts' );

	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    1.0.0
	 */
	public function run() {
		$this->loader->run();
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     1.0.0
	 * @return    string    The name of the plugin.
	 */
	public function get_plugin_name() {
		return $this->plugin_name;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     1.0.0
	 * @return    L_Erbario_Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader() {
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     1.0.0
	 * @return    string    The version number of the plugin.
	 */
	public function get_version() {
		return $this->version;
	}

}
