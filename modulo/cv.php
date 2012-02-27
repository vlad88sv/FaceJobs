<?php
/******* paso1_personal **********/

campos::$defcampos['paso1_personal.foto_hash']['tipo'] = uiForm::$cargarImagenOWebCam;

campos::$defcampos['paso1_personal.nombres']['tipo'] = uiForm::$textoSimple;
campos::$defcampos['paso1_personal.nombres']['longitud'] = 250;
campos::$defcampos['paso1_personal.nombres']['texto'] = 'Nombres:';

campos::$defcampos['paso1_personal.apellidos']['tipo'] = uiForm::$textoSimple;
campos::$defcampos['paso1_personal.apellidos']['longitud'] = 250;
campos::$defcampos['paso1_personal.apellidos']['texto'] = 'Apellidos:';

campos::$defcampos['paso1_personal.estado_civil']['tipo'] = uiForm::$radio;
campos::$defcampos['paso1_personal.estado_civil']['valores'] = array('casado' => 'Casado','soltero' => 'Soltero','divorciado' => 'Divorciado','viudo' => 'Viudo','union libre' => 'Unión libre');
campos::$defcampos['paso1_personal.estado_civil']['texto'] = 'Estado civil:';

campos::$defcampos['paso1_personal.fecha_nacimiento']['tipo'] = uiForm::$fecha;
campos::$defcampos['paso1_personal.fecha_nacimiento']['anoLimite'] = '1994';
campos::$defcampos['paso1_personal.fecha_nacimiento']['flags'] = 'DMY';
campos::$defcampos['paso1_personal.fecha_nacimiento']['texto'] = 'Fecha de nacimiento:';

campos::$defcampos['paso1_personal.sexo']['tipo'] = uiForm::$radio;
campos::$defcampos['paso1_personal.sexo']['valores'] = array('masculino' => 'Masculino','femenino' => 'Femenino');
campos::$defcampos['paso1_personal.sexo']['texto'] = 'Sexo:';

campos::$defcampos['paso1_personal.telefono_contacto']['tipo'] = uiForm::$telefono;
campos::$defcampos['paso1_personal.telefono_contacto']['longitud'] = 50;
campos::$defcampos['paso1_personal.telefono_contacto']['texto'] = 'Teléfono de contacto:';

campos::$defcampos['paso1_personal.ID_nacionalidad']['tipo'] = uiForm::$comboboxPaises;
campos::$defcampos['paso1_personal.ID_nacionalidad']['texto'] = 'Nacionalidad:';

campos::$defcampos['paso1_personal.ciudad_de_domicilio']['tipo'] = uiForm::$textoSimple;
campos::$defcampos['paso1_personal.ciudad_de_domicilio']['texto'] = 'Ciudad de domicilio:';

campos::$defcampos['paso1_personal.direccion_domicilio']['tipo'] = uiForm::$textoSimple;
campos::$defcampos['paso1_personal.direccion_domicilio']['longitud'] = 250;
campos::$defcampos['paso1_personal.direccion_domicilio']['texto'] = 'Dirección de domicilio:';

campos::$defcampos['paso1_personal.correo_electronico']['tipo'] = uiForm::$correo;
campos::$defcampos['paso1_personal.correo_electronico']['texto'] = 'Correo electrónico:';

campos::$defcampos['paso1_personal.licencia_conducir']['tipo'] = uiForm::$sino;
campos::$defcampos['paso1_personal.licencia_conducir']['texto'] = 'Posee licencia de conducir:';

campos::$defcampos['paso1_personal.vehiculo']['tipo'] = uiForm::$sino;
campos::$defcampos['paso1_personal.vehiculo']['texto'] = 'Posee vehiculo:';

campos::$defcampos['paso1_personal.discapacidad_fisica']['tipo'] = uiForm::$sino;
campos::$defcampos['paso1_personal.discapacidad_fisica']['texto'] = 'Posee alguna discapacidad física:';

campos::$defcampos['paso1_personal.tiempo_completo']['tipo'] = uiForm::$sino;
campos::$defcampos['paso1_personal.tiempo_completo']['texto'] = 'Posee disponibilidad para un trabajo de tiempo completo:';

campos::$defcampos['paso1_personal.disponibilidad_viajar']['tipo'] = uiForm::$sino;
campos::$defcampos['paso1_personal.disponibilidad_viajar']['texto'] = 'Posee disponibilidad para viajar si es requerido:';

/******* paso2_educacion_secundaria **********/

campos::$defcampos['paso2_educacion_secundaria.ID_pais']['tipo'] = uiForm::$comboboxPaises;
campos::$defcampos['paso2_educacion_secundaria.ID_pais']['texto'] ="País:";

campos::$defcampos['paso2_educacion_secundaria.institucion']['tipo'] = uiForm::$textoSimple;
campos::$defcampos['paso2_educacion_secundaria.institucion']['longitud'] = 250;
campos::$defcampos['paso2_educacion_secundaria.institucion']['texto'] = "Institución:";

campos::$defcampos['paso2_educacion_secundaria.ano_finalizacion']['tipo'] = uiForm::$fecha;
campos::$defcampos['paso2_educacion_secundaria.ano_finalizacion']['flags'] = 'Y';
campos::$defcampos['paso2_educacion_secundaria.ano_finalizacion']['texto'] = "Año de finalización:";
campos::$defcampos['paso2_educacion_secundaria.ano_finalizacion']['enLinea'] = true;

campos::$defcampos['paso2_educacion_secundaria.incompleto']['tipo'] = uiForm::$cheque;
campos::$defcampos['paso2_educacion_secundaria.incompleto']['texto'] = 'Incompleto:';

campos::$defcampos['paso2_educacion_secundaria.titulo']['tipo'] = uiForm::$textoSimple;
campos::$defcampos['paso2_educacion_secundaria.titulo']['longitud'] = 250;
campos::$defcampos['paso2_educacion_secundaria.titulo']['texto'] = 'Titulo:';

/******* paso2_educacion_superior **********/

campos::$defcampos['paso2_educacion_superior.ID_pais']['tipo'] = uiForm::$comboboxPaises;
campos::$defcampos['paso2_educacion_superior.ID_pais']['texto'] = 'País:';

campos::$defcampos['paso2_educacion_superior.institucion']['tipo'] = uiForm::$textoSimple;
campos::$defcampos['paso2_educacion_superior.institucion']['longitud'] = 250;
campos::$defcampos['paso2_educacion_superior.institucion']['texto'] = 'Institución:';

campos::$defcampos['paso2_educacion_superior.ID_area_estudio']['tipo'] = uiForm::$comboboxComplejo;
campos::$defcampos['paso2_educacion_superior.ID_area_estudio']['datos']['tabla'] = 'datos_area_estudio';
campos::$defcampos['paso2_educacion_superior.ID_area_estudio']['datos']['clave'] = 'ID_area_estudio';
campos::$defcampos['paso2_educacion_superior.ID_area_estudio']['datos']['valor'] = 'area_estudio';
campos::$defcampos['paso2_educacion_superior.ID_area_estudio']['texto'] = 'Área de estudio:';
campos::$defcampos['paso2_educacion_superior.ID_area_estudio']['enLinea'] = true;

campos::$defcampos['paso2_educacion_superior.completo']['tipo'] = uiForm::$cheque;
campos::$defcampos['paso2_educacion_superior.completo']['texto'] = 'Completo';

campos::$defcampos['paso2_educacion_superior.titulo_obtenido']['tipo'] = uiForm::$textoSimple;
campos::$defcampos['paso2_educacion_superior.titulo_obtenido']['texto'] = 'Titulo obtenido:';

campos::$defcampos['paso2_educacion_superior.nivel_alcanzado']['tipo'] = uiForm::$comboboxComplejo;
campos::$defcampos['paso2_educacion_superior.nivel_alcanzado']['datos']['tabla'] = 'datos_nivel_estudio';
campos::$defcampos['paso2_educacion_superior.nivel_alcanzado']['datos']['clave'] = 'ID_nivel_estudio';
campos::$defcampos['paso2_educacion_superior.nivel_alcanzado']['datos']['valor'] = 'nivel_estudio';
campos::$defcampos['paso2_educacion_superior.nivel_alcanzado']['texto'] = 'Nivel alcanzado:';

campos::$defcampos['paso2_educacion_superior.fecha_desde']['tipo'] = uiForm::$fecha;
campos::$defcampos['paso2_educacion_superior.fecha_desde']['flags'] = 'Y';
campos::$defcampos['paso2_educacion_superior.fecha_desde']['texto'] = 'Fecha desde:';
//campos::$defcampos['paso2_educacion_superior.fecha_desde']['enLinea'] = true;

campos::$defcampos['paso2_educacion_superior.fecha_hasta']['tipo'] = uiForm::$fecha;
campos::$defcampos['paso2_educacion_superior.fecha_hasta']['flags'] = 'Y';
campos::$defcampos['paso2_educacion_superior.fecha_hasta']['texto'] = 'Fecha hasta:';

/* paso2_idiomas */

campos::$defcampos['paso2_idiomas.ID_idioma']['tipo'] = uiForm::$comboboxComplejo;
campos::$defcampos['paso2_idiomas.ID_idioma']['datos']['tabla'] = 'datos_idioma';
campos::$defcampos['paso2_idiomas.ID_idioma']['datos']['clave'] = 'ID_idioma';
campos::$defcampos['paso2_idiomas.ID_idioma']['datos']['valor'] = 'idioma';
campos::$defcampos['paso2_idiomas.ID_idioma']['texto'] = 'Idioma:';

campos::$defcampos['paso2_idiomas.nivel']['tipo'] = uiForm::$radio;
campos::$defcampos['paso2_idiomas.nivel']['valores'] = array('basico' => 'Básico', 'intermedio' => 'Intermedio', 'avanzado' => 'Avanzado');

/* paso2_otros_estudios */

campos::$defcampos['paso2_otros_estudios.ID_pais']['tipo'] = uiForm::$comboboxPaises;
campos::$defcampos['paso2_otros_estudios.ID_pais']['texto'] = 'País:';

campos::$defcampos['paso2_otros_estudios.institucion']['tipo'] = uiForm::$textoSimple;
campos::$defcampos['paso2_otros_estudios.institucion']['texto'] = 'Institución:';

campos::$defcampos['paso2_otros_estudios.nombre_curso']['tipo'] = uiForm::$textoSimple;
campos::$defcampos['paso2_otros_estudios.nombre_curso']['texto'] = 'Nombre del curso:';

campos::$defcampos['paso2_otros_estudios.fecha_finalizacion']['tipo'] = uiForm::$fecha;
campos::$defcampos['paso2_otros_estudios.fecha_finalizacion']['flags'] = 'Y';
campos::$defcampos['paso2_otros_estudios.fecha_finalizacion']['texto'] = 'Fecha de finalización';

/* paso3_empresa */

campos::$defcampos['paso3_empresa.ID_pais']['tipo'] = uiForm::$comboboxPaises;
campos::$defcampos['paso3_empresa.ID_pais']['texto'] = 'País:';

campos::$defcampos['paso3_empresa.nombre_empresa']['tipo'] = uiForm::$textoSimple;
campos::$defcampos['paso3_empresa.nombre_empresa']['texto'] = 'Empresa:';

campos::$defcampos['paso3_empresa.ID_actividad_economica']['tipo'] = uiForm::$comboboxComplejo;
campos::$defcampos['paso3_empresa.ID_actividad_economica']['datos']['tabla'] = 'datos_actividad_economica';
campos::$defcampos['paso3_empresa.ID_actividad_economica']['datos']['clave'] = 'ID_actividad_economica';
campos::$defcampos['paso3_empresa.ID_actividad_economica']['datos']['valor'] = 'actividad_economica';
campos::$defcampos['paso3_empresa.ID_actividad_economica']['texto'] = 'Actividad económica de la empresa:';

/* paso3_cargos */
campos::$defcampos['paso3_cargos.ID_paso3_empresa']['tipo'] = uiForm::$comboboxComplejo;
campos::$defcampos['paso3_cargos.ID_paso3_empresa']['datos']['tabla'] = 'paso3_empresa';
campos::$defcampos['paso3_cargos.ID_paso3_empresa']['datos']['clave'] = 'ID_paso3_empresa';
campos::$defcampos['paso3_cargos.ID_paso3_empresa']['datos']['valor'] = 'nombre_empresa';
campos::$defcampos['paso3_cargos.ID_paso3_empresa']['datos']['filtros']['mios'] = true;
campos::$defcampos['paso3_cargos.ID_paso3_empresa']['texto'] = 'Empresa:';
 
campos::$defcampos['paso3_cargos.ID_puesto_desempenado']['tipo'] = uiForm::$comboboxComplejo;
campos::$defcampos['paso3_cargos.ID_puesto_desempenado']['datos']['tabla'] = 'datos_area_estudio';
campos::$defcampos['paso3_cargos.ID_puesto_desempenado']['datos']['clave'] = 'ID_area_estudio';
campos::$defcampos['paso3_cargos.ID_puesto_desempenado']['datos']['valor'] = 'area_estudio';
campos::$defcampos['paso3_cargos.ID_puesto_desempenado']['texto'] = 'Puesto desempeñado:';
campos::$defcampos['paso3_cargos.ID_puesto_desempenado']['subtexto'] = 'Seleccione en la siguiente lista el puesto que mas se asemeje.';

campos::$defcampos['paso3_cargos.puesto_desempenado_detalle']['tipo'] = uiForm::$textoSimple;
campos::$defcampos['paso3_cargos.puesto_desempenado_detalle']['texto'] = 'Puesto exacto desempeñado:';
campos::$defcampos['paso3_cargos.puesto_desempenado_detalle']['subtexto'] = 'Escriba acá el puesto exacto desempeñado';

campos::$defcampos['paso3_cargos.actualmente']['tipo'] = uiForm::$cheque;
campos::$defcampos['paso3_cargos.actualmente']['texto'] = 'Se desempeña actualmente en este puesto de trabajo:';

campos::$defcampos['paso3_cargos.fecha_inicio']['tipo'] = uiForm::$fecha;
campos::$defcampos['paso3_cargos.fecha_inicio']['flags'] = 'MY';
campos::$defcampos['paso3_cargos.fecha_inicio']['texto'] = 'Fecha desde:';

campos::$defcampos['paso3_cargos.fecha_final']['tipo'] = uiForm::$fecha;
campos::$defcampos['paso3_cargos.fecha_final']['flags'] = 'MY';
campos::$defcampos['paso3_cargos.fecha_final']['texto'] = 'Fecha hasta:';

campos::$defcampos['paso3_cargos.funciones']['tipo'] = uiForm::$memo;
campos::$defcampos['paso3_cargos.funciones']['texto'] = 'Descripción de funciones desempeñadas en este cargo:';

/* paso4_expectativa_laboral */

campos::$defcampos['paso4_expectativa_laboral.ID_area_interes']['tipo'] = uiForm::$comboboxComplejo;
campos::$defcampos['paso4_expectativa_laboral.ID_area_interes']['datos']['tabla'] = 'datos_area_estudio';
campos::$defcampos['paso4_expectativa_laboral.ID_area_interes']['datos']['clave'] = 'ID_area_estudio';
campos::$defcampos['paso4_expectativa_laboral.ID_area_interes']['datos']['valor'] = 'area_estudio';
campos::$defcampos['paso4_expectativa_laboral.ID_area_interes']['texto'] = 'Área de interés:';

/* paso5_referencias_personal */

campos::$defcampos['paso5_referencias_personal.empresa']['tipo'] = uiForm::$textoSimple;
campos::$defcampos['paso5_referencias_personal.empresa']['texto'] = 'Empresa:';
campos::$defcampos['paso5_referencias_personal.empresa']['subtexto'] = 'Nombre comercial de la empresa en la que labora este contacto.';

campos::$defcampos['paso5_referencias_personal.nombre']['tipo'] = uiForm::$textoSimple;
campos::$defcampos['paso5_referencias_personal.nombre']['texto'] = 'Nombre:';
campos::$defcampos['paso5_referencias_personal.nombre']['subtexto'] = 'Nombre completo de la persona que ingresarás como referencia personal';

campos::$defcampos['paso5_referencias_personal.cargo']['tipo'] = uiForm::$textoSimple;
campos::$defcampos['paso5_referencias_personal.cargo']['texto'] = 'Cargo:';
campos::$defcampos['paso5_referencias_personal.cargo']['subtexto'] = 'Cargo que desempeña la persona que ingresarás como referencia personal';

campos::$defcampos['paso5_referencias_personal.telefono']['tipo'] = uiForm::$textoSimple;
campos::$defcampos['paso5_referencias_personal.telefono']['texto'] = 'Teléfono:';
campos::$defcampos['paso5_referencias_personal.telefono']['subtexto'] = 'Teléfono del lugar de trabajo de esta referencia personal';

/* paso5_referencias_laboral */

campos::$defcampos['paso5_referencias_laboral.ID_empresa']['tipo'] = uiForm::$comboboxComplejo;
campos::$defcampos['paso5_referencias_laboral.ID_empresa']['datos']['tabla'] = 'paso3_empresa';
campos::$defcampos['paso5_referencias_laboral.ID_empresa']['datos']['clave'] = 'ID_paso3_empresa';
campos::$defcampos['paso5_referencias_laboral.ID_empresa']['datos']['valor'] = 'nombre_empresa';
campos::$defcampos['paso5_referencias_laboral.ID_empresa']['datos']['filtros']['mios'] = true;

campos::$defcampos['paso5_referencias_laboral.ID_empresa']['texto'] = 'Empresa:';
campos::$defcampos['paso5_referencias_laboral.ID_empresa']['subtexto'] = 'Selecciona la empresa en la cual laboró con este contacto de referencia laboral';


campos::$defcampos['paso5_referencias_laboral.nombre']['tipo'] = uiForm::$textoSimple;
campos::$defcampos['paso5_referencias_laboral.nombre']['texto'] = 'Nombre:';
campos::$defcampos['paso5_referencias_laboral.nombre']['subtexto'] = 'Nombre completo de la persona que ingresarás como referencia laboral';

campos::$defcampos['paso5_referencias_laboral.cargo']['tipo'] = uiForm::$textoSimple;
campos::$defcampos['paso5_referencias_laboral.cargo']['texto'] = 'Cargo:';
campos::$defcampos['paso5_referencias_laboral.cargo']['subtexto'] = 'Cargo que desempeña la persona que ingresarás como referencia laboral';

campos::$defcampos['paso5_referencias_laboral.telefono']['tipo'] = uiForm::$textoSimple;
campos::$defcampos['paso5_referencias_laboral.telefono']['texto'] = 'Teléfono:';
campos::$defcampos['paso5_referencias_laboral.telefono']['subtexto'] = 'Teléfono del lugar de trabajo de esta referencia laboral';

/* paso6_info_adicional */

campos::$defcampos['paso6_info_adicional.categoria']['tipo'] = uiForm::$textoSimple;
campos::$defcampos['paso6_info_adicional.categoria']['texto'] = 'Nombre de categoria:';
campos::$defcampos['paso6_info_adicional.categoria']['longitud'] = 25;

campos::$defcampos['paso6_info_adicional.informacion']['tipo'] = uiForm::$memo;

/* paso7_privacidad */

campos::$defcampos['paso8_privacidad.ocultar_telefono']['tipo'] = uiForm::$radio;
campos::$defcampos['paso8_privacidad.ocultar_telefono']['valores'] = array('publico' => 'Público', 'privado' => 'Privado');
campos::$defcampos['paso8_privacidad.ocultar_telefono']['texto'] = 'Teléfono de contacto';

campos::$defcampos['paso8_privacidad.ocultar_domicilio']['tipo'] = uiForm::$radio;
campos::$defcampos['paso8_privacidad.ocultar_domicilio']['valores'] = array('publico' => 'Público', 'privado' => 'Privado');
campos::$defcampos['paso8_privacidad.ocultar_domicilio']['texto'] = 'Dirección de domicilio';

/* paso0 */

campos::$defcampos['paso0.ID_idioma_nativo']['tipo'] = uiForm::$comboboxComplejo;
campos::$defcampos['paso0.ID_idioma_nativo']['datos']['tabla'] = 'datos_idioma';
campos::$defcampos['paso0.ID_idioma_nativo']['datos']['clave'] = 'ID_idioma';
campos::$defcampos['paso0.ID_idioma_nativo']['datos']['valor'] = 'idioma';
campos::$defcampos['paso0.ID_idioma_nativo']['texto'] = 'Idioma nativo';

campos::$defcampos['paso0.ID_expectativa_salarial']['tipo'] = uiForm::$comboboxSimple;
campos::$defcampos['paso0.ID_expectativa_salarial']['texto'] = 'Rango de expectativa salarial';
campos::$defcampos['paso0.ID_expectativa_salarial']['valores'] = array(0 => 'USD \$100 - USD \$250','USD \$250 - USD \$500','USD \$500 - USD \$750','USD \$750 - USD \$1000','USD \$1000 - USD \$1500','USD \$1500 - USD \$2000','USD \$2000 - USD \$3000','> USD \$3000');
/*campos::$defcampos['paso0.video_hash'];*/

campos::$deflazo['paso1']['vistaCamposExtra'][] = '(SELECT CONCAT(DATE_FORMAT(`fecha_inicio`,"%b/%Y"), " - ", IF(actualmente,"actualidad",DATE_FORMAT(`fecha_final`,"%b/%Y"))) FROM paso3_cargos as p3c WHERE p3c.ID_paso3_empresa=t1.ID_paso3_empresa GROUP BY ID_paso3_empresa LIMIT 1) AS "fecha_compuesta"';
//campos::$deflazo['paso1']


campos::$deflazo['paso2_educacion_superior']['vistaCamposExtra'][] = 'CONCAT(`fecha_desde`, " - ", IF(completo,`fecha_hasta`,"Actualidad")) AS "fecha_compuesta"';
campos::$deflazo['paso2_educacion_superior']['vista'][0][0] = '<span class="ocre">$$fecha_compuesta$$</span>';
campos::$deflazo['paso2_educacion_superior']['vista'][0][1] = '<span class="negro">$$ID_pais_valor$$</span>';
campos::$deflazo['paso2_educacion_superior']['vista'][1][0] = '<span class="ocre">$$institucion$$</span>';
campos::$deflazo['paso2_educacion_superior']['vista'][1][1] = '<span class="gris">$$ID_area_estudio_valor$$</span>';
campos::$deflazo['paso2_educacion_superior']['vista'][1][2] = '<span class="gris">$$titulo_obtenido$$</span> [<span class="ocre">$$nivel_alcanzado_valor$$</span>]';

campos::$deflazo['paso2_educacion_superior']['campos'][] = 'paso2_educacion_superior.ID_pais';
campos::$deflazo['paso2_educacion_superior']['campos'][] = 'paso2_educacion_superior.institucion';
campos::$deflazo['paso2_educacion_superior']['campos'][] = 'paso2_educacion_superior.ID_area_estudio';
campos::$deflazo['paso2_educacion_superior']['campos'][] = 'paso2_educacion_superior.completo';
campos::$deflazo['paso2_educacion_superior']['campos'][] = 'paso2_educacion_superior.titulo_obtenido';
campos::$deflazo['paso2_educacion_superior']['campos'][] = 'paso2_educacion_superior.nivel_alcanzado';
campos::$deflazo['paso2_educacion_superior']['campos'][] = 'paso2_educacion_superior.fecha_desde';
campos::$deflazo['paso2_educacion_superior']['campos'][] = 'paso2_educacion_superior.fecha_hasta';

campos::$deflazo['paso2_idiomas']['vista']['class'] = 'lazoVistaPeque';
campos::$deflazo['paso2_idiomas']['vista'][0][0] = '<span class="gris">$$ID_idioma_valor$$</span>';
campos::$deflazo['paso2_idiomas']['vista'][0][1] = '<span class="ocre">$$nivel_valor$$</span>';

campos::$deflazo['paso2_idiomas']['campos'][] = 'paso2_idiomas.ID_idioma';
campos::$deflazo['paso2_idiomas']['campos'][] = 'paso2_idiomas.nivel';

campos::$deflazo['paso2_otros_estudios']['vista'][0][0] = '<span class="ocre">$$fecha_finalizacion$$</span>';
campos::$deflazo['paso2_otros_estudios']['vista'][0][1] = '<span class="negro">$$ID_pais_valor$$</span>';
campos::$deflazo['paso2_otros_estudios']['vista'][1][0] = '<span class="ocre">$$institucion$$</span>';
campos::$deflazo['paso2_otros_estudios']['vista'][1][1] = '$$nombre_curso$$';

campos::$deflazo['paso2_otros_estudios']['campos'][] = 'paso2_otros_estudios.ID_pais';
campos::$deflazo['paso2_otros_estudios']['campos'][] = 'paso2_otros_estudios.institucion';
campos::$deflazo['paso2_otros_estudios']['campos'][] = 'paso2_otros_estudios.nombre_curso';
campos::$deflazo['paso2_otros_estudios']['campos'][] = 'paso2_otros_estudios.fecha_finalizacion';

campos::$deflazo['paso3_empresa']['vistaUniones'][] = 'paso3_cargos';
campos::$deflazo['paso3_empresa']['vistaCamposExtra'][] = '(SELECT CONCAT(MIN(DATE_FORMAT(STR_TO_DATE(CONCAT(`fecha_inicioMes`,",",`fecha_inicioAno`),"%m,%Y"),"%b/%Y")), " - ", IF(actualmente,"actualidad",DATE_FORMAT(STR_TO_DATE(CONCAT(`fecha_finalMes`,",",`fecha_finalAno`),"%m,%Y"),"%b/%Y"))) FROM paso3_cargos as p3c WHERE p3c.ID_paso3_empresa=t1.ID_paso3_empresa GROUP BY p3c.ID_paso3_empresa LIMIT 1) AS "fecha_compuesta"';
campos::$deflazo['paso3_empresa']['vista'][0][0] = '<span class="ocre">$$fecha_compuesta$$</span>';
campos::$deflazo['paso3_empresa']['vista'][1][0] = '<span class="negro">$$ID_pais_valor$$</span>';
campos::$deflazo['paso3_empresa']['vista'][2][0] = '<span class="ocre">$$nombre_empresa$$</span>';
campos::$deflazo['paso3_empresa']['vista'][2][1] = 'Actividad económica de la empresa: <span class="negro">$$ID_actividad_economica_valor$$</span>';

campos::$deflazo['paso3_empresa']['campos'][] = 'paso3_empresa.ID_pais';
campos::$deflazo['paso3_empresa']['campos'][] = 'paso3_empresa.nombre_empresa';
campos::$deflazo['paso3_empresa']['campos'][] = 'paso3_empresa.ID_actividad_economica';

campos::$deflazo['paso3_cargos']['vistaVirtual'] = true;
campos::$deflazo['paso3_cargos']['vistaVirtualRemota'] = 'paso3_empresa';
campos::$deflazo['paso3_cargos']['vistaCamposExtra'][] = 'CONCAT(DATE_FORMAT(STR_TO_DATE(CONCAT(`fecha_inicioMes`,",",`fecha_inicioAno`),"%m,%Y"),"%b/%Y"), " - ", IF(actualmente,"actualidad",DATE_FORMAT(STR_TO_DATE(CONCAT(`fecha_finalMes`,",",`fecha_finalAno`),"%m,%Y"),"%b/%Y"))) AS "fecha_compuesta"';
campos::$deflazo['paso3_cargos']['vista'][0][0] = '<span class="ocre">$$fecha_compuesta$$</span>';
campos::$deflazo['paso3_cargos']['vista'][1][0] = '<span class="gris">Puesto desempeñado:</span>';
campos::$deflazo['paso3_cargos']['vista'][2][0] = '<span class="negro">$$puesto_desempenado_detalle$$</span>';

campos::$deflazo['paso3_cargos']['campos'][] = 'paso3_cargos.ID_paso3_empresa';
campos::$deflazo['paso3_cargos']['campos'][] = 'paso3_cargos.ID_puesto_desempenado';
campos::$deflazo['paso3_cargos']['campos'][] = 'paso3_cargos.puesto_desempenado_detalle';
campos::$deflazo['paso3_cargos']['campos'][] = 'paso3_cargos.actualmente';
campos::$deflazo['paso3_cargos']['campos'][] = 'paso3_cargos.fecha_inicio';
campos::$deflazo['paso3_cargos']['campos'][] = 'paso3_cargos.fecha_final';
campos::$deflazo['paso3_cargos']['campos'][] = 'paso3_cargos.funciones';

campos::$deflazo['paso4_expectativa_laboral']['vista']['class'] = 'lazoVistaPeque';
campos::$deflazo['paso4_expectativa_laboral']['vista'][0][0] = '<span class="ocre">$$ID_area_interes_valor$$</span>';
campos::$deflazo['paso4_expectativa_laboral']['campos'][] = 'paso4_expectativa_laboral.ID_area_interes';


campos::$deflazo['paso5_referencias_laboral']['vistaCamposExtra'][] = '(SELECT pais FROM datos_pais AS dp WHERE dp.ID_pais = (SELECT ID_pais FROM paso3_empresa AS p3e WHERE p3e.ID_paso3_empresa = t1.ID_empresa )) AS "pais_valor"';
campos::$deflazo['paso5_referencias_laboral']['vistaCamposExtra'][] = '(SELECT actividad_economica FROM datos_actividad_economica AS dae WHERE dae.ID_actividad_economica = (SELECT ID_actividad_economica FROM paso3_empresa AS p3e WHERE p3e.ID_paso3_empresa = t1.ID_empresa )) AS "ID_actividad_economica_valor"';
campos::$deflazo['paso5_referencias_laboral']['vista'][0][0] = '$$pais_valor$$';
campos::$deflazo['paso5_referencias_laboral']['vista'][0][1] = 'Nombre:';
campos::$deflazo['paso5_referencias_laboral']['vista'][0][2] = 'Teléfono:';
campos::$deflazo['paso5_referencias_laboral']['vista'][0][3] = 'Cargo:';
campos::$deflazo['paso5_referencias_laboral']['vista'][1][0] = '<span class="ocre">$$ID_empresa_valor$$</span>';
campos::$deflazo['paso5_referencias_laboral']['vista'][1][1] = '<span class="negro">$$nombre$$</span>';
campos::$deflazo['paso5_referencias_laboral']['vista'][1][2] = '<span class="negro">$$telefono$$</span>';
campos::$deflazo['paso5_referencias_laboral']['vista'][1][3] = '<span class="negro">$$cargo$$</span>';
campos::$deflazo['paso5_referencias_laboral']['vista'][2][0] = '<span class="gris">Actividad económica de la empresa</span>';
campos::$deflazo['paso5_referencias_laboral']['vista'][3][0] = '<span class="negro">$$ID_actividad_economica_valor$$</span>';

campos::$deflazo['paso5_referencias_laboral']['campos'][] = 'paso5_referencias_laboral.ID_empresa';
campos::$deflazo['paso5_referencias_laboral']['campos'][] = 'paso5_referencias_laboral.nombre';
campos::$deflazo['paso5_referencias_laboral']['campos'][] = 'paso5_referencias_laboral.cargo';
campos::$deflazo['paso5_referencias_laboral']['campos'][] = 'paso5_referencias_laboral.telefono';

campos::$deflazo['paso5_referencias_personal']['vista'][0][1] = 'Nombre:';
campos::$deflazo['paso5_referencias_personal']['vista'][0][2] = 'Teléfono:';
campos::$deflazo['paso5_referencias_personal']['vista'][0][3] = 'Cargo:';
campos::$deflazo['paso5_referencias_personal']['vista'][0][4] = 'Empresa:';
campos::$deflazo['paso5_referencias_personal']['vista'][1][1] = '<span class="negro">$$nombre$$</span>';
campos::$deflazo['paso5_referencias_personal']['vista'][1][2] = '<span class="negro">$$telefono$$</span>';
campos::$deflazo['paso5_referencias_personal']['vista'][1][3] = '<span class="negro">$$cargo$$</span>';
campos::$deflazo['paso5_referencias_personal']['vista'][1][4] = '<span class="negro">$$empresa$$</span>';

campos::$deflazo['paso5_referencias_personal']['campos'][] = 'paso5_referencias_personal.empresa';
campos::$deflazo['paso5_referencias_personal']['campos'][] = 'paso5_referencias_personal.nombre';
campos::$deflazo['paso5_referencias_personal']['campos'][] = 'paso5_referencias_personal.cargo';
campos::$deflazo['paso5_referencias_personal']['campos'][] = 'paso5_referencias_personal.telefono';

campos::$deflazo['paso6_info_adicional']['vista']['class'] = 'lazoVistaPeque';
campos::$deflazo['paso6_info_adicional']['vista'][0][0] = '$$categoria$$';
campos::$deflazo['paso6_info_adicional']['campos'][] = 'paso6_info_adicional.categoria';
campos::$deflazo['paso6_info_adicional']['campos'][] = 'paso6_info_adicional.informacion';

campos::$deflazo['paso6_info_adicional_vista']['paraTabla'] = 'paso6_info_adicional';
campos::$deflazo['paso6_info_adicional_vista']['vista'][0][0] = '<h2>$$categoria$$</h2>';
campos::$deflazo['paso6_info_adicional_vista']['vista'][0][1] = '$$informacion$$';
campos::$deflazo['paso6_info_adicional_vista']['campos'][] = 'paso6_info_adicional.categoria';
campos::$deflazo['paso6_info_adicional_vista']['campos'][] = 'paso6_info_adicional.informacion';
?>