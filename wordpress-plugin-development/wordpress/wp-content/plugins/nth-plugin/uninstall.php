<?php

/**
 * Trigger this file on Plugin uninstall
 * 
 * @package NTHPlugin
 */

defined('WP_UNINSTALL_PLUGIN') or die('Hey, what are you doing here? You silly human!');

// Clear Database stored data
/*
$books = get_post(array(
    'post_type'    => 'books',
    'numberposts'  => -1
));

foreach ($books as $book) {
    wp_delete_post($book->ID, false); // trashed the data || true: force delete
}
*/

global $wpdb;
$wpdb->query("DELETE FROM wp_posts WHERE post_type = 'book'");
$wpdb->query("DELETE FROM wp_postmeta WHERE post_id NOT IN (SELECT id FROM wp_posts)");
$wpdb->query("DELETE FROM wp_term_relationships WHERE object_id NOT IN (SELECT id FROM wp_posts)");
