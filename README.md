# Laravel Kanban API

Ez egy egyszerű Kanban-jellegű REST API Laravel 12-vel és Dockerrel. Az alkalmazás `columns` és `tasks` kezelésére alkalmas.

## 🚀 Telepítés

1. **Repository klónozása:**

```bash
git clone https://github.com/sportolo96/ZNiTech.git
cd ZNiTech
```

2. **.env fájl létrehozása:**

```bash
cp .env.example .env
```

3. **.env változók beállítása:**

```
DB_CONNECTION=mysql
DB_HOST=db
DB_PORT=3306
DB_DATABASE=znitech
DB_USERNAME=root
DB_PASSWORD=laravel
DB_ROOT_PASSWORD=laravel
```

4. **Docker konténerek indítása:**

```bash
docker-compose up -d --build
```

5. **Migrációk futtatása:**

```bash
docker exec -it znitech-php php artisan migrate
```

## 🧪 API végpontok

### 🟧 Oszlopok (`columns`)

- **GET /api/columns**  
  Összes oszlop lekérése a kapcsolódó feladatokkal.

- **POST /api/columns**  
  Új oszlop létrehozása:

```json
{
  "name": "Todo",
  "position": 1,
  "color": "#FF0000"
}
```

- **GET /api/columns/{id}**  
  Egy oszlop lekérése a kapcsolódó feladatokkal (rendezve `position` szerint).

### 🟦 Feladatok (`tasks`)

- **POST /api/tasks**  
  Új feladat létrehozása:

```json
{
  "column_id": 1,
  "name": "Feladat címe",
  "description": "Leírás",
  "position": 1
}
```

- **GET /api/tasks/{id}**  
  Egy feladat lekérése.

---

## ⚙️ Docker szolgáltatások

| Konténer        | Leírás              |
|------------------|----------------------|
| znitech-php      | Laravel app (PHP 8.2) |
| znitech-nginx    | Webszerver            |
| znitech-db       | MySQL adatbázis       |
