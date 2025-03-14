# Sistema de Punto de Venta (POS) en Laravel

Este proyecto es un Sistema de Punto de Venta (POS) desarrollado con Laravel, diseñado para gestionar operaciones de ventas, inventario y clientes de manera eficiente.

## Características

- **Gestión de productos**: Añadir, editar y eliminar productos del inventario.
- **Control de inventario**: Seguimiento de existencias y alertas de stock bajo.
- **Procesamiento de ventas**: Creación y gestión de transacciones de venta.
- **Gestión de clientes**: Registro y seguimiento de información de clientes.
- **Informes y análisis**: Generación de informes de ventas e inventario.

## Requisitos previos

- PHP >= 7.4
- Composer
- Servidor web (Apache, Nginx, etc.)
- Base de datos MySQL o PostgreSQL

## Instalación

1. **Clonar el repositorio**:

   ```bash
   git clone https://github.com/jimmiroblescasanova/pos-laravel-v1.git
   cd pos-laravel-v1
   ```

2. **Instalar dependencias de PHP**:

   ```bash
   composer install
   ```

3. **Instalar dependencias de JavaScript**:

   ```bash
   npm install
   ```

4. **Copiar el archivo de entorno y generar la clave de aplicación**:

   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

5. **Configurar la base de datos**:

   Edite el archivo `.env` y configure los parámetros de conexión a su base de datos:

   ```
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=nombre_de_la_base_de_datos
   DB_USERNAME=usuario
   DB_PASSWORD=contraseña
   ```

6. **Ejecutar migraciones y seeders**:

   ```bash
   php artisan migrate --seed
   ```

7. **Compilar assets**:

   ```bash
   npm run dev
   ```

8. **Iniciar el servidor**:

   ```bash
   php artisan serve
   ```

   Acceda a la aplicación en `http://localhost:8000`.

## Credenciales de acceso

- **Administrador**:
  - Correo electrónico: `admin@example.com`
  - Contraseña: `password`

Asegúrese de cambiar las credenciales predeterminadas después de la instalación inicial.

## Contribuciones

Las contribuciones son bienvenidas. Por favor, siga los siguientes pasos:

1. Haga un fork del repositorio.
2. Cree una rama para su característica (`git checkout -b feature/nueva-caracteristica`).
3. Realice commit de sus cambios (`git commit -am 'Añadir nueva característica'`).
4. Haga push a la rama (`git push origin feature/nueva-caracteristica`).
5. Abra un Pull Request.

## Licencia

Este proyecto está licenciado bajo la Licencia MIT. Consulte el archivo [LICENSE](LICENSE) para más detalles.
