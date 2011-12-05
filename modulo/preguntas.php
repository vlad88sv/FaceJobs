<?php
class preguntas
{
    /*
     __construct($tabla, $ID, $grupo)
     Crear un recurso de preguntas
     $tabla: Tabla de preguntas
     $ID: ID de la cuenta
     $grupo: para asociar las preguntas de un mismo tipo
    */
    
    private $recurso;
    
    function __construct($tablaDatos, $ID_cuenta, $grupo)
    {
        
    }
    
    function __destruct()
    {
       // Vaciar el recurso de memcached
    }

    /*
     crearPregunta($contexto,$clave,$titulo,$tipo,$parametros)
        Fabrica de preguntas
        Contexto: paso en el que se utiliza la pregunta
        Clave: identificador unico de la pregunta
        Titulo: etiqueta de la pregunta - pasa por _($titulo)
        Tipo: [texto|imagenOwebcam|imagen|cheque|radio|telefono|lista|sino]
        Parametros: [_tbl_fuente|orientacion|_rango[]|_valores[]]
    */
    public function crear($clave, $titulo, $tipo, $parametros)
    {
        
    }
    
    /*
     verPregunta($contexto,$clave,$titulo)
        Visualización de determinada pregunta - desde memcached()
     */
    public function ver($clave)
    {
        
    }
    
    /*
     cargarPreguntas($ID)
     Carga las preguntas del candidato - memcached().
    */
    public function cargar()
    {
        
    }
}
?>