<?php

return [
    'nav' => [
        'home' => 'Home',
        'about' => 'About me',
        'projects' => 'Projects',
        'contact' => 'Contact Me',
    ],

    'home' => [
        'title' => 'Home',
        'name' => 'Gustavo Olivares / Software Development',
        'description' => 'Software developer experienced in Laravel, MySQL, Node.js, and more. Specialized in building scalable and efficient web applications.',
        'experience_title' => 'Work Experience',
        'experiences' => [
            'camarones' => [
                'position' => 'Web Developer',
                'place' => 'Municipality of Camarones (Remote)',
                'date' => 'March 2024 – December 2024',
                'desc' => 'Developed a Laravel platform to manage invoices and pharmacy supplies in Codpa, including history and reports for decision-making.'
            ],
            'dici' => [
                'position' => 'Web Developer',
                'place' => 'University of Tarapacá “DICI” - Arica',
                'date' => 'December 2023 – February 2024',
                'desc' => 'Laravel-based system for efficiently managing computer check-outs using QR codes.'
            ],
            'dlo' => [
                'position' => 'Web Developer',
                'place' => 'University of Tarapacá “DLO” - Arica',
                'date' => 'January 2023 – March 2023',
                'desc' => 'Laravel web project developed with peers to manage infrastructure project reports at the university.'
            ]
        ]
    ],
    
    'about' => [
        'title' => 'About me',
        'intro' => 'I am a software developer with hands-on experience building web applications focused on efficiency and scalability. I have worked on projects such as inventory management systems and platforms with QR code integration, delivering functional solutions to real-world needs.',

        'location_age' => 'I am :age years old and based in Arica, Chile.',

        'education_title' => 'Academic Background',
        'education_description' => 'I hold a degree in Software Engineering (Ingeniería en Computación e Informática) from the University of Tarapacá, where I gained a solid foundation in software development, data structures, and systems architecture.',

        'skills_title' => 'Web Development Focus',
        'skills_description' => 'I specialize in modern web technologies, with a strong focus on Laravel for backend development, complemented by tools like Livewire, Alpine.js, and relational databases. I also have experience using frontend technologies like Tailwind CSS and frameworks like React when needed.',

        'learning_title' => 'Continuous Learning',
        'learning_description' => 'I am a self-taught learner who strengthens knowledge through video courses and official documentation. I consistently practice by building real-world projects to apply and reinforce what I’ve learned.',

        'values_title' => 'Professional Approach',
        'values_description' => 'I strive to write clean, scalable, and maintainable code. I enjoy improving processes, automating tasks, and building solutions that deliver real value to users.',
    ],

    'projects' => [
        'title' => 'Projects',
        'description' => 'Here you can find some of the projects I have worked on, each designed to solve specific problems and improve efficiency in various areas.',
        'placeholder_title' => 'Project in Development',
        'placeholder_description' => 'More information about this project coming soon.',
        'alternative_text' => 'Project screenshot',
    ],
];
