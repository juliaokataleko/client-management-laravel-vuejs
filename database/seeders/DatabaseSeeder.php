<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\Client;
use App\Models\Country;
use App\Models\State;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        User::create([
            'name' => 'Administrador',
            'email' => 'admin@email.com',
            'username' => 'admin',
            'password' => bcrypt('admin'),
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
        ]);

        $countries = [
            [
                'name' => 'Angola',
                'country_code' => 'AO',
                'provincies' => [

                    [
                        "name" => "Bengo",
                        "municipios" => [
                            "Ambriz",
                            "Dande",
                            "Dembos",
                            "Bula Atumba",
                            "Nambuangongo",
                            "Pango Aluquêm",
                        ]
                    ],
                    [
                        "name" => "Benguela",
                        "municipios" => [
                            "Benguela",
                            "Lobito",
                            "Caimbambo",
                            "Ganda",
                            "Cubal",
                            "Catumbela",
                            "Balombo",
                            "Bocoio",
                            "Baia Farta",
                            "Chongoroi"
                        ]
                    ],
                    [
                        "name" => "Luanda",
                        "municipios" => [
                            "Belas",
                            "Cacuaco",
                            "Cazenga",
                            "Icolo e Bengo",
                            "Luanda",
                            "Quiçama",
                            "Kilamba Kiaxi",
                            "Talatona",
                            "Viana"
                        ]
                    ],
                    [
                        "name" => "Huíla",
                        "municipios" => [
                            "Caconda",
                            "Cacula",
                            "Caluquembe",
                            "Chiange",
                            "Chibia",
                            "Chicomba",
                            "Chipindo",
                            "Humpata",
                            "Jamba",
                            "Kuvango",
                            "Lubango",
                            "Matala",
                            "Quilengues",
                            "Quipungo",
                        ]
                    ],
                    [
                        "name" => "Huambo",
                        "municipios" => [
                            "Bailundo ",
                            "Catchiungo",
                            "Caála ",
                            "Ekunha",
                            "Huambo",
                            "Londuimbale",
                            "Longongo",
                            "Mungo",
                            "Tchicala-Tcholoanga",
                            "Tchindjenje",
                            "Ucuma",
                        ]
                    ],
                    [
                        "name" => "Cabinda",
                        "municipios" => [
                            "Belize",
                            "Buco-Zau",
                            "Cabinda",
                            "Cacongo",
                        ]
                    ],
                    [
                        "name" => "Moxico",
                        "municipios" => [
                            "Alto Zambeze",
                            "Bundas ",
                            "Camanongue",
                            "Cameia",
                            "Luau",
                            "Lucano",
                            "Luchazes",
                            "Léua",
                            "Moxico",
                        ]
                    ],
                    [
                        "name" => "Namibe",
                        "municipios" => [
                            "Bibala",
                            "Camulo",
                            "Namibe",
                            "Tômbua",
                            "Virei",
                        ]
                    ],
                    [
                        "name" => "Bié",
                        "municipios" => [
                            "Andulo",
                            "Camacupa",
                            "Catabola",
                            "Chinguar",
                            "Chitembo",
                            "Cuemba",
                            "Cunhinga",
                            "Kuito",
                            "Nharea",
                        ]
                    ],
                    [
                        "name" => "Kuando Kubango",
                        "municipios" => [
                            "Calai",
                            "Cuangar",
                            "Cuchi",
                            "Cuito Cuanavale",
                            "Dirico",
                            "Longa",
                            "Mavinga",
                            "Menongue",
                            "Rivungo",
                        ]
                    ],
                    [
                        "name" => "Uíge",
                        "municipios" => [
                            "Alto Cauale",
                            "Ambuíla ",
                            "Bembe",
                            "Buengas",
                            "Bungo",
                            "Damba",
                            "Macocola",
                            "Mucaba",
                            "Negage",
                            "Puri",
                            "Quimbele",
                            "Quitexe",
                            "Sanza Pombo",
                            "Songo",
                            "Uíge",
                            "Maquela do Zombo",
                        ]
                    ],
                    [
                        "name" => "Lunda Norte",
                        "municipios" => [
                            "Cambulo",
                            "Capenda-Camulemba",
                            "Caungula",
                            "Chitato (Tchitato)",
                            "Cuango",
                            "Cuilo",
                            "Lóvua",
                            "Lubalo",
                            "Lucapa",
                            "Xá Muteba",
                        ]
                    ],
                    [
                        "name" => "Lunda Sul",
                        "municipios" => [
                            "Cacolo",
                            "Dala",
                            "Muconda",
                            "Saurimo",
                        ]
                    ],
                    [
                        "name" => "Kwanza Norte",
                        "municipios" => [
                            "Ambaca",
                            "Banga",
                            "Bolongongo",
                            "Cambambe",
                            "Cazengo",
                            "Golungo Alto",
                            "Gonguembo",
                            "Lucala",
                            "Quiculungo",
                            "Samba Caju",
                        ]
                    ],
                    [
                        "name" => "Kwanza Sul",
                        "municipios" => [
                            "Amboim",
                            "Cassongue",
                            "Conda",
                            "Ebo",
                            "Libolo",
                            "Mussende",
                            "Porto Amboim",
                            "Quibala",
                            "Quilenda",
                            "Seles",
                            "Sumbe",
                            "Waku Kungo",
                        ]
                    ],
                    [
                        "name" => "Malange",
                        "municipios" => [
                            "Cacuso",
                            "Calandula ",
                            "Cambundi-Catembo",
                            "Cangandala",
                            "Caombo",
                            "Cuaba Nzogo",
                            "Cunda-Diaza ",
                            "Luquembo",
                            "Malange",
                            "Marimba",
                            "Massango",
                            "Caculama-Mucari",
                            "Quela",
                            "Quirima",
                        ]
                    ],
                    [
                        "name" => "Zaire",
                        "municipios" => [
                            "Cuimba",
                            "M 'Banza Kongo",
                            "Noqui",
                            "N'Zeto",
                            "Soyo",
                            "Tomboco",
                        ]
                    ],
                    [
                        "name" => "Cunene",
                        "municipios" => [
                            "Cahama",
                            "Cuanhama",
                            "Curoca",
                            "Cuvelay",
                            "Namacunde",
                            "Ombadja",
                        ]
                    ]
                ]
            ],
            [
                'name' => 'BRASIL',
                'country_code' => 'BR',
                'provincies' => [

                    [
                        "name" => "São Paulo",
                        "municipios" => [
                            "Guarulhos",
                            "São Paulo",
                            "Campinas",
                            "São Bernardo do Campo",
                            "São José dos Campos",
                            "Santo André",
                            "Ribeirão Preto",
                            "Osasco",
                            "Sorocaba",
                            "Mauá",
                            "São José do Rio Preto",
                            "Mogi das Cruzes",
                        ]
                    ],
                ]
            ],
        ];

        foreach ($countries as $key => $country) {

            $data = [
                "name" => $country['name'],
                "code" => $country['country_code'],
            ];

            $id = Country::insertGetId($data);

            foreach ($country['provincies'] as $province) {

                $data = [
                    "name" => $province['name'],
                    "country_id" => $id,
                ];
                $state_code = State::insertGetId($data);

                foreach ($province['municipios'] as $municipio) {

                    $data = [
                        'name' => $municipio,
                        'state_id' => $state_code,
                        'country_id' => $id
                    ];

                    City::insert($data);
                }
            }
        }

        for ($i = 0; $i < 20; $i++) {
            $country = Country::find(2);
            $state = State::where('country_id', $country->id)->first();
            $city = City::where('state_id', $state->id)->first();

            if (is_null($country)) $country = Country::first();
            if (is_null($state)) $state = State::first();
            if (is_null($city)) $city = City::first();

            $dataClient = [
                'name' => 'Cliente ' . $i,
                'email' => "email$i@gmail.com",
                'phone' => rand(900000000, 999999999),
                'birthday' => date('Y-m-d', strtotime('17-12-1900')),
                'country_id' => $country->id,
                'state_id' => $state->id,
                'city_id' => $city->id,
                'address' => 'Endereço do cliente ' . $i,
            ];

            $client = Client::create($dataClient);
        }
    }
}
