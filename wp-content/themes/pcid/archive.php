<?php get_header(); ?>

	<div id="main_content" class="search-results-page page-archives">
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
			<div class="container">
				<div class="row">
					<div class="col-md-8 article">
						<?php
							$current_tag = single_tag_title("", false);
							echo "<h2 class='article-title'>Archive: ".$current_tag."</h2>";
						?>		

						<?php if (have_posts()) : while (have_posts()) : the_post(); $the_ID = $post->ID; ?>
							<div <?php post_class(); ?> id="post-<?php the_ID(); ?>">
								<h4>
								<?php $permalink = get_permalink();
									if( 'story' == get_post_type() ) { ?>
										<?php
											$post_object = get_field('news_page', 'option');
											if( $post_object ){
												$post = $post_object;
												setup_postdata( $post ); 
												$news_page_link = get_the_permalink();
												$news_page_title = get_the_title();
												wp_reset_postdata();
											}
										?>									
										<a href="<?php echo esc_url( $permalink ); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a><br />
										<small><?php echo('<a href="' . $news_page_link . '" title="' . $news_page_title . '">' . $news_page_title . '</a>'); ?></small>
									<?php } elseif( 'event' == get_post_type() ) { ?>
										<?php
											$post_object = get_field('events_page', 'option');
											if( $post_object ){
												$post = $post_object;
												setup_postdata( $post ); 
												$events_page_link = get_the_permalink();
												$events_page_title = get_the_title();
												wp_reset_postdata();
											}
										?>									
										<a href="<?php echo esc_url( $permalink ); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a><br />
										<small><?php echo('<a href="' . $events_page_link . '" title="' . $events_page_title . '">' . $events_page_title . '</a>'); ?></small>				
									<?php } elseif( 'press_release' == get_post_type() ) { ?>
										<?php
											$post_object = get_field('press_release_page', 'option');
											if( $post_object ){
												$post = $post_object;
												setup_postdata( $post ); 
												$press_release_page_link = get_the_permalink();
												$press_release_page_title = get_the_title();
												wp_reset_postdata();
											}
										?>									
										<a href="<?php echo esc_url( $permalink ); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a><br />
										<small><?php echo('<a href="' . $press_release_page_link . '" title="' . $press_release_page_title . '">' . $press_release_page_title . '</a>'); ?></small>				
									<?php } elseif( 'video' == get_post_type() ) { ?>
										<?php
											$post_object = get_field('videos_page', 'option');
											if( $post_object ){
												$post = $post_object;
												setup_postdata( $post ); 
												$videos_page_link = get_the_permalink();
												$videos_page_title = get_the_title();
												wp_reset_postdata();
											}
										?>									
										<a href="<?php echo esc_url( $permalink ); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a><br />
										<small><?php echo('<a href="' . $videos_page_link . '" title="' . $videos_page_title . '">' . $videos_page_title . '</a>'); ?></small>				
									<?php } elseif( 'publication' == get_post_type() ) { ?>
										<?php
											$post_object = get_field('publications_page', 'option');
											if( $post_object ){
												$post = $post_object;
												setup_postdata( $post ); 
												$publication_page_link = get_the_permalink();
												$publication_page_title = get_the_title();
												wp_reset_postdata();
											}
										?>									
										<a href="<?php echo esc_url( $permalink ); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a><br />
										<small><?php echo('<a href="' . $publication_page_link . '" title="' . $publication_page_title . '">' . $publication_page_title . '</a>'); ?></small>				
									<?php } elseif( 'personnel' == get_post_type() ) { ?>
										<a href="<?php echo esc_url( $permalink ); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a><br />
										<?php
											$terms = get_the_terms( $the_ID, 'personnel_type' ); 
											foreach($terms as $term) {
												$post_object = get_field('personnel_type_page', $term);
												if( $post_object ){
													$post = $post_object;
													setup_postdata( $post ); 
													$personnel_type_page = get_the_permalink();
													wp_reset_postdata();
												}
												echo '<small class="personnel-page"><a href="' . $personnel_type_page . '" title="' . $term->name .'">' . $term->name . '</a></small>';
											}										
										?>
									<?php } elseif( 'post' == get_post_type() ) { ?>
										<a href="<?php echo esc_url( $permalink ); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a><br />
										<?php
											$terms = get_the_terms( $the_ID, 'category' ); 
											foreach($terms as $term) {
												$post_object = get_field('main_blog_page', $term);
												if( $post_object ){
													$post = $post_object;
													setup_postdata( $post ); 
													$blog_page = get_the_permalink();
													wp_reset_postdata();
												}
												echo '<small class="blog-page"><a href="' . $blog_page . '" title="' . $term->name .'">' . $term->name . '</a></small>';
											}										
										?>
									<?php } else { ?>
										<a href="<?php echo esc_url( $permalink ); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>					
								<?php } ?>
								</h4>
								<?php if( ('post' == get_post_type()) || ('story' == get_post_type()) || ('event' == get_post_type()) || ('press_release' == get_post_type())) { ?>
									<?php echo '<p class="excerpt" ' . (get_field('section_title_color_news_and_articles_section', 'option') ? ' style="color:' . get_field('section_title_color_news_and_articles_section', 'option') . ';"' : '') . '>' . limit_words(get_the_excerpt(), '40') . ' ... </p>'; ?>
								<?php } elseif( 'video' == get_post_type() ) {
									$video_description = get_field('video_description', $the_ID);
								?>
									<?php echo '<p class="excerpt" ' . (get_field('section_title_color_news_and_articles_section', 'option') ? ' style="color:' . get_field('section_title_color_news_and_articles_section', 'option') . ';"' : '') . '>' . limit_words($video_description, '40') . ' ... </p>'; ?>
								<?php } elseif( 'publication' == get_post_type() ) { ?>
									<?php echo ((get_field('summary', $the_ID)) ? '<p class="summary" ' . (get_field('section_title_color_news_and_articles_section', 'option') ? ' style="color:' . get_field('section_title_color_news_and_articles_section', 'option') . ';"' : '') . '>' . get_field('summary', $the_ID) . '</p>' : ''); ?>
								<?php } elseif( 'personnel' == get_post_type() ) { ?>
									<?php echo (get_field('biography', $the_ID) ? '<div class="biography">' . limit_words(get_field('biography', $the_ID), '60') . '</div>' : ''); ?>
								<?php } ?>

								<div class="post-metadata">					
									<?php
										$posttags = get_the_tags();
										if ($posttags) {
											$html = '<div class="post_tags" title="Tags"><i class="fa fa-tags"></i> <ul>';
											foreach($posttags as $tag) {
												$tag_link = get_tag_link($tag->term_id);
												$html .= "<li><a href='{$tag_link}' title='{$tag->name}' class='{$tag->slug}'>";
												$html .= "{$tag->name}</a></li>";
											}
										$html .= '</ul></div>';
										echo $html;
										}
									?>
								</div>

								<div class="search-result-footer"></div>
							</div>

							<?php endwhile; ?>
								<?php if(function_exists('wp_page_numbers')) { wp_page_numbers(); } ?>
							<?php else : ?>
								<p>No search results to display.</p>
							<?php endif; ?>						
					</div>
					<div class="col-md-4 aside">
						<?php
							dynamic_sidebar('Default Sidebar');
						?>					
					</div>
					<div class="clearfix"></div>
				</div>
				<div class="clearfix"></div>				
			</div>
		</div>
		<div class="clearfix clear"></div>
	</div>
	<div class="clearfix clear"></div>


<?php wp_reset_query(); ?>

<?php get_footer(); ?>