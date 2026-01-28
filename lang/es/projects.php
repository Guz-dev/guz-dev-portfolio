<?php

return [    
    'pharmacy-manager' => [
        'title' => 'Gestor de Farmacia',
        'description' => 'Aplicación para gestionar inventario, facturas y pacientes en una farmacia. Incluye autenticación, roles de usuario y reportes.',
        'tools' => 'Laravel, Livewire, TailwindCSS, MySQL',

        'description1' => 'Interfaz inicial del Gestor de Farmacia donde se observan las opciones de menú.',
        'description2' => 'Interfaz donde se observa el formulario de ingreso de facturas junto con el listado de medicamentos e insumos.',
        'description3' => 'Interfaz de uno de los mantenedores de pacientes donde se pueden agregar, editar y eliminar pacientes.',
        'description4' => 'Interfaz de administración de usuarios donde se pueden asignar roles y permisos.',
        'description5' => 'Interfaz de salida de medicamentos a través de una prescripción médica.',
        'description6' => 'Interfaz de reportes donde se pueden generar reportes de facturas, inventario y pacientes.',
        'description7' => 'PDF generado de comprobante de entrega de medicamentos a un paciente.',
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
        'description' => 'Proyecto que muestra los sismos recientes usando una API externa y ayuda a visualizar los datos.',
        'tools' => 'Laravel, Livewire, Laravel Charts, HTTP Client',

        'update_button' => 'Actualizar datos',
        'data_source' => 'Datos obtenidos desde el'
    ],
];
