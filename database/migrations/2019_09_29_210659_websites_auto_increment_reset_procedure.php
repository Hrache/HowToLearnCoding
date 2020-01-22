<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class WebsitesAutoIncrementResetProcedure extends Migration
{
  protected $procedure_1 = 'websites_autoincrement_reset_proc';

  protected $trigger_1 = 'call_procedure_1';

  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    DB::raw("CREATE PROCEDURE {$this->procedure_1}() BEGIN ALTER TABLE websites AUTO_INCREMENT = 1;");
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    DB::row("DROP PROCEDURE {$procedure_1};");
  }
}
