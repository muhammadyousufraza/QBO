<?php

if ( defined( 'ABSPATH' ) === false ) {
	exit;
}

?>
<style>
    .recommended-plugins-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
    }

    a.hide-recommended-btn {
        background: #ffa500;
        color: #fff;
        text-decoration: none;
        padding: 10px 20px;
        font-size: 1rem;
        border-radius: 4px;
    }
</style>
<?php

wp_enqueue_script( 'wp-util' );

// You may comment this out IF you're sure the function exists.
require_once ABSPATH . 'wp-admin/includes/plugin-install.php';

remove_all_filters( 'plugins_api' );

$pluginsAllowedTags = array(
	'a'       => array(
		'href'   => array(),
		'title'  => array(),
		'target' => array(),
	),
	'abbr'    => array( 'title' => array() ),
	'acronym' => array( 'title' => array() ),
	'code'    => array(),
	'pre'     => array(),
	'em'      => array(),
	'strong'  => array(),
	'ul'      => array(),
	'ol'      => array(),
	'li'      => array(),
	'p'       => array(),
	'br'      => array(),
);

$recommendedPlugins = array();

/* Integrate Google Drive */
$args = [
	'slug'   => 'integrate-google-drive',
	'fields' => [
		'short_description' => true,
		'icons'             => true,
		'reviews'           => false, // excludes all reviews
	],
];

$data = plugins_api( 'plugin_information', $args );

if ( $data && ! is_wp_error( $data ) ) {
	$recommendedPlugins['integrate-google-drive']                    = $data;
	$recommendedPlugins['integrate-google-drive']->name              = 'Integrate Google Drive';
	$recommendedPlugins['integrate-google-drive']->short_description = 'Browse, Upload, Download, Embed, Play, Share, Gallery, and Manage Your Google Drive Files Into Your WordPress Site.';
}

/* Radio Player */
$args = [
	'slug'   => 'radio-player',
	'fields' => [
		'short_description' => true,
		'icons'             => true,
		'reviews'           => false, // excludes all reviews
	],
];

$data = plugins_api( 'plugin_information', $args );

if ( $data && ! is_wp_error( $data ) ) {
	$recommendedPlugins['radio-player']                    = $data;
	$recommendedPlugins['radio-player']->name              = 'Radio Player';
	$recommendedPlugins['radio-player']->short_description = 'Shoutcast, Icecast, and Audio Stream Player for WordPress with seamless integration and reliable streaming.';
}

/* Essential Addons for Contact Form 7 */
$args = [
	'slug'   => 'essential-addons-for-contact-form-7',
	'fields' => [
		'short_description' => true,
		'icons'             => true,
		'reviews'           => false, // excludes all reviews
	],
];

$data = plugins_api( 'plugin_information', $args );
if ( $data && ! is_wp_error( $data ) ) {
	$recommendedPlugins['essential-addons-for-contact-form-7']                    = $data;
	$recommendedPlugins['essential-addons-for-contact-form-7']->name              = 'Essential Addons for Contact Form 7';
	$recommendedPlugins['essential-addons-for-contact-form-7']->short_description = 'All-in-one enhancement suite for improving Contact Form 7 and WordPress.';
}


?>
<div class="wrap recommended-plugins">
    <h2 class="recommended-plugins-header">
		<?php _e( 'Try out our recommended plugins', 'dracula-dark-mode' ); ?>
        <a class="hide-recommended-btn" href="#" class=""><?php _e( 'Hide From Menu', 'dracula-dark-mode' ); ?></a>
    </h2>
</div>
<div class="wrap recommended-plugins">
    <div class="wp-list-table widefat plugin-install">
        <div class="the-list">
			<?php
			foreach ( (array) $recommendedPlugins as $plugin ) {
				if ( is_object( $plugin ) ) {
					$plugin = (array) $plugin;
				}

				// Display the group heading if there is one.
				if ( isset( $plugin['group'] ) && $plugin['group'] != $group ) {
					if ( isset( $this->groups[ $plugin['group'] ] ) ) {
						$group_name = $this->groups[ $plugin['group'] ];
						if ( isset( $plugins_group_titles[ $group_name ] ) ) {
							$group_name = $plugins_group_titles[ $group_name ];
						}
					} else {
						$group_name = $plugin['group'];
					}

					// Starting a new group, close off the divs of the last one.
					if ( ! empty( $group ) ) {
						echo '</div></div>';
					}

					echo '<div class="plugin-group"><h3>' . esc_html( $group_name ) . '</h3>';
					// Needs an extra wrapping div for nth-child selectors to work.
					echo '<div class="plugin-items">';

					$group = $plugin['group'];
				}
				$title = wp_kses( $plugin['name'], $pluginsAllowedTags );

				// Remove any HTML from the description.
				$description = strip_tags( $plugin['short_description'] );
				$version     = wp_kses( $plugin['version'], $pluginsAllowedTags );

				$name = strip_tags( $title . ' ' . $version );

				$author = wp_kses( $plugin['author'], $pluginsAllowedTags );
				if ( ! empty( $author ) ) {
					/* translators: %s: Plugin author. */
					$author = ' <cite>' . sprintf( __( 'By %s', 'dracula-dark-mode' ), $author ) . '</cite>';
				}

				$requires_php = isset( $plugin['requires_php'] ) ? $plugin['requires_php'] : null;
				$requires_wp  = isset( $plugin['requires'] ) ? $plugin['requires'] : null;

				$compatible_php = is_php_version_compatible( $requires_php );
				$compatible_wp  = is_wp_version_compatible( $requires_wp );
				$tested_wp      = ( empty( $plugin['tested'] ) || version_compare( get_bloginfo( 'version' ), $plugin['tested'], '<=' ) );

				$action_links = array();

				if ( current_user_can( 'install_plugins' ) || current_user_can( 'update_plugins' ) ) {
					$status = install_plugin_install_status( $plugin );

					switch ( $status['status'] ) {
						case 'install':
							if ( $status['url'] ) {
								if ( $compatible_php && $compatible_wp ) {
									$action_links[] = sprintf(
										'<a class="install-now button" data-slug="%s" href="%s" aria-label="%s" data-name="%s">%s</a>',
										esc_attr( $plugin['slug'] ),
										esc_url( $status['url'] ),
										/* translators: %s: Plugin name and version. */
										esc_attr( sprintf( _x( 'Install %s now', 'plugin', 'dracula-dark-mode' ), $name ) ),
										esc_attr( $name ),
										__( 'Install Now', 'dracula-dark-mode' )
									);
								} else {
									$action_links[] = sprintf(
										'<button type="button" class="button button-disabled" disabled="disabled">%s</button>',
										_x( 'Cannot Install', 'plugin', 'dracula-dark-mode' )
									);
								}
							}
							break;

						case 'update_available':
							if ( $status['url'] ) {
								if ( $compatible_php && $compatible_wp ) {
									$action_links[] = sprintf(
										'<a class="update-now button aria-button-if-js" data-plugin="%s" data-slug="%s" href="%s" aria-label="%s" data-name="%s">%s</a>',
										esc_attr( $status['file'] ),
										esc_attr( $plugin['slug'] ),
										esc_url( $status['url'] ),
										/* translators: %s: Plugin name and version. */
										esc_attr( sprintf( _x( 'Update %s now', 'plugin', 'dracula-dark-mode' ), $name ) ),
										esc_attr( $name ),
										__( 'Update Now', 'dracula-dark-mode' )
									);
								} else {
									$action_links[] = sprintf(
										'<button type="button" class="button button-disabled" disabled="disabled">%s</button>',
										_x( 'Cannot Update', 'plugin', 'dracula-dark-mode' )
									);
								}
							}
							break;

						case 'latest_installed':
						case 'newer_installed':
							if ( is_plugin_active( $status['file'] ) ) {
								$action_links[] = sprintf(
									'<button type="button" class="button button-disabled" disabled="disabled">%s</button>',
									_x( 'Active', 'plugin', 'dracula-dark-mode' )
								);
							} elseif ( current_user_can( 'activate_plugin', $status['file'] ) ) {
								$button_text = __( 'Activate', 'dracula-dark-mode' );
								/* translators: %s: Plugin name. */
								$button_label = _x( 'Activate %s', 'plugin', 'dracula-dark-mode' );
								$activate_url = add_query_arg(
									array(
										'_wpnonce' => wp_create_nonce( 'activate-plugin_' . $status['file'] ),
										'action'   => 'activate',
										'plugin'   => $status['file'],
									),
									network_admin_url( 'plugins.php' )
								);

								if ( is_network_admin() ) {
									$button_text = __( 'Network Activate', 'dracula-dark-mode' );
									/* translators: %s: Plugin name. */
									$button_label = _x( 'Network Activate %s', 'plugin', 'dracula-dark-mode' );
									$activate_url = add_query_arg( array( 'networkwide' => 1 ), $activate_url );
								}

								$action_links[] = sprintf(
									'<a href="%1$s" class="button activate-now" aria-label="%2$s">%3$s</a>',
									esc_url( $activate_url ),
									esc_attr( sprintf( $button_label, $plugin['name'] ) ),
									$button_text
								);
							} else {
								$action_links[] = sprintf(
									'<button type="button" class="button button-disabled" disabled="disabled">%s</button>',
									_x( 'Installed', 'plugin', 'dracula-dark-mode' )
								);
							}
							break;
					}
				}

				$details_link = self_admin_url(
					'plugin-install.php?tab=plugin-information&amp;plugin=' . $plugin['slug'] .
					'&amp;TB_iframe=true&amp;width=600&amp;height=550'
				);

				$action_links[] = sprintf(
					'<a href="%s" class="thickbox open-plugin-details-modal" aria-label="%s" data-title="%s">%s</a>',
					esc_url( $details_link ),
					/* translators: %s: Plugin name and version. */
					esc_attr( sprintf( __( 'More information about %s', 'dracula-dark-mode' ), $name ) ),
					esc_attr( $name ),
					__( 'More Details', 'dracula-dark-mode' )
				);

				if ( ! empty( $plugin['icons']['svg'] ) ) {
					$plugin_icon_url = $plugin['icons']['svg'];
				} elseif ( ! empty( $plugin['icons']['2x'] ) ) {
					$plugin_icon_url = $plugin['icons']['2x'];
				} elseif ( ! empty( $plugin['icons']['1x'] ) ) {
					$plugin_icon_url = $plugin['icons']['1x'];
				} else {
					$plugin_icon_url = $plugin['icons']['default'];
				}

				/**
				 * Filters the install action links for a plugin.
				 *
				 * @param string[] $action_links An array of plugin action links. Defaults are links to Details and Install Now.
				 * @param array $plugin The plugin currently being listed.
				 *
				 * @since 2.7.0
				 *
				 */
				$action_links = apply_filters( 'plugin_install_action_links', $action_links, $plugin );

				$last_updated_timestamp = strtotime( $plugin['last_updated'] );
				?>
                <div class="plugin-card plugin-card-<?php echo sanitize_html_class( $plugin['slug'] ); ?>">
					<?php
					if ( ! $compatible_php || ! $compatible_wp ) {
						echo '<div class="notice inline notice-error notice-alt"><p>';
						if ( ! $compatible_php && ! $compatible_wp ) {
							_e( 'This plugin doesn&#8217;t work with your versions of WordPress and PHP.', 'dracula-dark-mode' );
							if ( current_user_can( 'update_core' ) && current_user_can( 'update_php' ) ) {
								printf(
								/* translators: 1: URL to WordPress Updates screen, 2: URL to Update PHP page. */
									' ' . __( '<a href="%1$s">Please update WordPress</a>, and then <a href="%2$s">learn more about updating PHP</a>.', 'dracula-dark-mode' ),
									self_admin_url( 'update-core.php' ),
									esc_url( wp_get_update_php_url() )
								);
								wp_update_php_annotation( '</p><p><em>', '</em>' );
							} elseif ( current_user_can( 'update_core' ) ) {
								printf(
								/* translators: %s: URL to WordPress Updates screen. */
									' ' . __( '<a href="%s">Please update WordPress</a>.', 'dracula-dark-mode' ),
									self_admin_url( 'update-core.php' )
								);
							} elseif ( current_user_can( 'update_php' ) ) {
								printf(
								/* translators: %s: URL to Update PHP page. */
									' ' . __( '<a href="%s">Learn more about updating PHP</a>.', 'dracula-dark-mode' ),
									esc_url( wp_get_update_php_url() )
								);
								wp_update_php_annotation( '</p><p><em>', '</em>' );
							}
						} elseif ( ! $compatible_wp ) {
							_e( 'This plugin doesn&#8217;t work with your version of WordPress.', 'dracula-dark-mode' );
							if ( current_user_can( 'update_core' ) ) {
								printf(
								/* translators: %s: URL to WordPress Updates screen. */
									' ' . __( '<a href="%s">Please update WordPress</a>.', 'dracula-dark-mode' ),
									self_admin_url( 'update-core.php' )
								);
							}
						} elseif ( ! $compatible_php ) {
							_e( 'This plugin doesn&#8217;t work with your version of PHP.', 'dracula-dark-mode' );
							if ( current_user_can( 'update_php' ) ) {
								printf(
								/* translators: %s: URL to Update PHP page. */
									' ' . __( '<a href="%s">Learn more about updating PHP</a>.', 'dracula-dark-mode' ),
									esc_url( wp_get_update_php_url() )
								);
								wp_update_php_annotation( '</p><p><em>', '</em>' );
							}
						}
						echo '</p></div>';
					}
					?>
                    <div class="plugin-card-top">
                        <div class="name column-name">
                            <h3>
                                <a href="<?php echo esc_url( $details_link ); ?>"
                                   class="thickbox open-plugin-details-modal">
									<?php echo esc_attr( $title ); ?>
                                    <img src="<?php echo esc_attr( $plugin_icon_url ); ?>" class="plugin-icon" alt=""/>
                                </a>
                            </h3>
                        </div>
                        <div class="action-links">
							<?php
							if ( $action_links ) {
								echo '<ul class="plugin-action-buttons"><li>' . implode( '</li><li>', $action_links ) . '</li></ul>';
							}
							?>
                        </div>
                        <div class="desc column-description">
                            <p><?php echo esc_html( $description ); ?></p>
                            <p class="authors"><?php echo wp_kses( $author, $pluginsAllowedTags ); ?></p>
                        </div>
                    </div>
                    <div class="plugin-card-bottom">
                        <div class="vers column-rating">
							<?php
							wp_star_rating(
								array(
									'rating' => $plugin['rating'],
									'type'   => 'percent',
									'number' => $plugin['num_ratings'],
								)
							);
							?>
                            <span class="num-ratings"
                                  aria-hidden="true">(<?php echo number_format_i18n( $plugin['num_ratings'] ); ?>)</span>
                        </div>
                        <div class="column-updated">
                            <strong><?php _e( 'Last Updated:', 'dracula-dark-mode' ); ?></strong>
							<?php
							/* translators: %s: Human-readable time difference. */
							printf( __( '%s ago', 'dracula-dark-mode' ), human_time_diff( $last_updated_timestamp ) );
							?>
                        </div>
                        <div class="column-downloaded">
							<?php
							if ( $plugin['active_installs'] >= 1000000 ) {
								$active_installs_millions = floor( $plugin['active_installs'] / 1000000 );
								$active_installs_text     = sprintf(
								/* translators: %s: Number of millions. */
									_nx( '%s+ Million', '%s+ Million', $active_installs_millions, 'Active plugin installations', 'dracula-dark-mode' ),
									number_format_i18n( $active_installs_millions )
								);
							} elseif ( 0 == $plugin['active_installs'] ) {
								$active_installs_text = _x( 'Less Than 10', 'Active plugin installations', 'dracula-dark-mode' );
							} else {
								$active_installs_text = number_format_i18n( $plugin['active_installs'] ) . '+';
							}
							/* translators: %s: Number of installations. */
							printf( __( '%s Active Installations', 'dracula-dark-mode' ), $active_installs_text );
							?>
                        </div>
                        <div class="column-compatibility">
							<?php
							if ( ! $tested_wp ) {
								echo '<span class="compatibility-untested">' . __( 'Untested with your version of WordPress', 'dracula-dark-mode' ) . '</span>';
							} elseif ( ! $compatible_wp ) {
								echo '<span class="compatibility-incompatible">' . __( '<strong>Incompatible</strong> with your version of WordPress', 'dracula-dark-mode' ) . '</span>';
							} else {
								echo '<span class="compatibility-compatible">' . __( '<strong>Compatible</strong> with your version of WordPress', 'dracula-dark-mode' ) . '</span>';
							}
							?>
                        </div>
                    </div>
                </div>
				<?php
			} ?>
        </div>
    </div>
    <div id="hide-recommeded-plugins" style="display:none;"
         title="<?php _e( 'Are you sure?', 'dracula-dark-mode' ); ?>">
        <p><?php _e( "If you hide the recommended plugins page from your menu, it won't appear there again. Are you sure you'd like to do it?", 'dracula-dark-mode' ); ?></p>
    </div>

</div>

<script>
    (function ($) {
        "use strict";
        $(document).ready(function () {
            $('a.hide-recommended-btn').on('click', function (event) {
                event.preventDefault();

                Swal.fire({
                    title: wp.i18n.__('Are you sure?', "dracula-dark-mode"),
                    text: wp.i18n.__('If you hide the recommended plugins page from your menu, it won\'t appear there again. Are you sure you\'d like to do it?', "dracula-dark-mode"),
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: wp.i18n.__('Yes, hide it!', "dracula-dark-mode"),
                    cancelButtonText: wp.i18n.__('No, cancel!', "dracula-dark-mode"),
                    reverseButtons: true,
                    customClass: {
                        container: 'dracula-swal',
                    }
                }).then((result) => {
                    if (result.value) {
                        wp.ajax.send('dracula_hide_recommended_plugins', {
                            data: {
                                nonce: dracula.nonce
                            },
                            success: function () {
                                Swal.fire({
                                    title: wp.i18n.__('Done!', "dracula-dark-mode"),
                                    text: wp.i18n.__('The recommended plugins page has been hidden from your menu.', "dracula-dark-mode"),
                                    icon: 'success',
                                    showConfirmButton: false,
                                    timer: 2500
                                });

                                setTimeout(function () {
                                    window.location = '<?php echo admin_url() ?>/admin.php?page=dracula';
                                }, 2500);

                            },
                            error: function (error) {
                                console.log(error);
                            },
                        });
                    }
                });

            });
        });
    })(jQuery);
</script>

