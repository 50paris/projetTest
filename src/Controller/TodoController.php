<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
/**
 * @Route("/todo") 
*/
class TodoController extends AbstractController
{
    #[Route('/', name: 'app_todo')]
    public function index(Request $request): Response
    {
        $session = $request -> getSession();
        if(!$session->has('todo')){
            $todo = [
                    'achat'=>'acheter clef usb',
                    'cours'=>'finaliser mon cours',
                    'correction'=>'corriger mes examens'
            ];
            $session->set('todo',$todo);
            $this->addFlash('info','liste est init');
        }
        return $this->render('todo/index.html.twig');
    }
    #[Route('/add/{name?test}/{content?test content}', name: 'todo.add')]
    public function todoAdd(Request $request, $name, $content): RedirectResponse
    {
        $session= $request->getSession();
        if($session->has('todo')){
            $todo=  $session->get('todo');
            if(isset($todo[$name])){
                $this->addFlash('error','todo existant error');
            }else{
                $todo[$name] = $content;
                $this->addFlash('success','todo créé');
                $session->set('todo', $todo);
            }
        }else{
            $this->addFlash('error','liste non intit error');
        }
        return $this->redirectToRoute('app_todo');
    }
    #[Route('/update/{name}/{content}', name: 'todo.update')]
    public function updateTodo(Request $request, $name, $content): RedirectResponse
    {
        $session= $request->getSession();
        if($session->has('todo')){
            $todo=  $session->get('todo');
            if(!isset($todo[$name])){
                $this->addFlash('error','todo no existant error');
            }else{
                $todo[$name] = $content;
                $session->set('todo',$todo);
                $this->addFlash('success','todo modifié success');
            }
        }else{
            $this->addFlash('error','liste non intit error');
        }
        return $this->redirectToRoute('app_todo');
    }
    #[Route('/delete/{name}/', name: 'todo.delete')]
    public function deleteTodo(Request $request, $name): RedirectResponse
    {
        $session= $request->getSession();
        if($session->has('todo')){
            $todo=  $session->get('todo');
            if(!isset($todo[$name])){
                $this->addFlash('error','todo no existant error');
            }else{
               unset($todo[$name]);
                $session->set('todo',$todo);
                $this->addFlash('success','todo supprimé success');
            }
        }else{
            $this->addFlash('error','liste non intit error');
        }
        return $this->redirectToRoute('app_todo');
    }
    #[Route('/reset/', name: 'todo.reset')]
    public function resetTodo(Request $request ): RedirectResponse
    {
        $session= $request->getSession();
        $session->remove('todo');
        return $this->redirectToRoute('app_todo');
    }
}
