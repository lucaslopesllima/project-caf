<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up()
    {
        DB::table('users')
            ->whereNull('integrationHash')
            ->orWhere('integrationHash', '')
            ->update(['integrationHash' => DB::raw('UUID()')]);

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
        DB::unprepared('DROP TRIGGER IF EXISTS tr_users_before_insert');

        DB::table('users')->update(['integrationHash' => 'pwefmpeiowjfopijwpfiojwpfjwopíjfopẃijfopíowjnfpiojdsopifjdiopw0jf0']);
    }
}; 