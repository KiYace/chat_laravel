# chat_laravel
RealTime chat on laravel-webcockets

# Installation
1. Clone this repo
2. Copy ``.env.exapmle`` file to .env
3. Enter DB connection to .env file
4. Fill empty PUSHER_ values with a random values
5. Fill ``MIX_WEBSOCKET_HOST`` by your ``APP_HOST``
6. Fill ``MIX_WEBSOCKET_PORT`` by your ``PUSHER_APP_PORT``
7. Go to terminal to project folder and enter ``docker-compose -f docker-compose.yml up -d``
8. Go to ``chat_php`` by ``docker exec -it chat_php sh``
9. Enter next commands:
- ``composer install``
- ``php artisan key:generate``
- ``php artisan migrate``
- ``npm install``
- ``npm run dev``
- ``php artisan websocket:serve``
10. Set your ``APP_HOST`` to your /etc/hosts

All done! Your application ready, enjoy it!
