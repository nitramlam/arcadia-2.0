<?php
session_start();
require_once(__DIR__ . '/../includes/auth.php');
require_once(__DIR__ . '/../includes/header.php');
require_once(__DIR__ . '/../db.php'); // Connexion à MySQL

// Connexion à MongoDB
$manager = new MongoDB\Driver\Manager("mongodb+srv://martinlamalle:456123Fx37!@arcadia.t7ei6.mongodb.net/?retryWrites=true&w=majority&appName=arcadia");

// Vérification de la connexion de l'utilisateur
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'administrateur') {
    header("Location: /connexion/connexion.php");
    exit();
}

// Fonction pour gérer l'upload d'image
function uploadImage($file) {
    if (isset($file) && $file['error'] == 0) {
        $uploadDir = __DIR__ . '/../animaux/';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }
        $uploadFile = $uploadDir . basename($file['name']);
        if (move_uploaded_file($file['tmp_name'], $uploadFile)) {
            return '/animaux/' . basename($file['name']);
        }
    }
    return null;
}

// Fonction pour ajouter ou mettre à jour l'animal dans MongoDB
// Fonction pour ajouter ou mettre à jour l'animal dans MongoDB
function syncAnimalToMongoDB($animalId, $nom) {
    global $manager;

    // Mise à jour du document dans MongoDB
    $bulk = new MongoDB\Driver\BulkWrite;
    $filter = ['animal_id' => (string)$animalId];
    $update = [
        '$set' => [
            'animal_id' => (string)$animalId,
            'animal_name' => $nom,
            // On continue à utiliser le view_count mais sans jamais l'afficher
            'view_count' => 0  // Par défaut, on ne l'affiche pas
        ]
    ];
    $bulk->update($filter, $update, ['upsert' => true]); // 'upsert' ajoute si l'animal n'existe pas
    $manager->executeBulkWrite('arcadia.animal_views', $bulk);
}

// Fonction pour supprimer l'animal de MongoDB
function deleteAnimalFromMongoDB($animalId) {
    global $manager;

    // Suppression du document dans MongoDB
    $bulk = new MongoDB\Driver\BulkWrite;
    $filter = ['animal_id' => (string)$animalId];
    $bulk->delete($filter);
    $manager->executeBulkWrite('arcadia.animal_views', $bulk);
}

// Fonction pour créer une page personnalisée pour chaque animal
function createAnimalPage($animalId) {
    global $conn;
    
    // Connexion à MongoDB
    $manager = new MongoDB\Driver\Manager("mongodb+srv://martinlamalle:456123Fx37!@arcadia.t7ei6.mongodb.net/?retryWrites=true&w=majority&appName=arcadia");

    $stmt = $conn->prepare("SELECT * FROM animal WHERE animal_id = ?");
    $stmt->bind_param("i", $animalId);
    $stmt->execute();
    $result = $stmt->get_result();
    $animal = $result->fetch_assoc();

    if (!$animal) {
        throw new Exception("Animal introuvable.");
    }

    $uploadDir = __DIR__ . '/../animaux_pages/';
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    $pageContent = <<<PHP
<?php
require_once (__DIR__ . '/../includes/header.php');

// Connexion à MongoDB pour incrémenter le compteur de vues
\$manager = new MongoDB\Driver\Manager("mongodb+srv://martinlamalle:456123Fx37!@arcadia.t7ei6.mongodb.net/?retryWrites=true&w=majority&appName=arcadia");

// Incrémentation du view_count dans MongoDB
\$bulk = new MongoDB\Driver\BulkWrite;
\$filter = ['animal_id' => "{$animalId}"];
\$update = [
    '\$inc' => ['view_count' => 1]  // Incrémenter de 1 à chaque accès
];
\$bulk->update(\$filter, \$update);
\$manager->executeBulkWrite('arcadia.animal_views', \$bulk);

?>
<!DOCTYPE html>
<html lang='fr'>
<head>
    <meta charset='UTF-8'>
    <title>{$animal['nom']} - Page Personnalisée</title>
    <link rel='stylesheet' href='animauxPage.css'>
</head>
<body>
    <div class="animal-main">
        <h1 class="animal-title">{$animal['nom']}</h1>
        <img class="animal-photo" src="{$animal['image_path']}" alt="{$animal['nom']}">
        <div class="info-section">
            <h2>Informations Générales</h2>
            <div class="general-info">
                <p class="species-info"><strong>Espèce:</strong> {$animal['espece']}</p>
                <p class="description-info"><strong>Description:</strong> {$animal['description']}</p>
                <p class="weight-info"><strong>Poids:</strong> {$animal['poids']} kg</p>
                <p class="sex-info"><strong>Sexe:</strong> {$animal['sexe']}</p>
                <p class="origin-continent-info"><strong>Continent d'origine:</strong> {$animal['continent_origine']}</p>
                <p class="habitat-info"><strong>Habitat:</strong> {$animal['habitat']}</p>
            </div>
        </div>

        <div class="medical-section">
            <h2>Données Médicales</h2>
            <div class="medical-info">
                <p class="diet-info"><strong>Régime:</strong> {$animal['regime']}</p>
                <p class="last-visit-info"><strong>Dernière visite:</strong> {$animal['derniere_visite']}</p>
                <p class="general-state-info"><strong>État général:</strong> {$animal['etat_general']}</p>
                <p class="weight-info"><strong>Grammage:</strong> {$animal['grammage']} kg</p>
                <p class="comment-info"><strong>Commentaire:</strong> {$animal['commentaire']}</p>
            </div>
        </div>
    </div>
    <?php require_once (__DIR__ . '/../includes/footer.php'); ?>
</body>
</html>
PHP;

    $pagePath = __DIR__ . "/../animaux_pages/animal_{$animalId}.php";
    file_put_contents($pagePath, $pageContent);

    return "/animaux_pages/animal_{$animalId}.php";
}

// Gestion des soumissions des formulaires
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['add_animal'])) {
        // Ajouter un nouvel animal
        $nom = $_POST['nom'];
        $description = $_POST['description'];
        $poids = $_POST['poids'];
        $sexe = $_POST['sexe'];
        $continent_origine = $_POST['continent_origine'];
        $age = $_POST['age'];
        $habitat = $_POST['habitat'];
        $espece = $_POST['espece'];

        // Gestion du téléchargement de l'image
        $imagePath = uploadImage($_FILES['image']);
        $stmt = $conn->prepare("INSERT INTO animal (nom, description, poids, sexe, continent_origine, age, habitat, espece, image_path) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssdsdssss", $nom, $description, $poids, $sexe, $continent_origine, $age, $habitat, $espece, $imagePath);
        $stmt->execute();

        $animalId = $conn->insert_id;
        createAnimalPage($animalId);
        
        // Synchronisation avec MongoDB
        syncAnimalToMongoDB($animalId, $nom);

        // Mise à jour de l'URL de la page personnalisée dans la base de données
        $stmt = $conn->prepare("UPDATE animal SET page_personnalisee_url = ? WHERE animal_id = ?");
        $pageUrl = "/animaux_pages/animal_{$animalId}.php";
        $stmt->bind_param("si", $pageUrl, $animalId);
        $stmt->execute();
    } elseif (isset($_POST['update_animal'])) {
        // Modifier un animal
        $animal_id = $_POST['animal_id'];
        $nom = $_POST['nom'];
        $description = $_POST['description'];
        $poids = $_POST['poids'];
        $sexe = $_POST['sexe'];
        $continent_origine = $_POST['continent_origine'];
        $age = $_POST['age'];
        $habitat = $_POST['habitat'];
        $espece = $_POST['espece'];

        // Vérifier s'il y a une nouvelle image téléchargée
        $imagePath = uploadImage($_FILES['image']);
        if ($imagePath) {
            $stmt = $conn->prepare("UPDATE animal SET nom = ?, description = ?, poids = ?, sexe = ?, continent_origine = ?, age = ?, habitat = ?, espece = ?, image_path = ? WHERE animal_id = ?");
            $stmt->bind_param("ssdsdsssii", $nom, $description, $poids, $sexe, $continent_origine, $age, $habitat, $espece, $imagePath, $animal_id);
        } else {
            $stmt = $conn->prepare("UPDATE animal SET nom = ?, description = ?, poids = ?, sexe = ?, continent_origine = ?, age = ?, habitat = ?, espece = ? WHERE animal_id = ?");
            $stmt->bind_param("ssdsdssii", $nom, $description, $poids, $sexe, $continent_origine, $age, $habitat, $espece, $animal_id);
        }
        $stmt->execute();

        // Recréer la page personnalisée
        createAnimalPage($animal_id);

        // Synchronisation avec MongoDB
        syncAnimalToMongoDB($animal_id, $nom);
    } elseif (isset($_POST['delete_animal'])) {
        // Supprimer un animal
        $animal_id = $_POST['animal_id'];
        $stmt = $conn->prepare("DELETE FROM animal WHERE animal_id = ?");
        $stmt->bind_param("i", $animal_id);
        $stmt->execute();

        // Suppression de MongoDB
        deleteAnimalFromMongoDB($animal_id);
    }
}

// Récupérer les données des animaux
$animalQuery = $conn->query("SELECT * FROM animal");
$animals = $animalQuery->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Gestion des Animaux</title>
    <link rel="stylesheet" href="modifierAnimaux.css">
</head>
<body>
    <main>
        <section class="intro">
            <h2>Nos Animaux</h2>
            <p>Au Zoo Écologique de la Forêt de Brocéliande, nous créons des habitats fidèles aux milieux naturels de nos animaux, assurant ainsi leur bien-être et contribuant à la préservation de l'écosystème. Rencontrez nos majestueux lions, éléphants, alligators et bien d'autres résidents fascinants au cœur de notre zoo.</p>
        </section>
        <section class="animal-list">
            <?php foreach ($animals as $animal): ?>
                <div class="animal-card">
                    <h3><?php echo htmlspecialchars($animal['nom'] ?? ''); ?></h3>
                    <img src="<?php echo htmlspecialchars($animal['image_path'] ?? '/animaux/default.jpg'); ?>" alt="<?php echo htmlspecialchars($animal['nom'] ?? ''); ?>">
                    <button class="view-report">Afficher le compte rendu</button>
                    <div class="animal-details" style="display: none;">
                        <p><strong>État général:</strong> <?php echo htmlspecialchars($animal['etat_general'] ?? ''); ?></p>
                        <p><strong>Nourriture proposée:</strong> <?php echo htmlspecialchars($animal['regime'] ?? ''); ?></p>
                        <p><strong>Grammage proposé:</strong> <?php echo htmlspecialchars($animal['grammage'] ?? ''); ?> kg</p>
                        <p><strong>Dernière visite:</strong> <?php echo htmlspecialchars($animal['derniere_visite'] ?? ''); ?></p>
                        <p><strong>Commentaire:</strong> <?php echo htmlspecialchars($animal['commentaire'] ?? ''); ?></p>
                    </div>
                    <button class="edit-toggle">✏️</button>
                    <form method="POST" class="animal-form" style="display: none;" enctype="multipart/form-data">
                        <input type="hidden" name="animal_id" value="<?php echo htmlspecialchars($animal['animal_id'] ?? ''); ?>">
                        <label>Nom: <input type="text" name="nom" value="<?php echo htmlspecialchars($animal['nom'] ?? ''); ?>" required></label>
                        <label>Description: <textarea name="description" required><?php echo htmlspecialchars($animal['description'] ?? ''); ?></textarea></label>
                        <label>Poids: <input type="number" step="0.01" name="poids" value="<?php echo htmlspecialchars($animal['poids'] ?? ''); ?>" required></label>
                        <label>Sexe: <input type="text" name="sexe" value="<?php echo htmlspecialchars($animal['sexe'] ?? ''); ?>" required></label>
                        <label>Continent d'origine: <input type="text" name="continent_origine" value="<?php echo htmlspecialchars($animal['continent_origine'] ?? ''); ?>" required></label>
                        <label>Âge: <input type="number" name="age" value="<?php echo htmlspecialchars($animal['age'] ?? ''); ?>" required></label>
                        <label>Habitat: <input type="text" name="habitat" value="<?php echo htmlspecialchars($animal['habitat'] ?? ''); ?>" required></label>
                        <label>Espèce: <input type="text" name="espece" value="<?php echo htmlspecialchars($animal['espece'] ?? ''); ?>" required></label>
                        <label>Image: <input type="file" name="image" accept="image/*"></label>
                        <button type="submit" name="update_animal" class="edit-btn">Modifier</button>
                        <button type="submit" name="delete_animal" class="delete-btn">Supprimer</button>
                    </form>
                </div>
            <?php endforeach; ?>
        </section>

        <!-- Formulaire d'ajout d'un nouvel animal -->
        <button class="add-animal" onclick="openAddForm()">Ajouter un animal</button>
        <form method="POST" class="add-animal-form" id="add-animal-form" style="display: none;" enctype="multipart/form-data">
            <label>Nom: <input type="text" name="nom" required></label>
            <label>Description: <textarea name="description" required></textarea></label>
            <label>Poids: <input type="number" step="0.01" name="poids" required></label>
            <label>Sexe: <input type="text" name="sexe" required></label>
            <label>Continent d'origine: <input type="text" name="continent_origine" required></label>
            <label>Âge: <input type="number" name="age" required></label>
            <label>Habitat: <input type="text" name="habitat" required></label>
            <label>Espèce: <input type="text" name="espece" required></label>
            <label>Image: <input type="file" name="image" accept="image/*"></label>
            <button type="submit" name="add_animal">Ajouter</button>
            <button type="button" onclick="closeAddForm()">Annuler</button>
        </form>
    </main>
    <?php require_once (__DIR__ . '/../includes/footer.php'); ?>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const viewReportButtons = document.querySelectorAll('.view-report');
            viewReportButtons.forEach(button => {
                button.addEventListener('click', () => {
                    const details = button.nextElementSibling;
                    details.style.display = details.style.display === 'block' ? 'none' : 'block';
                });
            });

            const editToggles = document.querySelectorAll('.edit-toggle');
            editToggles.forEach(button => {
                button.addEventListener('click', () => {
                    const form = button.nextElementSibling;
                    form.style.display = form.style.display === 'block' ? 'none' : 'block';
                });
            });

            const addAnimalButton = document.querySelector('.add-animal');
            addAnimalButton.addEventListener('click', () => {
                document.getElementById('add-animal-form').style.display = 'block';
            });
        });

        function closeAddForm() {
            document.getElementById('add-animal-form').style.display = 'none';
        }
    </script>