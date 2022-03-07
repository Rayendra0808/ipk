<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRankingDimensionView extends Migration
{
   /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \DB::statement($this->createView());
    }
   
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        \DB::statement($this->dropView());
    }
   
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    private function createView()
    {
        return <<<SQL
            CREATE VIEW view_dimension_rank AS
                
            SELECT b.*,
            RANK() OVER (PARTITION BY
                            dimension_id, year
                ORDER BY dimension_value desc
            ) sort
            FROM (
            SELECT * FROM  dimension_values dv 
            where province_id != 1001) as b
            SQL;
    }
   
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    private function dropView()
    {
        return <<<SQL
            DROP VIEW IF EXISTS `view_dimension_rank`;
            SQL;
    }
}
