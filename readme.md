В проекте использовались
---

- Breadcrumbs (https://github.com/davejamesmiller/laravel-breadcrumbs) Неподдерживаемый
- Nestedset (https://github.com/lazychaser/laravel-nestedset)
- Phpunit tests

---
app|
---
<<<|Models
- public const STATUS_WAIT = 'wait'
        
        Константы лучше делать строкой в БД, чтобы не заморачиваться с цифрами
- public function isWait(): bool

        Методы, которые возвращают свойство модели. Чтобы не писать в других клссах и главное в view длинные строки с логикой
- public function verify(): void

        Метод в модели, чтобы не писать в контроллере|сервисе (для удобства тестов в первую очередь ?). Кидает exeption, ловим в try/catch
        
---
<<<|Controllers
- public function show(User $user) (Admin/UsersController)

        Не передаем в вид выпадающий список статусов юзеров active|wait, вместо этого используем метод verify, кот-ый меняет wait на active

---
<<<|Services

    Сервисы нужны для переиспользования методов. Например верификация юзера в RegisterController и Admin\UsersController
- public function verify($id): void

        Лучше принимать id юзера и получать его внутри сервиса (чтобы случайно не передать измененного юзера в контроллере или типа того ?)

database|
---
<<<|migrations

---
<<<|factories

- $factory->state(User::class, 'admin', [ 'email' => 'admin@admin.admin', ]);

        Создаем стейт для фабрики, который можно будет вызывать отдельно
        
---
<<<|seeds

- factory(User::class, 1)->states('admin')->create();

    Создаем экземпляр нужного стейта фабрики

resources|
---
<<<|views|layouts|app.blade.php

    mix() - путь до css, js, прописанный в ларавел миксе вебпака
    <link href="{{ mix('css/app.css', 'build') }}" rel="stylesheet">
    <script src="{{ mix('js/app.js', 'build') }}"></script>

routes|
---
<<<|web.php

- Route::group( [ 'prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth'], ], function() {} );

        Группируем роуты
        
tests|
---
<<<|Unit

- use DatabaseTransactions;

        Трейт, который откатывает БД после выполнения теста. Например user создался-удалился ?

---
webpack.mix.js
    
        mix
            .setPublicPath('public/build') //sets the base output path for any mix assets. Fonts, images etc.
            .setResourceRoot('/build/') // sets the base output path in the generated assets relative to the public root (e.g. url('/css/fonts/font.tty'));
            .js('resources/assets/js/app.js', 'js')
            .sass('resources/assets/sass/app.scss', 'css')
            .version(); // Чтобы добавлялось версионирование в названии файлов (сбрасывались css и тд)

Подходы в разработке
---
RAD

    Быстрая разработка. Фигак и в продакшн. Код в контроллерах
Service Layer

    Вынесение логики в сервисы. Для переиспользования методов в разных местах.
Command Bus

    Для больших проектов. Если сервисы слишком распухают и  не справляются
CQRS

    Query Bus. Тоже только для больших проектов. Усложняет код. НАпример, если 2 БД в проекте и 2 набора сущностей 
