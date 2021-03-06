<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeeLeaveApplicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_leave_applications', function (Blueprint $table) {
            $table->id();
            $table->string('Leave_Period',50)->nullable();
            $table->string('Employee_No',50);
            $table->enum('Status',['New', 'Review', 'Approved', 'Rejected', 'Canceled']);
            $table->string('Application_Code',50)->unique();
            $table->string('Leave_Code', 50);
            $table->decimal("Days_Applied", 5, 2);
            $table->date('Start_Date');
            $table->date('End_Date')->nullable();
            $table->date('Return_Date')->nullable();
            $table->date('Application_Date')->nullable();
            $table->string("Next_Approver", 50)->nullable();
            $table->string("Comments", 255)->nullable();
            $table->decimal("Approved_Days", 5, 2)->nullable();
            $table->date('Approved_Start_Date')->nullable();
            $table->date('Approved_End_Date')->nullable();
            $table->date('Approved_Return_Date')->nullable();
            $table->date('Approval_Date')->nullable();
            $table->boolean('Taken')->default(false);
            $table->foreign("Employee_No")->references("No")->on("employees")->onDelete('cascade');
            $table->foreign("Next_Approver")->references("No")->on("employees")->onDelete('cascade');
            $table->foreign("Leave_Code")->references("Code")->on("leave_types")->onDelete('cascade');
            $table->audits();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employee_leave_applications');
    }
}
