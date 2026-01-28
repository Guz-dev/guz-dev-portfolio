<?php

return [
    'pharmacy-manager' => [
        'title' => 'Pharmacy Manager',
        'description' => 'An application to manage inventory, invoices, and patients in a pharmacy. Features authentication, user roles, and reporting.',
        'tools' => 'Laravel, Livewire, TailwindCSS, MySQL',

        'description1' => 'Initial interface of the Pharmacy Manager showing the menu options.',
        'description2' => 'Interface showing the invoice entry form along with the list of medicines and supplies.',
        'description3' => 'Interface of one of the patient management modules where patients can be added, edited, and deleted.',
        'description4' => 'User management interface where roles and permissions can be assigned.',
        'description5' => 'Interface for dispensing medicines through a medical prescription.',
        'description6' => 'Reporting interface where invoices, inventory, and patient reports can be generated.',
        'description7' => 'PDF generated for the delivery receipt of medicines to a patient.',
    ],
    'todos' => [
        'title' => 'To-Do List',
        'description' => 'A to-do list that allows adding, marking as completed, deleting, importing, and exporting tasks.',
        'tools' => 'Laravel, Livewire, TailwindCSS',

        'clearButton' => 'Clear all',
        'importButton' => 'Import Tasks',
        'addButton' => 'Add Task',
        'addButtonTooltip' => 'Add a new task to the list',
        'exportButton' => 'Export Tasks',
        'removeButton' => 'Remove Task',        
    ],
    'earthquake-tracker' => [
        'title' => 'Earthquake Tracker',
        'description' => 'A project that displays recent earthquakes using an external API and helps visualize the data.',
        'tools' => 'Laravel, Livewire, Laravel Charts, HTTP Client',

        'update_button' => 'Update Data',
        'data_source' => 'Data sourced from the'
    ],
];
