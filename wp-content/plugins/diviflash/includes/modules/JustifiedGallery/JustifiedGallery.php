<?php

class DIFL_JustifiedGallery extends ET_Builder_Module {
	use DIFL\Handler\Fa_Icon_Handler;

    public $slug       = 'difl_justifiedgallery';
    public $vb_support = 'on';
	public $icon_path;
    use DF_UTLS;

    protected $module_credits = array(
		'module_uri' => '',
		'author'     => 'DiviFlash',
		'author_uri' => '',
    );

    public function init() {
        $this->name = esc_html__( 'Justified Gallery', 'divi_flash' );
        $this->main_css_element = "%%order_class%%";
        $this->icon_path        =  DIFL_ADMIN_DIR_PATH . 'dashboard/static/module-icons/justified-gallery.svg';
    }

    public function get_settings_modal_toggles(){
        return array(
            'general'   => array(
                'toggles'      => array(
                    'gallery' => esc_html__('Gallery', 'divi_flash'),
                    'settings' => esc_html__('Gallery Settings', 'divi_flash'),
                    'hover'     => esc_html__('Hover Settings', 'divi_flash')
                ),
            ),
            'advanced'   => array(
                'toggles'   => array(
                    'font_styles'    => array (
                        'title'             => esc_html__('Font Styles', 'divi_flash'),
                        'tabbed_subtoggles' => true,
                        'sub_toggles' => array(
                            'caption'   => array(
                                'name' => 'Caption',
                            ),
                            'description'     => array(
                                'name' => 'Description',
                            )
                        ),
                    ),
                    'image'                 => esc_html__('Image Filter', 'divi_flash'),
                    'more_btn'              => esc_html__('Load More Button', 'divi_flash'),
                    'df_borders'            => esc_html__('Borders', 'divi_flash'),
                    'pagination'            => esc_html__( 'Pagination Button Styles', 'divi_flash' ),
                    'active_pagination'     => esc_html__( 'Active Pagination Number', 'divi_flash' )
                )
            ),
        );
    }

    public function get_advanced_fields_config() {
        $advanced_fields = array();

        $advanced_fields['fonts'] = array(
            'caption'     => array(
                'label'         => esc_html__( 'Caption', 'divi_flash' ),
                'toggle_slug'   => 'font_styles',
                'sub_toggle'    => 'caption',
                'tab_slug'		=> 'advanced',
                'hide_text_shadow'  => true,
                'hide_text_align'  => true,
                'line_height' => array (
                    'default' => '1em',
                ),
                'font_size' => array(
                    'default' => '16px',
                ),
                'css'      => array(
                    'main' => "%%order_class%% .df_jsg_caption",
                    'hover' => "%%order_class%% .df_jsg_image:hover .df_jsg_caption",
                    'important'	=> 'all'
                ),
            ),
            'description'     => array(
                'label'         => esc_html__( 'Description', 'divi_flash' ),
                'toggle_slug'   => 'font_styles',
                'sub_toggle'    => 'description',
                'tab_slug'		=> 'advanced',
                'hide_text_shadow'  => true,
                'hide_text_align'  => true,
                'line_height' => array (
                    'default' => '1em',
                ),
                'font_size' => array(
                    'default' => '14px',
                ),
                'css'      => array(
                    'main' => "%%order_class%% .df_jsg_description",
                    'hover' => "%%order_class%% .df_jsg_image:hover .df_jsg_description",
                    'important'	=> 'all'
                ),
            ),
            'more_btn'     => array(
                'label'         => esc_html__( 'Button', 'divi_flash' ),
                'toggle_slug'   => 'more_btn',
                'tab_slug'		=> 'advanced',
                'hide_text_shadow'  => true,
                'line_height' => array (
                    'default' => '1em',
                ),
                'font_size' => array(
                    'default' => '14px',
                ),
                'css'      => array(
                    'main' => "%%order_class%% .jsg-more-image-btn",
                    'hover' => "%%order_class%% .jsg-more-image-btn:hover",
                    'important'	=> 'all'
                ),
            ),
            'pagination'        => array(
	            'label'       => et_builder_i18n( 'Pagination' ),
	            'css'         => array(
		            'main'  => "%%order_class%% .pagination .page-numbers",
		            'hover' => "%%order_class%% .pagination .page-numbers:hover"
	            ),
	            'line_height' => array(
		            'default' => floatval( et_get_option( 'body_font_height', '1.7' ) ) . 'em',
	            ),
	            'font_size'   => array(
		            'default' => '16px',
	            ),
	            'toggle_slug' => 'pagination'
            ),
            'active_pagination' => array(
	            'label'       => et_builder_i18n( 'Pagination' ),
	            'css'         => array(
		            'main'  => "%%order_class%% .df_jsg_container .pagination .page-numbers.current",
		            'hover' => "%%order_class%% .df_jsg_container .pagination .page-numbers.current:hover"
	            ),
	            'line_height' => array(
		            'default' => floatval( et_get_option( 'body_font_height', '1.7' ) ) . 'em',
	            ),
	            'font_size'   => array(
		            'default' => '16px',
	            ),
	            'toggle_slug' => 'active_pagination'
            )
        );
        $advanced_fields['borders'] = array(
            'default'               => false,
            'image'                 => array (
                'css'               => array(
                    'main' => array(
                        'border_radii' => '%%order_class%% .df_jsg_image',
                        'border_styles' => '%%order_class%% .df_jsg_image',
                        'border_styles_hover' => '%%order_class%% .df_jsg_image:hover',
                    )
                ),
                'tab_slug'          => 'advanced',
                'toggle_slug'       => 'df_borders',
                'label_prefix'      => 'Image'
            ),
            'more_btn'              => array (
                'css'               => array(
                    'main' => array(
                        'border_radii' => '%%order_class%% .df_jsg_button_container button',
                        'border_styles' => '%%order_class%% .df_jsg_button_container button',
                        'border_styles_hover' => '%%order_class%% .df_jsg_button_container button:hover',
                    )
                ),
                'tab_slug'          => 'advanced',
                'toggle_slug'       => 'more_btn',
                'label_prefix'      => 'Button'
            ),
            'pagination'        => array(
	            'css'         => array(
		            'main' => array(
			            'border_radii'        => '%%order_class%% .pagination .page-numbers:not(.dots)',
			            'border_radii_hover'  => '%%order_class%% .pagination .page-numbers:not(.dots):hover',
			            'border_styles'       => '%%order_class%% .pagination .page-numbers:not(.dots)',
			            'border_styles_hover' => '%%order_class%% .pagination .page-numbers:not(.dots):hover',
		            )
	            ),
	            'tab_slug'    => 'advanced',
	            'toggle_slug' => 'pagination'
            ),
            'active_pagination' => array(
	            'css'         => array(
		            'main' => array(
			            'border_radii'        => '%%order_class%% .df_jsg_container .pagination .page-numbers.current',
			            'border_radii_hover'  => '%%order_class%% .df_jsg_container .pagination .page-numbers.current:hover',
			            'border_styles'       => '%%order_class%% .df_jsg_container .pagination .page-numbers.current',
			            'border_styles_hover' => '%%order_class%% .df_jsg_container .pagination .page-numbers.current:hover',
		            )
	            ),
	            'tab_slug'    => 'advanced',
	            'toggle_slug' => 'active_pagination'
            )
        );
        $advanced_fields['box_shadow'] = array(
            'default'   => false,
            'load_more'     => array(
                'css' => array(
                    'main' => "%%order_class%% .jsg-more-image-btn",
                    'hover' => "%%order_class%% .jsg-more-image-btn:hover",
                ),
                'tab_slug'          => 'advanced',
                'toggle_slug'       => 'more_btn'
            ),
            'pagination'        => array(
	            'css'         => array(
		            'main'  => "%%order_class%% .pagination .page-numbers:not(.dots)",
		            'hover' => "%%order_class%% .pagination .page-numbers:not(.dots):hover",
	            ),
	            'tab_slug'    => 'advanced',
	            'toggle_slug' => 'pagination'
            ),
            'active_pagination' => array(
	            'css'         => array(
		            'main'  => "%%order_class%% .df_jsg_container .pagination .page-numbers.current",
		            'hover' => "%%order_class%% .df_jsg_container .pagination .page-numbers.current:hover",
	            ),
	            'tab_slug'    => 'advanced',
	            'toggle_slug' => 'active_pagination'
            )
        );
        $advanced_fields["filters"] = array(
			'child_filters_target' => array(
				'tab_slug' => 'advanced',
				'toggle_slug' => 'image',
				'css' => array(
					'main' => '%%order_class%% img'
				),
			),
        );
        $advanced_fields['image'] = array(
			'css' => array(
				'main' => array(
					'%%order_class%% img',
				)
			),
        );
        $advanced_fields['text'] = false;
	    $advanced_fields['margin_padding'] = array(
		    'css' => array(
			    'main' => array(
				    '%%order_class%% .df_jsg_container',
			    )
		    ),
	    );
    
        return $advanced_fields;
    }

    public function get_fields() {
        $gallery = array(
            'gallery' => array(
				'label'            => esc_html__( 'Gallery Images', 'divi_flash' ),
				'description'      => esc_html__( 'Choose images that you would like to appear in the image gallery.', 'divi_flash' ),
				'type'             => 'upload-gallery',
				'toggle_slug'      => 'gallery',
            )
        );
        $settings = array (
            'image_size'    => array(
                'label'    => esc_html__('Image Size', 'divi_flash'),
                'type'          => 'select',
                'options'       => array (
                    'medium'    => esc_html__('Medium', 'divi_flash'),
                    'large'     => esc_html__('Large', 'divi_flash'),
                    'original'  => esc_html__('Original', 'divi_flash')
                ),
                'default'       => 'medium',
                'toggle_slug'   => 'settings',
            ),
            'rowheight'    => array (
                'label'             => esc_html__( 'Row Max Height', 'divi_flash' ),
                'type'              => 'range',
                'toggle_slug'       => 'settings',
                'default'           => '150',
                'default_unit'      => '',
                'allowed_units'     => array (''),
                'range_settings'    => array(
                    'min'  => '1',
                    'max'  => '500',
                    'step' => '1',
                ),
                'validate_unit'     => false
            ),
            'space_between'    => array (
                'label'             => esc_html__( 'Space Between', 'divi_flash' ),
                'type'              => 'range',
                'toggle_slug'       => 'settings',
                'default'           => '10',
                'default_unit'      => '',
                'allowed_units'     => array (''),
                'description'       => esc_html__('Space between each image. To remove space between images set the value -1.', 'divi_flash'),
                'range_settings'    => array(
                    'min'  => '1',
                    'max'  => '50',
                    'step' => '1',
                ),
                'validate_unit'     => false
            ),
            'load_more'    => array(
                'label'         => esc_html__('Load More button', 'divi_flash'),
                'type'          => 'yes_no_button',
                'options'       => array (
                    'off' => esc_html__( 'Off', 'divi_flash' ),
					'on'  => esc_html__( 'On', 'divi_flash' ),
                ),
                'default'       => 'off',
                'toggle_slug'   => 'settings',
                'show_if_not'   => array(
	                'show_pagination' => 'on'
                )
            ),
            'ini_count'    => array(
                'label'         => esc_html__('Initial Image Load Count', 'divi_flash'),
                'type'          => 'text',
                'default'       => '8',
                'toggle_slug'   => 'settings',
                'show_if'       => array(
                    'load_more' => 'on'
                ),
                'show_if'   => array(
                    'load_more' => 'on'
                )
            ),
            'image_count'    => array(
                'label'         => esc_html__('Load More Image Count', 'divi_flash'),
                'type'          => 'text',
                'default'       => '4',
                'toggle_slug'   => 'settings',
                'show_if'       => array(
                    'load_more' => 'on'
                ),
                'show_if'   => array(
                    'load_more' => 'on'
                )
            ),
            'load_more_text'    => array(
                'label'         => esc_html__('Load More Button Text', 'divi_flash'),
                'type'          => 'text',
                'default'       => 'Load More',
                'toggle_slug'   => 'settings',
                'show_if'       => array(
                    'load_more' => 'on'
                ),
                'show_if_not'   => array(
                    'filter_nav' => 'on'
                )
            ),
	        /** Pagination **/
            'show_pagination'                      => array(
	            'label'       => esc_html__( 'Show Pagination', 'divi_flash' ),
	            'type'        => 'yes_no_button',
	            'options'     => array(
		            'off' => esc_html__( 'Off', 'divi_flash' ),
		            'on'  => esc_html__( 'On', 'divi_flash' ),
	            ),
	            'default'     => 'off',
	            'toggle_slug' => 'settings',
	            'show_if_not' => array(
		            'filter_nav'      => 'on',
		            'load_more' => 'on'
	            )
            ),
            'pagination_img_count' => array(
	            'label'       => esc_html__( 'Pagination Image Count', 'divi_flash' ),
	            'type'        => 'text',
	            'default'     => '8',
	            'toggle_slug' => 'settings',
	            'show_if'     => array(
		            'show_pagination' => 'on'
	            ),
	            'show_if_not' => array(
		            'load_more' => 'on'
	            )
            ),
            'use_number_pagination'                => array(
	            'label'       => esc_html__( 'Use Number Pagination', 'divi_flash' ),
	            'type'        => 'yes_no_button',
	            'options'     => array(
		            'off' => esc_html__( 'Off', 'divi_flash' ),
		            'on'  => esc_html__( 'On', 'divi_flash' ),
	            ),
	            'default'     => 'off',
	            'toggle_slug' => 'settings',
	            'tab_slug'    => 'general',
	            'show_if'     => array(
		            'show_pagination' => 'on'
	            )
            ),
            'use_icon_only_at_pagination'          => array(
	            'label'       => esc_html__( 'Use Icon Only in Next and Previous Button', 'divi_flash' ),
	            'type'        => 'yes_no_button',
	            'options'     => array(
		            'off' => esc_html__( 'Off', 'divi_flash' ),
		            'on'  => esc_html__( 'On', 'divi_flash' ),
	            ),
	            'default'     => 'off',
	            'toggle_slug' => 'settings',
	            'tab_slug'    => 'general',
	            'show_if'     => array(
		            'show_pagination' => 'on'
	            )
            ),
            'older_text'                           => array(
	            'label'       => esc_html__( 'Older Entries Button Text', 'divi_flash' ),
	            'type'        => 'text',
	            'toggle_slug' => 'settings',
	            'default'     => 'Older Entries',
	            'show_if'     => array(
		            'show_pagination'             => 'on',
		            'use_icon_only_at_pagination' => 'off'
	            )
            ),
            'newer_text'                           => array(
	            'label'       => esc_html__( 'Next Entries Button Text', 'divi_flash' ),
	            'type'        => 'text',
	            'toggle_slug' => 'settings',
	            'default'     => 'Next Entries',
	            'show_if'     => array(
		            'show_pagination'             => 'on',
		            'use_icon_only_at_pagination' => 'off'
	            )
            ),
	        /** Pagination **/
            'use_url'    => array(
                'label'         => esc_html__('Use Custom Link', 'divi_flash'),
                'type'          => 'yes_no_button',
                'options'       => array (
                    'off' => esc_html__( 'Off', 'divi_flash' ),
					'on'  => esc_html__( 'On', 'divi_flash' ),
                ),
                'default'       => 'off',
                'toggle_slug'   => 'settings',
            ),
            'url_target'    => array(
                'label'         => esc_html__('Link Target', 'divi_flash'),
                'type'          => 'select',
                'options'       => array (
                    'same_window'               => esc_html__('In The Same Window', 'divi_flash'),
                    'new_window'              => esc_html__('In The New Tab', 'divi_flash')
                ),
                'default'       => 'same_window',
                'toggle_slug'   => 'settings',
                'show_if'       => array(
                    'use_url'   => 'on'
                )
            ),
            'use_lightbox'    => array(
                'label'         => esc_html__('Use Lightbox', 'divi_flash'),
                'type'          => 'yes_no_button',
                'options'       => array (
                    'off' => esc_html__( 'Off', 'divi_flash' ),
					'on'  => esc_html__( 'On', 'divi_flash' ),
                ),
                'default'       => 'off',
                'toggle_slug'   => 'settings',
                'show_if_not'   => array(
                    'use_url' => 'on'
                )
            ),
            'use_lightbox_download'    => array(
                'label'         => esc_html__('Lightbox Download Button', 'divi_flash'),
                'type'          => 'yes_no_button',
                'options'       => array (
                    'off' => esc_html__( 'Off', 'divi_flash' ),
					'on'  => esc_html__( 'On', 'divi_flash' ),
                ),
                'default'       => 'off',
                'toggle_slug'   => 'settings',
                'show_if'       => array(
                    'use_lightbox' => 'on'
                )
            ),
            'show_content_lg'    => array(
                'label'         => esc_html__('Show Content on LightBox', 'divi_flash'),
                'description'   => esc_html__('Must be enabled caption and description.', 'divi_flash'),
                'type'          => 'yes_no_button',
                'options'       => array (
                    'off' => esc_html__( 'Off', 'divi_flash' ),
					'on'  => esc_html__( 'On', 'divi_flash' ),
                ),
                'default'       => 'off',
                'toggle_slug'   => 'settings',
                'show_if'       => array(
                    'use_lightbox' => 'on'
                ),
                'show_if_not'   => array(
                    'use_url' => 'on'
                )
            )
        );
        $hover = array(
            'overlay'    => array(
                'label'         => esc_html__('Overlay', 'divi_flash'),
                'type'          => 'yes_no_button',
                'options'       => array (
                    'off' => esc_html__( 'Off', 'divi_flash' ),
					'on'  => esc_html__( 'On', 'divi_flash' ),
                ),
                'default'       => 'off',
                'toggle_slug'   => 'hover',
            ),
            'overlay_primary'  => array(
                'label'             => esc_html__( 'Overlay Primary color', 'divi_flash' ),
                'type'              => 'color-alpha',
                'toggle_slug'       => 'hover',
                'default'           => '#00B4DB',
                'show_if'           => array(
                    'overlay'  => 'on'
                )
            ),
            'overlay_secondary'  => array(
                'label'             => esc_html__( 'Overlay Secondary color', 'divi_flash' ),
                'type'              => 'color-alpha',
                'toggle_slug'       => 'hover',
                'default'           => '#0083B0',
                'show_if'           => array(
                    'overlay'  => 'on'
                )
            ),
            'overlay_direction'    => array (
                'label'             => esc_html__( 'Overlay Gradient Direction', 'divi_flash' ),
                'type'              => 'range',
                'toggle_slug'       => 'hover',
                'default'           => '180deg',
                'default_unit'      => 'deg',
                'allowed_units'     => array ('deg'),
                'range_settings'    => array(
                    'min'  => '1',
                    'max'  => '360',
                    'step' => '1',
                ),
                'mobile_options'    => true,
                'show_if'           => array(
                    'overlay'  => 'on'
                )
            ),
            'overlay_spacing'    => array (
	            'label'             => esc_html__( 'Overlay Spacing', 'divi_flash' ),
	            'type'              => 'range',
	            'toggle_slug'       => 'hover',
	            'default'           => '0px',
	            'default_unit'      => 'px',
	            'allowed_units'     => array ('px'),
	            'range_settings'    => array(
		            'min'  => '0',
		            'max'  => '100',
		            'step' => '1',
	            ),
	            'mobile_options'    => true,
	            'show_if'           => array(
		            'overlay'  => 'on'
	            )
            ),
            'border_anim'    => array(
                'label'         => esc_html__('Border Animation', 'divi_flash'),
                'type'          => 'yes_no_button',
                'options'       => array (
                    'off' => esc_html__( 'Off', 'divi_flash' ),
					'on'  => esc_html__( 'On', 'divi_flash' ),
                ),
                'default'       => 'off',
                'toggle_slug'   => 'hover'
            ),
            'anm_border_color'  => array(
                'label'             => esc_html__( 'Border Color', 'divi_flash' ),
                'type'              => 'color-alpha',
                'toggle_slug'       => 'hover',
                'default'           => '#ffffff',
                'show_if'           => array(
                    'border_anim'  => 'on'
                )
            ),
            'anm_border_width'    => array (
                'label'             => esc_html__( 'Border Width', 'divi_flash' ),
                'type'              => 'range',
                'toggle_slug'       => 'hover',
                'default'           => '3px',
                'default_unit'      => '',
                'allowed_units'     => array ('px'),
                'range_settings'    => array(
                    'min'  => '1',
                    'max'  => '20',
                    'step' => '1',
                ),
                'mobile_options'    => true,
                'show_if'           => array(
                    'border_anim'  => 'on'
                )
            ),
            'anm_border_margin'    => array (
                'label'             => esc_html__( 'Border Space', 'divi_flash' ),
                'type'              => 'range',
                'toggle_slug'       => 'hover',
                'default'           => '15px',
                'default_unit'      => '',
                'allowed_units'     => array ('px'),
                'range_settings'    => array(
                    'min'  => '0',
                    'max'  => '50',
                    'step' => '1',
                ),
                'mobile_options'    => true,
                'show_if'           => array(
                    'border_anim'  => 'on'
                )
            ),
            'border_anm_style'    => array(
                'label'         => esc_html__('Border Animation Style', 'divi_flash'),
                'type'          => 'select',
                'options'       => array (
                    'c4-border-center'          => esc_html__('Border Center', 'divi_flash'),
                    'c4-border-top'             => esc_html__('Border Top', 'divi_flash'),
                    'c4-border-bottom'          => esc_html__('Border Bottom', 'divi_flash'),
                    'c4-border-right'           => esc_html__('Border Right', 'divi_flash'),
                    'c4-border-vert'            => esc_html__('Border Vertical', 'divi_flash'),
                    'c4-border-horiz'           => esc_html__('Border Horizontal', 'divi_flash'),
                    'c4-border-top-left'        => esc_html__('Border Top Left', 'divi_flash'),
                    'c4-border-top-right'       => esc_html__('Border Top Right', 'divi_flash'),
                    'c4-border-bottom-left'     => esc_html__('Border Bottom Left', 'divi_flash'),
                    'c4-border-bottom-right'    => esc_html__('Border Bottom Right', 'divi_flash'),
                    'c4-border-corners-1'       => esc_html__('Border Corner 1', 'divi_flash'),   
                    'c4-border-corners-2'       => esc_html__('Border Corner 2', 'divi_flash'),   
                    'c4-border-cc-1'            => esc_html__('Border CC 1', 'divi_flash'),   
                    'c4-border-cc-2'            => esc_html__('Border CC 2', 'divi_flash'),   
                    'c4-border-cc-3'            => esc_html__('Border CC 3', 'divi_flash'),   
                    'c4-border-ccc-1'           => esc_html__('Border CCC 1', 'divi_flash'),   
                    'c4-border-ccc-2'           => esc_html__('Border CCC 2', 'divi_flash'),   
                    'c4-border-ccc-3'           => esc_html__('Border CCC 3', 'divi_flash'),   
                    'c4-border-fade'            => esc_html__('Border Fade', 'divi_flash'),   
                ),
                'default'       => 'c4-border-fade',
                'toggle_slug'   => 'hover',
                'show_if'       => array(
                    'border_anim'   => 'on'
                )
            ),
            'anm_content_padding'    => array (
                'label'             => esc_html__( 'Content Space', 'divi_flash' ),
                'type'              => 'range',
                'toggle_slug'       => 'hover',
                'default'           => '1em',
                'default_unit'      => '',
                'allowed_units'     => array ('em'),
                'range_settings'    => array(
                    'min'  => '.5',
                    'max'  => '3',
                    'step' => '.1',
                ),
                'mobile_options'    => true
            ),
            'content_position'    => array(
                'label'         => esc_html__('Content Position', 'divi_flash'),
                'type'          => 'select',
                'options'       => array (
                    'c4-layout-top-left'        => esc_html__('Top Left', 'divi_flash'),
                    'c4-layout-top-center'      => esc_html__('Top Center', 'divi_flash'),
                    'c4-layout-top-right'       => esc_html__('Top Right', 'divi_flash'),
                    'c4-layout-center-left'     => esc_html__('Center Left', 'divi_flash'),
                    'c4-layout-center'          => esc_html__('Center', 'divi_flash'),
                    'c4-layout-center-right'    => esc_html__('Center Right', 'divi_flash'),
                    'c4-layout-bottom-left'     => esc_html__('Bottom Left', 'divi_flash'),
                    'c4-layout-bottom-center'   => esc_html__('Bottom Center', 'divi_flash'),
                    'c4-layout-bottom-right'    => esc_html__('Bottom Right', 'divi_flash')
                ),
                'default'       => 'c4-layout-top-left',
                'toggle_slug'   => 'hover'
            ),
            'image_scale'    => array(
                'label'    => esc_html__('Image Scale Type', 'divi_flash'),
                'type'          => 'select',
                'options'       => array (
                    'no-image-scale'            => esc_html__('None', 'divi_flash'),
                    'c4-image-zoom-in'          => esc_html__('Zoom In', 'divi_flash'),
                    'c4-image-zoom-out'         => esc_html__('Zoom Out', 'divi_flash'),
                    'c4-image-pan-up'           => esc_html__('Pan Up', 'divi_flash'),
                    'c4-image-pan-down'         => esc_html__('Pan Down', 'divi_flash'),
                    'c4-image-pan-left'         => esc_html__('Pan Left', 'divi_flash'),
                    'c4-image-pan-right'        => esc_html__('Pan Right', 'divi_flash'),
                    'c4-image-rotate-left'      => esc_html__('Rotate Left', 'divi_flash'),
                    'c4-image-rotate-right'     => esc_html__('Rotate Right', 'divi_flash'),
                    'c4-image-blur'             => esc_html__('Blur', 'divi_flash')
                ),
                'default'       => 'no-image-scale',
                'toggle_slug'   => 'hover'
            ),
            'image_scale_hover'    => array (
                'label'             => esc_html__( 'Scale', 'divi_flash' ),
                'type'              => 'range',
                'toggle_slug'       => 'hover',
                'default'           => '1.3',
                'allowed_units'     => array (),
                'range_settings'    => array(
                    'min'  => '1.3',
                    'max'  => '3',
                    'step' => '.1',
                ),
                'validate_unit'    => false,
                'show_if'          => array (
                    'image_scale' => array( 'c4-image-rotate-left', 'c4-image-rotate-right' )
                )
            ),
            'show_caption'    => array(
                'label'         => esc_html__('Show Caption', 'divi_flash'),
                'type'          => 'yes_no_button',
                'options'       => array (
                    'off' => esc_html__( 'Off', 'divi_flash' ),
					'on'  => esc_html__( 'On', 'divi_flash' ),
                ),
                'default'       => 'off',
                'toggle_slug'   => 'hover',
            ),
            'content_reveal_caption'    => array(
                'label'    => esc_html__('Caption Reveal', 'divi_flash'),
                'type'          => 'select',
                'options'       => array (
                    'c4-reveal-up'            => esc_html__('Reveal Top', 'divi_flash'),
                    'c4-reveal-down'          => esc_html__('Reveal Down', 'divi_flash'),
                    'c4-reveal-left'          => esc_html__('Reveal Left', 'divi_flash'),
                    'c4-reveal-right'         => esc_html__('Reveal Right', 'divi_flash'),
                    'c4-fade-up'              => esc_html__('Fade Up', 'divi_flash'),
                    'c4-fade-down'            => esc_html__('Fade Down', 'divi_flash'),
                    'c4-fade-left'            => esc_html__('Fade Left', 'divi_flash'),
                    'c4-fade-right'           => esc_html__('Fade Right', 'divi_flash'),
                    'c4-rotate-up-right'      => esc_html__('Rotate Up Right', 'divi_flash'),
                    'c4-rotate-up-left'       => esc_html__('Rotate Up Left', 'divi_flash'),
                    'c4-rotate-down-right'    => esc_html__('Rotate Down Right', 'divi_flash'),
                    'c4-rotate-down-left'     => esc_html__('Rotate Down Left', 'divi_flash')
                ),
                'default'       => 'c4-fade-up',
                'toggle_slug'   => 'hover',
                'show_if'       => array(
                    'show_caption' => 'on'
                )
            ),
            'show_description'    => array(
                'label'         => esc_html__('Show Description', 'divi_flash'),
                'type'          => 'yes_no_button',
                'options'       => array (
                    'off' => esc_html__( 'Off', 'divi_flash' ),
					'on'  => esc_html__( 'On', 'divi_flash' ),
                ),
                'default'       => 'off',
                'toggle_slug'   => 'hover',
            ),
            'content_reveal_description'    => array(
                'label'    => esc_html__('Description Reveal', 'divi_flash'),
                'type'          => 'select',
                'options'       => array (
                    'c4-reveal-up'            => esc_html__('Reveal Top', 'divi_flash'),
                    'c4-reveal-down'          => esc_html__('Reveal Down', 'divi_flash'),
                    'c4-reveal-left'          => esc_html__('Reveal Left', 'divi_flash'),
                    'c4-reveal-right'         => esc_html__('Reveal Right', 'divi_flash'),
                    'c4-fade-up'              => esc_html__('Fade Up', 'divi_flash'),
                    'c4-fade-down'            => esc_html__('Fade Down', 'divi_flash'),
                    'c4-fade-left'            => esc_html__('Fade Left', 'divi_flash'),
                    'c4-fade-right'           => esc_html__('Fade Right', 'divi_flash'),
                    'c4-rotate-up-right'      => esc_html__('Rotate Up Right', 'divi_flash'),
                    'c4-rotate-up-left'       => esc_html__('Rotate Up Left', 'divi_flash'),
                    'c4-rotate-down-right'    => esc_html__('Rotate Down Right', 'divi_flash'),
                    'c4-rotate-down-left'     => esc_html__('Rotate Down Left', 'divi_flash'),
                ),
                'default'       => 'c4-fade-up',
                'toggle_slug'   => 'hover',
                'show_if'       => array(
                    'show_description' => 'on'
                )
            )
        );
        $alignment = array(
            'more_btn_align' => array(
                'label'             => esc_html__( 'Alignment', 'divi_flash' ),
				'type'              => 'text_align',
				'options'           => et_builder_get_text_orientation_options(array('justified')),
				'tab_slug'          => 'advanced',
                'toggle_slug'       => 'more_btn'
            )
        );
        $button = array(
            'spinner_color' => array(
                'label'             => esc_html__( 'Loading Icon Color', 'divi_flash' ),
				'type'              => 'color-alpha',
				'tab_slug'          => 'advanced',
                'toggle_slug'       => 'more_btn',
                'default'           => '#2665e0'
            )
        );
        $tag = array(
            'caption_tag' => array (
                'default'         => 'h4',
                'label'           => esc_html__( 'Caption Tag', 'divi_flash' ),
                'type'            => 'select',
                'options'         => array(
                    'h1'    => esc_html__( 'h1 tag', 'divi_flash' ),
                    'h2'    => esc_html__( 'h2 tag', 'divi_flash' ),
                    'h3'    => esc_html__( 'h3 tag', 'divi_flash' ),
                    'h4'    => esc_html__( 'h4 tag', 'divi_flash' ),
                    'h5'    => esc_html__( 'h5 tag', 'divi_flash' ),
                    'h6'    => esc_html__( 'h6 tag', 'divi_flash'),
                    'p'     => esc_html__( 'p tag', 'divi_flash'),
                    'span'  => esc_html__( 'span tag', 'divi_flash')
                ),
                'toggle_slug'     => 'font_styles',
                'tab_slug'        => 'advanced',
                'sub_toggle'      => 'caption'
            ),
            'description_tag' => array (
                'default'         => 'p',
                'label'           => esc_html__( 'Description Tag', 'divi_flash' ),
                'type'            => 'select',
                'options'         => array(
                    'h1'    => esc_html__( 'h1 tag', 'divi_flash' ),
                    'h2'    => esc_html__( 'h2 tag', 'divi_flash' ),
                    'h3'    => esc_html__( 'h3 tag', 'divi_flash' ),
                    'h4'    => esc_html__( 'h4 tag', 'divi_flash' ),
                    'h5'    => esc_html__( 'h5 tag', 'divi_flash' ),
                    'h6'    => esc_html__( 'h6 tag', 'divi_flash'),
                    'p'     => esc_html__( 'p tag', 'divi_flash'),
                    'span'  => esc_html__( 'span tag', 'divi_flash')
                ),
                'toggle_slug'     => 'font_styles',
                'tab_slug'        => 'advanced',
                'sub_toggle'      => 'description'
            )
        );
        $more_btn_bg = $this->df_add_bg_field(array(
            'label'				=> 'Background',
            'key'               => 'more_btn_bg',
            'toggle_slug'       => 'more_btn',
            'tab_slug'			=> 'advanced',
            'hover'				=> 'tabs',
            'image'             => false
        ));
        $title = $this->add_margin_padding(array(
            'title'         => 'Caption',
            'key'           => 'title',
            'toggle_slug'   => 'margin_padding',
            'option'        => 'padding'
        ));
        $description = $this->add_margin_padding(array(
            'title'         => 'Description',
            'key'           => 'description',
            'toggle_slug'   => 'margin_padding',
            'option'        => 'padding'
        ));
        $load_more_button = $this->add_margin_padding(array(
            'title'         => 'Load More',
            'key'           => 'load_more',
            'toggle_slug'   => 'margin_padding'
        ));
        $use_load_more_icon = array(
            'more_btn_use_icon' => array(
				'label'                 => esc_html__( 'Use Icon', 'divi_flash' ),
				'type'                  => 'yes_no_button',
				'option_category'       => 'basic_option',
				'options'               => array(
					'off' => esc_html__( 'No', 'divi_flash' ),
					'on'  => esc_html__( 'Yes', 'divi_flash' ),
                ),
                'toggle_slug'           => 'more_btn',
                'tab_slug'              => 'advanced',
				'affects'               => array (
                    'more_btn_font_icon',
                    'more_btn_icon_size'
				)
            ),
            'more_btn_font_icon' => array(
                'label'                 => esc_html__( 'Icon', 'divi_flash' ),
                'type'                  => 'select_icon',
                'option_category'       => 'basic_option',
                'class'                 => array( 'et-pb-font-icon' ),
                'toggle_slug'           => 'more_btn',
                'tab_slug'              => 'advanced',
                'depends_show_if'       => 'on'
            ),
            'more_btn_icon_size' => array (
                'label'             => esc_html__( 'Icon Size', 'divi_flash' ),
				'type'              => 'range',
				'option_category'   => 'font_option',
				'toggle_slug'       => 'more_btn',
                'tab_slug'          => 'advanced',
				'default'           => '22px',
				'default_unit'      => 'px',
				'range_settings' => array(
					'min'  => '1',
					'max'  => '120',
					'step' => '1',
                ),
				'mobile_options'    => true,
				'depends_show_if'   => 'on',
				'responsive'        => true
            )           
        );
	    $pagination = array(
		    'pagination_align'   => array(
			    'label'             => esc_html__('Pagination Alignment', 'divi_flash'),
			    'type'              => 'select',
			    'options'           => array(
				    'center'          => esc_html__('Center', 'divi_flash'),
				    'flex-start'      => esc_html__('Left', 'divi_flash'),
				    'flex-end'        => esc_html__('Right', 'divi_flash'),
				    'space-between'   => esc_html__('Justified', 'divi_flash')
			    ),
			    'default'           => 'center',
			    'toggle_slug'       => 'pagination',
			    'tab_slug'          => 'advanced',
			    'responsive'        => true,
			    'mobile_options'    => true
		    ),
		    'next_prev_icon'   => array(
			    'label'             => esc_html__('Next & Prev Icon', 'divi_flash'),
			    'type'              => 'select',
			    'options'           => array(
				    'set_1'          => esc_html__('Set 1', 'divi_flash'),
				    'set_2'          => esc_html__('Set 2', 'divi_flash'),
				    'set_3'          => esc_html__('Set 3', 'divi_flash'),
				    'set_4'          => esc_html__('Set 4', 'divi_flash')
			    ),
			    'default'           => 'set_1',
			    'toggle_slug'       => 'pagination',
			    'tab_slug'          => 'advanced',
			    'responsive'        => true,
			    'mobile_options'    => true
		    )
	    );
	    $pagination_background = $this->df_add_bg_field(array (
		    'label'				    => 'Background',
		    'key'                   => 'pagination_background',
		    'toggle_slug'           => 'pagination',
		    'tab_slug'              => 'advanced'
	    ));
	    $active_pagination_background = $this->df_add_bg_field(array (
		    'label'				    => 'Background',
		    'key'                   => 'active_pagination_background',
		    'toggle_slug'           => 'active_pagination',
		    'tab_slug'              => 'advanced'
	    ));
	    $pagination_spacing = $this->add_margin_padding(array(
		    'title'         => 'Pagination Next & Previous Button',
		    'key'           => 'pagination',
		    'toggle_slug'   => 'margin_padding'
	    ));
	    $pagination_number_spacing = $this->add_margin_padding(array(
		    'title'         => 'Pagination Number',
		    'key'           => 'pagination_number',
		    'toggle_slug'   => 'margin_padding'
	    ));

        return array_merge(
            $gallery,
            $settings,
            $hover,
            $alignment,
            $button,
            $tag,
            $more_btn_bg,
            $title,
            $description,
            $load_more_button,
            $use_load_more_icon,
	        $pagination,
	        $pagination_background,
	        $active_pagination_background,
	        $pagination_spacing,
	        $pagination_number_spacing
        );
    }

    public function get_transition_fields_css_props() {
        $fields = parent::get_transition_fields_css_props();

        $fields = $this->df_background_transition(array (
            'fields'        => $fields,
            'key'           => 'more_btn_bg',
            'selector'      => '%%order_class%% .jsg-more-image-btn'
        ));

        $fields['title_padding'] = array ('padding' => '%%order_class%% .df_jsg_caption');
        $fields['description_padding'] = array ('padding' => '%%order_class%% .df_jsg_description');
        $fields['load_more_margin'] = array ('margin' => '%%order_class%% .jsg-more-image-btn');
        $fields['load_more_padding'] = array ('padding' => '%%order_class%% .jsg-more-image-btn');

        // border fix
        $fields = $this->df_fix_border_transition(
            $fields, 
            'image', 
            '%%order_class%% .df_jsg_image'
        );
        $fields = $this->df_fix_border_transition(
            $fields, 
            'more_btn', 
            '%%order_class%% .df_jsg_button_container button'
        );

	    /** Pagination **/
	    $pagination = '%%order_class%% .pagination .page-numbers';
	    $fields['pagination_margin'] = array ('margin' => $pagination);
	    $fields['pagination_padding'] = array ('padding' => $pagination);

	    $fields['pagination_number_margin'] = array ('margin' => $pagination);
	    $fields['pagination_number_margin'] = array ('padding' => $pagination);
	    $fields = $this->df_background_transition(array (
		    'fields'        => $fields,
		    'key'           => 'pagination_background',
		    'selector'      => $pagination
	    ));
	    $fields = $this->df_background_transition(array (
		    'fields'        => $fields,
		    'key'           => 'active_pagination_background',
		    'selector'      => '%%order_class%% .pagination .page-numbers.current'
	    ));
	    $fields = $this->df_fix_border_transition(
		    $fields,
		    'pagination',
		    $pagination
	    );
	    $fields = $this->df_fix_box_shadow_transition(
		    $fields,
		    'pagination',
		    $pagination
	    );
	    /** Pagination **/

        return $fields;
    }
    
    public function additional_css_styles($render_slug) {
        ET_Builder_Element::set_style($render_slug, array(
            'selector' => '%%order_class%% .c4-izmir',
            'declaration' => '--border-radius: 0px;'
        ));
        if($this->props['overlay'] !== 'on') {
            ET_Builder_Element::set_style($render_slug, array(
                'selector' => '%%order_class%% .c4-izmir',
                'declaration' => '--image-opacity: 1;'
            ));
        }
        if($this->props['overlay'] === 'on') {
            ET_Builder_Element::set_style($render_slug, array(
                'selector' => '%%order_class%% .c4-izmir .df-overlay',
                'declaration' => sprintf('background-image: linear-gradient(%4$s, %1$s 0, %2$s %3$s);',
                    $this->props['overlay_primary'],
                    $this->props['overlay_secondary'],
                    '100%',
                    $this->props['overlay_direction']
                )
            ));
	        $overlay_spacing = !empty($this->props['overlay_spacing']) ? $this->props['overlay_spacing'] : "0px";
	        ET_Builder_Element::set_style($render_slug, array(
		        'selector' => '%%order_class%% .c4-izmir .df-overlay',
		        'declaration' => sprintf('margin: %1$s;',
			        $overlay_spacing
		        )
	        ));
	        if ( ! empty( $this->props['overlay_spacing_tablet'] ) ) {
		        ET_Builder_Element::set_style( $render_slug, array(
			        'selector'    => "%%order_class%% .c4-izmir .df-overlay",
			        'declaration' => sprintf('margin: %1$s;',
				        $this->props['overlay_spacing_tablet']
			        ),
			        'media_query' => ET_Builder_Element::get_media_query( 'max_width_980' ),
		        ) );
	        }
	        if ( ! empty( $this->props['overlay_spacing_phone'] ) ) {
		        ET_Builder_Element::set_style( $render_slug, array(
			        'selector'    => "%%order_class%% .c4-izmir .df-overlay",
			        'declaration' => sprintf('margin: %1$s;',
				        $this->props['overlay_spacing_phone']
			        ),
			        'media_query' => ET_Builder_Element::get_media_query( 'max_width_767' ),
		        ) );
	        }
        }
        if (isset($this->props['more_btn_align'])) {
            ET_Builder_Element::set_style($render_slug, array(
                'selector' => '%%order_class%% .df_jsg_button_container',
                'declaration' => sprintf('text-align: %1$s;', $this->props['more_btn_align'])
            ));
        }
        if ($this->props['image_scale'] === 'c4-image-rotate-left') {
            ET_Builder_Element::set_style($render_slug, array(
                'selector' => '%%order_class%% .c4-image-rotate-left:hover img, %%order_class%% :focus.c4-image-rotate-left img',
                'declaration' => sprintf('transform: scale(%1$s) rotate(-15deg);', $this->props['image_scale_hover'])
            ));
        }
        if ($this->props['image_scale'] === 'c4-image-rotate-right') {
            ET_Builder_Element::set_style($render_slug, array(
                'selector' => '%%order_class%% .c4-image-rotate-right:hover img, %%order_class%% :focus.c4-image-rotate-right img',
                'declaration' => sprintf('transform: scale(%1$s) rotate(15deg);', $this->props['image_scale_hover'])
            ));
        }
        if($this->props['border_anim'] === 'on') {
            ET_Builder_Element::set_style($render_slug, array(
                'selector' => '%%order_class%% .c4-izmir',
                'declaration' => sprintf('
                    --border-color: %1$s;',
                    $this->props['anm_border_color']
                ),
            ));
            $this->df_process_range( array(
                'render_slug'       => $render_slug,
                'slug'              => 'anm_border_width',
                'type'              => '--border-width',
                'selector'          => '%%order_class%% .c4-izmir'
            ) );
            $this->df_process_range( array(
                'render_slug'       => $render_slug,
                'slug'              => 'anm_border_margin',
                'type'              => '--border-margin',
                'selector'          => '%%order_class%% .c4-izmir'
            ) );
        }
        $this->df_process_range( array(
            'render_slug'       => $render_slug,
            'slug'              => 'anm_content_padding',
            'type'              => '--padding',
            'selector'          => '%%order_class%% .c4-izmir'
        ) );

        // loading icon color
        $this->df_process_color(array(
            'render_slug'       => $render_slug,
            'slug'              => 'spinner_color',
            'type'              => 'fill',
            'selector'          => '%%order_class%% .jsg-more-image-btn .spinner svg'
        ));
        // loading font-size
        $this->df_process_range( array(
            'render_slug'       => $render_slug,
            'slug'              => 'more_btn_icon_size',
            'type'              => 'font-size',
            'selector'          => '%%order_class%% .df-jsg-load-more-icon'
        ) );

        // background: More Button
        $this->df_process_bg(array(
            'render_slug'       => $render_slug,
            'slug'              => 'more_btn_bg',
            'selector'          => '%%order_class%% .jsg-more-image-btn',
            'hover'             => '%%order_class%% .jsg-more-image-btn:hover'
        ));
        // spacing: title
        $this->set_margin_padding_styles(array(
            'render_slug'       => $render_slug,
            'slug'              => 'title_padding',
            'type'              => 'padding',
            'selector'          => '%%order_class%% .df_jsg_caption',
            'hover'             => '%%order_class%% .df_jsg_image:hover .df_jsg_caption',
        ));
        // spacing: description
        $this->set_margin_padding_styles(array(
            'render_slug'       => $render_slug,
            'slug'              => 'description_padding',
            'type'              => 'padding',
            'selector'          => '%%order_class%% .df_jsg_description',
            'hover'             => '%%order_class%% .df_jsg_image:hover .df_jsg_description',
        ));
        // spacing: load more
        $this->set_margin_padding_styles(array(
            'render_slug'       => $render_slug,
            'slug'              => 'load_more_margin',
            'type'              => 'margin',
            'selector'          => '%%order_class%% .jsg-more-image-btn',
            'hover'             => '%%order_class%% .jsg-more-image-btn:hover',
        ));
        $this->set_margin_padding_styles(array(
            'render_slug'       => $render_slug,
            'slug'              => 'load_more_padding',
            'type'              => 'padding',
            'selector'          => '%%order_class%% .jsg-more-image-btn',
            'hover'             => '%%order_class%% .jsg-more-image-btn:hover',
        ));
        // icon font family
        if(method_exists('ET_Builder_Module_Helper_Style_Processor', 'process_extended_icon')) {
            $this->generate_styles(
                array(
                    'utility_arg'    => 'icon_font_family',
                    'render_slug'    => $render_slug,
                    'base_attr_name' => 'more_btn_font_icon',
                    'important'      => true,
                    'selector'       => '%%order_class%% .df-jsg-load-more-icon',
                    'processor'      => array(
                        'ET_Builder_Module_Helper_Style_Processor',
                        'process_extended_icon',
                    ),
                )
            );
        }

	    /** Pagination **/
	    $this->set_margin_padding_styles(array(
		    'render_slug'       => $render_slug,
		    'slug'              => 'pagination_margin',
		    'type'              => 'margin',
		    'selector'          => '%%order_class%% .pagination .page-numbers.prev, %%order_class%% .pagination .page-numbers.next',
		    'hover'             => '%%order_class%% .pagination .page-numbers.prev:hover, %%order_class%% .pagination .page-numbers.next:hover',
	    ));
	    $this->set_margin_padding_styles(array(
		    'render_slug'       => $render_slug,
		    'slug'              => 'pagination_padding',
		    'type'              => 'padding',
		    'selector'          => '%%order_class%% .pagination .page-numbers.prev, %%order_class%% .pagination .page-numbers.next',
		    'hover'             => '%%order_class%% .pagination .page-numbers.prev:hover, %%order_class%% .pagination .page-numbers.next:hover',
	    ));
	    $this->set_margin_padding_styles(array(
		    'render_slug'       => $render_slug,
		    'slug'              => 'pagination_number_margin',
		    'type'              => 'margin',
		    'selector'          => '%%order_class%% .pagination .page-numbers:not(.prev):not(.next)',
		    'hover'             => '%%order_class%% .pagination .page-numbers:not(.prev):not(.next):hover',
	    ));
	    $this->set_margin_padding_styles(array(
		    'render_slug'       => $render_slug,
		    'slug'              => 'pagination_number_padding',
		    'type'              => 'padding',
		    'selector'          => '%%order_class%% .pagination .page-numbers:not(.prev):not(.next)',
		    'hover'             => '%%order_class%% .pagination .page-numbers:not(.prev):not(.next):hover',
	    ));
	    $this->df_process_bg(array (
		    'render_slug'       => $render_slug,
		    'slug'              => "pagination_background",
		    'selector'          => '%%order_class%% .pagination .page-numbers:not(.dots)',
		    'hover'             => '%%order_class%% .pagination .page-numbers:not(.dots):hover'
	    ));
	    $this->df_process_bg(array (
		    'render_slug'       => $render_slug,
		    'slug'              => "active_pagination_background",
		    'selector'          => '%%order_class%% .pagination .page-numbers.current',
		    'hover'             => '%%order_class%% .pagination .page-numbers.current:hover',
		    'important'         => true
	    ));
	    $this->df_process_string_attr(array(
		    'render_slug'       => $render_slug,
		    'slug'              => 'pagination_align',
		    'type'              => 'justify-content',
		    'selector'          => '%%order_class%% .pagination',
		    'important'         => false,
		    'default'           => 'center'
	    ));
	    // arrow icon
	    $next_prev_icon = $this->props['next_prev_icon'];
	    ET_Builder_Element::set_style($render_slug, array(
		    'selector' => '%%order_class%% .pagination .older::before, %%order_class%% .pagination .prev::before',
		    'declaration' => sprintf('content: "%1$s";', $this->ig_arrow_icon($next_prev_icon, 'prev')),
	    ));
	    ET_Builder_Element::set_style($render_slug, array(
		    'selector' => '%%order_class%% .pagination .newer::after, %%order_class%% .pagination .next::after',
		    'declaration' => sprintf('content: "%1$s";', $this->ig_arrow_icon($next_prev_icon, 'next')),
	    ));
	    /** Pagination **/
    }

    public function render( $attrs, $content, $render_slug ) {
		$this->handle_fa_icon();
        wp_enqueue_script('imageload');
        wp_enqueue_script('lightgallery-script');
        wp_enqueue_script('justified-gallery-script');
        wp_enqueue_script('df-jsgallery');
        $this->additional_css_styles($render_slug);

        $load_more = $this->props['load_more'];
        $more_btn_use_icon = $this->props['more_btn_use_icon'];
	    $show_pagination = $this->props['show_pagination'];

        $gallery_array = df_jsg_options($this->props);
        $images = df_jsg_render_gallery_markup($gallery_array);

        $load_more_icon = $more_btn_use_icon === 'on' ? sprintf('<span class="df-jsg-load-more-icon">%1$s</span>',
            $this->props['more_btn_font_icon'] !== '' ? esc_attr(et_pb_process_font_icon( $this->props['more_btn_font_icon'] )) : '4'
        ) : '';

        $load_more_icon_class = $more_btn_use_icon === 'on' ? ' has_icon' : '';

	    /** Pagination **/
	    $older = $this->props['older_text'] ? $this->props['older_text'] : 'Older Entries';
	    $next = $this->props['newer_text'] ? $this->props['newer_text'] : 'Next Entries';
	    if('on' === $this->props['use_icon_only_at_pagination']){
		    $older = '';
		    $next = '';
	    }
	    $pagination_data = '';
	    if('on' === $show_pagination && count(explode(',',$gallery_array['gallery'])) > (int)$this->props['pagination_img_count']){
		    ob_start();
		    ?>
		    <div class="df-jsg-pagination pagination clearfix <?php echo 'on' === $this->props['use_icon_only_at_pagination'] ? 'only_icon':''; ?>">
			    <a class="prev page-numbers" data-current="1" data-count="<?php echo esc_html($this->props['pagination_img_count']); ?>" href="#" style="display: none;"><?php echo esc_html($older); ?></a>
			    <?php
			    if('on' === $this->props['use_number_pagination']){
				    for ($i = 0; $i < ceil(count(explode(',',$gallery_array['gallery']))/(int)$this->props['pagination_img_count']); $i++){
					    ?>
					    <a class="page-numbers <?php echo 0 === $i ? 'current' : ''; ?>" data-page="<?php echo esc_html(($i+1)); ?>" data-count="<?php echo esc_html($this->props['pagination_img_count']); ?>" href="#"><?php echo esc_html(($i+1)); ?></a>
					    <?php
				    }
			    }
			    ?>
			    <a class="next page-numbers" data-current="1" data-count="<?php echo esc_html($this->props['pagination_img_count']); ?>" href="#"><?php echo esc_html($next); ?></a>
		    </div>
		    <?php
		    $pagination_data = ob_get_clean();
	    }
	    /** Pagination **/
        
        $data_settings = df_jsg_options($this->props);
     
        $load_more_button = ( $load_more === 'on' ) ?
            sprintf('<div class="df_jsg_button_container">
                    <button class="jsg-more-image-btn%4$s" data-loaded="%2$s">%1$s %3$s
                    <span class="spinner">
                        <svg width="135" height="140" viewBox="0 0 135 140" xmlns="http://www.w3.org/2000/svg" fill="#fff">
                            <rect y="10" width="15" height="120" rx="6">
                                <animate attributeName="height"
                                    begin="0.5s" dur="1s"
                                    values="120;110;100;90;80;70;60;50;40;140;120" calcMode="linear"
                                    repeatCount="indefinite" />
                                <animate attributeName="y"
                                    begin="0.5s" dur="1s"
                                    values="10;15;20;25;30;35;40;45;50;0;10" calcMode="linear"
                                    repeatCount="indefinite" />
                            </rect>
                            <rect x="30" y="10" width="15" height="120" rx="6">
                                <animate attributeName="height"
                                    begin="0.25s" dur="1s"
                                    values="120;110;100;90;80;70;60;50;40;140;120" calcMode="linear"
                                    repeatCount="indefinite" />
                                <animate attributeName="y"
                                    begin="0.25s" dur="1s"
                                    values="10;15;20;25;30;35;40;45;50;0;10" calcMode="linear"
                                    repeatCount="indefinite" />
                            </rect>
                            <rect x="60" width="15" height="140" rx="6">
                                <animate attributeName="height"
                                    begin="0s" dur="1s"
                                    values="120;110;100;90;80;70;60;50;40;140;120" calcMode="linear"
                                    repeatCount="indefinite" />
                                <animate attributeName="y"
                                    begin="0s" dur="1s"
                                    values="10;15;20;25;30;35;40;45;50;0;10" calcMode="linear"
                                    repeatCount="indefinite" />
                            </rect>
                            <rect x="90" y="10" width="15" height="120" rx="6">
                                <animate attributeName="height"
                                    begin="0.25s" dur="1s"
                                    values="120;110;100;90;80;70;60;50;40;140;120" calcMode="linear"
                                    repeatCount="indefinite" />
                                <animate attributeName="y"
                                    begin="0.25s" dur="1s"
                                    values="10;15;20;25;30;35;40;45;50;0;10" calcMode="linear"
                                    repeatCount="indefinite" />
                            </rect>
                            <rect x="120" y="10" width="15" height="120" rx="6">
                                <animate attributeName="height"
                                    begin="0.5s" dur="1s"
                                    values="120;110;100;90;80;70;60;50;40;140;120" calcMode="linear"
                                    repeatCount="indefinite" />
                                <animate attributeName="y"
                                    begin="0.5s" dur="1s"
                                    values="10;15;20;25;30;35;40;45;50;0;10" calcMode="linear"
                                    repeatCount="indefinite" />
                            </rect>
                        </svg>
                    </span></button>
                </div>', 
                et_core_sanitized_previously($this->props['load_more_text']),
                et_core_sanitized_previously($this->props['ini_count']),
                $load_more_icon,
                esc_attr($load_more_icon_class)
            ) : '';

        // filter for images
		if (array_key_exists('image', $this->advanced_fields) && array_key_exists('css', $this->advanced_fields['image'])) {
			$this->add_classname($this->generate_css_filters(
				$render_slug,
				'child_',
				self::$data_utils->array_get($this->advanced_fields['image']['css'], 'main', '%%order_class%%')
			));
		 }

        return sprintf('<div class="df_jsg_container%4$s" data-settings=\'%2$s\'>
                <div class="justified-gallery">%1$s</div>
                %3$s
                %5$s
            </div>', 
            $images, 
            wp_json_encode($data_settings),
            $load_more_button,
            $this->props['use_lightbox'] === 'on' ? ' ig_has_lightbox' : '',
	        $pagination_data
        );
    }
	public function ig_arrow_icon( $set = 'set_1', $type = 'next') {
		$icons = array(
			'set_1'  => array(
				'next' => '5',
				'prev' => '4'
			),
			'set_2' => array(
				'next' => '$',
				'prev' => '#'
			),
			'set_3' => array(
				'next' => '9',
				'prev' => '8'
			),
			'set_4' => array(
				'next' => 'E',
				'prev' => 'D'
			)
		);
		return $icons[$set][$type];
	}
}
new DIFL_JustifiedGallery;