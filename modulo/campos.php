<?php
// http://facejobs.org/ofertas.html | Búsqueda como candidato
campos::$defcampos['paso0.tipo_busqueda']['tipo'] = uiForm::$radio;
campos::$defcampos['paso0.tipo_busqueda']['valores'] = array('0' => 'Recientes', '1' => 'Acorde a mi hoja de vida', '2' => 'búsqueda avanzada');

campos::$defcampos['paso0.busqueda_ocultar_vistas']['tipo'] = uiForm::$cheque;
campos::$defcampos['paso0.busqueda_ocultar_vistas']['texto'] = "ocultar ofertas vistas";
campos::$defcampos['paso0.busqueda_ocultar_vistas']['enLinea'] = true;

campos::$defcampos['paso0.busqueda_ocultar_aplicadas']['tipo'] = uiForm::$cheque;
campos::$defcampos['paso0.busqueda_ocultar_aplicadas']['texto'] = "ocultar ofertas aplicadas";
campos::$defcampos['paso0.busqueda_ocultar_aplicadas']['enLinea'] = true;

campos::$defcampos['paso0.busqueda_ocultar_anonimas']['tipo'] = uiForm::$cheque;
campos::$defcampos['paso0.busqueda_ocultar_anonimas']['texto'] = "ocultar empresas anónimas";
campos::$defcampos['paso0.busqueda_ocultar_anonimas']['enLinea'] = true;

campos::$defcampos['buscar_actividad_economica_empresa.ID_actividad_economica']['tipo'] = uiForm::$comboboxComplejo;
campos::$defcampos['buscar_actividad_economica_empresa.ID_actividad_economica']['datos']['tabla'] = 'datos_actividad_economica';
campos::$defcampos['buscar_actividad_economica_empresa.ID_actividad_economica']['datos']['clave'] = 'ID_actividad_economica';
campos::$defcampos['buscar_actividad_economica_empresa.ID_actividad_economica']['datos']['valor'] = 'actividad_economica';
campos::$defcampos['buscar_actividad_economica_empresa.ID_actividad_economica']['texto'] = 'Actividad económica de la empresa:';

campos::$deflazo['buscar_actividad_economica_empresa']['vista']['class'] = 'lazoVistaPeque';
campos::$deflazo['buscar_actividad_economica_empresa']['vista'][0][0] = '$$ID_actividad_economica_valor$$';
campos::$deflazo['buscar_actividad_economica_empresa']['campos'][] = 'buscar_actividad_economica_empresa.ID_actividad_economica';

// Areas de interes
campos::$defcampos['buscar_areas_interes.ID_area_interes']['tipo'] = uiForm::$comboboxComplejo;
campos::$defcampos['buscar_areas_interes.ID_area_interes']['datos']['tabla'] = 'datos_area_interes';
campos::$defcampos['buscar_areas_interes.ID_area_interes']['datos']['clave'] = 'ID_area_interes';
campos::$defcampos['buscar_areas_interes.ID_area_interes']['datos']['valor'] = 'area_interes';
campos::$defcampos['buscar_areas_interes.ID_area_interes']['texto'] = 'Área de interés';

campos::$deflazo['buscar_areas_interes']['vista']['class'] = 'lazoVistaPeque';
campos::$deflazo['buscar_areas_interes']['vista'][0][0] = '$$ID_area_interes_valor$$';
campos::$deflazo['buscar_areas_interes']['campos'][] = 'buscar_areas_interes.ID_area_interes';

// Pais
campos::$deflazo['buscar_pais']['vista']['class'] = 'lazoVistaPeque';
campos::$deflazo['buscar_pais']['vista'][0][0] = '$$ID_pais_valor$$';
campos::$deflazo['buscar_pais']['campos'][] = 'buscar_pais.ID_pais';

campos::$defcampos['buscar_pais.ID_pais']['tipo'] = uiForm::$comboboxPaises;
campos::$defcampos['buscar_pais.ID_pais']['texto'] = 'País:';

// Palabras clave
campos::$deflazo['buscar_palabras_claves']['vista']['class'] = 'lazoVistaPeque';
campos::$deflazo['buscar_palabras_claves']['vista'][0][0] = '$$palabra_clave$$';
campos::$deflazo['buscar_palabras_claves']['campos'][] = 'buscar_palabras_claves.palabra_clave';

campos::$defcampos['buscar_palabras_claves.palabra_clave']['tipo'] = uiForm::$textoSimple;
campos::$defcampos['buscar_palabras_claves.palabra_clave']['texto'] = 'Palabra clave:';

// Registro de empresas
campos::$defcampos['empresa_registro.foto_hash']['tipo'] = uiForm::$cargarImagenOWebCam;

campos::$defcampos['empresa_registro.nombre_legal']['tipo'] = uiForm::$textoSimple;
campos::$defcampos['empresa_registro.nombre_legal']['texto'] = 'Nombre legal de la empresa';

campos::$defcampos['empresa_registro.nombre_comercial']['tipo'] = uiForm::$textoSimple;
campos::$defcampos['empresa_registro.nombre_comercial']['texto'] = 'Nombre comercial de la empresa';

campos::$defcampos['empresa_registro.pagina_web']['tipo'] = uiForm::$textoSimple;
campos::$defcampos['empresa_registro.pagina_web']['texto'] = 'Pagina web de la empresa';

campos::$defcampos['empresa_registro.telefono_empresa']['tipo'] = uiForm::$telefono;
campos::$defcampos['empresa_registro.telefono_empresa']['texto'] = 'Telefono de la empresa';

campos::$defcampos['empresa_registro.identificador_fiscal']['tipo'] = uiForm::$textoSimple;
campos::$defcampos['empresa_registro.identificador_fiscal']['texto'] = 'Identificador fiscal';

// Paises de domicilio //
campos::$defcampos['empresa_pais.ID_pais']['tipo'] = uiForm::$comboboxComplejo;
campos::$defcampos['empresa_pais.ID_pais']['datos']['tabla'] = 'datos_pais';
campos::$defcampos['empresa_pais.ID_pais']['datos']['clave'] = 'ID_pais';
campos::$defcampos['empresa_pais.ID_pais']['datos']['valor'] = 'pais';
campos::$defcampos['empresa_pais.ID_pais']['texto'] = 'Pai(ses) de domicilio:';
campos::$defcampos['empresa_pais.ID_pais']['subtexto'] = 'Se le cobrará mensualmente en base al número de paises seleccionados.';

campos::$deflazo['empresa_pais']['vista'][0][0] = '<span class="ocre">$$ID_pais_valor$$</span>';
campos::$deflazo['empresa_pais']['vista']['class'] = 'lazoVistaPeque';
campos::$deflazo['empresa_pais']['campos'][] = 'empresa_pais.ID_pais';
// ------------------ //

// Actividad economica de la empresa //
campos::$defcampos['empresa_actividad_economica.ID_actividad_economica']['tipo'] = uiForm::$comboboxComplejo;
campos::$defcampos['empresa_actividad_economica.ID_actividad_economica']['datos']['tabla'] = 'datos_actividad_economica';
campos::$defcampos['empresa_actividad_economica.ID_actividad_economica']['datos']['clave'] = 'ID_actividad_economica';
campos::$defcampos['empresa_actividad_economica.ID_actividad_economica']['datos']['valor'] = 'actividad_economica';
campos::$defcampos['empresa_actividad_economica.ID_actividad_economica']['texto'] = 'Actividad económica de la empresa:';
campos::$defcampos['empresa_actividad_economica.ID_actividad_economica']['subtexto'] = 'Ingrese todas las actividades económicas a las que pertenezca la empresa, pulsando el botón agregar cada vez que desees.';

campos::$deflazo['empresa_actividad_economica']['vista'][0][0] = '<span class="ocre">$$ID_actividad_economica_valor$$</span>';
campos::$deflazo['empresa_actividad_economica']['vista']['class'] = 'lazoVistaPeque';
campos::$deflazo['empresa_actividad_economica']['campos'][] = 'empresa_actividad_economica.ID_actividad_economica';
// ------------------ //

campos::$defcampos['empresa_registro.contacto_nombre']['tipo'] = uiForm::$textoSimple;
campos::$defcampos['empresa_registro.contacto_nombre']['texto'] = 'Nombre';

campos::$defcampos['empresa_registro.contacto_correo']['tipo'] = uiForm::$textoSimple;
campos::$defcampos['empresa_registro.contacto_correo']['texto'] = 'Correo';

campos::$defcampos['empresa_registro.contacto_telefono']['tipo'] = uiForm::$textoSimple;
campos::$defcampos['empresa_registro.contacto_telefono']['texto'] = 'Telefono';

campos::$defcampos['empresa_registro.privacidad_contacto_nombre']['tipo'] = uiForm::$radio;
campos::$defcampos['empresa_registro.privacidad_contacto_nombre']['valores'] = array('publico' => 'Público', 'privado' => 'Privado');
campos::$defcampos['empresa_registro.privacidad_contacto_nombre']['texto'] = 'Nombre del contacto';

campos::$defcampos['empresa_registro.privacidad_contacto_correo']['tipo'] = uiForm::$radio;
campos::$defcampos['empresa_registro.privacidad_contacto_correo']['valores'] = array('publico' => 'Público', 'privado' => 'Privado');
campos::$defcampos['empresa_registro.privacidad_contacto_correo']['texto'] = 'Correo electronico del contacto';

campos::$defcampos['empresa_registro.privacidad_contacto_telefono']['tipo'] = uiForm::$radio;
campos::$defcampos['empresa_registro.privacidad_contacto_telefono']['valores'] = array('publico' => 'Público', 'privado' => 'Privado');
campos::$defcampos['empresa_registro.privacidad_contacto_telefono']['texto'] = 'Teléfono del contacto';

campos::$defcampos['empresa_registro.privacidad_telefono_empresa']['tipo'] = uiForm::$radio;
campos::$defcampos['empresa_registro.privacidad_telefono_empresa']['valores'] = array('publico' => 'Público', 'privado' => 'Privado');
campos::$defcampos['empresa_registro.privacidad_telefono_empresa']['texto'] = 'Télefono de la empresa';
?>