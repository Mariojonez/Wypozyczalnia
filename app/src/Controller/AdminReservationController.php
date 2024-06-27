<?php
/**
 * Admin Reservation controller.
 */

namespace App\Controller;

use App\Entity\Reservation;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class AdminReservationController.
 *
 * Controller for managing reservations by admin.
 */
class AdminReservationController extends AbstractController
{
    /**
     * Approve a reservation.
     *
     * @param Reservation            $reservation   The reservation entity
     * @param EntityManagerInterface $entityManager The entity manager
     *
     * @return Response The HTTP response
     *
     * @Route("/admin/reservation/{id}/approve", name="admin_reservation_approve")
     */
    #[Route('/admin/reservation/{id}/approve', name: 'admin_reservation_approve')]
    public function approve(Reservation $reservation, EntityManagerInterface $entityManager): Response
    {
        $reservation->setStatus('approved');
        $entityManager->flush();

        // Update resource state
        // $resource = $reservation->getTask();
        // $resource->setStatus('unavailable');
        // $entityManager->flush();

        $this->addFlash('success', 'Reservation approved.');

        return $this->redirectToRoute('admin_reservation_list');
    }

    /**
     * Reject a reservation.
     *
     * @param Reservation            $reservation   The reservation entity
     * @param EntityManagerInterface $entityManager The entity manager
     *
     * @return Response The HTTP response
     *
     * @Route("/admin/reservation/{id}/reject", name="admin_reservation_reject")
     */
    #[Route('/admin/reservation/{id}/reject', name: 'admin_reservation_reject')]
    public function reject(Reservation $reservation, EntityManagerInterface $entityManager): Response
    {
        $reservation->setStatus('rejected');
        $entityManager->flush();

        $this->addFlash('success', 'Reservation rejected.');

        return $this->redirectToRoute('admin_reservation_list');
    }

    /**
     * Mark a reservation as returned.
     *
     * @param Reservation            $reservation   The reservation entity
     * @param EntityManagerInterface $entityManager The entity manager
     *
     * @return Response The HTTP response
     *
     * @Route("/admin/reservation/{id}/return", name="admin_reservation_return")
     */
    #[Route('/admin/reservation/{id}/return', name: 'admin_reservation_return')]
    public function return(Reservation $reservation, EntityManagerInterface $entityManager): Response
    {
        $reservation->setStatus('returned');
        $entityManager->flush();

        // Update resource state
        // $resource = $reservation->getTask();
        // $resource->setStatus('available');
        // $entityManager->flush();

        $this->addFlash('success', 'Resource returned.');

        return $this->redirectToRoute('admin_reservation_list');
    }
}
