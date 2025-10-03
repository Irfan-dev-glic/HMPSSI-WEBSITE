<?php
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'hmps_si');

define('JWT_SECRET', 'your_jwt_secret_key');
define('JWT_EXPIRES_IN', 604800); // 7 days in seconds

define('BASE_URL', 'http://localhost/backend-hmps');
define('UPLOAD_PATH', __DIR__ . '/../uploads/');

// Email configuration
define('EMAIL_HOST', 'smtp.gmail.com');
define('EMAIL_PORT', 587);
define('EMAIL_USER', 'your_email@gmail.com');
define('EMAIL_PASS', 'your_email_password');
define('EMAIL_FROM', 'no-reply@hmps-stmiksz.ac.id');
?>