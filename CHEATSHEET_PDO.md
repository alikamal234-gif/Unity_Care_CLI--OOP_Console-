# 📚 Aide-Mémoire PDO - Minimal

## Connexion
```php
$dsn = "mysql:host=localhost;dbname=ma_db;charset=utf8mb4";
$conn = new PDO($dsn, 'root', '');
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
```

## SELECT - Plusieurs lignes
```php
$stmt = $conn->prepare("SELECT * FROM products WHERE category_id = :cat_id");
$stmt->bindParam(':cat_id', $categoryId);
$stmt->execute();
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);
```

## SELECT - Une ligne
```php
$stmt = $conn->prepare("SELECT * FROM products WHERE id = :id");
$stmt->bindParam(':id', $productId);
$stmt->execute();
$product = $stmt->fetch(PDO::FETCH_ASSOC);
```

## INSERT
```php
$stmt = $conn->prepare("INSERT INTO products (name, price, category_id) VALUES (:name, :price, :cat_id)");
$stmt->bindParam(':name', $name);
$stmt->bindParam(':price', $price);
$stmt->bindParam(':cat_id', $categoryId);
$stmt->execute();
$newId = $conn->lastInsertId();
```

## UPDATE
```php
$stmt = $conn->prepare("UPDATE products SET name = :name, price = :price WHERE id = :id");
$stmt->bindParam(':name', $name);
$stmt->bindParam(':price', $price);
$stmt->bindParam(':id', $productId);
$stmt->execute();
```

## DELETE
```php
$stmt = $conn->prepare("DELETE FROM products WHERE id = :id");
$stmt->bindParam(':id', $productId);
$stmt->execute();
```

## Vérifier existence
```php
$stmt = $conn->prepare("SELECT id FROM users WHERE email = :email");
$stmt->bindParam(':email', $email);
$stmt->execute();
if ($stmt->rowCount() > 0) {
    // Existe
}
```

## Gestion erreurs
```php
try {
    $stmt = $conn->prepare("SELECT * FROM products WHERE id = :id");
    $stmt->bindParam(':id', $id);
    $stmt->execute();
} catch(PDOException $e) {
    echo "Erreur: " . $e->getMessage();
}
```

