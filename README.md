# Тестовое задание для кандидатов на позицию junior backend-developer

Данное тестовое задание предполагает создание нескольких таблиц, моделей для работы с таблицам и апи для получения и создания записей в таблице

## Подготовка

1) Создайте свой пустой репозиторий на github (без форка этого репозитория)
2) Скачайте этот репозиторий как zip-архив и распакуйте
3) Закомитьте распакованные файлы в свой пустой репозиторий как `test begin`
4) Когда закончите выполнение задания и успешно пройдете тест через phpunit, закомитье изменения как `test passed`
5) Отправьте своё резюме и ссылку на ваш репозиторий на `undermuz@gmail.com`

## Зависимости

Нужно убедиться что в php.ini включены нужные расширения: mbstring и sqlite3

Установить composer локально или глобально

Установить зависимости: `php composer.phar install` (`composer install`)

Проверка будет производиться на версии PHP 8.0.15

## Настройте код для работы с БД

В файле `src\db\connection.php` должно быть подключение к БД sqlite

В файле `scr\db\initial.php` должно быть создание начальных таблиц для работы кода (ссылка на подключение с предыдущего шага будет в аргументе функции):

`users`

1) id - число, уникальный, авто-инкремент
2) email - строка
3) first_name - строка
4) last_name - строка
5) password - строка
6) created_at - число

`post`

1) id - число, уникальный, авто-инкремент
2) title - строка
3) body - строка
4) creator_id - связь с user.id
5) created_at - число

Выполните команду `php composer.phar bootstrap` (`composer bootstrap`) для выполнения скрипта поднятия таблиц из `scr\db\initial.php`

Нужно убедиться что база данных создана верно, через программу для просмотра sqlite баз данных

## Создайте модели

В папке `src\Models` должны быть созданы классы User и Post отвечающие за соответствующие таблицы в БД

Экземпляр класса каждой модели должен хранить соответствующие поля как свойства класса, и метод сохранения в таблицу

Класс каждой модели должен иметь статический метод findOne который возвращает последнюю (по ID) запись в соответствующей таблице как экземпляр класса

При создании записи в таблицах, должен указываться created_at = текущий unix-timestamp

После записи в таблицу, в экземпляре класса должен установиться ID из БД (полученный авто-инкрементом)

Получить текущее подключение к БД из `src\db\connection.php` можно через App\db\DB::getInstance()->getConnection();

Проверьте ваш код командой `php composer.phar test:db` (`composer test:db`)

## Создание API

В файле `src\api` есть класс `Api` и метод `connection`, нужно дописать класс и метод чтобы принимать запросы:

`GET /api/users/:id` - где `:id` это число, указывающие ID из таблицы users, на этот запрос должен вернуться ответ в формате JSON с полями из таблицы users по полученному ID, пример:

```text
//Request:
GET /api/users/1

//Response:
{
    "id": 1,
    "email": "some-email@mail.com",
    "first_name": "SomeName",
    "last_name": "SomeLastName",
    "password": "SomePassword",
    "created_at": 1659633384,
}
```

```text
PUT /api/users

{
    "email": :email,
    "first_name": :first_name,
    "last_name": :last_name,
    "password": :password,
}
```

- где `:email`, `:first_name`, `:last_name` и `:password` это поля в таблице users для создания в ней записи, на этот запрос должен вернуться ответ в формате JSON с полями из таблицы users по полученной после создания записи, пример:

```text
//Request:
PUT /api/users

{
    "email": "api-email@mail.com",
    "first_name": "ApiName",
    "last_name": "ApiLastName",
    "password": "ApiPassword",
}

//Response:
{
    "id": 23,
    "email": "api-email@mail.com",
    "first_name": "ApiName",
    "last_name": "ApiLastName",
    "password": "ApiPassword",
    "created_at": 1659633584,
]
```

Перед проверкой кода, запустите локальный сервер командой: `php composer.phar serve` (`composer serve`)

Проверьте ваш код командой `php composer.phar test:api` (`composer test:api`)

## Запустите тест

Выполните команду `php composer.phar test` (`composer test`)
