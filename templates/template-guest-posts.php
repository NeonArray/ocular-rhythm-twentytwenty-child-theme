<?php
/**
 * Template Name: Guest Posts Archive
 * Template Post Type: post, page
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since 1.0.0
 */

get_header();
?>

	<main id="site-content" role="main">

		<?php
		$query = new WP_Query( array(
			'post_type' => 'guest_post',
			'posts_per_page' => 20,
		) );

		$archive_title    = get_the_title();
		$archive_subtitle = get_the_archive_description();

		if ( $archive_title || $archive_subtitle ) {
			?>

			<header class="archive-header has-text-align-center header-footer-group">

				<div class="archive-header-inner section-inner medium">

					<?php if ( $archive_title ) { ?>
						<h1 class="archive-title"><?php echo wp_kses_post( $archive_title ); ?></h1>
					<?php } ?>

					<?php if ( $archive_subtitle ) { ?>
						<div class="archive-subtitle section-inner thin max-percentage intro-text"><?php echo wp_kses_post( wpautop( $archive_subtitle ) ); ?></div>
					<?php } ?>

				</div><!-- .archive-header-inner -->

			</header><!-- .archive-header -->

			<?php
		}

		if ( $query->have_posts() ) {

			$i = 0;

			while ( $query->have_posts() ) {
				$i++;
				if ( $i > 1 ) {
					echo '<hr class="post-separator styled-separator is-style-wide section-inner" aria-hidden="true" />';
				}
				$query->the_post();

				get_template_part( 'template-parts/content', get_post_type() );

			}
		} elseif ( is_search() ) {
			?>

			<div class="no-search-results-form section-inner thin">

				<?php
				get_search_form(
					array(
						'label' => __( 'search again', 'twentytwenty' ),
					)
				);
				?>

			</div><!-- .no-search-results -->

			<?php
		}
		wp_reset_postdata();
		?>

		<?php get_template_part( 'template-parts/pagination' ); ?>

	</main><!-- #site-content -->

<?php get_template_part( 'template-parts/footer-menus-widgets' ); ?>

<?php
get_footer();
