


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

routes|
---
<<<|web.php

tests|
---
<<<|Unit
