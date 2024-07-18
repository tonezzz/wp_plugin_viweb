<?php
	function wpbingo_social_link_shortcode( $args, $content ) {
	global $mafoil_settings;	
	$content = '<ul class="social-link">';
		$link_tiktok = (isset($mafoil_settings['link-tiktok']) && $mafoil_settings['link-tiktok']) ? ($mafoil_settings['link-tiktok']) : '';
		if($link_tiktok)
			$content .= '<li><a href="'.esc_url($mafoil_settings['link-tiktok']).'"><i class="icon-tiktok"></i></a></li>';
		if($mafoil_settings['link-tw'])
			$content .= '<li><a href="'.esc_url($mafoil_settings['link-tw']).'"><i class="icon-x-twitter"></i></a></li>';
		if($mafoil_settings['link-instagram'])
			$content .= '<li><a href="'.esc_url($mafoil_settings['link-instagram']).'"><i class="fa fa-instagram"></i></a></li>';
		if($mafoil_settings['link-fb'])
			$content .= '<li><a href="'.esc_url($mafoil_settings['link-fb']).'"><i class="fa fa-facebook"></i></a></li>';
		if($mafoil_settings['link-youtube'])
			$content .= '<li><a href="'.esc_url($mafoil_settings['link-youtube']).'"><i class="fa fa-youtube"></i></a></li>';
		if($mafoil_settings['link-dribbble'])
			$content .= '<li><a href="'.esc_url($mafoil_settings['link-dribbble']).'"><i class="fa fa-dribbble"></i></a></li>';
		if($mafoil_settings['link-behance'])
			$content .= '<li><a href="'.esc_url($mafoil_settings['link-behance']).'"><i class="fa fa-behance"></i></a></li>';
		if($mafoil_settings['link-linkedin'])
			$content .= '<li><a href="'.esc_url($mafoil_settings['link-linkedin']).'"><i class="fa fa-linkedin"></i></a></li>';
		if($mafoil_settings['link-whatapp'])
			$content .= '<li><a href="'.esc_url($mafoil_settings['link-whatapp']).'"><i class="fa fa-whatsapp"></i></a></li>';
		if($mafoil_settings['link-pinterest'])
			$content .= '<li><a href="'.esc_url($mafoil_settings['link-pinterest']).'"><i class="fa fa-pinterest"></i></a></li>';
	$content .= '</ul>';
	return $content; 
	}
	add_shortcode('social_link', 'wpbingo_social_link_shortcode');
	
	function wpbingo_social_share_shortcode() {
		global $post,$mafoil_settings;
		
		if (!$mafoil_settings['social-share']) return false;
		
		$permalinked = urlencode(get_permalink($post->ID));
		$permalink = get_permalink($post->ID);
		$title = urlencode($post->post_title);
		$stitle = $post->post_title;
		$image = esc_url(wp_get_attachment_url( get_post_thumbnail_id() ));
		
		$data = '<div class="social-share">';
			
		if ($mafoil_settings['share-fb']) {
			$data .='<a href="http://www.facebook.com/sharer.php?u='.esc_url($permalink).'&i='.esc_url($image).'" title="'. esc_attr__('Facebook', 'wpbingo').'" class="share-facebook" target="_blank"><i class="fa fa-facebook"></i></a>';
		}			
		if ($mafoil_settings['share-tw']) {
			$data .='<a href="https://twitter.com/intent/tweet?url='.esc_url($permalink).'"  title="'. esc_attr__('Twitter', 'wpbingo').'" class="share-twitter">'. esc_html__('', 'wpbingo').'<i class="icon-x-twitter"></i></a>';
		}
		if ($mafoil_settings['share-linkedin']) {
			$data .='<a href="https://www.linkedin.com/shareArticle?mini=true&amp;url='.esc_url($permalink).'"  title="'. esc_attr__('LinkedIn', 'wpbingo').'" class="share-linkedin">'. esc_html__('', 'wpbingo').'<i class="fa fa-linkedin"></i></a>';
		}
		if ($mafoil_settings['share-pinterest']) {
			$data .= '<a href="https://pinterest.com/pin/create/button/?url='.esc_url($permalink).'&amp;media='.esc_url($image).'"  title="'. esc_attr__('Pinterest', 'wpbingo').'" class="share-pinterest">'. esc_html__('', 'wpbingo').'<i class="fa fa-pinterest"></i></a>';
		}
		$data .= '</div>';
		return $data;

	}
	add_shortcode('social_share', 'wpbingo_social_share_shortcode');