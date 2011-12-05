<?php
/*
 * Definen como opera cada paso (que tabla, que campo, que restricciones).
 * defcv = Definicion de Curriculum Vitae
 */

/******* paso1_personal **********/

cv::$defcv['paso1_personal.foto_hash']['tipo'] = uiForm::$cargarImagenOWebCam;

cv::$defcv['paso1_personal.nombres']['tipo'] = uiForm::$textoSimple;
cv::$defcv['paso1_personal.nombres']['longitud'] = 250;
cv::$defcv['paso1_personal.nombres']['texto'] = 'Nombres:';

cv::$defcv['paso1_personal.apellidos']['tipo'] = uiForm::$textoSimple;
cv::$defcv['paso1_personal.apellidos']['longitud'] = 250;
cv::$defcv['paso1_personal.apellidos']['texto'] = 'Apellidos:';

cv::$defcv['paso1_personal.estado_civil']['tipo'] = uiForm::$comboboxSimple;
cv::$defcv['paso1_personal.estado_civil']['valores'] = array('casado','soltero','divorciado','viudo','union libre');
cv::$defcv['paso1_personal.estado_civil']['texto'] = 'Estado civil:';

cv::$defcv['paso1_personal.fecha_nacimiento']['tipo'] = uiForm::$fecha;
cv::$defcv['paso1_personal.fecha_nacimiento']['flags'] = 'DMY';
cv::$defcv['paso1_personal.fecha_nacimiento']['texto'] = 'Fecha de nacimiento:';

cv::$defcv['paso1_personal.sexo']['tipo'] = uiForm::$comboboxSimple;
cv::$defcv['paso1_personal.sexo']['valores'] = array('masculino','femenino');
cv::$defcv['paso1_personal.sexo']['texto'] = 'Sexo:';

cv::$defcv['paso1_personal.telefono_contacto']['tipo'] = uiForm::$telefono;
cv::$defcv['paso1_personal.telefono_contacto']['longitud'] = 50;
cv::$defcv['paso1_personal.telefono_contacto']['texto'] = 'Teléfono de contacto:';

cv::$defcv['paso1_personal.ID_nacionalidad']['tipo'] = uiForm::$comboboxPaises;
cv::$defcv['paso1_personal.ID_nacionalidad']['texto'] = 'Nacionalidad:';

cv::$defcv['paso1_personal.ID_ciudad_de_domicilio']['tipo'] = uiForm::$comboboxPaises;
cv::$defcv['paso1_personal.ID_ciudad_de_domicilio']['texto'] = 'Ciudad de domicilio:';

cv::$defcv['paso1_personal.direccion_domicilio']['tipo'] = uiForm::$textoSimple;
cv::$defcv['paso1_personal.direccion_domicilio']['longitud'] = 250;
cv::$defcv['paso1_personal.direccion_domicilio']['texto'] = 'Dirección de domicilio:';

cv::$defcv['paso1_personal.correo_electronico']['tipo'] = uiForm::$correo;
cv::$defcv['paso1_personal.correo_electronico']['texto'] = 'Correo electrónico:';

cv::$defcv['paso1_personal.licencia_conducir']['tipo'] = uiForm::$sino;
cv::$defcv['paso1_personal.licencia_conducir']['texto'] = 'Posee licencia de conducir:';

cv::$defcv['paso1_personal.vehiculo']['tipo'] = uiForm::$sino;
cv::$defcv['paso1_personal.vehiculo']['texto'] = 'Posee vehiculo:';

cv::$defcv['paso1_personal.discapacidad_fisica']['tipo'] = uiForm::$sino;
cv::$defcv['paso1_personal.discapacidad_fisica']['texto'] = 'Posee alguna discapacidad física:';


/******* paso2_educacion_secundaria **********/

cv::$defcv['paso2_educacion_secundaria.ID_pais']['tipo'] = uiForm::$comboboxPaises;
cv::$defcv['paso2_educacion_secundaria.ID_pais']['texto'] ="País:";

cv::$defcv['paso2_educacion_secundaria.institucion']['tipo'] = uiForm::$textoSimple;
cv::$defcv['paso2_educacion_secundaria.institucion']['longitud'] = 250;
cv::$defcv['paso2_educacion_secundaria.institucion']['texto'] = "Institución:";

cv::$defcv['paso2_educacion_secundaria.ano_finalizacion']['tipo'] = uiForm::$fecha;
cv::$defcv['paso2_educacion_secundaria.ano_finalizacion']['flags'] = 'Y';
cv::$defcv['paso2_educacion_secundaria.ano_finalizacion']['texto'] = "Año de finalización:";
cv::$defcv['paso2_educacion_secundaria.ano_finalizacion']['enLinea'] = true;

cv::$defcv['paso2_educacion_secundaria.incompleto']['tipo'] = uiForm::$cheque;
cv::$defcv['paso2_educacion_secundaria.incompleto']['texto'] = 'Incompleto:';

cv::$defcv['paso2_educacion_secundaria.titulo']['tipo'] = uiForm::$textoSimple;
cv::$defcv['paso2_educacion_secundaria.titulo']['longitud'] = 250;
cv::$defcv['paso2_educacion_secundaria.titulo']['texto'] = 'Titulo:';
/******* paso2_educacion_superior **********/

cv::$defcv['paso2_educacion_superior.ID_pais']['tipo'] = uiForm::$comboboxPaises;
cv::$defcv['paso2_educacion_superior.ID_pais']['texto'] = 'País:';

cv::$defcv['paso2_educacion_superior.institucion']['tipo'] = uiForm::$textoSimple;
cv::$defcv['paso2_educacion_superior.institucion']['longitud'] = 250;
cv::$defcv['paso2_educacion_superior.institucion']['texto'] = 'Institución:';

cv::$defcv['paso2_educacion_superior.ID_area_estudio']['tipo'] = uiForm::$comboboxComplejo;
cv::$defcv['paso2_educacion_superior.ID_area_estudio']['datos']['tabla'] = 'datos_area_estudio';
cv::$defcv['paso2_educacion_superior.ID_area_estudio']['datos']['clave'] = 'ID_area_estudio';
cv::$defcv['paso2_educacion_superior.ID_area_estudio']['datos']['valor'] = 'area_estudio';
cv::$defcv['paso2_educacion_superior.ID_area_estudio']['texto'] = 'Área de estudio:';
cv::$defcv['paso2_educacion_superior.ID_area_estudio']['enLinea'] = true;

cv::$defcv['paso2_educacion_superior.completo']['tipo'] = uiForm::$cheque;
cv::$defcv['paso2_educacion_superior.completo']['texto'] = 'Completo';

cv::$defcv['paso2_educacion_superior.titulo_obtenido']['tipo'] = uiForm::$textoSimple;
cv::$defcv['paso2_educacion_superior.titulo_obtenido']['texto'] = 'Titulo obtenido:';

cv::$defcv['paso2_educacion_superior.nivel_alcanzado']['tipo'] = uiForm::$comboboxSimple;
cv::$defcv['paso2_educacion_superior.nivel_alcanzado']['valores'] = array('activo','abandonado','egresado','graduado','doctorado','PhD');
cv::$defcv['paso2_educacion_superior.nivel_alcanzado']['texto'] = 'Nivel alcanzado';

cv::$defcv['paso2_educacion_superior.fecha_desde']['tipo'] = uiForm::$fecha;
cv::$defcv['paso2_educacion_superior.fecha_desde']['flags'] = 'Y';
cv::$defcv['paso2_educacion_superior.fecha_desde']['texto'] = 'Desde';

cv::$defcv['paso2_educacion_superior.fecha_hasta']['tipo'] = uiForm::$fecha;
cv::$defcv['paso2_educacion_superior.fecha_hasta']['flags'] = 'Y';
cv::$defcv['paso2_educacion_superior.fecha_hasta']['texto'] = 'Hasta';

/* paso2_idiomas */

cv::$defcv['paso2_idiomas.ID_idioma']['tipo'] = uiForm::$comboboxComplejo;
cv::$defcv['paso2_idiomas.ID_idioma']['datos']['tabla'] = 'datos_idiomas';
cv::$defcv['paso2_idiomas.ID_idioma']['datos']['clave'] = 'ID_idioma';
cv::$defcv['paso2_idiomas.ID_idioma']['datos']['valor'] = 'idioma';


cv::$defcv['paso2_idiomas.nivel']['tipo'] = uiForm::$radio;
cv::$defcv['paso2_idiomas.nivel']['valores'] = array('basico', 'intermedio', 'avanzado');
/* paso2_otros_estudios */

cv::$defcv['paso2_otros_estudios.ID_pais']['tipo'] = uiForm::$comboboxPaises;

cv::$defcv['paso2_otros_estudios.institucion'] = uiForm::$textoSimple;

cv::$defcv['paso2_otros_estudios.nombre_curso'] = uiForm::$textoSimple;

cv::$defcv['paso2_otros_estudios.fecha_finalizacion']= uiForm::$fecha;
cv::$defcv['paso2_otros_estudios.fecha_finalizacion']['flags'] = 'Y';

/* paso3_cargos */
/*
cv::$defcv['paso3_cargos.ID_paso3_empresa'];
cv::$defcv['paso3_cargos.ID_puesto_desempenado'];
cv::$defcv['paso3_cargos.puesto_desempenado_detalle'];
cv::$defcv['paso3_cargos.actualmente'];
cv::$defcv['paso3_cargos.fecha_inicio'];
cv::$defcv['paso3_cargos.fecha_final'];
cv::$defcv['paso3_cargos.funciones'];
*/

/* paso3_empresa */
/*
cv::$defcv['paso3_empresa.ID_pais'];
cv::$defcv['paso3_empresa.ID_empresa'];
cv::$defcv['paso3_empresa.ID_actividad_economica'];
cv::$defcv['paso3_empresa.nombre_empresa'];
*/
/* paso4_expectativa_laboral */
/*
cv::$defcv['paso4_expectativa_laboral.ID_area_interes'];
*/

/* paso5_referencias */
/*
cv::$defcv['paso5_referencias.empresa'];
cv::$defcv['paso5_referencias.nombre'];
cv::$defcv['paso5_referencias.cargo'];
cv::$defcv['paso5_referencias.telefono'];
cv::$defcv['paso5_referencias.tipo'];
*/
/* paso6_info_adicional */
/*
cv::$defcv['paso6_info_adicional.categoria'];
cv::$defcv['paso6_info_adicional.informacion'];
*/
/* paso7_privacidad */
/*
cv::$defcv['paso7_privacidad.ocultar_telefono'];
cv::$defcv['paso7_privacidad.ocultar_domicilio'];
*/

/* paso0 */

cv::$defcv['paso0.ID_idioma_nativo']['tipo'] = uiForm::$comboboxComplejo;
cv::$defcv['paso0.ID_idioma_nativo']['datos']['tabla'] = 'datos_idiomas';
cv::$defcv['paso0.ID_idioma_nativo']['datos']['clave'] = 'ID_idioma';
cv::$defcv['paso0.ID_idioma_nativo']['datos']['valor'] = 'idioma';

/*cv::$defcv['paso0.ID_expectativa_salarial'];*/
/*cv::$defcv['paso0.video_hash'];*/

cv::$deflazo['paso2_educacion_superior']['vista']['sql'] = '';
cv::$deflazo['paso2_educacion_superior']['vista'][0][0] = '$$fecha_agrupada$$';
cv::$deflazo['paso2_educacion_superior']['vista'][1][0] = '<img src="$$imgBandera$$" />';
cv::$deflazo['paso2_educacion_superior']['vista'][2][0] = '$$institucion$$';
cv::$deflazo['paso2_educacion_superior']['vista'][2][1] = '$$ID_area_estudio$$';
cv::$deflazo['paso2_educacion_superior']['vista'][2][2] = '<span class="vista_titulo_obtenido">$$titulo_obtenido$$</span> <span class="vista_nivel_alcanzado">$$nivel_alcanzado$$</span>';

cv::$deflazo['paso2_educacion_superior']['campos'][] = 'paso2_educacion_superior.ID_pais';
cv::$deflazo['paso2_educacion_superior']['campos'][] = 'paso2_educacion_superior.institucion';
cv::$deflazo['paso2_educacion_superior']['campos'][] = 'paso2_educacion_superior.ID_area_estudio';
cv::$deflazo['paso2_educacion_superior']['campos'][] = 'paso2_educacion_superior.completo';
cv::$deflazo['paso2_educacion_superior']['campos'][] = 'paso2_educacion_superior.titulo_obtenido';
cv::$deflazo['paso2_educacion_superior']['campos'][] = 'paso2_educacion_superior.nivel_alcanzado';
cv::$deflazo['paso2_educacion_superior']['campos'][] = 'paso2_educacion_superior.fecha_desde';
cv::$deflazo['paso2_educacion_superior']['campos'][] = 'paso2_educacion_superior.fecha_hasta';

class cv
{
    public static $defcv = array();
    public static $deflazo = array();
    
    function cv ($ID_cuenta)
    {
       
    }    
    
    public function guardar()
    {
        
    }
}

function AgregarCampos(&$defpaso, $paso, &$defcv, array $camposDefCv)
{
    foreach($camposDefCv as $campo)
        if (isset(cv::$defcv[$campo]))
            $defpaso[$paso][$campo] = cv::$defcv[$campo];
        else
            depurar::registrar('Asignación errónea de campo "'.$campo.'" a paso',errores::$critico,'AgregarCampos');
}

?>