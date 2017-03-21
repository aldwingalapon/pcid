<?php get_header(); ?>

	<div id="main_content" class="search-results-page">
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
						<h2 class="article-title">Search Results</h2>
						
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