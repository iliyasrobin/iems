<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('ip_addresses', function (Blueprint $table) {
            $table->string('ip_address')->after('id');
            $table->string('subnet_mask')->nullable()->after('ip_address');
            $table->string('gateway')->nullable()->after('subnet_mask');
            $table->string('dns')->nullable()->after('gateway');
            $table->foreignId('department_id')->nullable()->after('dns')->constrained()->nullOnDelete();
            $table->string('location')->nullable()->after('department_id');
            $table->string('device_name')->nullable()->after('location');
            $table->string('mac_address')->nullable()->after('device_name');
            $table->enum('status', ['active', 'inactive', 'reserved'])->default('active')->after('mac_address');
            $table->text('description')->nullable()->after('status');
            $table->string('assigned_to')->nullable()->after('description');
            $table->date('assigned_date')->nullable()->after('assigned_to');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ip_addresses', function (Blueprint $table) {
            $table->dropColumn([
                'ip_address',
                'subnet_mask',
                'gateway',
                'dns',
                'department_id',
                'location',
                'device_name',
                'mac_address',
                'status',
                'description',
                'assigned_to',
                'assigned_date'
            ]);
        });
    }
};
