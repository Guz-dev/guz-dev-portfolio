<?php

return [    
    'nav' => [
        'home' => 'Inicio',
        'about' => 'Sobre mí',
        'projects' => 'Proyectos',
        'contact' => 'Contáctame',
    ],

    'home' => [
        'title' => 'Inicio',
        'name' => 'Gustavo Olivares',
        'description' => 'Desarrollador web especializado en Laravel, MySQL y Node.js. Construyo soluciones eficientes y escalables para empresas modernas.',

        'experience_title' => 'Experiencia laboral',
        'experiences' => [
            'camarones' => [
                'position' => 'Desarrollador web',
                'place' => 'Municipalidad de Camarones (Remoto)',
                'date' => 'Marzo 2024 – Diciembre 2024',
                'desc' => 'Desarrollo de una plataforma en Laravel para registrar facturas e insumos de farmacia en Codpa, con historial y reportes para toma de decisiones.'
            ],
            'dici' => [
                'position' => 'Desarrollador web',
                'place' => 'Universidad de Tarapacá “DICI” - Arica',
                'date' => 'Diciembre 2023 – Febrero 2024',
                'desc' => 'Sistema Laravel para gestión de préstamos de computadores mediante un sistema optimizado con código QR.'
            ],
            'dlo' => [
                'position' => 'Desarrollador web',
                'place' => 'Universidad de Tarapacá “DLO” - Arica',
                'date' => 'Enero 2023 – Marzo 2023',
                'desc' => 'Web en Laravel desarrollada en práctica con otros estudiantes para gestión de informes de proyectos del Departamento de Infraestructura.'
            ]
        ],
        'resume_link' => 'Descargar CV',
    ],

    'about' => [
        'title' => 'Sobre mí',
        'intro' => 'Soy desarrollador de software con experiencia práctica en el desarrollo de aplicaciones web orientadas a la eficiencia y escalabilidad. He participado en proyectos como sistemas de gestión de inventarios y plataformas con integración de códigos QR, resolviendo necesidades concretas con soluciones funcionales.',

        'location_age' => 'Tengo :age años y vivo en Arica, Chile.',

        'education_title' => 'Formación académica',
        'education_description' => 'Soy titulado en Ingeniería en Computación e Informática de la Universidad de Tarapacá, donde adquirí una sólida base en desarrollo de software, estructuras de datos y arquitectura de sistemas.',

        'skills_title' => 'Especialización en desarrollo web',
        'skills_description' => 'Me enfoco principalmente en tecnologías web modernas, con énfasis en Laravel para el backend, complementado por herramientas como Livewire, Alpine.js y bases de datos relacionales. También tengo experiencia utilizando tecnologías frontend como Tailwind CSS y frameworks como React cuando el proyecto lo requiere.',

        'learning_title' => 'Aprendizaje constante',
        'learning_description' => 'Aprendo de forma autodidacta, reforzando mis conocimientos mediante cursos en video y documentación oficial. Practico constantemente creando proyectos reales que me permiten aplicar y consolidar lo aprendido.',

        'values_title' => 'Enfoque profesional',
        'values_description' => 'Me esfuerzo por escribir código limpio, escalable y fácil de mantener. Disfruto mejorar procesos, automatizar tareas y desarrollar soluciones que realmente aporten valor a quienes las utilizan.',
    ],
    
    'projects' => [
        'title' => 'Proyectos',
        'description' => 'Aquí puedes encontrar algunos de los proyectos en los que he trabajado, cada uno diseñado para resolver problemas específicos y mejorar la eficiencia en diferentes áreas.',
        'placeholder_title' => 'Proyecto en desarrollo',
        'placeholder_description' => 'Próximamente más información sobre este proyecto.',
        'alternative_text' => 'Captura de pantalla del proyecto',
    ],
    
    'contact' => [
        'title' => 'Contáctame',
        'description' => 'Si deseas ponerte en contacto conmigo para discutir oportunidades de colaboración, proyectos o simplemente para saludar, no dudes en enviarme un mensaje a través del siguiente formulario o utilizando mis redes sociales.',
        'name_placeholder' => 'Tu nombre',
        'email_placeholder' => 'Tu correo electrónico',
        'message_placeholder' => 'Tu mensaje',
        'send_button' => 'Enviar mensaje',
    ],
];
