<?php  
/**
 * Template Name: Single Event
 *
 */
?>

<style type="text/css">
.acf-map {
	width: 100%;
	height: 400px;
	border: #ccc solid 1px;
	margin: 20px 0;
}
/* fixes potential theme css conflict */
.acf-map img {
   max-width: inherit !important;
}
</style>

<script type='text/javascript' src='http://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js'></script>
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&key=AIzaSyDOiDvxa8z9wWPR8YJGaFkty1JFA4XXy_Q"></script>
<script type="text/javascript">
(function($) {
/*
*  new_map
*
*  This function will render a Google Map onto the selected jQuery element
*
*  @type	function
*  @date	8/11/2013
*  @since	4.3.0
*
*  @param	$el (jQuery element)
*  @return	n/a
*/
function new_map( $el ) {
	// var
	var $markers = $el.find('.marker');
	// vars
	var args = {
		zoom		: 18,
		center		: new google.maps.LatLng(0, 0),
		mapTypeId	: google.maps.MapTypeId.ROADMAP
	};
	// create map	        	
	var map = new google.maps.Map( $el[0], args);
	// add a markers reference
	map.markers = [];
	// add markers
	$markers.each(function(){
    	add_marker( $(this), map );
	});
	// center map
	center_map( map );
	// return
	return map;
}
/*
*  add_marker
*
*  This function will add a marker to the selected Google Map
*
*  @type	function
*  @date	8/11/2013
*  @since	4.3.0
*
*  @param	$marker (jQuery element)
*  @param	map (Google Map object)
*  @return	n/a
*/
function add_marker( $marker, map ) {
	// var
	var latlng = new google.maps.LatLng( $marker.attr('data-lat'), $marker.attr('data-lng') );
	// create marker
	var marker = new google.maps.Marker({
		position	: latlng,
		map			: map
	});
	// add to array
	map.markers.push( marker );
	// if marker contains HTML, add it to an infoWindow
	if( $marker.html() )
	{
		// create info window
		var infowindow = new google.maps.InfoWindow({
			content		: $marker.html()
		});
		// show info window when marker is clicked
		google.maps.event.addListener(marker, 'click', function() {
			infowindow.open( map, marker );
		});
	}
}
function center_map( map ) {
	// vars
	var bounds = new google.maps.LatLngBounds();
	// loop through all markers and create bounds
	$.each( map.markers, function( i, marker ){
		var latlng = new google.maps.LatLng( marker.position.lat(), marker.position.lng() );
		bounds.extend( latlng );
	});
	// only 1 marker?
	if( map.markers.length == 1 )
	{
		// set center of map
	    map.setCenter( bounds.getCenter() );
	    map.setZoom( 18 );
	}
	else
	{
		// fit to bounds
		map.fitBounds( bounds );
	}
}
// global var
var map = null;
$(document).ready(function(){
	$('.acf-map').each(function(){
		// create map
		map = new_map( $(this) );
	});
});
})(jQuery);
</script>

<?php get_header(); set_pcid_post_views(get_the_ID()); ?>
<?php if (have_posts()) : ?>
	<div id="main_content" class="single-event">
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
							$post_object = get_field('events_page', 'option');
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
								<?php echo ( get_field('show_content_title', $the_ID ) ? '<h2 class="article-title"><span class="pre-title"><a href="' . $news_page_link . '" title="' . $news_page_title . '">' . $news_page_title . '</a></span>' . get_field('content_title', $the_ID ) . '<span class="edit-link">' . edit_post_link('Edit this event', ' | ', '') . ' | <a href="' . add_query_arg(array('post_type'=>'event'),admin_url('post-new.php')) . ' title="Add new event" class="post-add-link">Add new event</a></span></h2>' : '' ); ?>
							<?php } else { ?>
								<h2 class="article-title"><span class="pre-title"><a href="<?php echo $news_page_link; ?>" title="<?php echo $news_page_title; ?>"><?php echo $news_page_title; ?></a></span><?php echo get_the_title(); ?><span class="edit-link"><?php edit_post_link('Edit this event', ' | ', ''); ?><?php echo ' | <a href="' . add_query_arg(array('post_type'=>'event'),admin_url('post-new.php')) . '" title="Add new event" class="post-add-link">Add new event</a>'; ?></span></h2>
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
							<div class="event-details">
								<?php
									$all_day_event = get_field('all_day_event', $the_ID);
									$start_date = get_field('start_date', $the_ID);
									$start_time = get_field('start_time', $the_ID);
									$end_date = get_field('end_date', $the_ID);
									$end_time = get_field('end_time', $the_ID);
									$organizer_name = get_field('organizer_name', $the_ID);
									$speakers = get_field('speakers', $the_ID);
									$organizer_phone = get_field('organizer_phone', $the_ID);
									$organizer_website = get_field('organizer_website', $the_ID);
									$organizer_email = get_field('organizer_email', $the_ID);
									$event_website_url = get_field('event_website_url', $the_ID);
									$link = ($custom_link ? $custom_link : get_permalink($the_ID));
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
								<h3>Event Details</h3>
								<?php echo ((get_field('venue_name', $the_ID)) ? '<span class="venue_name"><b>Venue</b>: ' . get_field('venue_name', $the_ID) . '</span>' : ''); ?>
								<?php echo ((get_field('address', $the_ID)) ? '<span class="address"><b>Address</b>: ' . get_field('address', $the_ID) . '</span>' : ''); ?>
								<?php echo ($date ? '<span class="date"><b>Date</b>: ' . $date . '</span>' : ''); ?>
								<?php echo ($organizer_name ? '<h3>Organizer</h3><span class="organizer"><b>Organizer Name</b>: ' . $organizer_name . ($organizer_phone ? '<br /><span class="organizer_contact">Telephone: ' . $organizer_phone . '</span>' : '') . ($organizer_website ? '<br /><span class="organizer_website">Website: <a href="' . $organizer_website . '" target="_blank" title="' . $organizer_name . '">' . $organizer_website . '</a></span>' : '') . ($organizer_email ? '<br /><span class="organizer_email">Email Address: <a href="mailto:' . $organizer_email . '" target="_blank" title="' . $organizer_name . '">' . $organizer_email . '</a></span>' : '') . '</span>' : ''); ?>
								<?php
									if( have_rows('speakers', $the_ID) ):
									  $i = 0; 
									  while( have_rows('speakers', $the_ID) ): the_row(); 
										if( get_sub_field('speaker_name', $the_ID) ) $i++;
									 endwhile; 
									  $tCount = $i;
									endif;
									if( have_rows('speakers', $the_ID ) ): echo (($tCount > 1) ? '<h3>Speakers</h3>' : '<h3>Speaker</h3>');
										while ( have_rows('speakers', $the_ID ) ) : the_row();
											$speaker_name = get_sub_field('speaker_name', $the_ID );
											$speaker_department_designation = get_sub_field('speaker_department_designation', $the_ID );
											$speaker_photo = get_sub_field('speaker_photo', $the_ID );
											$speaker_email = get_sub_field('speaker_email', $the_ID );
											$speaker_url = get_sub_field('speaker_url', $the_ID );
											$speaker_target = get_sub_field('speaker_target', $the_ID );
											if($speaker_url){
												echo ('<span class="speaker"><a href="' . $speaker_url . '" target="' . $speaker_target . '" title="' . $speaker_name . '">' . ($speaker_photo ? '<span class="speaker_photo" style="float:left;margin-right:1rem;margin-bottom:1rem;"><img src="' . $speaker_photo['sizes']['small-photo-thumbnails'] . '" title="' . $speaker_name . '" alt="' . $speaker_name . '" width="80" height="80" /></span>': '') . $speaker_name . '</a><br />' . $speaker_department_designation . ($speaker_email ? '<br /><span class="speaker_email"><a href="mailto:' . $speaker_email . '" target="' . $speaker_target . '" title="' . $speaker_name . '">' . $speaker_email . '</a></span>' : '') . '</span>');
											}else{
												echo ('<span class="speaker">' . ($speaker_photo ? '<span class="speaker_photo" style="float:left;margin-right:1rem;margin-bottom:1rem;"><img src="' . $speaker_photo['sizes']['small-photo-thumbnails'] . '" title="' . $speaker_name . '" alt="' . $speaker_name . '" width="80" height="80" /></span>': '') . $speaker_name . '<br />' . $speaker_department_designation . ($speaker_email ? '<br /><span class="speaker_email"><a href="mailto:' . $speaker_email . '" target="' . $speaker_target . '" title="' . $speaker_name . '">' . $speaker_email . '</a></span>' : '') . '</span>');
											}
										endwhile;
										echo ('<div class="clearfix"></div>');
									else :
									endif;
								?>					
							</div>
							<?php if(get_field('show_google_map', $the_ID)) { ?>
								<?php 
									$location = get_field('event_location', $the_ID);
									if( !empty($location) ):?>
										<div class="acf-map">
											<div class="marker" data-lat="<?php echo $location['lat']; ?>" data-lng="<?php echo $location['lng']; ?>"></div>
										</div>
									<?php endif; ?>							
							<?php } ?>
							<!--
							<?php if(get_field('show_google_calendar_button', $the_ID) || get_field('show_ical_button', $the_ID)) { ?>
								<p class="buttons">
									<?php if(get_field('show_google_calendar_button', $the_ID)){ ?>
										<a href="" title="Add to Google Calendar" class="button btn_secondary">+ Google Calendar</a>
									<?php } ?>
									<?php if(get_field('show_ical_button', $the_ID)){ ?>
										<a href="" title="Add to iCal" class="button btn_primary">+ iCal Export</a>
									<?php } ?>
								</p>
							<?php } ?>
							-->
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
										dynamic_sidebar('Default Events Sidebar');
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