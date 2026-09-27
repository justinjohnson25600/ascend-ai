<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * The enquiry types changed with the Business Automation Solutions repositioning.
     * The column was a database enum, which cannot be extended in place, so it becomes
     * a plain string validated by App\Enums\EnquiryType. Old values are folded into "general".
     */
    public function up(): void
    {
        if (DB::getDriverName() === 'pgsql') {
            DB::statement('ALTER TABLE contacts DROP CONSTRAINT IF EXISTS contacts_enquiry_type_check');
        }

        Schema::table('contacts', function (Blueprint $table): void {
            $table->string('enquiry_type', 32)->change();
        });

        DB::table('contacts')
            ->whereIn('enquiry_type', ['investment', 'advisory'])
            ->update(['enquiry_type' => 'general']);
    }

    public function down(): void
    {
        // The original values cannot be recovered once folded, so there is nothing safe to reverse.
    }
};
