<?php

declare(strict_types=1);

use Cidenet\Api\Domain\Model\Employee\EmployeeAdmissionDate;
use Cidenet\Api\Domain\Model\Employee\EmployeeArea;
use Cidenet\Api\Domain\Model\Employee\EmployeeCountry;
use Cidenet\Api\Domain\Model\Employee\EmployeeEmail;
use Cidenet\Api\Domain\Model\Employee\EmployeeFirstName;
use Cidenet\Api\Domain\Model\Employee\EmployeeFirstSurname;
use Cidenet\Api\Domain\Model\Employee\EmployeeId;
use Cidenet\Api\Domain\Model\Employee\EmployeeIdentificationNumber;
use Cidenet\Api\Domain\Model\Employee\EmployeeIdType;
use Cidenet\Api\Domain\Model\Employee\EmployeeOtherName;
use Cidenet\Api\Domain\Model\Employee\EmployeeSecondSurname;
use Cidenet\Api\Domain\Model\Employee\EmployeeStatus;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->uuid(EmployeeId::COLUMN)->primary();

            $table->string(EmployeeFirstName::COLUMN, 20);
            $table->string(EmployeeOtherName::COLUMN, 50)->nullable(true);
            $table->string(EmployeeFirstSurname::COLUMN, 20);
            $table->string(EmployeeSecondSurname::COLUMN, 20);
            $table->string(EmployeeEmail::COLUMN, 300)->unique();
            $table->string(EmployeeCountry::COLUMN);
            $table->enum(EmployeeIdType::COLUMN, EmployeeIdType::$IDType);
            $table->string(EmployeeIdentificationNumber::COLUMN, 20);
            $table->date(EmployeeAdmissionDate::COLUMN);
            $table->enum(EmployeeArea::COLUMN, EmployeeArea::$area);
            $table->enum(EmployeeStatus::COLUMN, EmployeeStatus::$status);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('employees');
    }
};
