<?php
/**
 * Single Product tabs
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/tabs/tabs.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.8.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Filter tabs and allow third parties to add their own.
 *
 * Each tab is an array containing title, callback and priority.
 *
 * @see woocommerce_default_product_tabs()
 */
$product_tabs = apply_filters( 'woocommerce_product_tabs', array() );
$description_style 			= 	mafoil_get_config('description-style','tab');
$j = 1;
if ( ! empty( $product_tabs ) ) : ?>
	<div class="woocommerce-tabs wc-tabs-wrapper description-style-<?php echo esc_attr($description_style); ?>">
		<?php if($description_style == 'accordion'){ ?>
			<div class="content-woocommerce-tabs" id="woocommerce-tabs-accordion">
				<div class="content-tab accordion">
				<?php foreach ( $product_tabs as $key => $product_tab ) : ?>
					<div class="accordion-item">
						<a class="<?php echo esc_attr( $key ); ?>_tab" role="button"  data-parent="#woocommerce-tabs-accordion" data-toggle="collapse" href="#tab-<?php echo esc_attr( $key ); ?>" id="tab-title-<?php echo esc_attr( $key ); ?>" aria-expanded="true" aria-controls="tab-<?php echo esc_attr( $key ); ?>">
							<?php echo wp_kses_post( apply_filters( 'woocommerce_product_' . $key . '_tab_title', $product_tab['title'], $key ) ); ?>
						</a>
						<div class="panel-collapse collapse <?php if($j==1){ ?>show<?php } ?>" role="tabpanel" id="tab-<?php echo esc_attr( $key ); ?>" aria-labelledby="tab-title-<?php echo esc_attr( $key ); ?>">
							<?php
							if ( isset( $product_tab['callback'] ) ) {
								call_user_func( $product_tab['callback'], $key, $product_tab );
							}
							?>
						</div>
					</div>
				<?php $j++; endforeach; ?>
				</div>
			</div>
		<?php }elseif($description_style == 'full-content'){ ?>
			<div class="content-woocommerce-tabs">
				<div class="content-tab-woocommerce">
					<?php foreach ( $product_tabs as $key => $product_tab ) : ?>
						<h2>
							<?php echo wp_kses_post( apply_filters( 'woocommerce_product_' . $key . '_tab_title', $product_tab['title'], $key ) ); ?>
						</h2>
						<div class="container-tab">
							<div class="tab-title hidden-lg hidden-md" data-id="tab-<?php echo esc_attr( $key ); ?>">
								<?php echo wp_kses_post( apply_filters( 'woocommerce_product_' . $key . '_tab_title', $product_tab['title'], $key ) ); ?>
							</div>
							<div class="tab-content woocommerce-Tabs-panel woocommerce-Tabs-panel--<?php echo esc_attr( $key ); ?> panel entry-content wc-tab" id="tab-<?php echo esc_attr( $key ); ?>" role="tabpanel" aria-labelledby="tab-title-<?php echo esc_attr( $key ); ?>">
								<?php
									if ( isset( $product_tab['callback'] ) ) {
										call_user_func( $product_tab['callback'], $key, $product_tab );
									}
								?>
							</div>
						</div>
					<?php endforeach; ?>
				</div>
			</div>
		<?php }else{ ?>
			<div class="content-woocommerce-tabs">
				<div class="content-ul-tab">
					<ul class="tabs wc-tabs" role="tablist">
						<?php foreach ( $product_tabs as $key => $product_tab ) : ?>
							<li class="<?php echo esc_attr( $key ); ?>_tab" id="tab-title-<?php echo esc_attr( $key ); ?>" role="tab" aria-controls="tab-<?php echo esc_attr( $key ); ?>">
								<a href="#tab-<?php echo esc_attr( $key ); ?>">
									<?php echo wp_kses_post( apply_filters( 'woocommerce_product_' . $key . '_tab_title', $product_tab['title'], $key ) ); ?>
								</a>
							</li>
						<?php endforeach; ?>
					</ul>
				</div>
				<div class="content-tab">
					<?php foreach ( $product_tabs as $key => $product_tab ) : ?>
						<div class="container-tab">
							<div class="tab-title hidden-lg hidden-md" data-id="tab-<?php echo esc_attr( $key ); ?>">
								<?php echo wp_kses_post( apply_filters( 'woocommerce_product_' . $key . '_tab_title', $product_tab['title'], $key ) ); ?>
							</div>
							<div class="woocommerce-Tabs-panel woocommerce-Tabs-panel--<?php echo esc_attr( $key ); ?> panel entry-content wc-tab" id="tab-<?php echo esc_attr( $key ); ?>" role="tabpanel" aria-labelledby="tab-title-<?php echo esc_attr( $key ); ?>">
								<?php
								if ( isset( $product_tab['callback'] ) ) {
									call_user_func( $product_tab['callback'], $key, $product_tab );
								}
								?>
							</div>
						</div>
					<?php endforeach; ?>
				</div>
			</div>
		<?php } ?>
	</div>
	<?php do_action( 'woocommerce_product_after_tabs' ); ?>
<?php endif; ?>
