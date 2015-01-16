<?php

	class ServerData {

		//Solo hay que cambiar estas variables por los que pida el server
		//Todos los archivos php con conexion a base de datos usan estos valores
		
		private $name = "localhost";
		private $usu = "root";
		private $pass = "root";

		public function GetName ()
		{
			return $this->name;
		}

		public function GetUser ()
		{
			return $this->usu;
		}

		public function GetPass ()
		{
			return $this->pass;
		}
	}

?>