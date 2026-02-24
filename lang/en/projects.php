<?php

return [
    'pharmacy-manager' => [
        'title' => 'Pharmacy Manager (Technical Overview)',
        'description' => 'An application to manage inventory, invoices, and patients in a pharmacy. Features authentication, user roles, and reporting.',
        'tools' => 'Laravel, Livewire, TailwindCSS, MySQL',

        'sub_title1' => 'Initial interface of the Pharmacy Manager showing the menu options.',
        'description1' => 'The options include managing invoices, inventory, patients, users, and generating reports.',
        'sub_title2' => 'Interface showing the invoice entry form along with the list of medicines and supplies.',
        'description2' => 'The form allows registering new invoices and associating them with the corresponding medicines and supplies, showing the respective stock and its update.',
        'sub_title3' => 'Interface of one of the patient management modules where patients can be added, edited, and deleted.',
        'description3' => 'An example of one of the system\'s management modules, in this case for patients, where new patients can be added, their information edited, or existing records deleted.',
        'sub_title4' => 'User management interface where roles and permissions can be assigned.',
        'description4' => 'In this interface, system users can be managed, assigned roles and permissions to control access to the different functionalities of the application.',
        'sub_title5' => 'Interface for dispensing medicines through a medical prescription.',
        'description5' => 'This interface allows registering the delivery of medicines to patients following medical prescriptions, with an interface similar to the invoice entry but focused on medicine dispensing.',
        'sub_title6' => 'Reporting interface where invoices, inventory, and patient reports can be generated.',
        'description6' => 'In this interface, detailed reports of invoices, inventory, and patients can be generated, facilitating analysis and decision-making.',
        'sub_title7' => 'PDF generated for the delivery receipt of medicines to a patient.',
        'description7' => 'Example of a generated PDF for the delivery receipt of medicines to a patient, showing the details of the delivery and relevant information.',
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
        'description' => 'A proof of concept that displays recent earthquakes using an external API and helps visualize the data.',
        'tools' => 'Laravel, Livewire, Google Charts, HTTP Client',

        'update_button' => 'Update Data',
        //'data_source' => 'Data sourced from the'
        'magnitude_filter' => 'Filter by Magnitude:',
        'no_earthquakes' => 'No earthquakes found with the specified magnitude.',
        'data_source' => 'Data sourced from the',

        'chart_title' => 'Magnitude vs Depth of Earthquakes in Chile',
        'hAxis_title' => 'Depth (km)',
        'vAxis_title' => 'Magnitude',
        'table_labels' => [
            'datetime' => 'Date & Time',
            'location' => 'Location',
            'magnitude' => 'Magnitude',
            'depth' => 'Depth (km)',
        ],
        'table_location_format' => ':distance at (:cardinal_direction) of :location',
    ],
];
