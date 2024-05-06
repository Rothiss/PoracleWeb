<?php

include_once "../config.php";
include_once "../include/db_connect.php";

// CREATE SETTINGS TABLE IF IT DOESN'T EXIST

$sql = "CREATE TABLE IF NOT EXISTS pweb_settings ( setting varchar(255) NOT NULL, value varchar(255), UNIQUE(setting) )";
$result = $conn->query($sql);

$languages = [];
foreach ($_POST as $key => $value) {
  if (strpos($key, 'language') !== false) {
    array_push($languages, substr($key, 9, 11));
  } else {
    if ($key == "scan_dbpass" && trim($value) == "") {
      continue;
    } else {
      if ($key == "api_secret" && trim($value) == "") {
        continue;
      } else {
        if ($key == "telegram_bot_token" && trim($value) == "") {
          continue;
        } else {
          if ($key != "action" && $key != "update") {
            if (strpos($key, 'disable') !== false) {
              if ($value == "on") {
                $value = "False";
              }
              if ($value == "off") {
                $value = "True";
              }
            } else {
              if ($key == "api_address") {
                $value = rtrim($value, '/');
              } else {
                if ($value == "on") {
                  $value = "True";
                }
                if ($value == "off") {
                  $value = "False";
                }
              }
            }

            $stmt = $conn->prepare("INSERT INTO pweb_settings (setting, value) VALUES (?, ?) ON DUPLICATE KEY UPDATE value=?");
            if (false === $stmt) {
              header("Location: $redirect_url/?type=display&page=server_settings&return=sql_error&phase=E1&sql=$stmt->error");
              exit();
            }

            $rs = $stmt->bind_param("sss", $key, $value, $value);
            if (false === $rs) {
              header("Location: $redirect_url/?type=display&page=server_settings&return=sql_error&phase=E2&sql=$stmt->error");
              exit();
            }

            $rs = $stmt->execute();
            if (false === $rs) {
              header("Location: $redirect_url/?type=display&page=server_settings&return=sql_error&phase=E3&sql=$stmt->error");
              exit();
            }

            $stmt->close();
          }
        }
      }
    }
  }
}

$languages = implode(",", $languages);
if ($languages == "") {
  $languages = "en";
}

$stmt = $conn->prepare("INSERT INTO pweb_settings (setting, value) VALUES ('allowed_languages', ?) ON DUPLICATE KEY UPDATE value=?");
if (false === $stmt) {
  header("Location: $redirect_url/?type=display&page=server_settings&return=sql_error&phase=E1&sql=$stmt->error");
  exit();
}

$rs = $stmt->bind_param("ss", $languages, $languages);
if (false === $rs) {
  header("Location: $redirect_url/?type=display&page=server_settings&return=sql_error&phase=E2&sql=$stmt->error");
  exit();
}

$rs = $stmt->execute();
if (false === $rs) {
  header("Location: $redirect_url/?type=display&page=server_settings&return=sql_error&phase=E3&sql=$stmt->error");
  exit();
}

header("Location: $redirect_url?type=display&page=server_settings&return=success_update_settings");
exit();

include "./action_error.php";

