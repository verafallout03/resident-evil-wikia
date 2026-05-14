<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LocationSeeder extends Seeder
{
    public function run(): void
    {
        $locations = [
            [
                'name'         => 'Raccoon City',
                'slug'         => 'raccoon-city',
                'region'       => 'Midwest',
                'country'      => 'Estados Unidos',
                'description'  => 'Ciudad ficticia del Medio Oeste americano y epicentro del brote del virus-T en 1998. Fue destruida por un misil nuclear lanzado por el gobierno para contener la infección.',
                'image'        => null,
                'is_published' => true,
                'created_at'   => now(),
                'updated_at'   => now(),
            ],
            [
                'name'         => 'Mansión Spencer',
                'slug'         => 'mansion-spencer',
                'region'       => 'Arklay Mountains',
                'country'      => 'Estados Unidos',
                'description'  => 'Enorme mansión victoriana propiedad de Oswell E. Spencer, usada como laboratorio secreto de Umbrella. Escenario principal del primer Resident Evil.',
                'image'        => null,
                'is_published' => true,
                'created_at'   => now(),
                'updated_at'   => now(),
            ],
            [
                'name'         => 'Comisaría de Raccoon City',
                'slug'         => 'raccoon-city-police-department',
                'region'       => 'Raccoon City',
                'country'      => 'Estados Unidos',
                'description'  => 'Antigua galería de arte reconvertida en cuartel general del Departamento de Policía de Raccoon City. Escenario central de Resident Evil 2.',
                'image'        => null,
                'is_published' => true,
                'created_at'   => now(),
                'updated_at'   => now(),
            ],
            [
                'name'         => 'Isla Rockfort',
                'slug'         => 'rockfort-island',
                'region'       => 'Atlántico Sur',
                'country'      => 'Internacional (aguas internacionales)',
                'description'  => 'Isla privada utilizada por Umbrella como instalación de detención y laboratorio de investigación. Escenario de Resident Evil – Code: Veronica.',
                'image'        => null,
                'is_published' => true,
                'created_at'   => now(),
                'updated_at'   => now(),
            ],
            [
                'name'         => 'Pueblo de los Ganados',
                'slug'         => 'pueblo-ganados',
                'region'       => 'Rural',
                'country'      => 'España',
                'description'  => 'Pueblo rural aislado en España, cuyos habitantes han sido infectados con Las Plagas y controlados por Los Iluminados. Zona de inicio de Resident Evil 4.',
                'image'        => null,
                'is_published' => true,
                'created_at'   => now(),
                'updated_at'   => now(),
            ],
            [
                'name'         => 'Castillo Salazar',
                'slug'         => 'castillo-salazar',
                'region'       => 'Rural',
                'country'      => 'España',
                'description'  => 'Imponente castillo medieval propiedad de Ramon Salazar, custodio de las Plagas y seguidor de Los Iluminados. Escenario principal del acto II de RE4.',
                'image'        => null,
                'is_published' => true,
                'created_at'   => now(),
                'updated_at'   => now(),
            ],
            [
                'name'         => 'Kijuju',
                'slug'         => 'kijuju',
                'region'       => 'África Oriental',
                'country'      => 'República ficticia de Kijuju',
                'description'  => 'Región ficticia de África subsahariana devastada por el tráfico de armas biológicas y el parásito Uroboros. Escenario de Resident Evil 5.',
                'image'        => null,
                'is_published' => true,
                'created_at'   => now(),
                'updated_at'   => now(),
            ],
            [
                'name'         => 'Granja Baker',
                'slug'         => 'granja-baker',
                'region'       => 'Louisiana',
                'country'      => 'Estados Unidos',
                'description'  => 'Propiedad aislada de la familia Baker en los pantanos de Louisiana. Infectada por el moho Mold y escenario de los primeros actos de Resident Evil 7.',
                'image'        => null,
                'is_published' => true,
                'created_at'   => now(),
                'updated_at'   => now(),
            ],
            [
                'name'         => 'Pueblo de los Cuatro Señores',
                'slug'         => 'pueblo-cuatro-senores',
                'region'       => 'Europa del Este',
                'country'      => 'Rumanía (ficticio)',
                'description'  => 'Misterioso pueblo de montaña en Europa del Este dominado por Mother Miranda y los Cuatro Señores. Escenario principal de Resident Evil Village.',
                'image'        => null,
                'is_published' => true,
                'created_at'   => now(),
                'updated_at'   => now(),
            ],
            [
                'name'         => 'Castillo Dimitrescu',
                'slug'         => 'castillo-dimitrescu',
                'region'       => 'Europa del Este',
                'country'      => 'Rumanía (ficticio)',
                'description'  => 'Majestuoso castillo gótico habitado por Lady Alcina Dimitrescu y sus tres hijas. Conocido por sus vinos y sus siniestros secretos en RE Village.',
                'image'        => null,
                'is_published' => true,
                'created_at'   => now(),
                'updated_at'   => now(),
            ],
            [
                'name'         => 'Queen Zenobia',
                'slug'         => 'queen-zenobia',
                'region'       => 'Mar Mediterráneo',
                'country'      => 'Aguas internacionales',
                'description'  => 'Crucero de lujo aparentemente abandonado en el Mediterráneo. Escenario de Resident Evil: Revelations, infectado con el virus T-Abyss.',
                'image'        => null,
                'is_published' => true,
                'created_at'   => now(),
                'updated_at'   => now(),
            ],
        ];

        DB::table('locations')->insert($locations);
    }
}
