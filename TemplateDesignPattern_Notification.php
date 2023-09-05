<?php

/**
 * The Template Method Pattern is a behavioral design pattern 
 * that defines the skeleton of an algorithm in the superclass but lets subclasses override specific steps of the algorithm without changing its structure.
 * It's used when you have an algorithm that consists of multiple steps,
 * and the steps can vary among subclasses while preserving the overall algorithm's structure.
 */

// Base class representing a Notification
abstract class Notification
{
    // The template method that defines the notification sending process
    final public function send()
    {
        $this->authorize();
        $this->formatMessage();
        $this->sendNotification();
    }

    // Abstract methods that subclasses must implement
    abstract protected function authorize();
    abstract protected function formatMessage();
    abstract protected function sendNotification();
}

// Concrete subclass for email notifications
class EmailNotification extends Notification
{
    protected function authorize()
    {
        echo "Authorizing email...\n";
    }

    protected function formatMessage()
    {
        echo "Formatting email message...\n";
    }

    protected function sendNotification()
    {
        echo "Sending email notification...\n";
    }
}

// Concrete subclass for SMS notifications
class SMSNotification extends Notification
{
    protected function authorize()
    {
        echo "Authorizing SMS...\n";
    }

    protected function formatMessage()
    {
        echo "Formatting SMS message...\n";
    }

    protected function sendNotification()
    {
        echo "Sending SMS notification...\n";
    }
}

// Client code
$emailNotification = new EmailNotification();
$emailNotification->send();

$smsNotification = new SMSNotification();
$smsNotification->send();
