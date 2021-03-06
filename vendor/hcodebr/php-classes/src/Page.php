<?php 
	namespace Hcode;
	use Rain\Tpl;

	class Page {

		private $tpl;
		private $options;
		private $defaults=[
			"data"=>[]
		];

		public function __construct($opts = array(), $ptl_dir = "/views/") {

			$this->options = array_merge($this->defaults, $opts);

			$config = array(
				"tpl_dir"       => $_SERVER["DOCUMENT_ROOT"].$ptl_dir,
				"cache_dir"     => $_SERVER["DOCUMENT_ROOT"]."/views-cache/",
				"debug"         => false 
			);

			Tpl::configure( $config );

			// create the Tpl object
			$this->tpl = new Tpl;
			$this->setData($this->options["data"]);
			
			$this->tpl->draw( "header" );
		}

		public function __destruct() {

			$this->tpl->draw("footer");

		}


		private function setData($data=array(), $returnHTML=false) {
			foreach ($data as $key => $value) {
				$this->tpl->assign($key,$value);
			}
		}


		public function setTpl($name, $data=array(), $returnHTML=false) {

			$this->setData($data);
			return $this->tpl->draw($name, $returnHTML);

		}

	}

?>