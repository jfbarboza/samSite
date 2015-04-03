<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>
<?php get_header(); ?>

	<div class="template-tag">
		
		<?php
		
			global $wp_query, $posts;
					$backup_query = $wp_query;
			
			$sorted = array();

			foreach($posts as $post) {
				$sorted[$post->post_type][] = $post;
			}
			
           foreach ($sorted as $key => $post_type) {
			   
				if ($key == 'folio')  {
					$args = array_merge( $wp_query->query_vars, array( 'post_type' => $key ) );
					get_posts( $args );
					get_template_part( 'loop/loop', 'folio' );
				} else {
					$args = array_merge( $wp_query->query_vars, array( 'post_type' => $key ) );
					get_posts( $args );
					get_template_part( 'loop/loop', 'tag' );
				}
				
				get_template_part( 'content', 'pagenavi' );
				$wp_query = $backup_query;
			}
		
		?>
		
	</div><!--/ .template-tag-->

<?php get_footer(); ?>
