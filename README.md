# sonetasot

## Repositorio

- **Usuario de GitHub:** [@JUzielCrz](https://github.com/JUzielCrz)
- **Proyecto:** [Sonetasot](https://github.com/JUzielCrz/sonetasot)
- **Clonar:** `git clone https://github.com/JUzielCrz/sonetasot.git`


## Api Laravel 

### Proyecto: ApiRest

- **laravel/framework:** "^10.10",
- **php:**  "^8.1"

### Rutas establecidas en el proyecto:
```bash
        POST: http://127.0.0.1:8000/api/appointment
            body ejemplo:
                {
                    "name" : "Diego",
                    "last_name" : "Martinez",
                    "phone" : "9513057889",
                    "date" : "2022-01-15",
                    "curp" : "AOCU941218HOCLRZ99",
                    "email" : "diego_003@gmailcom",
                    "password" : "password"
                }
        
        POST: http://127.0.0.1:8000/api/auth/login
            body ejemplo:
                {
                    "email" : "diego_003@gmailcom",
                    "password" : "password"
                }
        GET: http://127.0.0.1:8000/api/appointment/1  (ocupa token)
        DELETE: http://127.0.0.1:8000/api/appointment/1  (ocupa token)
        UPDATE: http://127.0.0.1:8000/api/appointment/1  (ocupa token)
```

### Clonar el repositorio del proyecto:
```bash
    git clone https://github.com/tu-usuario/tu-proyecto-angular.git
```
### ubicarse en la terminar con cd dentro del directorio del proyecto ApiRest

### Copiar el Archivo .env:
```bash
    cp .env.example .env
```
### Configurar la Clave de la Aplicación:
```bash
    php artisan key:generate
```
### Configurar la Base de Datos:

    abrir el archivo .env y configura los detalles de tu base de datos (nombre, usuario, contraseña).

### Instalar Dependencias de Composer:
```bash
    composer install
```
### Migrar la Base de Datos:
```bash
    php artisan migrate
```
### Iniciar el Servidor de Desarrollo:
```bash
    php artisan serve
```

### Abre tu navegador y visita http://127.0.0.1:8000 o la URL que te proporcionó php artisan serve.