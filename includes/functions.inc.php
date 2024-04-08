<?php

function emptyInputSignup($name, $email, $username, $pwd, $pwdRepeat)
{
    return empty($name) || empty($email) || empty($username) || empty($pwd) || empty($pwdRepeat);
}

function invalidUid($username)
{
    return !preg_match("/^[a-zA-Z0-9]*$/", $username);
}

function invaliEmail($email)
{
    return !filter_var($email, FILTER_VALIDATE_EMAIL);
}

function pwdMatch($pwd, $pwdRepeat)
{
    return $pwd !== $pwdRepeat;
}

function uidExists($conn, $username, $email)
{
    $sql = "SELECT * FROM users WHERE uid = ? OR email = ?;";
    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("Location: ../signup.php?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "ss", $username, $email);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);
    mysqli_stmt_close($stmt);

    if ($row = mysqli_fetch_assoc($resultData)) {
        return $row;
    } else {
        return false;
    }
}

function createUser($conn, $name, $email, $username, $pwd)
{
    $sql = "INSERT INTO users (name, email, uid, pwd) VALUES (?, ?, ?, ?);";
    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("Location: ../signup.php?error=stmtfailed");
        exit();
    }

    $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);

    mysqli_stmt_bind_param($stmt, "ssss", $name, $email, $username, $hashedPwd);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);
    mysqli_stmt_close($stmt);

    header("Location: ../signup.php?error=none");
    exit();
}

// LOG IN

function emptyInputLogin($username, $pwd)
{
    return empty($username) || empty($pwd);
}

function loginUser($conn, $username, $pwd)
{
    $uidExists = uidExists($conn, $username, $username);

    if ($uidExists === false) {
        header("Location: ../login.php?error=wronglogin");
        exit();
    }

    $pwdHashed = $uidExists['pwd'];
    $checkPwd = password_verify($pwd, $pwdHashed);

    if (!$checkPwd) {
        header("Location: ../login.php?error=wrongpassword");
        exit();
    }

    session_start();
    $_SESSION['userid'] = $uidExists['id'];
    $_SESSION['useruid'] = $uidExists['uid'];

    header("Location: ../index.php");
    exit();
}
