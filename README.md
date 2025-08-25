# amt-spice-master
road-spice-master wordpress theme

//==== discover section
/wp-content/themes/road-spice-master/
├── assets/
│   ├── css/
│   │   ├── components/
│   │   │   └── discover-section.css  # Component-specific styles
│   │   └── theme.css                 # Main compiled stylesheet
├── inc/
│   └── discover-settings.php
└── functions.php


//===Footer=======START==================
/wp-content/themes/road-spice-master/
├── assets/
│   ├── css/
│   │   └── road-footer.css
│   └── js/
│       └── road-footer-script.js
├── inc/
│   └── footer-settings.php
├── footer.php
└── functions.php

---------------------------------------
/**
 * Load footer customization settings
 */
require get_template_directory() . '/inc/footer-settings.php';
//===Footer=======END==================
----------------------------------------

