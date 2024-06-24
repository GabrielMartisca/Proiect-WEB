<?php
include '../Models/statistics_model.php';
require_once '../vendor/autoload.php'; // Ensure this path is correct for your setup

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

                case 'exportPDF':
                    $this->exportPDF();
                    break;

                default:
                    echo json_encode(['error' => 'Invalid action']);
                    break;
            }
        } else {
            // Include the view when no action is specified
            include "../Views/statistics_view.php";
        }
    }

    private function getStatistics() {
        header('Content-Type: application/json'); // Set content type to JSON
        $data = [
            'favoriteFoods' => $this->model->getTopFavoriteFoods(),
            'commonAllergens' => $this->model->getTopCommonAllergens(),
            'commonDiets' => $this->model->getTopCommonDiets(),
            'boughtItems' => $this->model->getTopBoughtItems()
        ];
        echo json_encode($data);
        exit(); // Ensure no additional content is sent
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
        exit(); // Ensure no additional content is sent
    }

    private function exportPDF() {
        $pdf = new \TCPDF();
        $pdf->AddPage();
        $pdf->SetFont('helvetica', '', 12);

        $pdf->Cell(0, 10, 'Top 3 Favorite Foods', 0, 1, 'C');
        foreach ($this->model->getTopFavoriteFoods() as $row) {
            $pdf->Cell(0, 10, $row['favoriteFood'] . ' (' . $row['count'] . ')', 0, 1);
        }

        $pdf->Ln(10);
        $pdf->Cell(0, 10, 'Top 3 Most Common Allergens', 0, 1, 'C');
        foreach ($this->model->getTopCommonAllergens() as $row) {
            $pdf->Cell(0, 10, $row['allergen'] . ' (' . $row['count'] . ')', 0, 1);
        }

        $pdf->Ln(10);
        $pdf->Cell(0, 10, 'Top 3 Most Common Diets', 0, 1, 'C');
        foreach ($this->model->getTopCommonDiets() as $row) {
            $pdf->Cell(0, 10, $row['regime'] . ' (' . $row['count'] . ')', 0, 1);
        }

        $pdf->Ln(10);
        $pdf->Cell(0, 10, 'Most Bought Food Items', 0, 1, 'C');
        foreach ($this->model->getTopBoughtItems() as $row) {
            $pdf->Cell(0, 10, $row['name'] . ' (' . $row['count'] . ')', 0, 1);
        }

        $pdf->Output('statistics.pdf', 'D'); // D for download
        exit();
    }
}

$controller = new StatisticsController();
$controller->handleRequest();
