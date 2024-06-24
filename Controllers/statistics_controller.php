<?php
include '../Models/statistics_model.php';

class StatisticsController {
    private $model;

    public function __construct() {
        $this->model = new StatisticsModel();
    }

    public function handleRequest() {
        if (isset($_GET['action'])) {
            $action = $_GET['action'];

            switch ($action) {
                case 'getStatistics':
                    $this->getStatistics();
                    break;

                case 'exportCSV':
                    $this->exportCSV();
                    break;

                default:
                    echo json_encode(['error' => 'Invalid action']);
            }
        }
    }

    private function getStatistics() {
        $data = [
            'favoriteFoods' => $this->model->getTopFavoriteFoods(),
            'commonAllergens' => $this->model->getTopCommonAllergens(),
            'commonDiets' => $this->model->getTopCommonDiets(),
            'boughtItems' => $this->model->getTopBoughtItems()
        ];
        echo json_encode($data);
    }

    private function exportCSV() {
        $filename = 'statistics.csv';
        $output = fopen('php://output', 'w');
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment;filename=' . $filename);

        fputcsv($output, ['Top 3 Favorite Foods']);
        foreach ($this->model->getTopFavoriteFoods() as $row) {
            fputcsv($output, $row);
        }

        fputcsv($output, []);
        fputcsv($output, ['Top 3 Most Common Allergens']);
        foreach ($this->model->getTopCommonAllergens() as $row) {
            fputcsv($output, $row);
        }

        fputcsv($output, []);
        fputcsv($output, ['Top 3 Most Common Diets']);
        foreach ($this->model->getTopCommonDiets() as $row) {
            fputcsv($output, $row);
        }

        fputcsv($output, []);
        fputcsv($output, ['Most Bought Food Items']);
        foreach ($this->model->getTopBoughtItems() as $row) {
            fputcsv($output, $row);
        }

        fclose($output);
        exit();
    }
}

$controller = new StatisticsController();
$controller->handleRequest();
?>
