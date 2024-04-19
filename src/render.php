<?php
/**
 * @see https://github.com/WordPress/gutenberg/blob/trunk/docs/reference-guides/block-api/block-metadata.md#render
 */
$artillery_url = get_post_meta( get_the_ID(), 'artillery_link', true );

// Check if the artillery_link meta information exists
if ($artillery_url) {
    ?>
    <p <?php echo get_block_wrapper_attributes(); ?>>
        <a href="<?php echo esc_url( $artillery_url ); ?>" target="_blank" rel="noopener noreferrer">View article on Artillery Magazine</a>
    </p>
    <?php
}
