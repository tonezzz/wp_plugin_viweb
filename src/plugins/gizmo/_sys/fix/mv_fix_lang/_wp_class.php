<?php
/*
* 20230103 1539 - B4 import fix (Varlexar) DB Backup.
* mv_fix_lang() class.
*	- Fix language fields from Valexar to Poly lang.
* 	- Must use with gz_polylang.
* v0.00/20221230:Tony
*	- Add excerpt module
*/
class mv_fix_lang extends gz_tpl{
	public function __construct(){
		$config = [
			'shortcodes' => [
				['prm'=>['mv_gen_prod_csv',[$this,'mv_gen_prod_csv']]],
				['prm'=>['mv_fix_lang',[$this,'mv_fix_lang']]],
			],
		];
		parent::__construct($config);
	}

	function mv_gen_prod_csv(){
		$r_en = ['size','1,000cc.'];
		$r_th = ['ขนาด','1 ลิตร'];
		$query = ['post_type'	=>'product'];

		$wp_query = new WP_Query($query);
		$html = '';
		$items = [];
		foreach($wp_query->posts as $post){
			$title = $post->post_title;
			$excerpt = $post->post_excerpt;
			$content = $post->post_content;
			$items[$post->ID] = [
				'ID'	=> $post->ID,
				//'title'	=> $title,
				'title_th'	=> str_replace($r_en,$r_th,GZ()->modules['gz_multilang']->valexar_text_lang($title,'th',$title)),
				'title_en'	=> str_replace($r_th,$r_en,GZ()->modules['gz_multilang']->valexar_text_lang($title,'en',$title)),
				//'excerpt'	=> $excerpt,
				'excerpt_th'	=> str_replace($r_en,$r_th,GZ()->modules['gz_multilang']->valexar_text_lang($excerpt,'th',$excerpt)),
				'excerpt_en'	=> str_replace($r_th,$r_en,GZ()->modules['gz_multilang']->valexar_text_lang($excerpt,'en',$excerpt)),
				//'post_content'	=> $content,
				'content_th'	=> str_replace($r_en,$r_th,GZ()->modules['gz_multilang']->valexar_text_lang($content,'th',$content)),
				'content_en'	=> str_replace($r_th,$r_en,GZ()->modules['gz_multilang']->valexar_text_lang($content,'en',$content)),
			];
		}
		$html.= $this->show_table($items);
		if(isset($_GET['csv'])) $html.= $this->save_csv($items);
		return $html;
	}

	function mv_fix_lang($atts,$content=null){
		return $this->mv_fix_lang_csv($atts,$content);
	}

	function mv_fix_lang_csv($atts,$content=null){
		//$atts = shortcode_atts([
		//],$atts,'mv_fix_excerpt');
		//extract($atts, EXTR_PREFIX_ALL,'att');
		$r_en = ['size','1,000cc.'];
		$r_th = ['ขนาด','1 ลิตร'];
		$query = new WP_Query(['post_type'	=>'product']);
		$html = '';
		$updates = [];
		//$updates[] = ['title','title_th','title_en','excerpt_th','excerpt_en','content_th','content_en'];
		//$updates[] = ['id','title','title_th','title_en'];
		foreach($query->posts as $post){
			$title = $post->post_title;
			$excerpt = $post->post_excerpt;
			$content = $post->post_content;
			$updates[$post->ID] = [
				'ID'	=> $post->ID,
				'title'	=> $title,
				'title_th'	=> str_replace($r_en,$r_th,GZ()->modules['gz_polylang']->valexar_text_lang($title,'th',$title)),
				'title_en'	=> str_replace($r_th,$r_en,GZ()->modules['gz_polylang']->valexar_text_lang($title,'en',$title)),
				//'excerpt_th'	=> str_replace($r_en,$r_th,GZ()->modules['gz_polylang']->valexar_text_lang($excerpt,'th',$excerpt)),
				//'excerpt_en'	=> str_replace($r_th,$r_en,GZ()->modules['gz_polylang']->valexar_text_lang($excerpt,'en',$excerpt)),
				//'content_th'	=> str_replace($r_en,$r_th,GZ()->modules['gz_polylang']->valexar_text_lang($content,'th',$content)),
				//'content_en'	=> str_replace($r_th,$r_en,GZ()->modules['gz_polylang']->valexar_text_lang($content,'en',$content)),
			];
		}
		$this->update_posts($updates);
		$html.= $this->show_table($updates);
		if(isset($_GET['csv'])) $html.= $this->save_csv($updates);
		//$html.= $this->show_data($query->posts);
		return $html;
	}

	function update_posts($updates){
		$posts = [];
		foreach($updates as $id=>$update){
			$posts[] = [
				'ID'				=> $id,
				'post_title'		=> $update['title_th'],
				'meta_input'		=> [
					'title_en' => $update['title_en'],
				]
			];
		} //die('<pre>'.print_r($posts,true));
		foreach($posts as $post) wp_update_post($post);
	}

	function show_table($data){
		$html = '';
		$html = "<style>";
		$html.= "table.bb {max-width: none !important; width:100% !important; margin:0 !important; rowspacing=0 cellspacing=0; padding: 0; border-spacing: 0; }";
		$html.= "table.bb tr {}";
		$html.= "table.bb td {display: table-cell; vertical-align: top; border: 1px solid #ccc;}";
		$html.= "</style>";
		$html.= "<table class='bb'>";
		foreach($data as $row){
			$html.= "<tr>";
			foreach($row as $item){
				$html.= "<td>";
				$html.= "{$item}";
				$html.= "</td>";
			}
			$html.= "</tr>";
		}
		$html.= "</table>";
		return $html;
	}

	function show_data($data){
		$html = "<style>";
		$html.= ".bb {rowspacing=0 cellspacing=0; padding: 0; border-spacing: 0; border: 1px solid #ccc; vertical-align: top;}";
		//$html.= ".td {display: table-cell; vertical-align: top;}";
		$html.= "</style>";
		$html.= "<table class='bb'>";
		//$html.= "<tr class='bb'><td colspan='2' class='bb'>Data</td></tr>"; 
		if(is_object($data) || is_array($data)){
			foreach($data as $key=>$val){
				$html.= "<tr class='bb'>";
				$html.= "<td class='bb'>{$key}</td><td class='bb'>{$this->show_data($val)}</td>";
				$html.= "<tr>";
			}
		}else{
				$html.= "<tr class='bb'><td class='bb'>";
				$html.= wp_strip_all_tags($data);
				$html.= "</td></tr>";
		}
		$html.= "</table>";
		return $html;
	}

	//////////////////////////////
	function save_csv($rows){
		$rs = [];
		$rs[] = [
			'ID',
			'Name',
			'Short description',
			'Description',
			'Meta: _post_title_en',
			'Meta: _post_excerpt_en',
			'Meta: _post_content_en',
		];
		foreach($rows as $id=>$post){
			$rs[] = [
				$id,
				$post['title_th'],
				$this->encode_csv($post['excerpt_th']),
				$this->encode_csv($post['content_th']),
				$this->encode_csv($post['title_en']),
				$this->encode_csv($post['excerpt_en']),
				$this->encode_csv($post['content_en']),
			];
		}
		
		//Save to file
		$fname = wp_upload_dir()['path'].'prod.csv'; $file = fopen($fname,'w');	foreach($rs as $row) fputcsv($file,$row); fclose($file);

		//$txt = '';
		//foreach($rs as $row) $txt .= implode(',',$row) . "\n";
		//file_put_contents($fname,$txt);
		$html = '';
		$html.= "<pre>".print_r($rs,true)."</pre>";
		$html.= "<p>{$fname}</p>";
		return $html;
	}


	//function encode_csv($txt){ return htmlentities( $txt ); } //This way, Html tags doesn't work.
	function encode_csv($txt){
		//$src = ["\n","\t","\r",'"'];
		//$dst = ['\n','\t','\r','\"'];
		$src = ["\n","\r"]; $dst = ['',''];
		return str_replace($src,'',$txt);
		//return htmlentities( $txt );
	}

}