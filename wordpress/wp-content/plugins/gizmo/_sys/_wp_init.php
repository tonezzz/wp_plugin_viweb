<?php
//die(__FILE__);

/*
//For woocommerce import
define('ALLOW_UNFILTERED_UPLOADS', true);
add_filter( 'upload_mimes', function() {
  $mimes = [
    'svg' => 'image/svg+xml',
    'jpg|jpeg' => 'image/jpeg',
    'png' => 'image/png',
  ];
  return $mimes;
});
//For woocommerce import
*/

require dirname(__FILE__) .'/lib/gz_ut_v0.03.php';

gz_load_module_2(['action'=>'load','type'=>'lib0','name'=>'gz_tpl','version'=>'v0.14','init'=>true]);
gz_load_module_2(['action'=>'load','type'=>'lib','name'=>'gz_multilang','version'=>'','init'=>true]);

//gz_load_module_2(['action'=>'load','type'=>'lib0','name'=>'gz_facebook','version'=>'v0.02','init'=>true]);

//gz_load_module_2(['action'=>'load' ,'type'=>'tpl','name'=>'mv_block','version'=>'v2.00','init'=>true]);

//gz_load_module_2(['action'=>'load','type'=>'fix','name'=>'mv_fix_lang','version'=>'','init'=>true]);
//gz_load_module_2(['action'=>'load' ,'type'=>'lib','name'=>'mv_gen_image','version'=>'v2.00','init'=>true]);

function gz_svg_mime_type( $mimes = array() ) {
  $mimes['svg']  = 'image/svg+xml';
  $mimes['svgz'] = 'image/svg+xml';
  return $mimes;
}
add_filter( 'upload_mimes', 'gz_svg_mime_type' );   