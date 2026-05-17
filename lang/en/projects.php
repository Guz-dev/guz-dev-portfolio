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
        'update_limit_reached' => 'Daily update limit reached. Try again later.',
        'magnitude_filter' => 'Filter by Magnitude:',
        'no_earthquakes' => 'No earthquakes found with the specified magnitude.',
        'data_source' => 'Data sourced from ',

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

        'stat_total' => 'Total Earthquakes',
        'stat_avg_magnitude' => 'Avg Magnitude',
        'stat_max_magnitude' => 'Max Magnitude',
        'stat_avg_depth' => 'Avg Depth (km)',

        'depth_filter_label' => 'Depth Range:',
        'to' => 'to',

        'magnitude_distribution_title' => 'Magnitude Distribution',
        'depth_distribution_title' => 'Depth Distribution',
        'time_distribution_title' => 'Earthquakes Over Time',
        'range' => 'Range',
        'count' => 'Count',
        'date' => 'Date',

        'of' => 'of',

        'use_cases_title' => 'Potential Applications',
        'use_case_1_title' => 'Scientific Research',
        'use_case_1_description' => 'Analyze correlations between magnitude, depth, and frequency of seismic events to support geological and seismological studies.',
        'use_case_2_title' => 'Risk Assessment',
        'use_case_2_description' => 'Evaluate seismic risk for infrastructure projects, urban planning, and insurance modeling based on historical earthquake patterns.',
        'use_case_3_title' => 'Disaster Preparedness',
        'use_case_3_description' => 'Improve early warning systems and emergency response strategies by understanding seismic behavior and high-risk zones.',
        'use_case_4_title' => 'Education & Outreach',
        'use_case_4_description' => 'Teach seismology concepts through interactive data visualization and raise public awareness about earthquake safety.',
    ],
];
