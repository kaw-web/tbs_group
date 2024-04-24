<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Entity\Contact;
use App\Service\SubscriptionService;

class SubscriptionController extends AbstractController
{
    #[Route('/subscription/{idContact}', name: 'subscription_by_contact', methods:['GET'])]
    public function subscriptionByIdContact(Request $request, Contact $contact, SubscriptionService $subscriptionService): Response
    {
       
    }

    #[Route('/subscription', name: 'subscription', methods:['POST'])]
    public function subscription(Request $request): Response
    {
       
    }

    #[Route('/subscription/{idSubscription}', name: 'edit_subscription', methods:['PUT'])]
    public function editSubscription(Request $request): Response
    {
       
    }

    #[Route('/subscription/{idSubscription}', name: 'delete_subscription', methods:['DELETE'])]
    public function deleteSubscription(Request $request): Response
    {
       
    }

}
