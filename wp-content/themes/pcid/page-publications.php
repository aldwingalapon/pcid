<?php  
/**
 * Template Name: Publications
 *
 */
?>

<?php get_header(); set_pcid_post_views(get_the_ID()); ?>
<?php if (have_posts()) : ?>
	<div id="main_content" class="publication-page">
		<div class="page-breadcrumb">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<?php if(function_exists('the_breadcrumbs')) the_breadcrumbs(); ?>
					</div>
					<div class="clearfix"></div>
				</div>
			</div>
		</div>
		<div class="inner_content">
			<?php while (have_posts()) : the_post(); $the_ID = $post->ID; ?>
				<div class="container">
					<div class="row">
						<div class="col-md-12 article">
							<?php if(get_field('hide_content_title', $the_ID)) { ?>
								<?php echo ( get_field('show_content_title', $the_ID ) ? '<h2 class="article-title">' . get_field('content_title', $the_ID ) . '<span class="edit-link">' . edit_post_link('Edit this article', ' | ', '') . '</span></h2>' : '' ); ?>
							<?php } else { ?>
								<h2 class="article-title"><?php echo get_the_title(); ?><span class="edit-link"><?php edit_post_link('Edit this article', ' | ', ''); ?></span></h2>
							<?php } ?>
							<?php the_content(); ?>
							<div class="row">
								<?php
									$publication = $wp_query;
									$wp_query = null;
									$wp_query = new WP_Query();
									$args = array(
										'paged' => $paged,
										'posts_per_page' => 12,
										'post_type' =>	'publication',
										'status'	=>	'publish',
										'orderby'	=>	'menu_order',
										'order'	=>	'ASC'
									);
									$wp_query->query($args);
								?>
								<?php if (have_posts()) : $publicationitem = 1; ?>
									<?php while (have_posts()) : the_post();
										$id = get_the_ID();
										$image_url = "";
										if ( has_post_thumbnail() ) {
											$image_url = wp_get_attachment_image_src( get_post_thumbnail_id($id), 'full' );
										}
									?>
									<div class="col-md-3 col-sm-4 col-xs-6 publication_item publication_item_<?php echo $id ; ?>">
										<div class="publication_content<?php echo((($publicationitem % 4) == 0) ? ' publication_content_last' : ((($publicationitem % 4) == 1) ? ' publication_content_first' : '' ) ); ?>">
											<div class="publication_content_image">
												<div class="publication_content_image_overlay"></div>
												<a href="<?php echo get_permalink($id); ?>" title="<?php echo get_the_title(); ?>" rel="bookmark">
													<div data-src="<?php echo $image_url[0]; ?>" class="publication_content_icon lazy-image"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/publication.png" width="570" height="800" title="<?php echo get_the_title(); ?>" alt="<?php echo get_the_title(); ?>" /></div>
												</a>											
											</div>
											<div class="publication_content_title">
												<h4><a href="<?php echo get_permalink($id); ?>" title="<?php echo get_the_title(); ?>" <?php echo (get_field('section_title_color_news_and_articles_section', 'option') ? ' style="color:' . get_field('section_title_color_news_and_articles_section', 'option') . ';"' : ''); ?>><?php echo get_the_title(); ?></a></h4>
											</div>
											<div class="publication_content_excerpt">
												<?php echo ((get_field('summary', $id)) ? '<p class="summary" ' . (get_field('section_title_color_news_and_articles_section', 'option') ? ' style="color:' . get_field('section_title_color_news_and_articles_section', 'option') . ';"' : '') . '>' . get_field('summary', $id) . '</p>' : ''); ?>
											</div>
											<div class="clearfix"></div>
										</div>
									</div>
									<?php 
										$publicationitem++; 
										endwhile; ?>
									<div class="clearfix"></div>
									<div class="col-md-12">
										<?php  if(function_exists('wp_page_numbers')) { wp_page_numbers(); } ?>
									</div>
									<div class="clearfix"></div>
								<?php else : endif; $wp_query = null; $wp_query = $publication; ?>
							</div>
							<div class="clearfix"></div>
						</div>
						<div class="clearfix"></div>
					</div>
					<div class="clearfix"></div>				
				</div>
			<?php endwhile; ?>
		</div>
	</div>
	
<?php else : ?>
<?php endif; ?>

<?php wp_reset_query(); ?>

<?php get_footer(); ?>