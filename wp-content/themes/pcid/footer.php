		<footer id="main_footer">
			<div id="top_footer">
				<div class="container">
					<div class="row">
						<div class="col-md-3 col-sm-6">
							<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Footer One') ) : ?>
							<?php endif; ?>
						</div>
						<div class="col-md-3 col-sm-6">
							<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Footer Two') ) : ?>
							<?php endif; ?>
						</div>
						<div class="col-md-3 col-sm-6">
							<?php if(get_field('show_social_network_links', 'option')) { ?>
								<?php
									if( have_rows('social_network', 'option' ) ): ?>
										<span class="widget">
											<?php echo(get_field('section_title', 'option') ? '<h4>' . get_field('section_title', 'option') . '</h4>' : ''); ?>
											<ul class="footer_sn">
												<?php
													while ( have_rows('social_network', 'option' ) ) : the_row();
														$sn_name = get_sub_field('sn_name');
														$sn_type = get_sub_field('sn_type');
														$sn_url = get_sub_field('sn_url');
												?>
													<li class="<?php echo $sn_type; ?>"><a href="<?php echo $sn_url ?>" title="<?php echo $sn_name ?>" rel="nofollow" target="_blank" class="social-link"></a> <?php echo $sn_name ; ?></li>
												<?php endwhile; ?>
											</ul>
										</span>
								<?php
									endif;
								?>
							<?php } else { ?>
								<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Footer Three') ) : ?>
								<?php endif; ?>
							<?php } ?>
						</div>
						<div class="col-md-3 col-sm-6">
							<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Footer Four') ) : ?>
							<?php endif; ?>
						</div>
						<div class="clearfix clear"></div>
					</div>
					<div class="clearfix clear"></div>
				</div>
				<div class="clearfix clear"></div>
			</div>
			<div id="bottom_footer">
				<div class="container">
					<div class="row">
						<div class="col-md-12">
							<div class="copyright">
								<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Footer Copyright') ) : ?>
								<?php endif; ?>
							</div>
							<div class="clearfix clear"></div>
							<div class="footer-menu">
								<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Footer Menu') ) : ?>
								<?php endif; ?>
							</div>
							<div class="clearfix clear"></div>
						</div>
						<div class="clearfix clear"></div>
					</div>
				<div class="clearfix clear"></div>
			</div>
			<div class="clearfix clear"></div>
		</footer>
	</div>

	<script type="text/javascript" src="<?php echo get_stylesheet_directory_uri(); ?>/js/jquery-1.12.4.min.js"></script>

	<?php wp_footer(); ?>

	<script type="text/javascript" src="<?php echo get_stylesheet_directory_uri(); ?>/js/modernizr.js" defer></script>
	<script type="text/javascript" src="<?php echo get_stylesheet_directory_uri(); ?>/js/owl.carousel.min.js"></script>
	<script type="text/javascript" src="<?php echo get_stylesheet_directory_uri(); ?>/js/jquery.lazy.min.js"></script>
	<script type="text/javascript" src="<?php echo get_stylesheet_directory_uri(); ?>/js/lightbox.min.js" defer></script>
	<script type="text/javascript" src="<?php echo get_stylesheet_directory_uri(); ?>/js/modal.js" defer></script>
	<script type="text/javascript" src="<?php echo get_stylesheet_directory_uri(); ?>/js/classie.js" defer></script>
	<script type="text/javascript" src="<?php echo get_stylesheet_directory_uri(); ?>/js/vegas.min.js" defer></script>
	<script src="<?php echo get_stylesheet_directory_uri(); ?>/js/bootstrap.min.js" defer></script>
	<script src="<?php echo get_stylesheet_directory_uri(); ?>/js/jquery.simplemodal.js" defer></script>
	<script src="<?php echo get_stylesheet_directory_uri(); ?>/js/jquery.counteverest.min.js"></script>
	<script src="<?php echo get_stylesheet_directory_uri(); ?>/scripts/scripts.js" defer></script>
	<script type="text/javascript" src="<?php echo get_stylesheet_directory_uri(); ?>/js/user-interactions.js" defer></script>
</body>
</html>