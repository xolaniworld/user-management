<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class MyFirstMigration extends AbstractMigration
{
    /**
     * Change Method.
     *
     * Write your reversible migrations using this method.
     *
     * More information on writing migrations is available here:
     * https://book.cakephp.org/phinx/0/en/migrations.html#the-change-method
     *
     * Remember to call "create()" or "update()" and NOT "save()" when working
     * with the Table class.
     */
    public function change(): void
    {
        // create the table
        $table = $this->table('admin');
        $table->addColumn('username', 'string', ['limit' => 250])
            ->addColumn('email', 'string', ['limit' => 250])
            ->addColumn('password', 'string', ['limit' => 250])
            ->addColumn('created', 'datetime')
            ->addColumn('updated', 'datetime')
            ->create();

        $table->insert([
            'username' => 'admin',
            'email' => 'admin@admin.com',
            'password' => password_hash('secret', PASSWORD_DEFAULT)
        ])->saveData();

        $table = $this->table('deleted_user');
        $table->addColumn('email', 'string', ['limit' => 250])
            ->addColumn('deleted_time', 'datetime')
            ->addColumn('created', 'datetime')
            ->addColumn('updated', 'datetime')
            ->create();

        $table = $this->table('feedback');
        $table->addColumn('sender', 'string', ['limit' => 250])
            ->addColumn('receiver', 'string', ['limit' => 250])
            ->addColumn('title', 'string', ['limit' => 250])
            ->addColumn('feedback_data', 'string', ['limit' => 250])
            ->addColumn('attachment', 'string', ['limit' => 250])
            ->addColumn('created', 'datetime')
            ->addColumn('updated', 'datetime')
            ->create();

        $table = $this->table('notification');
        $table->addColumn('notification_user', 'string', ['limit' => 250])
            ->addColumn('notification_receiver', 'string', ['limit' => 250])
            ->addColumn('notification_type', 'string', ['limit' => 250])
            ->addColumn('time', 'datetime')
            ->addColumn('created', 'datetime')
            ->addColumn('updated', 'datetime')
            ->create();

        $table = $this->table('users');
        $table->addColumn('name', 'string', ['limit' => 250])
            ->addColumn('email', 'string', ['limit' => 250])
            ->addColumn('password', 'string', ['limit' => 250])
            ->addColumn('gender', 'string', ['limit' => 250])
            ->addColumn('mobile', 'string', ['limit' => 250])
            ->addColumn('designation', 'string', ['limit' => 250])
            ->addColumn('image', 'string', ['limit' => 250])
            ->addColumn('status', 'string', ['limit' => 250])
            ->addColumn('created', 'datetime')
            ->addColumn('updated', 'datetime')
            ->create();

    }
}
