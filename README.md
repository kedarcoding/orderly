# orderly
Interview Task Work

Order Management System – Laravel + Vue 3
This is a mini Order Management System built using Laravel 11 (REST API) as backend and Vue 3 + TailwindCSS as frontend.
 
You must open two command prompt for laravel and vuejs.

First Terminal / run commands :

git clone https://github.com/kedarcoding/orderly.git

*****PHP / Laravel  setup****

cd orderly/api
composer install
cp .env.example .env


****Set DB details in .env   ensure db name password username etc in .env***

php artisan key:generate

php artisan migrate --seed

php artisan serve  

backend will run on  http://localhost:8000      ( this is backend url not frontend  )

terminal 2 : For Vue3 

cd orderly/frontend

npm install

npm run dev

run URL :    http://localhost:5173                    This is final url run and test


📋 Features
✅ Create new orders

📄 View paginated list of orders

🔁 Update order status (paid, pending, cancelled)

💬 Status update feedback + toast messages

🧪 Basic input validations

💅 Tailwind CSS styling
