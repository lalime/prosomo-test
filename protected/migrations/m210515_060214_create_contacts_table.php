<?php

class m210515_060214_create_contacts_table extends CDbMigration
{
	public function up()
	{
        $this->createTable('contacts', array(
                'id' => 'pk',
                'first_name' => 'string NOT NULL',
                'last_name' => 'string NOT NULL',
                'email' => 'string NOT NULL',
                'phone_number' => 'string NOT NULL',
                'city' => 'string NOT NULL',
                'state' => 'string NOT NULL',
                'zipcode' => 'string NOT NULL',
                'country' => 'string NOT NULL',
                'comment' => 'text',
                'comment_2' => 'text',
                'created_at' => 'datetime DEFAULT CURRENT_TIMESTAMP',
            )
        );
	}

	public function down()
	{
        $this->dropTable('contacts');
		echo "m210515_060214_create_contacts_table does not supxport migration down.\n";
		return false;
	}

	/*
	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
	}

	public function safeDown()
	{
	}
	*/
}