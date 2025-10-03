<?php
// Function to send JSON response
function response($data, $status = 200) {
    header('Content-Type: application/json');
    http_response_code($status);
    echo json_encode($data);
    exit;
}

// Function to validate required fields
function validateRequired($data, $fields) {
    $errors = [];
    foreach ($fields as $field) {
        if (!isset($data[$field]) || empty($data[$field])) {
            $errors[$field] = 'Field ' . $field . ' is required';
        }
    }
    return $errors;
}

// Function to upload file
function uploadFile($file, $targetDir) {
    $targetFile = $targetDir . basename($file['name']);
    $fileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
    
    // Check if file already exists
    if (file_exists($targetFile)) {
        return ['success' => false, 'message' => 'File already exists'];
    }
    
    // Check file size (5MB limit)
    if ($file['size'] > 5000000) {
        return ['success' => false, 'message' => 'File is too large'];
    }
    
    // Allow certain file formats
    $allowedTypes = ['jpg', 'jpeg', 'png', 'gif', 'pdf', 'doc', 'docx'];
    if (!in_array($fileType, $allowedTypes)) {
        return ['success' => false, 'message' => 'Only JPG, JPEG, PNG, GIF, PDF, DOC & DOCX files are allowed'];
    }
    
    // Try to upload file
    if (move_uploaded_file($file['tmp_name'], $targetFile)) {
        return ['success' => true, 'filename' => basename($file['name'])];
    } else {
        return ['success' => false, 'message' => 'Error uploading file'];
    }
}

// Function to delete file
function deleteFile($filename) {
    if (file_exists($filename)) {
        unlink($filename);
        return true;
    }
    return false;
}

// Function to send email
function sendEmail($to, $subject, $message) {
    // Use PHPMailer or similar library in production
    // This is a simplified version
    $headers = "From: " . EMAIL_FROM . "\r\n";
    $headers .= "Reply-To: " . EMAIL_FROM . "\r\n";
    $headers .= "Content-type: text/html\r\n";
    
    return mail($to, $subject, $message, $headers);
}
?>