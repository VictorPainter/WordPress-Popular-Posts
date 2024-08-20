<!-- Displaying Popular Posts -->

<?php
// Fetch the 7 most popular posts based on the 'popular_post_views' meta key
$popular_posts_query = new WP_Query(array(
    'posts_per_page' => 7,                   // Limit to 7 posts
    'meta_key' => 'popular_post_views',      // Meta key to order by (updated in previous function)
    'orderby' => 'meta_value_num',           // Order by meta value as a number
    'order' => 'DESC'                        // Display in descending order (most views first)
));

// Loop through the popular posts
if ($popular_posts_query->have_posts()) :
    echo '<ul>'; // Start an unordered list for the popular posts
    while ($popular_posts_query->have_posts()) : $popular_posts_query->the_post(); ?>
        <li>
            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
        </li>
    <?php endwhile;
    echo '</ul>'; // End the unordered list
else :
    echo '<p>No popular posts found.</p>'; // Display a message if no popular posts are found
endif;

// Reset the post data to avoid conflicts with other queries
wp_reset_postdata();
?>
