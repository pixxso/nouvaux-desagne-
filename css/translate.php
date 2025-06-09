<?php
header("Content-Type: application/json");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $text = $_POST["text"] ?? "";
    $from = $_POST["from"] ?? "FR";
    $to = $_POST["to"] ?? "EN";

    if (!$text) {
        echo json_encode(["error" => "Texte manquant."]);
        exit;
    }

    $params = http_build_query([
        "auth_key" => "5245af7e-a9af-45dc-bad9-910a3175b0e9:fx",
        "text" => $text,
        "source_lang" => $from,
        "target_lang" => $to
    ]);

    $ch = curl_init("https://api-free.deepl.com/v2/translate");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
    curl_setopt($ch, CURLOPT_HTTPHEADER, ["Content-Type: application/x-www-form-urlencoded"]);
    $response = curl_exec($ch);
    curl_close($ch);

    echo $response;
}
?>
