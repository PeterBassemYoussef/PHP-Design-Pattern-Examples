<?php

/**
 * Air Traffic Controller
 */

// Mediator
interface ATCMediator
{
    public function registerRunway(Runway $runway);
    public function registerFlight(Flight $flight);
    public function canLand(Flight $flight);
    public function landingConfirmed(Flight $flight);
    public function canTakeOff(Flight $flight);
    public function takeOffConfirmed(Flight $flight);
}

// Concrete Mediator
class ATCControl implements ATCMediator
{
    private $runways = [];
    private $flights = [];

    public function registerRunway(Runway $runway)
    {
        $this->runways[] = $runway;
    }

    public function registerFlight(Flight $flight)
    {
        $this->flights[] = $flight;
        $flight->setMediator($this);
    }

    public function canLand(Flight $flight)
    {
        foreach ($this->runways as $runway) {
            if (!$runway->isOccupied()) {
                $runway->setFlight($flight);
                $runway->occupy();
                echo "{$flight->getName()} is clear to land on Runway {$runway->getName()}\n";
                return true;
            }
        }
        echo "{$flight->getName()} is waiting to land\n";
        return false;
    }

    public function landingConfirmed(Flight $flight)
    {
        echo "{$flight->getName()} has successfully landed\n\n";
    }

    public function canTakeOff(Flight $flight)
    {
        foreach ($this->runways as $runway) {
            if ($runway->isOccupied() && $runway->getFlight() === $flight) {
                return true;
            }
        }
        return false;
    }

    public function takeOffConfirmed(Flight $flight)
    {
        foreach ($this->runways as $runway) {
            if ($runway->isOccupied() && $runway->getFlight() === $flight) {
                echo "{$flight->getName()} has successfully taken off from Runway {$runway->getName()}\n\n";
                $runway->vacate();
            }
        }
    }
}

// Colleague
class Flight
{
    private $name;
    private $mediator;

    public function __construct($name)
    {
        $this->name = $name;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setMediator(ATCMediator $mediator)
    {
        $this->mediator = $mediator;
    }

    public function requestLanding()
    {
        if ($this->mediator->canLand($this)) {
            echo "{$this->name} is cleared for landing.\n";
            $this->mediator->landingConfirmed($this);
        } else {
            echo "{$this->name} is in a holding pattern.\n\n";
        }
    }

    public function requestTakeOff()
    {
        if ($this->mediator->canTakeOff($this)) {
            echo "{$this->name} is cleared for takeoff.\n";
            $this->mediator->takeOffConfirmed($this);
        } else {
            echo "{$this->name} cannot take off yet.\n\n";
        }
    }
}

// Concrete Colleague
class Runway
{
    private $name;
    private $occupied = false;
    private $flight;

    public function __construct($name)
    {
        $this->name = $name;
    }

    public function getName()
    {
        return $this->name;
    }

    public function isOccupied()
    {
        return $this->occupied;
    }

    public function occupy()
    {
        $this->occupied = true;
    }

    public function vacate()
    {
        $this->occupied = false;
    }

    public function setFlight(Flight $flight)
    {
        $this->flight = $flight;
    }

    public function getFlight()
    {
        return $this->flight;
    }
}

// Usage
$mediator = new ATCControl();
$runway1 = new Runway("Runway 1");
$runway2 = new Runway("Runway 2");

$mediator->registerRunway($runway1);
$mediator->registerRunway($runway2);

$flight1 = new Flight("Flight 123");
$flight2 = new Flight("Flight 456");
$flight3 = new Flight("Flight 789");

$mediator->registerFlight($flight1);
$mediator->registerFlight($flight2);
$mediator->registerFlight($flight3);

$flight1->requestLanding();
$flight2->requestLanding();

$flight3->requestLanding();

sleep(2);
$flight2->requestTakeOff();

$flight3->requestLanding();
