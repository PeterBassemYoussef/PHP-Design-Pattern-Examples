<?php

/**
 * The Observer design pattern is a behavioral pattern where an object, 
 * known as the subject, maintains a list of its dependents, called observers, and notifies them of state changes.
 * This pattern is used to define a one-to-many relationship between objects, 
 * ensuring that when one object changes state, 
 * its dependents are notified and updated automatically.
 */

/** Weather Station example **/

// Subject interface that defines methods for attaching, detaching, and notifying observers
interface Subject
{
    public function attach(Observer $observer);
    public function detach(Observer $observer);
    public function notify();
}

// Concrete subject (WeatherData) that collects and updates weather data
class WeatherData implements Subject
{
    private $observers = [];
    private $temperature;
    private $humidity;
    private $pressure;

    public function attach(Observer $observer)
    {
        $this->observers[] = $observer;
    }

    public function detach(Observer $observer)
    {
        $index = array_search($observer, $this->observers);
        if ($index !== false) {
            unset($this->observers[$index]);
        }
    }

    public function notify()
    {
        foreach ($this->observers as $observer) {
            $observer->update($this->temperature, $this->humidity, $this->pressure);
        }
    }

    public function setMeasurements($temperature, $humidity, $pressure)
    {
        $this->temperature = $temperature;
        $this->humidity = $humidity;
        $this->pressure = $pressure;
        $this->measurementsChanged();
    }

    public function measurementsChanged()
    {
        $this->notify();
    }
}

// Observer interface that defines an update method for receiving data updates
interface Observer
{
    public function update($temperature, $humidity, $pressure);
}

// Concrete observers (Displays) that receive and display weather data
class CurrentConditionsDisplay implements Observer
{
    private $temperature;
    private $humidity;

    public function update($temperature, $humidity, $pressure)
    {
        $this->temperature = $temperature;
        $this->humidity = $humidity;
        $this->display();
    }

    public function display()
    {
        echo "Current conditions: {$this->temperature}°C and {$this->humidity}% humidity\n";
    }
}

class ForecastDisplay implements Observer
{
    private $pressure;

    public function update($temperature, $humidity, $pressure)
    {
        $this->pressure = $pressure;
        $this->display();
    }

    public function display()
    {
        echo "Forecast: Pressure {$this->pressure} hPa\n\n";
    }
}

// Client code
$weatherData = new WeatherData();

$currentConditionsDisplay = new CurrentConditionsDisplay();
$forecastDisplay = new ForecastDisplay();

$weatherData->attach($currentConditionsDisplay);
$weatherData->attach($forecastDisplay);

$weatherData->setMeasurements(25.5, 60, 1013);
$weatherData->setMeasurements(28.0, 55, 1012);
