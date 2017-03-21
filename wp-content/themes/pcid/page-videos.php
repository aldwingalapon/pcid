<?php  
/**
 * Template Name: Videos
 *
 */
?>

<?php get_header(); set_pcid_post_views(get_the_ID()); ?>
<?php if (have_posts()) : ?>
	<div id="main_content" class="videos-page">
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
							<div class="row-fluid">

								<?php
									$videoItems = $wp_query;
									$wp_query= null;
									$wp_query = new WP_Query();
									$args = array(
										'paged' => $paged,
										'posts_per_page' => 4,
										'post_type' =>	'video',
										'status'	=>	'publish',
										'orderby'	=>	'date',
										'order'	=>	'DESC'
									);
									$wp_query->query($args);
									//$wp_query->query('showposts=5&cat=56&orderby=date&order=desc'.'&paged='.$paged);
								?>
									
								<?php if (have_posts()) : ?>
									<?php while (have_posts()) : the_post();
										$video_post_id = get_the_ID();
										$video_description = get_field('video_description', $video_post_id);
										$youtube_video_id = get_field('youtube_video_id', $video_post_id);
										$video_link = 'https://www.youtube.com/watch?v='. get_field('youtube_video_id', $video_post_id);
										$video_image_placeholder = 'http://i3.ytimg.com/vi/' . get_field('youtube_video_id', $video_post_id) . '/0.jpg';
										$featured = get_field('featured', $video_post_id);
									?>
										<div class="video-item row" id="post-<?php the_ID(); ?>">
											<div class="col-md-12">
												<h4><?php the_title(); ?></h4>
											</div>
											<div class="clearfix"></div>
											<div class="col-md-6">
												<div class="video-container">
														 <iframe src="https://www.youtube.com/embed/<?php echo $youtube_video_id;?>" frameborder="0" width="560" height="315"></iframe>
												</div>
											</div>
											<div class="col-md-6">
												<?php echo $video_description; ?>
											</div>
											<div class="clearfix"></div>
											<div class="col-md-12">
												<p class="view-more"><a href="<?php the_permalink() ?>" title="Go to Video">Go to Video (Larger Window)</a></p>
											</div>
											<div class="clearfix"></div>
										</div>
									<?php endwhile; ?>

									<div class="clearfix"></div>
									<div class="col-md-12">
										<?php  if(function_exists('wp_page_numbers')) { wp_page_numbers(); } ?>
									</div>
								<?php else : endif; $wp_query = null; $wp_query = $videoItems; ?>							
							
								<div class="clearfix"></div>
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