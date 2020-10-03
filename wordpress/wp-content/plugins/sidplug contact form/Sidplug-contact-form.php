<?php
/*
Plugin Name: Sidplug formulaire de contact
Plugin URI: 
Description: un exemple de formulaire de contact
Version: 1.0
Author: Sidiki
Author URI: 
*/

/**
* Activate the plugin.
*/
function Sidplug_form_contact_activate() { 
  Sidplug_create_contact_table(); 
}
register_activation_hook( __FILE__, 'Sidplug_form_contact_activate' );

/**
 * Deactivation hook.
 */
function baobab_form_contact_deactivate() {
  //
}
register_deactivation_hook( __FILE__, 'Sidplug_form_contact_deactivate' );

function html_form_code() {
	echo '<form action="' . esc_url( $_SERVER['REQUEST_URI'] ) . '" method="post">';
	echo '<p>';
	echo 'Votre nom* <br/>';
	echo '<input type="text" name="cf-name" pattern="[a-zA-Z0-9 ]+" value="' . ( isset( $_POST["cf-name"] ) ? esc_attr( $_POST["cf-name"] ) : '' ) . '" size="40" />';
	echo '</p>';
	echo '<p>';
	echo 'Votre Email* <br/>';
	echo '<input type="email" name="cf-email" value="' . ( isset( $_POST["cf-email"] ) ? esc_attr( $_POST["cf-email"] ) : '' ) . '" size="40" />';
	echo '</p>';
	echo '<p>';
	echo 'Sujet* <br/>';
	echo '<input type="text" name="cf-subject" pattern="[a-zA-Z ]+" value="' . ( isset( $_POST["cf-subject"] ) ? esc_attr( $_POST["cf-subject"] ) : '' ) . '" size="40" />';
	echo '</p>';
	echo '<p>';
	echo 'Votre message* <br/>';
	echo '<textarea rows="10" cols="35" name="cf-message">' . ( isset( $_POST["cf-message"] ) ? esc_attr( $_POST["cf-message"] ) : '' ) . '</textarea>';
	echo '</p>';
	echo '<p><input type="submit" name="cf-submitted" value="Envoyer"></p>';
	echo '</form>';
}

function Sidplug_create_contact(){
  // sanitize form values
  $contact = array();
  $contact['nom']    = sanitize_text_field( $_POST["cf-name"] );
  $contact['email']   = sanitize_email( $_POST["cf-email"] );
  $contact['sujet'] = sanitize_text_field( $_POST["cf-subject"] );
  $contact['message'] = esc_textarea( $_POST["cf-message"] );
  return $contact;
}

function deliver_mail() {

	// if the submit button is clicked, send the email
	if ( isset( $_POST['cf-submitted'] ) ) {
    $contact = Sidplug_create_contact();
    
		// get the blog administrator's email address
		$to = get_option( 'admin_email' );

		$headers = "From: ". $contact['nom'] ."<".$contact['email'].">" . "\r\n";

		// If email has been process for sending, display a success message
		if ( wp_mail( $to, $contact['sujet'], $contact['message'], $headers ) ) {
			echo '<div>';
			echo '<p>Message envoyé avec succès!</p>';
			echo '</div>';
		} else {
			echo 'Une erreur est survenue';
		}
	}
}

function Sidplug_create_contact_table(){
  global $wpdb;
  $table_name = $wpdb->prefix . "contacts";
  $charset_collate = $wpdb->get_charset_collate();

  $sql = "CREATE TABLE $table_name (
    id mediumint(9) NOT NULL AUTO_INCREMENT,
    nom_contact tinytext NOT NULL,
    email varchar(255) NOT NULL,
    sujet varchar(255) NOT NULL,
    message text NOT NULL,
    time datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
    PRIMARY KEY  (id)
  ) $charset_collate;";

  require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
  dbDelta( $sql );
}

function Sidplug_insert_contact($contact){
  if ( isset( $_POST['cf-submitted'] ) ) {
    global $wpdb;
    $table_name = $wpdb->prefix . "contacts";
  
    $wpdb->insert( 
      $table_name, 
      array(
        'nom_contact' => $contact["nom"], 
        'email' => $contact["email"], 
        'sujet' => $contact["sujet"], 
        'message' => $contact["message"],  
        'time' => current_time( 'mysql' ) 
      ) 
    );
  }
}
function cf_shortcode() {
	ob_start();
  deliver_mail();
  if (isset( $_POST['cf-submitted'] )) {
    $contact = Sidplug_create_contact();
    Sidplug_insert_contact($contact);
	  
  }
  html_form_code();
	return ob_get_clean();
}

add_shortcode( 'Sidplug_contact_form', 'cf_shortcode' );

function html_contact_list(){
  global $wpdb;
  // Interrogation de la base de données
  $resultats = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}contacts order by time desc") ;
  echo '<table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">Date</th>
      <th scope="col">Heure</th>
      <th scope="col">Nom Contact</th>
      <th scope="col">Email</th>
      <th scope="col">Sujet</th>
      <th scope="col">Message</th>
    </tr>
  </thead>
  <tbody>';
  // Parcours des resultats obtenus
  foreach ($resultats as $contact) {
    $date_obj = date_create($contact->time);
    $date = date_format($date_obj, 'd-m-Y');
    $heure = date_format($date_obj, 'H:i:s');
    echo '<tr>';
    echo '<th scope="row">'. $date. '</th>';
    echo '<th scope="row">'. $heure. '</th>';
    echo '<th scope="row">'. $contact->nom_contact. '</th>';
    echo '<th scope="row">'. $contact->email. '</th>';
    echo '<th scope="row">'. $contact->sujet. '</th>';
    echo '<th scope="row">'. $contact->message. '</th>';
    echo '</tr>';
  }
  echo "</tbody></table>";
}
function cf_liste_contacts_shortcode() {
  ob_start();
  html_contact_list();
	return ob_get_clean();
}

add_shortcode( 'Sidplug_contact_liste', 'cf_liste_contacts_shortcode' );

function wp_adding_styles() {
  wp_enqueue_style('bootstrap', "https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css");
}
add_action( 'wp_enqueue_scripts', 'wp_adding_styles' ); 

function wp_adding_scripts() {
  wp_enqueue_script( 'bootstrap', "https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js", array( 'jquery' ) );
}
add_action( 'wp_enqueue_scripts', 'wp_adding_scripts');
