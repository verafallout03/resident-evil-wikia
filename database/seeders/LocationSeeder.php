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
                'image'        => 'https://static.wikia.nocookie.net/residentevil/images/9/9b/RaccoonCityView2.jpg/revision/latest?cb=20121015193310&path-prefix=es',
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
                'image'        => 'https://static.wikia.nocookie.net/residentevil/images/d/d0/Spencer_estate_%28Arklay%29.jpg/revision/latest?cb=20110122042123&path-prefix=es',
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
                'image'        => 'https://static.wikia.nocookie.net/residentevil/images/5/5b/Raccoon_Police_Station_remake.png/revision/latest?cb=20200807080725&path-prefix=es',
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
                'image'        => 'https://static.wikia.nocookie.net/residentevil/images/b/b8/Rockfort_Island_Arwork2.png/revision/latest?cb=20180330105401&path-prefix=es',
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
                'image'        => 'https://static.wikia.nocookie.net/residentevil/images/7/77/Nintendo-Dolphin-1080p-Wallpaper-08-Resident-Evil-4-RE4-Ganados-Village-Town-Church.jpg/revision/latest?cb=20150415023124&path-prefix=es',
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
                'image'        => 'https://static.wikia.nocookie.net/residentevil/images/3/3b/Salazar_castle.jpg/revision/latest?cb=20120521204135&path-prefix=es',
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
                'image'        => 'https://static.wikia.nocookie.net/residentevil/images/4/47/Kijuju1.jpg/revision/latest/scale-to-width-down/2560?cb=20091201074439',
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
                'image'        => 'https://static.wikia.nocookie.net/residentevil/images/8/86/Baker_mansion.jpg/revision/latest?cb=20161116033441&path-prefix=es',
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
                'image'        => 'https://static.wikia.nocookie.net/residentevil/images/b/bf/Castillo_Dimitrescu.jpg/revision/latest?cb=20210516074326&path-prefix=es',
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
                'image'        => 'https://static.wikia.nocookie.net/residentevil/images/4/4e/Queen_Zenobia.jpg/revision/latest?cb=20120130013052&path-prefix=es',
                'is_published' => true,
                'created_at'   => now(),
                'updated_at'   => now(),
            ],
        ];

        DB::table('locations')->insert($locations);
    }
}
