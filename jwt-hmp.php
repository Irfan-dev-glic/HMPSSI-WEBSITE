<?php
require_once __DIR__ . '/vendor/autoload.php';

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

// Define JWT_SECRET and JWT_EXPIRES_IN if not already defined
if (!defined('JWT_SECRET')) {
    define('JWT_SECRET', 'your_secret_key_here');
}
if (!defined('JWT_EXPIRES_IN')) {
    define('JWT_EXPIRES_IN', 60 * 60 * 24 * 7); // 7 days
}

class JwtHandler {
    protected $jwt_secret;
    protected $token;
    
    public function __construct() {
        $this->jwt_secret = JWT_SECRET;
    }
    
    // Encode token
    public function _jwt_encode_data($iss, $data) {
        // Token will expire in 7 days
        $time = time();
        $expire = $time + JWT_EXPIRES_IN;
        
        $token = array(
            "iss" => $iss,
            "aud" => $iss,
            "iat" => $time,
            "exp" => $expire,
            "data" => $data
        );

        return JWT::encode($token, $this->jwt_secret, 'HS256');
    }
    
    // Decode token
    public function _jwt_decode_data($jwt_token) {
        try {
            $decode = JWT::decode($jwt_token, new Key($this->jwt_secret, 'HS256'));
        } catch (Exception $e) {
            error_log('JWT Decode Error: ' . $e->getMessage());
            return false;
        }
        }
    }
?>