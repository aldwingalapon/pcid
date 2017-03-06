<?php 
/**
* Envato updater
* version 1.0.0
*/

if ( ! function_exists( 'cptch_envato_get_plugins' ) ) {
	function cptch_envato_get_plugins( $transient ) {	
		global $cptchpls_plugin_info;	

		$wp_plugin_key = 'captcha-plus/captcha-plus.php';
		if ( empty( $cptchpls_plugin_info ) ) {
			if ( ! function_exists( 'get_plugin_data' ) )
				require_once( ABSPATH . 'wp-admin/includes/plugin.php' );
			$cptchpls_plugin_info = get_plugin_data( dirname( dirname( __FILE__ ) ) . '/captcha-plus.php' );
		}

		$response = cptch_envato_request( 'https://api.envato.com/v3/market/buyer/list-purchases?filter_by=wordpress-plugins' );

		if ( is_wp_error( $response ) ) {
			echo '<div class="error below-h2"><p>' . $response->get_error_message() . '</p></div>';
			return $transient;			
		} elseif ( empty( $response ) || empty( $response['results'] ) ) {
			return $transient;
		}

		/* loop through the marketplace plugins */
		foreach ( $response['results'] as $plugin_element ) {

			if ( str_replace( ' by BestWebSoft', '', $cptchpls_plugin_info['Name'] ) == $plugin_element['item']['wordpress_plugin_metadata']['plugin_name'] && $cptchpls_plugin_info['AuthorName'] == $plugin_element['item']['wordpress_plugin_metadata']['author'] ) {

				if ( version_compare( $cptchpls_plugin_info['Version'], $plugin_element['item']['wordpress_plugin_metadata']['version'], '<' ) ) {
					$url = cptch_envato_get_download_url( $plugin_element['item']['id'] );
					if ( ! $url ) {
						echo '<div class="error below-h2"><p>' . __( 'An unknown Envato API error occurred.', 'captcha-plus' ) . '</p></div>';
					} else {						
						$path = explode( '/', $wp_plugin_key );
						$transient->response[ $wp_plugin_key ] = (object) array(
							'package'		=> $url,
							'slug' 			=> $path[0],
							'plugin' 		=> $wp_plugin_key,
							'new_version'	=> $plugin_element['item']['wordpress_plugin_metadata']['version'],
							'url'			=> $cptchpls_plugin_info['PluginURI']
						);

						$requires_wp = $tested_wp = null;
						$versions = array();

						/* Set the required and tested WordPress version numbers */
						foreach ( $plugin_element['item']['attributes'] as $value ) {
							if ( 'compatible-software' === $value['name'] ) {
								foreach ( $value['value'] as $version ) {
									$versions[] = str_replace( 'WordPress ', '', trim( $version ) );
								}
								if ( ! empty( $versions ) ) {
									$requires_wp = $versions[ count( $versions ) - 1 ];
									$tested_wp = $versions[0];
								}
								break;
							}
						}

						$envato_transient = array(
							'id' 			=> $plugin_element['item']['id'],
							'name' 			=> ( ! empty( $plugin_element['item']['wordpress_plugin_metadata']['plugin_name'] ) ? $plugin_element['item']['wordpress_plugin_metadata']['plugin_name'] : '' ),
							'author' 		=> ( ! empty( $plugin_element['item']['wordpress_plugin_metadata']['author'] ) ? $plugin_element['item']['wordpress_plugin_metadata']['author'] : '' ),
							'version' 		=> ( ! empty( $plugin_element['item']['wordpress_plugin_metadata']['version'] ) ? $plugin_element['item']['wordpress_plugin_metadata']['version'] : '' ),
							'description' 	=> $plugin_element['item']['wordpress_plugin_metadata']['description'],
							'url' 			=> ( ! empty( $plugin_element['item']['url'] ) ? $plugin_element['item']['url'] : '' ),
							'landscape_url' => ( ! empty( $plugin_element['item']['previews']['landscape_preview']['landscape_url'] ) ? $plugin_element['item']['previews']['landscape_preview']['landscape_url'] : '' ),
							'requires' 		=> $requires_wp,
							'tested' 		=> $tested_wp,
							'number_of_sales' => ( ! empty( $plugin_element['item']['number_of_sales'] ) ? $plugin_element['item']['number_of_sales'] : '' ),
							'updated_at' 	=> ( ! empty( $plugin_element['item']['updated_at'] ) ? $plugin_element['item']['updated_at'] : '' ),
							'rating' 		=> ( ! empty( $plugin_element['item']['rating'] ) ? $plugin_element['item']['rating'] : '' ),
							'rating_count'	=> ( ! empty( $plugin_element['item']['rating_count'] ) ? $plugin_element['item']['rating_count'] : '' ),
							'package'		=> $url
						);

						set_site_transient( 'cptch_envato_plugin', $envato_transient, HOUR_IN_SECONDS );
					}
				}				
				break;
			}
		}
		return $transient;
	}
}

/**
* Request for Envato API.
*
* @param  string $url API request URL, including the request method, parameters, file type.
* @return array  The HTTP response.
*/
if ( ! function_exists( 'cptch_envato_request' ) ) {
	function cptch_envato_request( $url ) {
		global $cptchpls_options, $cptchpls_plugin_info;

		if ( empty( $cptchpls_options ) )
			$cptchpls_options = get_option( 'cptchpls_options' );

		if ( empty( $cptchpls_options["envato_token"] ) )
			return false;

		$args = array(
			'headers' => array(
				'Authorization' => 'Bearer ' . $cptchpls_options["envato_token"],
				'User-Agent' => $cptchpls_plugin_info["Name"] . '/' . $cptchpls_plugin_info["Version"],
			),
			'timeout' => 20
		);

		$request = wp_safe_remote_request( $url, $args );
		if ( is_wp_error( $request ) )
			return new WP_Error( 'cptch_envato_api_error', $request->get_error_message() );

		$return = json_decode( wp_remote_retrieve_body( $request ), true );
		if ( 200 == wp_remote_retrieve_response_code( $request ) ) {		
			if ( null === $return )
				return new WP_Error( 'cptch_envato_api_error', __( 'An unknown Envato API error occurred.', 'captcha-plus' ) );

			return $return;
		} elseif ( isset( $return['error_description'] ) ) {
			return new WP_Error( 'cptch_envato_api_error', __( 'Envato API error', 'captcha-plus' ) . ': ' . $return['error_description'], 'captcha-plus' );
		} else {
			return new WP_Error( 'cptch_envato_api_error', __( 'An unknown Envato API error occurred.', 'captcha-plus' ) );
		}
	}
}

/**
 * Download the item
 *
 * @param  int   $id The item ID.
 * @return bool|array The HTTP response.
 */
if ( ! function_exists( 'cptch_envato_get_download_url' ) ) {
	function cptch_envato_get_download_url( $item_id ) {
		$response = cptch_envato_request( 'https://api.envato.com/v3/market/buyer/download?item_id=' . $item_id . '&shorten_url=true' );

		if ( is_wp_error( $response ) || empty( $response ) || ! empty( $response['error'] ) )
			return false;

		if ( ! empty( $response['wordpress_theme'] ) )
			return $response['wordpress_theme'];

		if ( ! empty( $response['wordpress_plugin'] ) )
			return $response['wordpress_plugin'];

		return false;
	}
}

/**
* Inject API data for premium plugins.
*
* @param bool   $response false
* @param string $action The API action being performed
* @param object $args Plugin arguments
* @return bool|object $response The plugin info or false
*/
if ( ! function_exists( 'cptch_plugins_api' ) ) {
	function cptch_plugins_api( $response, $action, $args ) {
		if ( 'plugin_information' === $action && isset( $args->slug ) && 'captcha-plus' == $args->slug ) {
			$envato_installed = get_site_transient( 'cptch_envato_plugin' );
			if ( $envato_installed ) {
				$response = new stdClass();
				$response->slug = $args->slug;
				$response->plugin = 'captcha-plus/captcha-plus.php';
				$response->plugin_name = $envato_installed['name'];
				$response->name = $envato_installed['name'];
				$response->version = $envato_installed['version'];
				$response->author = $envato_installed['author'];
				$response->homepage = $envato_installed['url'];
				$response->requires = $envato_installed['requires'];
				$response->tested = $envato_installed['tested'];
				$response->downloaded = $envato_installed['number_of_sales'];
				$response->last_updated = $envato_installed['updated_at'];
				$response->sections = array( 'description' => $envato_installed['description'] );
				$response->banners['low'] = $envato_installed['landscape_url'];
				$response->rating = $envato_installed['rating'] / 5 * 100;
				$response->num_ratings = $envato_installed['rating_count'];
				$response->download_link = $envato_installed['package'];
			}
		}

		return $response;
	}
}

if ( ! function_exists( 'cptch_settings_page_action' ) ) {
	function cptch_settings_page_action( $options ) { ?>
		<tr valign="top">
			<th><?php _e( 'Envato compatibility', 'captcha-plus' ); ?></th>
			<td colspan="2">
				<p class="description"><a href="https://build.envato.com/create-token/?purchase:download=t&amp;purchase:verify=t&amp;purchase:list=t" target="_blank"><?php _e( 'Generate your Envato API Personal Token', 'captcha-plus' ); ?></a> <?php _e( 'and insert it below.', 'captcha-plus' ); ?></p>
				<input class="cptchpls_settings_input" type="text" name="cptch_envato_token" value="<?php if ( isset( $options['envato_token'] ) ) echo $options['envato_token']; ?>" autocomplete="off">
			</td>
		</tr>
		<?php return $options;
	}
}

if ( ! function_exists( 'cptch_before_save_options' ) ) {
	function cptch_before_save_options( $options ) {
		if ( isset( $_POST["cptch_envato_token"] ) )
			$options['envato_token'] = stripslashes( esc_html( $_POST["cptch_envato_token"] ) );

		return $options;
	}
}

/* Inject Envato plugin updates into the response array. */
add_filter( 'pre_set_site_transient_update_plugins', 'cptch_envato_get_plugins' );
add_filter( 'pre_set_transient_update_plugins', 'cptch_envato_get_plugins' );
/* Inject plugin information For Envato */
add_filter( 'plugins_api', 'cptch_plugins_api', 10, 3 );
/* Add block for plugin settings page */
add_action( 'cptch_settings_page_action', 'cptch_settings_page_action', 10, 1 );
add_filter( 'cptch_before_save_options', 'cptch_before_save_options', 10, 1 );