<?php

/**
 * ContactForm class.
 * ContactForm is the data structure for keeping
 * contact form data. It is used by the 'contact' action of 'SiteController'.
 */
class ContactForm extends CFormModel
{
	public $first_name;
	public $last_name;
	public $email;
	public $phone_number;
	public $city;
	public $state;
	public $zipcode;
	public $country;
	public $comment;
	public $comment_2;
	public $verifyCode;

	/**
	 * Declares the validation rules.
	 */
	public function rules()
	{
		return array(
			// name, last_name, email, phone_number, city, state, zipcode, country are required
			array('first_name, last_name, email, phone_number, city, state, zipcode, country', 'required'),
			// comments fields has to be safe
            array('comment, comment_2', 'safe'),
			// email has to be a valid email address
			array('email', 'email'),
			// verifyCode needs to be entered correctly
			array('verifyCode', 'captcha', 'allowEmpty'=>!CCaptcha::checkRequirements()),
		);
	}

	/**
	 * Declares customized attribute labels.
	 * If not declared here, an attribute would have a label that is
	 * the same as its name with the first letter in upper case.
	 */
	public function attributeLabels()
	{
		return array(
			'verifyCode'=>'Verification Code',
		);
	}
}