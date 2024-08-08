<?php

// src/Entity/Booking.php
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use DateTimeInterface;

/**
 * @ORM\Entity(repositoryClass="App\Repository\BookingRepository")
 * @ORM\Table(name="bookings")
 */
#[ORM\Entity(repositoryClass: 'App\Repository\BookingRepository')]
#[ORM\Table(name: 'bookings')]
class Booking
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private int $id;

    #[ORM\Column(type: 'date', nullable: true)]
    private ?DateTimeInterface $booking_date = null;

    #[ORM\Column(type: 'time', nullable: true)]
    private ?DateTimeInterface $booking_time = null;

    #[ORM\Column(type: 'string', length: 255)]
    #[Assert\NotBlank]
    #[Assert\Length(max: 255)]
    #[Assert\Regex(pattern: '/^[a-zA-Z\s]+$/', message: 'Name can only contain letters and spaces.')]
    private string $name;

    #[ORM\Column(type: 'string', length: 255)]
    #[Assert\NotBlank]
    #[Assert\Email(message: 'The email "{{ value }}" is not a valid email.')]
    private string $email;

    #[ORM\Column(type: 'string', length: 20)]
    #[Assert\NotBlank]
    #[Assert\Regex(pattern: '/^\+?[0-9]{7,15}$/', message: 'Phone number must be between 7 and 15 digits long.')]
    private string $phone;

    #[ORM\Column(type: 'boolean')]
    private bool $status;

    // Getter and Setter methods

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBookingDate(): ?DateTimeInterface
    {
        return $this->booking_date;
    }

    public function setBookingDate(?DateTimeInterface $booking_date): self
    {
        $this->booking_date = $booking_date;
        return $this;
    }

    public function getBookingTime(): ?DateTimeInterface
    {
        return $this->booking_time;
    }

    public function setBookingTime(?DateTimeInterface $booking_time): self
    {
        $this->booking_time = $booking_time;
        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;
        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): self
    {
        $this->phone = $phone;
        return $this;
    }

    public function getStatus(): ?bool
    {
        return $this->status;
    }

    public function setStatus(bool $status): self
    {
        $this->status = $status;
        return $this;
    }
}
