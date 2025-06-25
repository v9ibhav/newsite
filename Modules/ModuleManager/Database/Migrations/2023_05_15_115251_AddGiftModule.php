<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Migrations\Migration;
use Modules\ModuleManager\Entities\Module;

class AddGiftModule extends Migration
{
    public function up()
    {
        $totalCount = DB::table('modules')->count();
        $newModule = new Module();
        $newModule->name = 'Gift';
        $newModule->details = 'Gift Module For InfixLMS.';
        $newModule->status = 0;
        $newModule->order = $totalCount;
        $newModule->save();
    }

    public function down()
    {
        //
    }
}
