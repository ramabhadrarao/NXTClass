<?php
/*
File name: paginate.php
Description: Paginate class for nxtclass admin pages
Version: 1.0
*/

class paginate {
	
	private $options = array();
	private $nav = '';
	private $limit;
	
	function __construct($options){
		$this->options = array_merge(array(
			'total'			=>	0,
			'nr_per_page'	=>	25,
			'between'		=>	3,
			'qs'			=>	'pages'
		),$options);
		
		$get = 1;
		if(isset($_GET[$this->options['qs']])) $get = (int) $_GET[$this->options['qs']];
		
		if(isset($get) && !empty($get)){
			$limit_x = (($get-1)*$this->options['nr_per_page']);
		}else{
			$limit_x = 0;
		}
		
		$this->limit = $limit_x.','.$this->options['nr_per_page'];
		$this->options['pages'] = ceil($this->options['total']/$this->options['nr_per_page']);
		$last = $this->options['pages'];
		$this->options['current_page'] = $limit_x/$this->options['nr_per_page']+1;
		$start = 1;
		$stop = $this->options['current_page'] + $this->options['between'];
		if($this->options['current_page'] > $this->options['between']) $start = $this->options['current_page'] - $this->options['between'];
		if($this->options['pages'] < $stop) $stop = $this->options['pages'];
		
		if($this->options['total'] > $this->options['nr_per_page']){
			
			$nav = '<span class="pages">'.__('Page', 'huddle').' '.($this->options['current_page']).' '.__('of', 'huddle').' '.$this->options['pages'].'</span> ';
			
			$gets = array();
			foreach($_GET as $gk=>$gv){
				if($gk != $this->options['qs']) array_push($gets,$gk.'='.$gv);
			}

			$base_url = current(explode('?', $_SERVER['REQUEST_URI'])).'?'.implode('&',$gets);

			if($limit_x != 0) $nav .= '<a class="previouspostslink" href="'. add_query_arg( 'pages', $get - 1 ) .'"><span>&larr; '.__('Previous', 'huddle').'</span></a> ';

			for($nr = $start; $nr <= $stop; $nr++ ){
				if($limit_x != ($nr-1)*$this->options['nr_per_page'])
					$nav .= '<a class="page" href="'. add_query_arg( 'pages', $nr ) .'"><span>'.$nr.'</span></a> ';
				else
					$nav .= '<span class="current"><span>'.$nr.'</span></span> ';
			}

			if($get != $last) $nav .= '<a class="nextpostslink" href="'. add_query_arg( 'pages', $get + 1 ) .'"><span>'.__('Next', 'huddle').' &rarr;</span></a> ';

			$this->nav = $nav;
		}
		
	}
	
	function nav(){
		return '<div class="nxt-pagenavi">'.$this->nav.'</div>';
	}
	
	function limit(){
		return $this->limit;
	}
	
	function get($i){
		if($this->options[$i]) return $this->options[$i];
		return false;
	}
	
}
