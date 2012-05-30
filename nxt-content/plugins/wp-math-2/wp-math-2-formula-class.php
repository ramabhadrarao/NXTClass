<?php
class nxt_Math_2_Formula
{
	private $_gate = 'https://chart.googleapis.com/chart';
	
	private $_params = array();
	
	private $_url;
	
	private static $_instance = null;
	
	public static function &getInstance()
	{
		if(self::$_instance)
		{
			return self::$_instance;
		}
		self::$_instance = new nxt_Math_2_Formula();
		return self::$_instance;
	}
	
	private function __construct()
	{
		$this->_params['cht'] = 'tx';
	}
	
	public function setHeight($height)
	{
		$this->_params['chs'] = $height;
	}
	
	public function setFormula($formula)
	{
		$this->_params['chl'] = urlencode($formula);
	}
	
	public function setBackground($background)
	{
		$this->_params['chf'] = "bg,s,$background";
	}
	
	public function setColor($color)
	{
		$this->_params['chco'] = $color;
	}
	
	public function getUrl()
	{
		$params = array();
		foreach($this->_params as $key => $value)
		{
			$params[] = "$key=$value";
		}
		
		$queryString = implode('&', $params);
		$this->_url = $this->_gate . '?' . $queryString;
		return $this->_url;
	}
	
	public function render()
	{
		if(!$this->_url)
		{
			$this->getUrl();
		}
		$fp = fopen($this->_url, 'r');
		$img = file_get_contents($this->_url);
		header('Content-Type: image/png');
		echo $img;
	}
}
