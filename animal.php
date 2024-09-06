<?php
session_start();

function loadAnimals() {
    $animals = [
        ["name" => "Otter", "image" => "img/otterr.jpg"],
        ["name" => "Panda", "image" => "img/pandaa.jpg"],
        ["name" => "Jaguar", "image" => "img/jaguars.jpg"],
        ["name" => "Chimpanzee", "image" => "img/chimpanzee.jpg"],
        ["name" => "Giraffe", "image" => "img/giraffe.jpg"],
        ["name" => "Lion", "image" => "img/lions.jpg"],
        ["name" => "Tiger", "image" => "img/tigerr.jpg"],
        ["name" => "Lynx", "image" => "img/lynx.jpg"],
        ["name" => "Fennec Fox", "image" => "img/fennecfox.jpg"],
        ["name" => "Polar Bear", "image" => "img/polarbear.jpg"],
        ["name" => "Red Panda", "image" => "img/redpanda.jpg"],
        ["name" => "Brown Bear", "image" => "img/brownbear.jpg"],
        ["name" => "Secretary Bird", "image" => "img/secretarybird.jpg"],
        ["name" => "Racoon", "image" => "img/raccoon.jpg"],
        ["name" => "Siamang", "image" => "img/siamang.jpg"],
        ["name" => "Dolphin", "image" => "img/dolphins.jpg"],
        ["name" => "Bald Eagle", "image" => "img/baldeagle.jpg"],
        ["name" => "Elephant", "image" => "img/elephant.jpg"],
        ["name" => "Capybara", "image" => "img/capybara.jpg"],
        ["name" => "Flamingo", "image" => "img/flamingos.jpg"],
        ["name" => "Guinea Pig", "image" => "img/guineapigs.jpg"],
        ["name" => "Leopard", "image" => "img/leopard.jpg"],
        ["name" => "Zebra", "image" => "img/zebra.jpg"],
        ["name" => "Owl", "image" => "img/owl.jpg"],
        ["name" => "Pygmy Marmoset", "image" => "img/pygmymarmoset.jpg"],
        ["name" => "Sunbear", "image" => "img/sunbear.jpg"],
        ["name" => "Wolf", "image" => "img/wolf.jpg"]
    ];
    return array_slice($animals, 0);
}

$animals = loadAnimals();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <link rel="stylesheet" href="Style-main.css">
    <title>Animals - ZOOTOPIA &CO</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        header {
            background-color: #000;
            width: 100%;
            position: fixed;
            top: 0;
            z-index: 999;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 200px;
        }
        .animal-card {
            width: 300px;
            margin: 20px;
            display: inline-block;
            text-align: center;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s, box-shadow 0.3s;
        }
        .animal-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }
        .animal-card img {
            width: 100%;
            height: auto;
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
        }
        .animal-card h3 {
            font-size: 1.5em;
            margin: 15px 0;
        }
        #animal-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            padding: 20px;
        }
        @media (max-width: 600px) {
            header {
                padding: 12px 20px;
                flex-direction: row;
                align-items: center;
                justify-content: space-between;
            }
            .title{
                margin-bottom: -20px;
            }
        }
    </style>
</head>
<body>
    <header>
        <a href="visitorindex.php" class="Logo">Zootopia &Co</a>
        <nav class="nav">
            <a href="visitorindex.php">HOME</a>
        </nav>
    </header>

    <section class="cards" id="animals">
        <h2 class="title">Our Animals</h2>
        <div id="animal-container">
            <?php foreach ($animals as $animal): ?>
                <div class="animal-card">
                    <img src="<?php echo $animal['image']; ?>" alt="<?php echo $animal['name']; ?>">
                    <h3><?php echo $animal['name']; ?></h3>
                </div>
            <?php endforeach; ?>
        </div>
    </section>
</body>
</html>