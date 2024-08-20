<?php

/*
 * This code tracks post views and updates the hit count for a post. 
 * The first function manages the post view count.
 * The second function hooks into wp_head and calls the first function when a single post is viewed.
 */

// Place this code into your theme's functions.php file

function update_popular_post_views($post_id) {
    $count_key = 'popular_post_views';
    $current_count = get_post_meta($post_id, $count_key, true);

    if (empty($current_count)) {
        // Initialize view count if it doesn't exist
        $current_count = 0;
        add_post_meta($post_id, $count_key, '0', true);
    } else {
        // Increment view count
        $current_count++;
        update_post_meta($post_id, $count_key, $current_count);
    }
}

function track_popular_post_views() {
    if (!is_single()) {
        return;
    }

    global $post;

    // Ensure post ID is set and valid
    if (isset($post->ID)) {
        update_popular_post_views($post->ID);
    }
}

// Hook into wp_head to track post views only on single post pages
add_action('wp_head', 'track_popular_post_views');

?>
