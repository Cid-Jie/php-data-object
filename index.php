<?php

require_once '_connec.php';
$pdo = new \PDO(DSN, USER, PASS);

//Add new friend in the database
$data = array_map('trim', $_POST);

if (isset($data['firstname']) && !empty($data['firstname']) && (isset($data['lastname']) && !empty($data['lastname']))) {

    if(strlen($data['firstname']) < 45 && (strlen($data['lastname']) < 45)){
        $query = "INSERT INTO friend (firstname, lastname) VALUES (:firstname, :lastname)";
        $statement = $pdo->prepare($query);
        $statement->bindValue(':firstname', $data['firstname'], \PDO::PARAM_STR);
        $statement->bindValue(':lastname', $data['lastname'], \PDO::PARAM_STR);
        $statement->execute();
        header('Location: index2.php');
    }else{
        echo 'You must have less characters in your name!';
    }
}

$query = "SELECT * FROM friend";
$statement = $pdo->query($query);
$friends = $statement->fetchAll(PDO::FETCH_ASSOC);

foreach($friends as $friend) {
    echo '<li>'.$friend['firstname'] . ' ' . $friend['lastname'].'</li>';
}

?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <title>Formulaire PDO</title>
</head>
<body>

<h1 class="text-center">Connexion</h1>
    <form action="" method="POST" class="container bg-light">
        <p>
            <label for="firstname" class="form-label">Firstname: </label>
            <input type="text" name="firstname" id="firstname" class="form-control" required>
        </p>
        <p>
            <label for="lastname" class="form-label">Lastname : </label>
            <input type="text" name="lastname" id="lastname" class="form-control" required>
        </p>
        <p>
            <input type="submit" value="OK" class="btn btn-primary btn-lg">
        </p>
    </form>

</body>
</html>