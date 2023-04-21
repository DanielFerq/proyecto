<?php

class errors extends controllers
{

	public function __construct()
	{
		parent::__construct();
	}

	public function notFound()
	{
		//AL NO ECONTRAR LA PAGINA ARROJA ESTO VIEW POR DEFECTO
		$this->views->getview($this, "error-view");
	}
}

$notFound = new errors();
$notFound->notFound();

?>