<?php
/**
 * Download button
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly
?>
<p><a class="aligncenter download-button" href="<?php $dlm_download->the_download_link(); ?>" rel="nofollow">
		<?php printf( __( 'Download &ldquo;%s&rdquo;', 'download-monitor' ), $dlm_download->get_the_title() ); ?>
		<small>Filename: <?php $dlm_download->the_filename(); ?> / Filesize: <?php $dlm_download->the_filesize(); ?></small>
	</a></p>