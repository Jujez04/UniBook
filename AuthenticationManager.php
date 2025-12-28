<?php
require_once 'repo/StudentRepository.php';
require_once 'SessionManager.php';

class AuthenticationManager {
    private $studentRepo;
    private $sessionManager;

    public function __construct(&$studentRepo, &$sessionManager) {
        $this->studentRepo = $studentRepo;
        $this->sessionManager = $sessionManager;
    }

    public function login() {
        //Controllo se è una richiesta POST
        if($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header("Location: login.php");
            exit;
        }

        //Recupero l'input
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';

        if(empty($email) || empty($password)) {
            header("Location: login.php?error=empty_fields");
            exit;
        }

        //Recupero lo studente tramite repository
        $student = $this->studentRepo->findByEmail($email);

        if($student && password_verify($password, $student->getPassword())) {
            $this->sessionManager->loginUser(
                $student->getIdStudent(),
                [
                    'name' => $student->getName(),
                    'surname' => $student->getSurname(),
                    'profile_image' => $student->getProfileImage()
                ]
            );
            return true;
        } else {
            return false;
        }
    }

    public function logout() {
        $this->sessionManager->destroySession();
    }
}

?>
