

package zonal
{
	import flash.events.*;
	import flash.net.URLLoader;
	import flash.net.URLRequest;
	import flash.net.URLVariables;
	import flash.net.URLLoaderDataFormat;
	import flash.net.URLRequestMethod;
	import flash.text.*;
	
	public class Datos
	{
		private var g_direccion = ""; // "http://localhost/PROYECTOS/SENA/zonal-regional/v1/deploy/";
		public var g_vector_objetos:Array = new Array();
		
		public function Datos( vector:Array ):void
		{
			trace( "Ha nacido la clase datos." );
			g_vector_objetos = vector;
			//embeberEnCombos();  //Esta linea funciona pero no se implementa.
		}
		
		public function traer_categorias()
		{
			var url_peticion:URLRequest = new URLRequest ( g_direccion + "traer_categorias.php" );
			url_peticion.method = URLRequestMethod.POST;
			
			var url_variables:URLVariables = new URLVariables();
			//url_variables.id_actividad_periodo = id_actividad_periodo;
						
			url_peticion.data = url_variables;
			
			var cargador:URLLoader = new URLLoader ( url_peticion );
			
			cargador.addEventListener( Event.COMPLETE, al_traer_categorias );
			
			cargador.dataFormat = URLLoaderDataFormat.VARIABLES;
			cargador.load( url_peticion );
		}
		
		public function al_traer_categorias( e:Event ):void
		{
			var cadena:String = "";
			var vector:Array;
			var i:Number = 0;
			
			//trace( "Retornando actividades proyecto " + e.target.data.error );
			
			cadena = e.target.data.error;
			vector = cadena.split( "<|r|>" );  //Sacamos cada registro, que también es el mismo campo.
			
			g_vector_objetos[ 0 ].objeto.removeAll();
			g_vector_objetos[ 0 ].objeto.addItem( { label: "Seleccione", data: "-1" } );
			
			for ( i = 0; i < vector.length; i ++ )
			{
				if ( String( vector[ i ] ).length >= 2 )
				{
					g_vector_objetos[ 0 ].objeto.addItem( { label: vector[ i ], data: vector[ i ] } );
				}
				
				//trace( vector[ i ] );
			}
		}
		
		public function traer_regionales()
		{
			var url_peticion:URLRequest = new URLRequest ( g_direccion + "traer_regionales.php" );
			url_peticion.method = URLRequestMethod.POST;
			
			var url_variables:URLVariables = new URLVariables();
			//url_variables.id_actividad_periodo = id_actividad_periodo;
						
			url_peticion.data = url_variables;
			
			var cargador:URLLoader = new URLLoader ( url_peticion );
			
			cargador.addEventListener( Event.COMPLETE, al_traer_regionales );
			
			cargador.dataFormat = URLLoaderDataFormat.VARIABLES;
			cargador.load( url_peticion );
		}
		
		public function al_traer_regionales( e:Event ):void
		{
			var cadena:String = "";
			var vector:Array;
			var i:Number = 0;
			
			//trace( "Retornando actividades proyecto " + e.target.data.error );
			
			cadena = e.target.data.error;
			vector = cadena.split( "<|r|>" );  //Sacamos cada registro, que también es el mismo campo.
			
			g_vector_objetos[ 1 ].objeto.removeAll();
			g_vector_objetos[ 1 ].objeto.addItem( { label: "Seleccione", data: "-1" } );
			
			for ( i = 0; i < vector.length; i ++ )
			{
				if ( String( vector[ i ] ).length >= 2 )
				{
					g_vector_objetos[ 1 ].objeto.addItem( { label: vector[ i ], data: vector[ i ] } );
				}
				
				//trace( vector[ i ] );
			}
		}
		
		public function guardar_foto( nombre_region:String, categoria:String, url:String )
		{
			var url_peticion:URLRequest = new URLRequest ( g_direccion + "guardar_foto.php" );
			url_peticion.method = URLRequestMethod.POST;
			
			var url_variables:URLVariables = new URLVariables();
			url_variables.nombre_region = nombre_region;
			url_variables.categoria 	= categoria;
			url_variables.url 			= url;
						
			url_peticion.data = url_variables;
			
			var cargador:URLLoader = new URLLoader ( url_peticion );
			
			cargador.addEventListener( Event.COMPLETE, al_guardar_foto );
			
			cargador.dataFormat = URLLoaderDataFormat.VARIABLES;
			cargador.load( url_peticion );
		}
		
		public function al_guardar_foto( e:Event ):void
		{			
			g_vector_objetos[ 2 ].objeto.text = e.target.data.error; 
		}
		
		function embeberEnCombos()
		{
			
			var font:Fuente_1 = new Fuente_1();
			var myTextFormat:TextFormat = new TextFormat();
			
			myTextFormat.font = font.fontName;
			myTextFormat.color = 0x996600;
			myTextFormat.size = 12;		
			
			/*
			
			cbCategories.dropdown.setRendererStyle( "textFormat" , myTextFormat ) ; 
			cbCategories.textField.setStyle ("textFormat",myTextFormat);
			
			
			cbCategories.setStyle("embedFonts", true);
			cbCategories.textField.setStyle("embedFonts", true);*/
			
			// embed fonts in dropdown menu
			g_vector_objetos[ 0 ].objeto.dropdown.setRendererStyle("textFormat", myTextFormat);
			g_vector_objetos[ 0 ].objeto.dropdown.setRendererStyle("embedFonts", true);
			
			// embed fonts in main text field
			g_vector_objetos[ 0 ].objeto.textField.setStyle("textFormat", myTextFormat);
			g_vector_objetos[ 0 ].objeto.textField.setStyle("embedFonts", true);
			
			
			// embed fonts in dropdown menu
			g_vector_objetos[ 1 ].objeto.dropdown.setRendererStyle("textFormat", myTextFormat);
			g_vector_objetos[ 1 ].objeto.dropdown.setRendererStyle("embedFonts", true);
			
			// embed fonts in main text field
			g_vector_objetos[ 1 ].objeto.textField.setStyle("textFormat", myTextFormat);
			g_vector_objetos[ 1 ].objeto.textField.setStyle("embedFonts", true);

		}
	}
}