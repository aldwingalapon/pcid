<?php  
/**
 * Template Name: Single News
 *
 */
?>
<?php get_header(); set_pcid_post_views(get_the_ID()); ?>
<?php if (have_posts()) : ?>
	<div id="main_content" class="single-news">
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
						<div class="col-md-8 article">
							<?php if(get_field('hide_content_title', $the_ID)) { ?>
								<?php echo ( get_field('show_content_title', $the_ID ) ? '<h2 class="article-title"><span class="pre-title"><a href="' . $news_page_link . '" title="' . $news_page_title . '">' . $news_page_title . '</a></span>' . get_field('content_title', $the_ID ) . '<span class="edit-link">' . edit_post_link('Edit this article', ' | ', '') . (( current_user_can('edit_posts') ) ? ' | <a href="' . add_query_arg(array('post_type'=>'news'),admin_url('post-new.php')) . ' title="Add new article" class="post-add-link">Add new article</a>' : '') . '</span></h2>' : '' ); ?>
							<?php } else { ?>
								<h2 class="article-title"><span class="pre-title"><a href="<?php echo $news_page_link; ?>" title="<?php echo $news_page_title; ?>"><?php echo $news_page_title; ?></a></span><?php echo get_the_title(); ?><span class="edit-link"><?php edit_post_link('Edit this article', ' | ', ''); ?><?php echo (( current_user_can('edit_posts') ) ? ' | <a href="' . add_query_arg(array('post_type'=>'news'),admin_url('post-new.php')) . '" title="Add new article" class="post-add-link">Add new article</a>' : ''); ?></span></h2>
							<?php } ?>
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
								<span class="social-links">
									<span class="share-this">SHARE THIS</span>
									<span class="facebook social"><a href="http://www.facebook.com/sharer.php?u=<?php echo get_permalink($id); ?>" title="Share in Facebook" rel="nofollow" onclick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=220,width=600');return false;"></a></span>
									<span class="twitter social"><a href="https://twitter.com/share?url=<?php echo get_permalink($id); ?>" title="" rel="nofollow" onclick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=260,width=600');return false;"></a></span>
									<span class="googleplus social"><a href="https://plus.google.com/share?url=<?php echo get_permalink($id); ?>" title="" rel="nofollow" onclick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;"></a></span>
									<span class="rss social"><a href="https://www.rss.com//shareArticle?url=<?php echo get_permalink($id); ?>" title="" rel="nofollow" onclick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;"></a></span>
									<span class="email social"><a href="mailto:?subject=<?php echo get_permalink($id); ?>" title="" rel="nofollow" onclick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=260,width=600');return false;"></a></span>
								</span>
							</div>
							<?php the_content(); ?>
							<div class="article-footer">
								<p class="category-post"><b>Posted in</b>: <?php the_category( '&bull;' ); ?></p>
								<p class="category-post"><?php the_tags( '<b>Tags</b>: ', ' • ', ' ' ); ?></p>
							</div>
						</div>
						<div class="col-md-4 aside">
							<?php
								if( have_rows('page_widgets', $the_ID ) ):
									while ( have_rows('page_widgets', $the_ID ) ) : the_row();
										dynamic_sidebar( get_sub_field('sidebar_widget', $the_ID ) );
									endwhile;
								else :
										dynamic_sidebar('Default News Sidebar');
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