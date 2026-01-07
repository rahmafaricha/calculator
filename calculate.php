<?php
header('Content-Type: application/json');

// Get POST data
$input = json_decode(file_get_contents('php://input'), true);

if (!$input) {
    echo json_encode(['error' => 'Invalid input']);
    exit;
}

$prev = $input['prev'] ?? null;
$current = $input['current'] ?? null;
$operation = $input['operation'] ?? null;

if ($prev === null || $current === null || $operation === null) {
    echo json_encode(['error' => 'Missing parameters']);
    exit;
}

$prev = floatval($prev);
$current = floatval($current);
$result = 0;

switch ($operation) {
    case '+':
        $result = $prev + $current;
        break;
    case '-':
        $result = $prev - $current;
        break;
    case '×':
        $result = $prev * $current;
        break;
    case '÷':
        if ($current == 0) {
            echo json_encode(['error' => 'Cannot divide by zero']);
            exit;
        }
        $result = $prev / $current;
        break;
    default:
        echo json_encode(['error' => 'Invalid operation']);
        exit;
}

echo json_encode(['result' => $result]);
?>
