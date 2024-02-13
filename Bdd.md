### 1. Table `roles`

Cette table permet de définir les différents rôles d'utilisateurs dans l'application.

```sql
CREATE TABLE roles (
    id_role INT PRIMARY KEY AUTO_INCREMENT,
    nom_role VARCHAR(50)
);
```

### 2. Table `utilisateurs`

Cette table stocke les informations sur les utilisateurs, y compris leur rôle.

```sql
CREATE TABLE utilisateurs (
    id_utilisateur INT PRIMARY KEY AUTO_INCREMENT,
    nom VARCHAR(255),
    prenom VARCHAR(255),
    email VARCHAR(255) UNIQUE,
    mot_de_passe VARCHAR(255),
    id_role INT,
    FOREIGN KEY (id_role) REFERENCES roles(id_role)
);
```

### 3. Table `stocks`

Cette table garde une trace de tous les médicaments et matériaux disponibles.

```sql
CREATE TABLE stocks (
    id_stock INT PRIMARY KEY AUTO_INCREMENT,
    nom VARCHAR(255),
    description VARCHAR(255),
    quantite_disponible INT,
    type ENUM('medicament', 'materiel')
);
```

### 4. Table `commandes`

Cette table enregistre les commandes passées par les utilisateurs, avec un statut pour suivre si elles sont validées.

```sql
CREATE TABLE commandes (
    id_commande INT PRIMARY KEY AUTO_INCREMENT,
    id_utilisateur INT,
    date_commande DATETIME DEFAULT CURRENT_TIMESTAMP,
    statut ENUM('en_attente', 'validee', 'invalidée') DEFAULT 'en_attente',
    FOREIGN KEY (id_utilisateur) REFERENCES utilisateurs(id_utilisateur)
);
```

### 5. Table `details_commande`

Cette table lie les commandes aux stocks, permettant de spécifier les quantités commandées.

```sql
CREATE TABLE details_commande (
    id_commande INT,
    id_stock INT,
    quantite INT,
    FOREIGN KEY (id_commande) REFERENCES commandes(id_commande),
    FOREIGN KEY (id_stock) REFERENCES stocks(id_stock),
    PRIMARY KEY (id_commande, id_stock)
);
```

### 6. Table `mouvements`

Cette table enregistre chaque entrée ou sortie de stock (médicament ou matériel) comme un mouvement.

```sql
CREATE TABLE mouvements (
    id_mouvement INT PRIMARY KEY AUTO_INCREMENT,
    id_stock INT,
    type_mouvement ENUM('entree', 'sortie'),
    quantite INT,
    date_mouvement DATETIME DEFAULT CURRENT_TIMESTAMP,
    id_commande INT,
    FOREIGN KEY (id_stock) REFERENCES stocks(id_stock),
    FOREIGN KEY (id_commande) REFERENCES commandes(id_commande)
);
```

### Exemples d'insertions initiales

Vous devrez peupler la table `roles` avec les rôles disponibles, par exemple :

```sql
INSERT INTO roles (nom_role) VALUES ('admin'), ('user');
```

Et ajouter des utilisateurs, des stocks, et éventuellement quelques commandes pour commencer :

```sql
-- Ajouter un utilisateur admin
INSERT INTO utilisateurs (nom, prenom, email, mot_de_passe, id_role) VALUES ('Admin', 'Istrateur', 'admin@example.com', 'motdepassehash', (SELECT id_role FROM roles WHERE nom_role = 'admin'));

-- Ajouter un stock initial
INSERT INTO stocks (nom, description, quantite_disponible, type) VALUES ('Paracetamol', 'Antidouleur', 100, 'medicament');
```
