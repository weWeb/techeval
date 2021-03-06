<?php
// src/Blogger/BlogBundle/Controller/PageController.php
// Reference: http://tutorial.symblog.co.uk/docs/configuration-and-templating.html

namespace Blogger\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Blogger\BlogBundle\Entity\Enquiry;
use Blogger\BlogBundle\Entity\Blog;
use Blogger\BlogBundle\Form\EnquiryType;
use Blogger\BlogBundle\Form\BlogType;

class PageController extends Controller
{
	public function indexAction()
	{
    	$em = $this->getDoctrine()
        	       ->getEntityManager();

    	$blogs = $em->getRepository('BloggerBlogBundle:Blog')
            	    ->getLatestBlogs();

    	return $this->render('BloggerBlogBundle:Page:index.html.twig', array(
        	'blogs' => $blogs
    	));
	}

	public function aboutAction()
	{
   	 	return $this->render('BloggerBlogBundle:Page:about.html.twig');
	}

	public function comparisonAction()
	{
   	 	return $this->render('BloggerBlogBundle:Page:comparison.html.twig');
	}

	public function contactAction()
	{
		$enquiry = new Enquiry();
		$form = $this->createForm(new EnquiryType(), $enquiry);

		$request = $this->getRequest();
		if ($request->getMethod() == 'POST') {
		    $form->bindRequest($request);

		    if ($form->isValid()) {
				$message = \Swift_Message::newInstance()
            		->setSubject('Contact enquiry from weweb symfony2 demo blog')
            		->setFrom('enquiries@symblog.co.uk')
            		->setTo($this->container->getParameter('blogger_blog.emails.contact_email'))
            		->setBody($this->renderView('BloggerBlogBundle:Page:contactEmail.txt.twig', array('enquiry' => $enquiry)));
        		$this->get('mailer')->send($message);
       			$this->get('session')->setFlash('blogger-notice', 'The email was successfully sent. Thank you!');
		        return $this->redirect($this->generateUrl('BloggerBlogBundle_contact'));
		    }
		}

		return $this->render('BloggerBlogBundle:Page:contact.html.twig', array('form' => $form->createView()));
	}

	public function sidebarAction()
	{
    		$em = $this->getDoctrine()
               		->getEntityManager();

	    	$tags = $em->getRepository('BloggerBlogBundle:Blog')
               		->getTags();

    		$tagWeights = $em->getRepository('BloggerBlogBundle:Blog')
                     		->getTagWeights($tags);

		$commentLimit   = $this->container
                           ->getParameter('blogger_blog.comments.latest_comment_limit');
    		$latestComments = $em->getRepository('BloggerBlogBundle:Comment')
                         	->getLatestComments($commentLimit);

    		return $this->render('BloggerBlogBundle:Page:sidebar.html.twig', array(
        		'latestComments'    => $latestComments,
        		'tags'              => $tagWeights
    		));
	}
	

	public function newblogAction()
	{
		$blog = new Blog();
		$form = $this->createForm(new BlogType(), $blog);
		
		$request = $this->getRequest();
    			if ($request->getMethod() == 'POST') {
        			$form->bindRequest($request);

        			if ($form->isValid()) {
            				$em = $this->getDoctrine()
                       				->getEntityManager();
           			 	$em->persist($blog);
           			 	
           				$em->flush();
            				$this->get('session')->setFlash('blogger-notice', 'The New Entry was successfully created. Thank you!');
           				return $this->redirect($this->generateUrl('BloggerBlogBundle_homepage'));
        			}
   	 	}

		/*$blog->setTitle("symblog - A Symfony2 Tutorial");
		$blog->setAuthor("yfw1");
		$blog->setBlog("symblog is a fully featured blogging website ...");
        	$blog->setImage('no_image.png');
        	$blog->setCreated(new \DateTime());
        	$blog->setUpdated($blog->getCreated());
           	$em = $this->getDoctrine()
                       ->getEntityManager();
		$em->persist($blog);
            	$em->flush();
            	*/
            	
		return $this->render('BloggerBlogBundle:Page:newblog.html.twig', array('form' => $form->createView()));

	}

}
