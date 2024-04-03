<?php
add_action('customize_register', 'mafoil_header_customizer');
function mafoil_header_customizer($wp_customize){
	///////////////COLOR
	$wp_customize->add_section( 'bwp-color' , array(
		'title'          => 'Wpbingo Color',
		'priority' => 1,
	));
	
	//---- gray dark
	$wp_customize->add_setting( 'gray_dark' , array(
		'default' => '',
		'sanitize_callback' => 'sanitize_color',
		'transport' => 'refresh',
	));
	$wp_customize->add_control('gray_dark', array(
		'label'   => esc_html__('Gray dark','mafoil'),
		'section' => 'bwp-color',
		'type'    => 'color',
	));
	
	//---- theme color
	$wp_customize->add_setting( 'theme_color' , array(
		'default' => '',
		'sanitize_callback' => 'sanitize_color',
		'transport' => 'refresh',
	));
	$wp_customize->add_control('theme_color', array(
		'label'   => esc_html__('Theme color','mafoil'),
		'section' => 'bwp-color',
		'type'    => 'color',
	));
	
	//---- text color
	$wp_customize->add_setting( 'text_color' , array(
		'default' => '',
		'sanitize_callback' => 'sanitize_color',
		'transport' => 'refresh',
	));
	$wp_customize->add_control('text_color', array(
		'label'   => esc_html__('Text color','mafoil'),
		'section' => 'bwp-color',
		'type'    => 'color',
	));
	
	//---- button color
	$wp_customize->add_setting( 'button_color' , array(
		'default' => '',
		'sanitize_callback' => 'sanitize_color',
		'transport' => 'refresh',
	));
	$wp_customize->add_control('button_color', array(
		'label'   => esc_html__('Button color','mafoil'),
		'section' => 'bwp-color',
		'type'    => 'color',
	));
	
	//---- border color
	$wp_customize->add_setting( 'border_color' , array(
		'default' => '',
		'sanitize_callback' => 'sanitize_color',
		'transport' => 'refresh',
	));
	$wp_customize->add_control('border_color', array(
		'label'   => esc_html__('Border color','mafoil'),
		'section' => 'bwp-color',
		'type'    => 'color',
	));
	
	///////////////TYPO
	$wp_customize->add_section( 'bwp-typo' , array(
		'title'          => 'Wpbingo typo',
		'priority' => 1,
	));
	$fonts = get_custom_google_fonts();
    $choices = array();
    foreach ( $fonts as $font ) {
        $choices[ $font['family'] ] = $font['family'];
    }
	array_unshift($choices, 'Default');
	//---- font base
	class Api_key extends WP_Customize_Control{
		public $type = 'api_key';
		public function render_content(){ ?>
			<div class="bwp-cus-title"><?php echo esc_html__('1.FONT BASE','mafoil') ?></div>
		<?php }
	}
	$wp_customize->add_setting( 'api_key' , array(
		'default' => '',
		'sanitize_callback' => 'sanitize_input',
		'transport' => 'refresh', 
	));
	$wp_customize->add_control(new Api_key($wp_customize,'api_key',array(
			'section' => 'bwp-typo',
			'settings' => [
				'api_key' => 'api_key',
			],
		)
	));
	
	$wp_customize->add_setting( 'font_size_body', array(
        'default' => '',
        'transport' => 'refresh',
		'sanitize_callback' => 'sanitize_input',
    ));
    $wp_customize->add_control( 'font_size_body', array(
        'type' => 'number',
        'section' => 'bwp-typo',
        'label' => 'Font size base',
    ));
	
    $wp_customize->add_setting( 'font_family_base', array(
        'default' => '',
		'sanitize_callback' => 'sanitize_input',
        'transport' => 'refresh',
    ));
    $wp_customize->add_control( 'font_family_base', array(
        'type' => 'select',
        'section' => 'bwp-typo',
        'label' => 'Select font base',
        'choices' => $choices,
    ));
	
	//---- font heading
	class Font_title2 extends WP_Customize_Control{
		public $type = 'font_title2';
		public function render_content(){ ?>
			<div class="bwp-cus-title" style="margin-top:40px;"><?php echo esc_html__('2.FONT HEADING','mafoil') ?></div>
		<?php }
	}
	$wp_customize->add_setting( 'font_title2' , array(
		'default' => '',
		'sanitize_callback' => 'sanitize_input',
		'transport' => 'refresh', 
	));
	$wp_customize->add_control(new Font_title2($wp_customize,'font_title2',array(
			'section' => 'bwp-typo',
			'settings' => [
				'font_title2' => 'font_title2',
			],
		)
	));
	
	$wp_customize->add_setting( 'font_size_heading', array(
        'default' => '',
        'transport' => 'refresh',
		'sanitize_callback' => 'sanitize_input',
    ));
    $wp_customize->add_control( 'font_size_heading', array(
        'type' => 'number',
        'section' => 'bwp-typo',
        'label' => 'Font size heading',
    ));
	
    $wp_customize->add_setting( 'font_family_heading', array(
        'default' => '',
		'sanitize_callback' => 'sanitize_input',
		'transport' => 'refresh',
    ));
    $wp_customize->add_control( 'font_family_heading', array(
        'type' => 'select',
        'section' => 'bwp-typo',
        'label' => 'Select font heading',
        'choices' => $choices,
    ));
	
	///////////////HEADER
	$wp_customize->add_panel( 'header_settings_section' , array(
		'title'          => 'Wpbingo Header',
		'priority' => 2,
	));
	///////////////HEADER 1
	$wp_customize->add_section('bwp-header_1', array(
		'title'          => 'Header 1',
		'panel' => 'header_settings_section',
	));
	
	//---- Top bar
	class Top_bar_1 extends WP_Customize_Control{
		public function enqueue(){
			wp_enqueue_style( 'custom_controls_css', get_template_directory_uri().'/customizer/css/custom_controls.css');
		}
		public $type = 'top_bar_1';
		public function render_content(){ ?>
			<div class="bwp-cus-title"><?php echo esc_html__('1.TOP BAR','mafoil') ?></div>
			<div class="filed-flex">
				<div class="cus-label"><?php echo esc_html__('Show topbar','mafoil') ?></div>
				<div class="switch-options">
					<input type="checkbox" value="<?php echo esc_attr($this->value('top_bar_1')); ?>" <?php $this->link('top_bar_1'); ?>>
					<label class="disable"></label>
				</div>
			</div>
		<?php }
	}
	
	$wp_customize->add_setting( 'top_bar_1' , array(
		'default' => '',
		'sanitize_callback' => 'sanitize_input',
		'transport' => 'refresh', 
	));
	$wp_customize->add_control(new Top_bar_1($wp_customize,'top_bar_1',array(
			'section' => 'bwp-header_1',
			'settings' => [
				'top_bar_1' => 'top_bar_1',
			],
		)
	));
	
	//---- background
	$wp_customize->add_setting( 'background_top_bar_1' , array(
		'default' => '',
		'sanitize_callback' => 'sanitize_color',
		'transport' => 'postMessage',
	));
	$wp_customize->add_control('background_top_bar_1', array(
		'label'   => esc_html__('Background','mafoil'),
		'section' => 'bwp-header_1',
		'type'    => 'color',
	));
	
	//---- color
	$wp_customize->add_setting( 'color_top_bar_1' , array(
		'default' => '',
		'sanitize_callback' => 'sanitize_color',
		'transport' => 'postMessage',
	));
	$wp_customize->add_control('color_top_bar_1', array(
		'label'   => esc_html__('Color','mafoil'),
		'section' => 'bwp-header_1',
		'type'    => 'color',
	));
	
	//---- color link
	$wp_customize->add_setting( 'color_link_top_bar_1' , array(
		'default' => '',
		'sanitize_callback' => 'sanitize_color',
		'transport' => 'postMessage',
	));
	$wp_customize->add_control('color_link_top_bar_1', array(
		'label'   => esc_html__('Color link','mafoil'),
		'section' => 'bwp-header_1',
		'type'    => 'color',
	));
	
	//---- color hover
	$wp_customize->add_setting( 'color_hover_top_bar_1' , array(
		'default' => '',
		'sanitize_callback' => 'sanitize_color',
		'transport' => 'refresh',
	));
	$wp_customize->add_control('color_hover_top_bar_1', array(
		'label'   => esc_html__('Color hover','mafoil'),
		'section' => 'bwp-header_1',
		'type'    => 'color',
	));
	
	//---- content left
	$wp_customize->add_setting( 'content_left_top_bar_1' , array(
		'default' => '',
		'sanitize_callback' => 'sanitize_input',
		'transport' => 'refresh',
	));
	$wp_customize->add_control('content_left_top_bar_1', array(
		'label'   => esc_html__('Content left','mafoil'),
		'section' => 'bwp-header_1',
		'type'    => 'textarea',
	));
	
	//---- content center
	$wp_customize->add_setting( 'content_center_top_bar_1' , array(
		'default' => '',
		'sanitize_callback' => 'sanitize_input',
		'transport' => 'refresh',
	));
	$wp_customize->add_control('content_center_top_bar_1', array(
		'label'   => esc_html__('Content center','mafoil'),
		'section' => 'bwp-header_1',
		'type'    => 'textarea',
	));
	
	//---- content right
	$wp_customize->add_setting( 'content_right_top_bar_1' , array(
		'default' => '',
		'sanitize_callback' => 'sanitize_input',
		'transport' => 'refresh',
	));
	$wp_customize->add_control('content_right_top_bar_1', array(
		'label'   => esc_html__('Content right','mafoil'),
		'section' => 'bwp-header_1',
		'type'    => 'textarea',
	));
	
	//---- social
	class social_1 extends WP_Customize_Control{
		public function enqueue(){
			wp_enqueue_style( 'custom_controls_css', get_template_directory_uri().'/customizer/css/custom_controls.css');
		}
		public $type = 'social_1';
		public function render_content(){ ?>
			<div class="filed-flex">
				<div class="cus-label"><?php echo esc_html__('Show social','mafoil') ?></div>
				<div class="switch-options">
					<input type="checkbox" value="<?php echo esc_attr($this->value('social_1')); ?>" <?php $this->link('social_1'); ?>>
					<label class="disable"></label>
				</div>
			</div>
		<?php }
	}
	
	$wp_customize->add_setting( 'social_1' , array(
		'default' => '',
		'sanitize_callback' => 'sanitize_input',
		'transport' => 'refresh', 
	));
	$wp_customize->add_control(new social_1($wp_customize,'social_1',array(
			'section' => 'bwp-header_1',
			'settings' => [
				'social_1' => 'social_1',
			],
		)
	));
	
	//---- padding
	class Padding_topbar_1 extends WP_Customize_Control{
		public $type = 'padding_topbar_1';
		public function render_content(){ ?>
			<span class="customize-control-title"><?php echo esc_attr($this->label); ?></span>
			<table class="tg">
				<thead>
					<tr>
						<th><?php echo esc_html__('Top','mafoil') ?></th>
						<th><?php echo esc_html__('Right','mafoil') ?></th>
						<th><?php echo esc_html__('Bottom','mafoil') ?></th>
						<th><?php echo esc_html__('Left','mafoil') ?></th>
						<th></th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td><input type="<?php echo esc_attr($this->type); ?>" value="<?php echo esc_attr($this->value('padding_topbar_top_1')); ?>" <?php $this->link('padding_topbar_top_1'); ?> /></td>
						<td><input type="<?php echo esc_attr($this->type); ?>" value="<?php echo esc_attr($this->value('padding_topbar_right_1')); ?>" <?php $this->link('padding_topbar_right_1'); ?> /></td>
						<td><input type="<?php echo esc_attr($this->type); ?>" value="<?php echo esc_attr($this->value('padding_topbar_bottom_1')); ?>" <?php $this->link('padding_topbar_bottom_1'); ?> /></td>
						<td><input type="<?php echo esc_attr($this->type); ?>" value="<?php echo esc_attr($this->value('padding_topbar_left_1')); ?>" <?php $this->link('padding_topbar_left_1'); ?> /></td>
						<td>px</td>
					</tr>
				</tbody>
			</table>
		<?php }
	}
	$wp_customize->add_setting('padding_topbar_top_1', array(
		'default' => '',
		'sanitize_callback' => 'sanitize_input',
		'transport' => 'postMessage',
	));
	$wp_customize->add_setting('padding_topbar_right_1', array(
		'default' => '',
		'sanitize_callback' => 'sanitize_input',
		'transport' => 'postMessage',
	));
	$wp_customize->add_setting('padding_topbar_bottom_1', array(
		'default' => '',
		'sanitize_callback' => 'sanitize_input',
		'transport' => 'postMessage',
	));
	$wp_customize->add_setting('padding_topbar_left_1', array(
		'default' => '',
		'sanitize_callback' => 'sanitize_input',
		'transport' => 'postMessage',
	));
	$wp_customize->add_control(new Padding_topbar_1(
		$wp_customize,'padding_topbar_1',
		array(
			'label' => esc_html__('Padding topbar','mafoil'),
			'section' => 'bwp-header_1',
			'settings' => [
				'padding_topbar_top_1' => 'padding_topbar_top_1',
				'padding_topbar_right_1' => 'padding_topbar_right_1',
				'padding_topbar_bottom_1' => 'padding_topbar_bottom_1',
				'padding_topbar_left_1' => 'padding_topbar_left_1'
			],
			'type' => 'number'
		)
	));
	
	//---- logo
	class Width_logo_1 extends WP_Customize_Control{
		public $type = 'range';
		public function render_content(){ ?>
			<div class="bwp-cus-title" style="margin-top:30px;"><?php echo esc_html__('2.HEADER MAIN','mafoil') ?></div>
			<span class="customize-control-title"><?php echo esc_attr($this->label); ?></span>
			<input type="range" value="<?php echo esc_attr($this->value()); ?>" name="points" min="0" max="500" <?php $this->link(); ?>>
		<?php }
	}
	$wp_customize->add_setting( 'width_logo_1' , array(
		'default' => '',
		'sanitize_callback' => 'sanitize_input',
		'transport' => 'postMessage', 
	));
	$wp_customize->add_control(new Width_logo_1($wp_customize,'width_logo_1',array(
			'label'   => esc_html__('Logo Size','mafoil'),
			'section' => 'bwp-header_1',
		)
	));
	
	//---- background
	$wp_customize->add_setting( 'header_color_1' , array(
		'default' => '',
		'sanitize_callback' => 'sanitize_color',
		'transport' => 'postMessage', 
	));
	$wp_customize->add_control('header_color_1', array(
		'label'   => esc_html__('Background','mafoil'),
		'section' => 'bwp-header_1',
		'type'    => 'color',
	));
	
	//---- text color
	$wp_customize->add_setting( 'content_color_1' , array(
		'default' => '',
		'sanitize_callback' => 'sanitize_color',
		'transport' => 'postMessage', 
	));
	$wp_customize->add_control('content_color_1', array(
		'label'   => esc_html__('Color content','mafoil'),
		'section' => 'bwp-header_1',
		'type'    => 'color',
	));
	
	//---- icon color
	$wp_customize->add_setting( 'icon_color_1' , array(
		'default' => '',
		'sanitize_callback' => 'sanitize_color',
		'transport' => 'postMessage', 
	));
	$wp_customize->add_control('icon_color_1', array(
		'label'   => esc_html__('Color group icon','mafoil'),
		'section' => 'bwp-header_1',
		'type'    => 'color',
	));
	
	//---- Menu color
	$wp_customize->add_setting( 'menu_color_1' , array(
		'default' => '',
		'sanitize_callback' => 'sanitize_color',
		'transport' => 'postMessage', 
	));
	$wp_customize->add_control('menu_color_1', array(
		'label'   => esc_html__('Color menu','mafoil'),
		'section' => 'bwp-header_1',
		'type'    => 'color',
	));
	
	//---- Hover color
	$wp_customize->add_setting( 'hover_color_1' , array(
		'default' => '',
		'sanitize_callback' => 'sanitize_color',
		'transport' => 'refresh', 
	));
	$wp_customize->add_control('hover_color_1', array(
		'label'   => esc_html__('Color hover','mafoil'),
		'section' => 'bwp-header_1',
		'type'    => 'color',
	));
	
	//---- Phone
	$wp_customize->add_setting( 'phone_1' , array(
		'default' => '+866.597.2742',
		'sanitize_callback' => 'sanitize_input',
		'transport' => 'refresh',
	));
	$wp_customize->add_control('phone_1', array(
		'label'   => esc_html__('Number phone','mafoil'),
		'section' => 'bwp-header_1',
		'type'    => 'textarea',
	));
	
	//---- padding
	class Padding_header_1 extends WP_Customize_Control{
		public $type = 'padding_1';
		public function render_content(){ ?>
			<span class="customize-control-title"><?php echo esc_attr($this->label); ?></span>
			<table class="tg">
				<thead>
					<tr>
						<th><?php echo esc_html__('Top','mafoil') ?></th>
						<th><?php echo esc_html__('Right','mafoil') ?></th>
						<th><?php echo esc_html__('Bottom','mafoil') ?></th>
						<th><?php echo esc_html__('Left','mafoil') ?></th>
						<th></th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td><input type="<?php echo esc_attr($this->type); ?>" value="<?php echo esc_attr($this->value('padding_top_1')); ?>" <?php $this->link('padding_top_1'); ?> /></td>
						<td><input type="<?php echo esc_attr($this->type); ?>" value="<?php echo esc_attr($this->value('padding_right_1')); ?>" <?php $this->link('padding_right_1'); ?> /></td>
						<td><input type="<?php echo esc_attr($this->type); ?>" value="<?php echo esc_attr($this->value('padding_bottom_1')); ?>" <?php $this->link('padding_bottom_1'); ?> /></td>
						<td><input type="<?php echo esc_attr($this->type); ?>" value="<?php echo esc_attr($this->value('padding_left_1')); ?>" <?php $this->link('padding_left_1'); ?> /></td>
						<td>px</td>
					</tr>
				</tbody>
			</table>
		<?php }
	}
	$wp_customize->add_setting('padding_top_1', array(
		'default' => '',
		'sanitize_callback' => 'sanitize_input',
		'transport' => 'postMessage',
	));
	$wp_customize->add_setting('padding_right_1', array(
		'default' => '',
		'sanitize_callback' => 'sanitize_input',
		'transport' => 'postMessage',
	));
	$wp_customize->add_setting('padding_bottom_1', array(
		'default' => '',
		'sanitize_callback' => 'sanitize_input',
		'transport' => 'postMessage',
	));
	$wp_customize->add_setting('padding_left_1', array(
		'default' => '',
		'sanitize_callback' => 'sanitize_input',
		'transport' => 'postMessage',
	));
	$wp_customize->add_control(new Padding_header_1(
		$wp_customize,'padding_1',
		array(
			'label' => esc_html__('Padding header','mafoil'),
			'section' => 'bwp-header_1',
			'settings' => [
				'padding_top_1' => 'padding_top_1',
				'padding_right_1' => 'padding_right_1',
				'padding_bottom_1' => 'padding_bottom_1',
				'padding_left_1' => 'padding_left_1'
			],
			'type' => 'number'
		)
	));
	
	
	///////////////HEADER 2
	$wp_customize->add_section('bwp-header_2', array(
		'title'          => 'Header 2',
		'panel' => 'header_settings_section',
	));
	
	//---- Top bar
	class Top_bar_2 extends WP_Customize_Control{
		public function enqueue(){
			wp_enqueue_style( 'custom_controls_css', get_template_directory_uri().'/customizer/css/custom_controls.css');
		}
		public $type = 'top_bar_2';
		public function render_content(){ ?>
			<div class="bwp-cus-title"><?php echo esc_html__('1.TOP BAR','mafoil') ?></div>
			<div class="filed-flex">
				<div class="cus-label"><?php echo esc_html__('Show topbar','mafoil') ?></div>
				<div class="switch-options">
					<input type="checkbox" value="<?php echo esc_attr($this->value('top_bar_2')); ?>" <?php $this->link('top_bar_2'); ?>>
					<label class="disable"></label>
				</div>
			</div>
		<?php }
	}
	
	$wp_customize->add_setting( 'top_bar_2' , array(
		'default' => '',
		'sanitize_callback' => 'sanitize_input',
		'transport' => 'refresh', 
	));
	$wp_customize->add_control(new Top_bar_2($wp_customize,'top_bar_2',array(
			'section' => 'bwp-header_2',
			'settings' => [
				'top_bar_2' => 'top_bar_2',
			],
		)
	));
	
	//---- background
	$wp_customize->add_setting( 'background_top_bar_2' , array(
		'default' => '',
		'sanitize_callback' => 'sanitize_color',
		'transport' => 'postMessage',
	));
	$wp_customize->add_control('background_top_bar_2', array(
		'label'   => esc_html__('Background','mafoil'),
		'section' => 'bwp-header_2',
		'type'    => 'color',
	));
	
	//---- color
	$wp_customize->add_setting( 'color_top_bar_2' , array(
		'default' => '',
		'sanitize_callback' => 'sanitize_color',
		'transport' => 'postMessage',
	));
	$wp_customize->add_control('color_top_bar_2', array(
		'label'   => esc_html__('Color','mafoil'),
		'section' => 'bwp-header_2',
		'type'    => 'color',
	));
	
	//---- color link
	$wp_customize->add_setting( 'color_link_top_bar_2' , array(
		'default' => '',
		'sanitize_callback' => 'sanitize_color',
		'transport' => 'postMessage',
	));
	$wp_customize->add_control('color_link_top_bar_2', array(
		'label'   => esc_html__('Color link','mafoil'),
		'section' => 'bwp-header_2',
		'type'    => 'color',
	));
	
	//---- color hover
	$wp_customize->add_setting( 'color_hover_top_bar_2' , array(
		'default' => '',
		'sanitize_callback' => 'sanitize_color',
		'transport' => 'refresh',
	));
	$wp_customize->add_control('color_hover_top_bar_2', array(
		'label'   => esc_html__('Color hover','mafoil'),
		'section' => 'bwp-header_2',
		'type'    => 'color',
	));
	
	//---- content left
	$wp_customize->add_setting( 'content_left_top_bar_2' , array(
		'default' => '',
		'sanitize_callback' => 'sanitize_input',
		'transport' => 'refresh',
	));
	$wp_customize->add_control('content_left_top_bar_2', array(
		'label'   => esc_html__('Content left','mafoil'),
		'section' => 'bwp-header_2',
		'type'    => 'textarea',
	));
	
	//---- content center
	$wp_customize->add_setting( 'content_center_top_bar_2' , array(
		'default' => '',
		'sanitize_callback' => 'sanitize_input',
		'transport' => 'refresh',
	));
	$wp_customize->add_control('content_center_top_bar_2', array(
		'label'   => esc_html__('Content center','mafoil'),
		'section' => 'bwp-header_2',
		'type'    => 'textarea',
	));
	
	//---- content right
	$wp_customize->add_setting( 'content_right_top_bar_2' , array(
		'default' => '',
		'sanitize_callback' => 'sanitize_input',
		'transport' => 'refresh',
	));
	$wp_customize->add_control('content_right_top_bar_2', array(
		'label'   => esc_html__('Content right','mafoil'),
		'section' => 'bwp-header_2',
		'type'    => 'textarea',
	));
	
	//---- social
	class social_2 extends WP_Customize_Control{
		public function enqueue(){
			wp_enqueue_style( 'custom_controls_css', get_template_directory_uri().'/customizer/css/custom_controls.css');
		}
		public $type = 'social_2';
		public function render_content(){ ?>
			<div class="filed-flex">
				<div class="cus-label"><?php echo esc_html__('Show social','mafoil') ?></div>
				<div class="switch-options">
					<input type="checkbox" value="<?php echo esc_attr($this->value('social_2')); ?>" <?php $this->link('social_2'); ?>>
					<label class="disable"></label>
				</div>
			</div>
		<?php }
	}
	
	$wp_customize->add_setting( 'social_2' , array(
		'default' => '',
		'sanitize_callback' => 'sanitize_input',
		'transport' => 'refresh', 
	));
	$wp_customize->add_control(new social_2($wp_customize,'social_2',array(
			'section' => 'bwp-header_2',
			'settings' => [
				'social_2' => 'social_2',
			],
		)
	));
	
	//---- padding
	class Padding_topbar_2 extends WP_Customize_Control{
		public $type = 'padding_topbar_2';
		public function render_content(){ ?>
			<span class="customize-control-title"><?php echo esc_attr($this->label); ?></span>
			<table class="tg">
				<thead>
					<tr>
						<th><?php echo esc_html__('Top','mafoil') ?></th>
						<th><?php echo esc_html__('Right','mafoil') ?></th>
						<th><?php echo esc_html__('Bottom','mafoil') ?></th>
						<th><?php echo esc_html__('Left','mafoil') ?></th>
						<th></th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td><input type="<?php echo esc_attr($this->type); ?>" value="<?php echo esc_attr($this->value('padding_topbar_top_2')); ?>" <?php $this->link('padding_topbar_top_2'); ?> /></td>
						<td><input type="<?php echo esc_attr($this->type); ?>" value="<?php echo esc_attr($this->value('padding_topbar_right_2')); ?>" <?php $this->link('padding_topbar_right_2'); ?> /></td>
						<td><input type="<?php echo esc_attr($this->type); ?>" value="<?php echo esc_attr($this->value('padding_topbar_bottom_2')); ?>" <?php $this->link('padding_topbar_bottom_2'); ?> /></td>
						<td><input type="<?php echo esc_attr($this->type); ?>" value="<?php echo esc_attr($this->value('padding_topbar_left_2')); ?>" <?php $this->link('padding_topbar_left_2'); ?> /></td>
						<td>px</td>
					</tr>
				</tbody>
			</table>
		<?php }
	}
	$wp_customize->add_setting('padding_topbar_top_2', array(
		'default' => '',
		'sanitize_callback' => 'sanitize_input',
		'transport' => 'postMessage',
	));
	$wp_customize->add_setting('padding_topbar_right_2', array(
		'default' => '',
		'sanitize_callback' => 'sanitize_input',
		'transport' => 'postMessage',
	));
	$wp_customize->add_setting('padding_topbar_bottom_2', array(
		'default' => '',
		'sanitize_callback' => 'sanitize_input',
		'transport' => 'postMessage',
	));
	$wp_customize->add_setting('padding_topbar_left_2', array(
		'default' => '',
		'sanitize_callback' => 'sanitize_input',
		'transport' => 'postMessage',
	));
	$wp_customize->add_control(new Padding_topbar_2(
		$wp_customize,'padding_topbar_2',
		array(
			'label' => esc_html__('Padding topbar','mafoil'),
			'section' => 'bwp-header_2',
			'settings' => [
				'padding_topbar_top_2' => 'padding_topbar_top_2',
				'padding_topbar_right_2' => 'padding_topbar_right_2',
				'padding_topbar_bottom_2' => 'padding_topbar_bottom_2',
				'padding_topbar_left_2' => 'padding_topbar_left_2'
			],
			'type' => 'number'
		)
	));
	
	//---- logo
	class Width_logo_2 extends WP_Customize_Control{
		public $type = 'range';
		public function render_content(){ ?>
			<div class="bwp-cus-title" style="margin-top:30px;"><?php echo esc_html__('2.HEADER MAIN','mafoil') ?></div>
			<span class="customize-control-title"><?php echo esc_attr($this->label); ?></span>
			<input type="range" value="<?php echo esc_attr($this->value()); ?>" name="points" min="0" max="500" <?php $this->link(); ?>>
		<?php }
	}
	$wp_customize->add_setting( 'width_logo_2' , array(
		'default' => '',
		'sanitize_callback' => 'sanitize_input',
		'transport' => 'postMessage', 
	));
	$wp_customize->add_control(new Width_logo_2($wp_customize,'width_logo_2',array(
			'label'   => esc_html__('Logo Size','mafoil'),
			'section' => 'bwp-header_2',
		)
	));
	
	//---- background
	$wp_customize->add_setting( 'header_color_2' , array(
		'default' => '',
		'sanitize_callback' => 'sanitize_color',
		'transport' => 'postMessage', 
	));
	$wp_customize->add_control('header_color_2', array(
		'label'   => esc_html__('Background','mafoil'),
		'section' => 'bwp-header_2',
		'type'    => 'color',
	));
	
	//---- icon color
	$wp_customize->add_setting( 'icon_color_2' , array(
		'default' => '',
		'sanitize_callback' => 'sanitize_color',
		'transport' => 'postMessage', 
	));
	$wp_customize->add_control('icon_color_2', array(
		'label'   => esc_html__('Color group icon','mafoil'),
		'section' => 'bwp-header_2',
		'type'    => 'color',
	));
	
	//---- Menu color
	$wp_customize->add_setting( 'menu_color_2' , array(
		'default' => '',
		'sanitize_callback' => 'sanitize_color',
		'transport' => 'postMessage', 
	));
	$wp_customize->add_control('menu_color_2', array(
		'label'   => esc_html__('Color menu','mafoil'),
		'section' => 'bwp-header_2',
		'type'    => 'color',
	));
	
	//---- Hover color
	$wp_customize->add_setting( 'hover_color_2' , array(
		'default' => '',
		'sanitize_callback' => 'sanitize_color',
		'transport' => 'refresh', 
	));
	$wp_customize->add_control('hover_color_2', array(
		'label'   => esc_html__('Color hover','mafoil'),
		'section' => 'bwp-header_2',
		'type'    => 'color',
	));
	
	//---- padding
	class Padding_header_2 extends WP_Customize_Control{
		public $type = 'padding_2';
		public function render_content(){ ?>
			<span class="customize-control-title"><?php echo esc_attr($this->label); ?></span>
			<table class="tg">
				<thead>
					<tr>
						<th><?php echo esc_html__('Top','mafoil') ?></th>
						<th><?php echo esc_html__('Right','mafoil') ?></th>
						<th><?php echo esc_html__('Bottom','mafoil') ?></th>
						<th><?php echo esc_html__('Left','mafoil') ?></th>
						<th></th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td><input type="<?php echo esc_attr($this->type); ?>" value="<?php echo esc_attr($this->value('padding_top_2')); ?>" <?php $this->link('padding_top_2'); ?> /></td>
						<td><input type="<?php echo esc_attr($this->type); ?>" value="<?php echo esc_attr($this->value('padding_right_2')); ?>" <?php $this->link('padding_right_2'); ?> /></td>
						<td><input type="<?php echo esc_attr($this->type); ?>" value="<?php echo esc_attr($this->value('padding_bottom_2')); ?>" <?php $this->link('padding_bottom_2'); ?> /></td>
						<td><input type="<?php echo esc_attr($this->type); ?>" value="<?php echo esc_attr($this->value('padding_left_2')); ?>" <?php $this->link('padding_left_2'); ?> /></td>
						<td>px</td>
					</tr>
				</tbody>
			</table>
		<?php }
	}
	$wp_customize->add_setting('padding_top_2', array(
		'default' => '',
		'sanitize_callback' => 'sanitize_input',
		'transport' => 'postMessage',
	));
	$wp_customize->add_setting('padding_right_2', array(
		'default' => '',
		'sanitize_callback' => 'sanitize_input',
		'transport' => 'postMessage',
	));
	$wp_customize->add_setting('padding_bottom_2', array(
		'default' => '',
		'sanitize_callback' => 'sanitize_input',
		'transport' => 'postMessage',
	));
	$wp_customize->add_setting('padding_left_2', array(
		'default' => '',
		'sanitize_callback' => 'sanitize_input',
		'transport' => 'postMessage',
	));
	$wp_customize->add_control(new Padding_header_2(
		$wp_customize,'padding_2',
		array(
			'label' => esc_html__('Padding header','mafoil'),
			'section' => 'bwp-header_2',
			'settings' => [
				'padding_top_2' => 'padding_top_2',
				'padding_right_2' => 'padding_right_2',
				'padding_bottom_2' => 'padding_bottom_2',
				'padding_left_2' => 'padding_left_2'
			],
			'type' => 'number'
		)
	));
	
	///////////////HEADER 3
	$wp_customize->add_section('bwp-header_3', array(
		'title'          => 'Header 3',
		'panel' => 'header_settings_section',
	));
	
	//---- Top bar
	class Top_bar_3 extends WP_Customize_Control{
		public function enqueue(){
			wp_enqueue_style( 'custom_controls_css', get_template_directory_uri().'/customizer/css/custom_controls.css');
		}
		public $type = 'top_bar_3';
		public function render_content(){ ?>
			<div class="bwp-cus-title"><?php echo esc_html__('1.TOP BAR','mafoil') ?></div>
			<div class="filed-flex">
				<div class="cus-label"><?php echo esc_html__('Show topbar','mafoil') ?></div>
				<div class="switch-options">
					<input type="checkbox" value="<?php echo esc_attr($this->value('top_bar_3')); ?>" <?php $this->link('top_bar_3'); ?>>
					<label class="disable"></label>
				</div>
			</div>
		<?php }
	}
	
	$wp_customize->add_setting( 'top_bar_3' , array(
		'default' => true,
		'sanitize_callback' => 'sanitize_input',
		'transport' => 'refresh', 
	));
	$wp_customize->add_control(new Top_bar_3($wp_customize,'top_bar_3',array(
			'section' => 'bwp-header_3',
			'settings' => [
				'top_bar_3' => 'top_bar_3',
			],
		)
	));
	
	//---- background
	$wp_customize->add_setting( 'background_top_bar_3' , array(
		'default' => '',
		'sanitize_callback' => 'sanitize_color',
		'transport' => 'postMessage',
	));
	$wp_customize->add_control('background_top_bar_3', array(
		'label'   => esc_html__('Background','mafoil'),
		'section' => 'bwp-header_3',
		'type'    => 'color',
	));
	
	//---- color
	$wp_customize->add_setting( 'color_top_bar_3' , array(
		'default' => '',
		'sanitize_callback' => 'sanitize_color',
		'transport' => 'postMessage',
	));
	$wp_customize->add_control('color_top_bar_3', array(
		'label'   => esc_html__('Color','mafoil'),
		'section' => 'bwp-header_3',
		'type'    => 'color',
	));
	
	//---- color link
	$wp_customize->add_setting( 'color_link_top_bar_3' , array(
		'default' => '',
		'sanitize_callback' => 'sanitize_color',
		'transport' => 'postMessage',
	));
	$wp_customize->add_control('color_link_top_bar_3', array(
		'label'   => esc_html__('Color link','mafoil'),
		'section' => 'bwp-header_3',
		'type'    => 'color',
	));
	
	//---- color hover
	$wp_customize->add_setting( 'color_hover_top_bar_3' , array(
		'default' => '',
		'sanitize_callback' => 'sanitize_color',
		'transport' => 'refresh',
	));
	$wp_customize->add_control('color_hover_top_bar_3', array(
		'label'   => esc_html__('Color hover','mafoil'),
		'section' => 'bwp-header_3',
		'type'    => 'color',
	));
	
	//---- content left
	$wp_customize->add_setting( 'content_left_top_bar_3' , array(
		'default' => '<a href="tel:+866.597.2742">Phone: +866.597.2742 </a>',
		'sanitize_callback' => 'sanitize_input',
		'transport' => 'refresh',
	));
	$wp_customize->add_control('content_left_top_bar_3', array(
		'label'   => esc_html__('Content left','mafoil'),
		'section' => 'bwp-header_3',
		'type'    => 'textarea',
	));
	
	//---- content center
	$wp_customize->add_setting( 'content_center_top_bar_3' , array(
		'default' => '<div class="free-shipping hidden-xs">Free shipping on all orders over $50 <a href="#">Details</a></div>', 
		'sanitize_callback' => 'sanitize_input',
		'transport' => 'refresh',
	));
	$wp_customize->add_control('content_center_top_bar_3', array(
		'label'   => esc_html__('Content center','mafoil'),
		'section' => 'bwp-header_3',
		'type'    => 'textarea',
	));
	
	//---- content right
	$wp_customize->add_setting( 'content_right_top_bar_3' , array(
		'default' => '',
		'sanitize_callback' => 'sanitize_input',
		'transport' => 'refresh',
	));
	$wp_customize->add_control('content_right_top_bar_3', array(
		'label'   => esc_html__('Content right','mafoil'),
		'section' => 'bwp-header_3',
		'type'    => 'textarea',
	));
	
	//---- social
	class social_3 extends WP_Customize_Control{
		public function enqueue(){
			wp_enqueue_style( 'custom_controls_css', get_template_directory_uri().'/customizer/css/custom_controls.css');
		}
		public $type = 'social_3';
		public function render_content(){ ?>
			<div class="filed-flex">
				<div class="cus-label"><?php echo esc_html__('Show social','mafoil') ?></div>
				<div class="switch-options">
					<input type="checkbox" value="<?php echo esc_attr($this->value('social_3')); ?>" <?php $this->link('social_3'); ?>>
					<label class="disable"></label>
				</div>
			</div>
		<?php }
	}
	
	$wp_customize->add_setting( 'social_3' , array(
		'default' => true,
		'sanitize_callback' => 'sanitize_input',
		'transport' => 'refresh', 
	));
	$wp_customize->add_control(new social_3($wp_customize,'social_3',array(
			'section' => 'bwp-header_3',
			'settings' => [
				'social_3' => 'social_3',
			],
		)
	));
	
	//---- padding
	class Padding_topbar_3 extends WP_Customize_Control{
		public $type = 'padding_topbar_3';
		public function render_content(){ ?>
			<span class="customize-control-title"><?php echo esc_attr($this->label); ?></span>
			<table class="tg">
				<thead>
					<tr>
						<th><?php echo esc_html__('Top','mafoil') ?></th>
						<th><?php echo esc_html__('Right','mafoil') ?></th>
						<th><?php echo esc_html__('Bottom','mafoil') ?></th>
						<th><?php echo esc_html__('Left','mafoil') ?></th>
						<th></th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td><input type="<?php echo esc_attr($this->type); ?>" value="<?php echo esc_attr($this->value('padding_topbar_top_3')); ?>" <?php $this->link('padding_topbar_top_3'); ?> /></td>
						<td><input type="<?php echo esc_attr($this->type); ?>" value="<?php echo esc_attr($this->value('padding_topbar_right_3')); ?>" <?php $this->link('padding_topbar_right_3'); ?> /></td>
						<td><input type="<?php echo esc_attr($this->type); ?>" value="<?php echo esc_attr($this->value('padding_topbar_bottom_3')); ?>" <?php $this->link('padding_topbar_bottom_3'); ?> /></td>
						<td><input type="<?php echo esc_attr($this->type); ?>" value="<?php echo esc_attr($this->value('padding_topbar_left_3')); ?>" <?php $this->link('padding_topbar_left_3'); ?> /></td>
						<td>px</td>
					</tr>
				</tbody>
			</table>
		<?php }
	}
	$wp_customize->add_setting('padding_topbar_top_3', array(
		'default' => '',
		'sanitize_callback' => 'sanitize_input',
		'transport' => 'postMessage',
	));
	$wp_customize->add_setting('padding_topbar_right_3', array(
		'default' => '',
		'sanitize_callback' => 'sanitize_input',
		'transport' => 'postMessage',
	));
	$wp_customize->add_setting('padding_topbar_bottom_3', array(
		'default' => '',
		'sanitize_callback' => 'sanitize_input',
		'transport' => 'postMessage',
	));
	$wp_customize->add_setting('padding_topbar_left_3', array(
		'default' => '',
		'sanitize_callback' => 'sanitize_input',
		'transport' => 'postMessage',
	));
	$wp_customize->add_control(new Padding_topbar_3(
		$wp_customize,'padding_topbar_3',
		array(
			'label' => esc_html__('Padding topbar','mafoil'),
			'section' => 'bwp-header_3',
			'settings' => [
				'padding_topbar_top_3' => 'padding_topbar_top_3',
				'padding_topbar_right_3' => 'padding_topbar_right_3',
				'padding_topbar_bottom_3' => 'padding_topbar_bottom_3',
				'padding_topbar_left_3' => 'padding_topbar_left_3'
			],
			'type' => 'number'
		)
	));
	
	//---- logo
	class Width_logo_3 extends WP_Customize_Control{
		public $type = 'range';
		public function render_content(){ ?>
			<div class="bwp-cus-title" style="margin-top:30px;"><?php echo esc_html__('2.HEADER MAIN','mafoil') ?></div>
			<span class="customize-control-title"><?php echo esc_attr($this->label); ?></span>
			<input type="range" value="<?php echo esc_attr($this->value()); ?>" name="points" min="0" max="500" <?php $this->link(); ?>>
		<?php }
	}
	$wp_customize->add_setting( 'width_logo_3' , array(
		'default' => '',
		'sanitize_callback' => 'sanitize_input',
		'transport' => 'postMessage', 
	));
	$wp_customize->add_control(new Width_logo_3($wp_customize,'width_logo_3',array(
			'label'   => esc_html__('Logo Size','mafoil'),
			'section' => 'bwp-header_3',
		)
	));
	
	//---- background
	$wp_customize->add_setting( 'header_color_3' , array(
		'default' => '',
		'sanitize_callback' => 'sanitize_color',
		'transport' => 'postMessage', 
	));
	$wp_customize->add_control('header_color_3', array(
		'label'   => esc_html__('Background','mafoil'),
		'section' => 'bwp-header_3',
		'type'    => 'color',
	));
	
	//---- icon color
	$wp_customize->add_setting( 'icon_color_3' , array(
		'default' => '',
		'sanitize_callback' => 'sanitize_color',
		'transport' => 'postMessage', 
	));
	$wp_customize->add_control('icon_color_3', array(
		'label'   => esc_html__('Color group icon','mafoil'),
		'section' => 'bwp-header_3',
		'type'    => 'color',
	));
	
	//---- Menu color
	$wp_customize->add_setting( 'menu_color_3' , array(
		'default' => '',
		'sanitize_callback' => 'sanitize_color',
		'transport' => 'postMessage', 
	));
	$wp_customize->add_control('menu_color_3', array(
		'label'   => esc_html__('Color menu','mafoil'),
		'section' => 'bwp-header_3',
		'type'    => 'color',
	));
	
	//---- Hover color
	$wp_customize->add_setting( 'hover_color_3' , array(
		'default' => '',
		'sanitize_callback' => 'sanitize_color',
		'transport' => 'refresh', 
	));
	$wp_customize->add_control('hover_color_3', array(
		'label'   => esc_html__('Color hover','mafoil'),
		'section' => 'bwp-header_3',
		'type'    => 'color',
	));
	
	//---- padding
	class Padding_header_3 extends WP_Customize_Control{
		public $type = 'padding_3';
		public function render_content(){ ?>
			<span class="customize-control-title"><?php echo esc_attr($this->label); ?></span>
			<table class="tg">
				<thead>
					<tr>
						<th><?php echo esc_html__('Top','mafoil') ?></th>
						<th><?php echo esc_html__('Right','mafoil') ?></th>
						<th><?php echo esc_html__('Bottom','mafoil') ?></th>
						<th><?php echo esc_html__('Left','mafoil') ?></th>
						<th></th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td><input type="<?php echo esc_attr($this->type); ?>" value="<?php echo esc_attr($this->value('padding_top_3')); ?>" <?php $this->link('padding_top_3'); ?> /></td>
						<td><input type="<?php echo esc_attr($this->type); ?>" value="<?php echo esc_attr($this->value('padding_right_3')); ?>" <?php $this->link('padding_right_3'); ?> /></td>
						<td><input type="<?php echo esc_attr($this->type); ?>" value="<?php echo esc_attr($this->value('padding_bottom_3')); ?>" <?php $this->link('padding_bottom_3'); ?> /></td>
						<td><input type="<?php echo esc_attr($this->type); ?>" value="<?php echo esc_attr($this->value('padding_left_3')); ?>" <?php $this->link('padding_left_3'); ?> /></td>
						<td>px</td>
					</tr>
				</tbody>
			</table>
		<?php }
	}
	$wp_customize->add_setting('padding_top_3', array(
		'default' => '',
		'sanitize_callback' => 'sanitize_input',
		'transport' => 'postMessage',
	));
	$wp_customize->add_setting('padding_right_3', array(
		'default' => '',
		'sanitize_callback' => 'sanitize_input',
		'transport' => 'postMessage',
	));
	$wp_customize->add_setting('padding_bottom_3', array(
		'default' => '',
		'sanitize_callback' => 'sanitize_input',
		'transport' => 'postMessage',
	));
	$wp_customize->add_setting('padding_left_3', array(
		'default' => '',
		'sanitize_callback' => 'sanitize_input',
		'transport' => 'postMessage',
	));
	$wp_customize->add_control(new Padding_header_3(
		$wp_customize,'padding_3',
		array(
			'label' => esc_html__('Padding header','mafoil'),
			'section' => 'bwp-header_3',
			'settings' => [
				'padding_top_3' => 'padding_top_3',
				'padding_right_3' => 'padding_right_3',
				'padding_bottom_3' => 'padding_bottom_3',
				'padding_left_3' => 'padding_left_3'
			],
			'type' => 'number'
		)
	));
	
	///////////////HEADER 4
	$wp_customize->add_section('bwp-header_4', array(
		'title'          => 'Header 4',
		'panel' => 'header_settings_section',
	));
	
	//---- Top bar
	class Top_bar_4 extends WP_Customize_Control{
		public function enqueue(){
			wp_enqueue_style( 'custom_controls_css', get_template_directory_uri().'/customizer/css/custom_controls.css');
		}
		public $type = 'top_bar_4';
		public function render_content(){ ?>
			<div class="bwp-cus-title"><?php echo esc_html__('1.TOP BAR','mafoil') ?></div>
			<div class="filed-flex">
				<div class="cus-label"><?php echo esc_html__('Show topbar','mafoil') ?></div>
				<div class="switch-options">
					<input type="checkbox" value="<?php echo esc_attr($this->value('top_bar_4')); ?>" <?php $this->link('top_bar_4'); ?>>
					<label class="disable"></label>
				</div>
			</div>
		<?php }
	}
	
	$wp_customize->add_setting( 'top_bar_4' , array(
		'default' => true,
		'sanitize_callback' => 'sanitize_input',
		'transport' => 'refresh', 
	));
	$wp_customize->add_control(new Top_bar_4($wp_customize,'top_bar_4',array(
			'section' => 'bwp-header_4',
			'settings' => [
				'top_bar_4' => 'top_bar_4',
			],
		)
	));
	
	//---- background
	$wp_customize->add_setting( 'background_top_bar_4' , array(
		'default' => '',
		'sanitize_callback' => 'sanitize_color',
		'transport' => 'postMessage',
	));
	$wp_customize->add_control('background_top_bar_4', array(
		'label'   => esc_html__('Background','mafoil'),
		'section' => 'bwp-header_4',
		'type'    => 'color',
	));
	
	//---- color
	$wp_customize->add_setting( 'color_top_bar_4' , array(
		'default' => '',
		'sanitize_callback' => 'sanitize_color',
		'transport' => 'postMessage',
	));
	$wp_customize->add_control('color_top_bar_4', array(
		'label'   => esc_html__('Color','mafoil'),
		'section' => 'bwp-header_4',
		'type'    => 'color',
	));
	
	//---- color link
	$wp_customize->add_setting( 'color_link_top_bar_4' , array(
		'default' => '',
		'sanitize_callback' => 'sanitize_color',
		'transport' => 'postMessage',
	));
	$wp_customize->add_control('color_link_top_bar_4', array(
		'label'   => esc_html__('Color link','mafoil'),
		'section' => 'bwp-header_4',
		'type'    => 'color',
	));
	
	//---- color hover
	$wp_customize->add_setting( 'color_hover_top_bar_4' , array(
		'default' => '',
		'sanitize_callback' => 'sanitize_color',
		'transport' => 'refresh',
	));
	$wp_customize->add_control('color_hover_top_bar_4', array(
		'label'   => esc_html__('Color hover','mafoil'),
		'section' => 'bwp-header_4',
		'type'    => 'color',
	));
	
	//---- content left
	$wp_customize->add_setting( 'content_left_top_bar_4' , array(
		'default' => 'Free shipping on all orders over $50',
		'sanitize_callback' => 'sanitize_input',
		'transport' => 'refresh',
	));
	$wp_customize->add_control('content_left_top_bar_4', array(
		'label'   => esc_html__('Content left','mafoil'),
		'section' => 'bwp-header_4',
		'type'    => 'textarea',
	));
	
	//---- content center
	$wp_customize->add_setting( 'content_center_top_bar_4' , array(
		'default' => '', 
		'sanitize_callback' => 'sanitize_input',
		'transport' => 'refresh',
	));
	$wp_customize->add_control('content_center_top_bar_4', array(
		'label'   => esc_html__('Content center','mafoil'),
		'section' => 'bwp-header_4',
		'type'    => 'textarea',
	));
	
	//---- content right
	$wp_customize->add_setting( 'content_right_top_bar_4' , array(
		'default' => '<div class="address hidden-xs"><a target="_blank" href="https://www.google.com/maps/place/lastminute.com+London+Eye/@51.503297,-0.119554,10z/data=!4m5!3m4!1s0x0:0x4291f3172409ea92!8m2!3d51.5032973!4d-0.1195537?hl=en">07 Piney Creek Rd, Scottsburg, VA, USA</a></div><div class="email"><a href="mailto:support@mafoil.com">support@mafoil.com</a></div>', 
		'sanitize_callback' => 'sanitize_input',
		'transport' => 'refresh',
	));
	$wp_customize->add_control('content_right_top_bar_4', array(
		'label'   => esc_html__('Content right','mafoil'),
		'section' => 'bwp-header_4',
		'type'    => 'textarea',
	));
	
	//---- social
	class social_4 extends WP_Customize_Control{
		public function enqueue(){
			wp_enqueue_style( 'custom_controls_css', get_template_directory_uri().'/customizer/css/custom_controls.css');
		}
		public $type = 'social_4';
		public function render_content(){ ?>
			<div class="filed-flex">
				<div class="cus-label"><?php echo esc_html__('Show social','mafoil') ?></div>
				<div class="switch-options">
					<input type="checkbox" value="<?php echo esc_attr($this->value('social_4')); ?>" <?php $this->link('social_4'); ?>>
					<label class="disable"></label>
				</div>
			</div>
		<?php }
	}
	
	$wp_customize->add_setting( 'social_4' , array(
		'default' => '',
		'sanitize_callback' => 'sanitize_input',
		'transport' => 'refresh', 
	));
	$wp_customize->add_control(new social_4($wp_customize,'social_4',array(
			'section' => 'bwp-header_4',
			'settings' => [
				'social_4' => 'social_4',
			],
		)
	));
	
	//---- padding
	class Padding_topbar_4 extends WP_Customize_Control{
		public $type = 'padding_topbar_4';
		public function render_content(){ ?>
			<span class="customize-control-title"><?php echo esc_attr($this->label); ?></span>
			<table class="tg">
				<thead>
					<tr>
						<th><?php echo esc_html__('Top','mafoil') ?></th>
						<th><?php echo esc_html__('Right','mafoil') ?></th>
						<th><?php echo esc_html__('Bottom','mafoil') ?></th>
						<th><?php echo esc_html__('Left','mafoil') ?></th>
						<th></th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td><input type="<?php echo esc_attr($this->type); ?>" value="<?php echo esc_attr($this->value('padding_topbar_top_4')); ?>" <?php $this->link('padding_topbar_top_4'); ?> /></td>
						<td><input type="<?php echo esc_attr($this->type); ?>" value="<?php echo esc_attr($this->value('padding_topbar_right_4')); ?>" <?php $this->link('padding_topbar_right_4'); ?> /></td>
						<td><input type="<?php echo esc_attr($this->type); ?>" value="<?php echo esc_attr($this->value('padding_topbar_bottom_4')); ?>" <?php $this->link('padding_topbar_bottom_4'); ?> /></td>
						<td><input type="<?php echo esc_attr($this->type); ?>" value="<?php echo esc_attr($this->value('padding_topbar_left_4')); ?>" <?php $this->link('padding_topbar_left_4'); ?> /></td>
						<td>px</td>
					</tr>
				</tbody>
			</table>
		<?php }
	}
	$wp_customize->add_setting('padding_topbar_top_4', array(
		'default' => '',
		'sanitize_callback' => 'sanitize_input',
		'transport' => 'postMessage',
	));
	$wp_customize->add_setting('padding_topbar_right_4', array(
		'default' => '',
		'sanitize_callback' => 'sanitize_input',
		'transport' => 'postMessage',
	));
	$wp_customize->add_setting('padding_topbar_bottom_4', array(
		'default' => '',
		'sanitize_callback' => 'sanitize_input',
		'transport' => 'postMessage',
	));
	$wp_customize->add_setting('padding_topbar_left_4', array(
		'default' => '',
		'sanitize_callback' => 'sanitize_input',
		'transport' => 'postMessage',
	));
	$wp_customize->add_control(new Padding_topbar_4(
		$wp_customize,'padding_topbar_4',
		array(
			'label' => esc_html__('Padding topbar','mafoil'),
			'section' => 'bwp-header_4',
			'settings' => [
				'padding_topbar_top_4' => 'padding_topbar_top_4',
				'padding_topbar_right_4' => 'padding_topbar_right_4',
				'padding_topbar_bottom_4' => 'padding_topbar_bottom_4',
				'padding_topbar_left_4' => 'padding_topbar_left_4'
			],
			'type' => 'number'
		)
	));
	
	//---- logo
	class Width_logo_4 extends WP_Customize_Control{
		public $type = 'range';
		public function render_content(){ ?>
			<div class="bwp-cus-title" style="margin-top:30px;"><?php echo esc_html__('2.HEADER MAIN','mafoil') ?></div>
			<span class="customize-control-title"><?php echo esc_attr($this->label); ?></span>
			<input type="range" value="<?php echo esc_attr($this->value()); ?>" name="points" min="0" max="500" <?php $this->link(); ?>>
		<?php }
	}
	$wp_customize->add_setting( 'width_logo_4' , array(
		'default' => '',
		'sanitize_callback' => 'sanitize_input',
		'transport' => 'postMessage', 
	));
	$wp_customize->add_control(new Width_logo_4($wp_customize,'width_logo_4',array(
			'label'   => esc_html__('Logo Size','mafoil'),
			'section' => 'bwp-header_4',
		)
	));
	
	//---- background
	$wp_customize->add_setting( 'header_color_4' , array(
		'default' => '',
		'sanitize_callback' => 'sanitize_color',
		'transport' => 'postMessage', 
	));
	$wp_customize->add_control('header_color_4', array(
		'label'   => esc_html__('Background','mafoil'),
		'section' => 'bwp-header_4',
		'type'    => 'color',
	));
	
	//---- icon color
	$wp_customize->add_setting( 'icon_color_4' , array(
		'default' => '',
		'sanitize_callback' => 'sanitize_color',
		'transport' => 'postMessage', 
	));
	$wp_customize->add_control('icon_color_4', array(
		'label'   => esc_html__('Color group icon','mafoil'),
		'section' => 'bwp-header_4',
		'type'    => 'color',
	));
	
	//---- Menu color
	$wp_customize->add_setting( 'menu_color_4' , array(
		'default' => '',
		'sanitize_callback' => 'sanitize_color',
		'transport' => 'postMessage', 
	));
	$wp_customize->add_control('menu_color_4', array(
		'label'   => esc_html__('Color menu','mafoil'),
		'section' => 'bwp-header_4',
		'type'    => 'color',
	));
	
	//---- Hover color
	$wp_customize->add_setting( 'hover_color_4' , array(
		'default' => '',
		'sanitize_callback' => 'sanitize_color',
		'transport' => 'refresh', 
	));
	$wp_customize->add_control('hover_color_4', array(
		'label'   => esc_html__('Color hover','mafoil'),
		'section' => 'bwp-header_4',
		'type'    => 'color',
	));
	
	//---- padding
	class Padding_header_4 extends WP_Customize_Control{
		public $type = 'padding_4';
		public function render_content(){ ?>
			<span class="customize-control-title"><?php echo esc_attr($this->label); ?></span>
			<table class="tg">
				<thead>
					<tr>
						<th><?php echo esc_html__('Top','mafoil') ?></th>
						<th><?php echo esc_html__('Right','mafoil') ?></th>
						<th><?php echo esc_html__('Bottom','mafoil') ?></th>
						<th><?php echo esc_html__('Left','mafoil') ?></th>
						<th></th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td><input type="<?php echo esc_attr($this->type); ?>" value="<?php echo esc_attr($this->value('padding_top_4')); ?>" <?php $this->link('padding_top_4'); ?> /></td>
						<td><input type="<?php echo esc_attr($this->type); ?>" value="<?php echo esc_attr($this->value('padding_right_4')); ?>" <?php $this->link('padding_right_4'); ?> /></td>
						<td><input type="<?php echo esc_attr($this->type); ?>" value="<?php echo esc_attr($this->value('padding_bottom_4')); ?>" <?php $this->link('padding_bottom_4'); ?> /></td>
						<td><input type="<?php echo esc_attr($this->type); ?>" value="<?php echo esc_attr($this->value('padding_left_4')); ?>" <?php $this->link('padding_left_4'); ?> /></td>
						<td>px</td>
					</tr>
				</tbody>
			</table>
		<?php }
	}
	$wp_customize->add_setting('padding_top_4', array(
		'default' => '',
		'sanitize_callback' => 'sanitize_input',
		'transport' => 'postMessage',
	));
	$wp_customize->add_setting('padding_right_4', array(
		'default' => '',
		'sanitize_callback' => 'sanitize_input',
		'transport' => 'postMessage',
	));
	$wp_customize->add_setting('padding_bottom_4', array(
		'default' => '',
		'sanitize_callback' => 'sanitize_input',
		'transport' => 'postMessage',
	));
	$wp_customize->add_setting('padding_left_4', array(
		'default' => '',
		'sanitize_callback' => 'sanitize_input',
		'transport' => 'postMessage',
	));
	$wp_customize->add_control(new Padding_header_4(
		$wp_customize,'padding_4',
		array(
			'label' => esc_html__('Padding header','mafoil'),
			'section' => 'bwp-header_4',
			'settings' => [
				'padding_top_4' => 'padding_top_4',
				'padding_right_4' => 'padding_right_4',
				'padding_bottom_4' => 'padding_bottom_4',
				'padding_left_4' => 'padding_left_4'
			],
			'type' => 'number'
		)
	));
	
	///////////////HEADER 5
	$wp_customize->add_section('bwp-header_5', array(
		'title'          => 'Header 5',
		'panel' => 'header_settings_section',
	));
	
	//---- Top bar
	class Top_bar_5 extends WP_Customize_Control{
		public function enqueue(){
			wp_enqueue_style( 'custom_controls_css', get_template_directory_uri().'/customizer/css/custom_controls.css');
		}
		public $type = 'top_bar_5';
		public function render_content(){ ?>
			<div class="bwp-cus-title"><?php echo esc_html__('1.TOP BAR','mafoil') ?></div>
			<div class="filed-flex">
				<div class="cus-label"><?php echo esc_html__('Show topbar','mafoil') ?></div>
				<div class="switch-options">
					<input type="checkbox" value="<?php echo esc_attr($this->value('top_bar_5')); ?>" <?php $this->link('top_bar_5'); ?>>
					<label class="disable"></label>
				</div>
			</div>
		<?php }
	}
	
	$wp_customize->add_setting( 'top_bar_5' , array(
		'default' => '',
		'sanitize_callback' => 'sanitize_input',
		'transport' => 'refresh', 
	));
	$wp_customize->add_control(new Top_bar_5($wp_customize,'top_bar_5',array(
			'section' => 'bwp-header_5',
			'settings' => [
				'top_bar_5' => 'top_bar_5',
			],
		)
	));
	
	//---- background
	$wp_customize->add_setting( 'background_top_bar_5' , array(
		'default' => '',
		'sanitize_callback' => 'sanitize_color',
		'transport' => 'postMessage',
	));
	$wp_customize->add_control('background_top_bar_5', array(
		'label'   => esc_html__('Background','mafoil'),
		'section' => 'bwp-header_5',
		'type'    => 'color',
	));
	
	//---- color
	$wp_customize->add_setting( 'color_top_bar_5' , array(
		'default' => '',
		'sanitize_callback' => 'sanitize_color',
		'transport' => 'postMessage',
	));
	$wp_customize->add_control('color_top_bar_5', array(
		'label'   => esc_html__('Color','mafoil'),
		'section' => 'bwp-header_5',
		'type'    => 'color',
	));
	
	//---- color link
	$wp_customize->add_setting( 'color_link_top_bar_5' , array(
		'default' => '',
		'sanitize_callback' => 'sanitize_color',
		'transport' => 'postMessage',
	));
	$wp_customize->add_control('color_link_top_bar_5', array(
		'label'   => esc_html__('Color link','mafoil'),
		'section' => 'bwp-header_5',
		'type'    => 'color',
	));
	
	//---- color hover
	$wp_customize->add_setting( 'color_hover_top_bar_5' , array(
		'default' => '',
		'sanitize_callback' => 'sanitize_color',
		'transport' => 'refresh',
	));
	$wp_customize->add_control('color_hover_top_bar_5', array(
		'label'   => esc_html__('Color hover','mafoil'),
		'section' => 'bwp-header_5',
		'type'    => 'color',
	));
	
	//---- content left
	$wp_customize->add_setting( 'content_left_top_bar_5' , array(
		'default' => '',
		'sanitize_callback' => 'sanitize_input',
		'transport' => 'refresh',
	));
	$wp_customize->add_control('content_left_top_bar_5', array(
		'label'   => esc_html__('Content left','mafoil'),
		'section' => 'bwp-header_5',
		'type'    => 'textarea',
	));
	
	//---- content center
	$wp_customize->add_setting( 'content_center_top_bar_5' , array(
		'default' => '',
		'sanitize_callback' => 'sanitize_input',		
		'transport' => 'refresh',
	));
	$wp_customize->add_control('content_center_top_bar_5', array(
		'label'   => esc_html__('Content center','mafoil'),
		'section' => 'bwp-header_5',
		'type'    => 'textarea',
	));
	
	//---- content right
	$wp_customize->add_setting( 'content_right_top_bar_5' , array(
		'default' => '',
		'sanitize_callback' => 'sanitize_input',
		'transport' => 'refresh',
	));
	$wp_customize->add_control('content_right_top_bar_5', array(
		'label'   => esc_html__('Content right','mafoil'),
		'section' => 'bwp-header_5',
		'type'    => 'textarea',
	));
	
	//---- social
	class social_5 extends WP_Customize_Control{
		public function enqueue(){
			wp_enqueue_style( 'custom_controls_css', get_template_directory_uri().'/customizer/css/custom_controls.css');
		}
		public $type = 'social_5';
		public function render_content(){ ?>
			<div class="filed-flex">
				<div class="cus-label"><?php echo esc_html__('Show social','mafoil') ?></div>
				<div class="switch-options">
					<input type="checkbox" value="<?php echo esc_attr($this->value('social_5')); ?>" <?php $this->link('social_5'); ?>>
					<label class="disable"></label>
				</div>
			</div>
		<?php }
	}
	
	$wp_customize->add_setting( 'social_5' , array(
		'default' => '',
		'sanitize_callback' => 'sanitize_input',
		'transport' => 'refresh', 
	));
	$wp_customize->add_control(new social_5($wp_customize,'social_5',array(
			'section' => 'bwp-header_5',
			'settings' => [
				'social_5' => 'social_5',
			],
		)
	));
	
	//---- padding
	class Padding_topbar_5 extends WP_Customize_Control{
		public $type = 'padding_topbar_5';
		public function render_content(){ ?>
			<span class="customize-control-title"><?php echo esc_attr($this->label); ?></span>
			<table class="tg">
				<thead>
					<tr>
						<th><?php echo esc_html__('Top','mafoil') ?></th>
						<th><?php echo esc_html__('Right','mafoil') ?></th>
						<th><?php echo esc_html__('Bottom','mafoil') ?></th>
						<th><?php echo esc_html__('Left','mafoil') ?></th>
						<th></th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td><input type="<?php echo esc_attr($this->type); ?>" value="<?php echo esc_attr($this->value('padding_topbar_top_5')); ?>" <?php $this->link('padding_topbar_top_5'); ?> /></td>
						<td><input type="<?php echo esc_attr($this->type); ?>" value="<?php echo esc_attr($this->value('padding_topbar_right_5')); ?>" <?php $this->link('padding_topbar_right_5'); ?> /></td>
						<td><input type="<?php echo esc_attr($this->type); ?>" value="<?php echo esc_attr($this->value('padding_topbar_bottom_5')); ?>" <?php $this->link('padding_topbar_bottom_5'); ?> /></td>
						<td><input type="<?php echo esc_attr($this->type); ?>" value="<?php echo esc_attr($this->value('padding_topbar_left_5')); ?>" <?php $this->link('padding_topbar_left_5'); ?> /></td>
						<td>px</td>
					</tr>
				</tbody>
			</table>
		<?php }
	}
	$wp_customize->add_setting('padding_topbar_top_5', array(
		'default' => '',
		'sanitize_callback' => 'sanitize_input',
		'transport' => 'postMessage',
	));
	$wp_customize->add_setting('padding_topbar_right_5', array(
		'default' => '',
		'sanitize_callback' => 'sanitize_input',
		'transport' => 'postMessage',
	));
	$wp_customize->add_setting('padding_topbar_bottom_5', array(
		'default' => '',
		'sanitize_callback' => 'sanitize_input',
		'transport' => 'postMessage',
	));
	$wp_customize->add_setting('padding_topbar_left_5', array(
		'default' => '',
		'sanitize_callback' => 'sanitize_input',
		'transport' => 'postMessage',
	));
	$wp_customize->add_control(new Padding_topbar_5(
		$wp_customize,'padding_topbar_5',
		array(
			'label' => esc_html__('Padding topbar','mafoil'),
			'section' => 'bwp-header_5',
			'settings' => [
				'padding_topbar_top_5' => 'padding_topbar_top_5',
				'padding_topbar_right_5' => 'padding_topbar_right_5',
				'padding_topbar_bottom_5' => 'padding_topbar_bottom_5',
				'padding_topbar_left_5' => 'padding_topbar_left_5'
			],
			'type' => 'number'
		)
	));
	
	//---- logo
	class Width_logo_5 extends WP_Customize_Control{
		public $type = 'range';
		public function render_content(){ ?>
			<div class="bwp-cus-title" style="margin-top:30px;"><?php echo esc_html__('2.HEADER MAIN','mafoil') ?></div>
			<span class="customize-control-title"><?php echo esc_attr($this->label); ?></span>
			<input type="range" value="<?php echo esc_attr($this->value()); ?>" name="points" min="0" max="500" <?php $this->link(); ?>>
		<?php }
	}
	$wp_customize->add_setting( 'width_logo_5' , array(
		'default' => '',
		'sanitize_callback' => 'sanitize_input',
		'transport' => 'postMessage', 
	));
	$wp_customize->add_control(new Width_logo_5($wp_customize,'width_logo_5',array(
			'label'   => esc_html__('Logo Size','mafoil'),
			'section' => 'bwp-header_5',
		)
	));
	
	//---- background
	$wp_customize->add_setting( 'header_color_5' , array(
		'default' => '',
		'sanitize_callback' => 'sanitize_color',
		'transport' => 'postMessage', 
	));
	$wp_customize->add_control('header_color_5', array(
		'label'   => esc_html__('Background','mafoil'),
		'section' => 'bwp-header_5',
		'type'    => 'color',
	));
	
	//---- icon color
	$wp_customize->add_setting( 'icon_color_5' , array(
		'default' => '',
		'sanitize_callback' => 'sanitize_color',
		'transport' => 'postMessage', 
	));
	$wp_customize->add_control('icon_color_5', array(
		'label'   => esc_html__('Color group icon','mafoil'),
		'section' => 'bwp-header_5',
		'type'    => 'color',
	));
	
	//---- Hover color
	$wp_customize->add_setting( 'hover_color_5' , array(
		'default' => '',
		'sanitize_callback' => 'sanitize_color',
		'transport' => 'refresh', 
	));
	$wp_customize->add_control('hover_color_5', array(
		'label'   => esc_html__('Color hover','mafoil'),
		'section' => 'bwp-header_5',
		'type'    => 'color',
	));
	
	//---- padding
	class Padding_header_5 extends WP_Customize_Control{
		public $type = 'padding_5';
		public function render_content(){ ?>
			<span class="customize-control-title"><?php echo esc_attr($this->label); ?></span>
			<table class="tg">
				<thead>
					<tr>
						<th><?php echo esc_html__('Top','mafoil') ?></th>
						<th><?php echo esc_html__('Right','mafoil') ?></th>
						<th><?php echo esc_html__('Bottom','mafoil') ?></th>
						<th><?php echo esc_html__('Left','mafoil') ?></th>
						<th></th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td><input type="<?php echo esc_attr($this->type); ?>" value="<?php echo esc_attr($this->value('padding_top_5')); ?>" <?php $this->link('padding_top_5'); ?> /></td>
						<td><input type="<?php echo esc_attr($this->type); ?>" value="<?php echo esc_attr($this->value('padding_right_5')); ?>" <?php $this->link('padding_right_5'); ?> /></td>
						<td><input type="<?php echo esc_attr($this->type); ?>" value="<?php echo esc_attr($this->value('padding_bottom_5')); ?>" <?php $this->link('padding_bottom_5'); ?> /></td>
						<td><input type="<?php echo esc_attr($this->type); ?>" value="<?php echo esc_attr($this->value('padding_left_5')); ?>" <?php $this->link('padding_left_5'); ?> /></td>
						<td>px</td>
					</tr>
				</tbody>
			</table>
		<?php }
	}
	$wp_customize->add_setting('padding_top_5', array(
		'default' => '',
		'sanitize_callback' => 'sanitize_input',
		'transport' => 'postMessage',
	));
	$wp_customize->add_setting('padding_right_5', array(
		'default' => '',
		'sanitize_callback' => 'sanitize_input',
		'transport' => 'postMessage',
	));
	$wp_customize->add_setting('padding_bottom_5', array(
		'default' => '',
		'sanitize_callback' => 'sanitize_input',
		'transport' => 'postMessage',
	));
	$wp_customize->add_setting('padding_left_5', array(
		'default' => '',
		'sanitize_callback' => 'sanitize_input',
		'transport' => 'postMessage',
	));
	$wp_customize->add_control(new Padding_header_5(
		$wp_customize,'padding_5',
		array(
			'label' => esc_html__('Padding header','mafoil'),
			'section' => 'bwp-header_5',
			'settings' => [
				'padding_top_5' => 'padding_top_5',
				'padding_right_5' => 'padding_right_5',
				'padding_bottom_5' => 'padding_bottom_5',
				'padding_left_5' => 'padding_left_5'
			],
			'type' => 'number'
		)
	));
	
	///////////////HEADER 6
	$wp_customize->add_section('bwp-header_6', array(
		'title'          => 'Header 6',
		'panel' => 'header_settings_section',
	));
	
	//---- Top bar
	class Top_bar_6 extends WP_Customize_Control{
		public function enqueue(){
			wp_enqueue_style( 'custom_controls_css', get_template_directory_uri().'/customizer/css/custom_controls.css');
		}
		public $type = 'top_bar_6';
		public function render_content(){ ?>
			<div class="bwp-cus-title"><?php echo esc_html__('1.TOP BAR','mafoil') ?></div>
			<div class="filed-flex">
				<div class="cus-label"><?php echo esc_html__('Show topbar','mafoil') ?></div>
				<div class="switch-options">
					<input type="checkbox" value="<?php echo esc_attr($this->value('top_bar_6')); ?>" <?php $this->link('top_bar_6'); ?>>
					<label class="disable"></label>
				</div>
			</div>
		<?php }
	}
	
	$wp_customize->add_setting( 'top_bar_6' , array(
		'default' => '',
		'sanitize_callback' => 'sanitize_input',
		'transport' => 'refresh', 
	));
	$wp_customize->add_control(new Top_bar_6($wp_customize,'top_bar_6',array(
			'section' => 'bwp-header_6',
			'settings' => [
				'top_bar_6' => 'top_bar_6',
			],
		)
	));
	
	//---- background
	$wp_customize->add_setting( 'background_top_bar_6' , array(
		'default' => '',
		'sanitize_callback' => 'sanitize_color',
		'transport' => 'postMessage',
	));
	$wp_customize->add_control('background_top_bar_6', array(
		'label'   => esc_html__('Background','mafoil'),
		'section' => 'bwp-header_6',
		'type'    => 'color',
	));
	
	//---- color
	$wp_customize->add_setting( 'color_top_bar_6' , array(
		'default' => '',
		'sanitize_callback' => 'sanitize_color',
		'transport' => 'postMessage',
	));
	$wp_customize->add_control('color_top_bar_6', array(
		'label'   => esc_html__('Color','mafoil'),
		'section' => 'bwp-header_6',
		'type'    => 'color',
	));
	
	//---- color link
	$wp_customize->add_setting( 'color_link_top_bar_6' , array(
		'default' => '',
		'sanitize_callback' => 'sanitize_color',
		'transport' => 'postMessage',
	));
	$wp_customize->add_control('color_link_top_bar_6', array(
		'label'   => esc_html__('Color link','mafoil'),
		'section' => 'bwp-header_6',
		'type'    => 'color',
	));
	
	//---- color hover
	$wp_customize->add_setting( 'color_hover_top_bar_6' , array(
		'default' => '',
		'sanitize_callback' => 'sanitize_color',
		'transport' => 'refresh',
	));
	$wp_customize->add_control('color_hover_top_bar_6', array(
		'label'   => esc_html__('Color hover','mafoil'),
		'section' => 'bwp-header_6',
		'type'    => 'color',
	));
	
	//---- content left
	$wp_customize->add_setting( 'content_left_top_bar_6' , array(
		'default' => '',
		'sanitize_callback' => 'sanitize_input',
		'transport' => 'refresh',
	));
	$wp_customize->add_control('content_left_top_bar_6', array(
		'label'   => esc_html__('Content left','mafoil'),
		'section' => 'bwp-header_6',
		'type'    => 'textarea',
	));
	
	//---- content center
	$wp_customize->add_setting( 'content_center_top_bar_6' , array(
		'default' => '',
		'sanitize_callback' => 'sanitize_input',
		'transport' => 'refresh',
	));
	$wp_customize->add_control('content_center_top_bar_6', array(
		'label'   => esc_html__('Content center','mafoil'),
		'section' => 'bwp-header_6',
		'type'    => 'textarea',
	));
	
	//---- content right
	$wp_customize->add_setting( 'content_right_top_bar_6' , array(
		'default' => '',
		'sanitize_callback' => 'sanitize_input',
		'transport' => 'refresh',
	));
	$wp_customize->add_control('content_right_top_bar_6', array(
		'label'   => esc_html__('Content right','mafoil'),
		'section' => 'bwp-header_6',
		'type'    => 'textarea',
	));
	
	//---- social
	class social_6 extends WP_Customize_Control{
		public function enqueue(){
			wp_enqueue_style( 'custom_controls_css', get_template_directory_uri().'/customizer/css/custom_controls.css');
		}
		public $type = 'social_6';
		public function render_content(){ ?>
			<div class="filed-flex">
				<div class="cus-label"><?php echo esc_html__('Show social','mafoil') ?></div>
				<div class="switch-options">
					<input type="checkbox" value="<?php echo esc_attr($this->value('social_6')); ?>" <?php $this->link('social_6'); ?>>
					<label class="disable"></label>
				</div>
			</div>
		<?php }
	}
	
	$wp_customize->add_setting( 'social_6' , array(
		'default' => '',
		'sanitize_callback' => 'sanitize_input',
		'transport' => 'refresh', 
	));
	$wp_customize->add_control(new social_6($wp_customize,'social_6',array(
			'section' => 'bwp-header_6',
			'settings' => [
				'social_6' => 'social_6',
			],
		)
	));
	
	//---- padding
	class Padding_topbar_6 extends WP_Customize_Control{
		public $type = 'padding_topbar_6';
		public function render_content(){ ?>
			<span class="customize-control-title"><?php echo esc_attr($this->label); ?></span>
			<table class="tg">
				<thead>
					<tr>
						<th><?php echo esc_html__('Top','mafoil') ?></th>
						<th><?php echo esc_html__('Right','mafoil') ?></th>
						<th><?php echo esc_html__('Bottom','mafoil') ?></th>
						<th><?php echo esc_html__('Left','mafoil') ?></th>
						<th></th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td><input type="<?php echo esc_attr($this->type); ?>" value="<?php echo esc_attr($this->value('padding_topbar_top_6')); ?>" <?php $this->link('padding_topbar_top_6'); ?> /></td>
						<td><input type="<?php echo esc_attr($this->type); ?>" value="<?php echo esc_attr($this->value('padding_topbar_right_6')); ?>" <?php $this->link('padding_topbar_right_6'); ?> /></td>
						<td><input type="<?php echo esc_attr($this->type); ?>" value="<?php echo esc_attr($this->value('padding_topbar_bottom_6')); ?>" <?php $this->link('padding_topbar_bottom_6'); ?> /></td>
						<td><input type="<?php echo esc_attr($this->type); ?>" value="<?php echo esc_attr($this->value('padding_topbar_left_6')); ?>" <?php $this->link('padding_topbar_left_6'); ?> /></td>
						<td>px</td>
					</tr>
				</tbody>
			</table>
		<?php }
	}
	$wp_customize->add_setting('padding_topbar_top_6', array(
		'default' => '',
		'sanitize_callback' => 'sanitize_input',
		'transport' => 'postMessage',
	));
	$wp_customize->add_setting('padding_topbar_right_6', array(
		'default' => '',
		'sanitize_callback' => 'sanitize_input',
		'transport' => 'postMessage',
	));
	$wp_customize->add_setting('padding_topbar_bottom_6', array(
		'default' => '',
		'sanitize_callback' => 'sanitize_input',
		'transport' => 'postMessage',
	));
	$wp_customize->add_setting('padding_topbar_left_6', array(
		'default' => '',
		'sanitize_callback' => 'sanitize_input',
		'transport' => 'postMessage',
	));
	$wp_customize->add_control(new Padding_topbar_6(
		$wp_customize,'padding_topbar_6',
		array(
			'label' => esc_html__('Padding topbar','mafoil'),
			'section' => 'bwp-header_6',
			'settings' => [
				'padding_topbar_top_6' => 'padding_topbar_top_6',
				'padding_topbar_right_6' => 'padding_topbar_right_6',
				'padding_topbar_bottom_6' => 'padding_topbar_bottom_6',
				'padding_topbar_left_6' => 'padding_topbar_left_6'
			],
			'type' => 'number'
		)
	));
	
	//---- logo
	class Width_logo_6 extends WP_Customize_Control{
		public $type = 'range';
		public function render_content(){ ?>
			<div class="bwp-cus-title" style="margin-top:30px;"><?php echo esc_html__('2.HEADER MAIN','mafoil') ?></div>
			<span class="customize-control-title"><?php echo esc_attr($this->label); ?></span>
			<input type="range" value="<?php echo esc_attr($this->value()); ?>" name="points" min="0" max="500" <?php $this->link(); ?>>
		<?php }
	}
	$wp_customize->add_setting( 'width_logo_6' , array(
		'default' => '',
		'sanitize_callback' => 'sanitize_input',
		'transport' => 'postMessage', 
	));
	$wp_customize->add_control(new Width_logo_6($wp_customize,'width_logo_6',array(
			'label'   => esc_html__('Logo Size','mafoil'),
			'section' => 'bwp-header_6',
		)
	));
	
	//---- background
	$wp_customize->add_setting( 'header_color_6' , array(
		'default' => '',
		'sanitize_callback' => 'sanitize_color',
		'transport' => 'postMessage', 
	));
	$wp_customize->add_control('header_color_6', array(
		'label'   => esc_html__('Background','mafoil'),
		'section' => 'bwp-header_6',
		'type'    => 'color',
	));
	
	//---- icon color
	$wp_customize->add_setting( 'icon_color_6' , array(
		'default' => '',
		'sanitize_callback' => 'sanitize_color',
		'transport' => 'postMessage', 
	));
	$wp_customize->add_control('icon_color_6', array(
		'label'   => esc_html__('Color group icon','mafoil'),
		'section' => 'bwp-header_6',
		'type'    => 'color',
	));
	
	//---- Menu color
	$wp_customize->add_setting( 'menu_color_6' , array(
		'default' => '',
		'sanitize_callback' => 'sanitize_color',
		'transport' => 'postMessage', 
	));
	$wp_customize->add_control('menu_color_6', array(
		'label'   => esc_html__('Color menu','mafoil'),
		'section' => 'bwp-header_6',
		'type'    => 'color',
	));
	
	//---- Hover color
	$wp_customize->add_setting( 'hover_color_6' , array(
		'default' => '',
		'sanitize_callback' => 'sanitize_color',
		'transport' => 'refresh', 
	));
	$wp_customize->add_control('hover_color_6', array(
		'label'   => esc_html__('Color hover','mafoil'),
		'section' => 'bwp-header_6',
		'type'    => 'color',
	));
	
	//---- padding
	class Padding_header_6 extends WP_Customize_Control{
		public $type = 'padding_6';
		public function render_content(){ ?>
			<span class="customize-control-title"><?php echo esc_attr($this->label); ?></span>
			<table class="tg">
				<thead>
					<tr>
						<th><?php echo esc_html__('Top','mafoil') ?></th>
						<th><?php echo esc_html__('Right','mafoil') ?></th>
						<th><?php echo esc_html__('Bottom','mafoil') ?></th>
						<th><?php echo esc_html__('Left','mafoil') ?></th>
						<th></th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td><input type="<?php echo esc_attr($this->type); ?>" value="<?php echo esc_attr($this->value('padding_top_6')); ?>" <?php $this->link('padding_top_6'); ?> /></td>
						<td><input type="<?php echo esc_attr($this->type); ?>" value="<?php echo esc_attr($this->value('padding_right_6')); ?>" <?php $this->link('padding_right_6'); ?> /></td>
						<td><input type="<?php echo esc_attr($this->type); ?>" value="<?php echo esc_attr($this->value('padding_bottom_6')); ?>" <?php $this->link('padding_bottom_6'); ?> /></td>
						<td><input type="<?php echo esc_attr($this->type); ?>" value="<?php echo esc_attr($this->value('padding_left_6')); ?>" <?php $this->link('padding_left_6'); ?> /></td>
						<td>px</td>
					</tr>
				</tbody>
			</table>
		<?php }
	}
	$wp_customize->add_setting('padding_top_6', array(
		'default' => '',
		'sanitize_callback' => 'sanitize_input',
		'transport' => 'postMessage',
	));
	$wp_customize->add_setting('padding_right_6', array(
		'default' => '',
		'sanitize_callback' => 'sanitize_input',
		'transport' => 'postMessage',
	));
	$wp_customize->add_setting('padding_bottom_6', array(
		'default' => '',
		'sanitize_callback' => 'sanitize_input',
		'transport' => 'postMessage',
	));
	$wp_customize->add_setting('padding_left_6', array(
		'default' => '',
		'sanitize_callback' => 'sanitize_input',
		'transport' => 'postMessage',
	));
	$wp_customize->add_control(new Padding_header_6(
		$wp_customize,'padding_6',
		array(
			'label' => esc_html__('Padding header','mafoil'),
			'section' => 'bwp-header_6',
			'settings' => [
				'padding_top_6' => 'padding_top_6',
				'padding_right_6' => 'padding_right_6',
				'padding_bottom_6' => 'padding_bottom_6',
				'padding_left_6' => 'padding_left_6'
			],
			'type' => 'number'
		)
	));
	
	///////////////HEADER 7
	$wp_customize->add_section('bwp-header_7', array(
		'title'          => 'Header 7',
		'panel' => 'header_settings_section',
	));
	
	//---- Top bar
	class Top_bar_7 extends WP_Customize_Control{
		public function enqueue(){
			wp_enqueue_style( 'custom_controls_css', get_template_directory_uri().'/customizer/css/custom_controls.css');
		}
		public $type = 'top_bar_7';
		public function render_content(){ ?>
			<div class="bwp-cus-title"><?php echo esc_html__('1.TOP BAR','mafoil') ?></div>
			<div class="filed-flex">
				<div class="cus-label"><?php echo esc_html__('Show topbar','mafoil') ?></div>
				<div class="switch-options">
					<input type="checkbox" value="<?php echo esc_attr($this->value('top_bar_7')); ?>" <?php $this->link('top_bar_7'); ?>>
					<label class="disable"></label>
				</div>
			</div>
		<?php }
	}
	
	$wp_customize->add_setting( 'top_bar_7' , array(
		'default' => '',
		'sanitize_callback' => 'sanitize_input',
		'transport' => 'refresh', 
	));
	$wp_customize->add_control(new Top_bar_7($wp_customize,'top_bar_7',array(
			'section' => 'bwp-header_7',
			'settings' => [
				'top_bar_7' => 'top_bar_7',
			],
		)
	));
	
	//---- background
	$wp_customize->add_setting( 'background_top_bar_7' , array(
		'default' => '',
		'sanitize_callback' => 'sanitize_color',
		'transport' => 'postMessage',
	));
	$wp_customize->add_control('background_top_bar_7', array(
		'label'   => esc_html__('Background','mafoil'),
		'section' => 'bwp-header_7',
		'type'    => 'color',
	));
	
	//---- color
	$wp_customize->add_setting( 'color_top_bar_7' , array(
		'default' => '',
		'sanitize_callback' => 'sanitize_color',
		'transport' => 'postMessage',
	));
	$wp_customize->add_control('color_top_bar_7', array(
		'label'   => esc_html__('Color','mafoil'),
		'section' => 'bwp-header_7',
		'type'    => 'color',
	));
	
	//---- color link
	$wp_customize->add_setting( 'color_link_top_bar_7' , array(
		'default' => '',
		'sanitize_callback' => 'sanitize_color',
		'transport' => 'postMessage',
	));
	$wp_customize->add_control('color_link_top_bar_7', array(
		'label'   => esc_html__('Color link','mafoil'),
		'section' => 'bwp-header_7',
		'type'    => 'color',
	));
	
	//---- color hover
	$wp_customize->add_setting( 'color_hover_top_bar_7' , array(
		'default' => '',
		'sanitize_callback' => 'sanitize_color',
		'transport' => 'refresh',
	));
	$wp_customize->add_control('color_hover_top_bar_7', array(
		'label'   => esc_html__('Color hover','mafoil'),
		'section' => 'bwp-header_7',
		'type'    => 'color',
	));
	
	//---- content left
	$wp_customize->add_setting( 'content_left_top_bar_7' , array(
		'default' => '',
		'sanitize_callback' => 'sanitize_input',
		'transport' => 'refresh',
	));
	$wp_customize->add_control('content_left_top_bar_7', array(
		'label'   => esc_html__('Content left','mafoil'),
		'section' => 'bwp-header_7',
		'type'    => 'textarea',
	));
	
	//---- content center
	$wp_customize->add_setting( 'content_center_top_bar_7' , array(
		'default' => '',
		'sanitize_callback' => 'sanitize_input',
		'transport' => 'refresh',
	));
	$wp_customize->add_control('content_center_top_bar_7', array(
		'label'   => esc_html__('Content center','mafoil'),
		'section' => 'bwp-header_7',
		'type'    => 'textarea',
	));
	
	//---- content right
	$wp_customize->add_setting( 'content_right_top_bar_7' , array(
		'default' => '',
		'sanitize_callback' => 'sanitize_input',
		'transport' => 'refresh',
	));
	$wp_customize->add_control('content_right_top_bar_7', array(
		'label'   => esc_html__('Content right','mafoil'),
		'section' => 'bwp-header_7',
		'type'    => 'textarea',
	));
	
	//---- social
	class social_7 extends WP_Customize_Control{
		public function enqueue(){
			wp_enqueue_style( 'custom_controls_css', get_template_directory_uri().'/customizer/css/custom_controls.css');
		}
		public $type = 'social_7';
		public function render_content(){ ?>
			<div class="filed-flex">
				<div class="cus-label"><?php echo esc_html__('Show social','mafoil') ?></div>
				<div class="switch-options">
					<input type="checkbox" value="<?php echo esc_attr($this->value('social_7')); ?>" <?php $this->link('social_7'); ?>>
					<label class="disable"></label>
				</div>
			</div>
		<?php }
	}
	
	$wp_customize->add_setting( 'social_7' , array(
		'default' => '',
		'sanitize_callback' => 'sanitize_input',
		'transport' => 'refresh', 
	));
	$wp_customize->add_control(new social_7($wp_customize,'social_7',array(
			'section' => 'bwp-header_7',
			'settings' => [
				'social_7' => 'social_7',
			],
		)
	));
	
	//---- padding
	class Padding_topbar_7 extends WP_Customize_Control{
		public $type = 'padding_topbar_7';
		public function render_content(){ ?>
			<span class="customize-control-title"><?php echo esc_attr($this->label); ?></span>
			<table class="tg">
				<thead>
					<tr>
						<th><?php echo esc_html__('Top','mafoil') ?></th>
						<th><?php echo esc_html__('Right','mafoil') ?></th>
						<th><?php echo esc_html__('Bottom','mafoil') ?></th>
						<th><?php echo esc_html__('Left','mafoil') ?></th>
						<th></th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td><input type="<?php echo esc_attr($this->type); ?>" value="<?php echo esc_attr($this->value('padding_topbar_top_7')); ?>" <?php $this->link('padding_topbar_top_7'); ?> /></td>
						<td><input type="<?php echo esc_attr($this->type); ?>" value="<?php echo esc_attr($this->value('padding_topbar_right_7')); ?>" <?php $this->link('padding_topbar_right_7'); ?> /></td>
						<td><input type="<?php echo esc_attr($this->type); ?>" value="<?php echo esc_attr($this->value('padding_topbar_bottom_7')); ?>" <?php $this->link('padding_topbar_bottom_7'); ?> /></td>
						<td><input type="<?php echo esc_attr($this->type); ?>" value="<?php echo esc_attr($this->value('padding_topbar_left_7')); ?>" <?php $this->link('padding_topbar_left_7'); ?> /></td>
						<td>px</td>
					</tr>
				</tbody>
			</table>
		<?php }
	}
	$wp_customize->add_setting('padding_topbar_top_7', array(
		'default' => '',
		'sanitize_callback' => 'sanitize_input',
		'transport' => 'postMessage',
	));
	$wp_customize->add_setting('padding_topbar_right_7', array(
		'default' => '',
		'sanitize_callback' => 'sanitize_input',
		'transport' => 'postMessage',
	));
	$wp_customize->add_setting('padding_topbar_bottom_7', array(
		'default' => '',
		'sanitize_callback' => 'sanitize_input',
		'transport' => 'postMessage',
	));
	$wp_customize->add_setting('padding_topbar_left_7', array(
		'default' => '',
		'sanitize_callback' => 'sanitize_input',
		'transport' => 'postMessage',
	));
	$wp_customize->add_control(new Padding_topbar_7(
		$wp_customize,'padding_topbar_7',
		array(
			'label' => esc_html__('Padding topbar','mafoil'),
			'section' => 'bwp-header_7',
			'settings' => [
				'padding_topbar_top_7' => 'padding_topbar_top_7',
				'padding_topbar_right_7' => 'padding_topbar_right_7',
				'padding_topbar_bottom_7' => 'padding_topbar_bottom_7',
				'padding_topbar_left_7' => 'padding_topbar_left_7'
			],
			'type' => 'number'
		)
	));
	
	//---- logo
	class Width_logo_7 extends WP_Customize_Control{
		public $type = 'range';
		public function render_content(){ ?>
			<div class="bwp-cus-title" style="margin-top:30px;"><?php echo esc_html__('2.HEADER MAIN','mafoil') ?></div>
			<span class="customize-control-title"><?php echo esc_attr($this->label); ?></span>
			<input type="range" value="<?php echo esc_attr($this->value()); ?>" name="points" min="0" max="500" <?php $this->link(); ?>>
		<?php }
	}
	$wp_customize->add_setting( 'width_logo_7' , array(
		'default' => '',
		'sanitize_callback' => 'sanitize_input',
		'transport' => 'postMessage', 
	));
	$wp_customize->add_control(new Width_logo_7($wp_customize,'width_logo_7',array(
			'label'   => esc_html__('Logo Size','mafoil'),
			'section' => 'bwp-header_7',
		)
	));
	
	//---- background
	$wp_customize->add_setting( 'header_color_7' , array(
		'default' => '',
		'sanitize_callback' => 'sanitize_color',
		'transport' => 'postMessage', 
	));
	$wp_customize->add_control('header_color_7', array(
		'label'   => esc_html__('Background','mafoil'),
		'section' => 'bwp-header_7',
		'type'    => 'color',
	));
	
	//---- icon color
	$wp_customize->add_setting( 'icon_color_7' , array(
		'default' => '',
		'sanitize_callback' => 'sanitize_color',
		'transport' => 'postMessage', 
	));
	$wp_customize->add_control('icon_color_7', array(
		'label'   => esc_html__('Color group icon','mafoil'),
		'section' => 'bwp-header_7',
		'type'    => 'color',
	));
	
	//---- Menu color
	$wp_customize->add_setting( 'menu_color_7' , array(
		'default' => '',
		'sanitize_callback' => 'sanitize_color',
		'transport' => 'postMessage', 
	));
	$wp_customize->add_control('menu_color_7', array(
		'label'   => esc_html__('Color menu','mafoil'),
		'section' => 'bwp-header_7',
		'type'    => 'color',
	));
	
	//---- Hover color
	$wp_customize->add_setting( 'hover_color_7' , array(
		'default' => '',
		'sanitize_callback' => 'sanitize_color',
		'transport' => 'refresh', 
	));
	$wp_customize->add_control('hover_color_7', array(
		'label'   => esc_html__('Color hover','mafoil'),
		'section' => 'bwp-header_7',
		'type'    => 'color',
	));
	
	//---- padding
	class Padding_header_7 extends WP_Customize_Control{
		public $type = 'padding_7';
		public function render_content(){ ?>
			<span class="customize-control-title"><?php echo esc_attr($this->label); ?></span>
			<table class="tg">
				<thead>
					<tr>
						<th><?php echo esc_html__('Top','mafoil') ?></th>
						<th><?php echo esc_html__('Right','mafoil') ?></th>
						<th><?php echo esc_html__('Bottom','mafoil') ?></th>
						<th><?php echo esc_html__('Left','mafoil') ?></th>
						<th></th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td><input type="<?php echo esc_attr($this->type); ?>" value="<?php echo esc_attr($this->value('padding_top_7')); ?>" <?php $this->link('padding_top_7'); ?> /></td>
						<td><input type="<?php echo esc_attr($this->type); ?>" value="<?php echo esc_attr($this->value('padding_right_7')); ?>" <?php $this->link('padding_right_7'); ?> /></td>
						<td><input type="<?php echo esc_attr($this->type); ?>" value="<?php echo esc_attr($this->value('padding_bottom_7')); ?>" <?php $this->link('padding_bottom_7'); ?> /></td>
						<td><input type="<?php echo esc_attr($this->type); ?>" value="<?php echo esc_attr($this->value('padding_left_7')); ?>" <?php $this->link('padding_left_7'); ?> /></td>
						<td>px</td>
					</tr>
				</tbody>
			</table>
		<?php }
	}
	$wp_customize->add_setting('padding_top_7', array(
		'default' => '',
		'sanitize_callback' => 'sanitize_input',
		'transport' => 'postMessage',
	));
	$wp_customize->add_setting('padding_right_7', array(
		'default' => '',
		'sanitize_callback' => 'sanitize_input',
		'transport' => 'postMessage',
	));
	$wp_customize->add_setting('padding_bottom_7', array(
		'default' => '',
		'sanitize_callback' => 'sanitize_input',
		'transport' => 'postMessage',
	));
	$wp_customize->add_setting('padding_left_7', array(
		'default' => '',
		'sanitize_callback' => 'sanitize_input',
		'transport' => 'postMessage',
	));
	$wp_customize->add_control(new Padding_header_7(
		$wp_customize,'padding_7',
		array(
			'label' => esc_html__('Padding header','mafoil'),
			'section' => 'bwp-header_7',
			'settings' => [
				'padding_top_7' => 'padding_top_7',
				'padding_right_7' => 'padding_right_7',
				'padding_bottom_7' => 'padding_bottom_7',
				'padding_left_7' => 'padding_left_7'
			],
			'type' => 'number'
		)
	));
	
	///////////////HEADER 8
	$wp_customize->add_section('bwp-header_8', array(
		'title'          => 'Header 8',
		'panel' => 'header_settings_section',
	));
	
	//---- Top bar
	class Top_bar_8 extends WP_Customize_Control{
		public function enqueue(){
			wp_enqueue_style( 'custom_controls_css', get_template_directory_uri().'/customizer/css/custom_controls.css');
		}
		public $type = 'top_bar_8';
		public function render_content(){ ?>
			<div class="bwp-cus-title"><?php echo esc_html__('1.TOP BAR','mafoil') ?></div>
			<div class="filed-flex">
				<div class="cus-label"><?php echo esc_html__('Show topbar','mafoil') ?></div>
				<div class="switch-options">
					<input type="checkbox" value="<?php echo esc_attr($this->value('top_bar_8')); ?>" <?php $this->link('top_bar_8'); ?>>
					<label class="disable"></label>
				</div>
			</div>
		<?php }
	}
	
	$wp_customize->add_setting( 'top_bar_8' , array(
		'default' => true, 
		'sanitize_callback' => 'sanitize_input',
		'transport' => 'refresh', 
	));
	$wp_customize->add_control(new Top_bar_8($wp_customize,'top_bar_8',array(
			'section' => 'bwp-header_8',
			'settings' => [
				'top_bar_8' => 'top_bar_8',
			],
		)
	));
	
	//---- background
	$wp_customize->add_setting( 'background_top_bar_8' , array(
		'default' => '',
		'sanitize_callback' => 'sanitize_color',
		'transport' => 'postMessage',
	));
	$wp_customize->add_control('background_top_bar_8', array(
		'label'   => esc_html__('Background','mafoil'),
		'section' => 'bwp-header_8',
		'type'    => 'color',
	));
	
	//---- color
	$wp_customize->add_setting( 'color_top_bar_8' , array(
		'default' => '',
		'sanitize_callback' => 'sanitize_color',
		'transport' => 'postMessage',
	));
	$wp_customize->add_control('color_top_bar_8', array(
		'label'   => esc_html__('Color','mafoil'),
		'section' => 'bwp-header_8',
		'type'    => 'color',
	));
	
	//---- color link
	$wp_customize->add_setting( 'color_link_top_bar_8' , array(
		'default' => '',
		'sanitize_callback' => 'sanitize_color',
		'transport' => 'postMessage',
	));
	$wp_customize->add_control('color_link_top_bar_8', array(
		'label'   => esc_html__('Color link','mafoil'),
		'section' => 'bwp-header_8',
		'type'    => 'color',
	));
	
	//---- color hover
	$wp_customize->add_setting( 'color_hover_top_bar_8' , array(
		'default' => '',
		'sanitize_callback' => 'sanitize_color',
		'transport' => 'refresh',
	));
	$wp_customize->add_control('color_hover_top_bar_8', array(
		'label'   => esc_html__('Color hover','mafoil'),
		'section' => 'bwp-header_8',
		'type'    => 'color',
	));
	
	//---- content left
	$wp_customize->add_setting( 'content_left_top_bar_8' , array(
		'default' => 'Free shipping on all orders over $50', 
		'sanitize_callback' => 'sanitize_input',
		'transport' => 'refresh',
	));
	$wp_customize->add_control('content_left_top_bar_8', array(
		'label'   => esc_html__('Content left','mafoil'),
		'section' => 'bwp-header_8',
		'type'    => 'textarea',
	));
	
	//---- content center
	$wp_customize->add_setting( 'content_center_top_bar_8' , array(
		'default' => '', 
		'sanitize_callback' => 'sanitize_input',
		'transport' => 'refresh',
	));
	$wp_customize->add_control('content_center_top_bar_8', array(
		'label'   => esc_html__('Content center','mafoil'),
		'section' => 'bwp-header_8',
		'type'    => 'textarea',
	));
	
	//---- content right
	$wp_customize->add_setting( 'content_right_top_bar_8' , array(
		'default' => '<div class="address hidden-xs"><a target="_blank" href="https://www.google.com/maps/place/lastminute.com+London+Eye/@51.503297,-0.119554,10z/data=!4m5!3m4!1s0x0:0x4291f3172409ea92!8m2!3d51.5032973!4d-0.1195537?hl=en">07 Piney Creek Rd, Scottsburg, VA, USA</a></div><div class="email"><a href="mailto:support@mafoil.com">support@mafoil.com</a></div>', 
		'sanitize_callback' => 'sanitize_input',
		'transport' => 'refresh',
	));
	$wp_customize->add_control('content_right_top_bar_8', array(
		'label'   => esc_html__('Content right','mafoil'),
		'section' => 'bwp-header_8',
		'type'    => 'textarea',
	));
	
	//---- social
	class social_8 extends WP_Customize_Control{
		public function enqueue(){
			wp_enqueue_style( 'custom_controls_css', get_template_directory_uri().'/customizer/css/custom_controls.css');
		}
		public $type = 'social_8';
		public function render_content(){ ?>
			<div class="filed-flex">
				<div class="cus-label"><?php echo esc_html__('Show social','mafoil') ?></div>
				<div class="switch-options">
					<input type="checkbox" value="<?php echo esc_attr($this->value('social_8')); ?>" <?php $this->link('social_8'); ?>>
					<label class="disable"></label>
				</div>
			</div>
		<?php }
	}
	
	$wp_customize->add_setting( 'social_8' , array(
		'default' => '',
		'sanitize_callback' => 'sanitize_input',
		'transport' => 'refresh', 
	));
	$wp_customize->add_control(new social_8($wp_customize,'social_8',array(
			'section' => 'bwp-header_8',
			'settings' => [
				'social_8' => 'social_8',
			],
		)
	));
	
	//---- padding
	class Padding_topbar_8 extends WP_Customize_Control{
		public $type = 'padding_topbar_8';
		public function render_content(){ ?>
			<span class="customize-control-title"><?php echo esc_attr($this->label); ?></span>
			<table class="tg">
				<thead>
					<tr>
						<th><?php echo esc_html__('Top','mafoil') ?></th>
						<th><?php echo esc_html__('Right','mafoil') ?></th>
						<th><?php echo esc_html__('Bottom','mafoil') ?></th>
						<th><?php echo esc_html__('Left','mafoil') ?></th>
						<th></th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td><input type="<?php echo esc_attr($this->type); ?>" value="<?php echo esc_attr($this->value('padding_topbar_top_8')); ?>" <?php $this->link('padding_topbar_top_8'); ?> /></td>
						<td><input type="<?php echo esc_attr($this->type); ?>" value="<?php echo esc_attr($this->value('padding_topbar_right_8')); ?>" <?php $this->link('padding_topbar_right_8'); ?> /></td>
						<td><input type="<?php echo esc_attr($this->type); ?>" value="<?php echo esc_attr($this->value('padding_topbar_bottom_8')); ?>" <?php $this->link('padding_topbar_bottom_8'); ?> /></td>
						<td><input type="<?php echo esc_attr($this->type); ?>" value="<?php echo esc_attr($this->value('padding_topbar_left_8')); ?>" <?php $this->link('padding_topbar_left_8'); ?> /></td>
						<td>px</td>
					</tr>
				</tbody>
			</table>
		<?php }
	}
	$wp_customize->add_setting('padding_topbar_top_8', array(
		'default' => '',
		'sanitize_callback' => 'sanitize_input',
		'transport' => 'postMessage',
	));
	$wp_customize->add_setting('padding_topbar_right_8', array(
		'default' => '',
		'sanitize_callback' => 'sanitize_input',
		'transport' => 'postMessage',
	));
	$wp_customize->add_setting('padding_topbar_bottom_8', array(
		'default' => '',
		'sanitize_callback' => 'sanitize_input',
		'transport' => 'postMessage',
	));
	$wp_customize->add_setting('padding_topbar_left_8', array(
		'default' => '',
		'sanitize_callback' => 'sanitize_input',
		'transport' => 'postMessage',
	));
	$wp_customize->add_control(new Padding_topbar_8(
		$wp_customize,'padding_topbar_8',
		array(
			'label' => esc_html__('Padding topbar','mafoil'),
			'section' => 'bwp-header_8',
			'settings' => [
				'padding_topbar_top_8' => 'padding_topbar_top_8',
				'padding_topbar_right_8' => 'padding_topbar_right_8',
				'padding_topbar_bottom_8' => 'padding_topbar_bottom_8',
				'padding_topbar_left_8' => 'padding_topbar_left_8'
			],
			'type' => 'number'
		)
	));
	
	//---- logo
	class Width_logo_8 extends WP_Customize_Control{
		public $type = 'range';
		public function render_content(){ ?>
			<div class="bwp-cus-title" style="margin-top:30px;"><?php echo esc_html__('2.HEADER MAIN','mafoil') ?></div>
			<span class="customize-control-title"><?php echo esc_attr($this->label); ?></span>
			<input type="range" value="<?php echo esc_attr($this->value()); ?>" name="points" min="0" max="500" <?php $this->link(); ?>>
		<?php }
	}
	$wp_customize->add_setting( 'width_logo_8' , array(
		'default' => '',
		'sanitize_callback' => 'sanitize_input',
		'transport' => 'postMessage', 
	));
	$wp_customize->add_control(new Width_logo_8($wp_customize,'width_logo_8',array(
			'label'   => esc_html__('Logo Size','mafoil'),
			'section' => 'bwp-header_8',
		)
	));
	
	//---- background
	$wp_customize->add_setting( 'header_color_8' , array(
		'default' => '',
		'sanitize_callback' => 'sanitize_color',
		'transport' => 'postMessage', 
	));
	$wp_customize->add_control('header_color_8', array(
		'label'   => esc_html__('Background','mafoil'),
		'section' => 'bwp-header_8',
		'type'    => 'color',
	));
	
	//---- icon color
	$wp_customize->add_setting( 'icon_color_8' , array(
		'default' => '',
		'sanitize_callback' => 'sanitize_color',
		'transport' => 'postMessage', 
	));
	$wp_customize->add_control('icon_color_8', array(
		'label'   => esc_html__('Color group icon','mafoil'),
		'section' => 'bwp-header_8',
		'type'    => 'color',
	));
	
	//---- Menu color
	$wp_customize->add_setting( 'menu_color_8' , array(
		'default' => '',
		'sanitize_callback' => 'sanitize_color',
		'transport' => 'postMessage', 
	));
	$wp_customize->add_control('menu_color_8', array(
		'label'   => esc_html__('Color menu','mafoil'),
		'section' => 'bwp-header_8',
		'type'    => 'color',
	));
	
	//---- Hover color
	$wp_customize->add_setting( 'hover_color_8' , array(
		'default' => '',
		'sanitize_callback' => 'sanitize_color',
		'transport' => 'refresh', 
	));
	$wp_customize->add_control('hover_color_8', array(
		'label'   => esc_html__('Color hover','mafoil'),
		'section' => 'bwp-header_8',
		'type'    => 'color',
	));
	
	//---- padding
	class Padding_header_8 extends WP_Customize_Control{
		public $type = 'padding_8';
		public function render_content(){ ?>
			<span class="customize-control-title"><?php echo esc_attr($this->label); ?></span>
			<table class="tg">
				<thead>
					<tr>
						<th><?php echo esc_html__('Top','mafoil') ?></th>
						<th><?php echo esc_html__('Right','mafoil') ?></th>
						<th><?php echo esc_html__('Bottom','mafoil') ?></th>
						<th><?php echo esc_html__('Left','mafoil') ?></th>
						<th></th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td><input type="<?php echo esc_attr($this->type); ?>" value="<?php echo esc_attr($this->value('padding_top_8')); ?>" <?php $this->link('padding_top_8'); ?> /></td>
						<td><input type="<?php echo esc_attr($this->type); ?>" value="<?php echo esc_attr($this->value('padding_right_8')); ?>" <?php $this->link('padding_right_8'); ?> /></td>
						<td><input type="<?php echo esc_attr($this->type); ?>" value="<?php echo esc_attr($this->value('padding_bottom_8')); ?>" <?php $this->link('padding_bottom_8'); ?> /></td>
						<td><input type="<?php echo esc_attr($this->type); ?>" value="<?php echo esc_attr($this->value('padding_left_8')); ?>" <?php $this->link('padding_left_8'); ?> /></td>
						<td>px</td>
					</tr>
				</tbody>
			</table>
		<?php }
	}
	$wp_customize->add_setting('padding_top_8', array(
		'default' => '',
		'sanitize_callback' => 'sanitize_input',
		'transport' => 'postMessage',
	));
	$wp_customize->add_setting('padding_right_8', array(
		'default' => '',
		'sanitize_callback' => 'sanitize_input',
		'transport' => 'postMessage',
	));
	$wp_customize->add_setting('padding_bottom_8', array(
		'default' => '',
		'sanitize_callback' => 'sanitize_input',
		'transport' => 'postMessage',
	));
	$wp_customize->add_setting('padding_left_8', array(
		'default' => '',
		'sanitize_callback' => 'sanitize_input',
		'transport' => 'postMessage',
	));
	$wp_customize->add_control(new Padding_header_8(
		$wp_customize,'padding_8',
		array(
			'label' => esc_html__('Padding header','mafoil'),
			'section' => 'bwp-header_8',
			'settings' => [
				'padding_top_8' => 'padding_top_8',
				'padding_right_8' => 'padding_right_8',
				'padding_bottom_8' => 'padding_bottom_8',
				'padding_left_8' => 'padding_left_8'
			],
			'type' => 'number'
		)
	));
	
	///////////////HEADER MOBILE
	$wp_customize->add_section('bwp-menu_mobile', array(
		'title'          => 'Menu mobile',
		'panel' => 'header_settings_section',
	));
	
	//---- HEADER TOP
	class Topbar_mobile extends WP_Customize_Control{
		public function enqueue(){
			wp_enqueue_style( 'custom_controls_css', get_template_directory_uri().'/customizer/css/custom_controls.css');
		}
		public $type = 'topbar_mobile';
		public function render_content(){ ?>
			<div class="bwp-cus-title"><?php echo esc_html__('1.HEADER TOP','mafoil') ?></div>
			<div class="filed-flex">
				<div class="cus-label"><?php echo esc_html__('Show topbar in mobile','mafoil') ?></div>
				<div class="switch-options">
					<input type="checkbox" value="<?php echo esc_attr($this->value('topbar_mobile')); ?>" <?php $this->link('topbar_mobile'); ?>>
					<label class="disable"></label>
				</div>
			</div>
		<?php }
	}
	
	$wp_customize->add_setting( 'topbar_mobile' , array(
		'default' => '',
		'sanitize_callback' => 'sanitize_input',
		'transport' => 'refresh', 
	));
	$wp_customize->add_control(new Topbar_mobile($wp_customize,'topbar_mobile',array(
			'section' => 'bwp-menu_mobile',
			'settings' => [
				'topbar_mobile' => 'topbar_mobile',
			],
		)
	));
	
	//---- background top
	$wp_customize->add_setting( 'background_menu_top' , array(
		'default' => '',
		'sanitize_callback' => 'sanitize_color',
		'transport' => 'postMessage',
	));
	$wp_customize->add_control('background_menu_top', array(
		'label'   => esc_html__('Background','mafoil'),
		'section' => 'bwp-menu_mobile',
		'type'    => 'color',
	));
	
	//---- Color top
	$wp_customize->add_setting( 'color_menu_top' , array(
		'default' => '',
		'sanitize_callback' => 'sanitize_color',
		'transport' => 'postMessage',
	));
	$wp_customize->add_control('color_menu_top', array(
		'label'   => esc_html__('Color','mafoil'),
		'section' => 'bwp-menu_mobile',
		'type'    => 'color',
	));
	
	//---- HEADER BOTTOM
	class Header_moble_bottom extends WP_Customize_Control{
		public function enqueue(){
			wp_enqueue_style( 'custom_controls_css', get_template_directory_uri().'/customizer/css/custom_controls.css');
		}
		public $type = 'header_moble_bottom';
		public function render_content(){ ?>
			<div class="bwp-cus-title" style="margin-top:40px;"><?php echo esc_html__('2.HEADER BOTTOM','mafoil') ?></div>
			<div class="filed-flex">
				<div class="cus-label"><?php echo esc_html__('Show menu bottom','mafoil') ?></div>
				<div class="switch-options">
					<input type="checkbox" value="<?php echo esc_attr($this->value('header_moble_bottom')); ?>" <?php $this->link('header_moble_bottom'); ?>>
					<label class="disable"></label>
				</div>
			</div>
		<?php }
	}
	
	$wp_customize->add_setting( 'header_moble_bottom' , array(
		'default' => true,
		'sanitize_callback' => 'sanitize_input',
		'transport' => 'refresh', 
	));
	$wp_customize->add_control(new Header_moble_bottom($wp_customize,'header_moble_bottom',array(
			'section' => 'bwp-menu_mobile',
			'settings' => [
				'header_moble_bottom' => 'header_moble_bottom',
			],
		)
	));
	
	//---- icon shop
	class Header_moble_shop extends WP_Customize_Control{
		public $type = 'header_moble_shop';
		public function render_content(){ ?>
			<div class="filed-flex">
				<div class="cus-label"><?php echo esc_html__('Show icon shop','mafoil') ?></div>
				<div class="switch-options">
					<input type="checkbox" value="<?php echo esc_attr($this->value('header_moble_shop')); ?>" <?php $this->link('header_moble_shop'); ?>>
					<label class="disable"></label>
				</div>
			</div>
		<?php }
	}
	
	$wp_customize->add_setting( 'header_moble_shop' , array(
		'default' => true,
		'sanitize_callback' => 'sanitize_input',
		'transport' => 'refresh', 
	));
	$wp_customize->add_control(new Header_moble_shop($wp_customize,'header_moble_shop',array(
			'section' => 'bwp-menu_mobile',
			'settings' => [
				'header_moble_shop' => 'header_moble_shop',
			],
		)
	));
	
	//---- icon account
	class Header_moble_account extends WP_Customize_Control{
		public function enqueue(){
			wp_enqueue_style( 'custom_controls_css', get_template_directory_uri().'/customizer/css/custom_controls.css');
		}
		public $type = 'header_moble_account';
		public function render_content(){ ?>
			<div class="filed-flex">
				<div class="cus-label"><?php echo esc_html__('Show icon account','mafoil') ?></div>
				<div class="switch-options">
					<input type="checkbox" value="<?php echo esc_attr($this->value('header_moble_account')); ?>" <?php $this->link('header_moble_account'); ?>>
					<label class="disable"></label>
				</div>
			</div>
		<?php }
	}
	
	$wp_customize->add_setting( 'header_moble_account' , array(
		'default' => true,
		'sanitize_callback' => 'sanitize_input',
		'transport' => 'refresh', 
	));
	$wp_customize->add_control(new Header_moble_account($wp_customize,'header_moble_account',array(
			'section' => 'bwp-menu_mobile',
			'settings' => [
				'header_moble_account' => 'header_moble_account',
			],
		)
	));
	
	//---- icon search
	class Header_moble_search extends WP_Customize_Control{
		public $type = 'header_moble_search';
		public function render_content(){ ?>
			<div class="filed-flex">
				<div class="cus-label"><?php echo esc_html__('Show icon search','mafoil') ?></div>
				<div class="switch-options">
					<input type="checkbox" value="<?php echo esc_attr($this->value('header_moble_search')); ?>" <?php $this->link('header_moble_search'); ?>>
					<label class="disable"></label>
				</div>
			</div>
		<?php }
	}
	
	$wp_customize->add_setting( 'header_moble_search' , array(
		'default' => true,
		'sanitize_callback' => 'sanitize_input',
		'transport' => 'refresh', 
	));
	$wp_customize->add_control(new Header_moble_search($wp_customize,'header_moble_search',array(
			'section' => 'bwp-menu_mobile',
			'settings' => [
				'header_moble_search' => 'header_moble_search',
			],
		)
	));
	
	//---- icon wishlist
	class Header_moble_wishlist extends WP_Customize_Control{
		public $type = 'header_moble_wishlist';
		public function render_content(){ ?>
			<div class="filed-flex">
				<div class="cus-label"><?php echo esc_html__('Show icon wishlist','mafoil') ?></div>
				<div class="switch-options">
					<input type="checkbox" value="<?php echo esc_attr($this->value('header_moble_wishlist')); ?>" <?php $this->link('header_moble_wishlist'); ?>>
					<label class="disable"></label>
				</div>
			</div>
		<?php }
	}
	
	$wp_customize->add_setting( 'header_moble_wishlist' , array(
		'default' => true,
		'sanitize_callback' => 'sanitize_input',
		'transport' => 'refresh', 
	));
	$wp_customize->add_control(new Header_moble_wishlist($wp_customize,'header_moble_wishlist',array(
			'section' => 'bwp-menu_mobile',
			'settings' => [
				'header_moble_wishlist' => 'header_moble_wishlist',
			],
		)
	));
	
	//---- background bottom
	$wp_customize->add_setting( 'background_menu_bottom' , array(
		'default' => '',
		'sanitize_callback' => 'sanitize_color',
		'transport' => 'postMessage',
	));
	$wp_customize->add_control('background_menu_bottom', array(
		'label'   => esc_html__('Background','mafoil'),
		'section' => 'bwp-menu_mobile',
		'type'    => 'color',
	));
	
	//---- Color bottom
	$wp_customize->add_setting( 'color_menu_bottom' , array(
		'default' => '',
		'sanitize_callback' => 'sanitize_color',
		'transport' => 'postMessage',
	));
	$wp_customize->add_control('color_menu_bottom', array(
		'label'   => esc_html__('Color','mafoil'),
		'section' => 'bwp-menu_mobile',
		'type'    => 'color',
	));
	
	//---- MENU MOBILE
	class Header_moble_menu extends WP_Customize_Control{
		public function enqueue(){
			wp_enqueue_style( 'custom_controls_css', get_template_directory_uri().'/customizer/css/custom_controls.css');
		}
		public $type = 'header_moble_menu';
		public function render_content(){ ?>
			<div class="bwp-cus-title" style="margin-top:40px;"><?php echo esc_html__('3.MENU MOBILE','mafoil') ?></div>
		<?php }
	}
	
	$wp_customize->add_setting( 'header_moble_menu' , array(
		'default' => '',
		'sanitize_callback' => 'sanitize_input',
		'transport' => 'refresh', 
	));
	$wp_customize->add_control(new Header_moble_menu($wp_customize,'header_moble_menu',array(
			'section' => 'bwp-menu_mobile',
			'settings' => [
				'header_moble_menu' => 'header_moble_menu',
			],
		)
	));
	
	//---- background menu
	$wp_customize->add_setting( 'background_menu_mobile' , array(
		'default' => '',
		'sanitize_callback' => 'sanitize_color',
		'transport' => 'postMessage',
	));
	$wp_customize->add_control('background_menu_mobile', array(
		'label'   => esc_html__('Background','mafoil'),
		'section' => 'bwp-menu_mobile',
		'type'    => 'color',
	));
	
	//---- Color menu
	$wp_customize->add_setting( 'color_menu_mobile' , array(
		'default' => '',
		'sanitize_callback' => 'sanitize_color',
		'transport' => 'postMessage',
	));
	$wp_customize->add_control('color_menu_mobile', array(
		'label'   => esc_html__('Color','mafoil'),
		'section' => 'bwp-menu_mobile',
		'type'    => 'color',
	));
	
	//---- Color menu hover
	$wp_customize->add_setting( 'color_menu_mobile_hover' , array(
		'default' => '',
		'sanitize_callback' => 'sanitize_color',
		'transport' => 'refresh',
	));
	$wp_customize->add_control('color_menu_mobile_hover', array(
		'label'   => esc_html__('Color hover','mafoil'),
		'section' => 'bwp-menu_mobile',
		'type'    => 'color',
	));
}
function get_custom_google_fonts() {
	update_option( 'google_font_api_key', 'AIzaSyCPdZqkQoMWMNTwdf7oDjN6sh1lwaqeJ20' );
	$api_key = get_option( 'google_font_api_key' );
    $url = 'https://www.googleapis.com/webfonts/v1/webfonts?key='.$api_key;
    $response = wp_remote_get( $url );
    $body = wp_remote_retrieve_body( $response );
    $fonts = json_decode( $body, true );
    return $fonts['items'];
}
function sanitize_color( $color ) {
    return sanitize_hex_color( $color );
}
function sanitize_input( $input ) {
    return $input;
}
function mafoil_customizer_live_preview(){
	wp_enqueue_script( 
		'mytheme-themecustomizer',
		get_template_directory_uri().'/customizer/js/customizer-preview.js',
		array( 'jquery','customize-preview' ),
		'1.0.0',
		true
	);
}
add_action( 'customize_preview_init', 'mafoil_customizer_live_preview' );
function add_scripts() {
	?>
	<script type="text/javascript">
		jQuery( function( $ ) {
			wp.customize.section( 'bwp-menu_mobile', function( section ) {
				section.expanded.bind( function( isExpanded ) {
					if ( isExpanded ) {
						$('[data-device]').removeClass('active');
						$('.wp-full-overlay').addClass('preview-mobile');
						$('[data-device = "mobile"]').addClass('active');
						$('.preview-mobile .wp-full-overlay-main').css({"margin": "auto 0 auto -187.5px", "width": "375px", "height": "80vh"});
					}
				} );
			} );
			wp.customize.section( 'bwp-menu_mobile', function( section ) {
				section.expanded.bind( function( isExpanded ) {
					if ( ! isExpanded ) {
						$('[data-device]').removeClass('active');
						$('[data-device = "desktop"]').addClass('active');
						$(".preview-mobile .wp-full-overlay-main").removeAttr("style");
						$('.wp-full-overlay').removeClass('preview-mobile');
					}
				} );
			} );
		} );
	</script>
	<?php
}
add_action( 'customize_controls_print_scripts','add_scripts' );