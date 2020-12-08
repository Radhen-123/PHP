<?php
function is_valid_admin_login($email, $password)
{
    global $db;
    $query = 'SELECT password FROM administrators
              WHERE emailAddress = :email';
    $statement = $db->prepare($query);
    $statement->bindValue(':email', $email);
    $statement->execute();
    $row = $statement->fetch();
    $statement->closeCursor();
    $hash = $row['password'];
    return password_verify($password, $hash);
}

function emailExists($email)
{
    global $db;
    $query =    'SELECT * FROM administrators
                WHERE emailAddress = :email';
    $statement = $db->prepare($query);
    $statement->bindValue(':email', $email);
    $statement->execute();

    return $statement->rowCount() > 0;
}

function get_type($email)
{
    global $db;
    $query =    'SELECT * FROM administrators
                WHERE emailAddress = :email';
    $statement = $db->prepare($query);
    $statement->bindValue(':email', $email);
    $statement->execute();
    $type_id = $statement->fetch();
    return $type_id['typeID'];
}

function add_admin($email, $password, $first_name, $last_name, $user_type)
{
    if (emailExists($email))
    {
        return "Email Address Already Exists";
    }
    else
    {

        global $db;
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $query =
            'INSERT INTO administrators (emailAddress, password, firstName, lastName, typeID)
                VALUES (:email, :password, :firstName, :lastName, :typeID)';
        $statement = $db->prepare($query);
        $statement->bindValue(':email', $email);
        $statement->bindValue(':password', $hash);
        $statement->bindValue(':firstName', $first_name);
        $statement->bindValue(':lastName', $last_name);
        $statement->bindValue(':typeID', $user_type);
        $statement->execute();
        $statement->closeCursor();
        return "User Added Successfully ";
    }
}
?>