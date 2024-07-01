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
class Bwp_Product_Categories extends Widget_Base {
	public function get_name() {
		return 'bwp_product_categories';
	}
	public function get_title() {
		return __( 'Wpbingo Product Categories', 'wpbingo' );
	}
	public function get_icon() {
		return 'eicon-product-categories';
	}	
	public function get_categories() {
		return [ 'wpbingo' ];
	}
	protected function register_controls() {
		$terms = get_terms( 'product_cat', array( 'hide_empty' => false ) );
		foreach( $terms as $cat ){
			$term[$cat->slug] = $cat -> name;
		}
		$number = array('1' => 1, '2' => 2, '3' => 3, '4' => 4, '5' => 5, '6' => 6, '7' => 7, '8' => 8, '9' => 9);
		$this->start_controls_section(
			'content_section',
			[
				'label' => __( 'Content', 'wpbingo' ),
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
			'subtitle',
			[
				'label' => __( 'Subtitle', 'wpbingo' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => '',
				'placeholder' => __( 'Type your Extra Subtitle here', 'wpbingo' ),
			]
		);		
		$this->add_control(
			'category',
			[
				'label' => __( 'Categories', 'wpbingo' ),
				'multiple' => true,
				'type' => \Elementor\Controls_Manager::SELECT2,
				'default' => array(),
				'options' => $term,
			]
		);
		$this->add_control(
			'item_row',
			[
				'label' => __( 'Number row per column', 'wpbingo' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => '',
				'options' => array('1' => 1, '2' => 2, '3' => 3, '4' => 4, '5' => 5, '6' => 6),
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
			'show_name',
			[
				'label' => __( 'Show Name Categories', 'wpbingo' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'1'  => __( 'Yes', 'wpbingo' ),
					'0' => __( 'No', 'wpbingo' ),
				],
				'default' => '0',
				'condition'   => [
                    'layout' => ["default","slider","slider2"],
                ]
			]
		);
		$this->add_control(
			'show_count',
			[
				'label' => __( 'Show Count Product Categories', 'wpbingo' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'1'  => __( 'Yes', 'wpbingo' ),
					'0' => __( 'No', 'wpbingo' ),
				],
				'default' => '0',
				'condition'   => [
                    'layout' => ["default","slider","slider2"],
                ]
			]
		);
		$this->add_control(
			'show_thumbnail',
			[
				'label' => __( 'Show Image Categories', 'wpbingo' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'1'  => __( 'Yes', 'wpbingo' ),
					'0' => __( 'No', 'wpbingo' ),
				],
				'default' => '0',
				'condition'   => [
                    'layout' => ["default","slider","slider2"],
                ]
			]
		);
		$this->add_control(
			'show_icon',
			[
				'label' => __( 'Show Icon Categories', 'wpbingo' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'1'  => __( 'Yes', 'wpbingo' ),
					'0' => __( 'No', 'wpbingo' ),
				],
				'default' => '0',
				'condition'   => [
                    'layout' => ["default","slider","slider2"],
                ]
			]
		);
		$this->add_control(
			'show_thumbnail1',
			[
				'label' => __( 'Show Thumbnail Categories', 'wpbingo' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'1'  => __( 'Yes', 'wpbingo' ),
					'0' => __( 'No', 'wpbingo' ),
				],
				'default' => '0',
				'condition'   => [
                    'layout' => ["default","slider","slider2"],
                ]
			]
		);
		$this->add_control(
			'limit_children',
			[
				'label' => __( 'Number of Child categories', 'wpbingo' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => '4',
				'condition'   => [
                    'layout' => ["category-children"],
                ]
			]
		);
		$this->add_responsive_control(
			'align',
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
					'{{WRAPPER}} .item-product-cat-content' => 'text-align: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'show_nav',
			[
				'label' => __( 'Show Navigation', 'wpbingo' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'1'  => __( 'Yes', 'wpbingo' ),
					'0' => __( 'No', 'wpbingo' ),
				],
				'default' => '0',
				'condition'   => [
                    'layout' => ["default","slider", "slider2"],
                ]				
			]
		);
		$this->add_control(
			'show_pag',
			[
				'label' => __( 'Show Pagination', 'wpbingo' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'1'  => __( 'Yes', 'wpbingo' ),
					'0' => __( 'No', 'wpbingo' ),
				],
				'default' => '0',
				'condition'   => [
                    'layout' => ["default","slider","slider2"],
                ]				
			]
		);
		$this->add_control(
			'layout',
			[
				'label' => __( 'Layout', 'wpbingo' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'slider',
				'options' => [
					'default' 			 	=> __( 'Default', 'wpbingo' ),
					'slider' 			 	=> __( 'Slider', 'wpbingo' ),
					'slider2' 			 	=> __( 'Slider 2', 'wpbingo' )
				],
			]
		);		
		$this->end_controls_section();
		
		$this->start_controls_section(
			'categories_title_style',
			[
				'label' => __( 'Title', 'wpbingo' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->start_controls_tabs( 'tabs_title_hover');
		$this->start_controls_tab(
			'tab_title_normal',
			[
				'label' => __( 'Normal', 'wpbingo' ),
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
					'{{WRAPPER}} .bwp-woo-categories .item-title a' => 'color: {{VALUE}};',
				],
				'separator' => 'after',
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'background',
				'label' => __( 'Background', 'wpbingo' ),
				'types' => [ 'classic', 'gradient' ],
				'exclude' => [ 'image' ],
				'selector' => '{{WRAPPER}} .bwp-woo-categories .item-title a',
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
			'tab_title_hover',
			[
				'label' => __( 'Hover', 'wpbingo' ),
			]
		);
		$this->add_control(
			'title_color_hover',
			[
				'label' => __( 'Title Color Hover', 'wpbingo' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'global' => [
					'default' => Global_Colors::COLOR_PRIMARY,
				],
				'selectors' => [
					'{{WRAPPER}} .bwp-woo-categories .item-title a:hover' => 'color: {{VALUE}};',
				],
				'separator' => 'after',
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'title_background_hover',
				'label' => __( 'Background', 'wpbingo' ),
				'types' => [ 'classic', 'gradient' ],
				'exclude' => [ 'image' ],
				'selector' => '{{WRAPPER}} .bwp-woo-categories .item-title a:hover, {{WRAPPER}} .bwp-woo-categories .item-title a:focus',
				'fields_options' => [
					'background' => [
						'default' => 'classic',
					],
				],
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'selector' => '{{WRAPPER}} .bwp-woo-categories .item-title',
				'global' => [
					'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
				],
			]
		);
		$this->add_control(
			'font_custom_title',
			[
				'label' => _x( 'Use custom fonts','wpbingo' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'On', 'elementor' ),
				'label_off' => esc_html__( 'Off', 'elementor' ),
				'default' => 'label_off',
			]
		);
		$this->add_control(
			'input_font_custom_title',
			[
				'label' => __( 'Enter your font name', 'wpbingo' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => '',
				'placeholder' => __( 'Enter your font name here', 'wpbingo' ),
				'selectors' => [
					'{{WRAPPER}} .bwp-woo-categories .item-title' => 'font-family: {{VALUE}};',
				],
				'condition'   => [
                    'font_custom_title!' => '',
                ]
			]
		);
		$this->add_responsive_control(
			'title_margin',
			[
				'label' => __( 'Margin', 'wpbingo' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .bwp-woo-categories .item-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'title_padding',
			[
				'label' => __( 'Padding', 'wpbingo' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .bwp-woo-categories .item-title a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'width_title',
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
					'{{WRAPPER}} .bwp-woo-categories .item-title a' => 'min-width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();
		
		$this->start_controls_section(
			'categories_count_style',
			[
				'label' => __( 'Count', 'wpbingo' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'count_color',
			[
				'label' => __( 'Color', 'wpbingo' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .bwp-woo-categories .item-count' => 'color: {{VALUE}};',
				],
				'global' => [
					'default' => Global_Colors::COLOR_TEXT,
				],
			]
		);		
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'count_typography',
				'selector' => '{{WRAPPER}} .bwp-woo-categories .item-count',
				'global' => [
					'default' => Global_Typography::TYPOGRAPHY_TEXT,
				],
			]
		);		
		$this->add_responsive_control(
			'count_bottom_space',
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
					'{{WRAPPER}} .bwp-woo-categories .item-count' => 'margin-bottom: {{SIZE}}{{UNIT}};',
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
			'width_image',
			[
				'label' => __( 'Max Width', 'wpbingo' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 200,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .bwp-woo-categories .item-product-cat-content > a >div' => 'max-width: {{SIZE}}{{UNIT}};margin:auto;',
				],
			]
		);
		$this->add_responsive_control(
			'height_image',
			[
				'label' => __( 'Min Height', 'wpbingo' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 200,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .bwp-woo-categories .item-product-cat-content > a >div img' => 'min-height: {{SIZE}}{{UNIT}};object-fit: cover;',
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
					'{{WRAPPER}} .bwp-woo-categories .item-product-cat-content > a >div' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',	
					'{{WRAPPER}} .bwp-woo-categories .item-product-cat-content > a >div img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',					
				],
			]
		);
		$this->add_responsive_control(
			'image_margin',
			[
				'label' => __( 'Margin', 'wpbingo' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .bwp-woo-categories .item-product-cat-content > a >div' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'horizontal_align',
			[
				'label' => __( 'Horizontal Align', 'wpbingo' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'start'  => __( 'Start', 'wpbingo' ),
					'center' => __( 'Center', 'wpbingo' ),
					'end' => __( 'End', 'wpbingo' ),
				],
				'default' => 'start',
				'selectors_dictionary' => [
					'start' => 'justify-content: flex-start',
					'center' => 'justify-content: center;',
					'end' => 'justify-content: flex-end;',
				],
				'selectors' => [
					'{{WRAPPER}} .bwp-woo-categories .product-cat-content-info' => '{{VALUE}};display:flex;',
				],
			]
		);
		$this->add_control(
			'postion_contents',
			[
				'label' => __( 'Postion Content', 'wpbingo' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'inside'  => __( 'Inside', 'wpbingo' ),
					'outside' => __( 'Outside', 'wpbingo' ),
				],
				'default' => 'outside',
				'separator' => 'before',
			]
		);
		$this->add_responsive_control(
			'postion_content',
			[
				'label' => __( 'Postion', 'wpbingo' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'top'  => __( 'Top', 'wpbingo' ),
					'middle' => __( 'Middle', 'wpbingo' ),
					'bottom' => __( 'Bottom', 'wpbingo' ),
				],
				'default' => 'top',
				'selectors_dictionary' => [
					'top' => 'top:0;transform: translateY(0);bottom:auto;',
					'middle' => 'top:50%;transform: translateY(-50%);bottom:auto;',
					'bottom' => 'bottom:0;transform: translateY(0);top:auto;',
				],
				'selectors' => [
					'{{WRAPPER}} .bwp-woo-categories .product-cat-content-info' => '{{VALUE}};position: absolute;width: 100%;left: 0;',
				],
				'condition'   => [
                    'postion_contents' => ["inside"],
                ]
			]
		);
		$this->add_responsive_control(
			'padding_content_categories',
			[
				'label' => __( 'Padding', 'wpbingo' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .bwp-woo-categories .product-cat-content-info' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition'   => [
                    'postion_contents' => ["inside"],
                ]
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
			'section_content_style',
			[
				'label' => __( 'Box Content', 'wpbingo' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'content_color',
			[
				'label' => __( 'Color', 'wpbingo' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .bwp-woo-categories .item-product-cat-content' => 'background: {{VALUE}};',
				],
				'global' => [
					'default' => Global_Colors::COLOR_TEXT,
				],
			]
		);
		$this->add_responsive_control(
			'align_dot',
			[
				'label' => __( 'Alignment Dot', 'wpbingo' ),
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
					]
				],
				'default' => 'center',
				'selectors' => [
					'{{WRAPPER}}  .bwp-woo-categories .slick-dots' => 'text-align: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'border',
				'selector' => '{{WRAPPER}} .bwp-woo-categories .item-product-cat-content',
				'separator' => 'before',
			]
		);
		$this->add_control(
			'border_radius_content',
			[
				'label' => __( 'Border Radius', 'wpbingo' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .bwp-woo-categories .item-product-cat-content' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'before',
			]
		);
		$this->add_responsive_control(
			'padding_content',
			[
				'label' => __( 'Padding', 'wpbingo' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .bwp-woo-categories .item-product-cat-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'before',
			]
		);
		$this->add_responsive_control(
			'margin_content',
			[
				'label' => __( 'Margin', 'wpbingo' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .bwp-woo-categories .item-product-cat-content' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'before',
			]
		);
		$this->add_control(
			'show_box_shadow',
			[
				'label' => _x( 'Show Box Shadow','wpbingo' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'no' => __( 'No','wpbingo' ),
					'yes' => __( 'Yes','wpbingo' ),
				],
				'default' => 'no',
			]
		);
		$this->add_control(
			'box_shadow',
			[
				'label' => _x( 'Box Shadow','wpbingo' ),
				'type' => \Elementor\Controls_Manager::BOX_SHADOW,
				'selectors' => [
					'{{WRAPPER}} .bwp-woo-categories .item-product-cat-content' => 'box-shadow: {{HORIZONTAL}}px {{VERTICAL}}px {{BLUR}}px {{SPREAD}}px {{COLOR}} {{box_shadow_position.VALUE}};',
				],
				'separator' => 'before',
				'condition'   => [
                    'show_box_shadow' => ["yes"],
                ]
			]
		);
		$this->add_control(
			'box_shadow_position',
			[
				'label' => _x( 'Position','wpbingo' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => [
					' ' => __( 'Outline','wpbingo' ),
					'inset' => __( 'Inset','wpbingo' ),
				],
				'default' => ' ',
				'render_type' => 'ui',
				'condition'   => [
                    'show_box_shadow' => ["yes"],
                ]
			]
		);
		$this->end_controls_section();
	}
	protected function render() {
		$settings = $this->get_settings_for_display();
		extract( shortcode_atts(
			array(
				'title1' => '',	
				'subtitle' => '',				
				'orderby' => '',
				'category' => '',
				'item_row' => 1,
				'numberposts' => 5,
				'columns' => 4,
				'columns1440' => 4,
				'columns1' => 4,
				'columns2' => 3,
				'columns3' => 2,
				'columns4' => 1,
				'show_name' => 1,
				'show_count' => 1,
				'show_thumbnail' => 1,
				'show_thumbnail1' => 1,
				'limit_children' => 4,
				'show_icon' => 0,
				'show_nav'	=> '0',
				'show_pag'	=> '0',
				'layout'  => 'default',
				'image_hover' => '',
			), $settings )
		);
		if( $layout == 'default'){
			include( WPBINGO_ELEMENTOR_TEMPLATE_PATH.'bwp-product-categories/default.php' );
		}elseif($layout == 'slider' || $layout == 'slider2'){
			include( WPBINGO_ELEMENTOR_TEMPLATE_PATH.'bwp-product-categories/slider.php' );
		}
	}
}
