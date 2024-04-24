<?php

namespace App\Service;

use App\Entity\Contact;
use App\Entity\Product;
use App\Entity\Subscription;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;

class SubscriptionService
{

     public function  __construct(
        private readonly EntityManagerInterface $entityManager
     )
     {

     }

     public function getSubscriptionsByContact(Contact $contact):?array
     { 
       return $this->entityManager->getRepository(Subscription::class)->findBy(['contact'=>$contact->getId()]);
 
     }

     public function createSubscription(array $data):void
     {
         $subscripion = new Subscription();
         $subscripion->setContact($this->entityManager->getRepository(Contact::class)->findOneBy($data['idContact']));
         $subscripion->setProduct($this->entityManager->getRepository(Product::class)->findOneBy($data['idProduct']));
         $subscripion->setBeginDate($this->convertToDate( $data['beginDate'] ));
         $subscripion->setBeginDate($this->convertToDate( $data['endDate']) );
         $this->entityManager->persist($subscripion);
         $this->entityManager->flush();
     }

     public function editSubscription(Subscription $subscripion, array $data)
     {
         $subscripion->setContact($this->entityManager->getRepository(Contact::class)->findOneBy($data['idContact']));
         $subscripion->setProduct($this->entityManager->getRepository(Product::class)->findOneBy($data['idProduct']));
         $subscripion->setBeginDate($this->convertToDate( $data['beginDate'] ));
         $subscripion->setBeginDate($this->convertToDate( $data['endDate']) );
         $this->entityManager->flush();
     }

      public function deleteSubscription(Subscription $subscription):void
      { 
         $this->entityManager->remove($subscription);
         $this->entityManager->flush();

      }

      private function convertToDate(string $date):DateTime
      {
         
         $format = 'Y-m-d H:i:s';
         $dateTime = DateTime::createFromFormat($format, $date);
         return $dateTime;
      }

}