


---
app|
---
<<<|Models
- public const STATUS_WAIT = 'wait'
        
        Константы лучше делать строкой в БД, чтобы не заморачиваться с цифрами
- public function isWait(): bool

        Методы, которые возвращают свойство модели. Чтобы не писать в других клссах и главное в view длинные строки с логикой
- public function verify(): void

        Метод в модели, чтобы не писать в контроллере (для удобства тестов в первую очередь ?)
        
<<<|Controllers

<<<|Services

database|
---
<<<|migrations

routes|
---
<<<|web.php

tests|
---
<<<|Unit
