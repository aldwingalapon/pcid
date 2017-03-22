<?php  
/**
 * Template Name: Statements & Reports
 *
 */
?>

<?php get_header(); set_pcid_post_views(get_the_ID()); ?>
<?php if (have_posts()) : ?>
	<div id="main_content" class="press_release-page">
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
						<div class="col-md-8 article">
							<?php if(get_field('hide_content_title', $the_ID)) { ?>
								<?php echo ( get_field('show_content_title', $the_ID ) ? '<h2 class="article-title">' . get_field('content_title', $the_ID ) . '<span class="edit-link">' . edit_post_link('Edit this page', ' | ', '') . '</span></h2>' : '' ); ?>
							<?php } else { ?>
								<h2 class="article-title"><?php echo get_the_title(); ?><span class="edit-link"><?php edit_post_link('Edit this page', ' | ', ''); ?></span></h2>
							<?php } ?>
							<?php the_content(); ?>
							<div class="row">
								<?php
									$press_release = $wp_query;
									$wp_query = null;
									$wp_query = new WP_Query();
									$args = array(
										'paged' => $paged,
										'posts_per_page' => 12,
										'post_type' =>	'press_release',
										'status'	=>	'publish',
										'orderby'	=>	'date',
										'order'	=>	'DESC'
									);
									$wp_query->query($args);
								?>
								<?php if (have_posts()) : $press_releaseitem = 1; ?>
									<?php while (have_posts()) : the_post();
										$id = get_the_ID();
										$image_url = "";
										if ( has_post_thumbnail() ) {
											$image_url = wp_get_attachment_image_src( get_post_thumbnail_id($id), 'medium-press_release-thumbnails' );
										}
									?>
									<div class="col-md-6 col-sm-6 press_release_item press_release_item_<?php echo $id ; ?>">
										<div class="press_release_content<?php echo((($press_releaseitem % 2) == 0) ? ' press_release_content_last' : ((($press_releaseitem % 2) == 1) ? ' press_release_content_first' : '' ) ); ?>">
											<div class="press_release_content_image">
												<div class="press_release_content_image_overlay"></div>
												<a href="<?php echo get_permalink($id); ?>" title="<?php echo get_the_title(); ?>" rel="bookmark">
													<div data-src="<?php echo $image_url[0]; ?>" class="press_release_content_icon lazy-image"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/news.png" width="800" height="350" title="<?php echo get_the_title(); ?>" alt="<?php echo get_the_title(); ?>" /></div>
												</a>											
											</div>
											<div class="press_release_content_title">
												<h4><a href="<?php echo get_permalink($id); ?>" title="<?php echo get_the_title(); ?>" <?php echo (get_field('section_title_color_press_release_and_articles_section', 'option') ? ' style="color:' . get_field('section_title_color_press_release_and_articles_section', 'option') . ';"' : ''); ?>><?php echo get_the_title(); ?></a></h4>
												<div class="post-data">
													<span class="post-details">
														<?php the_time('j F Y') ?> / <?php $link = get_permalink(get_the_ID()); echo FacebookShareCount::get_share_count($link); ?> Shares /  by 
														<?php
															if( have_rows('authors', $the_ID ) ):
																while ( have_rows('authors', $the_ID ) ) : the_row();
																	$author_name = get_sub_field('author_name', $the_ID );
																	$author_designation = get_sub_field('author_designation', $the_ID );
																	$author_photo = get_sub_field('author_photo', $the_ID );
																	$author_link = get_sub_field('author_link', $the_ID );
																	$author_link_target = get_sub_field('author_link_target', $the_ID );
																	if($author_link){
																		echo ('<a href="' . $author_link . '" target="' . $author_link_target . '" title="' . $author_name . '">' . $author_name . '</a>');
																	}else{
																		echo ($author_name);
																	}
																endwhile;
															else :
																	the_author_posts_link();
															endif;
														?>					
														<?php
															if( have_rows('links', $the_ID ) ): echo (' (');
																while ( have_rows('links', $the_ID ) ) : the_row();
																	$link_name = get_sub_field('link_name', $the_ID );
																	$link_url = get_sub_field('link_url', $the_ID );
																	$link_target = get_sub_field('link_target', $the_ID );
																	if($link_url){
																		echo ('<a href="' . $link_url . '" target="' . $link_target . '" title="' . $link_name . '">' . $link_name . '</a>');
																	}else{
																		echo ($link_name);
																	}
																endwhile;
																echo (')');
															else :
															endif;
														?>					
													</span>
												</div>												
											</div>
											<div class="press_release_content_excerpt">
												<?php echo '<p class="excerpt" ' . (get_field('section_title_color_press_release_and_articles_section', 'option') ? ' style="color:' . get_field('section_title_color_press_release_and_articles_section', 'option') . ';"' : '') . '>'.limit_words(get_the_excerpt(), '15').' ... <br/> <a href="' . get_permalink($id) . '" title="' . get_the_title() . '" class="read-more">Read more</a></p>'; ?>
											</div>
											<div class="clearfix"></div>
										</div>
									</div>
									<?php 
										$press_releaseitem++; 
										endwhile; ?>
									<div class="clearfix"></div>
									<div class="col-md-12">
										<?php  if(function_exists('wp_page_numbers')) { wp_page_numbers(); } ?>
									</div>
									<div class="clearfix"></div>
								<?php else : endif; $wp_query = null; $wp_query = $press_release; ?>
							</div>
							<div class="clearfix"></div>
						</div>
						<div class="col-md-4 aside">
							<?php
								if( have_rows('page_widgets', $the_ID ) ):
									while ( have_rows('page_widgets', $the_ID ) ) : the_row();
										dynamic_sidebar( get_sub_field('sidebar_widget', $the_ID ) );
									endwhile;
								else :
										dynamic_sidebar('Default Page Sidebar');
								endif;
							?>					
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