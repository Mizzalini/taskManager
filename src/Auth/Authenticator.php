<?php
namespace App\Auth;

class Authenticator {

    /**
     * Orchestrates the login attempt
     * 
     * @param string $user The username submitted to the form
     * @param string $pass The password submitted to the form
     */
    public static function onLogin(string $user, string $pass): void {
        $error = self::validate($user, $pass);

        if ($error !== true) {
            $_SESSION['login_attempts']++;
            $_SESSION['error'] = $error;
            header("Location: login.php");
            exit;
        }

        $_SESSION['login_attempts'] = 0;

        self::createSession();
        self::redirectUserLogged();
    }

    /**
     * Validates the user's credentials
     * 
     * @param string $user The username to check
     * @param string $pass The password to check
     * @return bool|string Returns 'true' on success, or an error on failure
     */
    private static function validate(string $user, string $pass): bool|string {
        if (empty($user) || empty($pass)) {
            return "User and password are required.";
        }

        if (!hash_equals($user, USER) || !password_verify($pass, PASS)) {
            return "User or password is incorrect.";
        }

        return true;
    }

    private static function createSession(): void {
        $_SESSION['userLogged'] = true;
    }

    private static function redirectUserLogged(): void {
        header("Location: index.php");
        exit;
    }
}