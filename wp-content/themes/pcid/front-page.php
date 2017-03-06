<?php get_header(); ?>

	<div id="main_content" class="homepage frontpage">
		<div class="container">
			<div class="row">
				<div class="clearfix"></div>
			</div>
			<div class="clearfix"></div>
		</div>
		<div class="clearfix clear"></div>
		<!-- Hero Banner Section -->
		<?php if(get_field('show_hero_banner', 'option')) { ?>
			<div class="hero section">
				<?php 
					$heroterm = get_field('hero_banner_category', 'option');
					if( $heroterm ):
						$args = array(
							'posts_per_page' => -1,
							'post_type' =>	'slider',
							'status'	=>	'publish',
							'orderby'	=>	'date',
							'order'	=>	'DESC',
							'tax_query' =>
								array(
									array(
										'taxonomy' => 'slider_position',
										'field'    => 'name',
										'terms' => $heroterm->name,                                    
									),
								), 
						);

						$heroslider = New WP_Query($args); ?>		
					<?php if ($heroslider) : $i = 1; ?>
						<div class="hero-slider" id="hero-owl-carousel-container">
							<div class="owl-carousel" id="hero-owl-carousel">
								<?php  while ( $heroslider->have_posts() ) : 
									//$firstPosts[] = get_the_ID();
									$heroslider->the_post();
									$heroslider_id = get_the_ID();
									$add_link = get_field('add_link', $heroslider_id);
									$url_link = get_field('url_link', $heroslider_id);
									$video_link = get_field('video_link', $heroslider_id);
									$image_link = get_field('image_link', $heroslider_id);
									$target = get_field('target', $heroslider_id);
									$herolink = "";
									$heroclass = "";
									$herorel = "";
									$herotarget = "";
									$herocontent = get_the_content($heroslider_id);
									if(($add_link) == 'Internal Content'){
										$post_object = get_field('post_link', $heroslider_id);
										if( $post_object ){
											$post = $post_object;
											setup_postdata( $post ); 
											//$firstPosts[] = get_the_ID();
											$herolink = get_the_permalink();
											
											wp_reset_postdata();
										}
										$heroclass = "";
										$herorel = "";
										$herotarget = ' target="' . $target . '"';
									} elseif(($add_link) == 'Website'){
										$herolink = $url_link;
										$heroclass = "";
										$herorel = "";
										$herotarget = ' target="' . $target . '"';
									}elseif(($add_link) == 'Video'){
										$herolink = $video_link;
										$heroclass = "wplightbox";
										$herorel = "";
										$herotarget = "";
									}elseif(($add_link) == 'Image'){
										$herolink = $image_link;
										$heroclass = "data-lightbox";
										$herorel = ' rel="lightbox"';
										$herotarget = "";
									}
								?>
									<div class="hero-item">
										<?php if ( has_post_thumbnail($heroslider_id) ) {
											$image_url = wp_get_attachment_image_src( get_post_thumbnail_id($heroslider_id), 'full' );
											echo '<div class="hero-image lazy-image" data-src="' . $image_url[0] . '"><img src="' . $image_url[0] . '" width="' . $image_url[1] . '" height="' . $image_url[2] . '" /></div>';
										} ?>					
										<div class="caption">
											<h4><?php echo ($herolink ? '<a href="' . $herolink . '" title="' . get_the_title($heroslider_id) . '" class="herolink ' . $heroclass . '"' . $herorel . $herotarget . '>' : ''); ?><?php echo get_the_title($heroslider_id); ?><?php echo ($herolink ? '</a>' : ''); ?></h4>
											<?php echo ('<p>' . $herocontent . '</p>'); ?>
											<?php if($herolink){ ?><p class="readmore"><?php echo ($herolink ? '<a href="' . $herolink . '" title="' . get_the_title($heroslider_id) . '" class="herolink-readmore ' . $heroclass . '"' . $herorel . $herotarget . '>' : ''); ?>Read more<?php echo ($herolink ? '</a>' : ''); ?></p><?php } ?>
										</div>								
									</div>
								<?php endwhile; ?>
							</div>
						</div>
					<?php else : endif; ?>
				<?php endif; ?>	
			</div>
		<?php } ?>
		
		<!-- News and Articles Section -->
		<?php if(get_field('show_news_and_articles_section', 'option')) { ?>
			<?php 
				$background = "";
				if(get_field('section_background_type_news_and_articles_section', 'option') == 'Color'){
					$background = (get_field('section_background_color_news_and_articles_section', 'option') ? 'background-color:' . get_field('section_background_color_news_and_articles_section', 'option') . '; '  : '');
				}else{
					$background = (get_field('section_background_image_news_and_articles_section', 'option') ? 'background:transparent url(' . get_field('section_background_image_news_and_articles_section', 'option') . ') center no-repeat;background-size:cover; '  : '');
				}
			?>
			<div class="news_articles section" style="<?php echo $background;?><?php echo(get_field('section_padding_top_news_and_articles_section', 'option') ? 'padding-top:' . get_field('section_padding_top_news_and_articles_section', 'option') . 'rem; '  : ''); ?><?php echo(get_field('section_padding_bottom_news_and_articles_section', 'option') ? 'padding-bottom:' . get_field('section_padding_bottom_news_and_articles_section', 'option') . 'rem; '  : ''); ?>">
				<div class="container">
					<div class="row-fluid">
						<div class="col-md-12">
							<?php echo(get_field('section_title_news_and_articles_section', 'option') ? '<h2 class="section-title">' . (get_field('section_pre_title_news_and_articles_section', 'option') ? '<span class="pre-title">' . get_field('section_pre_title_news_and_articles_section', 'option') . '</span>' : '') . '<span class="title"' . (get_field('section_title_color_news_and_articles_section', 'option') ? ' style="color:' . get_field('section_title_color_news_and_articles_section', 'option') . ';"' : '') . '>' . get_field('section_title_news_and_articles_section', 'option') . '</span>' . (get_field('section_description_news_and_articles_section', 'option') ? '<small ' .  (get_field('section_description_color_news_and_articles_section', 'option') ? ' style="color:' . get_field('section_description_color_news_and_articles_section', 'option') . ';"' : '') . '> ' . get_field('section_description_news_and_articles_section', 'option') . '</small>' : '') . '</h2>' : ''); ?>

							<div class="clearfix"></div>
						</div>
						<div class="clearfix"></div>				
					</div>
					<div class="clearfix"></div>
					<div class="row-fluid" id="news_list">
						<?php
							$news = $wp_query;
							$wp_query = null;
							$wp_query = new WP_Query();
							$num = get_field('section_number_items_news_and_articles_section', 'option');
							
							$args = array(
								'posts_per_page' => $num,
								'post_type' =>	array('story', 'press_release', 'events'),
								'status'	=>	'publish',
								'orderby'	=>	'date',
								'order'	=>	'DESC'
							);

							$wp_query->query($args);						
						?>
						<?php if (have_posts()) : $newsitem = 1; ?>
							<?php while (have_posts()) : the_post();
								//$firstPosts[] = get_the_ID();
								$id = get_the_ID();
								$image_url = "";
								if ( has_post_thumbnail() ) {
									$image_url = wp_get_attachment_image_src( get_post_thumbnail_id($id), 'medium-news-thumbnails' );
								}
							?>
							<div class="col-md-3 col-sm-6 news_item news_item_<?php echo $id ; ?>">
								<div class="news_content<?php echo((($newsitem % 4) == 0) ? ' news_content_last' : ((($newsitem % 4) == 1) ? ' news_content_first' : '' ) ); ?>">
									<div class="news_content_image">
										<div class="news_content_image_overlay"></div>
										<a href="<?php echo get_permalink($id); ?>" title="<?php echo get_the_title(); ?>" rel="bookmark">
											<div data-src="<?php echo $image_url[0]; ?>" class="news_content_icon lazy-image"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/news.png" width="800" height="350" title="<?php echo get_the_title(); ?>" alt="<?php echo get_the_title(); ?>" /></div>
										</a>											
									</div>
									<div class="news_content_title">
										<h4><a href="<?php echo get_permalink($id); ?>" title="<?php echo get_the_title(); ?>" <?php echo (get_field('section_title_color_news_and_articles_section', 'option') ? ' style="color:' . get_field('section_title_color_news_and_articles_section', 'option') . ';"' : ''); ?>><?php echo get_the_title(); ?></a></h4>
									</div>
									<div class="news_content_excerpt">
										<?php echo '<p class="excerpt" ' . (get_field('section_title_color_news_and_articles_section', 'option') ? ' style="color:' . get_field('section_title_color_news_and_articles_section', 'option') . ';"' : '') . '>'.limit_words(get_the_excerpt(), '12').' ... <br/> <a href="' . get_permalink($id) . '" title="' . get_the_title() . '" class="read-more">Read more</a></p>'; ?>
									</div>
								</div>
							</div>
						<?php 
								$newsitem++; 
								endwhile; ?>
									<?php if(get_field('show_see_more_button_news_and_articles_section', 'option')) {
										$btntype = get_field('see_more_button_type_news_and_articles_section', 'option');
										$btntext = get_field('see_more_button_text_news_and_articles_section', 'option');
										$post_object = get_field('see_more_button_post_link_news_and_articles_section', 'option');
										if( $post_object ){
											$post = $post_object;
											setup_postdata( $post ); 
											$news_id = get_the_ID();
											$news_link = get_the_permalink();
											
											wp_reset_postdata();
										}
									
										echo (($btntext && $news_link) ? '<div class="clearfix"></div><p class="see-more"><a href=' . $news_link . ' class="button ' . $btntype . '">' . $btntext . '</a></p>' : '');
									?>
									<?php } ?>
								</div>
							</div>
							<div class="clearfix"></div>
						<?php else : endif; $wp_query = null; $wp_query = $news; ?>
					</div>
					<div class="clearfix"></div>
				</div>
			</div>
		<?php } ?>			
	</div>
	<div class="clearfix clear"></div>

<?php wp_reset_query(); ?>

<?php get_footer(); ?>
