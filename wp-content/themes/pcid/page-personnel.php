<?php  
/**
 * Template Name: Personnel
 *
 */
?>

<?php get_header(); ?>

<?php if (have_posts()) : ?>
	<div id="main_content" class="single-page page-personnel">
		<div class="page-breadcrumb">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<?php if(function_exists('the_breadcrumbs')) the_breadcrumbs(); ?>
					</div>
					<div class="clearfix"></div>
				</div>
				<div class="clearfix"></div>
			</div>
		</div>
		<div class="inner_content">
			<?php while (have_posts()) : the_post(); $the_ID = $post->ID; ?>
				<div class="container">
					<div class="row">
						<div class="col-md-8 article">
							<?php if(get_field('hide_page_title', $the_ID)) { ?>
								<?php echo ( get_field('show_custom_title', $the_ID ) ? '<h2 class="article-title">' . get_field('page_title', $the_ID ) . '<span class="edit-link">' . edit_post_link('Edit this page', ' | ', '') . ' | <a href="' . add_query_arg(array('post_type'=>'page'),admin_url('post-new.php')) . ' title="Add new page" class="post-add-link">Add new page</a></span></h2>' : '' ); ?>
							<?php } else { ?>
								<h2 class="article-title"><?php echo get_the_title(); ?><span class="edit-link"><?php edit_post_link('Edit this page', ' | ', ''); ?><?php echo ' | <a href="' . add_query_arg(array('post_type'=>'page'),admin_url('post-new.php')) . '" title="Add new page" class="post-add-link">Add new page</a>'; ?></span></h2>
							<?php } ?>

							<?php the_content(); ?>

							<?php
								if( have_rows('personnel_types', $the_ID ) ):
									while ( have_rows('personnel_types', $the_ID ) ) : the_row();
										$personnel_type = get_sub_field('personnel_type', $the_ID );
								?>
									<?php
										$personnel = $wp_query;
										$wp_query = null;
										$wp_query = new WP_Query();
										$args = array(
											'posts_per_page' => -1,
											'post_type' =>	'personnel',
											'status'	=>	'publish',
											'orderby'	=>	'menu_order',
											'order'	=>	'ASC',
											'tax_query' => array(
												array (
													'taxonomy' => 'personnel_type',
													'field' => 'slug',
													'terms' => $personnel_type->slug,
												)
											),
										);
										$wp_query->query($args);
									?>
									<?php if (have_posts()) : $personnelitem = 1; ?>
										<div class="row-fluid">
											<?php while (have_posts()) : the_post();
												$id = get_the_ID();
												$photo = get_field('photo', $id);
											?>
												<div class="col-md-3 col-sm-4 col-xs-6" id="<?php echo ($personnel_type->slug . '-' . $personnelitem); ?>">
													<div class="<?php echo $personnel_type->slug; ?> personnel" style="margin-bottom:1.5rem;">
														<a href="<?php echo get_permalink($id); ?>" title="<?php echo get_the_title(); ?>"><img src="<?php echo $photo['url']; ?>" alt="<?php echo get_the_title(); ?>" title="<?php echo get_the_title(); ?>" width="600" height="600" class="alignnone" style="margin:0 auto 0.5rem;clear:both;width:100%;height:auto;" /></a>
														<p style="text-align:left; line-height:1.3 !important;"><strong><a href="<?php echo get_permalink($id); ?>" title="<?php echo get_the_title(); ?>"><?php echo get_the_title(); ?></a></strong><br><em><?php echo get_field('position', $id ); ?></em></p>
													</div>
												</div>
											<?php 
												$personnelitem++; 
												endwhile; ?>
										</div>
										<div class="clearfix"></div>									
									<?php else : endif; $wp_query = null; $wp_query = $personnel; ?>
								<?php
									endwhile;
								endif;
							?>					
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
		<div class="clearfix clear"></div>
	</div>
	<div class="clearfix clear"></div>

<?php else : ?>
<?php endif; ?>

<?php wp_reset_query(); ?>

<?php get_footer(); ?>