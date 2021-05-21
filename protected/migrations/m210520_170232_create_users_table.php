<?php

class m210520_170232_create_users_table extends CDbMigration
{
	public function up()
	{
        $this->createTable('users', array(
                'id' => 'pk',
                'username' => 'string NOT NULL',
                'password' => 'string NOT NULL',
                'created_at' => 'datetime DEFAULT CURRENT_TIMESTAMP',
            )
        );

        $this->insert('users', [
            'username' => 'admin1',
            'password' => md5('admin11')
        ]);

        $this->insert('users', [
            'username' => 'admin2',
            'password' => md5('admin22')
        ]);
	}

	public function down()
	{
        $this->dropTable('contacts');
        
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