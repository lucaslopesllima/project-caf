<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up()
    {
        // Primeiro atualiza os registros existentes que estão null ou vazios
        DB::table('users')
            ->whereNull('integrationHash')
            ->orWhere('integrationHash', '')
            ->update(['integrationHash' => DB::raw('UUID()')]);

        // Criar trigger para novos registros
        DB::unprepared('
            CREATE TRIGGER tr_users_before_insert 
            BEFORE INSERT ON users 
            FOR EACH ROW 
            BEGIN
                IF NEW.integrationHash IS NULL OR NEW.integrationHash = "" THEN
                    SET NEW.integrationHash = UUID();
                END IF;
            END
        ');
    }

    public function down()
    {
        // Remove o trigger
        DB::unprepared('DROP TRIGGER IF EXISTS tr_users_before_insert');

        // Opcional: limpar os hashes gerados
        DB::table('users')->update(['integrationHash' => '']);
    }
}; 