<?php
namespace App\Common;
use Illuminate\Database\Schema\Blueprint;
class AuditableEntity
{
    public static function commonColumn(Blueprint $table,$noSoftDelete = false)
    {
        $table->unsignedBigInteger("created_by")->nullable();
        $table->unsignedBigInteger("update_by")->nullable();
        $table->unsignedBigInteger("deleted_by")->nullable();
        if(!$noSoftDelete){
            $table->softDeletes();
        }
        $table->timestamp('created_at')->useCurrent();
        $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
        $table->foreign('created_by')->references('id')->on('users')->constrained()->onDelete('cascade')->onUpdate('cascade');
        $table->foreign('update_by')->references('id')->on('users')->constrained()->onDelete('cascade')->onUpdate('cascade');
        $table->foreign('deleted_by')->references('id')->on('users')->constrained()->onDelete('cascade')->onUpdate('cascade');
    }
}
