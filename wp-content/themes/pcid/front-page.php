<?php get_header(); ?>

	<div id="main_content" class="homepage frontpage">
		<div class="container">
			<div class="row">
				<div class="clearfix"></div>
			</div>
			<div class="clearfix"></div>
		</div>

			<!-- Hero Banner Section -->
			<?php if(get_field('show_hero_banner', 'option')) { ?>
				<div class="hero section">
					<div class="row-fluid">
						<?php if(get_field('show_banner_sidebar	', 'option')) { ?>
							<div class="col-md-8">
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
													$firstPosts[] = get_the_ID();
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
															$firstPosts[] = get_the_ID();
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
														<div class="caption">
															<h4><?php echo ($herolink ? '<a href="' . $herolink . '" title="' . get_the_title($heroslider_id) . '" class="herolink ' . $heroclass . '"' . $herorel . $herotarget . '>' : ''); ?><?php echo get_the_title($heroslider_id); ?><?php echo ($herolink ? '</a>' : ''); ?></h4>
															<?php echo ('<p>' . $herocontent . '</p>'); ?>
															<?php if($herolink){ ?><p class="readmore"><?php echo ($herolink ? '<a href="' . $herolink . '" title="' . get_the_title($heroslider_id) . '" class="herolink-readmore ' . $heroclass . '"' . $herorel . $herotarget . '>' : ''); ?>Read more<?php echo ($herolink ? '</a>' : ''); ?></p><?php } ?>
														</div>								
														<?php if ( has_post_thumbnail($heroslider_id) ) {
															$image_url = wp_get_attachment_image_src( get_post_thumbnail_id($heroslider_id), 'full' );
															echo '<div class="hero-image lazy-image" data-src="' . $image_url[0] . '"><img src="' . $image_url[0] . '" width="' . $image_url[1] . '" height="' . $image_url[2] . '" /></div>';
														} ?>					
													</div>
												<?php endwhile; ?>
											</div>
										</div>
									<?php else : endif; ?>
								<?php endif; ?>	
							</div>
							<div class="col-md-4">
								<div class="banner-widget">
									<?php
										dynamic_sidebar('Default Banner Sidebar');
									?>
								</div>
							</div>
							<div class="clearfix"></div>						
						<?php } else { ?>
							<div class="col-md-12">
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
													$firstPosts[] = get_the_ID();
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
															$firstPosts[] = get_the_ID();
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
														<div class="caption">
															<h4><?php echo ($herolink ? '<a href="' . $herolink . '" title="' . get_the_title($heroslider_id) . '" class="herolink ' . $heroclass . '"' . $herorel . $herotarget . '>' : ''); ?><?php echo get_the_title($heroslider_id); ?><?php echo ($herolink ? '</a>' : ''); ?></h4>
															<?php echo ('<p>' . $herocontent . '</p>'); ?>
															<?php if($herolink){ ?><p class="readmore"><?php echo ($herolink ? '<a href="' . $herolink . '" title="' . get_the_title($heroslider_id) . '" class="herolink-readmore ' . $heroclass . '"' . $herorel . $herotarget . '>' : ''); ?>Read more<?php echo ($herolink ? '</a>' : ''); ?></p><?php } ?>
														</div>								
														<?php if ( has_post_thumbnail($heroslider_id) ) {
															$image_url = wp_get_attachment_image_src( get_post_thumbnail_id($heroslider_id), 'full' );
															echo '<div class="hero-image lazy-image" data-src="' . $image_url[0] . '"><img src="' . $image_url[0] . '" width="' . $image_url[1] . '" height="' . $image_url[2] . '" /></div>';
														} ?>					
													</div>
												<?php endwhile; ?>
											</div>
										</div>
									<?php else : endif; ?>
								<?php endif; ?>	
							</div>
							<div class="clearfix"></div>						
						<?php } ?>
					</div>
				<div class="clearfix"></div>
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
						<?php if(get_field('show_events_links_section', 'option')) { ?>
							<div class="row-fluid">
								<div class="col-md-9">
									<?php echo(get_field('section_title_news_and_articles_section', 'option') ? '<h2 class="section-title">' . (get_field('section_pre_title_news_and_articles_section', 'option') ? '<span class="pre-title">' . get_field('section_pre_title_news_and_articles_section', 'option') . '</span>' : '') . '<span class="title"' . (get_field('section_title_color_news_and_articles_section', 'option') ? ' style="color:' . get_field('section_title_color_news_and_articles_section', 'option') . ';"' : '') . '>' . get_field('section_title_news_and_articles_section', 'option') . '</span>' . (get_field('section_description_news_and_articles_section', 'option') ? '<small ' .  (get_field('section_description_color_news_and_articles_section', 'option') ? ' style="color:' . get_field('section_description_color_news_and_articles_section', 'option') . ';"' : '') . '> ' . get_field('section_description_news_and_articles_section', 'option') . '</small>' : '') . '</h2>' : ''); ?>
									<div class="clearfix"></div>
									<div class="row-fluid" id="news_list">
										<?php
											$news = $wp_query;
											$wp_query = null;
											$wp_query = new WP_Query();
											$args = array(
												'post__not_in' => $firstPosts,
												'posts_per_page' => 6,
												'post_type' =>	array('story'),
												'status'	=>	'publish',
												'orderby'	=>	'date',
												'order'	=>	'DESC'
											);
											$wp_query->query($args);						
										?>
										<?php if (have_posts()) : $newsitem = 1; ?>
											<?php while (have_posts()) : the_post();
												$firstPosts[] = get_the_ID();
												$id = get_the_ID();
												$image_url = "";
												if ( has_post_thumbnail() ) {
													$image_url = wp_get_attachment_image_src( get_post_thumbnail_id($id), 'medium-news-thumbnails' );
												}
											?>
												<div class="col-md-4 col-sm-6 news_item news_item_<?php echo $id ; ?>">
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
											<div class="clearfix"></div>
											<div class="col-md-12">
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
													echo (($btntext && $news_link) ? '<p class="see-more"><a href=' . $news_link . ' class="button ' . $btntype . '">' . $btntext . '</a></p>' : '');
												?>
												<?php } ?>
											</div>
											<div class="clearfix"></div>
										<?php else : endif; $wp_query = null; $wp_query = $news; ?>										
									</div>
									<div class="clearfix"></div>
								</div>
								<div class="col-md-3 event_links">
									<?php $events_count = get_field('section_events_count_events_links_section', 'option');
										if($events_count > 0){ ?>
											<?php echo(get_field('section_title_events_links_section', 'option') ? '<h2 class="section-title">' . (get_field('section_pre_title_events_links_section', 'option') ? '<span class="pre-title">' . get_field('section_pre_title_events_links_section', 'option') . '</span>' : '') . '<span class="title"' . (get_field('section_title_color_events_links_section', 'option') ? ' style="color:' . get_field('section_title_color_events_links_section', 'option') . ';"' : '') . '>' . get_field('section_title_events_links_section', 'option') . '</span>' . (get_field('section_description_events_links_section', 'option') ? '<small ' .  (get_field('section_description_color_events_links_section', 'option') ? ' style="color:' . get_field('section_description_color_events_links_section', 'option') . ';"' : '') . '> ' . get_field('section_description_events_links_section', 'option') . '</small>' : '') . '</h2>' : ''); ?>
										<?php
											$hide =  get_field('section_hide_past_events_events_links_section', 'option');
											$today = date('Ymd');
											if($hide){
												$args = array(
													'posts_per_page' => $events_count,
													'post_type' =>	'event',
													'status'	=>	'publish',
													'meta_key' => 'start_date',
													'orderby'=> 'meta_value_num',
													'order'=> 'DESC',
													'meta_query' => array(
														 array(
															'key'		=> 'end_date',
															'compare'	=> '>=',
															'value'		=> $today,
														)
													),
												);
											}else{
												$args = array(
													'posts_per_page' => $events_count,
													'post_type' =>	'event',
													'status'	=>	'publish',
													'meta_key' => 'start_date',
													'orderby'=> 'meta_value_num',
													'order'=> 'DESC',
												);
											}
											$events_list = New WP_Query($args); ?>
											<?php if ($events_list) : $count = 1; ?>
												<?php  while ( $events_list->have_posts() ) : $events_list->the_post(); $event_id = get_the_ID();
													$event_class = " event_links-item-future";
													$event_header_image = get_field('event_header_image', $event_id);
													$event_details = get_field('event_details', $event_id);
													$right_side_image = get_field('right_side_image', $event_id);
													$url = get_field('url', $event_id);
													$custom_link = get_field('custom_link', $event_id);
													$all_day_event = get_field('all_day_event', $event_id);
													$start_date = get_field('start_date', $event_id);
													$start_time = get_field('start_time', $event_id);
													$end_date = get_field('end_date', $event_id);
													$end_time = get_field('end_time', $event_id);
													$address = get_field('address', $event_id);
													$sdate = new DateTime( $start_date );
													$edate = new DateTime( $end_date );
													if(($sdate >= $today) || ($edate >= $today)){
														$event_class = " event_links-item-past";
													}
													$link = ($custom_link ? $custom_link : get_permalink($event_id));
													$startdate = date_create_from_format('Ymd', get_field('start_date'));
													$enddate = date_create_from_format('Ymd', get_field('end_date'));
													$starttime = date_create_from_format('H:i', get_field('start_time'));
													$endtime = date_create_from_format('H:i', get_field('end_time'));
													if (($start_date == $end_date) || ($start_date && !$end_date)){
														$date = $startdate->format( 'l, F j, Y' );
													}else{
														if(($startdate->format('F')) == ($enddate->format('F'))){
															if(($startdate->format('Y')) == ($enddate->format('Y'))){
																$date = $startdate->format( 'F j' ) . ' - ' . $enddate->format( 'j, Y' );
															}else{
																$date = $startdate->format( 'F j, Y' ) . ' - ' . $enddate->format( 'F j, Y' );
															}
														}else{
															if(($startdate->format('Y')) == ($enddate->format('Y'))){
																$date = $startdate->format( 'F j' ) . ' - ' . $enddate->format( 'F j, Y' );
															}else{
																$date = $startdate->format( 'F j, Y' ) . ' - ' . $enddate->format( 'F j, Y' );
															}
														}
													}
													if (($start_time == $end_time) || ($start_time && !$end_time)){
														$date .= ' @ ' . $starttime->format( 'g:i A' );
													}else{
														if(($starttime->format( 'A' ))==($endtime->format( 'A' ))){
															$date .= ' @ ' . $starttime->format( 'g:i ' ) . ' - '  . $endtime->format( 'g:i A' );
														}else{
															$date .= ' @ ' . $starttime->format( 'g:i A' ) . ' - '  . $endtime->format( 'g:i A' );
														}
													}
												?>										
													<div class="event_links-item event_links-item-<?php echo $event_id . $event_class;?>">
														<h4 class="event-title"><a href="<?php echo $link; ?>" title="<?php echo get_the_title($event_id); ?>"><?php echo get_the_title($event_id); ?></a><?php echo (($start_date && $address) ? '<small><span class="venue_date">' . $date . (($address ? '<br/>' . $address : '')) . '</span></small>' : ''); ?></h4>
													</div>
												<?php $count += 1; endwhile; ?>
											<?php else : endif; ?>
											<div class="clearfix"></div>
											<div class="col-md-12">
												<?php $showbutton = get_field('show_see_more_buttone_events_links_section', 'option'); if( $showbutton && ($events_count > 0)) {
													$btntype = get_field('see_more_button_typee_events_links_section', 'option');
													$btntext = get_field('see_more_button_texte_events_links_section', 'option');
													$post_object = get_field('see_more_button_post_linke_events_links_section', 'option');
													if( $post_object ){
														$post = $post_object;
														setup_postdata( $post ); 
														$event_page_id = get_the_ID();
														$event_page_link = get_the_permalink();
														wp_reset_postdata();
													}
													echo (($btntext && $event_page_link) ? '<p class="see-more"><a href=' . $event_page_link . ' class="button ' . $btntype . '">' . $btntext . '</a></p>' : '');
												?>
											</div>
											<div class="clearfix"></div>
										<?php } ?>
									<?php } ?>
									<div class="clearfix"></div>
								</div>
								<div class="clearfix"></div>						
							</div>
							<div class="clearfix"></div>						
						<?php } else { ?>
							<div class="row-fluid" id="news_list">
								<div class="col-md-12">
									<?php echo(get_field('section_title_news_and_articles_section', 'option') ? '<h2 class="section-title">' . (get_field('section_pre_title_news_and_articles_section', 'option') ? '<span class="pre-title">' . get_field('section_pre_title_news_and_articles_section', 'option') . '</span>' : '') . '<span class="title"' . (get_field('section_title_color_news_and_articles_section', 'option') ? ' style="color:' . get_field('section_title_color_news_and_articles_section', 'option') . ';"' : '') . '>' . get_field('section_title_news_and_articles_section', 'option') . '</span>' . (get_field('section_description_news_and_articles_section', 'option') ? '<small ' .  (get_field('section_description_color_news_and_articles_section', 'option') ? ' style="color:' . get_field('section_description_color_news_and_articles_section', 'option') . ';"' : '') . '> ' . get_field('section_description_news_and_articles_section', 'option') . '</small>' : '') . '</h2>' : ''); ?>
									<div class="clearfix"></div>
								</div>
								<div class="clearfix"></div>
								<?php
									$news = $wp_query;
									$wp_query = null;
									$wp_query = new WP_Query();
									$args = array(
										'post__not_in' => $firstPosts,
										'posts_per_page' => 7,
										'post_type' =>	array('story', 'press_release'),
										'status'	=>	'publish',
										'orderby'	=>	'date',
										'order'	=>	'DESC'
									);
									$wp_query->query($args);						
								?>
								<?php if (have_posts()) : $newsitem = 1; ?>
									<?php while (have_posts()) : the_post();
										$firstPosts[] = get_the_ID();
										$id = get_the_ID();
										$image_url = "";
										if ( has_post_thumbnail() ) {
											$image_url = wp_get_attachment_image_src( get_post_thumbnail_id($id), 'medium-news-thumbnails' );
										}
									?>
									<?php if($newsitem < 4){ ?>
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
									<?php }elseif($newsitem == 4){ ?>
										<div class="col-md-3 col-sm-6 news_item">
											<div class="news_content<?php echo((($newsitem % 4) == 0) ? ' news_content_last' : ((($newsitem % 4) == 1) ? ' news_content_first' : '' ) ); ?>">
									<?php } ?>
									<?php if($newsitem >= 4){ ?>
										<div class="news_content_title">
											<h4><a href="<?php echo get_permalink($id); ?>" title="<?php echo get_the_title(); ?>" <?php echo (get_field('section_title_color_news_and_articles_section', 'option') ? ' style="color:' . get_field('section_title_color_news_and_articles_section', 'option') . ';"' : ''); ?>><?php echo get_the_title(); ?></a></h4>
										</div>
									<?php } ?>
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
												echo (($btntext && $news_link) ? '<p class="see-more"><a href=' . $news_link . ' class="button ' . $btntype . '">' . $btntext . '</a></p>' : '');
											?>
											<?php } ?>
										</div>
									</div>
									<div class="clearfix"></div>
								<?php else : endif; $wp_query = null; $wp_query = $news; ?>
							</div>
							<div class="clearfix"></div>						
						<?php } ?>
					</div>
				</div>
			<?php } ?>		

			<!-- Gallery Section -->
			<?php if(get_field('show_gallery_section', 'option')) { ?>
				<?php 
					$background = "";
					if(get_field('section_background_type_gallery_section', 'option') == 'Color'){
						$background = (get_field('section_background_color_gallery_section', 'option') ? 'background-color:' . get_field('section_background_color_gallery_section', 'option') . '; '  : '');
					}else{
						$background = (get_field('section_background_image_gallery_section', 'option') ? 'background:transparent url(' . get_field('section_background_image_gallery_section', 'option') . ') center no-repeat;background-size:cover; '  : '');
					}
				?>
				<div class="gallery section" style="<?php echo $background;?><?php echo(get_field('section_padding_top_gallery_section', 'option') ? 'padding-top:' . get_field('section_padding_top_gallery_section', 'option') . 'rem; '  : ''); ?><?php echo(get_field('section_padding_bottom_gallery_section', 'option') ? 'padding-bottom:' . get_field('section_padding_bottom_gallery_section', 'option') . 'rem; '  : ''); ?>">
					<div class="container">
						<div class="row-fluid">
							<div class="col-md-12">
								<?php echo(get_field('section_title_gallery_section', 'option') ? '<h2 class="section-title">' . (get_field('section_pre_title_gallery_section', 'option') ? '<span class="pre-title">' . get_field('section_pre_title_gallery_section', 'option') . '</span>' : '') . '<span class="title"' . (get_field('section_title_color_gallery_section', 'option') ? ' style="color:' . get_field('section_title_color_gallery_section', 'option') . ';"' : '') . '>' . get_field('section_title_gallery_section', 'option') . '</span>' . (get_field('section_description_gallery_section', 'option') ? '<small ' .  (get_field('section_description_color_gallery_section', 'option') ? ' style="color:' . get_field('section_description_color_gallery_section', 'option') . ';"' : '') . '> ' . get_field('section_description_gallery_section', 'option') . '</small>' : '') . '</h2>' : ''); ?>
								<div class="clearfix"></div>
							</div>
							<div class="clearfix"></div>
						</div>
						<div class="clearfix"></div>
						<div class="row">
							<div class="col-md-12">
								<?php if(get_field('section_gallery_shortcode_gallery_section', 'option')) { ?>
									<?php echo do_shortcode(get_field('section_gallery_shortcode_gallery_section', 'option'));?>
								<?php } ?>
								<div class="clearfix"></div>
							</div>
							<div class="clearfix"></div>
						</div>
						<div class="clearfix"></div>
						<div class="row-fluid">
							<div class="col-md-12">
								<?php if(get_field('show_see_more_button_gallery_section', 'option')) {
									$btntype = get_field('see_more_button_type_gallery_section', 'option');
									$btntext = get_field('see_more_button_text_gallery_section', 'option');
									$post_object = get_field('see_more_button_post_link_gallery_section', 'option');
									if( $post_object ){
										$post = $post_object;
										setup_postdata( $post ); 
										$gallery_id = get_the_ID();
										$gallery_link = get_the_permalink();
										wp_reset_postdata();
									}
									echo (($btntext && $gallery_link) ? '<p class="see-more"><a href=' . $gallery_link . ' class="button ' . $btntype . '">' . $btntext . '</a></p>' : '');
								?>
								<?php } ?>
								<div class="clearfix"></div>
							</div>
							<div class="clearfix"></div>
						</div>
						<div class="clearfix"></div>
					</div>
				</div>
			<?php } ?>

			<!-- Featured Videos Section -->
			<?php if(get_field('show_featured_videos_section', 'option')) { ?>
				<?php 
					$background = "";
					if(get_field('section_background_type_videos_section', 'option') == 'Color'){
						$background = (get_field('section_background_color_videos_section', 'option') ? 'background-color:' . get_field('section_background_color_videos_section', 'option') . '; '  : '');
					}else{
						$background = (get_field('section_background_image_videos_section', 'option') ? 'background:transparent url(' . get_field('section_background_image_videos_section', 'option') . ') center no-repeat;background-size:cover; '  : '');
					}
				?>
				<div class="featured-videos section" style="<?php echo $background;?><?php echo(get_field('section_padding_top_videos_section', 'option') ? 'padding-top:' . get_field('section_padding_top_videos_section', 'option') . 'rem; '  : ''); ?><?php echo(get_field('section_padding_bottom_videos_section', 'option') ? 'padding-bottom:' . get_field('section_padding_bottom_videos_section', 'option') . 'rem; '  : ''); ?>">
					<div class="container">
						<div class="row-fluid">
							<div class="col-md-12">
								<?php echo(get_field('section_title_videos_section', 'option') ? '<h2 class="section-title">' . (get_field('section_pre_title_videos_section', 'option') ? '<span class="pre-title">' . get_field('section_pre_title_videos_section', 'option') . '</span>' : '') . '<span class="title"' . (get_field('section_title_color_videos_section', 'option') ? ' style="color:' . get_field('section_title_color_videos_section', 'option') . ';"' : '') . '>' . get_field('section_title_videos_section', 'option') . '</span>' . (get_field('section_description_videos_section', 'option') ? '<small ' .  (get_field('section_description_color_videos_section', 'option') ? ' style="color:' . get_field('section_description_color_videos_section', 'option') . ';"' : '') . '> ' . get_field('section_description_videos_section', 'option') . '</small>' : '') . '</h2>' : ''); ?>
								<div class="clearfix"></div>
							</div>
							<div class="clearfix"></div>
						</div>
						<div class="clearfix"></div>
						<div class="row-fluid" id="video_list">
							<?php $video_count = get_field('number_of_videos_to_display_videos_section', 'option'); $video_featured = get_field('display_only_featured_videos_section', 'option'); ?>
							<?php if(get_field('number_of_columns_videos_section', 'option') == 'Two Columns'){
								$videocolcount = 2;
								$videocolclass = "col-md-6"
							?>
							<?php }elseif(get_field('number_of_columns_videos_section', 'option') == 'Three Columns'){
								$videocolcount = 3;
								$videocolclass = "col-md-4 col-sm-6"
							?>
							<?php }else{
								$videocolcount = 4;
								$videocolclass = "col-md-3 col-sm-6"
							?>
							<?php } ?>
							<?php
								if($video_featured){
									$args = array(
										'posts_per_page' => $video_count,
										'post_type' =>	'video',
										'status'	=>	'publish',
										'orderby'=> 'date',
										'order'=> 'DESC',
										'meta_query' => array(
											 array(
												'key'		=> 'featured',
												'compare'	=> '==',
												'value'		=> '1',
											)
										),
									);
								}else{
									$args = array(
										'posts_per_page' => $video_count,
										'post_type' =>	'video',
										'status'	=>	'publish',
										'orderby'=> 'date',
										'order'=> 'DESC',
									);
								}
								$video_list = New WP_Query($args);
							?>
							<?php if ($video_list) : $count = 1; ?>
								<?php  while ( $video_list->have_posts() ) : $video_list->the_post(); $video_post_id = get_the_ID();
									$video_description = get_field('video_description', $video_post_id);
									$youtube_video_id = get_field('youtube_video_id', $video_post_id);
									$video_link = 'https://www.youtube.com/watch?v='. get_field('youtube_video_id', $video_post_id);
									$video_image_placeholder = 'http://i3.ytimg.com/vi/' . get_field('youtube_video_id', $video_post_id) . '/0.jpg';
									$featured = get_field('featured', $video_post_id);
								?>
									<div class="<?php echo $videocolclass; ?>">
										<div class="video-content">
											<?php echo ('<a href="' . $video_link . '" class="wplightbox video-link" title="' . get_the_title($video_post_id) . '"><img src="' . $video_image_placeholder . '" width="480" height="360" class="video-placeholder" /></a>'); ?>
											<div class="video_content_title">
												<h4><a href="<?php echo get_permalink($video_post_id); ?>" title="<?php echo get_the_title(); ?>" <?php echo (get_field('section_title_color_videos_section', 'option') ? ' style="color:' . get_field('section_title_color_videos_section', 'option') . ';"' : ''); ?>><?php echo get_the_title(); ?></a></h4>
											</div>
										</div>
									</div>
								<?php echo ((($count % $videocolcount) == 0) ? '<div class="clearfix"></div>' : ''); ?>
								<?php $count += 1; endwhile; ?>
							<?php else : endif; ?>								
							
							<div class="clearfix"></div>
						</div>
						<div class="clearfix"></div>
						<div class="row-fluid">
							<div class="col-md-12">
								<?php if(get_field('show_see_more_button_videos_section', 'option')) {
									$btntype = get_field('see_more_button_type_videos_section', 'option');
									$btntext = get_field('see_more_button_text_videos_section	', 'option');
									$post_object = get_field('see_more_button_post_link_videos_section', 'option');
									if( $post_object ){
										$post = $post_object;
										setup_postdata( $post ); 
										$video_page_id = get_the_ID();
										$video_page_link = get_the_permalink();
										wp_reset_postdata();
									}
									echo (($btntext && $video_page_link) ? '<p class="see-more"><a href=' . $video_page_link . ' class="button ' . $btntype . '">' . $btntext . '</a></p>' : '');
								?>
								<?php } ?>
								<div class="clearfix"></div>
							</div>
							<div class="clearfix"></div>
						</div>
						<div class="clearfix"></div>
					</div>
				</div>
			<?php } ?>

		<div class="clearfix clear"></div>
	</div>
	<div class="clearfix clear"></div>

<?php wp_reset_query(); ?>

<?php get_footer(); ?>