<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Country;
use App\Models\Film;
use App\Models\Genre;
use App\Models\Producer;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder {

    public function run() {

        // жанры
        collect([
            'биография',                    // 1
            'боевик',                       // 2
            'вестерн',                      // 3
            'военный',                      // 4
            'детектив',                     // 5
            'детский',                      // 6
            'документальный',               // 7
            'драма',                        // 8
            'история',                      // 9
            'комедия',                      // 10
            'криминал',                     // 11
            'ужасы',                        // 12
            'фантастика',                   // 13
        ])
            ->map(fn($a) => (new Genre(['name' => $a]))->save());


        // страны
        collect([
            'Венгрия',          // 1
            'Германия',         // 2
            'Испания',          // 3
            'Канада',           // 4
            'Норвегия',         // 5
            'Россия',           // 6
            'СССР',             // 7
            'США',              // 8
            'Украина',          // 9
        ])
            ->map(fn($a) => (new Country(['name' => $a]))->save());


        // режиссёры
        collect([
            new Producer(['surname' => 'Спилберг', 'name' => 'Стивен', 'image' => 'spilberg.webp', 'date_of_birth' => '1964-12-18']),
            new Producer(['surname' => 'Дарабонт', 'name' => 'Фрэнк', 'image' => 'darabont.webp', 'date_of_birth' => '1959-01-28']),
            new Producer(['surname' => 'Гайдай', 'name' => 'Леонид', 'patronymic' => 'Иович', 'image' => 'gajday.webp', 'date_of_birth' => '1923-01-30']),
            new Producer(['surname' => 'Рязанов', 'name' => 'Эльдар', 'patronymic' => 'Александрович', 'image' => 'ryzanov.webp', 'date_of_birth' => '1927-11-18']),
            new Producer(['surname' => 'Парри', 'name' => 'Эдуард', 'patronymic' => 'Иванович', 'image' => 'parri.webp', 'date_of_birth' => '1973-09-06']),
            new Producer(['surname' => 'Нолан', 'name' => 'Кристофер', 'image' => 'christopher_nolan.webp', 'date_of_birth' => '1970-07-30']),
            new Producer(['surname' => 'Коламбус', 'name' => 'Крис', 'image' => 'chris_columbus.webp', 'date_of_birth' => '1958-09-10']),
            new Producer(['surname' => 'Ричи', 'name' => 'Гай', 'image' => 'guy_ritchie.webp', 'date_of_birth' => '1968-09-10']),
            new Producer(['surname' => 'Кэмерон', 'name' => 'Джеймс', 'image' => 'james_cameron.webp', 'date_of_birth' => '1954-08-16']),
            new Producer(['surname' => 'Миядзаки', 'name' => 'Хаяо', 'image' => 'hayao_miyazaki.webp', 'date_of_birth' => '1941-01-05']),
        ])
            ->map(fn($a) => $a->save());

        // фильмы
        collect([
            new Film(['name' => 'Фабельманы', 'producer_id' => 1, 'release_date' => '2022-10-10', 'genre_id' => 8,
                'budget' => 4e7, 'image' => 'fabelmany.webp', 'country_id' => 8]),
            new Film(['name' => 'Поймай меня, если сможешь', 'producer_id' => 1, 'release_date' => '2002-02-13', 'genre_id' => 11,
                'budget' => 42e6, 'image' => 'catch_me_if_you_can.webp', 'country_id' => 8]),
            new Film(['name' => 'Под куполом', 'producer_id' => 1, 'release_date' => '2013-07-14', 'genre_id' => 13,
                'budget' => 40e6, 'image' => 'under_the_dome.webp', 'country_id' => 8]),
            new Film(['name' => 'Ходячие мертвецы', 'producer_id' => 2, 'release_date' => '2010-11-04', 'genre_id' => 12,
                'budget' => 15e6, 'image' => 'the_walking_dead.webp', 'country_id' => 8]),
            new Film(['name' => 'Зеленая миля', 'producer_id' => 2, 'release_date' => '2000-04-18', 'genre_id' => 8,
                'budget' => 60e6, 'image' => 'the_green_mile.webp', 'country_id' => 8]),
            new Film(['name' => 'Форрест Гамп', 'producer_id' => 2, 'release_date' => '1994-06-23', 'genre_id' => 8,
                'budget' => 55e6, 'image' => 'forrest_gump.webp', 'country_id' => 8]),
            new Film(['name' => 'Иван Васильевич меняет профессию', 'producer_id' => 3, 'release_date' => '1973-09-17', 'genre_id' => 8,
                'budget' => 1e6, 'image' => 'ivan_vasilyevich.webp', 'country_id' => 7]),
            new Film(['name' => 'Бриллиантовая рука', 'producer_id' => 3, 'release_date' => '1969-04-28', 'genre_id' => 10,
                'budget' => 2e6, 'image' => 'bryliantovaya_ruka.webp', 'country_id' => 7]),
            new Film(['name' => 'Служебный роман', 'producer_id' => 4, 'release_date' => '1977-10-26', 'genre_id' => 10,
                'budget' => 5e6, 'image' => 'sluzgebnyj_roman.webp', 'country_id' => 7]),
            new Film(['name' => 'Ирония судьбы, или С легким паром!', 'producer_id' => 4, 'release_date' => '1976-05-18', 'genre_id' => 8,
                'budget' => 6e6, 'image' => 'ironya_sudby.webp', 'country_id' => 7]),
            new Film(['name' => 'Шулер', 'producer_id' => 5, 'release_date' => '2013-09-23', 'genre_id' => 11,
                'budget' => 8e6, 'image' => 'shuller.webp', 'country_id' => 9]),
            new Film(['name' => 'От печали до радости', 'producer_id' => 5, 'release_date' => '2020-09-14', 'genre_id' => 11,
                'budget' => 7e6, 'image' => 'ot_pechaly_do_radosti.webp', 'country_id' => 6]),
        ])
            ->map(fn($a) => $a->save());
    }
}
