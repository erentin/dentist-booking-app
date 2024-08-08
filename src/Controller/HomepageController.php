<?php

namespace App\Controller;

use App\Entity\Booking;
use App\Form\DentistBookingType;
use App\Repository\BookingRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class HomepageController extends AbstractController
{

    public function __construct(BookingRepository $bookingRepository)
    {
        $this->bookingRepository = $bookingRepository;
    }

    #[Route('/', name: 'homepage')]
    public function index(Request $request): Response
    {
        date_default_timezone_set('Europe/Istanbul');

        $bookings = $this->bookingRepository->findAllBookings();

        

        $grouped = [];

        $grouped = [];

       
        foreach ($bookings as $booking) {
            $dateKey = $booking->getBookingDate()->format('Y-m-d'); // Tarihi 'Y-m-d' formatında al
            $timeKey = $booking->getBookingTime()->format('H:i'); // Saati 'H:i' formatında al
            
            // Tarihin milisaniye cinsinden zaman damgasını oluştur
            $dateTime = \DateTime::createFromFormat('Y-m-d', $dateKey, new \DateTimeZone('Europe/Istanbul'));
            $dateTime->setTime(0, 0, 0); // Saati 00:00:00 olarak ayarla
            $unixTimestamp = $dateTime->getTimestamp(); // Unix zaman damgasını al (saniye cinsinden)
            $millisecondsTimestamp = $unixTimestamp * 1000; // Milisaniyeye çevir
            
            if (!isset($grouped[$millisecondsTimestamp])) {
                $grouped[$millisecondsTimestamp] = [
                    'times' => [] // İlk başta zamanlar dizisi boş
                ];
            }
            
            // Zamanı ilgili tarihe ekle
            $grouped[$millisecondsTimestamp]['times'][] = $timeKey;
        }
        
        


    

        //dd($grouped);
        // Twig şablonuna formu geçirin
        return $this->render('homepage/index.html.twig', [
            'bookings' => $grouped,
        ]);
    }
}
