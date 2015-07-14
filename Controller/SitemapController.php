<?php
namespace Opifer\CmsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class SitemapController extends Controller
{
    /**
     * @Route("/sitemap", name="opifer_cms_sitemap_index")
     */
    public function indexAction()
    {
        $repository = $this->getDoctrine()->getRepository('OpiferCmsBundle:Content');
        $items = $repository->findActiveAddressable();

        return $this->render(
            'OpiferCmsBundle:Sitemap:index.html.twig',
            array('items' => $items)
        );
    }
}
