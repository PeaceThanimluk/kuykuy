# Setup and run (local)

1. Create the database and table (use MySQL client):

```sql
-- from project root
SOURCE db_init.sql;
```

2. Edit `config.php` if your MySQL credentials differ.

3. Start PHP built-in server for quick testing:

```bash
php -S 127.0.0.1:8000
```

4. Open http://127.0.0.1:8000/login.php in your browser.

Login credentials:
- username: staff
- password: staff1234
