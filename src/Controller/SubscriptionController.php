<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Entity\Subscription;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Service\SubscriptionService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Contracts\Service\Attribute\SubscribedService;

class SubscriptionController extends AbstractController
{
    #[Route('/subscription/{contact}', name: 'subscription_by_contact', methods:['GET'])]
    public function subscriptionByIdContact(Request $request, SubscriptionService $subscriptionService, Contact $contact): Response
    { 
        $subscriptions = $subscriptionService->getSubscriptionsByContact($contact);
        return $this->render('subscription/subscription_contact.html.twig',[
            'subscriptions'=>$subscriptions
        ]);
    }

    #[Route('/subscription', name: 'subscription', methods:['POST'])]
    public function createSubscription(Request $request, SubscriptionService $subscriptionService): Response
    {
       $requestData = json_decode($request->getContent(), true);
       $subscriptionService->createSubscription($requestData);
       return new Response('Subscription created', Response::HTTP_OK);
    }

    #[Route('/subscription/{subscription}', name: 'edit_subscription', methods:['PUT'])]
    public function editSubscription(Request $request,Subscription $subscription,  SubscriptionService $subscriptionService): Response
    {
        $requestData = json_decode($request->getContent(), true);
        $subscriptionService->editSubscription($subscription, $requestData);
        return new Response('Subscription updated', Response::HTTP_OK);
    }

    #[Route('/subscription/{subscription}', name: 'delete_subscription', methods:['DELETE'])]
    public function deleteSubscription(Request $request, Subscription $subscription, SubscriptionService $subscriptionService): Response
    { 
        $subscriptionService->deleteSubscription($subscription);
        return $this->render('subscription/delete_subscription.html.twig');
    }

}
