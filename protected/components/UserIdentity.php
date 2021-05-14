<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
	/**
	 * Authenticates a user.
	 * The example implementation makes sure if the username and password
	 * are both 'demo'.
	 * In practical applications, this should be changed to authenticate
	 * against some persistent user identity storage (e.g. database).
	 * @return boolean whether authentication succeeds.
	 */
	public function authenticate()
	{
		$userName = $this->username;
		$password = $this->password;

        $user = User::model()->find(array( 'condition' => "username='$userName'"));
        
		// If user is found
		if (!empty($user)) {
            $hashedPassword = md5($password);

            // If the database password match submited one then no error
            if ($hashedPassword == $user->password) {
                $this->errorCode = self::ERROR_NONE;
            } else {
                $this->errorCode = self::ERROR_PASSWORD_INVALID;
            }
        } else {
			$this->errorCode=self::ERROR_USERNAME_INVALID;
        }
        
		return !$this->errorCode;
	}
}