<?php
namespace ElementorWpbingo\Widgets;
use Elementor\Widget_Base;
use Elementor\Core\Kits\Documents\Tabs\Global_Colors;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;
use Elementor\Group_Control_Typography;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;

if ( ! defined( 'ABSPATH' ) ) exit;
class Bwp_Slider extends Widget_Base {
	public function get_name() {
		return 'bwp_slider';
	}
	public function get_title() {
		return __( 'Wpbingo Slider', 'wpbingo' );
	}
	public function get_icon() {
		return 'eicon-slider-push';
	}	
	public function get_categories() {
		return [ 'wpbingo' ];
	}
	protected function register_controls() {
		$number = array('1' => 1, '2' => 2, '3' => 3, '4' => 4, '5' => 5, '6' => 6,'7' => 7);
        $this->start_controls_section('content_tab_settings',
            [
                'label' => esc_html__('Content Slider', 'wpbingo'),
            ]
        );
		$repeater = new \Elementor\Repeater();
		$repeater->add_control(
			'title_slider',
			[
				'label' => __( 'Title', 'wpbingo' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => '',
				'placeholder' => __( 'Type your title here', 'wpbingo' ),
			]
		);
		$repeater->add_control(
			'subtitle_slider',
			[
				'label' => __( 'Sub Title', 'wpbingo' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => '',
				'placeholder' => __( 'Type your sub title here', 'wpbingo' ),
			]
		);
		$repeater->add_control(
			'description_slider',
			[
				'label' => __( 'Description', 'wpbingo' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => '',
				'placeholder' => __( 'Type your sub description here', 'wpbingo' ),
			]
		);
		$repeater->add_control(
			'button_slider',
			[
				'label' => __( 'Button', 'wpbingo' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => '',
				'placeholder' => __( 'Type your sub button here', 'wpbingo' ),
			]
		);
		$repeater->add_control(
			'buttonlink_slider',
			[
				'label' => __( 'Button Url', 'wpbingo' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => '#',
				'placeholder' => __( 'Type your button url here', 'wpbingo' ),
			]
		);
		$repeater->add_control(
			'horizontal_align',
			[
				'label' => __( 'Horizontal Align', 'wpbingo' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'horizontal_start'  => __( 'Start', 'wpbingo' ),
					'horizontal_center' => __( 'Center', 'wpbingo' ),
					'horizontal_end' => __( 'End', 'wpbingo' ),
				],
				'default' => 'horizontal_start',
			]
		);
		$repeater->add_control(
			'vertical_align',
			[
				'label' => __( 'Vertical Align', 'wpbingo' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'vertical_top'  => __( 'Top', 'wpbingo' ),
					'vertical_middle' => __( 'Middle', 'wpbingo' ),
					'vertical_bottom' => __( 'Bottom', 'wpbingo' ),
				],
				'default' => 'vertical_top',
			]
		);
		$repeater->add_control(
			'text_align',
			[
				'label' => __( 'Alignment', 'wpbingo' ),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'align_left' => [
						'title' => __( 'Left', 'wpbingo' ),
						'icon' => 'eicon-text-align-left',
					],
					'align_center' => [
						'title' => __( 'Center', 'wpbingo' ),
						'icon' => 'eicon-text-align-center',
					],
					'align_right' => [
						'title' => __( 'Right', 'wpbingo' ),
						'icon' => 'eicon-text-align-right',
					],
					'align_justify' => [
						'title' => __( 'Justified', 'wpbingo' ),
						'icon' => 'eicon-text-align-justify',
					],
				],
				'default' => 'align_left',
			]
		);	
		$repeater->add_control(
			'image',
			[
				'label' => __( 'Choose Image', 'wpbingo' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
		);
        $this->add_control('list_tab',
            [
                'label'  => esc_html__('List Slider', 'wpbingo'),
                'type'   => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
            ]
        );
		$this->end_controls_section();
		
		$this->start_controls_section(
			'content_section',
			[
				'label' => __( 'Garenal', 'wpbingo' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'title1',
			[
				'label' => __( 'Title', 'wpbingo' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => '',
				'placeholder' => __( 'Type your title here', 'wpbingo' ),
			]
		);
		$this->add_control(
			'label_button',
			[
				'label' => __( 'Label Button', 'wpbingo' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => '',
				'placeholder' => __( 'Type your label button here', 'wpbingo' ),
			]
		);
		$this->add_control(
			'url_button',
			[
				'label' => __( 'Url Button', 'wpbingo' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => '#',
				'placeholder' => __( 'Type your url button here', 'wpbingo' ),
			]
		);
		$this->add_control(
			'item_row',
			[
				'label' => __( 'Number row per column', 'wpbingo' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => '',
				'options' => array('1' => 1, '2' => 2, '3' => 3, '4' => 4, '5' => 5),
				'default' => 1
			]
		);
		$this->add_control(
			'columns',
			[
				'label' => __( 'Number of Columns >1440px', 'wpbingo' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => '',
				'options' => $number,
				'default' => 1
			]
		);
		$this->add_control(
			'columns1440',
			[
				'label' => __( 'Number of Columns 1200px to 1440px', 'wpbingo' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => '',
				'options' => $number,
				'default' => 1
			]
		);
		$this->add_control(
			'columns1',
			[
				'label' => __( 'Number of Columns on 992px to 1199px', 'wpbingo' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => '',
				'options' => $number,
				'default' => 1
			]
		);
		$this->add_control(
			'columns2',
			[
				'label' => __( 'Number of Columns on 768px to 991px', 'wpbingo' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => '',
				'options' => $number,
				'default' => 1
			]
		);
		$this->add_control(
			'columns3',
			[
				'label' => __( 'Number of Columns on 480px to 767px', 'wpbingo' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => '',
				'options' => $number,
				'default' => 1
			]
		);
		$this->add_control(
			'columns4',
			[
				'label' => __( 'Number of Columns in 480px or less than', 'wpbingo' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => '',
				'options' => $number,
				'default' => 1
			]
		);
		$this->add_control(
			'show_nav',
			[
				'label' => __( 'Show Navigation', 'wpbingo' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'true'  => __( 'Yes', 'wpbingo' ),
					'false' => __( 'No', 'wpbingo' ),
				],
				'default' => 'false'
			]
		);
		$this->add_control(
			'show_pag',
			[
				'label' => __( 'Show Pagination', 'wpbingo' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'true'  => __( 'Yes', 'wpbingo' ),
					'false' => __( 'No', 'wpbingo' ),
				],
				'default' => 'false'
			]
		);
		$this->add_control(
			'layout',
			[
				'label' => __( 'Layout', 'wpbingo' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'default',
				'options' => [
					'default'  => __( 'Default', 'wpbingo' ),
					'category-slider'  => __( 'Category Slider', 'wpbingo' ),
					'banner-slider'  => __( 'Banner Slider', 'wpbingo' ),
					'banner-category'  => __( 'Banner Categories', 'wpbingo' ),
					'banner-category_slider'  => __( 'Banner Categories Slider', 'wpbingo' )
				],
			]
		);		
		$this->end_controls_section();
		
		$this->start_controls_section(
			'section_title_style',
			[
				'label' => __( 'Title', 'wpbingo' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'title_color',
			[
				'label' => __( 'Title Color', 'wpbingo' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'global' => [
					'default' => Global_Colors::COLOR_PRIMARY,
				],
				'selectors' => [
					'{{WRAPPER}} .bwp-slider .title-slider' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'title_bg_color',
			[
				'label' => __( 'Background', 'wpbingo' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'global' => [
					'default' => Global_Colors::COLOR_PRIMARY,
				],
				'selectors' => [
					'{{WRAPPER}} .bwp-slider .title-slider span' => 'background: {{VALUE}};padding:0 5px;',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'selector' => '{{WRAPPER}} .bwp-slider .title-slider',
				'global' => [
					'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
				],
			]
		);
		$this->add_responsive_control(
			'title_bottom_space',
			[
				'label' => __( 'Spacing', 'wpbingo' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .bwp-slider .title-slider' => 'margin-bottom: {{SIZE}}{{UNIT}};margin-top:0;',
				],
			]
		);
		$this->end_controls_section();
		
		$this->start_controls_section(
			'section_subtitle_style',
			[
				'label' => __( 'Subtitle', 'wpbingo' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'subtitle_color',
			[
				'label' => __( 'Color', 'wpbingo' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .bwp-slider .subtitle-slider' => 'color: {{VALUE}};',
				],
				'global' => [
					'default' => Global_Colors::COLOR_TEXT,
				],
			]
		);
		$this->add_control(
			'subtitle_bg_color',
			[
				'label' => __( 'Background', 'wpbingo' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .bwp-slider .subtitle-slider span' => 'background: {{VALUE}};padding:0 5px;',
				],
				'global' => [
					'default' => Global_Colors::COLOR_TEXT,
				],
			]
		);	
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'subtitle_typography',
				'selector' => '{{WRAPPER}} .bwp-slider .subtitle-slider',
				'global' => [
					'default' => Global_Typography::TYPOGRAPHY_TEXT,
				],
			]
		);		
		$this->add_responsive_control(
			'subtitle_bottom_space',
			[
				'label' => __( 'Spacing', 'wpbingo' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .bwp-slider .subtitle-slider' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();
		
		$this->start_controls_section(
			'section_description_style',
			[
				'label' => __( 'Description', 'wpbingo' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'description_color',
			[
				'label' => __( 'Color', 'wpbingo' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .bwp-slider .description-slider' => 'color: {{VALUE}};',
				],
				'global' => [
					'default' => Global_Colors::COLOR_TEXT,
				],
			]
		);
		$this->add_control(
			'description_bg_color',
			[
				'label' => __( 'Background', 'wpbingo' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .bwp-slider .description-slider span' => 'background: {{VALUE}};padding:0 5px;',
				],
				'global' => [
					'default' => Global_Colors::COLOR_TEXT,
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'description_typography',
				'selector' => '{{WRAPPER}} .bwp-slider .description-slider',
				'global' => [
					'default' => Global_Typography::TYPOGRAPHY_TEXT,
				],
			]
		);		
		$this->add_responsive_control(
			'description_bottom_space',
			[
				'label' => __( 'Spacing', 'wpbingo' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .bwp-slider .description-slider' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();
		
		$this->start_controls_section(
			'section_button_style',
			[
				'label' => __( 'Button', 'wpbingo' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'button_typography',
				'selector' => '{{WRAPPER}} .bwp-slider .button-slider',
				'global' => [
					'default' => Global_Typography::TYPOGRAPHY_TEXT,
				],
			]
		);
		$this->add_control(
			'font_custom_button',
			[
				'label' => _x( 'Use custom fonts','wpbingo' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'On', 'elementor' ),
				'label_off' => esc_html__( 'Off', 'elementor' ),
				'default' => '',
			]
		);
		$this->add_control(
			'input_font_custom_button',
			[
				'label' => __( 'Enter your font name', 'wpbingo' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => '',
				'placeholder' => __( 'Enter your font name here', 'wpbingo' ),
				'selectors' => [
					'{{WRAPPER}} .bwp-slider .button-slider span' => 'font-family: {{VALUE}};',
				],
				'condition'   => [
                    'font_custom_button!' => '',
                ]
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'border',
				'selector' => '{{WRAPPER}} .bwp-slider .button-slider',
				'separator' => 'before',
			]
		);
		$this->add_control(
			'border_radius',
			[
				'label' => __( 'Border Radius', 'wpbingo' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .bwp-slider .button-slider' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'button_padding',
			[
				'label' => __( 'Padding', 'wpbingo' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .bwp-slider .button-slider' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'before',
			]
		);
		$this->start_controls_tabs( 'tabs_button_style' );
		$this->start_controls_tab(
			'tab_button_normal',
			[
				'label' => __( 'Normal', 'wpbingo' ),
			]
		);

		$this->add_control(
			'button_text_color',
			[
				'label' => __( 'Text Color', 'wpbingo' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .bwp-slider .button-slider' => 'fill: {{VALUE}}; color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'background',
				'label' => __( 'Background', 'wpbingo' ),
				'types' => [ 'classic', 'gradient' ],
				'exclude' => [ 'image' ],
				'selector' => '{{WRAPPER}} .bwp-slider .button-slider',
				'fields_options' => [
					'background' => [
						'default' => 'classic',
					],
					'color' => [
						'global' => [
							'default' => Global_Colors::COLOR_ACCENT,
						],
					],
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_button_hover',
			[
				'label' => __( 'Hover', 'wpbingo' ),
			]
		);

		$this->add_control(
			'hover_color',
			[
				'label' => __( 'Text Color', 'wpbingo' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bwp-slider .button-slider:hover, {{WRAPPER}} .bwp-slider .button-slider:focus' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'button_background_hover',
				'label' => __( 'Background', 'wpbingo' ),
				'types' => [ 'classic', 'gradient' ],
				'exclude' => [ 'image' ],
				'selector' => '{{WRAPPER}} .bwp-slider .button-slider:hover, {{WRAPPER}} .bwp-slider .button-slider:focus',
				'fields_options' => [
					'background' => [
						'default' => 'classic',
					],
				],
			]
		);

		$this->add_control(
			'button_hover_border_color',
			[
				'label' => __( 'Border Color', 'wpbingo' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'condition' => [
					'border_border!' => '',
				],
				'selectors' => [
					'{{WRAPPER}} .bwp-slider .button-slider:hover, {{WRAPPER}} .bwp-slider .button-slider:focus' => 'border-color: {{VALUE}};',
				],
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->add_responsive_control(
			'width_button',
			[
				'label' => __( 'Min Width', 'wpbingo' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 200,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .bwp-slider .button-slider' => 'min-width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'section_slick_spacing_style',
			[
				'label' => __( 'Slick Spacing', 'wpbingo' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_responsive_control(
			'margin_slick',
			[
				'label' => __( 'Margin', 'wpbingo' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .bwp-slider .slick-list' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'padding_slick',
			[
				'label' => __( 'Padding', 'wpbingo' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .bwp-slider .slick-slide' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();

		
		$this->start_controls_section(
			'section_image_style',
			[
				'label' => __( 'Image', 'wpbingo' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_responsive_control(
			'margin_image',
			[
				'label' => __( 'Margin', 'wpbingo' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .bwp-slider .content-image' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'padding_content',
			[
				'label' => __( 'Padding', 'wpbingo' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .bwp-slider .item-info' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'border_image_radius',
			[
				'label' => __( 'Border Radius', 'wpbingo' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [	
					'{{WRAPPER}} .bwp-slider .content-image > a img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',					
				],
			]
		);
		$this->add_responsive_control(
			'min-height',
			[
				'label' => __( 'Min Height Image', 'wpbingo' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .bwp-slider .content-image img' => 'min-height: {{SIZE}}{{UNIT}};object-fit: cover;',
				],
			]
		);
		$this->add_control(
			'image_hover',
			[
				'label' => __( 'Hover Animation', 'wpbingo' ),
				'type' => Controls_Manager::HOVER_ANIMATION,
			]
		);
		$this->end_controls_section();
		
		$this->start_controls_section(
			'section_navigation_style',
			[
				'label' => __( 'Navigation', 'wpbingo' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'navigation_border',
				'selector' => '{{WRAPPER}} .bwp-slider .slick-arrow',
				'separator' => 'before',
			]
		);
		$this->add_control(
			'navigation_border_radius',
			[
				'label' => __( 'Border Radius', 'wpbingo' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .bwp-slider .slick-arrow' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->start_controls_tabs( 'tabs_navigation_style' );
		$this->start_controls_tab(
			'tab_navigation_normal',
			[
				'label' => __( 'Normal', 'wpbingo' ),
			]
		);

		$this->add_control(
			'navigation_text_color',
			[
				'label' => __( 'Text Color', 'wpbingo' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .bwp-slider .slick-arrow' => 'fill: {{VALUE}}; color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'navigation_background',
				'label' => __( 'Background', 'wpbingo' ),
				'types' => [ 'classic', 'gradient' ],
				'exclude' => [ 'image' ],
				'selector' => '{{WRAPPER}} .bwp-slider .slick-arrow',
				'fields_options' => [
					'background' => [
						'default' => 'classic',
					],
					'color' => [
						'global' => [
							'default' => Global_Colors::COLOR_ACCENT,
						],
					],
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_navigation_hover',
			[
				'label' => __( 'Hover', 'wpbingo' ),
			]
		);

		$this->add_control(
			'hover_navigation_color',
			[
				'label' => __( 'Text Color', 'wpbingo' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bwp-slider .slick-arrow:hover, {{WRAPPER}} .bwp-slider .slick-arrow:focus' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'navigation_background_hover',
				'label' => __( 'Background', 'wpbingo' ),
				'types' => [ 'classic', 'gradient' ],
				'exclude' => [ 'image' ],
				'selector' => '{{WRAPPER}} .bwp-slider .slick-arrow:hover, {{WRAPPER}} .bwp-slider .slick-arrow:focus',
				'fields_options' => [
					'background' => [
						'default' => 'classic',
					],
				],
			]
		);

		$this->add_control(
			'navigation_hover_border_color',
			[
				'label' => __( 'Border Color', 'wpbingo' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'condition' => [
					'border_border!' => '',
				],
				'selectors' => [
					'{{WRAPPER}} .bwp-slider .slick-arrow:hover, {{WRAPPER}} .bwp-slider .slick-arrow:focus' => 'border-color: {{VALUE}};',
				],
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();
		
		$this->start_controls_section(
			'section_pagination_style',
			[
				'label' => __( 'Pagination', 'wpbingo' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'pagination_border',
				'selector' => '{{WRAPPER}} .bwp-slider .slick-dots li button',
				'separator' => 'before',
			]
		);
		$this->add_control(
			'pagination_border_radius',
			[
				'label' => __( 'Border Radius', 'wpbingo' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .bwp-slider .slick-dots li button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->start_controls_tabs( 'tabs_pagination_style' );
		$this->start_controls_tab(
			'tab_pagination_normal',
			[
				'label' => __( 'Normal', 'wpbingo' ),
			]
		);

		$this->add_control(
			'pagination_text_color',
			[
				'label' => __( 'Text Color', 'wpbingo' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .bwp-slider .slick-dots li button' => 'fill: {{VALUE}}; color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'pagination_background',
				'label' => __( 'Background', 'wpbingo' ),
				'types' => [ 'classic', 'gradient' ],
				'exclude' => [ 'image' ],
				'selector' => '{{WRAPPER}} .bwp-slider .slick-dots li button',
				'fields_options' => [
					'background' => [
						'default' => 'classic',
					],
					'color' => [
						'global' => [
							'default' => Global_Colors::COLOR_ACCENT,
						],
					],
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_pagination_hover',
			[
				'label' => __( 'Hover', 'wpbingo' ),
			]
		);

		$this->add_control(
			'hover_pagination_color',
			[
				'label' => __( 'Text Color', 'wpbingo' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bwp-slider .slick-dots li button:hover, {{WRAPPER}} .bwp-slider .slick-dots li button:focus' => 'color: {{VALUE}};',
					'{{WRAPPER}} .bwp-slider .slick-dots li.slick-active button, {{WRAPPER}} .bwp-slider .slick-dots li.slick-active button:focus' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'pagination_background_hover',
				'label' => __( 'Background', 'wpbingo' ),
				'types' => [ 'classic', 'gradient' ],
				'exclude' => [ 'image' ],
				'selector' => '{{WRAPPER}} .bwp-slider .slick-dots li button:hover, {{WRAPPER}} .bwp-slider .slick-dots li button:focus,{{WRAPPER}} .bwp-slider .slick-dots li.slick-active button',
				'fields_options' => [
					'background' => [
						'default' => 'classic',
					],
				],
			]
		);

		$this->add_control(
			'pagination_hover_border_color',
			[
				'label' => __( 'Border Color', 'wpbingo' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'condition' => [
					'border_border!' => '',
				],
				'selectors' => [
					'{{WRAPPER}} .bwp-slider .slick-dots li button:hover, {{WRAPPER}} .bwp-slider .slick-dots li button:focus' => 'border-color: {{VALUE}};',
					'{{WRAPPER}} .bwp-slider .slick-dots li.slick-active button' => 'border-color: {{VALUE}};'
				],
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->add_responsive_control(
			'align_pagination',
			[
				'label' => __( 'Alignment', 'wpbingo' ),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => __( 'Left', 'wpbingo' ),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'wpbingo' ),
						'icon' => 'eicon-text-align-center',
					],
					'right' => [
						'title' => __( 'Right', 'wpbingo' ),
						'icon' => 'eicon-text-align-right',
					],
					'justify' => [
						'title' => __( 'Justified', 'wpbingo' ),
						'icon' => 'eicon-text-align-justify',
					],
				],
				'default' => '',
				'selectors' => [
					'{{WRAPPER}}   .bwp-slider .slick-dots' => 'text-align: {{VALUE}};',
				],
			]
		);
		$this->add_responsive_control(
			'padding_pagination',
			[
				'label' => __( 'Padding Pagination', 'wpbingo' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .bwp-slider .slick-dots' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();
	}
	protected function render() {
		$settings = $this->get_settings_for_display();
		$title1 = ( $settings['title1'] ) ? $settings['title1'] : '';
		$label_button 	= ( $settings['label_button'] ) ? $settings['label_button'] : '';
		$url_button 	= ( $settings['url_button'] ) ? $settings['url_button'] : '#';
		$item_row		= 	( $settings['item_row'] ) ? $settings['item_row'] : 1;
		$image_hover 	= ( $settings['image_hover'] ) ? $settings['image_hover'] : '';
		$columns		= 	( $settings['columns'] ) ? $settings['columns'] : 1;
		$columns1440	= 	( $settings['columns1440'] ) ? $settings['columns1440'] : 1;
		$columns1		= 	( $settings['columns1'] ) ? $settings['columns1'] : 1;
		$columns2		= 	( $settings['columns2'] ) ? $settings['columns2'] : 1;
		$columns3		= 	( $settings['columns3'] ) ? $settings['columns3'] : 1;
		$columns4		= 	( $settings['columns4'] ) ? $settings['columns4'] : 1;
		$show_nav		= 	( $settings['show_nav'] ) ? $settings['show_nav'] : 'false';
		$show_pag		= 	( $settings['show_pag'] ) ? $settings['show_pag'] : 'false';
		$layout			= 	( $settings['layout'] ) ? $settings['layout'] : 'default';
		if( $settings['layout'] == 'default' || $settings['layout'] == 'banner-category' ){
			include(WPBINGO_ELEMENTOR_TEMPLATE_PATH.'bwp-slider/default.php' );
		}elseif( $settings['layout'] == 'banner-slider' || $settings['layout'] == 'banner-category_slider'
		|| $settings['layout'] == 'category-slider' ){
			include(WPBINGO_ELEMENTOR_TEMPLATE_PATH.'bwp-slider/layout-1.php' );
		}
	}
}
