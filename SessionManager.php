<?php

class SessionManager {

    public function loginUser($userId, $userData = []) {
        session_regenerate_id(true);

        $_SESSION['userid'] = $userId;
        $_SESSION['user_type'] = 'student';
        $_SESSION['user_data'] = $userData;
    }

    public function loginAdmin($userId, $userData = []) {
        session_regenerate_id(true);
        $_SESSION['userid'] = $userId;
        $_SESSION['user_type'] = 'admin';
        $_SESSION['user_data'] = $userData;
    }

    public function isLogged() {
        return isset($_SESSION['user_type']) && $_SESSION['user_type'] == 'student';
    }

    public function isAdminLogged() {
        return isset($_SESSION['user_type']) && $_SESSION['user_type'] == 'admin';
    }

    public function destroySession() {
        $_SESSION = [];
        session_destroy();
    }

    public function get($key) {
        return $_SESSION[$key] ?? null;
    }
}

?>