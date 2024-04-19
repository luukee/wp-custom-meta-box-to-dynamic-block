<?php
/**
 * Plugin Name:       Artillery Meta
 * Description:       Example block scaffolded with Create Block tool.
 * Requires at least: 6.1
 * Requires PHP:      7.0
 * Version:           0.1.0
 * Author:            The WordPress Contributors
 * License:           GPL-2.0-or-later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       artillery-meta
 *
 * @package CreateBlock
 */

//  Plugin created with the help of "Creating a custom block that stores post meta" article: 
// https://developer.wordpress.org/news/2023/03/03/creating-a-custom-block-that-stores-post-meta/

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Registers the block using the metadata loaded from the `block.json` file.
 * Behind the scenes, it registers also all assets so they can be enqueued
 * through the block editor in the corresponding context.
 *
 * @see https://developer.wordpress.org/reference/functions/register_block_type/
 */
// // Add custom meta box to post editor
function artillery_link_meta_box_content() {
	// Content of your meta box
	echo '<label for="artillery_link">Artillery Link:</label>';
	echo '<input type="text" id="artillery_link" name="artillery_link" value="' . esc_attr( get_post_meta( get_the_ID(), 'artillery_link', true ) ) . '" size="25" />';
}

function add_artillery_link_meta_box() {
	add_meta_box(
			'artillery_link_meta_box',
			'Artillery Link',
			'artillery_link_meta_box_content',
			'post',
			'normal',
			'default'
	);
}
add_action('add_meta_boxes', 'add_artillery_link_meta_box');

function save_artillery_link_meta_box( $post_id ) {
	if ( isset( $_POST['artillery_link'] ) ) {
		update_post_meta( $post_id, 'artillery_link', sanitize_text_field( $_POST['artillery_link'] ) );
	}
}
add_action( 'save_post', 'save_artillery_link_meta_box' );

/**
 * Registers the block using the metadata loaded from the `block.json` file.
 * Behind the scenes, it registers also all assets so they can be enqueued
 * through the block editor in the corresponding context.
 *
 * @see https://developer.wordpress.org/reference/functions/register_block_type/
 */
function create_block_artillery_link_block_init() {
	register_block_type( __DIR__ . '/build' );
}
add_action( 'init', 'create_block_artillery_link_block_init' );

// Register Artillery Link Block
function register_artillery_link_block() {
    register_block_type(
        'artillery-link/artillery-link-block',
        array(
            'attributes' => array(
                'linkUrl' => array(
                    'type' => 'string',
                    'default' => '',
                ),
            ),
            'render_callback' => 'render_artillery_link_block',
        )
    );
}
add_action('init', 'register_artillery_link_block');

// Render Artillery Link Block
function render_artillery_link_block($attributes) {
    $link_url = isset($attributes['linkUrl']) ? esc_url($attributes['linkUrl']) : '';

    // Render the block output
    ob_start();
    ?>
    <div class="artillery-link-block">
        <?php if (!empty($link_url)) : ?>
            <a href="<?php echo $link_url; ?>">Artillery Link</a>
            <p class="saved-content">hello from the saved content!</p>
        <?php else : ?>
            <p class="no-link">No link provided</p>
        <?php endif; ?>
    </div>
    <?php
    return ob_get_clean();
}