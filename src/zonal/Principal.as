

package zonal
{
	import flash.display.*;
	import flash.events.*;
	import flash.net.*;
	import flash.media.*;
	import flash.utils.*;
	import flash.geom.*;
	import flash.system.*;
	import com.adobe.images.JPGEncoder;
	import zonal.Datos;
	
	
	public class Principal extends MovieClip
	{
		private var g_nombre_camara:String = "";
		private var obj_datos:Datos;
		public var g_vector_objetos:Array = new Array();
		
		public function Principal():void
		{
			trace( "Ha nacido la clase principal" );
			
			if ( stage ) ini();
			else addEventListener( Event.ADDED_TO_STAGE, ini );			
		}	
		
		private function ini( e:Event = null )
		{
			mcPrincipal.mcBtnCapturarFoto.buttonMode = true;
			mcPrincipal.mcBtnCapturarFoto.mouseChildren = false;
			mcPrincipal.mcBtnCapturarFoto.addEventListener( MouseEvent.CLICK, en_clic );
			
			g_vector_objetos.push( { objeto: mcPrincipal.cmbCategorias } );
			g_vector_objetos.push( { objeto: mcPrincipal.cmbRegionales } );
			g_vector_objetos.push( { objeto: mcPrincipal.txt_salida } );
			
			colocar_camara( mcPrincipal.mcCamara );
			
			mcPrincipal.txt_salida.text = "";
			
			obj_datos = new Datos( g_vector_objetos );
			obj_datos.traer_categorias();
			obj_datos.traer_regionales();
			
		}
		
		private function en_clic( e:MouseEvent )
		{
			switch( e.target )
			{
				case mcPrincipal.mcBtnCapturarFoto:
					
						if ( g_vector_objetos[ 1 ].objeto.selectedItem.data != "-1" && g_vector_objetos[ 0 ].objeto.selectedItem.data != "-1" )
						{
							createJPG( mcPrincipal.mcCamara, 70, "foto" );
							
						}else {
									g_vector_objetos[ 2 ].objeto.text = "Por favor elija una categoría y una regional para tomar la foto. \n";
							}
					
					break;
					
				default:
		
			}
		}
		
		private function colocar_camara( contenedor:MovieClip ) 
		{ 		
			trace( Camera.names );
			
			if ( String( Camera.names ).length > 1 )
			{
				mcPrincipal.txt_salida.appendText( "Se encontró la cámara" + Camera.names + "\n" );
				
				var g_camara:Camera = Camera.getCamera(); 
				var g_vid:Video = new Video(); 
				
				g_camara.setMode( 800, 600, 15, true );
				g_camara.setQuality( 0, 80 );
				g_vid.attachCamera( g_camara ); 
				contenedor.addChild( g_vid );
				
				g_nombre_camara = String( Camera.names );
				
			}else {
					mcPrincipal.txt_salida.appendText( "No se encontró una cámara instalada. \n" );
				}
		}
		
		/**
			* Crea el jpg con las librerias de adobe
			* @mc			Es el movieclip que se ha de grabar como imagen
			* @n			Es la calidad del jpg
			* @FileName		Es el nombre del archivo jpg
		*/
		public function createJPG( mc:MovieClip, n:Number, fileName:String )
		{
			var jpgSource:BitmapData = new BitmapData ( mc.width, mc.height );
			
			jpgSource.draw( mc );
			
			var jpgEncoder:JPGEncoder = new JPGEncoder( n );
			var jpgStream:ByteArray = jpgEncoder.encode( jpgSource );
			
			var header:URLRequestHeader = new URLRequestHeader ( "Content-type", "application/octet-stream" );
			
			
			//Make sure to use the correct path to jpg_encoder_download.php
			
			fileName += retornar_momento();
			var jpgURLRequest:URLRequest = new URLRequest ( "imagenes/jpg_encoder_download.php?name=" + fileName + ".jpg" );
			
			jpgURLRequest.requestHeaders.push( header );
			jpgURLRequest.method = URLRequestMethod.POST;
			jpgURLRequest.data = jpgStream;
			
			//trace( jpgURLRequest );
			var loader:URLLoader = new URLLoader();
			//navigateToURL(jpgURLRequest, "_blank");
			loader.load( jpgURLRequest );
			
			loader.addEventListener( Event.COMPLETE, carga );
			//--
			
			mcPrincipal.txt_salida.appendText( "Se ha guardado la foto para " + g_vector_objetos[ 1 ].objeto.selectedItem.data + " " + g_vector_objetos[ 0 ].objeto.selectedItem.data );
			obj_datos.guardar_foto( g_vector_objetos[ 1 ].objeto.selectedItem.data, g_vector_objetos[ 0 ].objeto.selectedItem.data, "imagenes/" + fileName + ".jpg"  );
			
			function carga( event:Event ) 
			{						
				mcPrincipal.txt_salida.appendText( "Se ha guardado la foto.  \n" );
			}
		}
		
		function retornar_momento()
		{
			
			var cadena:String = "";
			var fecha:Date = new Date();
			
			cadena = "_" + fecha.getFullYear() + "_" + fecha.getMonth() + "_" + fecha.getDate() + "_";
			cadena += fecha.getHours() + "_" + fecha.getMinutes() + "_" + fecha.getSeconds() + "_" + Math.round( Math.random() * 10000000000 );
			
			return cadena;	
		}
	}	
}