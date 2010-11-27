<?php
/**
 * A user
 */
class Core_User extends Core_GetterSetter
{
    /**
     * User login
     * 
     * @var string
     */
    private $_login;
    
    /**
     * Hashed password
     * 
     * @var string
     */
    private $_hashedPassword;
    
    
    
    /**
     * Constructor
     * 
     * @param   Application     $application    Application instance
     * @param   string          $login          User login
     * @param   array           $config         Configuration
     */
    public function __construct(Application $application, $login, $config)
    {
        $this->_login = $login;
        $this->_hashedPassword = '';
        
        if (isset($config['password'])) {
            $this->_hashedPassword = $config['password'];
        }
    }
    
    /**
     * User login
     * 
     * @var string
     */
    public function get_login()
    {
        return $this->_login;
    }
    
    /**
     * Check the password
     * 
     * @param   string  $password   Clear password
     * @return  boolean             true if the password matches, false otherwise
     */
    public function checkPassword($password)
    {
        $hash = sha1($password);
        if ($hash === $this->_hashedPassword) {
            return true;
        }
        return false;
    }
}
