## Instalación

Para ejecutar el proyecto debe ejecutar las migraciones de Laravel

```bash
php artisan migrate --seed
```

Adicionalmente se deben configurar las siguientes variables de entorno:
```txt
PLACETOPAY_LOGIN="YOUR_LOGIN"
PLACETOPAY_TRANSKEY="YOUR_TRANKEY"
PLACETOPAY_URL_BASE="THE_BASE_URL_TO_POINT_AT"
PLACETOPAY_TIMEOUT="PLAYTOPAY_REST_TIMEOUT"
PLACETOPAY_CONNECT_TIMEOUT="PLAYTOPAY_REST_CONNECT_TIMEOUT"
```

## Prueba de conexión del servicio placetopay
```bash
php artisan test --parallel --recreate-databases
```
