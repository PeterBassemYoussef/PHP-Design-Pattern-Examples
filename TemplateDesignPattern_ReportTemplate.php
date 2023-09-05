<?php

/**
 * The Template Method Pattern is a behavioral design pattern 
 * that defines the skeleton of an algorithm in the superclass but lets subclasses override specific steps of the algorithm without changing its structure.
 * It's used when you have an algorithm that consists of multiple steps,
 * and the steps can vary among subclasses while preserving the overall algorithm's structure.
 */

// Base class representing a ReportTemplate
abstract class ReportTemplate
{
    // The template method that defines the report generation process
    final public function generateReport()
    {
        $this->fetchData();
        $this->formatHeader();
        $this->formatData();
        $this->formatFooter();
        $this->saveReport();
    }

    // Abstract methods that subclasses must implement
    abstract protected function fetchData();
    abstract protected function formatHeader();
    abstract protected function formatData();
    abstract protected function formatFooter();
    abstract protected function saveReport();
}

// Concrete subclass for PDF reports
class PdfReport extends ReportTemplate
{
    protected function fetchData()
    {
        echo "Fetching data for PDF report...\n";
    }

    protected function formatHeader()
    {
        echo "Formatting PDF report header...\n";
    }

    protected function formatData()
    {
        echo "Formatting data for PDF report...\n";
    }

    protected function formatFooter()
    {
        echo "Formatting PDF report footer...\n";
    }

    protected function saveReport()
    {
        echo "Saving PDF report...\n\n";
    }
}

// Concrete subclass for CSV reports
class CsvReport extends ReportTemplate
{
    protected function fetchData()
    {
        echo "Fetching data for CSV report...\n";
    }

    protected function formatHeader()
    {
        echo "Formatting CSV report header...\n";
    }

    protected function formatData()
    {
        echo "Formatting data for CSV report...\n";
    }

    protected function formatFooter()
    {
        echo "Formatting CSV report footer...\n";
    }

    protected function saveReport()
    {
        echo "Saving CSV report...\n\n";
    }
}

// Concrete subclass for HTML reports
class HtmlReport extends ReportTemplate
{
    protected function fetchData()
    {
        echo "Fetching data for HTML report...\n";
    }

    protected function formatHeader()
    {
        echo "Formatting HTML report header...\n";
    }

    protected function formatData()
    {
        echo "Formatting data for HTML report...\n";
    }

    protected function formatFooter()
    {
        echo "Formatting HTML report footer...\n";
    }

    protected function saveReport()
    {
        echo "Saving HTML report...\n\n";
    }
}

// Client code
$pdfReport = new PdfReport();
$pdfReport->generateReport();

$csvReport = new CsvReport();
$csvReport->generateReport();

$htmlReport = new HtmlReport();
$htmlReport->generateReport();
