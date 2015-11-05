<?php
   class  Conexion
   {
      private $Servidor;
      private $Puerto;
      private $Nombre;
      private $Usuario;
      private $Clave;
	  
      function __construct($Servidor,$Puerto,$Nombre,$Usuario,$Clave)
      {
		
         $this->Servidor = $Servidor;
         $this->Puerto = $Puerto;
         $this->Nombre = $Nombre;
         $this->Usuario = $Usuario;
         $this->Clave = $Clave;
      }

      function Conectar()
      {
         $connect=pg_connect("host=$this->Servidor port=$this->Puerto dbname=$this->Nombre user=$this->Usuario password=$this->Clave")or die('<div width="100%" class="error">OCURRIO UN ERROR AL INTENTAR CONECTAR A LA BASE DE DATOS <B>'.$this->Nombre.' </B></div>');
         return $connect;
      }

      function Consulta($Consulta)
      {
         $Valor=$this->Conectar();
         if(!$Valor)
            return 0; //Si no se pudo conectar
         else
         {
            //Valor es resultado de base de dato y Consulta es la Consulta a realizar
            $Resultado = pg_query( $Valor, $Consulta );
			
			//Cerrando conexion
			pg_close ( $Valor );
			// retorna si fue afectada una fila
            return $Resultado;
         }
      }

	  function cerrarConexion()
      {
         pg_close( $connect );
      }
   }
?>