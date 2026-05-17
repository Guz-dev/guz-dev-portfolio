<?php

return [    
    'pharmacy-manager' => [
        'title' => 'Gestor de Farmacia (Demostración del proyecto)',
        'description' => 'Aplicación para gestionar inventario, facturas y pacientes en una farmacia. Incluye autenticación, roles de usuario y reportes.',
        'tools' => 'Laravel, Livewire, TailwindCSS, MySQL',

        'sub_title1' => 'Interfaz inicial del Gestor de Farmacia donde se observan las opciones de menú.',
        'description1' => 'Las opciones incluyen gestión de facturas, inventario, pacientes, usuarios y generación de reportes.',
        'sub_title2' => 'Interfaz donde se observa el formulario de ingreso de facturas junto con el listado de medicamentos e insumos.',
        'description2' => 'El formulario permite registrar nuevas facturas y asociarlas a los medicamentos e insumos correspondientes, mostrando el respectivo stock y su actualización.',
        'sub_title3' => 'Interfaz de uno de los mantenedores de pacientes donde se pueden agregar, editar y eliminar pacientes.',
        'description3' => 'Se observa un ejemplo de uno de los mantenedores del sistema, en este caso el de pacientes, donde se pueden agregar nuevos pacientes, editar su información o eliminar registros existentes.',
        'sub_title4' => 'Interfaz de administración de usuarios donde se pueden asignar roles y permisos.',
        'description4' => 'En esta interfaz se pueden gestionar los usuarios del sistema, asignarles roles y permisos para controlar el acceso a las diferentes funcionalidades de la aplicación.',
        'sub_title5' => 'Interfaz de salida de medicamentos a través de una prescripción médica.',
        'description5' => 'Esta interfaz permite registrar la entrega de medicamentos a los pacientes siguiendo las prescripciones médicas, con una interfaz similar a la de ingreso de facturas pero enfocada en la salida de medicamentos.',
        'sub_title6' => 'Interfaz de reportes donde se pueden generar reportes de facturas, inventario y pacientes.',
        'description6' => 'En esta interfaz se pueden generar reportes detallados de facturas, inventario y pacientes, facilitando el análisis y la toma de decisiones.',
        'sub_title7' => 'PDF generado de comprobante de entrega de medicamentos a un paciente.',
        'description7' => 'Ejemplo de un PDF generado para el comprobante de entrega de medicamentos a un paciente, mostrando los detalles de la entrega y la información relevante.',
    ],
    'todos' => [
        'title' => 'Lista de tareas',
        'description' => 'Lista de tareas que permite agregar, marcar como completado, eliminar, importar y exportar tareas.',

        'clearButton' => 'Limpiar todo',
        'importButton' => 'Importar tareas',
        'addButton' => 'Agregar tarea',
        'addButtonTooltip' => 'Agregar una nueva tarea a la lista',
        'exportButton' => 'Exportar tareas',
        'removeButton' => 'Eliminar tarea',
    ],
    'earthquake-tracker' => [
        'title' => 'Monitor de Sismos',
        'description' => 'Una prueba de concepto que muestra los sismos recientes utilizando una API externa y ayuda a visualizar los datos.',
        'tools' => 'Laravel, Livewire, Google Charts, HTTP Client',

        'update_button' => 'Actualizar datos',
        'update_limit_reached' => 'Límite de actualizaciones diarias alcanzado. Intenta más tarde.',
        'magnitude_filter' => 'Filtrar por magnitud:',
        'no_earthquakes' => 'No se encontraron sismos con la magnitud especificada.',
        'data_source' => 'Datos obtenidos desde ',

        'chart_title' => 'Magnitud vs Profundidad de Sismos en Chile',
        'hAxis_title' => 'Profundidad (km)',
        'vAxis_title' => 'Magnitud',
        'table_labels' => [
            'datetime' => 'Fecha y Hora',
            'location' => 'Ubicación',
            'magnitude' => 'Magnitud',
            'depth' => 'Profundidad (km)',
        ],
        'table_location_format' => ':distance al (:cardinal_direction) de :location',

        'stat_total' => 'Total de Sismos',
        'stat_avg_magnitude' => 'Magnitud Promedio',
        'stat_max_magnitude' => 'Magnitud Máxima',
        'stat_avg_depth' => 'Profundidad Promedio (km)',

        'depth_filter_label' => 'Rango de Profundidad:',
        'to' => 'a',

        'magnitude_distribution_title' => 'Distribución de Magnitudes',
        'depth_distribution_title' => 'Distribución de Profundidades',
        'time_distribution_title' => 'Sismos en el Tiempo',
        'range' => 'Rango',
        'count' => 'Cantidad',
        'date' => 'Fecha',

        'of' => 'de',

        'use_cases_title' => 'Aplicaciones Potenciales',
        'use_case_1_title' => 'Investigación Científica',
        'use_case_1_description' => 'Analizar correlaciones entre magnitud, profundidad y frecuencia de eventos sísmicos para apoyar estudios geológicos y sismológicos.',
        'use_case_2_title' => 'Evaluación de Riesgos',
        'use_case_2_description' => 'Evaluar el riesgo sísmico para proyectos de infraestructura, planificación urbana y modelos de seguros basados en patrones históricos.',
        'use_case_3_title' => 'Preparación ante Desastres',
        'use_case_3_description' => 'Mejorar sistemas de alerta temprana y estrategias de respuesta a emergencias comprendiendo el comportamiento sísmico y zonas de alto riesgo.',
        'use_case_4_title' => 'Educación y Divulgación',
        'use_case_4_description' => 'Enseñar conceptos de sismología a través de visualización interactiva de datos y crear conciencia pública sobre seguridad sísmica.',
    ],
];
