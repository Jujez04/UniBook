<?php

class SessionManager {

    public function loginUser($userId, $userData = []) {
        session_regenerate_id(true);

        $_SESSION['userid'] = $userId;
        $_SESSION['user_data'] = $userData;
    }

    public function isLogged() {
        return isset($_SESSION['userid']) && isset($_SESSION['user_data']);
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