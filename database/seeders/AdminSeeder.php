<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'firstname' => 'Alice',
            'lastname' => 'Porebski',
            'email' => 'alice.porebski@eilco-ulco.fr',
            'password' => Hash::make('hyperbdd2021'),
            'validated_by_admin' => true,
            'role_id' => 1,
            'fax'=> '03 21 38 85 05',
            'phone_number'=>'03 21 38 85 60',
            'academic_career'=>"Alice POREBSKI a obtenu sa thèse de doctorat en 2009 à l'Université de Lille 1 Sciences et Technologies. Depuis 2010, elle a rejoint l'Université du Littoral Côte d'Opale. Ses activités de recherche portent sur la sélection d'attributs, la caractérisation des textures couleur, l'analyse d'images par approche spectrale. Ses travaux ont abouti à 5 revues internationales, 2 chapitres d'ouvrages scientifiques et une quinzaine de communications avec actes dans des congrès nationaux ou internationaux. Ses travaux de recherche ont été appliqués au contrôle qualité industriel pour détecter et identifier en temps réel des défauts sur des décors verriers.",
            'description'=>"Ma thématique de recherche concernent principalement la classification d'images et plus précisément la caractérisation des textures couleur et la sélection d'attributs. En ce qui concerne la caractérisation des textures couleur, la problématique abordée concerne l'influence de l'espace couleur considéré pour discriminer les classes de texture en présence. En effet, la couleur des pixels peut être représentée dans différents espaces couleur qui respectent différentes propriétés. De nombreux auteurs travaillant sur la classification d'images de texture couleur ont comparé les résultats de classification obtenus en considérant différents espaces couleur afin de déterminer le plus pertinent.",
            'created_at' => Carbon::now()

        ]);
        //
    }
}
