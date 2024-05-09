<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterAddColumnAvatarToMembersTable extends Migration
{
    public function up()
    {
        if(!Schema::hasColumn('members','avatars')) {
            Schema::table('members', function (Blueprint $table) {
                $table->string('avatar')->nullable()->after('role_id');
            });
        }
    }
    public function down()
    {
        if(!Schema::hasColumn('members','avatars')) {
            Schema::table('members', function (Blueprint $table) {
                $table->dropColumn('avatar');
            });
        }
    }
}
