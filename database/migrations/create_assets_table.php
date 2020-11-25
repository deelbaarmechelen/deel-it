<?php

use Illuminate\Database\Migrations\Migration;

class CreateAssetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assets', function ($table) {
            $table->increments('id');
            $table->string('name')->nullable();
            $table->string('asset_tag')->nullable();
            $table->integer('model_id')->nullable();
            $table->string('serial')->nullable();
            $table->date('purchase_date')->nullable();
            $table->decimal('purchase_cost',  20, 2)->nullable()->default(null);
            $table->string('order_number')->nullable();
            $table->integer('assigned_to')->nullable();
            $table->text('notes')->nullable();
            $table->integer('user_id')->nullable();
            $table->timestamps();
            $table->boolean('physical')->default(1);
            $table->engine = 'InnoDB';
            $table->softDeletes();
            $table->integer('status_id')->nullable();
            $table->boolean('archived')->nullable()->default(0);
            $table->integer('warranty_months')->nullable();
            $table->boolean('depreciate')->nullable();
            $table->integer('supplier_id')->nullable()->default(NULL);
            $table->tinyInteger('requestable')->default(0);
            $table->integer('rtd_location_id')->nullable()->default(NULL);
            $table->string('_snipeit_mac_address')->nullable()->default(NULL);
            $table->string('accepted')->nullable();
            $table->dateTime('last_checkout')->nullable();
            $table->date('expected_checkin')->nullable();
            $table->text('image')->after('notes')->nullable()->default(NULL);
            $table->integer('company_id')->unsigned()->nullable();
            $table->string('assigned_type')->nullable();
            $table->date('next_audit_date')->nullable()->default(NULL);
            $table->datetime('last_audit_date')->after('assigned_type')->nullable()->default(null);
            $table->integer('checkin_counter')->default(0);
            $table->integer('checkout_counter')->default(0);
            $table->integer('requests_counter')->default(0);
            $table->string('serial')->nullable()->default(null)->change();

            $table->index('rtd_location_id');
            $table->index(['assigned_type','assigned_to']);
            $table->integer('location_id')->nullable()->default(null);
            $table->index('created_at');
            $table->index(['deleted_at', 'status_id']);
            $table->index(['deleted_at', 'model_id']);
            $table->index(['deleted_at', 'assigned_type', 'assigned_to']);
            $table->index(['deleted_at', 'supplier_id']);
            $table->index(['deleted_at', 'location_id']);
            $table->index(['deleted_at', 'rtd_location_id']);
            $table->index(['deleted_at', 'asset_tag']);
            $table->index(['deleted_at', 'name']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('assets');
    }

}
