<?php 
	namespace Hcode;
	use Rain\Tpl;

	class Page {

		private $tpl;
		private $options;
		private $defaults=[
			"data"=>[]
		];

		public function __construct($opts=array()) {

			$this->options = array_merge($this->defaults, $opts);

			$config = array(
				"tpl_dir"       => $_SERVER["DOCUMENT_ROOT"]."/meussistemas/ecommerce/views/",
				"cache_dir"     => $_SERVER["DOCUMENT_ROOT"]."/meussistemas/ecommerce/views-cache/",
				"debug"         => false 
			);

			Tpl::configure( $config );

			// create the Tpl object
			$this->tpl = new Tpl;
			$this->setData($this->options["data"]);
			

			// assign a variable
			//$tpl->assign( "name", "Obi Wan Kenoby" );

			// assign an array
			//$tpl->assign( "week", array( "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday" ) );

			// draw the template
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