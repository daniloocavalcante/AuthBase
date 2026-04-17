<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use App\Models\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        $users_standard = [
            [   'name' => 'Danilo',
                'surname' => 'Cavalcante',
                'birth' => '2000-08-15',
                'gender' => 'male',
                'email' => 'danilo.cs10@icloud.com',
                'password' => Hash::make('danilo123'),
                'created_at' => '2020-01-02', 
                'updated_at' => '2020-01-02',
            ],
            [
                'name' => 'Danilo',
                'surname' => 'Silva',
                'birth' => '2000-08-15',
                'gender' => 'male',
                'email' => 'danilo.cs10@gmail.com',
                'password' => Hash::make('danilo123'),
                'created_at' => '2020-01-09', 
                'updated_at' => '2020-01-09',  
            ],
        ];


        foreach ($users_standard as $data_standard) {
            $user = User::create($data_standard);   //Criar usuários
            $user->assignRole('admin');
        }

        // Seeder 50 Usuários
        $users = [
            ['name'=>'Lucas','surname'=>'Silva','birth'=>'1998-03-14','gender'=>'male','email'=>'lucas.silva@email.com','password'=>Hash::make('lucas123'),'created_at'=>'2020-01-10','updated_at'=>'2020-01-10'],
            ['name'=>'Pedro','surname'=>'Oliveira','birth'=>'1995-07-21','gender'=>'male','email'=>'pedro.oliveira@email.com','password'=>Hash::make('pedro123'),'created_at'=>'2020-02-18','updated_at'=>'2020-02-18'],
            ['name'=>'Ana','surname'=>'Souza','birth'=>'1999-11-02','gender'=>'female','email'=>'ana.souza@email.com','password'=>Hash::make('ana123'),'created_at'=>'2020-03-22','updated_at'=>'2020-03-22'],
            ['name'=>'Mariana','surname'=>'Costa','birth'=>'1997-06-10','gender'=>'female','email'=>'mariana.costa@email.com','password'=>Hash::make('mariana123'),'created_at'=>'2020-04-30','updated_at'=>'2020-04-30'],
            ['name'=>'Rafael','surname'=>'Pereira','birth'=>'1994-09-18','gender'=>'male','email'=>'rafael.pereira@email.com','password'=>Hash::make('rafael123'),'created_at'=>'2020-06-15','updated_at'=>'2020-06-15'],
            ['name'=>'Carla','surname'=>'Almeida','birth'=>'1996-01-30','gender'=>'female','email'=>'carla.almeida@email.com','password'=>Hash::make('carla123'),'created_at'=>'2020-08-09','updated_at'=>'2020-08-09'],
            ['name'=>'Bruno','surname'=>'Fernandes','birth'=>'1993-04-12','gender'=>'male','email'=>'bruno.fernandes@email.com','password'=>Hash::make('bruno123'),'created_at'=>'2020-09-27','updated_at'=>'2020-09-27'],
            ['name'=>'Juliana','surname'=>'Rocha','birth'=>'1998-12-05','gender'=>'female','email'=>'juliana.rocha@email.com','password'=>Hash::make('juliana123'),'created_at'=>'2020-11-11','updated_at'=>'2020-11-11'],
            ['name'=>'Gabriel','surname'=>'Martins','birth'=>'2001-02-17','gender'=>'male','email'=>'gabriel.martins@email.com','password'=>Hash::make('gabriel123'),'created_at'=>'2020-12-20','updated_at'=>'2020-12-20'],
            ['name'=>'Fernanda','surname'=>'Barbosa','birth'=>'1997-10-09','gender'=>'female','email'=>'fernanda.barbosa@email.com','password'=>Hash::make('fernanda123'),'created_at'=>'2021-01-14','updated_at'=>'2021-01-14'],

            ['name'=>'Ricardo','surname'=>'Gomes','birth'=>'1992-08-22','gender'=>'male','email'=>'ricardo.gomes@email.com','password'=>Hash::make('ricardo123'),'created_at'=>'2021-02-21','updated_at'=>'2021-02-21'],
            ['name'=>'Patricia','surname'=>'Ribeiro','birth'=>'1995-05-19','gender'=>'female','email'=>'patricia.ribeiro@email.com','password'=>Hash::make('patricia123'),'created_at'=>'2021-03-28','updated_at'=>'2021-03-28'],
            ['name'=>'Daniel','surname'=>'Teixeira','birth'=>'1999-01-08','gender'=>'male','email'=>'daniel.teixeira@email.com','password'=>Hash::make('daniel123'),'created_at'=>'2021-05-03','updated_at'=>'2021-05-03'],
            ['name'=>'Amanda','surname'=>'Mendes','birth'=>'2000-06-14','gender'=>'female','email'=>'amanda.mendes@email.com','password'=>Hash::make('amanda123'),'created_at'=>'2021-06-19','updated_at'=>'2021-06-19'],
            ['name'=>'Eduardo','surname'=>'Batista','birth'=>'1993-11-11','gender'=>'male','email'=>'eduardo.batista@email.com','password'=>Hash::make('eduardo123'),'created_at'=>'2021-07-26','updated_at'=>'2021-07-26'],
            ['name'=>'Leticia','surname'=>'Campos','birth'=>'1998-04-07','gender'=>'female','email'=>'leticia.campos@email.com','password'=>Hash::make('leticia123'),'created_at'=>'2021-09-02','updated_at'=>'2021-09-02'],
            ['name'=>'Thiago','surname'=>'Freitas','birth'=>'1996-09-25','gender'=>'male','email'=>'thiago.freitas@email.com','password'=>Hash::make('thiago123'),'created_at'=>'2021-10-11','updated_at'=>'2021-10-11'],
            ['name'=>'Camila','surname'=>'Dias','birth'=>'1997-07-03','gender'=>'female','email'=>'camila.dias@email.com','password'=>Hash::make('camila123'),'created_at'=>'2021-11-18','updated_at'=>'2021-11-18'],
            ['name'=>'Felipe','surname'=>'Araujo','birth'=>'1994-12-18','gender'=>'male','email'=>'felipe.araujo@email.com','password'=>Hash::make('felipe123'),'created_at'=>'2021-12-29','updated_at'=>'2021-12-29'],
            ['name'=>'Larissa','surname'=>'Monteiro','birth'=>'2001-03-27','gender'=>'female','email'=>'larissa.monteiro@email.com','password'=>Hash::make('larissa123'),'created_at'=>'2022-01-17','updated_at'=>'2022-01-17'],

            ['name'=>'Rodrigo','surname'=>'Cardoso','birth'=>'1992-10-13','gender'=>'male','email'=>'rodrigo.cardoso@email.com','password'=>Hash::make('rodrigo123'),'created_at'=>'2022-02-22','updated_at'=>'2022-02-22'],
            ['name'=>'Beatriz','surname'=>'Ferreira','birth'=>'1999-05-22','gender'=>'female','email'=>'beatriz.ferreira@email.com','password'=>Hash::make('beatriz123'),'created_at'=>'2022-03-31','updated_at'=>'2022-03-31'],
            ['name'=>'Gustavo','surname'=>'Santos','birth'=>'1995-08-29','gender'=>'male','email'=>'gustavo.santos@email.com','password'=>Hash::make('gustavo123'),'created_at'=>'2022-05-09','updated_at'=>'2022-05-09'],
            ['name'=>'Vanessa','surname'=>'Lima','birth'=>'1998-02-01','gender'=>'female','email'=>'vanessa.lima@email.com','password'=>Hash::make('vanessa123'),'created_at'=>'2022-06-20','updated_at'=>'2022-06-20'],
            ['name'=>'Marcelo','surname'=>'Cunha','birth'=>'1993-06-16','gender'=>'male','email'=>'marcelo.cunha@email.com','password'=>Hash::make('marcelo123'),'created_at'=>'2022-07-27','updated_at'=>'2022-07-27'],
            ['name'=>'Renata','surname'=>'Farias','birth'=>'1997-04-04','gender'=>'female','email'=>'renata.farias@email.com','password'=>Hash::make('renata123'),'created_at'=>'2022-09-04','updated_at'=>'2022-09-04'],
            ['name'=>'Victor','surname'=>'Rezende','birth'=>'1996-07-15','gender'=>'male','email'=>'victor.rezende@email.com','password'=>Hash::make('victor123'),'created_at'=>'2022-10-15','updated_at'=>'2022-10-15'],
            ['name'=>'Bianca','surname'=>'Queiroz','birth'=>'1999-09-09','gender'=>'female','email'=>'bianca.queiroz@email.com','password'=>Hash::make('bianca123'),'created_at'=>'2022-11-22','updated_at'=>'2022-11-22'],
            ['name'=>'Caio','surname'=>'Duarte','birth'=>'1998-01-11','gender'=>'male','email'=>'caio.duarte@email.com','password'=>Hash::make('caio123'),'created_at'=>'2022-12-30','updated_at'=>'2022-12-30'],
            ['name'=>'Helena','surname'=>'Pacheco','birth'=>'2000-03-02','gender'=>'female','email'=>'helena.pacheco@email.com','password'=>Hash::make('helena123'),'created_at'=>'2023-01-18','updated_at'=>'2023-01-18'],

            ['name'=>'Matheus','surname'=>'Torres','birth'=>'1997-12-12','gender'=>'male','email'=>'matheus.torres@email.com','password'=>Hash::make('matheus123'),'created_at'=>'2023-03-03','updated_at'=>'2023-03-03'],
            ['name'=>'Paula','surname'=>'Borges','birth'=>'1996-08-08','gender'=>'female','email'=>'paula.borges@email.com','password'=>Hash::make('paula123'),'created_at'=>'2023-04-10','updated_at'=>'2023-04-10'],
            ['name'=>'Igor','surname'=>'Moraes','birth'=>'1995-02-19','gender'=>'male','email'=>'igor.moraes@email.com','password'=>Hash::make('igor123'),'created_at'=>'2023-05-21','updated_at'=>'2023-05-21'],
            ['name'=>'Natália','surname'=>'Vieira','birth'=>'1998-06-25','gender'=>'female','email'=>'natalia.vieira@email.com','password'=>Hash::make('natalia123'),'created_at'=>'2023-06-30','updated_at'=>'2023-06-30'],
            ['name'=>'Leandro','surname'=>'Assis','birth'=>'1994-03-03','gender'=>'male','email'=>'leandro.assis@email.com','password'=>Hash::make('leandro123'),'created_at'=>'2023-08-08','updated_at'=>'2023-08-08'],
            ['name'=>'Tatiane','surname'=>'Peixoto','birth'=>'1999-10-10','gender'=>'female','email'=>'tatiane.peixoto@email.com','password'=>Hash::make('tatiane123'),'created_at'=>'2023-09-17','updated_at'=>'2023-09-17'],
            ['name'=>'Samuel','surname'=>'Barreto','birth'=>'1996-01-28','gender'=>'male','email'=>'samuel.barreto@email.com','password'=>Hash::make('samuel123'),'created_at'=>'2023-10-26','updated_at'=>'2023-10-26'],
            ['name'=>'Isabela','surname'=>'Nogueira','birth'=>'2000-12-01','gender'=>'female','email'=>'isabela.nogueira@email.com','password'=>Hash::make('isabela123'),'created_at'=>'2023-12-05','updated_at'=>'2023-12-05'],
            ['name'=>'André','surname'=>'Lacerda','birth'=>'1993-09-09','gender'=>'male','email'=>'andre.lacerda@email.com','password'=>Hash::make('andre123'),'created_at'=>'2024-01-12','updated_at'=>'2024-01-12'],
            ['name'=>'Débora','surname'=>'Macedo','birth'=>'1997-05-17','gender'=>'female','email'=>'debora.macedo@email.com','password'=>Hash::make('debora123'),'created_at'=>'2024-02-20','updated_at'=>'2024-02-20'],

            ['name'=>'Vinicius','surname'=>'Ramos','birth'=>'1995-11-11','gender'=>'male','email'=>'vinicius.ramos@email.com','password'=>Hash::make('vinicius123'),'created_at'=>'2024-03-30','updated_at'=>'2024-03-30'],
            ['name'=>'Camila','surname'=>'Guedes','birth'=>'1998-02-02','gender'=>'female','email'=>'camila.guedes@email.com','password'=>Hash::make('camila123'),'created_at'=>'2024-05-10','updated_at'=>'2024-05-10'],
            ['name'=>'Douglas','surname'=>'Pinto','birth'=>'1994-04-04','gender'=>'male','email'=>'douglas.pinto@email.com','password'=>Hash::make('douglas123'),'created_at'=>'2024-06-18','updated_at'=>'2024-06-18'],
            ['name'=>'Elaine','surname'=>'Rezende','birth'=>'1996-07-07','gender'=>'female','email'=>'elaine.rezende@email.com','password'=>Hash::make('elaine123'),'created_at'=>'2024-07-29','updated_at'=>'2024-07-29'],
            ['name'=>'Fábio','surname'=>'Sales','birth'=>'1993-12-12','gender'=>'male','email'=>'fabio.sales@email.com','password'=>Hash::make('fabio123'),'created_at'=>'2024-09-03','updated_at'=>'2024-09-03'],
            ['name'=>'Gabriela','surname'=>'Tavares','birth'=>'1999-01-21','gender'=>'female','email'=>'gabriela.tavares@email.com','password'=>Hash::make('gabriela123'),'created_at'=>'2024-10-14','updated_at'=>'2024-10-14'],
            ['name'=>'Hugo','surname'=>'Neves','birth'=>'1995-05-05','gender'=>'male','email'=>'hugo.neves@email.com','password'=>Hash::make('hugo123'),'created_at'=>'2024-11-23','updated_at'=>'2024-11-23'],
            ['name'=>'Joana','surname'=>'Brandão','birth'=>'1998-08-08','gender'=>'female','email'=>'joana.brandao@email.com','password'=>Hash::make('joana123'),'created_at'=>'2025-01-04','updated_at'=>'2025-01-04'],
            ['name'=>'Kevin','surname'=>'Amaral','birth'=>'1997-09-14','gender'=>'male','email'=>'kevin.amaral@email.com','password'=>Hash::make('kevin123'),'created_at'=>'2025-02-16','updated_at'=>'2025-02-16'],
            ['name'=>'Lívia','surname'=>'Siqueira','birth'=>'2000-04-04','gender'=>'female','email'=>'livia.siqueira@email.com','password'=>Hash::make('livia123'),'created_at'=>'2025-03-28','updated_at'=>'2025-03-28'],
        ];

        foreach ($users as $data) {
            $user = User::create($data);
            $user->assignRole('user');
        }

    }
}
