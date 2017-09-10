<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWorkerAccounts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('worker_accounts', function (Blueprint $table) {
          $table->increments('id');
          $table->string('code', 10)->unique();
          $table->string('worker_code', 10);
          $table->string('cashbox_account', 10);
          $table->string('stock_account', 10);
          $table->string('loan_account', 10);
          $table->string('long_loan_account', 10);
          $table->string('salary_account', 10);
          $table->string('commission_account', 10);
          $table->string('bonus_account', 10);
          $table->string('antiquity_account', 10);
          $table->string('holidays_account', 10);
          $table->string('savings_account', 10);
          $table->string('insurance_account', 10);
          $table->json('reimbursement_accounts');
          $table->json('draw_accounts');
          $table->json('bank_accounts');

          $table->foreign('worker_code')->references('code')->on('workers');
          $table->foreign('cashbox_account')->references('code')->on('accounts');
          $table->foreign('stock_account')->references('code')->on('accounts');
          $table->foreign('loan_account')->references('code')->on('accounts');
          $table->foreign('long_loan_account')->references('code')->on('accounts');
          $table->foreign('salary_account')->references('code')->on('accounts');
          $table->foreign('commission_account')->references('code')->on('accounts');
          $table->foreign('bonus_account')->references('code')->on('accounts');
          $table->foreign('antiquity_account')->references('code')->on('accounts');
          $table->foreign('holidays_account')->references('code')->on('accounts');
          $table->foreign('savings_account')->references('code')->on('accounts');
          $table->foreign('insurance_account')->references('code')->on('accounts');
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('worker_accounts');
    }
}