<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        // Table "Users"
        Schema::create('users', function (Blueprint $table) {
            $table->id('id_Utilisateur');
            $table->string('email');
            $table->string('name');
            $table->string('password');
            $table->integer('temps_moyen_Utilisateur')->nullable();
            $table->timestamps();
        });

        // Table "Restaurant"
        Schema::create('Restaurant', function (Blueprint $table) {
            $table->id('id_Restaurant');
            $table->string('nom_Restaurant');
            $table->json('horaires_Restaurant')->nullable();
            $table->integer('CP_Restaurant');
            $table->string('adresse_Restaurant');
            $table->string('ville_Restaurant');
            $table->timestamps();
        });

        // Table "Types_restaurant"
        Schema::create('Types_restaurant', function (Blueprint $table) {
            $table->id('id_Types_restaurant');
            $table->string('type_Types_restaurant');
            $table->timestamps();
        });

        // Table "Messages"
        Schema::create('Messages', function (Blueprint $table) {
            $table->id('id_Messages');
            $table->longText('message_Messages');
            $table->foreignId('id_Utilisateur')->constrained('users', 'id_Utilisateur');
            $table->foreignId('id_Utilisateur_recoit')->constrained('users', 'id_Utilisateur');
            $table->timestamps();
        });

        // Table "Preferences"
        Schema::create('Preferences', function (Blueprint $table) {
            $table->foreignId('id_Utilisateur')->constrained('users', 'id_Utilisateur');
            $table->foreignId('id_Types_restaurant')->constrained('Types_restaurant', 'id_Types_restaurant');
            $table->primary(['id_Utilisateur', 'id_Types_restaurant']);
        });

        // Table "Manager"
        Schema::create('Manager', function (Blueprint $table) {
            $table->foreignId('id_Utilisateur')->constrained('users', 'id_Utilisateur');
            $table->foreignId('id_Restaurant')->constrained('Restaurant', 'id_Restaurant');
            $table->primary(['id_Utilisateur', 'id_Restaurant']);
        });

        // Table "Note"
        Schema::create('Note', function (Blueprint $table) {
            $table->foreignId('id_Utilisateur')->constrained('users', 'id_Utilisateur');
            $table->foreignId('id_Restaurant')->constrained('Restaurant', 'id_Restaurant');
            $table->integer('note_Note');
            $table->timestamps();
        });

        Schema::create('EstDeType', function (Blueprint $table) {
            $table->foreignId('id_Restaurant')->constrained('Restaurant', 'id_Restaurant');
            $table->foreignId('id_Types_restaurant')->constrained('Types_restaurant', 'id_Types_restaurant');
            $table->primary(['id_Restaurant', 'id_Types_restaurant']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('Note');
        Schema::dropIfExists('Manager');
        Schema::dropIfExists('Preferences');
        Schema::dropIfExists('Messages');
        Schema::dropIfExists('users');
        Schema::dropIfExists('Types_restaurant');
        Schema::dropIfExists('Restaurant');
        Schema::dropIfExists('EstDeType');

    }
};
