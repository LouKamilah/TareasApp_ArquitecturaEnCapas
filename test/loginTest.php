<?php 

class UserTest
{
    private $user;
    
    public function __construct($user)
    {
        $this->user = $user;
    }
    
    // Test de login exitoso
    public function testLoginSuccess()
    {
        $result = $this->user->login('test@example.com', 'password123');
        $this->assertTrue($result, "El login debería ser exitoso.");
    }
    
    // Test de login fallido
    public function testLoginFailure()
    {
        $result = $this->user->login('test@example.com', 'wrongpassword');
        $this->assertFalse($result, "El login debería fallar con una contraseña incorrecta.");
    }
    
    // comparación de resultados
    public function assertTrue($condition, $message)
    {
        if (!$condition) {
            echo "Error: " . $message . "\n";
        } else {
            echo "Test Passed: " . $message . "\n";
        }
    }
    
    // comparación de resultados
    public function assertFalse($condition, $message)
    {
        if ($condition) {
            echo "Error: " . $message . "\n";
        } else {
            echo "Test Passed: " . $message . "\n";
        }
    }
}

// Clase User (para probar)
class User
{
    public function login($email, $password)
    {
        // Simulación de un login sencillo (esto normalmente sería más complejo)
        $users = [
            ['email' => 'test@example.com', 'password' => 'password123']
        ];
        
        foreach ($users as $user) {
            if ($user['email'] === $email && $user['password'] === $password) {
                return true;
            }
        }
        
        return false;
    }
}

// Crear la instancia de la clase User
$user = new User();

// Crear la instancia de UserTest y ejecutar las pruebas
$test = new UserTest($user);
$test->testLoginSuccess(); // Esperamos un login exitoso
$test->testLoginFailure(); // Esperamos un login fallido


?>