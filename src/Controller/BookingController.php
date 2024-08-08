<?php

namespace App\Controller;

use App\Entity\Booking;
use App\Repository\BookingRepository;
use App\Form\DentistBookingType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Serializer\SerializerInterface;

class BookingController extends AbstractController
{

    public function __construct(BookingRepository $bookingRepository)
    {
        $this->bookingRepository = $bookingRepository;
    }

    #[Route('/booking/list', name: 'booking_list')]
    public function index(Request $request): Response
    {
        $bookings = $this->bookingRepository->findAllBookings();

        return $this->render('booking/list.html.twig', [
            'bookings' => $bookings,
        ]);
    }


    #[Route('/booking/store', name: 'booking_store', methods: ['POST'])]
    public function store(Request $request, EntityManagerInterface $entityManager)
    {

        $name = $request->request->get('name');
        $email = $request->request->get('email');
        $phone = $request->request->get('phone');
        $date = $request->request->get('date');
        $time = $request->request->get('time');

        $dateTimestamp = (new \DateTime('now', new \DateTimeZone('GMT+3')))
            ->setTimestamp($date / 1000); // Timestamp milisaniye cinsinden olduğu için 1000'e bölüyoruz

        // 'time' parametresini DateTime nesnesine dönüştürme
        $timeString = str_replace(['am', 'pm'], ['AM', 'PM'], strtolower($time)); // Eğer gerekirse AM/PM ekleme
        $timeString = \DateTime::createFromFormat('H-i', $timeString, new \DateTimeZone('GMT'));


        //dd($dateTimestamp, $date);
        $booking = new Booking();
        $booking->setName($name);
        $booking->setEmail($email);
        $booking->setPhone($phone);
        $booking->setBookingDate($dateTimestamp);
        $booking->setBookingTime($timeString);
        $booking->setStatus(0);

        // Entity Manager kullanarak veriyi veritabanına kaydet
        $entityManager->persist($booking);
        $entityManager->flush();

         // Başarılı yanıt döndür
         return new Response('Appointment saved successfully with ID ' . $booking->getId());
    }

 
}
