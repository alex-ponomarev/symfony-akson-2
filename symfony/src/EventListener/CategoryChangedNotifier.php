<?php


namespace App\EventListener;
use App\Entity\Category;
use App\Security\Authorization;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Mapping\PreRemove;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpClient\CurlHttpClient;

class CategoryChangedNotifier extends AbstractController
{
    private string $token;
    /**
     * @var Authorization
     */
    private Authorization $authorization;

    public function __construct()
    {
        $this->authorization = new Authorization();
        $this->token = $this->authorization->loginToProductService($_ENV['URL_SERVICE_CATEGORY']);
    }
         /** @PreRemove */
        public function preDelete(Category $category, LifecycleEventArgs $event)
        {
            $entity = $event->getObject();
            $entityManager = $event->getObjectManager();

            // perhaps you only want to act on some "Product" entity
            if ($entity instanceof Category) {
                $client = new CurlHttpClient();
               try {
                   $client->request(
                       'DELETE',
                       $_ENV['URL_SERVICE_PRODUCT'].'/api/product/delete/category/' . $category->getId(), [
                           'auth_bearer' => '{"accessToken":"' . $this->token . '"}',
                       ]
                   );
                   return true;
               }
               catch (Exception $err){
                   return false;
               }
               finally{
                   return  false;
               }
            }
            return false;
        }
}