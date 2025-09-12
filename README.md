# Запуск приложения

composer i

установить свои настройки в env.example и переименовать в env
пример:
DB_CONNECTION=pgsql
DB_HOST=localhost
DB_PORT=5432
DB_DATABASE=user_balance
DB_USERNAME=postgres
DB_PASSWORD=postgres


php artisan migrate

composer run dev

npm i

npm run dev

## Добавление пользователя
php artisan app:add-user {name} {email} {password}

## Добавление баланса пользователю
app:add-balance {user_id} {total} {currency}

## Добавление операции через пользователя
app:add-operation-by-user {user_id} {currency} {type} {sum}

type(debit или credit)

## Добавление операции через баланс
app:add-operation-by-balance {balance_id} {type} {sum}

type(debit или credit)


## Главная страница
http://localhost:5174/

## Страница входа
http://localhost:5174/login

## Страница истории операций
http://localhost:5174/history


 
