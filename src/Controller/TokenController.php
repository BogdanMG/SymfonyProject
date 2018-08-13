<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

use Firebase\JWT\JWT;

use App\Entity\Products;

class TokenController extends AbstractController
{
    /**
     * @Route("/api", name="api") 
     * @Method("POST")
     */
    public function getToken(Request $request)
    {
        define("SECRET_KEY","secret_key123456");

    $payload = [
        'iss' => 'admin',
            'aud' => 'users',
            'subject' => 'asgartcompany',
            'name' => 'BogdanMG'

    ];

        $token = JWT::encode($payload, SECRET_KEY);
        $req = $request->headers->get('Authorization');

    if($req){
        list($token) = sscanf($req, 'Bearer %s');
        if($token){
            try{
                $token = JWT::decode($token, SECRET_KEY, array('HS256'));     
                $input = json_decode(file_get_contents("php://input"));

                switch($input){

                    case $input->total_price:

                    if($input->total_price == true){
                        $products = $this->getDoctrine()->getRepository(Products::class)->findAllPrice();
                        return new Response(json_encode($products));
                    } else{
                        return new Response(json_encode(['price_all_error'=>'Value must be "true"']));
                        
                    }
                    break;

                    case $input->price:

                    if($input->price == "max"){
                        $products = $this->getDoctrine()->getRepository(Products::class)->findMaxPrice();
                        return new Response(json_encode($products));
                    }elseif($input->price == "min"){
                        $products = $this->getDoctrine()->getRepository(Products::class)->findMinPrice();
                        return new Response(json_encode($products));
            
                    } else{
                        return new Response(json_encode(['price_error'=>'Value must be "max" or min']));
                    }
                    break;

                    case $input->sort_by_date:

                    if($input->sort_by_date == "forward"){
                        $products = $this->getDoctrine()->getRepository(Products::class)->sortOnDate();
                        return new Response(json_encode($products));
            
                    }elseif($input->sort_by_date == "reverse"){
                            $products = $this->getDoctrine()->getRepository(Products::class)->sortOnDateRev();
                        return new Response(json_encode($products));
                    }else{
                        return new Response(json_encode(['sort_on_date_error'=>'Value must be "forward" or "reverse"']));
            
                    }

                    break;

                    case $input->sort_by_name:

                    if($input->sort_by_name == "forward"){
                        $products = $this->getDoctrine()->getRepository(Products::class)->sortByName();
                        return new Response(json_encode($products));
                    }elseif($input->sort_by_name == "reverse"){
                        $products = $this->getDoctrine()->getRepository(Products::class)->sortByNameRev();
                        return new Response(json_encode($products));
                    }else{
                        return new Response(json_encode(['sort_by_name_error'=>'Value must be "forward" or "rewverse"']));
            
                    }

                    break;

                    case $input->date_from:
                    case $input->date_to:

                    if(is_integer($input->date_from) && is_integer($input->date_to)){
                        $products = $this->getDoctrine()->getRepository(Products::class)->setDateRange($input->date_from, $input->date_to);
                        return new Response(json_encode($products));
                    }else{
                        return new Response(json_encode(['date_error'=>'Value must be type of "integer" or date not found']));
            
                    }

                    break;

                    case $input->upper_bound:
                    case $input->lower_bound:

                    if($input->upper_bound == null && $input->lower_bound == true){
                        $products = $this->getDoctrine()->getRepository(Products::class)->sortByLowerBound();
                        return new Response(json_encode($products));
                    }else{
                        return new Response(json_encode(['bound_error'=>'Value must be "true" in lower_bound or "" in upper_bound']));
            
                    }
            
                    if($input->upper_bound == true && $input->lower_bound == null){
                        $products = $this->getDoctrine()->getRepository(Products::class)->sortByUpperBound();
                        return new Response(json_encode($products));
                    }else{
                        return new Response(json_encode(['bound_error'=>'Value must be "true" in upper_bound or "" in lower_bound']));
                    }
                    break;


                    default:

                    return new Response(json_encode(['error'=>'Value is empty']));

                    break;
                
                }
                  
            }catch(Exeption $e){
                header('HTTP/1.0 401 Unauthorized');
            }
            


        }else{
            header('HTTP/1.0 400 Bad Request');
        }


        }else{
        header('HTTP/1.0 400 Bad Request');
        return new Response(json_encode(['info'=>'Token not found in reques']));
        }
        

    }


   /* eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJhZG1pbiIsImF1ZCI6InVzZXJzIiwic3ViamVjdCI6ImFzZ2FydGNvbXBhbnkiLCJuYW1lIjoiQm9nZGFuTUcifQ.3qnyKXKgdMrfzM32fnaukr3l2TBeWEoPYeN-0IiFnU4*/




    






}
?>