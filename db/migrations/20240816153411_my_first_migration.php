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
        $table->addColumn('id', 'integer')
            ->addColumn('username', 'varchar(250)')
            ->addColumn('email', 'varchar(250)')
            ->addColumn('password', 'varchar(250)')
            ->addColumn('created', 'datetime')
            ->addColumn('updated', 'datetime')
            ->create();

        $table = $this->table('deleteduser');
        $table->addColumn('id', 'integer')
            ->addColumn('email', 'varchar(250)')
            ->addColumn('deltime', 'datetime')
            ->addColumn('created', 'datetime')
            ->addColumn('updated', 'datetime')
            ->create();

        $table = $this->table('feedback');
        $table->addColumn('id', 'integer')
            ->addColumn('sender', 'varchar(250)')
            ->addColumn('receiver', 'varchar(250)')
            ->addColumn('title', 'varchar(250)')
            ->addColumn('feedback_data', 'varchar(250)')
            ->addColumn('attachment', 'varchar(250)')
            ->addColumn('created', 'datetime')
            ->addColumn('updated', 'datetime')
            ->create();

        $table = $this->table('notification');
        $table->addColumn('id', 'integer')
            ->addColumn('notification_user', 'varchar(250)')
            ->addColumn('notification_receiver', 'varchar(250)')
            ->addColumn('notification_type', 'varchar(250)')
            ->addColumn('time', 'datetime')
            ->addColumn('created', 'datetime')
            ->addColumn('updated', 'datetime')
            ->create();

        $table = $this->table('users');
        $table->addColumn('id', 'integer')
            ->addColumn('name', 'varchar(250)')
            ->addColumn('email', 'varchar(250)')
            ->addColumn('password', 'varchar(250)')
            ->addColumn('gender', 'varchar(250)')
            ->addColumn('mobile', 'varchar(250)')
            ->addColumn('designation', 'varchar(250)')
            ->addColumn('image', 'varchar(250)')
            ->addColumn('status', 'varchar(250)')
            ->addColumn('created', 'datetime')
            ->addColumn('updated', 'datetime')
            ->create();

    }
}
