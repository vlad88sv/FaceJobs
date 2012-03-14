<?php
campos::$defcampos['empresa_categorias.categoria']['tipo'] = uiForm::$textoSimple;
campos::$defcampos['empresa_categorias.categoria']['texto'] = 'Categoría:';

campos::$deflazo['empresa_categorias']['vista']['class'] = 'lazoVistaPeque';
campos::$deflazo['empresa_categorias']['vista'][0][0] = '$$categoria$$';
campos::$deflazo['empresa_categorias']['campos'][] = 'empresa_categorias.categoria';

?>