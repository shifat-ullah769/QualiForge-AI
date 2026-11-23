<?php

namespace App\Services;


use Illuminate\Validation\ValidationException;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Throwable;

class DatasetFileInspector
{
    /**
     * Read and inspect an uploaded CSV or Excel file.
     */
    public function inspectPath(string $filePath): array
    {
        try {
            $spreadsheet = IOFactory::load($filePath);

            $sheet = $spreadsheet->getActiveSheet();

            $rows = $sheet->toArray(
                null,
                true,
                true,
                false
            );

            $spreadsheet->disconnectWorksheets();

            unset($spreadsheet);

            if (empty($rows)) {
                $this->fail('file', 'The uploaded file is empty.');
            }

            // First row contains column headers.
            $headers = array_shift($rows);

            $headers = array_map(
                fn($header) => trim((string) $header),
                $headers
            );

            // Remove empty trailing columns.
            while (!empty($headers) && end($headers) === '') {
                array_pop($headers);
            }

            if (empty($headers)) {
                $this->fail('file', 'No column headers were found.');
            }

            // Check for empty headers.
            foreach ($headers as $index => $header) {
                if ($header === '') {
                    $this->fail(
                        'file',
                        'Column ' . ($index + 1) . ' has an empty header.'
                    );
                }
            }

            // Check duplicate headers (case-insensitive).
            $normalizedHeaders = array_map(
                fn($header) => mb_strtolower($header),
                $headers
            );

            if (count($normalizedHeaders) !== count(array_unique($normalizedHeaders))) {
                $this->fail(
                    'file',
                    'Duplicate column headers were found.'
                );
            }

            $columnCount = count($headers);

            // Remove completely empty rows.
            $dataRows = array_filter(
                $rows,
                function ($row) {
                    foreach ($row as $value) {
                        if ($value !== null && trim((string) $value) !== '') {
                            return true;
                        }
                    }

                    return false;
                }
            );

            $rowCount = count($dataRows);

            if ($rowCount === 0) {
                $this->fail(
                    'file',
                    'The file contains headers but no data rows.'
                );
            }


            // Check for columns where every data cell is empty
            foreach ($headers as $columnIndex => $header) {
                $hasValue = false;

                foreach ($dataRows as $row) {
                    $value = $row[$columnIndex] ?? null;

                    if ($value !== null && trim((string) $value) !== '') {
                        $hasValue = true;
                        break;
                    }
                }

                if (!$hasValue) {
                    $this->fail(
                        'file',
                        "Column '{$header}' contains no data values."
                    );
                }
            }

            // Check row structure.
            foreach ($dataRows as $index => $row) {
                $row = array_slice(
                    array_pad($row, $columnCount, null),
                    0,
                    $columnCount
                );

                if (count($row) !== $columnCount) {
                    $this->fail(
                        'file',
                        'Inconsistent column structure detected.'
                    );
                }
            }

            return [
                'headers' => $headers,
                'row_count' => $rowCount,
                'column_count' => $columnCount,
            ];
        } catch (ValidationException $exception) {
            throw $exception;
        } catch (Throwable $exception) {
            $this->fail(
                'file',
                'Unable to read this file. Please check that it is a valid CSV or Excel file.'
            );
        }
    }

    /**
     * Throw a user-friendly validation error.
     */
    private function fail(string $field, string $message): never
    {
        throw ValidationException::withMessages([
            $field => $message,
        ]);
    }
}
