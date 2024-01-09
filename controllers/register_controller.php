<?php

if (isset($_POST["req"]) && $_POST["req"] == "signup") {
    $firstName = $_POST["firstName"];
    $lastName = $_POST["lastName"];
    $email = $_POST["email"];
    $password = $_POST["password"];

    $errors = [
        "firstName_err" => Validation::validateUsername($firstName),
        "lastName_err" => Validation::validateUsername($lastName),
        "email_err" => Validation::validateEmail($email),
        "password_err" => Validation::validatePassword($password),
        "userexists_err" => Validation::userChecker($email, $db),
    ];

    if (array_filter($errors)) {

        echo json_encode(["errors" => $errors]);
        exit;
    }

    $passwordHash = password_hash($password, PASSWORD_BCRYPT);

    User::register($firstName, $lastName, $email, $passwordHash, $db);
    echo json_encode(["success" => "User registered successfully"]);
    exit;
}
