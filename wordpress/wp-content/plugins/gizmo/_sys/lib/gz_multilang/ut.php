<?php
function gz_init_locale(){
    if(isset($_GET['lang'])){ //"lang=th or lang=en"
        $lang = $_GET['lang'];
        //if($user_id=get_current_user_id()) update_user_option($user_id,'user_lang_pref',$locale);
        //$this->is_load_theme_textdomain = false; //Clear theme textdomain flag for reloading
    }else{
        //$lang = "th";
        //if($user_id=get_current_user_id()) $locale = get_user_option('user_lang_pref',$user_id );
        $lang = isset($_COOKIE['gz_lang'])?$_COOKIE['gz_lang']:"";
    }
    gz_set_lang($lang);
}

function gz_set_lang($lang=''){
    global $locale;
    if(is_admin()) return;
    switch($lang){
        case 'en': $lang='en'; $locale='en_US'; break;
        case 'th': $lang='th'; $locale='th_TH'; break;
        default: $lang='th'; $locale='th_TH';
    }
    setcookie('gz_lang',$lang,time()+60*60*24*355); $_COOKIE['gz_lang'] = $lang;
    setcookie('wp_lang',$lang,time()+60*60*24*355); $_COOKIE['wp_lang'] = $lang;

    setcookie('gz_locale',$locale,time()+60*60*24*355); $_COOKIE['gz_locale'] = $locale;
    //if(isset($_GET['d'])) die('<pre>'.print_r(compact('locale','lang'),true));
    //if(isset($_GET['d'])) die('<pre>'.print_r(compact('locale','lang'),true));
    //switch_to_locale($locale);
    $rs = switch_to_locale('th_TH');
    //$locale = apply_filters( 'theme_locale', determine_locale() );
    //if(isset($_GET['d'])) die($locale);
    //if(isset($_GET['d'])) die('<pre>'.print_r(compact('locale','lang','rs'),true));
    //$this->load_translations();
}



function gz_after_setup_theme(){//if(isset($_GET['d'])) die(__FILE__);
    gz_init_locale();
}
add_action('after_setup_theme','gz_after_setup_theme');

